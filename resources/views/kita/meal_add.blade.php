@extends('layouts.master')
@section('title', 'Endless - Premium Laravel Admin Template')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chartist.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
    <!-- Plugins css Ends-->
@endsection

@section('breadcrumb-title', 'Meals')
@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Meals</li>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12" style="text-align: right">
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModale"><i
                        class="fa fa-plus" aria-hidden="true"></i> Add New</button>
            </div>
        </div>
        <br>

        <div class="row" style="text-align: center;">
            <div class="col-sm-12">
                <h2>Add New Meal</h2>
                <form action="/addItems" method="POST">
                    @csrf
                    <input type="text" name="itemName">
                    <button type="submit">Add Items</button>
                </form>
                <br>

                <table id="example2" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <td>item name</td>
                        </tr>
                    </thead>
                    @foreach ($itemDataArray as $it)
                        <tbody>
                            <tr>
                                <td>{{ $it['name'] }}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-12">
                {{-- <div class="col-sm-1"><button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i
                class="fa fa-plus" aria-hidden="true"></i> Add New</button></div> --}}
                <div class="col-sm-12">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <td>Date</td>
                                <td>Items</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        @foreach ($meals as $ne)
                            <tbody>
                                <tr>
                                    <td>{{ $ne->added_date }}</td>
                                    <td>
                                        @foreach (json_decode($ne->items) as $it)
                                            {{ $it->name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <button onclick="setNid({{ $ne->id }})" type="button"
                                                        class="btn btn-success btn-sm" data-toggle="modal"
                                                        data-target="#myModaledit"><i class="fa fa-pencil-square-o"
                                                            aria-hidden="true"></i> Update</button>
                                                </td>
                                                <td>
                                                    <form action="/deleteMeal" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="meal_id" id="meal_id"
                                                            value="{{ $ne->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-trash" aria-hidden="true"></i>
                                                            Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
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
            $('#example2').DataTable();
        });

    </script>

    {{-- start meal add modal --}}
    <div id="myModale" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add New Meal</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/addNewMeal">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Date</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa"
                                            aria-hidden="true"></i></span>
                                    <input class="form-control" type="date" id="mydate" name="mydate"
                                        placeholder="Select date">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Items</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <div style="color: black;font-weight: bold;" id="newInput">
                                        <table border="1">
                                            <tr>
                                                <td>item name</td>
                                            </tr>
                                            @foreach ($itemDataArray as $it)
                                                <tr>
                                                    <td>{{ $it['name'] }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
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
    {{-- end meal add modal --}}

    {{-- start meal edit modal --}}
    <div id="myModaledit" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Update Meal</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/addNewMeal">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Date</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa"
                                            aria-hidden="true"></i></span>
                                    <input class="form-control" type="date" id="mydate" name="mydate"
                                        placeholder="Select date">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Items</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <div style="color: black;font-weight: bold;" id="newInput">
                                        <table border="1">
                                            <tr>
                                                <td>item name</td>
                                            </tr>
                                            @foreach ($itemDataArray as $it)
                                                <tr>
                                                    <td>{{ $it['name'] }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button class="btn btn-success" type="button">Update </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end meal edit modal --}}
@endsection
