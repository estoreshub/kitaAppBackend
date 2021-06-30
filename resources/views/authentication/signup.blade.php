@extends('authentication.layouts.master')
@section('title', 'Signup | Endless Admin Panel')
@section('styles')

@endsection

@section('content')
<div class="container-fluid">
  <!-- sign up page start-->
  <div class="authentication-main">
    <div class="row">
      <div class="col-sm-12 p-0">
        <div class="auth-innerright">
          <div class="authentication-box">
            <div class="text-center"><img src="{{asset('assets/images/endless-logo.png')}}" alt=""></div>
            <div class="card mt-4 p-4">
              <h4 class="text-center">NEW USER</h4>
              <h6 class="text-center">Enter your Username and Password For Signup</h6>
              <form class="theme-form">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">First Name</label>
                      <input class="form-control" type="text" placeholder="John">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-form-label">Last Name</label>
                      <input class="form-control" type="text" placeholder="Deo">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-form-label">User Name</label>
                  <input class="form-control" type="text" placeholder="John Deo">
                </div>
                <div class="form-group">
                  <label class="col-form-label">Password</label>
                  <input class="form-control" type="password" placeholder="**********">
                </div>
                <div class="form-group">
                  <label class="col-form-label">BOD</label>
                  <div class="form-row">
                    <div class="col-sm-4">
                      <select class="form-control mb-1">
                        <option>DD</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <select class="form-control mb-1">
                        <option>MM</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <select class="form-control mb-1">
                        <option>YYYY</option>
                        <option>1990</option>
                        <option>1991</option>
                        <option>1992</option>
                        <option>1993</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-sm-4">
                    <button class="btn btn-primary" type="submit">Sign Up</button>
                  </div>
                  <div class="col-sm-8">
                    <div class="text-left mt-2 m-l-20">Are you already user?  <a class="btn-link text-capitalize" href="login.html">Login</a></div>
                  </div>
                </div>
                <div class="form-divider"></div>
                <div class="social mt-3">
                  <div class="form-group btn-showcase d-flex">
                    <button class="btn social-btn btn-fb d-inline-block"> <i class="fa fa-facebook"></i></button>
                    <button class="btn social-btn btn-twitter d-inline-block"><i class="fa fa-google"></i></button>
                    <button class="btn social-btn btn-google d-inline-block"><i class="fa fa-twitter"></i></button>
                    <button class="btn social-btn btn-github d-inline-block"><i class="fa fa-github"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- sign up page ends-->
</div>
@endsection
@section('scripts')
@endsection