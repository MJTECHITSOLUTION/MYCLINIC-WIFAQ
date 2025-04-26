

<?php $__env->startSection('title'); ?>
    Tous les catégories
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les catégories</h6>
                </div>

                <div class="col-6">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                        <a href="<?php echo e(route('category.create')); ?>">
                            <button class="btn btn-info rounded-0 shadow-none btn-sm float-right ml-2"><i class="fa fa-plus"></i>
                                Ajouter un catégorie</button>
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                        <a href="<?php echo e(route('item.create')); ?>" class="btn btn-primary rounded-0 shadow-none btn-sm float-right"><i
                                class="fa fa-plus"></i>
                            Ajouter un article</a>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <div class="col-12">
                        <form class="  navbar-search" action="<?php echo e(route('item.search')); ?>" method="post">
                            <div class="input-group">
                                <input type="text" name="term"
                                    class="form-control rounded-0 bg-light  shadow-none border-1 small"
                                    placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
                                <?php echo csrf_field(); ?>
                                <div class="input-group-append">
                                    <button class="btn btn-primary rounded-0 " type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Nom catégorie </th>
                            <th class="text-center">
                                Description
                            </th>

                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-center"><?php echo e($category->name); ?></td>
                                <td class="text-center"><?php echo e($category->slug); ?></td>
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit drug')): ?>
                                        <a href="<?php echo e(route('category.edit', ['id' => $category->id])); ?>"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete drug')): ?>
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="<?php echo e(route('category.destroy', ['id' => $category->id])); ?>"><i
                                                class="fas fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center"><br><br> Aucun article trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- Button trigger modal -->


                <div class="d-flex">
                    <?php echo $categorys->links(); ?>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/category/all.blade.php ENDPATH**/ ?>