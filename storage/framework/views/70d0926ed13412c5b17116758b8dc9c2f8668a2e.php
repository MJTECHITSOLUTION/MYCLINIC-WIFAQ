
<?php $__env->startSection('content'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6 mb-3">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tous les achats</h6>
                </div>

                <div class="col-6">

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                        <a href="<?php echo e(route('purchase.create')); ?>"
                            class="btn btn-primary rounded-0 shadow-none btn-sm float-right"><i class="fa fa-plus"></i>
                            Ajouter un achat</a>
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
                            <th class="text-center">ID</th>
                            <th class="text-center">Date d'achat </th>
                            <th class="text-center">
                                TVA
                            </th>
                            <th class="text-center">
                                Total
                            </th>
                            <th class="text-center">Status d'achat</th>

                            <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-center"><?php echo e($purchase->id); ?></td>
                                <td class="text-center"><?php echo e($purchase->purchase_date); ?></td>
                                <td class="text-center">

                                    <?php if($purchase->TVA == ''): ?>
                                        <span class="badge badge-info">0 %</span>
                                    <?php else: ?>
                                        <span class="badge badge-info"><?php echo e($purchase->TVA); ?> %</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?php echo e($purchase->total_price); ?></td>
                                <td class="text-center ">
                                    <form id="purchaseForm" action="<?php echo e(route('purchase.status', ['id' => $purchase->id])); ?>"
                                        method="post">
                                        <?php echo csrf_field(); ?>
                                        <select name="purchase_status" class="form-control" onchange="submitForm()">
                                            <option value="0" <?php echo e($purchase->purchase_status == 0 ? 'selected' : ''); ?>>
                                                En cours</option>
                                            <option value="1" <?php echo e($purchase->purchase_status == 1 ? 'selected' : ''); ?>>
                                                Envoyé
                                            </option>
                                            <option value="2" <?php echo e($purchase->purchase_status == 2 ? 'selected' : ''); ?>>
                                                Payé
                                            </option>
                                            <option value="3" <?php echo e($purchase->purchase_status == 3 ? 'selected' : ''); ?>>
                                                Non payé
                                            </option>
                                            <option value="4" <?php echo e($purchase->purchase_status == 4 ? 'selected' : ''); ?>>
                                                Livré
                                            </option>


                                        </select>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view drug')): ?>
                                        <a href="<?php echo e(route('purchase.view', ['id' => $purchase->id])); ?>"
                                            class="btn btn-info btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit drug')): ?>
                                        <a href="<?php echo e(route('purchase.edit', ['id' => $purchase->id])); ?>"
                                            class="btn btn-success btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete drug')): ?>
                                        <a href="
                                            <?php echo e(route('purchase.destroy', ['id' => $purchase->id])); ?>"
                                            class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
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
                    <?php echo $purchases->links(); ?>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script>
        function submitForm() {
            document.getElementById('purchaseForm').submit();
        }
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/dr-imanebenjelloun.tayssir.cloud/resources/views/purchase/specialty/dentiste/all.blade.php ENDPATH**/ ?>