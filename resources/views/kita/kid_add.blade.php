@extends('layouts.master')
@section('title', 'Endless - Premium Laravel Admin Template')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chartist.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
    <!-- Plugins css Ends-->
@endsection

@section('breadcrumb-title', 'Kids')
@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Kids</li>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12" style="text-align: right">
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i
                        class="fa fa-plus" aria-hidden="true"></i> Add New</button>
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
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Year</td>
                                <td>Parent Type</td>
                                <td>Parent</td>
                                <td>Group</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#example').DataTable({
                "ajax": {
                    "url": "/getKidDetails",
                    "type": "post",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "first_name"
                    },
                    {
                        "data": "last_name"
                    },
                    {
                        "data": "year"
                    },
                    {
                        "data": "parent_type"
                    },
                    {
                        "data": "parent_id"
                    },
                    {
                        "data": "group_id"
                    }
                ],
                "columnDefs": [{
                    "targets": 6,
                    "name": "parent_id",
                    "data": "id",
                    "width": "60%",
                    "render": function(data, type, full, meta) {
                        return "<table><tr><td><button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModale\" onclick=\"setNid(" +
                            data +
                            ")\" > <i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Update</button></td><td><form action=\"deleteKid\" method=\"GET\"><input type=\"hidden\" name=\"kids_id\" id=\"kids_id\" value=" +
                            data +
                            "><button type=\"submit\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i>Delete</button></form></td></tr></table>";
                    },
                    "title": "parentID",
                    "orderable": true,
                    "searchable": true
                }]
            });
        });

        function setNid(val) {
            document.getElementById("k_id").value = val;

            myObj = {
                "_token": "<?php echo csrf_token(); ?>",
                "kid_id": document.getElementById("k_id").value
            }

            $.ajax({
                type: 'POST',
                url: '/getKidsData',
                data: myObj,
                success: function(data) {
                    var jsonObj = JSON.parse(data);
                    document.getElementById("fnames").value = jsonObj.first_name;
                    document.getElementById("lnames").value = jsonObj.last_name;
                    document.getElementById("years").value = jsonObj.year;
                    document.getElementById("typess").value = jsonObj.parent_type;
                    document.getElementById("parentss").value = jsonObj.parent_id;
                    document.getElementById("groupss").value = jsonObj.group_id;
                }
            });
        }

    </script>

    {{-- start kid add modal --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add New Kid</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/addNewKid">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">First Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="fname" id="fname"
                                        placeholder="Enter first Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Last Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lname" id="lname"
                                        placeholder="Enter Last Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Year</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="year" id="year"
                                        placeholder="Enter Year" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Parent Type</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <select class="form-control" name="types" id="types">
                                        <option value="0">select type</option>
                                        <option value="1">Mother</option>
                                        <option value="2">Father</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Parent</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <select class="form-control" name="parents" id="parents">
                                        <option value="0">select parent</option>
                                        @foreach ($parents as $pr)
                                            <option value="{{ $pr->id }}">{{ $pr->first_name }}
                                                {{ $pr->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Group</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <select class="form-control" name="groups" id="groups">
                                        <option value="0">select group</option>
                                        @foreach ($groups as $gr)
                                            <option value="{{ $gr->id }}">{{ $gr->name }}</option>
                                        @endforeach
                                    </select>
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
    {{-- end kid add modal --}}


    {{-- start kita edit modal --}}
    <div id="myModale" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Edit Kid Details</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/editKid">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">First Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="fnames" id="fnames"
                                        placeholder="Enter first Name" />
                                    <input type="hidden" name="k_id" id="k_id" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Last Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lnames" id="lnames"
                                        placeholder="Enter Last Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Year</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="years" id="years"
                                        placeholder="Enter Year" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Parent Type</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <select class="form-control" name="typess" id="typess">
                                        <option value="0">select type</option>
                                        <option value="1">Mother</option>
                                        <option value="2">Father</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Parent</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <select class="form-control" name="parentss" id="parentss">
                                        <option value="0">select parent</option>
                                        @foreach ($parents as $pr)
                                            <option value="{{ $pr->id }}">{{ $pr->first_name }}
                                                {{ $pr->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Group</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <select class="form-control" name="groupss" id="groupss">
                                        <option value="0">select group</option>
                                        @foreach ($groups as $gr)
                                            <option value="{{ $gr->id }}">{{ $gr->name }}</option>
                                        @endforeach
                                    </select>
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
    {{-- end kita edit modal --}}
@endsection
