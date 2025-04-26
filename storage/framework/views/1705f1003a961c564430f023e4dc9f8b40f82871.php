<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.Edit assurance')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modifier Antécédents
                        </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('anticedents.store_edit')); ?>">
                        <div class="form-group">
                            <label for="assurance_name">Nom de antécédents *</label>
                            <input type="hidden" name="id" value="<?php echo e($antecedents->id); ?>">
                            <input type="text" class="form-control" name="antecedents_name" id="antecedents_name"
                                aria-describedby="TradeName" value="<?php echo e($antecedents->antecedents_name); ?>">
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <button type="submit" class="btn rounded-0  btn-primary "><?php echo e(__('sentence.Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/anticedents/edit.blade.php ENDPATH**/ ?>