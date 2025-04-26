<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.edit analyse')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.edit analyse')); ?></h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('analyse.store_edit')); ?>">
               <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label"><?php echo e(__('sentence.analyse Name')); ?><font color="red">*</font></label>
                  <div class="col-sm-9">
                      <input type="hidden" name="analyse_id" value="<?php echo e($analyse->id); ?>">
                     <input type="text" class="form-control" id="analyse_name" name="analyse_name" value="<?php echo e($analyse->analyse_name); ?>">
                     <?php echo e(csrf_field()); ?>

                  </div>
               </div>
               <div class="form-group row">
                   <div class="col-sm-9">
                       <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Save')); ?></button>
                   </div>
                  <label for="inputEmail3" class="col-sm-3 col-form-label" style="display: none"><?php echo e(__('sentence.Tests')); ?><font color="red">*</font></label>
                   <div class="col-sm-9">
                       <select class="form-control multiselect-doctorino" name="test_id" id="test_id" tabindex="-1" aria-hidden="true" style="display: none;">
                           <option value=""><?php echo e(__('sentence.Select Test')); ?>...</option>
                           <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="14"></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/medecin.tayssir.cloud/resources/views/analyse/edit.blade.php ENDPATH**/ ?>