<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Patient;
use App\Appointment;
use App\Setting;
use Redirect;
use Nexmo;
use Illuminate\Support\Facades\Session;


class AppointmentController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
    }
    public function btncreate($id){
        $patient = User::findOrfail($id);
        Session::put('lastpatient', $patient->id);
        Session::put('namePatient', $patient->name);
        Session::put('imagePatient', $patient->image);
        Session::put('genderPation', $patient->patient->gender);
    	$patients = User::where('role','patient')->get();
	    return view('appointment.create', ['patients' => $patients]);
    }

    public function create(){
    	$patients = User::where('role','patient')->get();
        $doctors = User::where('role','Médecin')->get();
	    return view('appointment.create', ['patients' => $patients, 'doctors' => $doctors]);
    }

    public function checkslots($date, Request $request)
    {
        $doctorId = $request->query('doctor_id'); // ✅ Get doctor ID from query string
        return $this->getTimeSlot($date, $doctorId); // Pass to function
    }

    public function available_slot($date, $start, $end, $doctor_id)
    {
        $check = Appointment::where('date', $date)
            ->where('time_start', $start)
            ->where('time_end', $end)
            ->where('doctor_id', $doctor_id) // ✅ filter by doctor
            ->where('visited', '!=', '2')
            ->count();
    
        return $check == 0 ? 'available' : 'unavailable';
    }
    


    public function getTimeSlot($date,$doctorId) {

        $day = date("l", strtotime($date));
        $day_from_morning = strtolower($day . '_from_morning');
        $day_to_morning = strtolower($day . '_to_morning');
        $day_from_evening = strtolower($day . '_from_evening');
        $day_to_evening = strtolower($day . '_to_evening');

        $start_morning = Setting::get_option($day_from_morning);
        $end_morning = Setting::get_option($day_to_morning);
        $start_evening = Setting::get_option($day_from_evening);
        $end_evening = Setting::get_option($day_to_evening);
        $interval = Setting::get_option('appointment_interval');

        $startM = new DateTime($start_morning);
        $endM = new DateTime($end_morning);
        $startE = new DateTime($start_evening);
        $endE = new DateTime($end_evening);
        $start_time_morning = $startM->format('H:i');
        $end_time_morning = $endM->format('H:i');
        $start_time_evening = $startE->format('H:i');
        $end_time_evening = $endE->format('H:i');
        

        $time = [];

        $i = 0;
        while (strtotime($start_time_morning) <= strtotime($end_time_morning)) {
            $start = $start_time_morning;
            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time_morning)));
            $start_time_morning = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time_morning)));
            $time[$i]['start'] = $start;
            $time[$i]['end'] = $end;
            $time[$i]['available'] = $this->available_slot($date, $start, $end,$doctorId);
            $i++;
        }

        while (strtotime($start_time_evening) <= strtotime($end_time_evening)) {
            $start = $start_time_evening;
            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time_evening)));
            $start_time_evening = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($start_time_evening)));
            $time[$i]['start'] = $start;
            $time[$i]['end'] = $end;
            $time[$i]['available'] = $this->available_slot($date, $start, $end, $doctorId);
            $i++;
        }

        return $time;
    }


	public function store(Request $request){


		$validatedData = $request->validate([
        	'patient' => ['required','exists:users,id'],
            'rdv_time_date' => ['required'],
            'rdv_time_start' => ['required'],
            'rdv_time_end' => ['required'],
            'send_sms' => ['boolean'],
            'doctor_id'=> ['required'],

    	]);

    	$appointment = new Appointment(); 
		$appointment->user_id = $request->patient;
		$appointment->date = $request->rdv_time_date;
		$appointment->time_start = $request->rdv_time_start;
		$appointment->time_end = $request->rdv_time_end;
        $appointment->visited = 0;
        $appointment->reason = $request->reason;
        $appointment->doctor_id = $request->doctor_id;
		$appointment->save();


//        if($request->send_sms == 1){
//
//            $user = User::findOrFail($request->patient);
//            $phone = $user->Patient->phone;
//
//            Nexmo::message()->send([
//                'to'   => $phone,
//                'from' => '213794616181',
//                'text' => 'You have an appointment on '.$request->rdv_time_date.' at '.$request->rdv_time_start.' at Doctorino'
//            ]);
//
//        }

		return Redirect::route('appointment.all')->with('success', 'Rendez-vous créé avec succès !');

	}

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'rdv_id' => ['required', 'exists:appointments,id'],
            'rdv_status' => ['required', 'numeric'],
        ]);

        if ($request->rdv_status == 4) {
            $salle_soin = Appointment::where('visited', 4)->first();
            if ($salle_soin) {
                $appointments = Appointment::findOrFail($salle_soin->id);
                $appointments->visited = 1;
                $appointments->save();
            }
        }

        $appointment = Appointment::findOrFail($request->rdv_id);
        $appointment->visited = $request->rdv_status;
        $appointment->hours = $request->hours;
        $appointment->save();

        $salle_soin = Appointment::where('visited', 4)
            ->join('users', 'appointments.user_id', '=', 'users.id')
            ->first();

//        if ($salle_soin) {
//            Session::put('salle_soin', $salle_soin);
//        }

        return Redirect::back()->with('success', 'Rendez-vous mis à jour avec succès !');
    }


    public function all()
    {
        $lastpatient = session('lastpatient');

        $appointments = Appointment::orderBy('id', 'DESC')
            ->when($lastpatient, function ($query) use ($lastpatient) {
                return $query->where('user_id', $lastpatient);
            })
            ->paginate(10);

        return view('appointment.all', ['appointments' => $appointments]);
    }

    public function calendar(){

        $appointments = Appointment::orderBy('id','DESC')->paginate(10);
        return view('appointment.calendar', ['appointments' => $appointments]);
    }

    public function pending(){

        $appointments = Appointment::where('visited', 3)->orderBy('hours', 'ASC')->paginate(10);

        return view('appointment.pending', ['appointments' => $appointments]);
    }


    public function day(){

        $currentDate = now()->format('Y-m-d'); // Get the current date in 'Y-m-d' format
        $appointments = Appointment::whereDate('date', $currentDate)->orderBy('id','DESC')->paginate(10);

        return view('appointment.day', ['appointments' => $appointments]);

    }

    public function dayfilter(Request $request){
        $startDate = $request->input('datefilter');
//        $currentDate = now()->format('Y-m-d'); // Get the current date in 'Y-m-d' format
        $appointments = Appointment::whereDate('date', $startDate)->orderBy('id','DESC')->paginate(10);

        return view('appointment.dayfilter', ['appointments' => $appointments,'startDate'=>$startDate]);

    }



    public function destroy($id){

        Appointment::destroy($id);
        return Redirect::route('appointment.all')->with('success', 'Rendez-vous supprimé avec succès !');

    }


}
