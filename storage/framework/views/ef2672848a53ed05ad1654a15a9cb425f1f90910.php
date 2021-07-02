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
    <li class="breadcrumb-item active">Groups</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12" style="text-align: right">
                <button type="button" class="btn btn-primary btn-md add-button" data-toggle="modal" data-target="#myModal" style="color: white !important;border: 2px solid #2494d3 !important;background-color: #2596d3 !important;"> Add New</button>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm-12">
                
                <div class="col-sm-12">
                    <table id="example" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:20%;">Group Name</th>
                                <th style="width:20%;">Description</th>
                                <th style="width:20%;">Color Code</th>
                                <th style="width:20%;">Image</th>
                                <th style="width:20%;float:right;margin-right:7rem">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
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
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#example').DataTable({
                "ajax": {
                    "url": "/getGroupDetails",
                    "type": "post",
                    "dataSrc": ""
                },
                "columns": [{
                    "data": "name"
                }, {
                    "data": "description"
                }, ],
                "columnDefs": [{
                        "targets": 2,
                        "name": "color",
                        "data": "color",
                        "render": function(data, type, full, meta) {
                            return "<p style=\"background-color:" + data + "\;color:" + data +
                                "\" >" + data + "</p>";
                        },
                        "title": "Color",
                        "orderable": true,
                        "searchable": true
                    },
                    {
                        "targets": 3,
                        "name": "image",
                        "data": "image",
                        "render": function(data, type, full, meta) {
                            return "<div style=\"width:200px;justify-content:center\"><img src=\"" + data + "\" height=\"100\" width=\"100\"/></div>";
                        },
                        "title": "Image",
                        "orderable": true,
                        "searchable": true
                    }, {
                        "targets": 4,
                        "name": "group_id",
                        "data": "id",
                        "render": function(data, type, full, meta) {
                            return "<table  style=\"float:right;\"><tr><td><button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModale\" onclick=\"setNid(" +
                                data +
                                ")\" > <i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Update</button></td><td><form action=\"deleteGroup\" method=\"GET\"><input type=\"hidden\" name=\"group_id\" id=\"group_id\" value=" +
                                data +
                                "><button type=\"submit\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i>Delete</button></form></td></tr></table>";
                        },
                        "title": "Image",
                        "orderable": true,
                        "searchable": true
                    }
                ]
            });
        });

        function setNid(val) {
            document.getElementById("gr_id").value = val;

            myObj = {
                "_token": "<?php echo csrf_token(); ?>",
                "group_id": document.getElementById("gr_id").value
            }

            $.ajax({
                type: 'POST',
                url: '/getGroupData',
                data: myObj,
                success: function(data) {
                    var jsonObj = JSON.parse(data);
                    document.getElementById("groupImage").src = 'http://kitaapp.de.w01b7e22.kasserver.com' + jsonObj.image;
                    document.getElementById("names").value = jsonObj.name;
                    document.getElementById("dess").value = jsonObj.description;
                    document.getElementById("colors").value = jsonObj.color;
                }
            });
        }

    </script>

    
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="border-radius: 1rem;width: 650px;">
                <div class="modal-header modal-header-new">
                    <h3>Add New Group</h3>
                    <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="/addNewGroup">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="name" id="name"
                                        placeholder="Enter Group Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-sticky-note" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="des" id="des"
                                        placeholder="Enter Description" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-crosshairs" aria-hidden="true"></i></span>
                                    
                                    <input type="color" class="form-control modal-input" id="color" name="color" value="#ff0000"
                                        placeholder="Enter Color Code">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                    <input type="file" class="form-control modal-input" id="photos[]" name="photos[]" multiple>
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
                                    <span class="input-group-addon modal-icon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="names" id="names"
                                        placeholder="Enter Group Name" />
                                    <input type="hidden" name="gr_id" id="gr_id" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Description</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-sticky-note" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="dess" id="dess"
                                        placeholder="Enter Description" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Color</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-crosshairs" aria-hidden="true"></i></span>
                                    
                                    <input type="color" class="form-control modal-input" id="colors" name="colors" value="#ff0000"
                                        placeholder="Enter Color Code">
                                </div>
                            </div>
                        </div>
                        <div class="loading-image-background">
                        <img id="groupImage" alt="" style="width: 150px;height:150px;">
                        </div>


                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Image</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                    <input type="file" class="form-control modal-input" id="photoss[]" name="photoss[]" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="form-group " style="float:right;">
                            <button class="btn btn-success" type="submit">Update </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dilshan/Documents/freelance/epit_de/backEnd/kitaAppBackend/resources/views/kita/group_add.blade.php ENDPATH**/ ?>