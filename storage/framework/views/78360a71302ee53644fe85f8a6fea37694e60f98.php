<?php $__env->startSection('title'); ?>
    Catégorie Acte
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Catégorie acte</h6>
            <div>
                <button id="openFormButton" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                    <i class="fas fa-plus"></i> Ajouter nouveau
                </button>
                <!-- First additional button with orange color -->
                <a type="button" href="<?php echo e(route('act.create_category_act')); ?>" class="btn btn-info ml-2">
                    Famille acte
                </a>
                <!-- Second additional button with orange color -->
                <a type="button" href="<?php echo e(route('act.create_act')); ?>" class="btn btn-secondary ml-2">
                    Acte
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Search bar in the center -->
            <div class="d-flex justify-content-end">
                <form class="form-inline navbar-search" action="<?php echo e(route('cat.search')); ?>" method="post">
                    <?php echo csrf_field(); ?> <!-- Add a CSRF token for security -->
                    <div class="form-group">
                        <select id="sous_category" name="term" class="form-control ">
                            <option value="">Recherche...</option>
                            <?php $__currentLoopData = $category_act; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($act->id); ?>"><?php echo e($act->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </form>
            </div>
            <br>
            <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">Libellé</th>
                            <th class="text-center">Remarque</th>
                            <th class="text-center">Famille</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $sous_category_act; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($act->name); ?></td>
                                <td class="text-center"><?php echo e($act->ref); ?></td>
                                <td class="text-center">
                                    <?php if(!empty($act->category_act_id)): ?>
                                            <?php $category = DB::table('category_act')->where('id', $act->category_act_id)->value('name'); ?>
                                        <?php echo e($category ?? ''); ?>

                                    <?php else: ?>
                                        <?php echo e($act->category_act_id); ?>

                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit drug')): ?>
                                        <button type="button" class="btn btn-success btn-circle btn-sm editbtn"
                                                value="<?php echo e($act->id); ?>"
                                                data-name="<?php echo e($act->name); ?>"
                                                data-ref="<?php echo e($act->ref); ?>"
                                                data-category_act_id = "<?php echo e($act->category_act_id); ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit drug')): ?>
                                        <a href="<?php echo e(route('act.destroysouscategory', ['id' => $act->id])); ?>"
                                           class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
            <span class="float-right mt-3"><?php echo e($sous_category_act->links()); ?></span>
        </div>
            </div>



    <!-- Modal for the form -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Ajoute</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo e(route('category.acte')); ?>">
                        <div class="form-group row">
                            <label for="SelectAct" class="col-sm-3 col-form-label">Famille acte<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <select id="sous_category" name="category_act_id" class="form-control ">
                                    <option value="">Sélectionnez...</option>
                                    <?php $__currentLoopData = $category_act; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($act->id); ?>"><?php echo e($act->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Libellé<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="name">
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Remarque</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="ref">
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn rounded-0  btn-primary "><?php echo e(__('sentence.Save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for editing an entry -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="post" action="<?php echo e(url('update-actg')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PUT')); ?>

                        <input type="hidden" id="editActeId" name="id">
                        <div class="form-group row">
                            <label for="SelectAct" class="col-sm-3 col-form-label">Famille acte<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <select id="sous_category" name="category_act_id" class="form-control" required>
                                    <option value="">Sélectionnez...</option>
                                    <?php $__currentLoopData = $category_act; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($act->id); ?>"><?php echo e($act->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editName" class="col-sm-3 col-form-label">Libellé<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="editName" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editRef" class="col-sm-3 col-form-label">Remarque</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="editRef" name="ref">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn rounded-0 btn-primary"><?php echo e(__('sentence.Save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <!-- Include necessary scripts and styles for modal and select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

    <!-- JavaScript for opening the modal and initializing select2 -->
    <script>
        $(document).ready(function () {
            $('#sous_category').select2();
        });
        $(document).ready(function() {
            $('.select2').select2();
            $('#openFormButton').click(function() {
                $('#formModal').modal('show');
            });
        });
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
        $(document).ready(function() {
            $(".editbtn").click(function () {
                var actId = $(this).val();
                var actName = $(this).data("name");
                var actRef = $(this).data("ref");
                var id_cat = $(this).data("category_act_id");

                $("#editActeId").val(actId);
                $("#editName").val(actName);
                $("#editRef").val(actRef);
                $("#sous_category").val(id_cat);

                $("#editModal").modal("show");
            });
        });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/act/create_sous_category_act.blade.php ENDPATH**/ ?>