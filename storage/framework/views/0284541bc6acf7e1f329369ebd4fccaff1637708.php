

<?php $__env->startSection('title'); ?>
    Ajouter un catégorie
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un catégorie</h6>
                </div>
                <div class="card-body">

                    <form action="<?php echo e(route('category.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">

                            <label for="" class="my__label">Nom de catégorie</label>
                            <input type="text" name="name" class="form-control rounded-0 shadow-none"
                                placeholder="Nom de catégorie">
                            <label for=""></label>
                            <label for="" class="my__label">
                                Description de catégorie
                            </label>
                            <textarea name="slug" id="slug" class="form-control rounded-0 shadow-none"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm rounded-0 shadow-none"
                                data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 shadow-none">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/category/create.blade.php ENDPATH**/ ?>