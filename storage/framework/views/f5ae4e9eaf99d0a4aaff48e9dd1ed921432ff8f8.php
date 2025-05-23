<?php $__env->startSection('title'); ?>
    Rapport consultation par type d'assurance
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport consultation par type d'assurance</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="<?php echo e(route('record.assuranceconsultation')); ?>" method="post">
                        <div class="input-group w-100">
                            <select class="form-control rounded-0 shadow-none" name="assurance" id="assurance" required>
                                <option value="<?php echo e($assuranceRequest); ?>"><?php echo e($assuranceRequest); ?></option>
                                <?php $__currentLoopData = $assurance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assuranc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($assuranc->assurance_name); ?>">
                                        <?php echo e($assuranc->assurance_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label><b>Date début : </b></label>
                            <input type="date" name="start_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date début" value="<?php echo e($startDate); ?>"  aria-label="Date début" aria-describedby="basic-addon2" required>

                            <!-- End Date Input -->
                            <label style="margin-left: 20px;"><b>Date fin :</b></label>
                            <input type="date" name="end_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date fin" value="<?php echo e($endDate); ?>" aria-label="Date fin" aria-describedby="basic-addon2" style="margin-left: 10px;" required>
                            <?php echo csrf_field(); ?>
                            <div class="input-group-append" style="margin-left: 10px;">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="text-right" >
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
                        <th class="text-center sm__screen">Nom assurance</th>
                        <th class="text-center xxs__screen">Date de consultation</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $assurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td class="text-center"><?php echo e($assurance->user_name); ?></td>
                            <td class="text-center"><?php echo e($assurance->assurance); ?></td>
                            <td class="text-center"><?php echo e($assurance->created_at); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    

                    </tbody>
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
                    <img src="<?php echo e(asset('uploads/'.App\Setting::get_option('logo'))); ?>" style="width: 300px; height: 200px;" >
                </div>
            </div>
        </div>
        <br><br>
        <h3>
        <div class="text-center">
            <b>List des consultations par type d'assurance <br> du <?php echo e(\Carbon\Carbon::parse($startDate)->format('d-m-Y')); ?> ou <?php echo e(\Carbon\Carbon::parse($endDate)->format('d-m-Y')); ?> </b>
        </div>
        </h3>
        <br>

        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th class="text-center"><b>Nome et prénom</b></th>
                <th class="text-center sm__screen"><b>Nom assurance</b></th>
                <th class="text-center xxs__screen"><b>Date de consultation</b></th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $assurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center"><?php echo e($assurance->user_name); ?></td>
                    <td class="text-center"><?php echo e($assurance->assurance); ?></td>
                    <td class="text-center"><?php echo e($assurance->created_at); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            

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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/record/assuranceconsultation.blade.php ENDPATH**/ ?>