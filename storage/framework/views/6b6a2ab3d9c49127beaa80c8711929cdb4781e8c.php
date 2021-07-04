<?php $__env->startSection('title', 'Kiga - App'); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/chartist.css')); ?>">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/ui-changes.css')); ?>">
    <!-- Plugins css Ends-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Meal Plans</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid">



         <div class="add-kids-event-section">
         <div class="col-sm-2 add-new-event-topic" style="text-align: left">
                                                                   Add Meal Items
                                                               </div>
         <div class="row">
                     <div class="col-sm-12" style="text-align: right">
                         <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModale" style="color: white !important;border: 2px solid #2494d3 !important;background-color: #2596d3 !important;"> Add New</button>
                     </div>
                 </div>

         <div class="row" style="text-align: center;">

                     <div class="col-sm-12">
                         <h2 style="color: #2696d3;">Add New Meal</h2>
                         <form action="/addItems" method="POST">
                             <?php echo csrf_field(); ?>
                             <input type="text" name="itemName" class="modal-input">
                             <button type="submit"  class="drop-down-add-btn" >Add Items</button>
                         </form>
                         <br>

                         <table id="example2" class="display" style="width:100%">
                             <thead>
                                 <tr>
                                     <td>item name</td>
                                 </tr>
                             </thead>
                             <?php $__currentLoopData = $itemDataArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tbody>
                                     <tr>
                                         <td><?php echo e($it['name']); ?></td>
                                     </tr>
                                 </tbody>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </table>
                     </div>
                 </div>
         </div>


        <br>

        <div class="row add-kids-event-section">
        <div class="col-sm-12 add-new-event-topic" style="text-align: left;    padding-bottom: 1rem;">
                                                Existing Meal List
                                            </div>
            <div class="col-sm-12">
                
                <div class="col-sm-12">
                    <table class="custormize" id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <td style="width:30%">Date</td>
                                <td style="width:30%">Items</td>
                                <td style="width:40%">Action</td>
                            </tr>
                        </thead>
                        <?php $__currentLoopData = $meals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody>
                                <tr>
                                    <td><?php echo e($ne->added_date); ?></td>
                                    <td>
                                        <?php $__currentLoopData = json_decode($ne->items); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($it->name); ?><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <button onclick="setNid(<?php echo e($ne->id); ?>)" type="button"
                                                        class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#myModaledit"><i class="fa fa-pencil-square-o"
                                                            aria-hidden="true"></i> Update</button>
                                                </td>
                                                <td>
                                                    <form action="/deleteMeal" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="meal_id" id="meal_id"
                                                            value="<?php echo e($ne->id); ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-trash" aria-hidden="true"></i>
                                                            Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Container-fluid Ends-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/chartist/chartist.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/knob/knob.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/chart/knob/knob-chart.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/prism/prism.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/clipboard/clipboard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom-card/custom-card.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/notify/bootstrap-notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dashboard/default.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/notify/index.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/height-equal.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();
        });

    </script>

    
    <div id="myModale" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content"  style="border-radius: 1rem;width: 650px;">
                <div class="modal-header modal-header-new"">
                    <h3>Add New Meal</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/addNewMeal">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Date</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-envelope fa"
                                            aria-hidden="true"></i></span>
                                    <input class="form-control modal-input" type="date" id="mydate" name="mydate"
                                        placeholder="Select date">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Items</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <div style="color: black;font-weight: bold; width: 90%;" id="newInput">
                                        <table border="1" style="width: 91%;">
                                            <tr>
                                                <td style="background-color: #bdbdbd;
                                                               text-align: center;">Item name</td>
                                            </tr>
                                            <?php $__currentLoopData = $itemDataArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr style="text-align: center;">
                                                    <td><?php echo e($it['name']); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group register-button">
                            <button class="btn btn-success" type="submit">Add </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    

    
    <div id="myModaledit" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Update Meal</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/addNewMeal">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Date</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa"
                                            aria-hidden="true"></i></span>
                                    <input class="form-control" type="date" id="mydate" name="mydate"
                                        placeholder="Select date">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Items</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <div style="color: black;font-weight: bold;" id="newInput">
                                        <table border="1">
                                            <tr>
                                                <td>item name</td>
                                            </tr>
                                            <?php $__currentLoopData = $itemDataArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($it['name']); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button class="btn btn-success" type="button">Update </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dilshan/Documents/freelance/epit_de/backEnd/kitaAppBackend/resources/views/kita/meal_add.blade.php ENDPATH**/ ?>
