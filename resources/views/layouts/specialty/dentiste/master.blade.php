<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Digit94Team">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <title>Myclinic - @yield('title') </title>
    <!-- Custom styles for this template-->
    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"
          media="all">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" media="all">


    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/css/gijgo.min.css') }}" rel="stylesheet" media="all">

    <script>
        "use strict";
        const SITE_URL = "{{ url('/') }}";
    </script>


    @yield('header')


</head>
@php
    $namePatient = Session::get('namePatient');
    $lastPatientId = Session::get('lastpatient');
    $imagePatient = Session::get('imagePatient');
    $genderPation = Session::get('genderPation');

@endphp
<body id="page-top">
<div id="app">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15 d-none d-lg-block d-xl-none">
                </div>
                <div class="sidebar-brand-text mx-3"><img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" class="img-fluid" style="margin-top: 20px"></div>
            </a>
            <!-- Divider -->
            <br>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('sentence.Dashboard') }}</span></a>
            </li>
            @if(Auth::user()->can('add patient') || Auth::user()->can('view all patients'))
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('sentence.Patients') }}
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient"
                       aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-user-injured"></i>
                        <span>{{ __('sentence.Patients') }}</span>
                    </a>
                    <div id="collapsePatient" class="collapse" aria-labelledby="headingTwo"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @can('add patient')
                                <a class="collapse-item"
                                   href="{{ route('patient.create') }}">{{ __('sentence.New Patient') }}</a>
                            @endcan
                            @can('view all patients')
                                <a class="collapse-item"
                                   href="{{ route('patient.all') }}">{{ __('sentence.All Patients') }}</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endif



            @if(Auth::user()->can('create prescription') || Auth::user()->can('view all prescriptions') || Auth::user()->can('view prescription') || Auth::user()->can('view prescription'))

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('sentence.Prescriptions') }}
                </div>


                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                       aria-expanded="true" aria-controls="collapseTwo">
                        <i class="far fa-file-alt"></i>
                        <span>{{ __('sentence.Prescriptions') }}</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @can('create prescription')
                                <a class="collapse-item"
                                   href="{{ route('prescription.create') }}">{{ __('sentence.New Prescription') }}</a>
                            @endcan
                            @can('view all prescriptions')
                                <a class="collapse-item"
                                   href="{{ route('prescription.all') }}">{{ __('sentence.All Prescriptions') }}</a>
                            @endcan
{{--                            @can('view all invoices')--}}
{{--                                <a class="collapse-item"--}}
{{--                                   href="{{ route('billing.all') }}">{{ __('sentence.Billing List') }}</a>--}}
{{--                            @endcan--}}
                        </div>
                    </div>
                </li>
            @endif


            {{--                Graph Parametre--}}
{{--            @if(Auth::user()->can('create drug') || Auth::user()->can('view all drugs') || Auth::user()->can('view drug') || Auth::user()->can('edit drug'))--}}

