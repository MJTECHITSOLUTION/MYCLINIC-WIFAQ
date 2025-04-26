@extends('layouts.master')

@section('title')
    {{ __('sentence.All graph') }}
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All graph') }}</h6>
                </div>
                {{--                <div class="col-4"> --}}
                {{--                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('graph.search') }}" method="post"> --}}
                {{--                        <div class="input-group"> --}}
                {{--                            <input type="text" name="term" class="form-control rounded-0 shoadow-none shadow-none rounded-0 bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"> --}}
                {{--                            @csrf --}}
                {{--                            <div class="input-group-append"> --}}
                {{--                                <button class="btn rounded-0  btn-primary" type="submit"> --}}
                {{--                                    <i class="fas fa-search fa-sm"></i> --}}
                {{--                                </button> --}}
                {{--                            </div> --}}
                {{--                        </div> --}}
                {{--                    </form> --}}
                {{--                </div> --}}
                <div class="col-4">
                    <a href="{{ route('graph.create') }}" class="btn rounded-0  btn-primary btn-sm float-right"><i
                            class="fa fa-plus"></i>
                        {{ __('sentence.New graph') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{--                        <th>ID</th> --}}
                            <th>{{ __('sentence.Patient') }}</th>
                            <th class="text-center">Nom de graphe</th>
                            <th class="text-center">Type de graphe</th>
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse($croissances as $croissance)
                                {{--                                <td>{{ $croissance->id }}</td> --}}
                                <td><a> {{ $croissance->name }} </a></td>
                                {{--                            <td class="text-center">{{ $prescription->created_at->format('d M Y H:i') }}</td> --}}
                                <td class="text-center">
                                    <label class="badge badge-primary-soft">
                                        {{ $croissance->label }}
                                        <input type="hidden" name="label" id="label"
                                            value="{{ $croissance->label }}">
                                    </label>
                                    <label class="badge badge-primary-soft">
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="badge badge-primary-soft">
                                        {{ $croissance->type }}
                                    </label>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('graph/view/' . $croissance->id . '?label=' . $croissance->label . '&graph_id=' . $croissance->graph_id) }}"
                                        class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('graph/edit/' . $croissance->id . '?label=' . $croissance->label . '&graph_id=' . $croissance->graph_id) }}"
                                        class="btn   btn-outline-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                    <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                        data-target="#DeleteModal"
                                        data-link="{{ url('graph/delete/' . $croissance->id . '?user_id=' . $croissance->user_id . '&graph_id=' . $croissance->graph_id) }}"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center"><img src="{{ asset('img/not-found.svg') }}"
                                    width="200" /> <br><br> <b class="text-muted">Aucun Graphe trouvé</b></td>
                        </tr>
                    </tbody>
                    @endforelse

                </table>


            </div>
        </div>
    </div>
@endsection
