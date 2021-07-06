new dashboard


<?php $__env->startSection('title', 'Kiga - App'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/chartist.css')); ?>">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/kita-app-user.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/ui-changes.css')); ?>">
<!-- Plugins css Ends-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item active">Dashboard</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Container-fluid starts-->
<div class="container-fluid">

        <div class="row ui-sortable" id="draggableMultiple" style="text-align: center">
            <div class="col-sm-12 col-xl-6">
              <a href="/new-group">
                <div class="card div-topics" style="background-color: cadetblue !important;">
                    <div class="card-padding">
                     <img class="topic-board-image" src="<?php echo e(asset('assets/images/kita-user/age-group.png')); ?>" alt="">
                      <h5 class="card-inner">Groups</h5>
                    </div>
                  </div>
              </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-parent">
                    <div class="card div-topics" style="background-color: palevioletred !important;">
                        <div class="card-padding">
                       <img class="topic-board-image" src="<?php echo e(asset('assets/images/kita-user/parents.png')); ?>" alt="">
                          <h5 class="card-inner">Parents</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-kid">
                    <div class="card div-topics" style="background-color: salmon !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="<?php echo e(asset('assets/images/kita-user/boy.png')); ?>" alt="">
                          <h5 class="card-inner">Kids</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-news">
                    <div class="card div-topics" style="background-color: darkseagreen !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="<?php echo e(asset('assets/images/kita-user/newspaper.png')); ?>" alt="">
                          <h5 class="card-inner">News</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-meal">
                    <div class="card div-topics" style="background-color: turquoise !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="<?php echo e(asset('assets/images/kita-user/breakfast.png')); ?>" alt="">
                          <h5 class="card-inner">Meals</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/block-boards">
                    <div class="card div-topics" style="background-color: steelblue !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="<?php echo e(asset('assets/images/kita-user/shopping-cart.png')); ?>" alt="">
                          <h5 class="card-inner">Market Place</h5>
                        </div>
                      </div>
                  </a>
            </div>

            <div class="col-sm-12 col-xl-6">
                <a href="/new-event">
                    <div class="card div-topics" style="background-color: deepskyblue !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="<?php echo e(asset('assets/images/kita-user/chat.png')); ?>" alt="">
                          <h5 class="card-inner">Events / Messages</h5>
                        </div>
                      </div>
                  </a>
            </div>

            <div class="col-sm-12 col-xl-6">
                <a href="/new-register">
                    <div class="card div-topics" style="background-color: slategray !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="<?php echo e(asset('assets/images/kita-user/attendance.png')); ?>" alt="">
                          <h5 class="card-inner">Attendance Register</h5>
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

<<<<<<< HEAD:storage/framework/views/13e353a1a552bb12f3a99d6754b24707f6350abc.php
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Fiverr Projects\Dilshan\web\Lahiru\kitaAppBackend\resources\views/kita/dashboard.blade.php ENDPATH**/ ?>
=======
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dilshan/Documents/freelance/epit_de/backEnd/kitaAppBackend/resources/views/kita/dashboard.blade.php ENDPATH**/ ?>
>>>>>>> 171800079e09c216be6133b56bd9ed32e1714677:storage/framework/views/67e995f39cc58ee6f71553a5d5ca23f8aff2251e.php
