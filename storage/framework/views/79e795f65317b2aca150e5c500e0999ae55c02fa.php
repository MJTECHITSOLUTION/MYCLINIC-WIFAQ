<?php $__env->startSection('title'); ?>
    Rapport paiement
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport paiement</h6>
                </div>
               <div class="col-6 text-right">
                   Total : <?php echo e($total_payments_range); ?> <?php echo e(App\Setting::get_option('currency')); ?>

                   <br>
                   Rest à payer : <?php echo e($total_payments_range - $restapaye); ?> <?php echo e(App\Setting::get_option('currency')); ?>

               </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="<?php echo e(route('record.paiement')); ?>" method="post">
                        <div class="input-group w-100 ">
                            <!-- Start Date Input -->
                            <label><b>Date début : </b></label>
                            <input type="date" name="start_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date début" value="<?php echo e($startDate); ?>" aria-label="Date début"
                                   aria-describedby="basic-addon2" required>

                            <!-- End Date Input -->
                            <label style="margin-left: 40px;"><b>Date fin :</b></label>
                            <input type="date" name="end_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date fin" value="<?php echo e($endDate); ?>" aria-label="Date fin"
                                   aria-describedby="basic-addon2" style="margin-left: 10px;" required>

                            <?php echo csrf_field(); ?>
                            <div class="input-group-append" style="margin-left: 10px;">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="text-right">
                        <button href="" class="d-sm-inline-block btn btn-sm btn-info shadow-sm print">
                            <i class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-md-inline-block">Imprimer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table  class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
                       id="dataTable" width="100%" cellspacing="0">
                    <thead class="">
                    <tr>
                        <th class="text-center">Nome et prénom</th>
                        <th class="text-center sm__screen">Mode de paiement</th>
                        <th class="text-center xxs__screen">Statut de paiement</th>
                        <th class="text-center sm__screen">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center"> <?php echo e($payment->user_name); ?> </td>
                            <td class="text-center sm__screen">
                                <?php echo e($payment->payment_mode); ?> </td>
                            <td class="text-center xxs__screen">
                                <?php if($payment->payment_status === 'Paid'): ?>
                                    Payé
                                <?php elseif($payment->payment_status === 'Partially Paid'): ?>
                                    Partiellement payé
                                <?php else: ?>
                                    non payé
                                <?php endif; ?>

                                 </td>
                            <td class="text-center sm__screen"> <?php echo e($payment->total_without_tax); ?> </td>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" align="center"> <br><br> <b
                                    class="text-muted">Aucun paiement trouvé !</b>
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>

                <div id="container"></div>
                

            </div>
        </div>
    </div>
    <div id="print_div" style="display: none">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <p><strong>Nom:</strong> <?php echo e(App\Setting::get_option('title')); ?></p>
                    <p><strong>Adresse:</strong> <?php echo e(App\Setting::get_option('address')); ?></p>
                    <p> <strong>Téléphone:</strong><?php echo e(App\Setting::get_option('phone')); ?> </p>
                    <p><strong>Ville:</strong> <?php echo e(App\Setting::get_option('ville')); ?></p>
                </div>



            </div>
        </div>
        <br><br>
        <h3>
        <div class="text-center">
        <b> List des paiements <br> du <?php echo e(\Carbon\Carbon::parse($startDate)->format('d-m-Y')); ?> ou <?php echo e(\Carbon\Carbon::parse($endDate)->format('d-m-Y')); ?></b>
        </div>
        </h3>
            <br>
        <div class="col-12 text-right">
           Total payé : <?php echo e($total_payments_range); ?> <?php echo e(App\Setting::get_option('currency')); ?>

           <br>
           Rest à payer : <?php echo e($total_payments_range - $restapaye); ?> <?php echo e(App\Setting::get_option('currency')); ?>  
            
            </div>
        <table  class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
                id="dataTable" width="100%" cellspacing="0">
            <thead class="">
            <tr>
                <th class="text-center"><b>Nome et prénom</b></th>
                <th class="text-center sm__screen"><b>Mode de paiement</b></th>
                <th class="text-center xxs__screen"><b>Statut de paiement</b></th>
                <th class="text-center sm__screen"><b>Total</b></th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-center"> <?php echo e($payment->user_name); ?> </td>
                    <td class="text-center sm__screen text-center">
                        <?php echo e($payment->payment_mode); ?> </td>
                    <td class="text-center xxs__screen">
                        <?php if($payment->payment_status === 'Paid'): ?>
                            Payé
                        <?php elseif($payment->payment_status === 'Partially Paid'): ?>
                            Partiellement payé
                        <?php else: ?>
                            non payé
                        <?php endif; ?>

                    </td>
                    <td class="text-center sm__screen"> <?php echo e($payment->total_without_tax); ?> </td>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" align="center"> <br><br> <b
                            class="text-muted">Aucun paiement trouvé !</b>
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script type="text/javascript">
        function PrintPreview(divName) {

            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }


        $(function(){
            $(document).on("click", '.print',function () {
                PrintPreview('print_div');
                /*
                $('#print_area').printThis({
                 importCSS: true,
                        importStyle: true,//thrown in for extra measure
                 loadCSS: "<?php echo e(asset('dashboard/css/sb-admin-2.min.css')); ?>",
         pageTitle: "xxx",
         copyTagClasses: true,
          base: true,
          printContainer: true,
          removeInline: false,
        });
        */

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/record/payment.blade.php ENDPATH**/ ?>