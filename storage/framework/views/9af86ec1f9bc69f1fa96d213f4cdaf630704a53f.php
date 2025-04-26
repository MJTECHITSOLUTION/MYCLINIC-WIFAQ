

<?php $__env->startSection('title'); ?>
    Ajouter un Déposes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un Déposes</h6>
                </div>
                <div class="card-body">

                    <form action="<?php echo e(route('depense.store_edit')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <input type="hidden"value="<?php echo e($depense->id); ?>" name="myid">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="" class="my__label">Label <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="label"
                                    id="label" value="<?php echo e($depense->label); ?>">

                            </div>


                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="" class="my__label">Monton <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="monton"
                                    id="monton" value="<?php echo e($depense->monton); ?>">

                            </div>

                            <div class="form-group col-6">
                                <label for="" class="my__label">Type déposes <span
                                        class="text-danger"></span></label>
                                <select type="text" class="form-control rounded-0 w-100 shadow-none" name="type_depenses"
                                    id="type_depenses" value="<?php echo e($depense->type_depenses); ?>">


                                    <?php $__currentLoopData = $type_depenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_depense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($type_depense->name == $depense->type_depenses): ?>
                                            <option value="<?php echo e($type_depense->name); ?>" selected><?php echo e($type_depense->name); ?>

                                            </option>
                                        <?php else: ?>
                                            <option value="<?php echo e($type_depense->name); ?>"><?php echo e($type_depense->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                            </div>


                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="" class="my__label">Tiers <span class="text-danger"></span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="created_by"
                                    id="created_by" value="<?php echo e($depense->created_by); ?>">

                            </div>
                            <div class="form-group col-6">
                                <label for="" class="my__label"> Reference <span class="text-danger"></span></label>
                                <input type="text" class="form-control rounded-0 w-100 shadow-none" name="reference"
                                    id="reference" value="<?php echo e($depense->reference); ?>">

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="" class="my__label">Remarque <span class="text-danger"></span></label>
                                <textarea name="note" id="" class="form-control rounded-0 w-100 shadow-none"><?php echo e($depense->note); ?>

                                </textarea>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-0 shadow-none">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/depense/edit.blade.php ENDPATH**/ ?>