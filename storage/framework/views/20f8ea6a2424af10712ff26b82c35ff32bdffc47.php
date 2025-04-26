
<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('patient.store_edit')); ?>" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">

                        <div class="row">
                            <div class="col-8">
                                <h6 class="m-0 font-weight-bold text-primary">Modifier fiche patient</h6>
                            </div>
                            <div class="col-4">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view patient')): ?>
                                    <button type="submit" class="btn rounded-0  btn-primary btn-sm float-right"
                                        style="margin-left: 15px;"><?php echo e(__('sentence.Save')); ?></button>
                                    <a href="<?php echo e(route('patient.view', ['id' => $patient->id])); ?>"
                                        class="btn rounded-0  btn-primary btn-sm float-right ">Afichier dossier patient</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4"><?php echo e(__('sentence.Full Name')); ?><font color="red">*</font></label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Name"
                                    name="name" value="<?php echo e($patient->name); ?>">
                                <input type="hidden" class="form-control rounded-0 shadow-none " name="user_id"
                                    value="<?php echo e($patient->id); ?>">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputAddress"><?php echo e(__('sentence.Birthday')); ?><font color="red">*</font></label>
                                <input type="date" class="form-control rounded-0 shadow-none " id="Birthday"
                                    name="birthday" autocomplete="off" value="<?php echo e($patient->Patient->birthday); ?>">
                            </div>


                            <div class="form-group col-md-3">
                                <label for="inputCity"><?php echo e(__('sentence.Gender')); ?><font color="red">*</font></label>
                                <select class="form-control rounded-0 shadow-none " name="gender" id="Gender">
                                    <option value="<?php echo e($patient->Patient->gender); ?>" selected="selected">
                                        <?php echo e($patient->Patient->gender); ?></option>
                                    <option value="Homme"><?php echo e(__('sentence.Male')); ?></option>
                                    <option value="Femme"><?php echo e(__('sentence.Female')); ?></option>
                                    <option value="Enfant">Enfant</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputdossier">Numéro de dossier physique</label>
                                <input type="text" class="form-control" name="numdossier" id="numdossier" value="<?php echo e($patient->Patient->numdossier); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            
                            
                            
                            
                            
                            
                            
                            

                        </div>

                        <h4 class="scheduler-border">Informations supplementaires</h4>
                        <div class="form-row">
























                            
                            
                            
                            
                            <div class="form-group col-md-4">
                                <label for="inputAddress"><?php echo e(__('sentence.Profession')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="profession"
                                    name="profession" value="<?php echo e($patient->Patient->profession); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress">CIN</label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="cin"
                                    name="cin" autocomplete="off" value="<?php echo e($patient->Patient->cin); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Assurance</label>
                                <select class="form-control rounded-0 shadow-none " name="assurance" id="assurance">
                                    <option value="<?php echo e($patient->Patient->assurance); ?>">
                                        <?php echo e($patient->Patient->assurance); ?></option>
                                    <?php $__currentLoopData = $assurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($assurance->assurance_name); ?>">
                                            <?php echo e($assurance->assurance_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState"><?php echo e(__('sentence.Image')); ?></label>
                                <br>
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Sélectionner photo...
                                </label>
                                <input type="file" class="form-control rounded-0 shadow-none " id="file-upload"
                                       name="image">
                            </div>
                        </div>
                        

                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <br>

                        <h4 class="scheduler-border">Adresse et contact</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2"><?php echo e(__('sentence.Address')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Address"
                                    name="adress" value="<?php echo e($patient->Patient->adress); ?>">
                            </div>

                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="form-group col-md-3">
                                <label for="inputAddress2"><?php echo e(__('sentence.Ville')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Ville"
                                    name="Ville" value="<?php echo e($patient->Patient->ville); ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2"><?php echo e(__('sentence.Pays')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Pays"
                                    name="Pays" value="Maroc" value="<?php echo e($patient->Patient->pays); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputPassword4"><?php echo e(__('sentence.Email Adress')); ?></label>
                                <input type="email" class="form-control rounded-0 shadow-none " id="Email"
                                    name="email" value="<?php echo e($patient->email); ?>">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputAddress2"><?php echo e(__('sentence.Phone')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="Phone"
                                    name="phone" value="<?php echo e($patient->Patient->phone); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2"><?php echo e(__('sentence.fixe')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none " id="fixe"
                                    name="fixe" value="<?php echo e($patient->Patient->fixe); ?>">
                            </div>
                        </div>

                        <h4 class="scheduler-border">Observation</h4>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Observation</label>
                                <textarea class="form-control rounded-0 shadow-none " id="historiquemaladie" name="historiquemaladie"> <?php echo e($patient->Patient->historiquemaladie); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row col-12 d-flex justify-content-end">
                            <button type="submit" class="btn rounded-0  btn-primary"><?php echo e(__('sentence.Save')); ?></button>

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
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            width: inherit;
            /* Or auto */
            padding: 0 10px;
            /* To give a bit of padding on the left and right */
            border-bottom: none;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/patient/specialty/dentiste/edit.blade.php ENDPATH**/ ?>