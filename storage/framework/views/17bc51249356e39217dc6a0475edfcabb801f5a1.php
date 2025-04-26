

<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Add assurance')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Add assurance')); ?></h6>
                </div>
                <div class="card-body">

                    <form method="post" action="<?php echo e(route('assurance.store')); ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo e(__('sentence.assurance name')); ?> *</label>
                            <input type="text" class="form-control" name="assurance_name" id="assuranceName"
                                aria-describedby="assuranceName" required>
                            <?php echo e(csrf_field()); ?>

                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        <button type="submit" class="btn rounded-0  btn-primary "><?php echo e(__('sentence.Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/assurance/create.blade.php ENDPATH**/ ?>