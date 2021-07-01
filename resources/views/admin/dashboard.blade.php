@extends('layouts_admin.master')
@section('title', 'Endless - Premium Laravel Admin Template')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chartist.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
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
        <div class="row" style="text-align: right">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" style="color: white !important;
                                                                                                                           border: 2px solid #2494d3 !important;
                                                                                                                           background-color: #2596d3 !important;
                                                                                                                       }

><i
                        class="fa fa-plus" aria-hidden="true"></i> Add New User</button>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-12">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Kindergarden Name</td>
                            <td>Address</td>
                            <td>Logo</td>
                            <td>Email</td>
                            <td>Telephone</td>
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
                            <td></td>
                        </tr>
                    </tbody>
                </table>
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
                    "url": "/getKitaUsers",
                    "type": "post",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "first_name"
                    }, {
                        "data": "last_name"
                    },
                    {
                        "data": "kindergarden_name"
                    },
                    {
                        "data": "address"
                    },
                ],
                "columnDefs": [{
                        "targets": 4,
                        "name": "image",
                        "data": "image",
                        "render": function(data, type, full, meta) {
                            return "<img src=\"" + data + "\" height=\"100\" width=\"100\"/>";
                        },
                        "title": "Image",
                        "orderable": true,
                        "searchable": true
                    },
                    {
                        "targets": 5,
                        "name": "email",
                        "data": "email",
                        "render": function(data, type, full, meta) {
                            return "<p>\ " + data + "\ <p/>";
                        },
                        "title": "email",
                        "orderable": true,
                        "searchable": true
                    },
                    {
                        "targets": 6,
                        "name": "telephone",
                        "data": "telephone",
                        "render": function(data, type, full, meta) {
                            return "<p>\ " + data + "\ <p/>";
                        },
                        "title": "telephone",
                        "orderable": true,
                        "searchable": true
                    },
                    {
                        "targets": 7,
                        "name": "kita_id",
                        "data": "id",
                        "render": function(data, type, full, meta) {
                            return "<table><tr><button type=\"button\" class=\"btn btn-success btn-sm\" data-toggle=\"modal\" data-target=\"#myModalE\" onclick=\"setNid(" +
                                data +
                                ")\" > <i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> Update</button></tr></table>";
                        },
                        "title": "kita_id",
                        "orderable": true,
                        "searchable": true
                    }
                ]
            });
        });

        function setNid(val) {
            document.getElementById("kita_id").value = val;

            myObj = {
                "_token": "<?php echo csrf_token(); ?>",
                "kita_id": document.getElementById("kita_id").value
            }

            $.ajax({
                type: 'POST',
                url: '/getKitaData',
                data: myObj,
                success: function(data) {
                    var jsonObj = JSON.parse(data);
                    document.getElementById("kitaLogo").src = 'http://kitaapp.de.w01b7e22.kasserver.com' + jsonObj.image;
                    document.getElementById("fnameU").value = jsonObj.first_name;
                    document.getElementById("lnameU").value = jsonObj.last_name;
                    document.getElementById("kinameU").value = jsonObj.kindergarden_name;
                    document.getElementById("cityU").value = jsonObj.city;
                    document.getElementById("stateU").value = jsonObj.state;
                    document.getElementById("zipU").value = jsonObj.postal_code;
                    document.getElementById("addressU").value = jsonObj.address;
                    document.getElementById("emailU").value = jsonObj.email;
                    document.getElementById("teleU").value = jsonObj.telephone;
                }
            });
        }

    </script>

    {{-- start kita add modal --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="border-radius: 1rem;
                                                  width: 650px;">
                <div class="modal-header modal-header-new">
                    <h3>Add New Kita User</h3>
                    <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/addNewKita" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="fname" id="fname"
                                        placeholder="Enter your First Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="lname" id="lname"
                                        placeholder="Enter your Last Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="kiname" id="kiname"
                                        placeholder="Enter your Kindergarden Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="city" id="city"
                                        placeholder="Enter your City" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="state" id="state"
                                        placeholder="Enter your State" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-globe" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="zip" id="zip"
                                        placeholder="Enter your Postal/Zip Code" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="address" id="address"
                                        placeholder="Enter your Address" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                    <input type="file" class="form-control modal-input" id="photos[]" name="photos[]" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-envelope fa"
                                            aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="email" id="email"
                                        placeholder="Enter your Email" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group form-data-field">
                                    <span class="input-group-addon modal-icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control modal-input" name="tele" id="tele"
                                        placeholder="Enter your Telephone" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group register-button">
                            <button class="btn btn-success" type="submit">Register </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end kita add modal --}}

    {{-- start kita edit modal --}}
    <div id="myModalE" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Edit Kita User Details</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="/editKitaUser" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Your First Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="fnameU" id="fnameU"
                                        placeholder="Enter your First Name" />
                                    <input type="hidden" name="kita_id" id="kita_id" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Your Last Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lnameU" id="lnameU"
                                        placeholder="Enter your Last Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Kindergarden Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="kinameU" id="kinameU"
                                        placeholder="Enter your Kindergarden Name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">City</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="cityU" id="cityU"
                                        placeholder="Enter your City" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">State / Province</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="stateU" id="stateU"
                                        placeholder="Enter your State" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Postal / Zip Code</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="zipU" id="zipU"
                                        placeholder="Enter your Postal/Zip Code" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Address</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="addressU" id="addressU"
                                        placeholder="Enter your Address" />
                                </div>
                            </div>
                        </div>

                        <img id="kitaLogo" alt="" style="width: 150px;height:150px;">

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Logo</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="file" class="form-control" id="photoss[]" name="photoss[]" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Your Email</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa"
                                            aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="emailU" id="emailU"
                                        placeholder="Enter your Email" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Your Telephone</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="teleU" id="teleU"
                                        placeholder="Enter your Telephone" />
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
    {{-- end kita edit modal --}}
@endsection
