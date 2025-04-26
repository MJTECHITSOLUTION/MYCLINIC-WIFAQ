<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use Redirect;
class DrugController extends Controller{


	public function __construct(){
        $this->middleware('auth');
    }


    //
    public function create(){
    	return view('drug.create');

    }

    public function store(Request $request){

    	$validatedData = $request->validate([
        	'trade_name' => 'required',
    	]);

    	$drug = Drug::updateOrCreate(
		    ['trade_name' => $request->trade_name, 'generic_name' => $request->generic_name],
		    ['note' => $request->note]
		);

    	return Redirect::route('drug.all')->with('success', __('sentence.Drug added Successfully'));
    }

    public function all()
    {
        $drugs = Drug::paginate(100); // 10 items per page

        return view('drug.all', ['drugs' => $drugs]);
    }


    public function edit($id){
        $drug = Drug::find($id);
        return view('drug.edit',['drug' => $drug]);
    }

    public function store_edit(Request $request){

        $validatedData = $request->validate([
            'trade_name' => 'required',
        ]);

        $drug = Drug::find($request->drug_id);

        $drug->trade_name = $request->trade_name;
        $drug->generic_name = $request->generic_name;
        $drug->note = $request->note;

        $drug->save();

        return Redirect::route('drug.all')->with('success', __('sentence.Drug Edited Successfully'));

    }
    public function search(Request $request){
        $term = $request->term;
        $drugs = Drug::where('trade_name','LIKE','%' . $term . '%')->OrderBy('id','DESC')->paginate(200);
        return view('drug.all', ['drugs' => $drugs]);
    }

        public function destroy($id){

        Drug::destroy($id);
        return Redirect::route('drug.all')->with('success', __('sentence.Drug Deleted Successfully'));

    }
}
