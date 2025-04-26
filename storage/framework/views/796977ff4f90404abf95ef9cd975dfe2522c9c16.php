

<?php $__env->startSection('title'); ?>
    Le fournisseur N°<?php echo e($fournisseur->id); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2"> Le fournisseur N°<?php echo e($fournisseur->id); ?>

                    </h6>
                </div>

                <div class="col-6">

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                        <a href="<?php echo e(route('fournisseur.create')); ?>"
                            class="btn btn-primary rounded-0 shadow-none btn-sm float-right"><i class="fa fa-plus"></i>
                            Ajouter un fournisseur</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>


        <div class="card-body">
            <div class=" w-75 m-auto shadow-sm">


                <div class="d-flex justify-content-center flex-column ">

                    <h4 class="text-center mb-4"><?php echo e($fournisseur->name); ?></h4>


                    <div class="w-100 d-flex  justify-content-start px-5">
                        <div class="col-6 d-flex  justify-content-center  ">
                            <div>

                                <p class="text-left">Email : <?php echo e($fournisseur->email); ?></p>
                                <p class="text-left">Téléphone : <?php echo e($fournisseur->phone); ?></p>
                                <p class="text-left">Mobile : <?php echo e($fournisseur->mobile); ?></p>

                            </div>

                        </div>
                        <div class="col-6 d-flex  justify-content-center  ">
                            <div>
                                <p class="text-left">Addresse : <?php echo e($fournisseur->Adresse); ?> </p>
                                <p class="text-left">Ville : <?php echo e($fournisseur->Ville); ?> </p>
                                <p class="text-left">Pay : <?php echo e($fournisseur->Pays); ?></p>


                            </div>
                        </div>

                    </div>


                    <div class="action">
                        <div class="row px-5 my-4">
                            <div class="col-12 d-flex justify-content-end">
                                <a href="<?php echo e(route('fournisseur.edit', $fournisseur->id)); ?>"
                                    class="btn btn-primary rounded-0 shadow-none btn-sm"><i class="fa fa-edit"></i>
                                    Modifier</a>
                                <a href="#" class="btn btn-danger ml-2 rounded-0 shadow-none btn-sm"
                                    data-toggle="modal" data-target="#DeleteModal"
                                    data-link="<?php echo e(route('fournisseur.destroy', ['id' => $fournisseur->id])); ?>"><i
                                        class="fas fa-trash"></i>
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/fournisseur/view.blade.php ENDPATH**/ ?>