<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.New Prescription')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form method="post" action="<?php echo e(route('prescription.store')); ?>">
   <div class="row justify-content-center">
      <div class="col-md-4">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-10">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Patient informations')); ?></h6>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>
            <div class="card-body">
               <div class="form-group">
                  <label for="PatientID"><?php echo e(__('sentence.Patient')); ?> :</label>
                  <select class="form-control multiselect-doctorino" name="patient_id" id="PatientID" required>
                     <option><?php echo e(__('sentence.Select Patient')); ?></option>
                      <?php
                          $lastPatientId = Session::get('lastpatient'); // Retrieve the value of 'lastpatient' from the session
                      ?>

                      <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($patient->id); ?>"
                                  data-birthday="<?php echo e($patient->Patient->birthday ?? ''); ?>"
                                  data-gender="<?php echo e($patient->Patient->gender ?? ''); ?>"
                                  data-phone="<?php echo e($patient->Patient->phone ?? ''); ?>"
                                  data-address="<?php echo e($patient->Patient->address ?? ''); ?>"
                                  data-weight="<?php echo e($patient->Patient->weight ?? ''); ?>"
                                  data-height="<?php echo e($patient->Patient->height ?? ''); ?>"
                                  data-blood="<?php echo e($patient->Patient->blood ?? ''); ?>"
                                  data-cin="<?php echo e($patient->Patient->cin ?? ''); ?>"
                                  data-assurance="<?php echo e($patient->Patient->assurance); ?>"
                                  <?php if($lastPatientId == $patient->id): ?> selected <?php endif; ?>
                          > <!-- Check if current patient ID matches the lastpatient ID -->
                              <?php echo e($patient->name); ?>

                          </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php echo e(csrf_field()); ?>

               </div>
                <div id="selected-patient-info">

                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#PatientID').on('change', function() {
                            var selectedOption = $(this).find(':selected');
                            var birthday = selectedOption.data('birthday');
                            var phone = selectedOption.data('phone');
                            var address = selectedOption.data('address');
                            var assurance = selectedOption.data('assurance');
                            var height = selectedOption.data('height');
                            var blood = selectedOption.data('blood');
                            var cin = selectedOption.data('cin');

                            var patientInfo = '';
                            if (birthday) {
                                patientInfo += '<p><b><?php echo e(__('sentence.Birthday')); ?> :</b> ' + birthday + ' (' + calculateAge(birthday) + ')</p>';
                            }
                            if (phone) {
                                patientInfo += '<p><b><?php echo e(__('sentence.Phone')); ?> :</b> ' + phone + '</p>';
                            }
                            if (address) {
                                patientInfo += '<p><b><?php echo e(__('sentence.Address')); ?> :</b> ' + address + '</p>';
                            }
                            if (assurance) {
                                patientInfo += '<p><b><?php echo e(__('sentence.assurance')); ?> :</b> ' + assurance + ' </p>';
                            }
                            
                            
                            
                            if (blood) {
                                patientInfo += '<p><b><?php echo e(__('sentence.Blood Group')); ?> :</b> ' + blood + '</p>';
                            }
                            if (cin) {
                                patientInfo += '<p><b>CIN : </b> ' + cin + '</p>';
                            }
                            $('#selected-patient-info').html(patientInfo);
                        });

                        function calculateAge(birthday) {
                            var today = new Date();
                            var birthDate = new Date(birthday);
                            var age = today.getFullYear() - birthDate.getFullYear();
                            var monthDifference = today.getMonth() - birthDate.getMonth();

                            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                                age--;
                            }
                            return age;
                        }
                    });
                </script>
               <div class="form-group">

               </div>
            </div>
         </div>
      </div>

      <div class="col-md-8">
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <div class="row">
                      <div class="col-10">
                          <h6 class="m-0 font-weight-bold text-primary">Motife de consultation</h6>
                      </div>
                      <div class="col-2">
                          <button type="submit" class="btn btn-primary btn-sm float-right">Enregistre tout</button>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <div class="form-group">
                      <label for="motife">Motife de consultation</label>
                      <textarea class="form-control" id="motife" name="motife" placeholder=""></textarea>
                  </div>
              </div>
          </div>
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Examen clinique</h6>
              </div>
              <div class="card-body">
                  <fieldset class="certificate">
                      <form>
                          <div class="form-row">
                              <div class="form-group col-md-3">
                                  <label for="inputPoid">Poid</label>
                                  <input type="number" class="form-control" id="inputPoid" name="poid" placeholder="" style="width: 11rem;">
                                  <small id="poidHelp" class="form-text text-muted">Poids en kilogrammes</small>

                              </div>
                              <div class="form-group col-md-3">
                                  <label for="inputTaille">Taille</label>
                                  <input type="number" class="form-control" id="inputTaille" name="taille" placeholder="" style="width: 11rem;">
                                  <small id="tailleHelp" class="form-text text-muted">Hauteur en centimètres</small>
                              </div>
                              <div class="form-group col-md-3">
                                  <label for="inputPC">Périmètre crânien</label>
                                  <input type="number" class="form-control" id="inputPC" name="pc" placeholder="" style="width: 11rem;">
                                  <small id="padHelp" class="form-text text-muted">Périmètre crânien en cm </small>
                              </div>
                              <div class="form-group col-md-3">
                                  <label for="inputPAS">PAS</label>
                                  <input type="number" class="form-control" id="inputPAS" name="pas" placeholder="" style="width: 11rem;">
                                  <small id="pasHelp" class="form-text text-muted">Pression artérielle systolique en mmHg</small>
                              </div>
                              <div class="form-group col-md-3">
                                  <label for="inputPAD">TA</label>
                                  <input type="number" class="form-control" id="inputPAD" name="pad" placeholder="" style="width: 11rem;">
                                  <small id="padHelp" class="form-text text-muted">Pression artérielle diastolique en mmHg</small>
                              </div>
                              <div class="form-group col-md-3">
                                  <label for="inputPouls">Fréquence cardiaque</label>
                                  <input type="number" class="form-control" id="inputPouls" name="pouls" placeholder="" style="width: 11rem;">
                                  <small id="poulsHelp" class="form-text text-muted">Fréquence cardiaque en battements par minute</small>
                              </div>
                              <div class="form-group col-md-3">
                                  <label for="inputfr">Fréquence respiratoire</label>
                                  <input type="number" class="form-control" id="inputfr" name="fr" placeholder="" style="width: 11rem;">
                                  <small id="poulsHelp" class="form-text text-muted">Fréquence respiratoire</small>
                              </div>
                              <div class="form-group col-md-3">
                                  <label for="inputTemp">Température</label>
                                  <input type="number" class="form-control" id="inputTemp" name="temp" placeholder="" style="width: 11rem;">
                                  <small id="tempHelp" class="form-text text-muted">Température en °C</small>
                              </div>
                              <div class="form-group col-md-3">
                                  <label for="inputsa">Saturation en oxygène</label>
                                  <input type="number" class="form-control" id="inputsa" name="sa" placeholder="" style="width: 11rem;">
                                  <small id="tempHelp" class="form-text text-muted">Saturation en oxygène</small>
                              </div>
                          </div>
                          <label for="motife">Rapport d'examen</label>
                          <textarea class="form-control" id="rapport" name="rapport" placeholder=""></textarea>
                      </form>
                  </fieldset>
              </div>
          </div>
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Ajouter ordonnance</h6>
            </div>
            <div class="card-body">
               <fieldset class="drugs_labels">
                  <div class="repeatable"></div>
                  <div class="form-group">
                     <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Add Drug')); ?></a>
                  </div>
               </fieldset>
            </div>
         </div>
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Ajouter analyses médicals</h6>
            </div>
            <div class="card-body">
               <fieldset class="test_labels">
                  <div class="repeatable"></div>
                  <div class="form-group">
                     <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Add Test')); ?></a>
                  </div>
               </fieldset>
            </div>
         </div>

          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Ajouter bilan médical</h6>
              </div>
              <div class="card-body">
                  <div class="form-group">
                      <label for="bilan">Bilan</label>
                      <textarea class="form-control" id="bilan" name="bilan" placeholder=""></textarea>
                  </div>
              </div>
          </div>

          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Ajouter certificat médical</h6>
              </div>
              <div class="card-body">
                  <div class="form-group">
                      <label for="inputCertificat">Les jours</label>
                      <input type="number" class="form-control" id="inputCertificat" name="certificat" placeholder="Les jours du repos" oninput="calculateDates()">
                      <small id="certificatHelp" class="form-text text-muted">Entre les jours du repos.</small>
                      <label for="inputdated">La date de début</label>
                      <input type="date" class="form-control" id="dated" name="dated" value="<?php echo e(date('Y-m-d')); ?>" oninput="calculateDates()">
                      <label for="inputdatef">La date de Fin</label>
                      <input type="date" class="form-control" id="datef" name="datef">
                  </div>
              </div>
          </div>
          <button type="submit" class="btn btn-primary btn-sm float-right">Enregistre tout</button>





      </div>
   </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.multiselect-doctorino').select2();
});

