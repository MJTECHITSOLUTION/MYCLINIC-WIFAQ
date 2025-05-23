<?php $__env->startSection('title'); ?>
    Rapport rendez-vous
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport rendez-vous</h6>
                </div>
                <div class="col-6 text-right">

                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="<?php echo e(route('record.rdv')); ?>" method="post">
                        <div class="input-group w-100 ">
                            <!-- Start Date Input -->
                            <label><b>Date début : </b></label>
                            <input type="date" name="start_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date début"  aria-label="Date début" aria-describedby="basic-addon2"  required>

                            <!-- End Date Input -->
                            <label style="margin-left: 40px;"><b>Date fin :</b></label>
                            <input type="date" name="end_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date fin" value="<?php echo e(date('Y-m-d')); ?>" aria-label="Date fin" aria-describedby="basic-addon2" style="margin-left: 10px;" required>

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
                        <th class="text-center xxs__screen">A visité</th>
                        <th class="text-center sm__screen">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rdvs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center"> <?php echo e($payment->user_name); ?> </td>
                            <td class="text-center xxs__screen">
                                <?php if($payment->visited == 0): ?>
                                    <label class="badge badge-warning-soft">
                                        <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Not Yet Visited')); ?>

                                    </label>
                                <?php elseif($payment->visited == 1): ?>
                                    <label class="badge badge-primary-soft">
                                        <i class="fas fa-check"></i> Terminé
                                    </label>
                                <?php elseif($payment->visited == 3): ?>
                                    <label class="badge badge-success-soft">
                                        <i class="fas fa-check"></i>Salle d'attente
                                    </label>
                                <?php else: ?>
                                    <label class="badge badge-danger-soft">
                                        <i class="fas fa-user-times"></i> <?php echo e(__('sentence.Cancelled')); ?>

                                    </label>
                                <?php endif; ?>

                            </td>
                            <td class="text-center sm__screen"> <label class="badge badge-primary-soft">
                                    <i class="fas fa-calendar"></i> <?php echo e($payment->date->format('d M Y')); ?>

                                </label> </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" align="center"><img src="<?php echo e(asset('img/rest.png')); ?> " /> <br><br> <b
                                    class="text-muted">Aucun rendez-vous trouvé !</b>
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>

                <div id="container"></div>

            </div>
        </div>
    </div>
    <div class="print_div" id="print_div" style="display: none">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <p><strong>Nom:</strong> <?php echo e(App\Setting::get_option('title')); ?></p>
                    <p><strong>Adresse:</strong> <?php echo e(App\Setting::get_option('address')); ?></p>
                    <p><strong>Téléphone:</strong><?php echo e(App\Setting::get_option('phone')); ?> </p>
                    <p><strong>Ville:</strong> <?php echo e(App\Setting::get_option('ville')); ?></p>
                </div>
                <div class="col-md-7 text-right">
                    <img src="<?php echo e(asset('uploads/'.App\Setting::get_option('logo'))); ?>" style="width: 300px; height: 200px;" >
                </div>
            </div>
        </div>
        <br><br>
        <h3>
        <div class="text-center">
            <b>Nouveaux rendez-vous <br> du <?php echo e(\Carbon\Carbon::parse($startDate)->format('d-m-Y')); ?> ou <?php echo e(\Carbon\Carbon::parse($endDate)->format('d-m-Y')); ?> </b>
        </div><br></h3>
        <table  class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
                id="dataTable" width="100%" cellspacing="0">
            <thead class="">
            <tr>
                <th class="text-center"><b>Nome et prénom</b></th>
                <th class="text-center xxs__screen"><b>A visité</b></th>
                <th class="text-center sm__screen"><b>Date</b></th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $rdvs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-center"> <?php echo e($payment->user_name); ?> </td>
                    <td class="text-center xxs__screen">
                        <?php if($payment->visited == 0): ?>
                                <i class="fas fa-hourglass-start"></i> <?php echo e(__('sentence.Not Yet Visited')); ?>

                            </label>
                        <?php elseif($payment->visited == 1): ?>
                                <i class="fas fa-check"></i> Terminé
                            </label>
                        <?php elseif($payment->visited == 3): ?>
                                <i class="fas fa-check"></i>Salle d'attente
                            </label>
                        <?php else: ?>
                            <label class="badge badge-danger-soft">
                                <i class="fas fa-user-times"></i> <?php echo e(__('sentence.Cancelled')); ?>

                            </label>
                        <?php endif; ?>
                    </td>
                    <td class="text-center sm__screen"> <label>
                            <i class="fas fa-calendar"></i> <?php echo e($payment->date->format('d M Y')); ?>

                        </label> </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" align="center"> <br><br> <b
                            class="text-muted">Aucun rendez-vous trouvé !</b>
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


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/record/rdv.blade.php ENDPATH**/ ?>