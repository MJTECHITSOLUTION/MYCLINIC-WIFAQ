<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.Edit assurance')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Edit assurance')); ?> <?php echo e($assurance->trade_name); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('assurance.store_edit')); ?>">
               <div class="form-group">
                  <label for="assurance_name">Nom de l'assurance *</label>
                   <input type="hidden" name="assurance_id" value="<?php echo e($assurance->id); ?>">
                  <input type="text" class="form-control" name="assurance_name" id="assurance_name" aria-describedby="TradeName" value="<?php echo e($assurance->assurance_name); ?>">
                  <?php echo e(csrf_field()); ?>

               </div>





               <div class="form-group">
                  <label for="exampleInputPassword1">Note</label>
                  <input type="text" class="form-control" name="note" id="Note">
               </div>
               <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Save')); ?></button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Documents\GitHub\doctor\resources\views/assurance/edit.blade.php ENDPATH**/ ?>