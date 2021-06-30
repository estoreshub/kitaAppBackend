<?php $__env->startSection('title', 'Endless - Premium Laravel Admin Template'); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/chartist.css')); ?>">
	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('assets/css/jquery-te-1.4.0.css')); ?>">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
    <!-- Plugins css Ends-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title', 'Default'); ?>
<?php $__env->startSection('breadcrumb-items'); ?>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Parent Feedbacks</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row" style="text-align: right">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i
                        class="fa fa-plus" aria-hidden="true"></i> Add New</button>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-12">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Page Name</td>
                            <td>Page Content</td>
							<td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="width: 250px !important;height: 100px !important;"></td>
							<td></td>
                        </tr>
                    </tbody>
                </table>
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
	<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-te-1.4.0.min.js')); ?>" charset="utf-8"></script>

    <script>
        //$('.jqte-test').jqte();

        // settings of status
        var jqteStatus = true;
        console.log('aaa = ' + JSON.stringify($('.jqte-test').jqte()));
        $(".status").click(function() {
            jqteStatus = jqteStatus ? false : true;
            $('.jqte-test').jqte({
                "status": jqteStatus
            })
        });

    </script>

    <script>
        $(document).ready(function() {
			$("textarea").jqte();
			
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#example').DataTable({
                "ajax": {
                    "url": "/getHtmlPages",
                    "type": "post",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id"
                    }, {
                        "data": "page_name"
                    },
                   {
                        "data": "page_content"
                    },
                ],
							"columnDefs": [
                    {
                        "targets": 3,
                        "name": "page_id",
                        "data": "id",
                        "render": function(data, type, full, meta) {
                            return "<table><tr><button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModalE\" onclick=\"setNid(" +
                                data +
                                ")\" > <i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Update</button></tr></table>";
                        },
                        "title": "page_id",
                        "orderable": true,
                        "searchable": true
                    }
                ]
            });
        });
		
		function setNid(val) {
            

            document.getElementById("page_id").value = val;

            myObj = {
                "_token": "<?php echo csrf_token(); ?>",
                "page_id": document.getElementById("page_id").value
            }

            $.ajax({
                type: 'POST',
                url: '/getPageContent',
                data: myObj,
                success: function(data) {
                    var jsonObj = JSON.parse(data);
                    document.getElementById("pageNameU").value = jsonObj.page_name;
                    document.getElementById("pageContentU").value = jsonObj.page_content;
                }
            });
        }

    </script>

        
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add New Page</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/addNewHTML" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Page Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="pageName" id="pageName"
                                        placeholder="Enter your Page Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Content</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <textarea id="pageContent" name="pageContent" class="jqte-test"></textarea>
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
    

    
    <div id="myModalE" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Edit Page Content</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/editHTMLContent" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Page Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="pageNameU" id="pageNameU"
                                        placeholder="Enter your Page Name" />
									<input type="hidden" name="page_id" id="page_id" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Content</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <textarea id="pageContentU" name="pageContentU" class="jqte-test"></textarea>
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

<?php echo $__env->make('layouts_admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/htdocs/w01b7e22/27_03_2021/resources/views/admin/html_pages.blade.php ENDPATH**/ ?>