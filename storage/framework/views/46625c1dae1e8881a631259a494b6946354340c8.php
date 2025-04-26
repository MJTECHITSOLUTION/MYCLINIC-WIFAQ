

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Add Drug')); ?></h6>
                </div>
                <div class="card-body">

                    <form method="post" action="<?php echo e(route('drug.store')); ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo e(__('sentence.Trade Name')); ?> *</label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="trade_name"
                                id="TradeName" aria-describedby="TradeName" required>
                            <?php echo e(csrf_field()); ?>

                        </div>
                        
                        
                        
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1"><?php echo e(__('sentence.Note')); ?></label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="note" id="Note">
                        </div>
                        <button type="submit" class="btn rounded-0  btn-primary "><?php echo e(__('sentence.Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/drug/specialty/dentiste/create.blade.php ENDPATH**/ ?>