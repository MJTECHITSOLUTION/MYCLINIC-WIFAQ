
<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Patients')); ?></h6>
                </div>

                <div class="col-6">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
                        <a href="<?php echo e(route('patient.create')); ?>" class="btn rounded-0  btn-primary btn-sm float-right "><i
                                class="fa fa-plus"></i> <?php echo e(__('sentence.New Patient')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="<?php echo e(route('patient.search')); ?>" method="post">
                        <div class="input-group w-100 border">
                            <input type="text" name="term" class="form-control rounded-0 bg-light border-0 small"
                                placeholder="Rechercher par (CIN,Téléphone,Nom,Prénom)" aria-label="Search" aria-describedby="basic-addon2">
                            <?php echo csrf_field(); ?>
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
                            <th><?php echo e(__('sentence.Patient Name')); ?></th>
                            <th class="text-center"><?php echo e(__('sentence.Age')); ?></th>
                            <th class="text-center"><?php echo e(__('sentence.Phone')); ?></th>
                            <th class="text-center"><?php echo e(__('sentence.Date')); ?> de création</th>
                            <th class="text-center">Médecin</th>
                            <th class="text-center">Afficher</th>
                            <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><a href="<?php echo e(url('patient/view/' . $patient->user_id)); ?>"> <?php echo e($patient->name); ?> </a></td>
                                <td class="text-center"> <?php echo e(@\Carbon\Carbon::parse($patient->Patient->birthday)->age); ?>

                                </td>
                                <td class="text-center"> <?php echo e(@$patient->Patient->phone); ?> </td>
                                <td class="text-center"><label
                                        class="badge badge-primary-soft"><?php echo e($patient->created_at->format('d-m-Y')); ?></label>
                                </td>
                                <td class="text-center">
                                    <?php $doctor = App\User::find($patient->dr_id); ?>
                                    <?php if($doctor): ?>
                                        <label class="badge badge-primary-soft">
                                            <i class="fas fa-user-md mr-1"></i> <?php echo e($doctor->name); ?>

                                        </label>
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view patient')): ?>
                                        <a href="<?php echo e(route('prescription.view_for_user', ['id' => $patient->user_id])); ?>"
                                            class="btn rounded-0  btn-outline-primary btn-sm"></i>
                                            Consultation</a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view patient')): ?>
                                        <a href="<?php echo e(route('billing.showall', ['id' => $patient->user_id])); ?>"
                                            class="btn rounded-0  btn-outline-primary btn-sm"></i>
                                            Paiment</a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view patient')): ?>
                                        <a href="<?php echo e(route('patient.view', ['id' => $patient->user_id])); ?>"
                                            class="btn   btn-outline-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                        <a href="<?php echo e(route('patient.edit', ['id' => $patient->user_id])); ?>"
                                            class="btn   btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete patient')): ?>
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="<?php echo e(route('patient.destroy', ['id' => $patient->user_id])); ?>"><i
                                                class="fas fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" align="center"><img src="<?php echo e(asset('img/rest.png')); ?> " /> <br><br> <b
                                        class="text-muted">No patients found!</b>
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>

                <div id="container"></div>
                <span class="float-right mt-3"><?php echo e($patients->links()); ?></span>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\MAMP\htdocs\p.wifaq.myclinic.ma\resources\views/patient/specialty/dentiste/all.blade.php ENDPATH**/ ?>