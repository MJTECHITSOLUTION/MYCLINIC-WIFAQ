@extends('layouts.master')

@section('title')
    Ajouter une TVA
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Ajouter une type dépense</h6>
                        </div>

                        <div class="col-6">
                            @can('create drug')
                                <a href="{{ route('depense.all') }}" class="btn btn-primary btn-sm float-right"><i
                                        class="fa fa-plus"></i>
                                    Tous les dépense</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('type_depose.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="my__label">Libellé <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="name" id="name">
                        </div>



                        <div class="form-group">
                            <label for="exampleInputEmail1" class="my__label">Note <span class="text-danger"></span></label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="note" id="note">

                        </div>


                        <div class="col-md-12 d-flex justify-content-end">

                            <button type="submit" class="btn btn-primary rounded-0 ">{{ __('sentence.Save') }}</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