</script>


<script type="text/template" id="drugs_labels">
   <section class="field-group">
                         <div class="row">
                             <div class="col-md-2">




                             </div>
                             <div class="col-md-12">
                                 <select class="form-control multiselect-drug" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                                   <option value=""><?php echo e(__('sentence.Select Drug')); ?>...</option>
                                   <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($drug->id); ?>"><?php echo e($drug->trade_name); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                             </div>





                         </div>
                            <br>














                         <div class="row">
                             <div class="col-md-9">
                                 <div class="form-group-custom">
                                     <input type="text" id="drug_advice" name="drug_advice[]" class="form-control" placeholder="Remarque">
                                 </div>
                             </div>
                              <div class="col-md-3">
                                    <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> <?php echo e(__('sentence.Remove')); ?></a>
                               </div>
                               <div class="col-12">
                                    <hr color="#a1f1d4">
                              </div>
                         </div>
                 </section>

</script>
<script type="text/template" id="test_labels">
    <div class="field-group row">









        <div class="form-group col-md-12">
            <label for="analyse_id">Analyse:</label>
            <select name="analyse_id[]"  class="form-control analyse-select">
                <option value="">Select Analyse</option>
                <?php $__currentLoopData = $analyses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analyse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($analyse->id); ?>"><?php echo e($analyse->analyse_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-9">
            <div class="form-group-custom">
                <input type="text" name="description[]" class="form-control" placeholder="<?php echo e(__('sentence.Description')); ?>">
            </div>
        </div>
        <br>
        <div class="col-md-3">
            <a type="button" class="btn btn-danger delete text-white btn-sm" align="center">
                <i class="fa fa-plus"></i> <?php echo e(__('sentence.Remove')); ?>

            </a>
        </div>
        <div class="col-12">
            <hr color="#a1f1d4">
        </div>
    </div>
</script>

<script>
    function calculateDates() {
        const daysInput = document.getElementById('inputCertificat');
        const startDateInput = document.getElementById('dated');
        const endDateInput = document.getElementById('datef');

        const days = parseInt(daysInput.value, 10);
        const startDate = new Date(startDateInput.value);

        if (!isNaN(days) && startDate instanceof Date && !isNaN(startDate)) {
            const endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + days);
            endDateInput.value = endDate.toISOString().split('T')[0];
        } else {
            endDateInput.value = '';
        }
    }
</script>

<script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Documents\GitHub\doctor\resources\views/prescription/create.blade.php ENDPATH**/ ?>