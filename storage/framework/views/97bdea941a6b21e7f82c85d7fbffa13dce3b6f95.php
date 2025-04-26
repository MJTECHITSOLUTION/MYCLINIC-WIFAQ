<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('patient.create')); ?>" enctype="multipart/form-data" id="patientCreateForm">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <h6 class="m-0 font-weight-bold text-primary">Fiche patient</h6>
                            </div>
                            <?php if(Auth::user()->role == 'Médecin'): ?>
                                <input type="hidden" name="doctor" id="doctor" value="<?php echo e(Auth::user()->id); ?>">
                                <div class="col-4">
                                    <div class="form-group mb-0">
                                        <input type="hidden" class="form-control form-control-lg bg-light border-0 shadow-sm" value="<?php echo e(Auth::user()->name); ?>" readonly style="border-radius: 25px; padding: 15px 20px; height: auto; font-size: 1.1rem;">
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-4">
                                    <div class="form-group mb-0">
                                        <select class="form-control form-control-lg bg-light border-0 shadow-sm" name="doctor" id="doctor" required style="border-radius: 25px; padding: 15px 20px; height: auto; font-size: 1.1rem;">
                                            <option value="0">Choisir le médecin</option>
                                            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($doctor->id); ?>"><?php echo e($doctor->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-4 text-right">
                                <button type="submit" class="btn rounded-0 btn-primary btn-sm"
                                    style="margin-left: 15px;"><?php echo e(__('sentence.Save')); ?></button>
                                <a href="<?php echo e(route('patient.all')); ?>"
                                    class="btn rounded-0 btn-info btn-sm">Tous les patinets</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo csrf_field(); ?>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4"><?php echo e(__('sentence.Full Name')); ?><font color="red">*</font></label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Name"
                                    name="name" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress"><?php echo e(__('sentence.Birthday')); ?><font color="red">*</font></label>
                                <input type="date" class="form-control  rounded-0 shadow-none" id="Birthday"
                                    name="birthday" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity"><?php echo e(__('sentence.Gender')); ?><font color="red">*</font></label>
                                <select class="form-control rounded-0 shadow-none" name="gender" id="Gender" required>
                                    <option value="">Sélectionner...</option>
                                    <option value="Homme"><?php echo e(__('sentence.Male')); ?></option>
                                    <option value="Femme"><?php echo e(__('sentence.Female')); ?></option>
                                    <option value="Enfant">Enfant</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputdossier">Numéro de dossier physique</label>
                                <input type="text" class="form-control" name="numdossier" id="numdossier">
                            </div>
                        </div>


                        <h4 class="scheduler-border">Informations supplementaires</h4>
                        <div class="form-row">























                            
                            
                            
                            
                            <div class="form-group col-md-4">
                                <label for="inputAddress"><?php echo e(__('sentence.Profession')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="profession"
                                    name="profession">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress">CIN</label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="cin"
                                    name="cin">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Assurance </label>
                                <select class="form-control rounded-0 shadow-none" name="assurance" id="assurance">
                                    <option value="">Sélectionner Assurance</option>
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
                                <input type="file" class="form-control rounded-0 w-100 shadow-none" id="file-upload"
                                       name="image">
                            </div>

                            

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            

                        </div>

                        <h4 class="scheduler-border">Adresse et contact</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress2"><?php echo e(__('sentence.Address')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Address"
                                    name="adress">
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="form-group col-md-3">
                                <label for="inputAddress2"><?php echo e(__('sentence.Ville')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Ville"
                                    name="Ville">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2"><?php echo e(__('sentence.Pays')); ?></label>
                                <input type="text" class="form-control rounded-0 shadow-none" id="Pays"
                                    name="Pays" value="Maroc">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputPassword4"><?php echo e(__('sentence.Email Adress')); ?></label>
                                <input type="email" class="form-control rounded-0 shadow-none" id="Email"
                                    name="email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2"><?php echo e(__('sentence.Phone')); ?></label>
                                <input type="number" class="form-control rounded-0 shadow-none" id="Phone"
                                    name="phone">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2"><?php echo e(__('sentence.fixe')); ?></label>
                                <input type="number" class="form-control rounded-0 shadow-none" id="fixe"
                                    name="fixe">
                            </div>
                        </div>


                        <h4 class="scheduler-border">Observation</h4>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputAddress2"><?php echo e(__('sentence.observation')); ?></label>
                                <textarea class="form-control rounded-0 shadow-none" id="historiquemaladie" name="historiquemaladie"></textarea>
                            </div>
                        </div>

                        </h4>



                        <div class="row justify-content-end col-12">


                            <button type="submit"
                                class="btn rounded-0  btn-primary ccess"><?php echo e(__('sentence.Save')); ?></button>

                        </div>


    </form>
    </div>
    </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style type="text/css">
        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
            background-color: #f8f9fa;
            transition: all 0.3s;
        }

        .custom-file-upload:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
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
            padding: 0 10px;
            border-bottom: none;
        }

        .form-control {
            border-radius: 4px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .btn {
            border-radius: 4px;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .card {
            border-radius: 8px;
            transition: all 0.3s;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        h4.scheduler-border {
            color: #4e73df;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e3e6f0;
        }

        textarea {
            resize: vertical;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Show filename when selected
            $("#file-upload").change(function() {
                var fileName = $(this).val().split("\\").pop();
                if (fileName) {
                    $(".custom-file-upload").html('<i class="fa fa-file"></i> ' + fileName);
                } else {
                    $(".custom-file-upload").html('<i class="fa fa-cloud-upload"></i> Sélectionner photo...');
                }
            });

            // Form validation and submission
            $("#patientCreateForm").on('submit', function(e) {
                e.preventDefault();
                
                // Basic validation
                if (!$("#Name").val()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur de validation',
                        text: 'Le nom complet est obligatoire',
                        confirmButtonColor: '#4e73df'
                    });
                    return false;
                }
                
                if (!$("#Birthday").val()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur de validation',
                        text: 'La date de naissance est obligatoire',
                        confirmButtonColor: '#4e73df'
                    });
                    return false;
                }
                
                if (!$("#Gender").val()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur de validation',
                        text: 'Le genre est obligatoire',
                        confirmButtonColor: '#4e73df'
                    });
                    return false;
                }
                
                if (!$("#doctor").val() || $("#doctor").val() == "0") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur de validation',
                        text: 'Veuillez sélectionner un médecin',
                        confirmButtonColor: '#4e73df'
                    });
                    return false;
                }
                
                // File validation
                var fileInput = $("#file-upload")[0];
                if (fileInput.files.length > 0) {
                    var fileSize = fileInput.files[0].size / 1024 / 1024; // in MB
                    var fileType = fileInput.files[0].type;
                    
                    if (fileSize > 2) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fichier trop volumineux',
                            text: 'La taille de l\'image ne doit pas dépasser 2MB',
                            confirmButtonColor: '#4e73df'
                        });
                        return false;
                    }
                    
                    if (!fileType.match('image.*')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format de fichier invalide',
                            text: 'Veuillez sélectionner une image (JPG, PNG, GIF)',
                            confirmButtonColor: '#4e73df'
                        });
                        return false;
                    }
                }
                
                // Show loading state
                Swal.fire({
                    title: 'Enregistrement en cours...',
                    html: 'Veuillez patienter',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit the form
                this.submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\MAMP\htdocs\dr-rmili\resources\views/patient/specialty/dentiste/create.blade.php ENDPATH**/ ?>