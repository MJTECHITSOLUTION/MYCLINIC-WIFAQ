
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Patients') }}</h6>
                </div>

                <div class="col-6">
                    @can('add patient')
                        <a href="{{ route('patient.create') }}" class="btn rounded-0  btn-primary btn-sm float-right "><i
                                class="fa fa-plus"></i> {{ __('sentence.New Patient') }}</a>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="{{ route('patient.search') }}" method="post">
                        <div class="input-group w-100 border">
                            <input type="text" name="term" class="form-control rounded-0 bg-light border-0 small"
                                placeholder="Rechercher par (CIN,Téléphone,Nom,Prénom)" aria-label="Search" aria-describedby="basic-addon2">
                            @csrf
                            <div class="input-group-append">
                                <button class="btn  btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ __('sentence.Patient Name') }}</th>
                            <th class="text-center">{{ __('sentence.Age') }}</th>
                            <th class="text-center">{{ __('sentence.Phone') }}</th>
                            <th class="text-center">{{ __('sentence.Date') }} de création</th>
                            <th class="text-center">Médecin</th>
                            <th class="text-center">Afficher</th>
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr>
                                <td><a href="{{ url('patient/view/' . $patient->user_id) }}"> {{ $patient->name }} </a></td>
                                <td class="text-center"> {{ @\Carbon\Carbon::parse($patient->Patient->birthday)->age }}
                                </td>
                                <td class="text-center"> {{ @$patient->Patient->phone }} </td>
                                <td class="text-center"><label
                                        class="badge badge-primary-soft">{{ $patient->created_at->format('d-m-Y') }}</label>
                                </td>
                                <td class="text-center">
                                    @php $doctor = App\User::find($patient->dr_id); @endphp
                                    @if($doctor)
                                        <label class="badge badge-primary-soft">
                                            <i class="fas fa-user-md mr-1"></i> {{ $doctor->name }}
                                        </label>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @can('view patient')
                                        <a href="{{ route('prescription.view_for_user', ['id' => $patient->user_id]) }}"
                                            class="btn rounded-0  btn-outline-primary btn-sm"></i>
                                            Consultation</a>
                                    @endcan

                                    @can('view patient')
                                        <a href="{{ route('billing.showall', ['id' => $patient->user_id]) }}"
                                            class="btn rounded-0  btn-outline-primary btn-sm"></i>
                                            Paiment</a>
                                    @endcan
                                </td>
                                <td class="text-center">
                                    @can('view patient')
                                        <a href="{{ route('patient.view', ['id' => $patient->user_id]) }}"
                                            class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    @endcan
                                    @can('edit patient')
                                        <a href="{{ route('patient.edit', ['id' => $patient->user_id]) }}"
                                            class="btn   btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('delete patient')
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="{{ route('patient.destroy', ['id' => $patient->user_id]) }}"><i
                                                class="fas fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" align="center"><img src="{{ asset('img/rest.png') }} " /> <br><br> <b
                                        class="text-muted">No patients found!</b>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                <div id="container"></div>
                <span class="float-right mt-3">{{ $patients->links() }}</span>

            </div>
        </div>
    </div>
@endsection
