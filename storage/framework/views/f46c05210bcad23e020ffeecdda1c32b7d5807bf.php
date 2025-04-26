<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.New Prescription')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphe</title>
</head>
<body>
<style>
    .point-marker {
        width: 10px;
        height: 10px;
        background-color: red;
        border-radius: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
    }
    .chart-container {
        position: relative;
        max-width:1000px;
        max-height: 1000px;
    }
</style>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Patient informations')); ?></h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="PatientID"><?php echo e(__('sentence.Patient')); ?> :</label>
                        <select class="form-control multiselect-doctorino" name="user_id" id="user_id">
                            <option value="<?php echo e($patient->id); ?>">
                                <?php echo e($patient->name); ?>

                            </option>
                        </select>
                        <?php echo e(csrf_field()); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.graph')); ?></h6>

                </div>
                <div class="card-body">
                    <fieldset class="drugs_labels">
                        <div class="chart-container">
                            <?php $__currentLoopData = $gras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e(asset('img/graph/' . $gra->image.".png")); ?>" id="chart-image" style="max-width: 1000px; border: 1px solid #ddd; padding: 10px; border-radius: 5px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);" />
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $statistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statistic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="hidden" name="graph_id" id="graph_id" value="<?php echo e($statistic->graph_id); ?>">
                                    <div class="point point-marker" style="left: <?php echo e($statistic->x); ?>px; top: <?php echo e($statistic->y); ?>px; background-color: red;" data-point-id="<?php echo e($statistic->id); ?>">

                                        <button class="delete-btn" data-point-id="<?php echo e($statistic->id); ?>">effacer</button>
                                    </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </fieldset>
                </div>
                    <input type="hidden" name="x" id="x">
                    <input type="hidden" name="y" id="y">
            </div>
        </div>
    </div>


<script>
    $(document).ready(function() {
        $('#chart-image').click(function (event) {
            console.log('hey');
            var x = event.pageX - $(this).offset().left;
            var y = event.pageY - $(this).offset().top;


            var pointElement = $('<div class="point-marker"></div>');

            pointElement.css({
                left: x + 'px',
                top: y + 'px',
            })
            $('.chart-container').append(pointElement);

            $('#x').val(x);
            $('#y').val(y);
            var user_id = $('#user_id').val();
            var graph_id = $('#graph_id').val();
            console.log(graph_id);
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('point-save')); ?>',
                data: { x: x, y: y, user_id : user_id ,graph_id : graph_id, _token: '<?php echo e(csrf_token()); ?>' },
                success: function (data) {
                    alert("vous avez bien ajoute le point");
                },
                error: function (error) {
                    alert('Error occurred while saving the point.');
                }
            });
        });

    });
    $(document).on('click', '.point-marker', function() {
        $(this).remove();
        $('#x').val('');
        $('#y').val('');
    });
</script>
<script>
    $(document).on('click', '.delete-btn', function (event) {
        event.stopPropagation();
        var pointId = $(this).data('point-id');
        console.log(pointId);
        $.ajax({
            type: 'POST',
            url: '/delete-point',
            data: { pointId: pointId, _token: '<?php echo e(csrf_token()); ?>' },
            success: function (data) {
                $('.point[data-point-id="' + pointId + '"]').remove();
                alert(data.message);
            },
            error: function (error) {
                alert("Une erreur s'est produite lors de la suppression du point.");
            }
        });
    });
</script>

</body>
<style>

</style>
</html>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>



<style>
    .point-marker {
        width: 7px;
        height: 7px;
        background-color: red;
        border-radius: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
    }
    .chart-container {
        position: relative;
        max-width:1000px;
        max-height: 1000px;
    }
    .delete-btn {
        font-size: 8px;
        padding: 3px 8px;
        border: none;
        border-radius: 5px;
        background-color: #dc3545;
        color: white;
        cursor: pointer;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Admin\Documents\GitHub\doctor\resources\views/graph/edit.blade.php ENDPATH**/ ?>