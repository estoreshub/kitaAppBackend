new dashboard


<?php $__env->startSection('title', 'Endless - Premium Laravel Admin Template'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/chartist.css')); ?>">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
<!-- Plugins css Ends-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title', 'Default'); ?>
<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Default</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Container-fluid starts-->
<div class="container-fluid">

        <div class="row ui-sortable" id="draggableMultiple" style="text-align: center">
            <div class="col-sm-12 col-xl-6">
              <a href="/new-group">
                <div class="card">
                    <div class="card-header">
                      <h5>Groups</h5>
                    </div>
                  </div>
              </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-parent">
                    <div class="card">
                        <div class="card-header">
                          <h5>Parents</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-kid">
                    <div class="card">
                        <div class="card-header">
                          <h5>Kids</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-news">
                    <div class="card">
                        <div class="card-header">
                          <h5>News</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-meal">
                    <div class="card">
                        <div class="card-header">
                          <h5>Meals</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/block-boards">
                    <div class="card">
                        <div class="card-header">
                          <h5>Block Boards</h5>
                        </div>
                      </div>
                  </a>
            </div>

            <div class="col-sm-12 col-xl-6">
                <a href="/new-event">
                    <div class="card">
                        <div class="card-header">
                          <h5>Events / Messages</h5>
                        </div>
                      </div>
                  </a>
            </div>

            <div class="col-sm-12 col-xl-6">
                <a href="/new-register">
                    <div class="card">
                        <div class="card-header">
                          <h5>Attendance Register</h5>
                        </div>
                      </div>
                  </a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/htdocs/w01b7e22/27_03_2021/resources/views/kita/dashboard.blade.php ENDPATH**/ ?>