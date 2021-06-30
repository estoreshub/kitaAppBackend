<!-- Page Sidebar Start-->
<div class="page-sidebar">
  <div class="main-header-left d-none d-lg-block">
    <div class="logo-wrapper"><a href="<?php echo e(route('/')); ?>"><img src="<?php echo e(asset('assets/images/endless-logo.png')); ?>" alt=""></a></div>
  </div>
  <div class="sidebar custom-scrollbar">
    <div class="sidebar-user text-center">
      <div><img class="img-60 rounded-circle" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="#">
        <div class="profile-edit"><a href="edit-profile" target="_blank"><i data-feather="edit"></i></a></div>
      </div>
      <h6 class="mt-3 f-14"><?php echo e(Session::get('loggedUserName')); ?></h6>
      
    </div>
    <ul class="sidebar-menu">

      

      <li class="">
        <a class="sidebar-header" href="#"><i data-feather="home"></i><span>Dashboard</span>
          <i class="fa fa-angle-right pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
         <li><a href="/parent-feedbacks"><i class="fa fa-circle"></i>Parent Feedbacks</a></li>
			<li><a href="/html-pages"><i class="fa fa-circle"></i>HTML Pages</a></li>
        </ul>
      </li>

      
    </ul>
  </div>
</div>
<!-- Page Sidebar Ends-->
<!-- Right sidebar Start-->
<div class="right-sidebar" id="right_side_bar">
  <div>
    <div class="container p-0">
      <div class="modal-header p-l-20 p-r-20">
        <div class="col-sm-8 p-0">
          <h6 class="modal-title font-weight-bold">FRIEND LIST</h6>
        </div>
        <div class="col-sm-4 text-right p-0"><i class="mr-2" data-feather="settings"></i></div>
      </div>
    </div>
    <div class="friend-list-search mt-0">
      <input type="text" placeholder="search friend"><i class="fa fa-search"></i>
    </div>
    <div class="p-l-30 p-r-30">
      <div class="chat-box">
        <div class="people-list friend-list">
          <ul class="list">
            <li class="clearfix"><img class="rounded-circle user-image" src="<?php echo e(asset('assets/images/user/1.jpg')); ?>" alt="">
              <div class="status-circle online"></div>
              <div class="about">
                <div class="name">Vincent Porter</div>
                <div class="status"> Online</div>
              </div>
            </li>
            <li class="clearfix"><img class="rounded-circle user-image" src="<?php echo e(asset('assets/images/user/2.png')); ?>" alt="">
              <div class="status-circle away"></div>
              <div class="about">
                <div class="name">Ain Chavez</div>
                <div class="status"> 28 minutes ago</div>
              </div>
            </li>
            <li class="clearfix"><img class="rounded-circle user-image" src="<?php echo e(asset('assets/images/user/8.jpg')); ?>" alt="">
              <div class="status-circle online"></div>
              <div class="about">
                <div class="name">Kori Thomas</div>
                <div class="status"> Online</div>
              </div>
            </li>
            <li class="clearfix"><img class="rounded-circle user-image" src="<?php echo e(asset('assets/images/user/4.jpg')); ?>" alt="">
              <div class="status-circle online"></div>
              <div class="about">
                <div class="name">Erica Hughes</div>
                <div class="status"> Online</div>
              </div>
            </li>
            <li class="clearfix"><img class="rounded-circle user-image" src="<?php echo e(asset('assets/images/user/5.jpg')); ?>" alt="">
              <div class="status-circle offline"></div>
              <div class="about">
                <div class="name">Ginger Johnston</div>
                <div class="status"> 2 minutes ago</div>
              </div>
            </li>
            <li class="clearfix"><img class="rounded-circle user-image" src="<?php echo e(asset('assets/images/user/6.jpg')); ?>" alt="">
              <div class="status-circle away"></div>
              <div class="about">
                <div class="name">Prasanth Anand</div>
                <div class="status"> 2 hour ago</div>
              </div>
            </li>
            <li class="clearfix"><img class="rounded-circle user-image" src="<?php echo e(asset('assets/images/user/7.jpg')); ?>" alt="">
              <div class="status-circle online"></div>
              <div class="about">
                <div class="name">Hileri Jecno</div>
                <div class="status"> Online</div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Right sidebar Ends-->
<?php /**PATH /www/htdocs/w01b7e22/27_03_2021/resources/views/layouts_admin/sidebar.blade.php ENDPATH**/ ?>