

<?php $__env->startSection('title'); ?>
    Ajouter une TVA
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Ajouter une TVA</h6>
                        </div>

                        <div class="col-6">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                                <a href="<?php echo e(route('tva.all')); ?>" class="btn btn-primary btn-sm float-right"><i
                                        class="fa fa-plus"></i>
                                    Tous une TVA</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form method="post" action="<?php echo e(route('tva.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="my__label">Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="name" id="name">
                        </div>



                        <div class="form-group">
                            <label for="exampleInputEmail1" class="my__label">value <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="value" id="value">

                        </div>


                        <div class="col-md-12 d-flex justify-content-end">

                            <button type="submit" class="btn btn-primary rounded-0 "><?php echo e(__('sentence.Save')); ?></button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/tva/create.blade.php ENDPATH**/ ?>