<?php $__env->startSection('title'); ?>
    Tous les articles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les articles</h6>
                </div>

                <div class="col-6">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                        <button type="button" class="btn btn-info btn-sm rounded-0 shadow-none float-right ml-2"
                            data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-plus fa-sm"></i>
                            Ajouter une nouvelle catégorie
                        </button>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('category.create')); ?>" method="POST">
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
                            <th>
                                Image
                            </th>
                            <th>Nom </th>
                            <th>Category</th>
                            <th>Marque</th>
                            <th>Unit</th>
                            <th>Prix d'achat</th>
                            <th>
                                Prix de vente
                            </th>
                            <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e(asset('uploads/images_Items/' . $item->item_image)); ?>" alt=""
                                        width="50px" height="50px">
                                <td class="text-center">
                                    <a
                                        href="
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view drug')): ?>
                                        <?php echo e(route('item.view', ['id' => $item->id])); ?>

                                    <?php endif; ?>
                                    ">
                                        <?php echo e($item->name); ?>

                                    </a>

                                </td>
                                <td class="text-center"><?php echo e($item->category->name); ?></td>
                                <td class="text-center"><?php echo e($item->brand); ?></td>
                                <td class="text-center"><?php echo e($item->unit); ?></td>
                                <td class="text-center"><?php echo e(number_format($item->purchase_price, 2, ',', ' ')); ?></td>
                                <td class="text-center"><?php echo e(number_format($item->sale_price, 2, ',', ' ')); ?></td>
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view drug')): ?>
                                        <a href="<?php echo e(route('item.view', ['id' => $item->id])); ?>"
                                            class="btn btn-outline-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit drug')): ?>
                                        <a href="<?php echo e(route('item.edit', ['id' => $item->id])); ?>"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete drug')): ?>
                                        <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal"
                                            data-link="<?php echo e(route('item.destroy', ['id' => $item->id])); ?>"><i
                                                class="fas fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center"><br><br> Aucun article trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- Button trigger modal -->


                <div class="d-flex">
                    <?php echo $items->links(); ?>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/item/all.blade.php ENDPATH**/ ?>