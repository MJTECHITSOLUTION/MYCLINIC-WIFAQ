

<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Add analyse')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajoute analyse</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('analyse.create')); ?>">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nom d'analyse<font color="red">*
                                </font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="analyse_name" required>
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <input type="hidden"
                                    class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-doctorino"
                                    name="test_id" id="test_id" tabindex="-1" aria-hidden="true" value="14">
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit"
                                    class="btn rounded-0  btn-primary "><?php echo e(__('sentence.Save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/analyse/create.blade.php ENDPATH**/ ?>