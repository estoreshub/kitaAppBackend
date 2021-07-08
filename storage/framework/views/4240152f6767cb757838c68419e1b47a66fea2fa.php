<?php $__env->startSection('title', 'Endless - Premium Laravel Admin Template'); ?>
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
    <li class="breadcrumb-item active">Kids</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12" style="text-align: right">
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" style="color: white !important;border: 2px solid #2494d3 !important;background-color: #2596d3 !important;"> Add New</button>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm-12">
                
                <div class="col-sm-12">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <td style="font-weight: bold;">First Name</td>
                                <td style="font-weight: bold;">Last Name</td>
                                <td style="font-weight: bold;">Year</td>
                                <td style="font-weight: bold;">Parent Type</td>
                                <td style="font-weight: bold;">Parent</td>
                                <td style="font-weight: bold;">Group</td>
                                <td style="text-align: center;width:20%;font-weight: bold;">Action</td>
                            </tr>
                        </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#example').DataTable({
                "ajax": {
                    "url": "/getKidDetails",
                    "type": "post",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "first_name"
                    },
                    {
                        "data": "last_name"
                    },
                    {
                        "data": "year"
                    },
                    {
                        "data": "parent_type"
                    },
                    {
                        "data": "parent_id"
                    },
                    {
                        "data": "group_id"
                    }
                ],
                "columnDefs": [{
                    "targets": 6,
                    "name": "parent_id",
                    "data": "id",
                    "width": "60%",
                    "render": function(data, type, full, meta) {
                        return "<table class=\"custormize-table\" style=\"float:right;\"><tr><td><button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModale\" onclick=\"setNid(" +
                            data +
                            ")\" > <i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Update</button></td><td><button type=\"button\" onclick=\"deleteConfirm(" +data +")\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i>Delete</button></form></td></tr></table>";
                    },
                    "title": "parentID",
                    "orderable": true,
                    "searchable": true
                }]
            });
        });

        function setNid(val) {
            document.getElementById("k_id").value = val;

            myObj = {
                "_token": "<?php echo csrf_token(); ?>",
                "kid_id": document.getElementById("k_id").value
            }

            $.ajax({
                type: 'POST',
                url: '/getKidsData',
                data: myObj,
                success: function(data) {
                    var jsonObj = JSON.parse(data);
                    document.getElementById("fnames").value = jsonObj.first_name;
                    document.getElementById("lnames").value = jsonObj.last_name;
                    document.getElementById("years").value = jsonObj.year;
                    document.getElementById("typess").value = jsonObj.parent_type;
                    document.getElementById("parentss").value = jsonObj.parent_id;
                    document.getElementById("groupss").value = jsonObj.group_id;
                }
            });
        }

        function deleteConfirm(id) {
            document.getElementById("kids_id").value = id;
            $('#myModalDelete').modal('show');
        }

    </script>

    
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="border-radius: 1rem;width: 650px;">
                <div class="modal-header  modal-header-new">
                    <h3>Add New Kid</h3>
                    <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/addNewKid">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon  modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/identity.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="fname" id="fname"
                                        placeholder="Enter first Name" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/identity.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="lname" id="lname"
                                        placeholder="Enter Last Name" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/calendar.png')); ?>" alt=""></span>
                                    <input type="number" class="form-control modal-input" name="year" id="year"
                                        placeholder="Enter Year" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/customer-behavior.png')); ?>" alt=""></span>
                                    <select class="form-control modal-input" name="types" id="types" required >
                                        <option value="0">select parent type</option>
                                        <option value="1">Mother</option>
                                        <option value="2">Father</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/parents.png')); ?>" alt=""></span>
                                    <select class="form-control modal-input" name="parents" id="parents" required >
                                        <option value="0">select parent</option>
                                        <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($pr->id); ?>"><?php echo e($pr->first_name); ?>

                                                <?php echo e($pr->last_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/group.png')); ?>" alt=""></span>
                                    <select class="form-control modal-input" name="groups" id="groups" required >
                                        <option value="0">select group</option>
                                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($gr->id); ?>"><?php echo e($gr->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
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
    


    
    <div id="myModale" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="border-radius: 1rem;width: 650px;">
                <div class="modal-header modal-header-new">
                    <h3>Edit Kid Details</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/editKid">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">First Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/identity.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="fnames" id="fnames"
                                        placeholder="Enter first Name" required />
                                    <input type="hidden" name="k_id" id="k_id" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Last Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/identity.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="lnames" id="lnames"
                                        placeholder="Enter Last Name" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Year</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/calendar.png')); ?>" alt=""></span>
                                    <input type="number" class="form-control modal-input" name="years" id="years"
                                        placeholder="Enter Year" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Parent Type</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/customer-behavior.png')); ?>" alt=""></span>
                                    <select class="form-control modal-input" name="typess" id="typess" required >
                                        <option value="0">select type</option>
                                        <option value="1">Mother</option>
                                        <option value="2">Father</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Parent</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/parents.png')); ?>" alt=""></span>
                                    <select class="form-control modal-input" name="parentss" id="parentss" required >
                                        <option value="0">select parent</option>
                                        <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($pr->id); ?>"><?php echo e($pr->first_name); ?>

                                                <?php echo e($pr->last_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Group</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/group.png')); ?>" alt=""></span>
                                    <select class="form-control modal-input" name="groupss" id="groupss" required >
                                        <option value="0">select group</option>
                                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($gr->id); ?>"><?php echo e($gr->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group " style="float:right;">
                            <button class="btn btn-success" type="submit">Add </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    

            
    <!-- Modal HTML -->
<div id="myModalDelete" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
            			<div class="modal-header flex-column delet-modal-header">
            				<h4 class="modal-title w-100 delete-modal-header-text">Are you sure?</h4>
            			</div>
            			<div class="modal-body">
            				<p class="delete-modal-header-body">Do you really want to delete these records? This process cannot be undone.</p>
            			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="/deleteKid" method="GET">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="kids_id" id="kids_id">
				<button type="submit" class="btn btn-danger">Delete</button>
                </form>
			</div>
		</div>
	</div>
</div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Fiverr Projects\Dilshan\web\Lahiru\kitaAppBackend\resources\views/kita/kid_add.blade.php ENDPATH**/ ?>