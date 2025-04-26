<?php $__env->startSection('title'); ?>
    Facture
<?php $__env->stopSection(); ?>
<?php if(env('APP_NAME') == 'GEN'): ?>
    <?php echo $__env->first(['prescription.custom.generalist_facture', 'prescription.specialty.generalist.facture'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'PED'): ?>
    <?php echo $__env->first(['prescription.custom.pediatre_facture', 'prescription.specialty.pediatre.facture'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'OPH'): ?>
    <?php echo $__env->first(['prescription.custom.ophtamologie_facture', 'prescription.specialty.ophtamologie.facture'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(env('APP_NAME') == 'DENT'): ?>
    <?php echo $__env->first(['prescription.custom.dentiste_facture', 'prescription.specialty.dentiste.facture'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/billing/facture.blade.php ENDPATH**/ ?>