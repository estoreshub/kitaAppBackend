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
    <li class="breadcrumb-item active">Market Place/li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        
        <br>

        <div class="row">
            <div class="col-sm-12">
                
                <div class="col-sm-12">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <td style="font-weight:bold;">Title</td>
                            <td style="font-weight:bold;">Description</td>
                            <td style="font-weight:bold;">Images</td>
                            <td style="font-weight:bold;">Comments</td>
                            <td style="font-weight:bold;">Status</td>
                            <td style="font-weight:bold;">Action</td>
                        </tr>
                            </thead>
                        <?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ne): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tbody>
                            <tr>
                                <td><?php echo e($ne->title); ?></td>
                                <td><?php echo e($ne->description); ?></td>
                                <td>
                                    <?php $__currentLoopData = json_decode($ne->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $im): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img style="width:120px;height:120px;" src="<?php echo e($im->image); ?>"/><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td>
                                    <?php $__currentLoopData = json_decode($ne->comments); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    username - <?php echo e($com->username); ?> , comment - <?php echo e($com->comment); ?><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <?php if($ne->status == 1): ?>
                                    <td>available</td>
                                <?php endif; ?>
                                <?php if($ne->status == 0): ?>
                                    <td>sold out</td>
                                <?php endif; ?>
                                <td>
                                    <form action="/deleteBlock" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="bid" value="<?php echo e($ne->id); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </form>
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
		});
    </script>

    
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add New Group</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="/addNewGroup">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Group Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Group Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Description</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="des" id="des"
                                        placeholder="Enter Description" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Color</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="color" id="color"
                                        placeholder="Enter Color Code" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Image</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="file" class="form-control" id="photos[]" name="photos[]" multiple required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button class="btn btn-success" type="submit">Add </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    


    
    <div id="myModale" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Edit Group</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="/editGroup">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Group Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="names" id="names"
                                        placeholder="Enter Group Name" />
                                    <input type="hidden" name="gr_id" id="gr_id" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Description</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="dess" id="dess"
                                        placeholder="Enter Description" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Color</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="colors" id="colors"
                                        placeholder="Enter Color Code" />
                                </div>
                            </div>
                        </div>

                        <img id="groupImage" alt="" style="width: 150px;height:150px;">

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Image</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="file" class="form-control" id="photoss[]" name="photoss[]" multiple
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button class="btn btn-success" type="submit">Update </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dilshan/Documents/freelance/epit_de/backEnd/kitaAppBackend/resources/views/kita/block_boards.blade.php ENDPATH**/ ?>
