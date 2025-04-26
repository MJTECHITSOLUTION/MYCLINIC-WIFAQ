<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.New Patient')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
             <div class="row">
                 <div class="col-10">
                     <h6 class="m-0 font-weight-bold text-primary">Créer fiche Patient</h6>
                 </div>
                 <div class="col-2">
                     <button type="submit" class="btn btn-primary btn-sm float-right"><?php echo e(__('sentence.Save')); ?></button>
                 </div>
             </div>
         </div>
         <div class="card-body">
            <form method="post" action="<?php echo e(route('patient.create')); ?>" enctype="multipart/form-data">
               <?php echo csrf_field(); ?>
               <div class="form-row">
                  <div class="form-group col-md-4">
                     <label for="inputEmail4"><?php echo e(__('sentence.Full Name')); ?><font color="red">*</font></label>
                     <input type="text" class="form-control" id="Name" name="name">
                  </div>
                   <div class="form-group col-md-4">
                       <label for="inputAddress"><?php echo e(__('sentence.Birthday')); ?><font color="red">*</font></label>
                       <input type="date" class="form-control" id="Birthday" name="birthday" autocomplete="off">
                   </div>

                  <div class="form-group col-md-4">
                     <label for="inputCity"><?php echo e(__('sentence.Gender')); ?><font color="red">*</font></label>
                     <select class="form-control" name="gender" id="Gender">
                        <option value="Garçon"><?php echo e(__('sentence.Male')); ?></option>
                        <option value="Fille"><?php echo e(__('sentence.Female')); ?></option>
                     </select>
                  </div>
               </div>
               <div class="form-row">









               </div>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Informations supplementaires</legend>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputZip"><?php echo e(__('sentence.Blood Group')); ?> de l'enfant</label>
                            <select class="form-control" name="blood" id="Blood">
                                <option value="Unknown"><?php echo e(__('sentence.Unknown')); ?></option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState"><?php echo e(__('sentence.Image')); ?></label>
                            <br>
                            <label for="file-upload" class="custom-file-upload">
                                <i class="fa fa-cloud-upload"></i> Selectionner l'image de l'enfant...
                            </label>
                            <input type="file" class="form-control" id="file-upload" name="image">
                        </div>
                        <div class="form-group col-md-4">

                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputAddress2">Nom et prénom du représentant légal </label>
                            <input type="text" class="form-control" id="nbenfant" name="nbenfant">
                        </div>





                        <div class="form-group col-md-4">
                            <label for="inputAddress">CIN</label>
                            <input type="text" class="form-control" id="cin" name="cin" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputZip">Assurance </label>
                            <select class="form-control" name="assurance" id="assurance">
                                <?php $__currentLoopData = $assurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($assurance->assurance_name); ?>"><?php echo e($assurance->assurance_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>




















                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Adresse et contact</legend>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputAddress2"><?php echo e(__('sentence.Address')); ?></label>
                            <input type="text" class="form-control" id="Address" name="adress">
                        </div>








                        <div class="form-group col-md-3">
                            <label for="inputAddress2"><?php echo e(__('sentence.Ville')); ?></label>
                            <input type="text" class="form-control" id="Ville" name="Ville">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputAddress2"><?php echo e(__('sentence.Pays')); ?></label>
                            <input type="text" class="form-control" id="Pays" name="Pays" value="Maroc">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputPassword4"><?php echo e(__('sentence.Email Adress')); ?></label>
                            <input type="email" class="form-control" id="Email" name="email">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputAddress2"><?php echo e(__('sentence.Phone')); ?></label>
                            <input type="text" class="form-control" id="Phone" name="phone">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputAddress2"><?php echo e(__('sentence.fixe')); ?></label>
                            <input type="text" class="form-control" id="fixe" name="fixe">
                        </div>
                    </div>
                </fieldset>
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Observation</legend>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputAddress2"><?php echo e(__('sentence.observation')); ?></label>
                        <textarea  class="form-control" id="historiquemaladie" name="historiquemaladie"></textarea>
                    </div>
                </div>

            </fieldset>



                <div class="row justify-content-between">
                    <div class="col-2">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('sentence.Save')); ?></button>
                    </div>
                </div>
               <div class="form-group row">
                  <div class="col-sm-9 row justify-content-between">
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
<style type="text/css">
   input[type="file"] {
   display: none;
   }
   .custom-file-upload {
   border: 1px solid #ccc;
   display: inline-block;
   padding: 6px 12px;
   cursor: pointer;
   }
   fieldset.scheduler-border {
       border: 1px groove #ddd !important;
       padding: 0 1.4em 1.4em 1.4em !important;
       margin: 0 0 1.5em 0 !important;
       -webkit-box-shadow:  0px 0px 0px 0px #000;
       box-shadow:  0px 0px 0px 0px #000;
   }

   legend.scheduler-border {
       width:inherit; /* Or auto */
       padding:0 10px; /* To give a bit of padding on the left and right */
       border-bottom:none;
   }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/medecin.tayssir.cloud/resources/views/patient/create.blade.php ENDPATH**/ ?>