{{--
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

	<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Website CSS style -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script>-->
    <!--<link rel="stylesheet" href="{{ asset('css/app.css') }}">-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->

    <!-- Website Font style -->

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <title>Admin</title>
</head>

<body>

	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-2"></div>
			<div class="col-sm-2"></div>
			<div class="col-sm-2"></div>
			<div class="col-sm-2"></div>
			<div class="col-sm-2"></div>
			<div class="col-sm-2">
			<h2><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Session::get('loggedUserName') }} </h2>
	<form action="/logout" method="POST">
                @csrf
                <button type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
            </form>
				<br>
			</div>
		</div>
	</div>


		<div class="row" style="text-align:center;">
			<div class="col-sm-12">
				<div class="col-sm-3">
					<div class="panel panel-primary">
  					<a href="/new-group"><div style="background-color:#2c2c61;color:white;font-weight:bold;" class="panel-body">add new group</div></a>
					</div>
				</div>
				<div class="col-sm-3">
				<div class="panel panel-primary">
  					<a href="/new-parent"><div class="panel-body" style="background-color:#2c2c61;color:white;font-weight:bold;">add new parent</div></a>
					</div>
				</div>
				<div class="col-sm-3">
				<div class="panel panel-primary">
  					<a href="/new-kid"><div class="panel-body" style="background-color:#2c2c61;color:white;font-weight:bold;">add new kid</div></a>
					</div>
				</div>
				<div class="col-sm-3">
				<div class="panel panel-primary">
  					<a href="/new-news"><div class="panel-body" style="background-color:#2c2c61;color:white;font-weight:bold;">add new News</div></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="text-align:center;">
			<div class="col-sm-12">
				<div class="col-sm-3">
				<div class="panel panel-primary">
  					<a href="/new-meal"><div class="panel-body" style="background-color:#2c2c61;color:white;font-weight:bold;">add new Meal</div></a>
					</div>
				</div>
				<div class="col-sm-3">
				<div class="panel panel-primary">
  					<a href="/block-boards"><div class="panel-body" style="background-color:#2c2c61;color:white;font-weight:bold;">View Block Boards</div></a>
					</div>
				</div>
				<div class="col-sm-3">
				<div class="panel panel-primary">
  					<a href="/new-event"><div class="panel-body" style="background-color:#2c2c61;color:white;font-weight:bold;">Add New Event/Message</div></a>
					</div>
				</div>
				<div class="col-sm-3">
				<div class="panel panel-primary">
  					<a href="/new-register"><div class="panel-body" style="background-color:#2c2c61;color:white;font-weight:bold;">Check Attendance Register</div>
					</a></div>
				</div>
			</div>
		</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html> --}}

new dashboard

@extends('layouts.master')
@section('title', 'Endless - Premium Laravel Admin Template')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist.css')}}">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/kita-app-user.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ui-changes.css') }}">
<!-- Plugins css Ends-->
@endsection

@section('breadcrumb-title', 'Home')
@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">

        <div class="row ui-sortable" id="draggableMultiple" style="text-align: center">
            <div class="col-sm-12 col-xl-6">
              <a href="/new-group">
                <div class="card div-topics" style="background-color: cadetblue !important;">
                    <div class="card-padding">
                     <img class="topic-board-image" src="{{asset('assets/images/kita-user/age-group.png')}}" alt="">
                      <h5 class="card-inner">Groups</h5>
                    </div>
                  </div>
              </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-parent">
                    <div class="card div-topics" style="background-color: palevioletred !important;">
                        <div class="card-padding">
                       <img class="topic-board-image" src="{{asset('assets/images/kita-user/parents.png')}}" alt="">
                          <h5 class="card-inner">Parents</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-kid">
                    <div class="card div-topics" style="background-color: salmon !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="{{asset('assets/images/kita-user/boy.png')}}" alt="">
                          <h5 class="card-inner">Kids</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-news">
                    <div class="card div-topics" style="background-color: darkseagreen !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="{{asset('assets/images/kita-user/newspaper.png')}}" alt="">
                          <h5 class="card-inner">News</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/new-meal">
                    <div class="card div-topics" style="background-color: turquoise !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="{{asset('assets/images/kita-user/breakfast.png')}}" alt="">
                          <h5 class="card-inner">Meals</h5>
                        </div>
                      </div>
                  </a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <a href="/block-boards">
                    <div class="card div-topics" style="background-color: steelblue !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="{{asset('assets/images/kita-user/shopping-cart.png')}}" alt="">
                          <h5 class="card-inner">Market Place</h5>
                        </div>
                      </div>
                  </a>
            </div>

            <div class="col-sm-12 col-xl-6">
                <a href="/new-event">
                    <div class="card div-topics" style="background-color: deepskyblue !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="{{asset('assets/images/kita-user/chat.png')}}" alt="">
                          <h5 class="card-inner">Events / Messages</h5>
                        </div>
                      </div>
                  </a>
            </div>

            <div class="col-sm-12 col-xl-6">
                <a href="/new-register">
                    <div class="card div-topics" style="background-color: slategray !important;">
                        <div class="card-padding">
                         <img class="topic-board-image" src="{{asset('assets/images/kita-user/attendance.png')}}" alt="">
                          <h5 class="card-inner">Attendance Register</h5>
                        </div>
                      </div>
                  </a>
            </div>
          </div>
</div>
<!-- Container-fluid Ends-->
@endsection
@section('scripts')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
<script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/height-equal.js')}}"></script>
@endsection
