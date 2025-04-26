<?php $__env->startSection('title'); ?>
    Rapport assurance
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport assurance</h6>
                </div>
                <div class="col-6 text-right">

                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="<?php echo e(route('record.assurance')); ?>" method="post">
                        <div class="input-group w-100 ">
                            <select class="form-control rounded-0 shadow-none" multiple="multiple" name="assurance[]" id="example-multiple-selected" required >
                                <?php $__currentLoopData = $assurance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assuranc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($assuranc->assurance_name); ?>">
                                        <?php echo e($assuranc->assurance_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php echo csrf_field(); ?>
                            <div class="input-group-append">
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
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">Nome et prénom</th>
                        <th class="sm__screen text-center">Date de naissance</th>
                        <th class="text-center sm__screen">Assurance</th>
                        <th class="text-center xxs__screen">Mode paiement</th>
                        <th class="text-center sm__screen">Statu</th>
                        <th class="text-center sm__screen">Paie</th>
                        <th class="text-center sm__screen">Total</th>                        
                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $assurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $birthday = new DateTime($assurance->birthday);
                            $currentDate = new DateTime();
                            $age = $currentDate->diff($birthday)->y;
                        ?>
                        <tr>
            
                            <td class="text-center"><?php echo e($assurance->name); ?></td>
                            <td class="text-center"><?php echo e($assurance->birthday); ?> (<?php echo e($age); ?> ans) </td>
                            <td class="text-center"> <?php echo e($assurance->assurance); ?> </td>
                            <td class="text-center"><?php echo e($assurance->payment_mode); ?></td>
                            <td class="text-center">
                                <?php if($assurance->payment_status == 'Paid'): ?>
                        Payé
                        <?php endif; ?>
                        <?php if($assurance->payment_status == 'Unpaid'): ?>
                        Non payé
                        <?php endif; ?>
                        <?php if($assurance->payment_status == 'Partially Paid'): ?>
                        Partiellement payé
                        <?php endif; ?></td>
                            <?php
                            $billingId = $assurance->billingid; 
                            $sumPayment = DB::table('billing_reglement')
                                ->select(DB::raw('SUM(payment) as total_payment'))
                                ->where('billing_id', $billingId)
                                ->groupBy('billing_id')
                                ->first();

                            $totalPaymentValue = optional($sumPayment)->total_payment ?? 0;
                        ?>
                            <td class="text-center"><?php echo e($totalPaymentValue); ?></td>

                            <td class="text-center"><?php echo e($assurance->total_without_tax); ?></td>
                            
                        </tr>
                    </tbody>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>

                <div id="container"></div>

            </div>
        </div>
    </div>
    <div style="display: none" id="print_div">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <p><strong>Nom:</strong> <?php echo e(App\Setting::get_option('title')); ?></p>
                    <p><strong>Adresse:</strong> <?php echo e(App\Setting::get_option('address')); ?></p>
                    <p><strong>Téléphone:</strong><?php echo e(App\Setting::get_option('phone')); ?> </p>
                    <p><strong>Ville:</strong> <?php echo e(App\Setting::get_option('ville')); ?></p>
                </div>
                <div class="col-md-7 text-right">

                </div>
            </div>
        </div>
        <br><br>
        <h3>
        <div class="text-center" >
            <b>List des assurances du
                <?php $__currentLoopData = $assuranceRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assuranceRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e(htmlspecialchars($assuranceRequest)); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </b>
        </div>
        </h3><br>
        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th class="text-center">Nome et prénom</th>
                <th class="sm__screen text-center">Date de naissance</th>
                <th class="text-center sm__screen">Assurance</th>
                <th class="text-center xxs__screen">Mode paiement</th>
                <th class="text-center sm__screen">Statu</th>
                <th class="text-center sm__screen">Paie</th>
                <th class="text-center sm__screen">Total</th>                        
            </tr>
            </thead>
            <tbody>

            <?php $__currentLoopData = $assurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $birthday = new DateTime($assurance->birthday);
                    $currentDate = new DateTime();
                    $age = $currentDate->diff($birthday)->y;
                ?>
                <tr>
    
                    <td class="text-center"><?php echo e($assurance->name); ?></td>
                    <td class="text-center"><?php echo e($assurance->birthday); ?> (<?php echo e($age); ?> ans) </td>
                    <td class="text-center"> <?php echo e($assurance->assurance); ?> </td>
                    <td class="text-center"><?php echo e($assurance->payment_mode); ?></td>
                    <td class="text-center">
                        <?php if($assurance->payment_status == 'Paid'): ?>
                        Payé
                        <?php endif; ?>
                        <?php if($assurance->payment_status == 'Unpaid'): ?>
                        Non payé
                        <?php endif; ?>
                        <?php if($assurance->payment_status == 'Partially Paid'): ?>
                        Partiellement payé
                        <?php endif; ?>
            </td>
                    <?php
                    $billingId = $assurance->billingid; 
                    $sumPayment = DB::table('billing_reglement')
                        ->select(DB::raw('SUM(payment) as total_payment'))
                        ->where('billing_id', $billingId)
                        ->groupBy('billing_id')
                        ->first();

                    $totalPaymentValue = optional($sumPayment)->total_payment ?? 0;
                ?>
                    <td class="text-center"><?php echo e($totalPaymentValue); ?></td>

                    <td class="text-center"><?php echo e($assurance->total_without_tax); ?></td>
                    
                </tr>
            </tbody>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <script type="text/javascript"
            src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#example-multiple-selected').multiselect();
    </script>
<?php $__env->stopSection(); ?>
<link rel="stylesheet" type="text/css"
      href="https://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/record/assurance.blade.php ENDPATH**/ ?>