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
    <li class="breadcrumb-item active">News</li>
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
                                <td style="width:20%;font-weight:bold;">Title</td>
                                <td style="width:20%;font-weight:bold;">Description</td>
                                <td style="width:20%;font-weight:bold;">Date</td>
                                <td style="width:20%;font-weight:bold;">Image</td>
                                <td style="text-align: center;width:20%;font-weight: bold;">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                        <tbody>
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
                    "url": "/getNewsDetails",
                    "type": "post",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "title"
                    },
                    {
                        "data": "description"
                    },
                    {
                        "data": "added_date"
                    }
                ],
                "columnDefs": [{
                        "targets": 3,
                        "name": "image",
                        "data": "image",
                        "render": function(data, type, full, meta) {
                            return "<img src=\"" + data + "\" height=\"100\" width=\"100\"/>";
                        },
                        "title": "Image",
                        "orderable": true,
                        "searchable": true
                    },
                    {
                        "targets": 4,
                        "name": "news_id",
                        "data": "id",
                        "width": "60%",
                        "render": function(data, type, full, meta) {
                            return "<table class=\"custormize-table\" style=\"float:right;\"><tr><td><button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModale\" onclick=\"setNid(" +
                                data +
                                ")\" > <i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Update</button></td><td><button type=\"button\" onclick=\"deleteConfirm(" +data +")\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i>Delete</button></form></td></tr></table>";
                        },
                        "title": "newsID",
                        "orderable": true,
                        "searchable": true
                    }
                ]
            });
        });

        function setNid(val) {
            document.getElementById("new_id").value = val;

            myObj = {
                "_token": "<?php echo csrf_token(); ?>",
                "news_id": document.getElementById("new_id").value
            }

            $.ajax({
                type: 'POST',
                url: '/getNewsData',
                data: myObj,
                success: function(data) {
                    var jsonObj = JSON.parse(data);
                    document.getElementById("newsImage").src = 'http://kitaapp.de.w01b7e22.kasserver.com' + jsonObj.image;
                    document.getElementById("titles").value = jsonObj.title;
                    document.getElementById("dess").value = jsonObj.description;
                    document.getElementById("mydates").value = jsonObj.added_date;
                }
            });
        }

        function deleteConfirm(id) {
            document.getElementById("news_id").value = id;
            $('#myModalDelete').modal('show');
        }

    </script>

    
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="border-radius: 1rem;width: 650px;">
                <div class="modal-header modal-header-new">
                    <h3>Add New News</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" enctype=multipart/form-data action="/addNewNews">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/tag.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="title" id="title"
                                        placeholder="Enter title" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/policy.png')); ?>" alt=""></span>
                                    <textarea id="des" name="des" class="form-control modal-input" rows="3" cols="50"
                                        placeholder="Enter description " required ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/schedule.png')); ?>" alt=""></span>
                                    <input class="form-control modal-input" type="date" id="mydate" name="mydate"
                                        placeholder="Select date" required >
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/image.png')); ?>" alt=""></span>
                                    <input accept=".jpg, .png, .jpeg" type="file" class="form-control modal-input" id="photos[]" name="photos[]" multiple required >
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
                    <h3>Edit News</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" enctype=multipart/form-data action="/editNews">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Title</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/tag.png')); ?>" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="titles" id="titles"
                                        placeholder="Enter title" required />
                                    <input type="hidden" name="new_id" id="new_id" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Description</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/policy.png')); ?>" alt=""></span>
                                    <textarea id="dess" name="dess" class="form-control modal-input" rows="3" cols="50"
                                        placeholder="Enter description" required ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Date</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/schedule.png')); ?>" alt=""></span>
                                    <input class="form-control modal-input" type="date" id="mydates" name="mydates"
                                        placeholder="Select date" required >
                                </div>
                            </div>
                        </div>
                        <div class="loading-image-background">
                        <img id="newsImage" alt="" style="width: 150px;height:150px;">
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Image</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="<?php echo e(asset('assets/images/auto-modal/image.png')); ?>" alt=""></span>
                                    <input accept=".jpg, .png, .jpeg" type="file" class="form-control modal-input" id="photoss[]" name="photoss[]" multiple
                                        required >
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
                <form action="/deleteNews" method="GET">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="news_id" id="news_id">
				<button type="submit" class="btn btn-danger">Delete</button>
                </form>
			</div>
		</div>
	</div>
</div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Fiverr Projects\Dilshan\web\Lahiru\kitaAppBackend\resources\views/kita/news_add.blade.php ENDPATH**/ ?>