{{--                <!-- Nav Item - Pages Collapse Menu -->--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseGraph"--}}
{{--                       aria-expanded="true" aria-controls="collapseGraph">--}}
{{--                        <i class="fas fa-chart-bar"></i>--}}
{{--                        <span>{{ __('sentence.croissance') }}</span>--}}
{{--                    </a>--}}
{{--                    <div id="collapseGraph" class="collapse" aria-labelledby="headingPages"--}}
{{--                         data-parent="#accordionSidebar">--}}
{{--                        <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                            @can('create drug')--}}
{{--                                <a class="collapse-item"--}}
{{--                                   href="{{ route('graph.create') }}">{{ __('sentence.Add graph') }}</a>--}}
{{--                            @endcan--}}
{{--                            @can('view all drugs')--}}
{{--                                <a class="collapse-item"--}}
{{--                                   href="{{ route('graph.all') }}">{{ __('sentence.All graph') }}</a>--}}
{{--                            @endcan--}}


{{--                        </div>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            @endif--}}
            {{--Rapport--}}
            @if(Auth::user()->can('create drug') || Auth::user()->can('view all drugs') || Auth::user()->can('view drug') || Auth::user()->can('edit drug'))

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapserapport"
                       aria-expanded="true" aria-controls="collapserapport">
                        <i class='far fa-file-pdf'></i>
                        <span>Rapport</span>
                    </a>
                    <div id="collapserapport" class="collapse" aria-labelledby="headingPages"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @can('create drug')
                                <a class="collapse-item" href="{{ route('rapport.create') }}">Ajouter rapport</a>
                            @endcan
                            @can('view all drugs')
                                <a class="collapse-item" href="{{ route('rapport.all') }}">Tout les rapports</a>
                            @endcan
                                @can('view all drugs')
                                    <a class="collapse-item" href="{{ route('gabarit.gabarit_all') }}">Modèle rapport </a>
                                @endcan
                                @can('view all drugs')
                                    <a class="collapse-item" href="{{ route('gabarit.all') }}">Modèle patient </a>
                                @endcan
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsenote" aria-expanded="true" aria-controls="collapsenote">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2" viewBox="0 0 16 16">
                            <path d="M3.5 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5H12a.5.5 0 0 1 0-1h.5A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1H4a.5.5 0 0 1 0 1z"/>
                            <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"/>
                        </svg>
                        <span>Note d'honoraire</span>
                    </a>
                    <div id="collapsenote" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{--                                    @can('create invoice')--}}
                            {{--                                    <!-- <a class="collapse-item" href="{{ route('billing.create') }}">{{ __('sentence.Create Invoice') }}</a> -->--}}
                            {{--                                    @endcan--}}
                            @can('view all invoices')
                                <a class="collapse-item" href="{{ route('notehonoraire.create') }}">Ajouter note d'honoraire</a>
                            @endcan
                            @can('view all invoices')
                                <a class="collapse-item" href="{{ route('notehonoraire.all') }}">Tous les notes d'honoraire</a>
                            @endcan
                        </div>
                    </div>
                </li>
                
            @endif





                           @if(Auth::user()->can('create invoice') || Auth::user()->can('edit invoice') || Auth::user()->can('view invoice') || Auth::user()->can('view all invoices'))

                           <!-- Divider -->
                           <hr class="sidebar-divider">
                           <!-- Heading -->
                           <div class="sidebar-heading">
                              {{ __('sentence.Billing') }}
                           </div>
                           <!-- Nav Item - Utilities Collapse Menu -->
                           <li class="nav-item">
                              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBilling" aria-expanded="true" aria-controls="collapseBilling">
                              <i class="fas fa-fw fa-dollar-sign"></i>
                              <span>{{ __('sentence.Billing') }}</span>
                              </a>
                              <div id="collapseBilling" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                 <div class="bg-white py-2 collapse-inner rounded">
{{--                                    @can('create invoice')--}}
{{--                                    <!-- <a class="collapse-item" href="{{ route('billing.create') }}">{{ __('sentence.Create Invoice') }}</a> -->--}}
{{--                                    @endcan--}}
                                    @can('view all invoices')
                                    <a class="collapse-item" href="{{ route('billing.all') }}">Liste des paiements</a>
                                    @endcan
                                     @can('view all invoices')
                                    <a class="collapse-item" href="{{ route('billing.facture') }}">{{ __('sentence.Billing List') }}</a>
                                    @endcan
                                 </div>
                              </div>
                           </li>

            @endif

           @if(Auth::user()->can('create appointment') || Auth::user()->can('view all appointments') || Auth::user()->can('delete appointment'))
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('sentence.Appointment') }}
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppointment"
                       aria-expanded="true" aria-controls="collapseAppointment">
                        <i class="fas fa-fw fa-calendar-plus"></i>
                        <span>{{ __('sentence.Appointment') }}</span>
                    </a>
                    <div id="collapseAppointment" class="collapse" aria-labelledby="headingTwo"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @can('create appointment')
                                <a class="collapse-item" href="{{ route('appointment.create') }}">{{ __('sentence.New Appointment') }}</a>
                            @endcan
                            @can('view all appointments')
                                <a class="collapse-item" href="{{ route('appointment.pending') }}">Salle d'attente</a>

                                <a class="collapse-item"
                                   href="{{ route('appointment.all') }}">{{ __('sentence.All Appointments') }}</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endif

            @if(Auth::user()->can('manage roles'))
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Rapport statistique
                </div>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                       aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Statistique</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item"
                               href="{{ route('record.all') }}">Par patient</a>
                            <a class="collapse-item" href="{{ route('record.allP') }}">Par paiement</a>
                            <a class="collapse-item"
                               href="{{ route('record.allC') }}">Par consultation</a>
                            <a class="collapse-item"
                               href="{{ route('record.allR') }}">Par rendez-vous</a>
                            <a class="collapse-item"
                               href="{{ route('record.allA') }}">Par assurance</a>
                            <a class="collapse-item"
                               href="{{ route('record.allCA') }}">Consultation par <br>type d'assurance</a>
                        </div>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('manage roles'))
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Dépenses
                </div>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                       data-target="#collapseDespenses" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fa fa-money-bill"></i>
                        <span>Dépense</span>
                    </a>
                    <div id="collapseDespenses" class="collapse" aria-labelledby="headingUtilities"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1"
                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    Dépense

                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                    @can('create drug')
                                        <a class="collapse-item" href="{{ route('depense.create') }}">Ajouter une
                                            Dépense</a>
                                    @endcan
                                    @can('view all drugs')
                                        <a class="collapse-item" href="{{ route('depense.all') }}">Tous les
                                            Dépenses
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1"
                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    Achat
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                    @can('create drug')
                                        <a class="collapse-item" href="{{ route('purchase.create') }}">Ajouter une
                                            achat</a>
                                    @endcan
                                    @can('view all drugs')
                                        <a class="collapse-item" href="{{ route('purchase.all') }}">Tous les
                                            achats</a>
                                    @endcan
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
            @endif


            @if(Auth::user()->can('manage settings'))
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('sentence.Settings') }}
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSettings"
                       aria-expanded="true" aria-controls="collapseSettings">
                        <i class="fas fa-fw fa-cogs"></i>
                        <span>{{ __('sentence.Settings') }}</span>
                    </a>
                    <div id="collapseSettings" class="collapse" aria-labelledby="headingPages"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item"
                               href="{{ route('doctorino_settings.edit') }}">{{ __('sentence.Doctorino Settings') }}</a>
                            {{--                                <a class="collapse-item" href="{{ route('prescription_settings.edit') }}">{{ __('sentence.Prescription Settings') }}</a>--}}
                            <!-- <a class="collapse-item" href="{{ route('sms_settings.edit') }}">{{ __('sentence.SMS Gateway Setup') }}</a> -->

                            <!-- Roles -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('sentence.Users Management') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <a class="collapse-item"
                                           href="{{ route('user.create') }}">{{ __('sentence.Create User') }}</a>
                                        <a class="collapse-item" href="{{ route('user.all') }}">{{ __('sentence.All Users') }}</a>
                                        <a class="collapse-item"
                                           href="{{ route('roles.all') }}">{{ __('sentence.Roles & Permissions') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Nested Dropdown 1 -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('sentence.Drugs') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                    @can('create drug')
                                        <a class="collapse-item"
                                           href="{{ route('drug.create') }}">{{ __('sentence.Add Drug') }}</a>
                                    @endcan
                                    @can('view all drugs')
                                        <a class="collapse-item"
                                           href="{{ route('drug.all') }}">{{ __('sentence.All Drugs') }}</a>
                                    @endcan
                                </div>
                            </div>
                            <!-- Nested Dropdown  -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1"
                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    Catégorie

                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                    @can('create drug')
                                        <a class="collapse-item" href="{{ route('category.create') }}">Ajouter une
                                            catégorie</a>
                                    @endcan
                                    @can('view all drugs')
                                        <a class="collapse-item" href="{{ route('category.all') }}">Tous les
                                            catégories
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1"
                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    Type dépense

                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                    @can('create drug')
                                        <a class="collapse-item" href="{{ route('type_depose.create') }}">Ajouter une
                                            type dépense</a>
                                    @endcan
                                    @can('view all drugs')
                                        <a class="collapse-item" href="{{ route('type_depose.all') }}">Tous les
                                            type dépense</a>

                                        </a>
                                    @endcan
                                </div>
                            </div>


                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1"
                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    TVA

                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                    @can('create drug')
                                        <a class="collapse-item" href="{{ route('tva.create') }}">Ajouter une
                                            TVA</a>
                                    @endcan
                                    @can('view all drugs')
                                        <a class="collapse-item" href="{{ route('tva.all') }}">Tous les
                                            TVA
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <!-- Nested Dropdown  -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1"
                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    Article
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                    @can('create drug')
                                        <a class="collapse-item" href="{{ route('item.create') }}">Ajouter une
                                            article</a>
                                    @endcan
                                    @can('view all drugs')
                                        <a class="collapse-item" href="{{ route('item.all') }}">Tous les
                                            articles</a>
                                    @endcan
                                </div>
                            </div>


                            <!-- Nested Dropdown  -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1"
                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    Achat
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                    @can('create drug')
                                        <a class="collapse-item" href="{{ route('purchase.create') }}">Ajouter une
                                            achat</a>
                                    @endcan
                                    @can('view all drugs')
                                        <a class="collapse-item" href="{{ route('purchase.all') }}">Tous les
                                            achats</a>
                                    @endcan
                                </div>
                            </div>

                            <!-- Nested Dropdown  -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1"
                                   role="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    Fournisseur
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                    @can('create drug')
                                        <a class="collapse-item" href="{{ route('fournisseur.create') }}">Ajouter une
                                            fournisseur</a>
                                    @endcan
                                    @can('view all drugs')
                                        <a class="collapse-item" href="{{ route('fournisseur.all') }}">Tous les
                                            fournisseurs</a>
                                    @endcan
                                </div>
                            </div>

                            <!--Radio-->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown4" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Radio
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown4">
                                    <!-- Add the appropriate permissions checks and route names -->
                                    @can('create drug')
                                        <a class="collapse-item" href="{{ route('radio.create') }}">Ajouter radio</a>
                                    @endcan
                                    @can('view all drugs')
                                        <!-- Replace 'view all radios' with the actual permission name -->
                                        <a class="collapse-item" href="{{ route('radio.all') }}">Tout les radios</a>
                                    @endcan
                                </div>
                            </div>

                            <!-- Nested Dropdown 2 -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown2" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Analyse
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown2">
                                    {{--                                        @can('create diagnostic test')--}}
                                    {{--                                            <a class="collapse-item" href="{{ route('test.create') }}">{{ __('sentence.Add Test') }}</a>--}}
                                    {{--                                        @endcan--}}
                                    {{--                                        @can('view all diagnostic tests')--}}
                                    {{--                                            <a class="collapse-item" href="{{ route('test.all') }}">{{ __('sentence.All Tests') }}</a>--}}
                                    {{--                                        @endcan--}}
                                    @can('view all diagnostic tests')
                                        <a class="collapse-item"
                                           href="{{ route('analyse.create') }}">{{ __('sentence.creer analyse') }}</a>
                                    @endcan
                                    @can('view all diagnostic tests')
                                        <a class="collapse-item"
                                           href="{{ route('analyse.all') }}">{{ __('sentence.All analyse') }}</a>
                                    @endcan
                                </div>
                            </div>

                            <!-- Nested Dropdown 3 -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown3" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('sentence.assurance') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown3">
                                    @can('create diagnostic test')
                                        <a class="collapse-item"
                                           href="{{ route('assurance.create') }}">{{ __('sentence.Add assurance') }}</a>
                                    @endcan
                                    @can('view all diagnostic tests')
                                        <a class="collapse-item"
                                           href="{{ route('assurance.all') }}">{{ __('sentence.All assurance') }}</a>
                                    @endcan
                                </div>
                            </div>

                            <!-- Nested Dropdown 4 -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown30" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Antécédents
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown30">
                                    @can('create diagnostic test')
                                        <a class="collapse-item"
                                           href="{{ route('anticedents.create') }}">Ajoutez antécédents</a>
                                    @endcan
                                    @can('view all diagnostic tests')
                                        <a class="collapse-item"
                                           href="{{ route('anticedents.all') }}">Toutes antécédents</a>
                                    @endcan
                                </div>
                            </div>


                            <!-- Nested Dropdown 5 -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown4" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Service
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown4">
                                    @can('create diagnostic test')
                                        <a class="collapse-item"
                                           href="{{ route('payment.create') }}">Ajoute un service</a>
                                    @endcan
                                    @can('view all diagnostic tests')
                                        <a class="collapse-item"
                                           href="{{ route('payment.all') }}">Tous les services</a>
                                    @endcan
                                </div>
                            </div>

                            <!-- Nested Dropdown 6 -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown5" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acte
                                </a>
                                <div class="dropdown-menu" aria-labelledby="nestedDropdown5">
                                    @can('create diagnostic test')
                                        <a class="collapse-item"
                                           href="{{ route('act.create_category_act') }}">Famille acte</a>
                                    @endcan
                                    @can('create diagnostic test')
                                        <a class="collapse-item"
                                           href="{{ route('act.create_sous_category_act') }}">Sous catégorie acte</a>
                                    @endcan
                                    @can('view all diagnostic tests')
                                        <a class="collapse-item"
                                           href="{{ route('act.create_act') }}">les Actes</a>
                                    @endcan
                                </div>
                            </div>

                        </div>
                    </div>
                </li>

            @endif

            <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    AI assistant
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSettings"
                       aria-expanded="true" aria-controls="collapseSettings">
                        <i class="fas fa-fw fa-cogs"></i>
                        <span>AI assistant</span>
                    </a>
                    <div id="collapseSettings" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- Add your settings items here -->
                        </div>
                    </div>
                </li> --}}
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseai" aria-expanded="true" aria-controls="collapseai">
                    <i class="fas fa-robot"></i>
                    <span>Ai assistant</span>
                </a>
                <div id="collapseai" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        @can('view all invoices')
                            <a class="collapse-item" href="{{ route('ai.index') }}">Ai assistant</a>
                        @endcan
                        
                    </div>
                </div>
            </li>

            {{--                @if(Auth::user()->can('create drug') || Auth::user()->can('view all drugs') || Auth::user()->can('view drug') || Auth::user()->can('edit drug'))--}}

            {{--                    <!-- Nav Item - Pages Collapse Menu -->--}}
            {{--                    <li class="nav-item">--}}
            {{--                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">--}}
            {{--                            <i class="fas fa-fw fa-pills"></i>--}}
            {{--                            <span>{{ __('sentence.Drugs') }}</span>--}}
            {{--                        </a>--}}
            {{--                        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">--}}
            {{--                            <div class="bg-white py-2 collapse-inner rounded">--}}

            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </li>--}}
            {{--                @endif--}}



            {{--                @if(Auth::user()->can('create diagnostic test') || Auth::user()->can('edit diagnostic test') || Auth::user()->can('view all diagnostic tests'))--}}

            {{--                    <!-- Nav Item - Pages Collapse Menu -->--}}
            {{--                    <li class="nav-item">--}}
            {{--                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTests" aria-expanded="true" aria-controls="collapseTests">--}}
            {{--                            <i class="fas fa-fw fa-heartbeat"></i>--}}
            {{--                            <span>{{ __('sentence.Tests') }}</span>--}}
            {{--                        </a>--}}
            {{--                        <div id="collapseTests" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">--}}
            {{--                            <div class="bg-white py-2 collapse-inner rounded">--}}

            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </li>--}}
            {{--                @endif--}}

            {{--                @if(Auth::user()->can('create diagnostic test') || Auth::user()->can('edit diagnostic test') || Auth::user()->can('view all diagnostic tests'))--}}

            <!-- Nav Item - Pages Collapse Menu -->
            {{--                    <li class="nav-item">--}}
            {{--                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseAssurance" aria-expanded="true" aria-controls="collapseAssurance">--}}
            {{--                            <i class="fa fa-address-book" aria-hidden="true"></i>--}}
            {{--                            <span>{{ __('sentence.assurance') }}</span>--}}
            {{--                        </a>--}}
            {{--                        <div id="collapseAssurance" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">--}}
            {{--                            <div class="bg-white py-2 collapse-inner rounded">--}}
            {{--                                --}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </li>--}}
            {{--                @endif--}}



            {{-- @php
                $salle_soin = \App\Appointment::where('visited', 4)
                    ->join('users', 'appointments.user_id', '=', 'users.id')
                    ->select('users.name', 'users.id as user_id')
                    ->first();
            @endphp --}}
                <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            {{-- @isset($salle_soin)
                <div class="col-auto d-xl-block d-none">
                    <div class="header_notification d-flex align-items-center notification-wrapper">
                        <div class="notification_icon">
                            <img src="{{ asset('img/thumbnail.png') }}" class="img-fluid my_img_profil" alt="user" style="max-width: 30px;">
                        </div>
                        <p class="notification_text">
                            @isset($salle_soin->name)
                                <a href="{{ url('patient/view/'.$salle_soin->user_id) }}" role="button">
                                    <span>{{ $salle_soin->name }}</span>
                                </a>
                            @endisset
                        </p>
                    </div>
                </div>
            @endisset --}}


        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="dropdown shortcut-menu mr-4">
                        <button type="button" class="btn btn-doctorino brd-20 dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                            {{ __('sentence.Create as new') }} </button>
                        <div class="dropdown-menu shadow">
                            @if(Auth::user()->can('create prescription'))
                                <a class="dropdown-item"
                                   href="{{ route('prescription.create') }}">{{ __('sentence.Prescription') }}</a>
                            @endif
                            @if(Auth::user()->can('add patient'))
                                <a class="dropdown-item"
                                   href="{{ route('patient.create') }}">{{ __('sentence.Patient') }}</a>
                            @endif
                            @if(Auth::user()->can('create appointment'))
                                <a class="dropdown-item"
                                   href="{{ route('appointment.create') }}">{{ __('sentence.Appointment') }}</a>
                            @endif
{{--                            @if(Auth::user()->can('create invoice'))--}}
{{--                                <a class="dropdown-item"--}}
{{--                                   href="{{ route('billing.create') }}">{{ __('sentence.Invoice') }}</a>--}}
{{--                            @endif--}}
{{--                            @if(Auth::user()->can('create drug'))--}}
{{--                                <a class="dropdown-item" href="{{ route('drug.create') }}">{{ __('sentence.Drug') }}</a>--}}
{{--                            @endif--}}
                            @if(Auth::user()->can('create diagnostic test'))
                                {{--                              <a class="dropdown-item" href="{{ route('test.create') }}">{{ __('sentence.Diagnosis Test') }}</a>--}}
                            @endif
                        </div>
                    </div>

                    @can('view all patients')
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                            action="{{ route('patient.search') }}" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                       placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2"
                                       name="term">
                                @csrf
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endcan

                    <!-- Topbar Navbar -->

                    <ul class="navbar-nav ml-auto">

                        @empty(!$lastPatientId)
                            <a href="{{ url('patient/view/'.$lastPatientId) }}" role="button" style="position: relative ; top: 12px; right: 5px;">
                                    @if ($genderPation == 'Homme' || $genderPation == 'Boy')
                                        <center><img src="{{ asset('img/homme.png') }}" width="50" height="50"
                                                     class="d-none d-sm-inline-block rounded-circle mr-2">
                                        </center>
                                    @elseif ($genderPation == 'Femme')
                                        <center><img src="{{ asset('img/femme.png') }}" width="50" height="50"
                                                     class="d-none d-sm-inline-block rounded-circle mr-2">
                                        </center>
                                    @elseif ($genderPation == 'Enfant' || $genderPation == 'Garçon')
                                        <center><img src="{{ asset('img/garson.png') }}" width="50"
                                                     height="50" class="d-none d-sm-inline-block rounded-circle mr-2">
                                        </center>
                                    @elseif ($genderPation == 'Fille' || $genderPation == 'fille')
                                        <center><img src="{{ asset('img/fille.png') }}" width="50"
                                                     height="50" class="d-none d-sm-inline-block rounded-circle mr-2">
                                        </center>
                                    @else
                                        <center><img src="{{ asset('img/homme.png') }}" width="50"
                                                     height="50" class="d-none d-sm-inline-block rounded-circle mr-2">
                                        </center>
                                    @endif
                            </a>
                            <a href="{{ url('patient/view/'.$lastPatientId) }}" role="button">
                                <span style="position: relative ; top: 23px;">{{$namePatient}}</span>
                            </a>
                            <!-- Nav Item - User Information -->
{{--                            <a class="fa fa-user-times fa-1x" href="{{route('patient.create')}}" style="color: red; position: relative; left: 10px; top: 25px;" aria-hidden="true"></a>--}}
{{--                            <a href="{{ url('patient/view/'.$lastPatientId) }}" role="button">--}}
{{--                                <input  class="styled-input" id="patientNameInput" style="position: relative ; top: 23px;" value="{{$namePatient}}" readonly></input>--}}
{{--                            </a>--}}
{{--                        <input type="text" id="patientNameInput" value="{{$namePatient}}">--}}

                            <!-- Nav Item - User Information -->
                            <a class="fa fa-user-times fa-1x" href="{{route('clear.session')}}"
                               style="color: red; position: relative; left: 10px; top: 25px;" aria-hidden="true"></a>
                        @endempty
                        <li class="nav-item dropdown no-arrow" style="margin-left: 250px;">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-900 small-600">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/rmili.png') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="{{ route('patient.view', ['id' => Auth::user()->id]) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('sentence.View Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('user.edit_profile') }}">
                                    <i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('sentence.Update Profile') }}
                                </a>
                                @if(Auth::user()->can('manage settings'))
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('doctorino_settings.edit') }}">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('sentence.Doctorino Settings') }}
                                    </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('sentence.Logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>


                    @yield('content')



                    <!-- Page Heading -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright my-auto">
                        <span>Copyright &copy; Created by <a href="https://mjtech-solution.com/" target="_blank"> MJTech Solutions</a> 2008 - {{ date('Y') }}</span>
                        <span style="float: right;">Dentiste - Version {{ date('Y') }}V2</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.Ready to Leave') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{ __('sentence.Ready to Leave Msg') }}</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button"
                        data-dismiss="modal">{{ __('sentence.Cancel') }}</button>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('sentence.Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal-->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Voulez-vous vraiment supprimer cet élément ?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button"
                        data-dismiss="modal">{{ __('sentence.Cancel') }}</button>
                <a class="btn btn-danger" id="delete_link">Supprimer</a>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('dashboard/js/vue.js') }}"></script>
<script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap core JavaScript-->
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('dashboard/js/gijgo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboard/js/jquery.repeatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboard/js/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('https://jasonday.github.io/printThis/printThis.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>


@if (session('success'))
    <script type="text/javascript">
        $.notify({
            message: "<?php echo session('success'); ?>"
        }, {
            type: "success",
            delay: 5000,
        });
    </script>
@endif

@if (session('danger'))
    <script type="text/javascript">
        $.notify({
            message: "<?php echo session('danger'); ?>"
        }, {
            type: "danger",
            delay: 5000,
        });
    </script>
@endif

@if (session('warning'))
    <script type="text/javascript">
        $.notify({
            message: "<?php echo session('warning'); ?>"
        }, {
            type: "warning",
            delay: 5000,
        });
    </script>
@endif

<style>
    /* Apply styles to the input element */
    .styled-input {
        border: none !important;
        background-color: transparent;
        padding: 0;
        margin: 0;
        outline: none;
        width: auto; /* Adjust the width as needed */
        font-size: inherit;
    }

    /* Optional: Add additional styles to mimic a div */
    .styled-input {
        display: block;
        border: 2px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        background-color: white;
    }
</style>
<script>
    document.getElementById('clear-session-form').addEventListener('submit', function(event) {
        event.preventDefault();
        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
            .then(response => {
                if (response.ok) {
                    // Reload the page after clearing the session
                    location.reload();
                }
            });
    });
</script>

<script>
    // Function to refresh the input value
    function refreshInputValue() {
        var namePatient = "{{$namePatient}}"; // Get the current value of $namePatient
        document.getElementById("patientNameInput").value = namePatient; // Update the input's value
    }

    // Add an event listener to the button
    document.getElementById("refreshButton").addEventListener("click", refreshInputValue);
</script>
<style>
    .notification-wrapper {
        background-color: white;
        border-radius: 10px; /* Adjust the radius as needed */
        padding: 10px; /* Optional: add some padding for better spacing */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: add a subtle shadow for better appearance */
        display: flex;
        align-items: center;
    }

    .notification_icon {
        margin-right: 10px; /* Space between the icon and the text */
        display: flex;
        align-items: center;
    }

    .my_img_profil {
        border-radius: 50%; /* Makes the image circular */
        border: 2px solid #ddd; /* Optional: add a border around the image */
    }

    .notification_text {
        margin: 0; /* Remove any default margin */
        display: flex;
        align-items: center;
    }

</style>

@yield('footer')

</body>
</html>
