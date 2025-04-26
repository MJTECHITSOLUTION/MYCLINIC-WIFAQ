<?php $__env->startSection('title'); ?>
    Antécédents
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Antécédents</h6>
                </div>
                <div class="card-body">

                    <form method="post" action="<?php echo e(route('anticedents.store')); ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Antécédents name *</label>
                            <input type="text" class="form-control" name="antecedents_name" id="antecedents_name"
                                aria-describedby="antecedents_name" required>
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <button type="submit" class="btn rounded-0  btn-primary "><?php echo e(__('sentence.Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/anticedents/create.blade.php ENDPATH**/ ?>