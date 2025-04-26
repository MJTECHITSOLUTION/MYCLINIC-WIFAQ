

<?php $__env->startSection('title'); ?>
    Tous les fournisseurs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les fournisseurs</h6>
                </div>
                <div class="col-6 ">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add patient')): ?>
                        <a href="<?php echo e(route('fournisseur.create')); ?>" class="btn btn-primary btn-sm float-right "><i
                                class="fa fa-plus"></i> Ajouter</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form class="form-inline" action="<?php echo e(route('fournisseur.search')); ?>" method="post">
                        <div class="input-group w-100">
                            <input type="text" name="term" class="form-control bg-light border  small"
                                placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
                            <?php echo csrf_field(); ?>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
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
                <table class="table table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}" id="dataTable"
                    width="100%" cellspacing="0">
                    <thead class="">
                        <tr>
                            <th class="sm__screen">ID</th>
                            <th><?php echo e(__('sentence.Patient Name')); ?></th>
                            <th class="text-center sm__screen">Téléphone</th>
                            <th class="text-center sm__screen">Ville</th>
                            <th>
                                <center>Actions</center>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $fournisseurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fournisseur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td> <?php echo e($fournisseur->id); ?></td>
                                <td>
                                    <?php echo e($fournisseur->name); ?> </td>
                                <td class="text-center xxs__screen"><?php echo e($fournisseur->phone); ?></td>
                                <td class="text-center xxs__screen"><?php echo e($fournisseur->Ville); ?></td>

                                <td class="text-center">

                                    <a href="<?php echo e(route('fournisseur.view', ['id' => $fournisseur->id])); ?>"
                                        class="btn btn-outline-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit patient')): ?>
                                        <a href="<?php echo e(route('fournisseur.edit', ['id' => $fournisseur->id])); ?>"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete patient')): ?>
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="<?php echo e(route('fournisseur.destroy', ['id' => $fournisseur->id])); ?>"><i
                                                class="fas fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center"><br><br> Aucun article trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="d-flex">
                    <?php echo $fournisseurs->links(); ?>

                </div>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/fournisseur/all.blade.php ENDPATH**/ ?>