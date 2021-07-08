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
    <li class="breadcrumb-item active">Meal Plans</li>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">



         <div class="row">
                        <div class="col-sm-12" style="text-align: right">
                            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModale"
                                style="color: white !important;border: 2px solid #2494d3 !important;background-color: #2596d3 !important;">
                                Add New</button>
                        </div>
                    </div>

                    <div class="row" style="text-align: center;">

                        {{-- <div class="col-sm-12">
                    Add New Meal
        <h2 style="color: #2696d3;">Add New Meal</h2>
                            <form action="/addItems" method="POST">
                                @csrf
                                <input type="text" name="itemName" class="modal-input">
                                <button type="submit" class="drop-down-add-btn">Add Items</button>
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
                                            <td>
                                             @foreach ($it as $dt)
                                             <div>
                                             {{ $dt['name'] }}
                                             </div>
                                              @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div> --}}
                    </div>


        <br>

        <div class="row">

            <div class="col-sm-12">
                {{-- <div class="col-sm-1"><button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i
                class="fa fa-plus" aria-hidden="true"></i> Add New</button></div> --}}
                <div class="col-sm-12">
                    <table class="custormize" id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <td style="width:30%">Date</td>
                                <td style="width:30%">Items</td>
                                <td style="width:40%">Action</td>
                            </tr>
                        </thead>
                        @foreach ($meals as $ne)
                            <tbody>
                                <tr>
                                    <td>{{ $ne->added_date }}</td>
                                    <td>
                                        {{ $ne->items }}
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
                                                    <form action="" method="" id="">
                                                        @csrf
                                                        <input type="hidden" name="meal_id" id="meal_id"
                                                            value="{{ $ne->id }}">
                                                        <button onclick="deleteConfirm({{$ne->id}})" data-toggle="modal"
                                                        data-target="#myModalDelete" type="button"
                                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"
                                                                aria-hidden="true"></i>
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

    <script>
        // var items = [];

        // function guardarNumeros() {
        //     boxvalue = document.getElementById('itemName').value;
        //     items.push(boxvalue);
        //     console.log(items);
        // }

        var x = 0;
        var array = Array();

        function add_element_to_array() {
            var value = document.getElementById('itemName').value;
            if (value.length == 0) {
                alert('plese enter a value'); // keep form from submitting
            } else {
                addItemsToKidArray(value);
            }
        }

        function add_element_to_array_two() {
            var value = document.getElementById('itemNameB').value;
            if (value.length == 0) {
                alert('plese enter a value'); // keep form from submitting
            } else {
                addItemsToKidArrayTwo(value);
            }
        }

        var obj = [];

        function addItemsToKidArray(val) {
            const meal = {
                name: val
            };
            obj.push(meal);
            var newObj = JSON.stringify(obj);
            console.log('meal object = ' + newObj);
            document.getElementById("itemArray").value = newObj;
            display_array(newObj);
        }

        function addItemsToKidArrayTwo(val) {
            const meal = {
                name: val
            };
            obj.push(meal);
            var newObj = JSON.stringify(obj);
            console.log('meal object = ' + newObj);
            document.getElementById("itemArrayU").value = newObj;
            display_array_two(newObj);
        }

        function display_array(jsonObj) {
            var json = JSON.parse(jsonObj);
            var res = "";
            for (var key in json) {
                if (json.hasOwnProperty(key)) {
                    console.log(json[key].name);
                    res += json[key].name + "<br>";
                }
            }
            document.getElementById("Result").innerHTML = res;
        }

        function display_array_two(jsonObj) {
            var json = JSON.parse(jsonObj);
            var res = "";
            for (var key in json) {
                if (json.hasOwnProperty(key)) {
                    console.log(json[key].name);
                    res += json[key].name + "<br>";
                }
            }
            document.getElementById("mealResult").innerHTML = res;
        }

        function setNid(val) {
            document.getElementById("me_id").value = val;

            myObj = {
                "_token": "<?php echo csrf_token(); ?>",
                "meal_id": document.getElementById("me_id").value
            }

            $.ajax({
                type: 'POST',
                url: '/getMealData',
                data: myObj,
                success: function(data) {
                    var jsonObj = JSON.parse(data);
                    document.getElementById("mydateu").value = jsonObj.added_date;

                    // document.getElementById("mealResult").innerHTML = jsonObj.items;

                    var json = JSON.parse(jsonObj.items);
                    var rest = "";
                    for (var key in json) {
                        if (json.hasOwnProperty(key)) {
                            console.log(json[key].name);
                            rest += json[key].name + "<br>";
                        }
                    }
                    document.getElementById("mealResult").innerHTML = rest;
                }
            });
        }

        function deleteConfirm(id) {
            document.getElementById("meal_id").value = val;
        }
    </script>

    {{-- start meal add modal --}}
    <div id="myModale" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="border-radius: 1rem;width: 650px;">
                <div class="modal-header modal-header-new">
                    <h3>Add New Meal</h3>
                    <button type=" button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12" style="text-align: center;">
                        {{-- <h2 style="color: #2696d3;">Add New Meal</h2> --}}
                        <input type="text" name="itemName" id="itemName" class="modal-input meal-plan-add-items">
                        <button type="submit" class="drop-down-add-btn" onclick="add_element_to_array()">Add Items</button>
                        <br>
                        <br>
                    </div>
                    <form class="" method="POST" action="/addNewMeal">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Date</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/schedule.png')}}" alt=""></span>
                                    <input class="form-control modal-input meal-plan-add-items" type="date" id="mydate" name="mydate"
                                        placeholder="Select date">
                                    <input type="hidden" id="itemArray" name="itemArray">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Items</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/fast-food.png')}}" alt=""></span>
                                    <div class="meal-plan-item-list" id="newInput">
                                        <div id="Result" style="text-align: left;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group register-button">
                            <button class="btn btn-success" type="submit">Save </button>
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
            <div class="modal-content" style="border-radius: 1rem;width: 650px;">
                <div class="modal-header">
                    <h3>Update Meal</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" name="itemNameB" id="itemNameB" class="modal-input meal-plan-add-items" style="margin-left: 20%;">
                    <button type="submit" class="drop-down-add-btn" onclick="add_element_to_array_two()">Add Items</button>
                    <br>
                    <br>
                    <form class="" method="POST" action="/updateMealData">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Date</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/schedule.png')}}" alt=""></span>
                                    <input class="form-control" type="date" id="mydateu" name="mydateu"
                                        placeholder="Select date" required>
                                    <input type="hidden" id="me_id" name="me_id">
                                    <input type="hidden" id="itemArrayU" name="itemArrayU">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Items</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/fast-food.png')}}" alt=""></span>
                                    <div class="meal-plan-item-list" id="newInput">
                                        <div id="mealResult"></div>
                                        {{-- <table border="1">
                                            <tr>
                                                <td>item name</td>
                                            </tr>
                                            @foreach ($itemDataArray as $it)
                                                <tr>
                                                    <td>{{ $it['name'] }}</td>
                                                </tr>
                                            @endforeach
                                        </table> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group " style="float:right">
                            <button class="btn btn-success" type="submit">Update </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end meal edit modal --}}

    {{-- start delete modal popup --}}
    <!-- Modal HTML -->
<div id="myModalDelete" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
            			<div class="modal-header flex-column delet-modal-header">
            				<h4 class="modal-title w-100 delete-modal-header-text">Are you sure?</h4>
            			</div>
            			<div class="modal-body">
            				<p class="delete-modal-header-body">Do you really want to delete these records? This process cannot be undone.</p>
            			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="/deleteMeal" method="POST">
                    @csrf
                    <input type="hidden" name="meal_id" id="meal_id"
                        value="{{ $ne->id }}">
				<button type="submit" class="btn btn-danger">Delete</button>
                </form>
			</div>
		</div>
	</div>
</div>
    {{-- end delete model popup --}}
@endsection
