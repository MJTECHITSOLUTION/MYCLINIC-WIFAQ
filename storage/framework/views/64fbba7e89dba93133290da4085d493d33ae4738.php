
<?php $__env->startSection('content'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 ">
            <div class="row mb-2">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Tout les radios</h6>
                </div>
                <div class="col-4">


                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create diagnostic analyse')): ?>
                        <a href="<?php echo e(route('radio.create')); ?>" class="btn rounded-0  btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> Tout les radios</a>
                    <?php endif; ?>
                </div>
                <div class="col-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create drug')): ?>
                        <a href="<?php echo e(route('radio.create')); ?>" class="btn rounded-0  btn-primary btn-sm float-right"><i
                                class="fa fa-plus"></i> Ajoute Radio</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <form class="d-none d-sm-inline-block form-inline mr-auto col-12  mw-100 navbar-search"
                    action="<?php echo e(route('radio.search')); ?>" method="post">
                    <div class="input-group">
                        <input type="text" name="term"
                            class="form-control rounded-0  rounded-0 bg-light border-0 small" placeholder="Rechercher..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <?php echo csrf_field(); ?>
                        <div class="input-group-append">
                            <button class="btn rounded-0  btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            
                            <th>Nome de la Radio</th>
                            
                            <th class="text-center"><?php echo e(__('sentence.Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $radios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $radio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                
                                <td><?php echo e($radio->radio_name); ?></td>
                                
                                
                                
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit diagnostic test')): ?>
                                        <a href="<?php echo e(url('radio/edit/' . $radio->id)); ?>"
                                            class="btn   btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete diagnostic test')): ?>
                                        <a class="btn   btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#DeleteModal" data-link="<?php echo e(url('radio/delete/' . $radio->id)); ?>"><i
                                                class="fa fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/u459899255/domains/rmili.myclinic.ma/public_html/resources/views/radio/specialty/dentiste/all.blade.php ENDPATH**/ ?>