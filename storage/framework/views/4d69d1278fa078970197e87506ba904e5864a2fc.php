<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.View Prescription')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(!empty($prescription)): ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="<?php echo e(url('prescription/edit/'.$prescription->id)); ?>" value="Modifier" class="btn btn-success" style="position: relative; left: 1350px; margin-bottom: 20px;" align="center">Modifier</a>
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                   <h5> <strong><u>Ordonnance </u></strong></h5>

                    <button href="" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm print_prescription" style="margin-left: 1150px; margin-top: -90px;"><i class="fas fa-print fa-sm text-white-50"></i> Imprimer</button>
                    <!-- ROW: Doctor informations -->
                    <div class="row">
                        <div class="col">



                            <p><?php echo clean(App\Setting::get_option('header_left')); ?></p>
                        </div>
                        <div class="col-md-3">
                            <p><b><?php echo e(__('sentence.Date')); ?> :</b> <?php echo e($prescription->created_at->format('d-m-Y')); ?></p>
                            <p><b><?php echo e(__('sentence.Reference')); ?> :</b> <?php echo e($prescription->reference); ?></p>
                        </div>
                    </div>
                    <!-- END ROW: Doctor informations -->
                    <!-- ROW: Patient informations -->
                    <div class="row">
                        <div class="col">
                            <p>
                                <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($prescription->User->name); ?>

                            </p>
                            <hr>
                        </div>
                    </div>
                    <!-- END ROW: Patient informations -->
                    <?php if(count($prescription_drugs) > 0): ?>
                        <!-- ROW: Drugs List -->
                        <div class="row justify-content-center">
                            <div class="col">
                                <strong><u><?php echo e(__('sentence.medicament')); ?> </u></strong><br><br>
                                <?php $__currentLoopData = $prescription_drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($drug->Drug->trade_name); ?> <?php echo e($drug->strength); ?><br>
                                        <?php echo e($drug->drug_advice); ?></li>
                                    <?php if($loop->last): ?>
                                        <div style="margin-bottom: 40px;"></div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>




















                            </div>

                        </div>

                        

                        <!-- END ROW: Tests List -->

                    <?php if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right'))): ?>
                        <!-- ROW: Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                            </div>
                            <div class="col">
                                <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                            </div>
                        </div>
                        <!-- END ROW: Footer informations -->
                    <?php elseif(empty(App\Setting::get_option('footer_left'))): ?>
                        <!-- ROW: Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                            </div>
                        </div>
                        <!-- END ROW: Footer informations -->
                    <?php elseif(empty(App\Setting::get_option('footer_right'))): ?>
                        <!-- ROW: Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                            </div>
                        </div>
                        <!-- END ROW: Footer informations -->
                    <?php else: ?>
                    <?php endif; ?>
                </div>
        </div>
    <?php endif; ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>
    <div id="print_analysee">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h5><strong> <u>Analyses médicales </u></strong></h5>
                        <button href="" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm print_analyse" style="margin-left: 1150px; margin-top: -90px;"><i class="fas fa-print fa-sm text-white-50"></i> Imprimer</button>

                        <!-- ROW: Doctor informations -->
                        <div class="row">
                            <div class="col">



                                <p><?php echo clean(App\Setting::get_option('header_left')); ?></p>
                            </div>
                            <div class="col-md-3">
                                <p><b><?php echo e(__('sentence.Date')); ?> :</b> <?php echo e($prescription->created_at->format('d-m-Y')); ?></p>
                                <p><b><?php echo e(__('sentence.Reference')); ?> :</b> <?php echo e($prescription->reference); ?></p>
                            </div>
                        </div>
                        <!-- END ROW: Doctor informations -->
                        <!-- ROW: Patient informations -->
                        <div class="row">
                            <div class="col">
                                <hr>
                                <p>
                                    <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($prescription->User->name); ?>

                                </p>
                                <hr>
                            </div>
                        </div>

                        <?php if(count($prescription_tests) > 0): ?>
                            <!-- ROW: Tests List -->
                            <div class="row justify-content-center">
                                <div class="col" >
                                    <strong><u><?php echo e(__('sentence.Test to do')); ?> </u></strong><br><br>
                                    <?php $__currentLoopData = $prescription_tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php if(empty(!$test->analyse_name)): ?> <?php echo e($test->analyse_name); ?> <?php endif; ?></li>
                                        <?php if(empty(!$test->description)): ?>  <p> <?php echo e($test->description); ?> </p> <?php endif; ?>
                                        <br>
                                        <?php if($loop->last): ?>
                                            <br>
                                            <br>
                                            <div style="margin-bottom: 40px;">
                                                
                                                
                                                
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            </div>

                            

                            <!-- END ROW: Tests List -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>
    <div id="print_radioo">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <button href="" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm print_radio" style="margin-left: 1150px; margin-top: -90px;"><i class="fas fa-print fa-sm text-white-50"></i> Imprimer</button>

                        <!-- ROW: Doctor informations -->
                        <div class="row">
                            <div class="col">



                                <p><?php echo clean(App\Setting::get_option('header_left')); ?></p>
                            </div>
                            <div class="col-md-3">
                                <p><b><?php echo e(__('sentence.Date')); ?> :</b> <?php echo e($prescription->created_at->format('d-m-Y')); ?></p>
                                <p><b><?php echo e(__('sentence.Reference')); ?> :</b> <?php echo e($prescription->reference); ?></p>
                            </div>
                        </div>
                        <!-- END ROW: Doctor informations -->
                        <!-- ROW: Patient informations -->
                        <div class="row">
                            <div class="col">
                                <hr>
                                <p>
                                    <b><?php echo e(__('sentence.Patient Name')); ?> :</b> <?php echo e($prescription->User->name); ?>

                                </p>
                                <hr>
                            </div>
                        </div>

                        <?php if(count($prescription_radios) > 0): ?>
                            <!-- ROW: Tests List -->
                            <div class="row justify-content-center">
                                <div class="col" >
                                    <strong><u>Faire SVP </u></strong><br><br>
                                    <?php $__currentLoopData = $prescription_radios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $radio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php if(empty(!$radio->radio)): ?> <?php echo e($radio->radio); ?> <?php endif; ?></li>
                                        <?php if(empty(!$radio->justif)): ?>  <p> <?php echo nl2br(e( $radio->justif )); ?> </p> <?php endif; ?>
                                        <br>
                                        <?php if($loop->last): ?>
                                            <br>
                                            <br>
                                            <div style="margin-bottom: 40px;">
                                                
                                                
                                                
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            </div>

                            

                            <!-- END ROW: Tests List -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(empty(!$prescription->certificat)): ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <button href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print_certi"><i class="fas fa-print fa-sm text-white-50"></i> Imprimer</button>
    </div>
    <div id="print_certii">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <!-- ROW: Doctor informations -->
                    <div class="row">
                        <div class="col text-center"><br><br>
                            <h2 class="mt-400">CERTIFICAT MEDICAL</h2>
                        </div>
                    </div><br><br><br><br>
                    <div class="row mt-400">
                        <div class="col">
                            <p class="text-left">Je soussigne Docteur  <strong><?php echo e(App\Setting::get_option('title')); ?> </strong></p> <br>
                            <p class="text-left">Avoir examiné ce jour le(a) patient(e)  : <strong> <?php echo e($prescription->User->name); ?></strong> </p> <br>
                            <p class="text-left">Et que son état de santé nécessite un repos de <strong><?php echo e($prescription->certificat); ?> </strong>jour(s).</p> <br>
                            <p class="text-left">A partir du :  <strong><?php echo e($prescription->dated); ?> </strong> où <strong> <?php echo e($prescription->datef); ?> </strong>  sauf complication(s) </p> <br><br><br>
                            <p class="text-right" style="margin-right: 200px">Fait à <strong>Temara</strong> Le <?php echo e($prescription->created_at->format('d-m-Y')); ?> </p> <br><br>
                            <p class="text-right" style="margin-right: 100px"> Signature et cachet: </p><br><br><br><br><br><br>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
    </div>
    </div>
    <?php endif; ?>

    <div id="print_radio" style="display: none;">
        <!-- ROW: Doctor informations -->
        <div class="row">
            <div class="col-9">
                <?php if(!empty(App\Setting::get_option('logo'))): ?>
                    
                <?php endif; ?>
                <p><?php echo clean(App\Setting::get_option('header_left')); ?></p>
            </div>

        </div>
        <!-- END ROW: Doctor informations -->
        <!-- ROW: Patient informations -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br><br><br>
        <br>
        <br>

        <div class="row">
            <div class="col" style="font-size: xx-large; margin-left: 25px; margin-right: 25px;">
                <p>
                    <b style="float: right;">Skhirat ,<?php echo e(__('sentence.On')); ?> : <?php echo e($prescription->created_at->format('d-m-Y')); ?></b>
                </p>
                <br>
                <b style="float: left;"> <?php echo e($prescription->User->name); ?> </b>
            </div>
        </div> <br>
        <!-- END ROW: Patient informations -->
        <?php if(count($prescription_radios) > 0): ?>
            <!-- ROW: Tests List -->
            <div class="row justify-content-center" style="font-size: xx-large">
                <div class="col" >

                    <?php $__currentLoopData = $prescription_radios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $radio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li style="margin-left: 100px;"><?php if(empty(!$radio->radio)): ?> <?php echo e($radio->radio); ?></li>
                          <strong> <p style="margin-left: 200px;"><?php echo nl2br(e( $radio->justif )); ?> </p></strong>

                            <?php endif; ?>
                        <br>
                        <?php if($loop->last): ?>
                            <br>
                            <div style="margin-bottom: 40px;">
                                
                                
                                
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>

            

            <!-- END ROW: Tests List -->
        <?php endif; ?>


                    <?php if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right'))): ?>
                        <!-- ROW: Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                            </div>
                            <div class="col">
                                <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                            </div>
                        </div>
                        <!-- END ROW: Footer informations -->
                    <?php elseif(empty(App\Setting::get_option('footer_left'))): ?>
                        <!-- ROW: Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                            </div>
                        </div>
                        <!-- END ROW: Footer informations -->
                    <?php elseif(empty(App\Setting::get_option('footer_right'))): ?>
                        <!-- ROW: Footer informations -->
                        <div class="row">
                            <div class="col">
                                <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                            </div>
                        </div>
                        <!-- END ROW: Footer informations -->
                    <?php else: ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    </div>
    </div>
    <!-- Hidden prescription -->
    <div id="print_area" style="display: none;">
        <!-- ROW: Doctor informations -->
        <div class="row">
            <div class="col-9">
                <?php if(!empty(App\Setting::get_option('logo'))): ?>
                    
                <?php endif; ?>
                <p><?php echo clean(App\Setting::get_option('header_left')); ?></p>
            </div>

        </div>
        <!-- END ROW: Doctor informations -->
        <!-- ROW: Patient informations -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br><br><br>
        <br>
        <br>

        <div class="row">
            <div class="col" style="font-size: xx-large; margin-left: 25px; margin-right: 25px;">
                <p>
                    <b style="float: right;">Skhirat ,<?php echo e(__('sentence.On')); ?> : <?php echo e($prescription->created_at->format('d-m-Y')); ?></b>
                </p>
                <br>
                <b style="float: left;"> <?php echo e($prescription->User->name); ?> </b>
            </div>
        </div>
        <!-- END ROW: Patient informations -->
        <?php if(count($prescription_drugs) > 0): ?>
            <!-- ROW: Drugs List -->
        <br>
        <br>
            <div class="row" style="font-size: xx-large ; margin-left: 25px; margin-right: 25px;">
                <div class="col">
                    <?php $__currentLoopData = $prescription_drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($drug->Drug->trade_name); ?> <?php echo e($drug->strength); ?><br>
                            <?php if(isset($drug->drug_advice)): ?> <strong><p  style="font-size: xx-large; margin-left: 120px; margin-right: 25px;"> <?php echo e($drug->drug_advice); ?></p></strong></li> <?php endif; ?>
                        <?php if($loop->last): ?>
                            <div style="margin-bottom: 30px;"></div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>



























        <!-- ROW: Footer informations -->
        <footer style="position: absolute; bottom: 0;">
            <?php if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right'))): ?>
                <!-- ROW: Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                    </div>
                    <div class="col">
                        <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                    </div>
                </div>
                <!-- END ROW: Footer informations -->
            <?php elseif(empty(App\Setting::get_option('footer_left'))): ?>
                <!-- ROW: Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                    </div>
                </div>
                <!-- END ROW: Footer informations -->
            <?php elseif(empty(App\Setting::get_option('footer_right'))): ?>
                <!-- ROW: Footer informations -->
                <div class="row">
                    <div class="col">
                        <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                    </div>
                </div>
                <!-- END ROW: Footer informations -->
            <?php else: ?>
            <?php endif; ?>
        </footer>
        <!-- END ROW: Footer informations -->
    </div>

     <div>
         <!-- Hidden prescription -->
         <div id="print_analyse" style="display: none;">
             <!-- ROW: Doctor informations -->
             <div class="row">
                 <div class="col-9">
                     <?php if(!empty(App\Setting::get_option('logo'))): ?>

                     <?php endif; ?>
                     <p><?php echo clean(App\Setting::get_option('header_left')); ?></p>
                 </div>

             </div>
             <!-- END ROW: Doctor informations -->
             <!-- ROW: Patient informations -->
             <br>
             <br>
             <br>
             <br>
             <br>
             <br>
             <br><br><br>
             <br>
             <br>
             <div class="row">
                 <div class="col" style="font-size: xx-large; margin-left: 25px; margin-right: 25px;">
                     <p>
                         <b style="float: left;"></b> <strong><?php echo e($prescription->User->name); ?></strong>
                         <b style="float: right;">Skhirat ,<?php echo e(__('sentence.On')); ?> :<?php echo e($prescription->created_at->format('d-m-Y')); ?></b>
                     </p>
                 </div>
             </div>
             <!-- END ROW: Patient informations -->
















             <br>
             <br>
             <?php if(count($prescription_tests) > 0): ?>
                         <!-- ROW: Tests List -->
                         <div class="row justify-content-center">
                             <div class="col">
                                 <strong><u style="font-size: xx-large; margin-left: 25px; margin-right: 25px;"><?php echo e(__('sentence.Test to do')); ?></u></strong><br><br>
                                 <?php $__currentLoopData = $prescription_tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <li style="font-size: xx-large; margin-left: 50px;"><?php if(empty(!$test->analyse_name)): ?><?php echo e($test->analyse_name); ?> <?php endif; ?></li>
                                     <?php if(empty(!$test->description)): ?>
                                         <p style="font-size: xx-large; margin-left: 180px; margin-right: 25px;">
                                             <?php echo e($test->description); ?>

                                         </p>
                                     <?php endif; ?>
                                     <br>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </div>
                         </div>
                         <!-- END ROW: Tests List -->
                     <?php endif; ?>
             <!-- ROW: Footer informations -->
             <footer style="position: absolute; bottom: 0;">
                 <?php if(!empty(App\Setting::get_option('footer_left')) && !empty(App\Setting::get_option('footer_right'))): ?>
                     <!-- ROW: Footer informations -->
                     <div class="row">
                         <div class="col">
                             <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                         </div>
                         <div class="col">
                             <p class="float-right font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                         </div>
                     </div>
                     <!-- END ROW: Footer informations -->
                 <?php elseif(empty(App\Setting::get_option('footer_left'))): ?>
                     <!-- ROW: Footer informations -->
                     <div class="row">
                         <div class="col">
                             <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_right')); ?></p>
                         </div>
                     </div>
                     <!-- END ROW: Footer informations -->
                 <?php elseif(empty(App\Setting::get_option('footer_right'))): ?>
                     <!-- ROW: Footer informations -->
                     <div class="row">
                         <div class="col">
                             <p class="font-size-12"><?php echo clean(App\Setting::get_option('footer_left')); ?></p>
                         </div>
                     </div>
                     <!-- END ROW: Footer informations -->
                 <?php else: ?>
                 <?php endif; ?>
             </footer>
             <!-- END ROW: Footer informations -->
         </div>
     </div>
                        <div id="print_certi" style="display: none;">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                        <div class="card-body">
                                            <!-- ROW: Doctor informations -->
                                            <div class="row">
                                                <div class="col text-center"><br><br><br><br><br><br>
                                                    <br><br><br><br><br><br>
                                                    <h2 class="mt-400">CERTIFICAT MEDICAL</h2>
                                                </div>
                                            </div><br><br><br><br><br><br><br><br>
                                            <div class="row mt-100" style="font-size: x-large">
                                                <div class="col">
                                                    <p class="text-left">Je soussigne Docteur  <strong><?php echo e(App\Setting::get_option('title')); ?> </strong></p> <br>
                                                    <p class="text-left">Avoir examiné ce jour le(a) patient(e)  : <strong> <?php echo e($prescription->User->name); ?></strong> </p> <br>
                                                    <p class="text-left">Et que son état de santé nécessite un repos de <strong><?php echo e($prescription->certificat); ?> </strong>jour(s).</p> <br>
                                                    <p class="text-left">A partir du :  <strong><?php echo e($prescription->dated); ?> </strong> où <strong> <?php echo e($prescription->datef); ?> </strong>  sauf complication(s) </p> <br><br><br>
                                                    <p class="text-right" style="margin-right: 200px">Fait à <strong>Skhirat</strong> Le <?php echo e($prescription->created_at->format('d-m-Y')); ?> </p> <br><br>
                                                    <p class="text-right" style="margin-right: 60px"> Signature et cachet: </p><br><br><br><br><br><br>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <style type="text/css">
        p, u, li {
            color: #444444 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
        $(function(){
            $(document).on('click','.print_analyse',function (){
                printDiv('print_analyse');
            })
        })
        $(function(){
            $(document).on("click", '.print_prescription',function () {
                printDiv('print_area');
            });
        $(function(){
            $(document).on("click",'.print_certi',function (){
                printDiv('print_certi')
            })
        })
            $(function(){
                $(document).on("click",'.print_radio',function (){
                    printDiv('print_radio')
                })
            })
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/medecin.tayssir.cloud/resources/views/prescription/view.blade.php ENDPATH**/ ?>