<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.View Prescription')); ?>

<?php $__env->stopSection(); ?>
<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['prescription.custom.generalist_edit', 'prescription.specialty.generalist.view'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['prescription.custom.pediatre_edit', 'prescription.specialty.pediatre.view'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['prescription.custom.ophtamologie_edit', 'prescription.specialty.ophtamologie.view'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['prescription.custom.dentiste_edit', 'prescription.specialty.dentiste.view'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\dr-rmili\resources\views/prescription/view.blade.php ENDPATH**/ ?>