<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="Digit94Team">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
      <link rel="icon" type="image/png" href="<?php echo e(asset('img/favicon.png')); ?>">
      <title>Tayssir - <?php echo $__env->yieldContent('title'); ?> </title>
      <!-- Custom styles for this template-->
    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('dashboard/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css" media="all">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" media="all">


    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('dashboard/css/sb-admin-2.min.css')); ?>" rel="stylesheet"  media="all">
    <link href="<?php echo e(asset('dashboard/css/gijgo.min.css')); ?>" rel="stylesheet" media="all">

         <script>
             "use strict";
               const SITE_URL = "<?php echo e(url('/')); ?>";
         </script>


      <?php echo $__env->yieldContent('header'); ?>


</head>
   <?php
       $namePatient = Session::get('namePatient');
       $lastPatientId = Session::get('lastpatient');
       $imagePatient = Session::get('imagePatient');
   ?>
   <body id="page-top">
      <div id="app">
         <!-- Page Wrapper -->
         <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
               <!-- Sidebar - Brand -->
               <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('home')); ?>">
                  <div class="sidebar-brand-icon rotate-n-15 d-none d-lg-block d-xl-none">
                     <i class="fas fa-user-md"></i>
                  </div>
                  <div class="sidebar-brand-text mx-3"><img src="<?php echo e(asset('img/logo.png')); ?>" class="img-fluid" style="margin-top: 20px"></div>
               </a>
               <!-- Divider -->
                <br>
               <hr class="sidebar-divider my-0">
               <!-- Nav Item - Dashboard -->
               <li class="nav-item active">
                  <a class="nav-link" href="<?php echo e(route('home')); ?>">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span><?php echo e(__('sentence.Dashboard')); ?></span></a>
               </li>
               <?php if(Auth::user()->can('add patient') || Auth::user()->can('view all patients')): ?>
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  <?php echo e(__('sentence.Patients')); ?>

               </div>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient" aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fas fa-fw fa-user-injured"></i>
                  <span><?php echo e(__('sentence.Patients')); ?></span>
                  </a>
                  <div id="collapsePatient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
                        <a class="collapse-item" href="<?php echo e(route('patient.create')); ?>"><?php echo e(__('sentence.New Patient')); ?></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all patients')): ?>
                        <a class="collapse-item" href="<?php echo e(route('patient.all')); ?>"><?php echo e(__('sentence.All Patients')); ?></a>
                        <?php endif; ?>
                     </div>
                  </div>
               </li>
               <?php endif; ?>



               <?php if(Auth::user()->can('create prescription') || Auth::user()->can('view all prescriptions') || Auth::user()->can('view prescription') || Auth::user()->can('view prescription')): ?>

               <!-- Divider -->
               <hr class="sidebar-divider">

               <!-- Heading -->
               <div class="sidebar-heading">
                  <?php echo e(__('sentence.Prescriptions')); ?>

               </div>


               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fas fa-fw fa-prescription"></i>
                  <span><?php echo e(__('sentence.Prescriptions')); ?></span>
                  </a>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create prescription')): ?>
                        <a class="collapse-item" href="<?php echo e(route('prescription.create')); ?>"><?php echo e(__('sentence.New Prescription')); ?></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all prescriptions')): ?>
                        <a class="collapse-item" href="<?php echo e(route('prescription.all')); ?>"><?php echo e(__('sentence.All Prescriptions')); ?></a>
                        <?php endif; ?>
                     </div>
                  </div>
               </li>
               <?php endif; ?>



                <?php if(Auth::user()->can('create drug') || Auth::user()->can('view all drugs') || Auth::user()->can('view drug') || Auth::user()->can('edit drug')): ?>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseGraph" aria-expanded="true" aria-controls="collapseGraph">
                            <i class="fas fa-chart-bar"></i>
                            <span><?php echo e(__('sentence.croissance')); ?></span>
                        </a>
                        <div id="collapseGraph" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">



                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                                    <a class="collapse-item" href="<?php echo e(route('graph.create')); ?>"><?php echo e(__('sentence.Add graph')); ?></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all drugs')): ?>
                                    <a class="collapse-item" href="<?php echo e(route('graph.all')); ?>"><?php echo e(__('sentence.All graph')); ?></a>
                                <?php endif; ?>


                            </div>
                        </div>
                    </li>
                <?php endif; ?>





               <?php if(Auth::user()->can('create invoice') || Auth::user()->can('edit invoice') || Auth::user()->can('view invoice') || Auth::user()->can('view all invoices')): ?>

               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  <?php echo e(__('sentence.Billing')); ?>

               </div>
               <!-- Nav Item - Utilities Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBilling" aria-expanded="true" aria-controls="collapseBilling">
                  <i class="fas fa-fw fa-dollar-sign"></i>
                  <span><?php echo e(__('sentence.Billing')); ?></span>
                  </a>
                  <div id="collapseBilling" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
                        <a class="collapse-item" href="<?php echo e(route('billing.create')); ?>"><?php echo e(__('sentence.Create Invoice')); ?></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all invoices')): ?>
                        <a class="collapse-item" href="<?php echo e(route('billing.all')); ?>"><?php echo e(__('sentence.Billing List')); ?></a>
                        <?php endif; ?>
                     </div>
                  </div>
               </li>

               <?php endif; ?>

                <?php if(Auth::user()->can('create appointment') || Auth::user()->can('view all appointments') || Auth::user()->can('delete appointment')): ?>
                    <!-- Divider -->
                    <hr class="sidebar-divider">
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        <?php echo e(__('sentence.Appointment')); ?>

                    </div>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppointment" aria-expanded="true" aria-controls="collapseAppointment">
                            <i class="fas fa-fw fa-calendar-plus"></i>
                            <span><?php echo e(__('sentence.Appointment')); ?></span>
                        </a>
                        <div id="collapseAppointment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appointment')): ?>
                                    <a class="collapse-item" href="<?php echo e(route('appointment.create')); ?>"><?php echo e(__('sentence.New Appointment')); ?></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all appointments')): ?>
                                    <a class="collapse-item" href="<?php echo e(route('appointment.pending')); ?>">Salle d'attente</a>

                                    <a class="collapse-item" href="<?php echo e(route('appointment.all')); ?>"><?php echo e(__('sentence.All Appointments')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

               <?php if(Auth::user()->can('manage roles')): ?>
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  <?php echo e(__('sentence.Users & Roles')); ?>

               </div>
               <!-- Nav Item - Utilities Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                  <i class="fas fa-fw fa-users"></i>
                  <span><?php echo e(__('sentence.Users Management')); ?></span>
                  </a>
                  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo e(route('user.create')); ?>"><?php echo e(__('sentence.Create User')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('user.all')); ?>"><?php echo e(__('sentence.All Users')); ?></a>
                        <a class="collapse-item" href="<?php echo e(route('roles.all')); ?>"><?php echo e(__('sentence.Roles & Permissions')); ?></a>
                     </div>
                  </div>
               </li>
               <?php endif; ?>

               <?php if(Auth::user()->can('manage settings')): ?>
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  <?php echo e(__('sentence.Settings')); ?>

               </div>
               <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
                            <i class="fas fa-fw fa-cogs"></i>
                            <span><?php echo e(__('sentence.Settings')); ?></span>
                        </a>
                        <div id="collapseSettings" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="<?php echo e(route('doctorino_settings.edit')); ?>"><?php echo e(__('sentence.Doctorino Settings')); ?></a>
                                <a class="collapse-item" href="<?php echo e(route('prescription_settings.edit')); ?>"><?php echo e(__('sentence.Prescription Settings')); ?></a>
                                <a class="collapse-item" href="<?php echo e(route('sms_settings.edit')); ?>"><?php echo e(__('sentence.SMS Gateway Setup')); ?></a>

                                <!-- Nested Dropdown 1 -->
                                <div class="dropdown">
                                    <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e(__('sentence.Drugs')); ?>

                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="nestedDropdown1">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                                            <a class="collapse-item" href="<?php echo e(route('drug.create')); ?>"><?php echo e(__('sentence.Add Drug')); ?></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all drugs')): ?>
                                            <a class="collapse-item" href="<?php echo e(route('drug.all')); ?>"><?php echo e(__('sentence.All Drugs')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Nested Dropdown 2 -->
                                <div class="dropdown">
                                    <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Analyse
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="nestedDropdown2">






                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all diagnostic tests')): ?>
                                            <a class="collapse-item" href="<?php echo e(route('analyse.create')); ?>"><?php echo e(__('sentence.creer analyse')); ?></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all diagnostic tests')): ?>
                                            <a class="collapse-item" href="<?php echo e(route('analyse.all')); ?>"><?php echo e(__('sentence.All analyse')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Nested Dropdown 3 -->
                                <div class="dropdown">
                                    <a class="collapse-item dropdown-toggle" href="#" id="nestedDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e(__('sentence.assurance')); ?>

                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="nestedDropdown3">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create diagnostic test')): ?>
                                            <a class="collapse-item" href="<?php echo e(route('assurance.create')); ?>"><?php echo e(__('sentence.Add assurance')); ?></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all diagnostic tests')): ?>
                                            <a class="collapse-item" href="<?php echo e(route('assurance.all')); ?>"><?php echo e(__('sentence.All assurance')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>



                <?php endif; ?>




































                    <!-- Nav Item - Pages Collapse Menu -->















               <!-- Divider -->
               <hr class="sidebar-divider d-none d-md-block">
               <!-- Sidebar Toggler (Sidebar) -->
               <div class="text-center d-none d-md-inline">
                  <button class="rounded-circle border-0" id="sidebarToggle"></button>
               </div>
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
                       <button type="button" class="btn btn-doctorino brd-20 dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?php echo e(__('sentence.Create as new')); ?> </button>
                       <div class="dropdown-menu shadow">
                        <?php if(Auth::user()->can('create prescription')): ?>
                              <a class="dropdown-item" href="<?php echo e(route('prescription.create')); ?>"><?php echo e(__('sentence.Prescription')); ?></a>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('add patient')): ?>
                              <a class="dropdown-item" href="<?php echo e(route('patient.create')); ?>"><?php echo e(__('sentence.Patient')); ?></a>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('create appointment')): ?>
                              <a class="dropdown-item" href="<?php echo e(route('appointment.create')); ?>"><?php echo e(__('sentence.Appointment')); ?></a>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('create invoice')): ?>
                              <a class="dropdown-item" href="<?php echo e(route('billing.create')); ?>"><?php echo e(__('sentence.Invoice')); ?></a>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('create drug')): ?>
                              <a class="dropdown-item" href="<?php echo e(route('drug.create')); ?>"><?php echo e(__('sentence.Drug')); ?></a>
                        <?php endif; ?>
                        <?php if(Auth::user()->can('create diagnostic test')): ?>
                              <a class="dropdown-item" href="<?php echo e(route('test.create')); ?>"><?php echo e(__('sentence.Diagnosis Test')); ?></a>
                        <?php endif; ?>
                       </div>
                     </div>

                     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view all patients')): ?>
                     <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?php echo e(route('patient.search')); ?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2" name="term">
                            <?php echo csrf_field(); ?>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                     </form>
                     <?php endif; ?>

                     <!-- Topbar Navbar -->

                     <ul class="navbar-nav ml-auto">
                         <?php if(empty(!$lastPatientId)): ?>
                         <a href="<?php echo e(url('patient/view/'.$lastPatientId)); ?>" role="button" style="position: relative ; top: 12px; right: 5px;">
                                     <?php if(empty(!$imagePatient)): ?>
                                         <center><img src="<?php echo e(asset('uploads/'.$imagePatient)); ?>" class="img-profile rounded-circle img-fluid" width="40" height="40"></center>
                                     <?php else: ?>
                                         <center><img src="<?php echo e(asset('img/patient-icon.png')); ?>" class="img-profile rounded-circle img-fluid" width="40" height="40"></center>
                                     <?php endif; ?>
                         </a>
                         <a href="<?php echo e(url('patient/view/'.$lastPatientId)); ?>" role="button">
                                     <span style="position: relative ; top: 23px;"><?php echo e($namePatient); ?></span>
                         </a>
                        <!-- Nav Item - User Information -->
                             <a class="fa fa-user-times fa-1x" href="<?php echo e(route('patient.create')); ?>" style="color: red; position: relative; left: 10px; top: 25px;" aria-hidden="true"></a>
                         <?php endif; ?>
                        <li class="nav-item dropdown no-arrow" style="margin-left: 250px;">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <span class="mr-2 d-none d-lg-inline text-gray-900 small-600"><?php echo e(Auth::user()->name); ?></span>
                           <img class="img-profile rounded-circle" src="<?php echo e(asset('img/favicon.png')); ?>">
                           </a>
                           <!-- Dropdown - User Information -->
                           <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                               <a class="dropdown-item" href="<?php echo e(route('patient.view', ['id' => Auth::user()->id])); ?>">
                              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                              <?php echo e(__('sentence.View Profile')); ?>

                              </a>
                                <a class="dropdown-item" href="<?php echo e(route('user.edit_profile')); ?>">
                              <i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i>
                              <?php echo e(__('sentence.Update Profile')); ?>

                              </a>
                              <?php if(Auth::user()->can('manage settings')): ?>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="<?php echo e(route('doctorino_settings.edit')); ?>">
                              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                              <?php echo e(__('sentence.Doctorino Settings')); ?>

                              </a>
                              <?php endif; ?>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                              <?php echo e(__('sentence.Logout')); ?>

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
                              <?php if($errors->any()): ?>
                              <div class="alert alert-danger">
                                 <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </ul>
                              </div>
                              <?php endif; ?>
                           </div>
                        </div>



                     <?php echo $__env->yieldContent('content'); ?>



                     <!-- Page Heading -->
                  </div>
                  <!-- /.container-fluid -->
               </div>
               <!-- End of Main Content -->
               <!-- Footer -->
               <footer class="sticky-footer bg-white">
                  <div class="container my-auto">
                     <div class="copyright my-auto">
                        <span>Copyright &copy; Created by <a href="https://tayssir.cloud" target="_blank"> MJTech Solutions</a> <?php echo e(date('Y')); ?></span>
                        <span style="float: right;">Version 2.0</span>
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
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('sentence.Ready to Leave')); ?></h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body"><?php echo e(__('sentence.Ready to Leave Msg')); ?></div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo e(__('sentence.Cancel')); ?></button>
                  <a class="btn btn-primary" href="<?php echo e(route('logout')); ?>"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo e(__('sentence.Logout')); ?></a>
                  <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                     <?php echo csrf_field(); ?>
                  </form>
               </div>
            </div>
         </div>
      </div>


      <!-- Delete Modal-->
      <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('sentence.Delete')); ?></h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body"><?php echo e(__('sentence.Delete Alert')); ?></div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo e(__('sentence.Cancel')); ?></button>
                  <a class="btn btn-danger" id="delete_link"><?php echo e(__('sentence.Delete')); ?></a>
               </div>
            </div>
         </div>
      </div>

   <script src="<?php echo e(asset('dashboard/js/vue.js')); ?>"></script>
   <script src="<?php echo e(asset('dashboard/vendor/jquery/jquery.min.js')); ?>"></script>

      <!-- Bootstrap core JavaScript-->
   <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

      <script src="<?php echo e(asset('dashboard/js/gijgo.min.js')); ?>" type="text/javascript"></script>
      <script src="<?php echo e(asset('dashboard/js/jquery.repeatable.js')); ?>" type="text/javascript"></script>
       <script src="<?php echo e(asset('dashboard/js/bootstrap-notify.min.js')); ?>"></script>
       <script src="<?php echo e(asset('https://jasonday.github.io/printThis/printThis.js')); ?>"></script>

      <script src="<?php echo e(asset('js/custom.js')); ?>"></script>


            <?php if(session('success')): ?>
                <script type="text/javascript">
                    $.notify({
                                    message: "<?php echo session('success'); ?>"
                                },{
                                    type: "success",
                                    delay:5000,
                                });
                </script>
            <?php endif; ?>

            <?php if(session('danger')): ?>
            <script type="text/javascript">
                    $.notify({
                                    message: "<?php echo session('danger'); ?>"
                                },{
                                    type: "danger",
                                    delay:5000,
                                });
                </script>
            <?php endif; ?>

            <?php if(session('warning')): ?>
                  <script type="text/javascript">
                    $.notify({
                                    message: "<?php echo session('warning'); ?>"
                                },{
                                    type: "warning",
                                    delay:5000,
                                });
                </script>
            <?php endif; ?>

      <?php echo $__env->yieldContent('footer'); ?>

   </body>
</html>
<?php /**PATH /var/www/medecin.tayssir.cloud/resources/views/layouts/master.blade.php ENDPATH**/ ?>