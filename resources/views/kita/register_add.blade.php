@extends('layouts.master')
@section('title', 'Endless - Premium Laravel Admin Template')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chartist.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ui-changes.css') }}">
    <!-- Plugins css Ends-->
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Attendance Register</li>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        {{-- <div class="row">
            <div class="col-sm-12" style="text-align: right">
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" style="color: white !important;border: 2px solid #2494d3 !important;background-color: #2596d3 !important;">Add New</button>
            </div>
        </div> --}}
        <br>

        <div class="row" style="text-align: center">
            <div class="col-sm-12">
                    <form enctype="multipart/form-data" method="POST" action="/searchRegister">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label" style="font-weight:bold;">Date</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-envelope fa"
                                            aria-hidden="true"></i></span>
                                    <input class="form-control modal-input" type="date" id="mydate" name="mydate"
                                        placeholder="Select date">
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button class="btn btn-success" type="submit">Search </button>
                        </div>

                    </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                {{-- <div class="col-sm-1"><button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i
                class="fa fa-plus" aria-hidden="true"></i> Add New</button></div> --}}
                <div class="col-sm-12">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <td style="font-weight:bold;">Kid Name</td>
                            <td style="font-weight:bold;">Group Name</td>
                            <td style="font-weight:bold;">Parent Name</td>
                            <td style="font-weight:bold;">Date</td>
                            <td style="font-weight:bold;">Action</td>
                        </tr>
                            </thead>
                        @foreach ($register as $k)
                        <tbody>
                            <tr>
                                <td>{{ $k->fName }} {{ $k->lName }}</td>
                                <td>{{ $k->groupName }}</td>
                                <td>{{ $k->pfName }} {{ $k->plName }}</td>
                                <td>{{ $k->added_date }}</td>
                                @if($k->status==1)
                                <td>present</td>
                                @endif
                                @if($k->status==0)
                                <td>absent</td>
                                @endif
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Container-fluid Ends-->
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>

    <script>
	$(document).ready(function() {
		$('#example').DataTable();
		});
    </script>

@endsection


