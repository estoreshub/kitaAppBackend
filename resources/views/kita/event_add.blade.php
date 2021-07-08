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
    <li class="breadcrumb-item active">Events - Messages</li>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div>
            <div class="row">
                <div class="col-sm-12" style="text-align: right">
                    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModale"
                        style="color: white !important;border: 2px solid #2494d3 !important;background-color: #2596d3 !important;">
                        Add New Event</button>
                </div>
            </div>
            <br>


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
                                <td style="font-weight:bold;">Date</td>
                                <td style="font-weight:bold;">Title</td>
                                <td style="font-weight:bold;">Description</td>
                                <td style="font-weight:bold;">Event Type</td>
                                <td style="font-weight:bold;">Images</td>
                                <td style="font-weight:bold;">Users</td>
                                <td style="font-weight:bold;">Action</td>
                            </tr>
                        </thead>
                        @foreach ($events as $gr)
                            <tbody>
                                <tr>
                                    <td>{{ $gr->added_date }}</td>
                                    <td>{{ $gr->title }}</td>
                                    <td>{{ $gr->description }}</td>
                                    @if ($gr->event_type == 1)
                                        <td>event</td>
                                    @endif
                                    @if ($gr->event_type == 2)
                                        <td>message</td>
                                    @endif
                                    <td>
                                        @foreach (json_decode($gr->images) as $im)
                                            <img style="width:120px;height:120px;" src="{{ $im->imagePath }}" /><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach (json_decode($gr->users) as $us)
                                            kid id - {{ $us->kid_id }} , kid name - {{ $us->kid_name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <!--<button disabled="" onclick="setNid({{ $gr->id }})" type="button" class="btn btn-success btn-md"
                                                data-toggle="modal" data-target="#myModale"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</button>-->


                                            @csrf

                                            <button type="button" onclick="deleteConfirm({{$gr->id}})" data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"
                                                    aria-hidden="true"></i>
                                                Delete</button>
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
            $("#kidSelect").hide();
            $("#groupSelect").hide();
        });


        function sendNotification() {
            OneSignal.push(function() {
                /* These examples are all valid */
                var isPushSupported = OneSignal.isPushNotificationsSupported();
                if (isPushSupported) {
                    // Push notifications are supported
                    console.log('supported');
                    OneSignal.isPushNotificationsEnabled(function(isEnabled) {
                        if (isEnabled) {
                            console.log("Push notifications are enabled!");
                            OneSignal.getUserId(function(userId) {
                                console.log("OneSignal User ID:", userId);
                                // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316
                            });
                        } else {
                            console.log("Push notifications are not enabled yet.");
                            OneSignal.push(function() {
                                OneSignal.showNativePrompt();
                            });
                        }
                    });
                } else {
                    // Push notifications are not supported
                    console.log('not supported');
                }
            });
        }

        function SendSelfNoti() {
            OneSignal.sendSelfNotification(
                /* Title (defaults if unset) */
                "OneSignal Web Push Notification",
                /* Message (defaults if unset) */
                "Action buttons increase the ways your users can interact with your notification.",
                /* URL (defaults if unset) */
                'https://example.com/?_osp=do_not_open',
                /* Icon */
                'https://onesignal.com/images/notification_logo.png', {
                    /* Additional data hash */
                    notificationType: 'news-feature'
                },
                [{
                        /* Buttons */
                        /* Choose any unique identifier for your button. The ID of the clicked button is passed to you so you can identify which button is clicked */
                        id: 'like-button',
                        /* The text the button should display. Supports emojis. */
                        text: 'Like',
                        /* A valid publicly reachable URL to an icon. Keep this small because it's downloaded on each notification display. */
                        icon: 'http://i.imgur.com/N8SN8ZS.png',
                        /* The URL to open when this action button is clicked. See the sections below for special URLs that prevent opening any window. */
                        url: 'https://example.com/?_osp=do_not_open'
                    },
                    {
                        id: 'read-more-button',
                        text: 'Read more',
                        icon: 'http://i.imgur.com/MIxJp1L.png',
                        url: 'https://example.com/?_osp=do_not_open'
                    }
                ]
            );
        }

        function selectType(val) {
            // alert("val = "+val);

            if (val == "1") {
                $("#groupSelect").show();
                $("#kidSelect").hide();
            } else if (val == "2") {
                $("#kidSelect").show();
                $("#groupSelect").hide();
            }
        }

        var obj = [];
        function addItemsToKidArray(val) {
            var res = val.split(",");
            const kid = {kid_id:res[0], kid_name:res[1]};
            obj.push(kid);
            var newObj = JSON.stringify(obj);
            console.log('kid object = '+newObj);
            $('#kidsArray').val(newObj);
        }

        function deleteConfirm(id) {
            document.getElementById("event_id").value = id;
            // $('#myModalDelete').modal('show');
        }
    </script>

    {{-- start event add modal --}}
    <div id="myModale" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="border-radius: 1rem;width: 650px;">
                <div class="modal-header modal-header-new">
                    <h3>Add New Event</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <select name="kid_id" class="drop-down-events" required onchange="selectType(this.value)" style="margin-bottom:1rem">
                        <option value="0">Select Type</option>
                        <option value="1">Add By Group</option>
                        <option value="2">Add By Kid</option>
                    </select>

                    {{-- <select name="kid_id" class="drop-down-events" required>
                        <option value="0">select group</option>
                        @foreach ($groups as $grp)
                            <option value="{{ $grp->id }}">{{ $grp->name }}
                            </option>
                        @endforeach
                    </select> --}}

                    <div class="add-event-modal-table" id="kidSelect">
                    <table class="table table-bordered" >
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Kid Name</th>
                                                </tr>
                                            </thead>
                                            @foreach ($kids as $kd)
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                {{-- <input type="checkbox" name="favorite_pet" class="custom-control-input"> --}}
                                                                <input type="checkbox" onclick="addItemsToKidArray(this.value)"
                                                                    name="favorite_pet"
                                                                    value="{{ $kd->id }},{{ $kd->first_name }} {{ $kd->last_name }}">
                                                                {{ $kd->id }}<br>
                                                                {{-- <label class="custom-control-label" for="customCheck1">{{$kd->id}}</label> --}}
                                                            </div>
                                                        </td>
                                                        <td>{{ $kd->first_name }} {{ $kd->last_name }}</td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                    </div>

                    <form enctype="multipart/form-data" method="POST" action="/addNewEvent">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Date</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/schedule.png')}}" alt=""></span>
                                    <input class="form-control modal-input" type="date" id="mydate" name="mydate"
                                        placeholder="Select date" required >
                                        <input type="hidden" id="kidsArray" name="kidsArray">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Start Time</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/clock.png')}}" alt=""></span>
                                    <input class="form-control modal-input" type="time" id="startTime" name="startTime"
                                        placeholder="Select Start Time" required >
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">End Time</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/clock.png')}}" alt=""></span>
                                    <input class="form-control modal-input" type="time" id="endTime" name="endTime"
                                        placeholder="Select End Time" required >
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Title</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/tag.png')}}" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="title" id="title"
                                        placeholder="Enter Title" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Description</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/policy.png')}}" alt=""></span>
                                    <input type="text" class="form-control modal-input" name="des" id="des"
                                        placeholder="Enter Description" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="groupSelect">
                            <label for="name" class="cols-sm-2 control-label">Group</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/group.png')}}" alt=""></span>
                                    <select name="group_id" id="group_id" class="form-control modal-input" required >
                                        <option value="0">select group</option>
                                        @foreach ($groups as $gp)
                                            <option value="{{ $gp->id }}">{{ $gp->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Event Type</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/chatting.png')}}" alt=""></i></span>
                                    <select class="form-control modal-input" name="types" id="types"
                                        onchange="SendSelfNoti()" required >
                                        <option value="0">select type</option>
                                        <option value="1">Event</option>
                                        <option value="2">Message</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Images</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon modal-icon"><img  style="width: 2rem;" src="{{asset('assets/images/auto-modal/image.png')}}" alt=""></span>
                                    <input accept=".jpg, .png, .jpeg" type="file" class="form-control modal-input"
                                        id="photos[]" name="photos[]" multiple required >
                                </div>
                            </div>
                        </div>



                        <div class="form-group register-button">
                            <button class="btn btn-success" type="submit">Add </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end event add modal --}}

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
                <form action="/deleteEvent" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" id="event_id">
				<button type="submit" class="btn btn-danger">Delete</button>
                </form>
			</div>
		</div>
	</div>
</div>
    {{-- end delete model popup --}}
@endsection
