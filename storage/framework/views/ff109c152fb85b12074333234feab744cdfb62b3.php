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
    <li class="breadcrumb-item active">Parents</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12" style="text-align: right">
                <button type="button" class="btn btn-primary btn-md add-new-button" data-toggle="modal" data-target="#myModal" style="color: white !important;border: 2px solid #2494d3 !important;background-color: #2596d3 !important;"> Add New</button>
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
                                <td style="font-weight: bold;">Email</td>
                                <td style="font-weight: bold;">Telephone</td>
                                <td style="font-weight: bold;">Parent Type</td>
                                <td style="font-weight: bold;">Notification Access</td>
                                <td style="font-weight: bold;">Email Allow</td>
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
                    "url": "/getParentDetails",
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
                        "data": "email"
                    },
                    {
                        "data": "telephone"
                    },
                    {
                        "data": "parent_type"
                    },
                    {
                        "data": "notification_access"
                    },
                    {
                        "data": "email_allow"
                    }
                ],
                "columnDefs": [{
                    "targets": 7,
                    "name": "parent_id",
                    "data": "id",
                    "width": "60%",
                    "render": function(data, type, full, meta) {
                        return "<table class=\"custormize-table\" style=\"float:right;\"><tr><td><button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModale\" onclick=\"setNid(" +
                            data +
                            ")\" > <i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Update</button></td><td><button type=\"button\" onclick=\"deleteConfirm(" +data +")\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i>Delete</button></td></tr></table>";
                    },
                    "title": "parentID",
                    "orderable": true,
                    "searchable": true
                }]
            });
        });

        function setNid(val) {
            document.getElementById("pa_id").value = val;

            myObj = {
                "_token": "<?php echo csrf_token(); ?>",
                "parent_id": document.getElementById("pa_id").value
            }

            $.ajax({
                type: 'POST',
                url: '/getParentData',
                data: myObj,
                success: function(data) {
                    var jsonObj = JSON.parse(data);
                    document.getElementById("fnames").value = jsonObj.first_name;
                    document.getElementById("lnames").value = jsonObj.last_name;
                    document.getElementById("emails").value = jsonObj.email;
                    document.getElementById("teles").value = jsonObj.telephone;
                    document.getElementById("typess").value = jsonObj.parent_type;
                    if (jsonObj.notification_access == 1) {
                        document.getElementById("notis").checked = true;
                    } else if (jsonObj.notification_access == 0) {
                        document.getElementById("notis").checked = false;
                    }

                    if (jsonObj.email_allow == 1) {
                        document.getElementById("emas").checked = true;
                    } else if (jsonObj.email_allow == 0) {
                        document.getElementById("emas").checked = false;
                    }
                }
            });
        }

        function deleteConfirm(id) {
            document.getElementById("parent_id").value = id;
            $('#myModalDelete').modal('show');
        }

    </script>

    
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="border-radius: 1rem;width: 650px;">
                <div class="modal-header modal-header-new">
                    <h3>Add New Parent</h3>
                    <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/addNewParent">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/identity.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="fname" id="fname"
                                        placeholder="Enter your First Name" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/identity.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="lname" id="lname"
                                        placeholder="Enter your Last Name" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/gmail.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="email" id="email"
                                        placeholder="Enter your Email" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/telephone.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="tele" id="tele"
                                        placeholder="Enter your Telephone" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/customer-behavior.png')); ?>" alt=""></span>
                                    <select class="form-control modal-input" name="types" id="types" required >
                                        <option value="0">select type</option>
                                        <option value="1">Mother</option>
                                        <option value="2">Father</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label" style="font-size;">Notification Access</label>
                            <input type="checkbox" id="noti" name="noti" required >
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label" style="font-size;">Email Allow</label>
                            <input type="checkbox" id="ema" name="ema" required >
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
                    <h3>Edit Parent Details</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/editParent">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Your First Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/identity.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="fnames" id="fnames"
                                        placeholder="Enter your First Name" required />
                                    <input type="hidden" name="pa_id" id="pa_id" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Your Last Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/identity.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="lnames" id="lnames"
                                        placeholder="Enter your Last Name" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Your Email</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/gmail.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="emails" id="emails"
                                        placeholder="Enter your Email" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Your Telephone</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/telephone.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="teles" id="teles"
                                        placeholder="Enter your Telephone" required />
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
                            <label for="name" class="cols-sm-2 control-label">Notification Access</label>
                            <input type="checkbox" id="notis" name="notis" required >
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Email Allow</label>
                            <input type="checkbox" id="emas" name="emas" required >
                        </div>

                        <div class="form-group " style="float:right;">
                            <button class="btn btn-success" type="submit">Update </button>
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
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="material-icons">&#xE5CD;</i>
				</div>
				<h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete these records? This process cannot be undone.</p>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="/deleteParent" method="GET">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="parent_id" id="parent_id">
				<button type="submit" class="btn btn-danger">Delete</button>
                </form>
			</div>
		</div>
	</div>
</div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Fiverr Projects\Dilshan\web\Lahiru\kitaAppBackend\resources\views/kita/parent_add.blade.php ENDPATH**/ ?>