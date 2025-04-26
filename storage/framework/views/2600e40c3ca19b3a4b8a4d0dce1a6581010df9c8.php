
<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ajoute service</h6>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('payment.create')); ?>">
               <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Nom<font color="red">*</font></label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="inputEmail3" name="name" required>
                  </div>
                      <label for="inputEmail4" class="col-sm-3 col-form-label">Prix<font color="red">*</font></label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="inputEmail4" name="price" required>
                     <?php echo e(csrf_field()); ?>

                  </div>
               </div>

               <div class="form-group row">
                  <div class="col-sm-9">
                     <button type="submit" class="btn btn-success"><?php echo e(__('sentence.Save')); ?></button>
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
<?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/payment/specialty/dentiste/create.blade.php ENDPATH**/ ?>