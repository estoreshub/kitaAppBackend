<?php

namespace App\Http\Controllers;

use App\allUsers;
use App\htmlPages;
use App\Events;
use App\Groups;
use App\Kids;
use App\Meals;
use App\News;
use App\Parents;
use App\Student;
use Berkayk\OneSignal\OneSignalClient;
use OneSignal;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Mail;
use DateInterval;
use DatePeriod;
use DateTime;

class UserController extends Controller
{
    public function index()
    {

        //Artisan::call('cache:clear');
        //Artisan::call('config:clear');
        //$msg=exec('php artisan vendor:publish --provider="Berkayk\OneSignal\OneSignalServiceProvider" --tag="config"');
        //echo $msg;
        //exit();
        if (Session::has('loggedUserName')) {
            $userType = Session::get('loggedUserType');
            if ($userType == 1) {
                Session::put('userLoginErrorMsg', '');
                return redirect('/admin-dashboard');
            } else if ($userType == 2) {
                Session::put('userLoginErrorMsg', '');
                return redirect('/kita-dashboard');
            }
        } else if (!Session::has('loggedUserName')) {
            return view("admin/login");
        }
    }

    public function user_login(Request $request)
    {
        $username = $request->username;
        $pass = md5($request->password);

        $user = DB::table('all_users')
            ->where('username', $username)
            ->where('password', $pass)
            ->first();
        if ($user) {
            $userData = DB::table('all_users')
                ->where('username', $username)
                ->where('password', $pass)
                ->first();

            $userType = $userData->user_type_id;
            Session::put('loggedUserId', $userData->id);
            Session::put('loggedUserName', $userData->first_name);
            Session::put('loggedUserType', $userType);

            if ($userType == 1) {
                Session::put('userLoginErrorMsg', '');
                return redirect('/admin-dashboard');
            } else if ($userType == 2) {
                Session::put('userLoginErrorMsg', '');
                return redirect('/kita-dashboard');
            }
        } else if (!$user) {
            Session::put('userLoginErrorMsg', 'invalid credentials');
            return redirect('/');
        }
    }

    public function addStudent(Request $request)
    {
        $stu = new Student();
        $stu->first_name = $request->fname;
        $stu->last_name = $request->lname;
        $stu->save();
        return redirect('/');
    }

    public function adminDashboard()
    {
        $emptyArray = array();
        $kitas = DB::table('all_users')->where('user_type_id', 2)->get();
        if ($kitas) {
            return view('admin/dashboard', ['kitas' => $kitas]);
        } else if (!$kitas) {
            return view('admin/dashboard', ['kitas' => $emptyArray]);
        }
    }

    public function getKitaUsers()
    {
        $emptyArray = array();
        $kitas = DB::table('all_users')->where('user_type_id', 2)->get();
        if ($kitas) {
            echo json_encode($kitas);
        } else if (!$kitas) {
            echo json_encode($emptyArray);
        }
    }

    public function kitaDashboard()
    {
        return view("kita/dashboard");
    }

    public function add_new_kita(Request $request)
    {
        $photos = $request->file('photos');

        if ($request->hasFile('photos')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            foreach ($photos as $photo) {
                $filename = $photo->getClientOriginalName();
                $new_file_name = md5($photo->getClientOriginalName());
                $extension = $photo->getClientOriginalExtension();
                $disk = 'public';
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = '/uploads/photos/';
                    $filePath = $folder . md5($photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
                    $file = $photo->storeAs($folder, $new_file_name . '.' . $photo->getClientOriginalExtension(), $disk);

                    $cDate = date('YHi');
                    $username = $request->fname . '' . $cDate;
                    $cDates = date('YmdHi');
                    $password = $cDates;

                    $usr = new allUsers();
                    $usr->first_name = $request->fname;
                    $usr->last_name = $request->lname;
                    $usr->email = $request->email;
                    $usr->password = md5($password);
                    $usr->telephone = $request->tele;
                    $usr->user_type_id = 2;
                    $usr->username = $username;
                    $usr->kindergarden_name = $request->kiname;
                    $usr->city = $request->city;
                    $usr->postal_code = $request->zip;
                    $usr->state = $request->state;
                    $usr->address = $request->address;
                    $usr->image = $filePath;
                    $status = $usr->save();
                    if ($status) {
                        // start email
                        $from = 'superadmin@mail.com';
                        $to = $request->email;

                        Session::put('htmlEmailFrom', $from);
                        Session::put('htmlEmailTo', $to);

                        $data = array(
                            'name' => $request->fname,
                            'username' => $username,
                            'password' => $password,
                        );

                        Mail::send('mail/credentials', $data, function ($message) {
                            $message->to(Session::get('htmlEmailTo'), 'Tutorials Point')->subject('Login Credentials');
                            $message->from(Session::get('htmlEmailFrom'), 'www.kitaproject.com');
                        });
                        // end email

                        return redirect('/admin-dashboard');
                    }
                }
            }
        } else if (!$request->hasFile('photos')) {
            $cDate = date('YHi');
            $username = $request->fname . '' . $cDate;
            $cDates = date('YmdHi');
            $password = $cDates;

            $usr = new allUsers();
            $usr->first_name = $request->fname;
            $usr->last_name = $request->lname;
            $usr->email = $request->email;
            $usr->password = md5($password);
            $usr->telephone = $request->tele;
            $usr->user_type_id = 2;
            $usr->username = $username;
            $usr->kindergarden_name = $request->kiname;
            $usr->city = $request->city;
            $usr->postal_code = $request->zip;
            $usr->state = $request->state;
            $usr->address = $request->address;
            $usr->image = NULL;
            $status = $usr->save();
            if ($status) {
                // start email
                $from = 'superadmin@mail.com';
                $to = $request->email;

                Session::put('htmlEmailFrom', $from);
                Session::put('htmlEmailTo', $to);

                $data = array(
                    'name' => $request->fname,
                    'username' => $username,
                    'password' => $password,
                );

                Mail::send('mail/credentials', $data, function ($message) {
                    $message->to(Session::get('htmlEmailTo'), 'Tutorials Point')->subject('Login Credentials');
                    $message->from(Session::get('htmlEmailFrom'), 'www.kitaproject.com');
                });
                // end email

                return redirect('/admin-dashboard');
            }
        }
    }

    public function logout()
    {
        Session::forget('loggedUserId');
        Session::forget('loggedUserName');
        Session::forget('userLoginErrorMsg');
        Session::forget('loggedUserType');

        return redirect('/');
    }

    public function newGroup()
    {
        $emptyArray = array();
        $groups = DB::table('groups')->get();
        if ($groups) {
            return view('kita/group_add', ['groups' => $groups]);
        } else if (!$groups) {
            return view('kita/group_add', ['groups' => $emptyArray]);
        }
    }

    public function getGroupDetails()
    {
        $emptyArray = array();
        $groups = DB::table('groups')->get();
        if ($groups) {
            // return view('kita/group_add', ['groups' => $groups]);
            echo json_encode($groups);
        } else if (!$groups) {
            // return view('kita/group_add', ['groups' => $emptyArray]);
            echo json_encode($emptyArray);
        }
    }

    public function newParent()
    {
        $emptyArray = array();
        $parents = DB::table('parents')->get();
        if ($parents) {
            return view('kita/parent_add', ['parents' => $parents]);
        } else if (!$parents) {
            return view('kita/parent_add', ['parents' => $emptyArray]);
        }
    }

    public function newKid()
    {
        $emptyArray = array();
        $groups = DB::table('groups')->get();
        $parents = DB::table('parents')->get();
        $kids = DB::table('kids')->where('kita_admin_id', Session::get('loggedUserId'))->get();

        if ($groups && $parents && $kids) {
            return view('kita/kid_add', ['groups' => $groups, 'parents' => $parents, 'kids' => $kids]);
        } else if (!$groups && !$parents && !$kids) {
            return view('kita/kid_add', ['groups' => $emptyArray, 'parents' => $emptyArray, 'kids' => $emptyArray]);
        }
    }

    public function getKidDetails()
    {
        $emptyArray = array();
        $kids = DB::table('kids')->where('kita_admin_id', Session::get('loggedUserId'))->get();

        if ($kids) {
            echo json_encode($kids);
        } else if (!$kids) {
            echo json_encode($emptyArray);
        }
    }

    public function add_new_group(Request $request)
    {
        //echo "hello";
        //exit();
        $photos = $request->file('photos');

        if ($request->hasFile('photos')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            foreach ($photos as $photo) {
                $filename = $photo->getClientOriginalName();
                $new_file_name = md5($photo->getClientOriginalName());
                $extension = $photo->getClientOriginalExtension();
                $disk = 'public';
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = '/uploads/photos/';
                    $filePath = $folder . md5($photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
                    $file = $photo->storeAs($folder, $new_file_name . '.' . $photo->getClientOriginalExtension(), $disk);

                    $group = new Groups();
                    $group->name = $request->name;
                    $group->description = $request->des;
                    $group->image = $filePath;
                    $group->color = $request->color;
                    $group->kita_admin_id = Session::get('loggedUserId');
                    $status = $group->save();

                    return redirect('/new-group');

                    //echo $status;
                    //exit();

                    // to access uploaded file
                    // http://127.0.0.1:8000/storage/uploads/photos/f42df5d430ec29737942483719ab5232.jpg

                    //if ($status) {
                    //    return redirect('/new-group');
                    // } else if (!$status) {
                    //   echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
                    // }
                }
            }
        } else if (!$request->hasFile('photos')) {
            $group = new Groups();
            $group->name = $request->name;
            $group->description = $request->des;
            $group->image = NULL;
            $group->color = $request->color;
            $group->kita_admin_id = Session::get('loggedUserId');
            $status = $group->save();

            return redirect('/new-group');
        }
    }

    public function add_new_parent(Request $request)
    {
        $cDate = date('Hi');
        $cPass = date('ymdHi');
        $userObj = DB::table('parents')->latest('id')->first();
        $userCode = $cDate . '' . $userObj->id;

        $notif = 0;
        $eml = 0;
        if ($request->noti) {
            $notif = 1;
        } else if (!$request->noti) {
            $notif = 0;
        }

        if ($request->ema) {
            $eml = 1;
        } else if (!$request->ema) {
            $eml = 0;
        }

        $par = new Parents();
        $par->email = $request->email;
        $par->telephone = $request->tele;
        $par->first_name = $request->fname;
        $par->last_name = $request->lname;
        $par->usercode = $userCode;
        $par->username = $request->fname . "_" . $userCode;
        $par->password = md5($cPass);
        $par->notification_access = $notif;
        $par->email_allow = $eml;
        $par->status = 1;
        $par->parent_type = $request->types;
        $par->kita_admin_id = Session::get('loggedUserId');
        $status = $par->save();
        if ($status == 1) {
            // start email
            $from = 'superadmin@mail.com';
            $to = $request->email;

            Session::put('htmlEmailFrom', $from);
            Session::put('htmlEmailTo', $to);

            $data = array(
                'name' => $request->fname,
                'username' => $request->fname . "_" . $userCode,
                'password' => $cPass,
                'code' => $userCode,
            );

            Mail::send('mail/parent_code', $data, function ($message) {
                $message->to(Session::get('htmlEmailTo'), 'Tutorials Point')->subject('Login Credentials');
                $message->from(Session::get('htmlEmailFrom'), 'www.kitaproject.com');
            });
            // end email
            return redirect('/new-parent');
        } else if ($status == 0) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function add_new_kid(Request $request)
    {
        $cDate = date('YHi');
        $userObj = DB::table('parents')->latest('id')->first();
        $userCode = $cDate . '' . $userObj->id;

        $kid = new Kids();
        $kid->first_name = $request->fname;
        $kid->last_name = $request->lname;
        $kid->year = $request->year;
        $kid->user_code = $userCode;
        $kid->group_id = $request->groups;
        $kid->parent_id = $request->parents;
        $kid->parent_type = $request->types;
        $kid->kita_admin_id = Session::get('loggedUserId');
        $kid->status = 0;
        $status = $kid->save();
        $kidId = $kid->id;
        // echo $kidId;
        // exit();
        $userCode = $cDate . '' . $kidId;

        $parentEmail = DB::table('parents')->where('id', $request->parents)->value('email');

        if ($status) {
            // start email
            $from = 'superadmin@mail.com';
            $to = $parentEmail;

            Session::put('htmlEmailFrom', $from);
            Session::put('htmlEmailTo', $to);

            $data = array(
                'kid_name' => $request->fname,
                'kid_code' => $userCode,
            );

            Mail::send('mail/kid_code', $data, function ($message) {
                $message->to(Session::get('htmlEmailTo'), 'Tutorials Point')->subject('New Kid Added');
                $message->from(Session::get('htmlEmailFrom'), 'www.kitaproject.com');
            });
            // end email

            return redirect('/new-kid');
        } else if (!$status) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function newNews()
    {
        $emptyArray = array();
        $news = DB::table('news')->get();
        if ($news) {
            return view('kita/news_add', ['news' => $news]);
        } else if (!$news) {
            return view('kita/news_add', ['news' => $emptyArray]);
        }
    }

    public function getNewsDetails()
    {
        $emptyArray = array();
        $news = DB::table('news')->get();
        if ($news) {
            echo json_encode($news);
        } else if (!$news) {
            echo json_encode($emptyArray);
        }
    }

    public function add_new_news(Request $request)
    {
        $photos = $request->file('photos');
        if ($request->hasFile('photos')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            foreach ($photos as $photo) {
                $filename = $photo->getClientOriginalName();
                $new_file_name = md5($photo->getClientOriginalName());
                $extension = $photo->getClientOriginalExtension();
                $disk = 'public';
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = '/uploads/photos/';
                    $filePath = $folder . md5($photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
                    $file = $photo->storeAs($folder, $new_file_name . '.' . $photo->getClientOriginalExtension(), $disk);

                    $news = new News();
                    $news->kita_admin_id = Session::get('loggedUserId');
                    $news->title = $request->title;
                    $news->description = $request->des;
                    $news->added_date = $request->mydate;
                    $news->image = $filePath;
                    $status = $news->save();

                    if ($status == 1) {
                        return redirect('/new-news');
                    } else if ($status == 0) {
                        echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
                    }
                }
            }
        }
    }

    public function newMeal()
    {
        $emptyArray = array();
        if (Session::has('itemData')) {
            $itemDataArray = Session::get('itemData');
        } else if (!Session::has('itemData')) {
            $itemDataArray = $emptyArray;
        }

        $meals = DB::table('meals')->get();
        if ($meals) {
            return view('kita/meal_add', ['meals' => $meals, 'itemDataArray' => $itemDataArray]);
        } else if (!$meals) {
            return view('kita/meal_add', ['meals' => $emptyArray, 'itemDataArray' => $emptyArray]);
        }
    }

    public function getMealDetails()
    {
        $emptyArray = array();

        $meals = DB::table('meals')->get();
        if ($meals) {
            echo json_encode($meals);
        } else if (!$meals) {
            echo json_encode($emptyArray);
        }
    }

    public function addItems(Request $request)
    {
        $invArray = array(
            "name" => $request->itemName,
        );

        $emptyArray = array();

        $itemDataArray = array();

        Session::push('itemData', $invArray);
        if (Session::has('itemData')) {
            $itemDataArray = Session::get('itemData');
        } else if (!Session::has('itemData')) {
            $itemDataArray = $emptyArray;
        }

        $meals = DB::table('meals')->get();
        if ($meals && $itemDataArray) {
            return view('kita/meal_add', ['meals' => $meals, 'itemDataArray' => $itemDataArray]);
        } else if (!$meals && !$itemDataArray) {
            return view('kita/meal_add', ['meals' => $emptyArray, 'itemDataArray' => $emptyArray]);
        }
    }

    public function add_new_meal(Request $request)
    {
        $emptyArray = array();

        $timestamp = strtotime($request->mydate);

        $day = date('l', $timestamp);

        $meal = new Meals();
        $meal->kita_admin_id = Session::get('loggedUserId');
        $meal->added_date = $request->mydate;
        $meal->day = $day;

        // $arr1 = str_split($request->itemArray);
        $pieces = explode(",", $request->itemArray);
        $newar = $request->itemArray;

        $meal->items = $newar;
        $status = $meal->save();

        // Session::forget('itemData');

        if ($status == 1) {
            return redirect('/new-meal');
        } else if ($status == 0) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function updateMealData(Request $request)
    {
        $timestamp = strtotime($request->mydateu);

        $day = date('l', $timestamp);

        $status = DB::table('meals')
            ->where('id', $request->me_id)
            ->where('kita_admin_id', Session::get('loggedUserId'))
            ->update([
                'added_date' => $request->mydateu, 'day' => $day, 'items' => $request->itemArrayU
            ]);

        if ($status) {
            return redirect('/new-meal');
        } else if (!$status) {
            echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function blockBoards()
    {
        $emptyArray = array();
        $blocks = DB::table('block_boards')->get();
        if ($blocks) {
            return view('kita/block_boards', ['blocks' => $blocks]);
        } else if (!$blocks) {
            return view('kita/block_boards', ['blocks' => $emptyArray]);
        }
    }

    public function deleteBlock(Request $request)
    {
        $bid = $request->bid;
        $status = DB::table('block_boards')
            ->where('id', '=', $bid)
            ->delete();
        if ($status == 1) {
            return redirect('/block-boards');
        } else if ($status == 0) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function addKidstoTable(Request $request)
    {
        $userData = DB::table('kids')
            ->where('id', $request->kid_id)
            ->first();

        $kidArray = array(
            "kid_id" => $request->kid_id,
            "kid_name" => $userData->first_name . '' . $userData->last_name,
        );

        $emptyArray = array();

        $itemDataArray = array();

        Session::push('kidsData', $kidArray);
        if (Session::has('kidsData')) {
            $itemDataArray = Session::get('kidsData');
        } else if (!Session::has('kidsData')) {
            $itemDataArray = $emptyArray;
        }

        $events = DB::table('events')->get();
        $kids = DB::table('kids')->get();
        if ($events && $itemDataArray) {
            return view('kita/event_add', ['events' => $events, 'kidDataArray' => $itemDataArray, 'kids' => $kids]);
        } else if (!$events && !$itemDataArray) {
            return view('kita/event_add', ['events' => $emptyArray, 'kidDataArray' => $emptyArray, 'kids' => $emptyArray]);
        }
    }

    public function newEvent()
    {
        $emptyArray = array();
        $itemDataArray = array();

        if (Session::has('kidsData')) {
            $itemDataArray = Session::get('kidsData');
        } else if (!Session::has('kidsData')) {
            $itemDataArray = $emptyArray;
        }
        $events = DB::table('events')->get();
        $kids = DB::table('kids')->get();
        $groups = DB::table('groups')->get();
        if ($events && $kids && $groups) {
            return view('kita/event_add', ['events' => $events, 'kids' => $kids, 'kidDataArray' => $itemDataArray, 'groups' => $groups]);
        } else if (!$events && !$kids && !$groups) {
            return view('kita/event_add', ['events' => $emptyArray, 'kids' => $emptyArray, 'kidDataArray' => $itemDataArray, 'groups' => $emptyArray]);
        }
    }

    public function add_new_event(Request $request)
    {
        $DataArray = array();

        // if (Session::has('kidsData')) {
        //     $itemDataArray = Session::get('kidsData');
        // }

        $photos = $request->file('photos');
        if ($request->hasFile('photos')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            foreach ($photos as $photo) {
                $filename = $photo->getClientOriginalName();
                $new_file_name = md5($photo->getClientOriginalName());
                $extension = $photo->getClientOriginalExtension();
                $disk = 'public';
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = '/uploads/photos/';
                    $filePath = $folder . md5($photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
                    $file = $photo->storeAs($folder, $new_file_name . '.' . $photo->getClientOriginalExtension(), $disk);

                    $imgArray = array(
                        "imagePath" => $filePath,
                    );

                    $imageDataArray = array();

                    Session::push('imageData', $imgArray);
                    if (Session::has('imageData')) {
                        $imageDataArray = Session::get('imageData');
                    } else if (!Session::has('imageData')) {
                        $imageDataArray = $imgArray;
                    }

                    $date = $request->mydate;
                    $timestamp = strtotime($request->mydate);

                    $month = date('M', $timestamp);
                    $myDates = date('d', $timestamp);
                    $myYear = date("Y");

                    $event = new Events();
                    $event->kita_admin_id = Session::get('loggedUserId');
                    $event->added_date = $request->mydate;
                    $event->start_time = $request->startTime;
                    $event->end_time = $request->endTime;
                    $event->date = $myDates;
                    $event->month = $month;
                    $event->year = $myYear;
                    $event->title = $request->title;
                    $event->description = $request->des;
                    $event->event_type = $request->types;
                    $event->images = json_encode($imageDataArray);

                    if ($request->group_id) {
                        $kids = DB::table('kids')
                            ->where('group_id', $request->group_id)
                            ->get();

                        foreach ($kids as $kd) {
                            // $data = array(
                            //     'kid_id' => $kd->id,
                            //     'kid_name' => $kd->first_name.' '.$kd->last_name,
                            // );
                            array_push($DataArray, array('kid_id' => $kd->id, 'kid_name' => $kd->first_name . ' ' . $kd->last_name));
                        }
                        $event->users = json_encode($DataArray);
                    } else if (!$request->group_id) {
                        $event->users = $request->kidsArray;
                    }

                    $status = $event->save();
                    Session::forget('kidsData');
                    Session::forget('imageData');

                    if ($status == 1) {
                        if ($request->types == 2) {
                            $client = new OneSignalClient(
                                getenv('APP_ID'),
                                getenv('REST_API_KEY'),
                                getenv('USER_AUTH_KEY')
                            );

                            $url = 'http://localhost/';
                            $data = array(
                                'en' => 'hello users',
                            );
                            $appID = "40f62a0e-9f3a-41a1-b748-efbf5cf33223";

                            $msg = $this->sendMessage($appID, $request->des);
                            echo $msg;
                        }

                        return redirect('/new-event');
                    } else if ($status == 0) {
                        echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
                    }
                }
            }
        }
    }

    public function newRegister()
    {
        $emptyArray = array();

        $register = DB::table('daily_registers')
            ->join('kids', 'kids.id', '=', 'daily_registers.kid_id')
            ->join('groups', 'groups.id', '=', 'daily_registers.group_id')
            ->join('parents', 'parents.id', '=', 'daily_registers.parent_id')
            ->select('daily_registers.*', 'kids.first_name as fName', 'kids.last_name as lName', 'kids.id as kiid', 'groups.name as groupName', 'parents.first_name as pfName', 'parents.last_name as plName')
            // ->groupBy('daily_register.id')
            ->get();

        if ($register) {
            return view('kita/register_add', ['register' => $register]);
        } else if (!$register) {
            return view('kita/register_add', ['register' => $emptyArray]);
        }
    }

    public function searchRegister(Request $request)
    {
        $emptyArray = array();

        $register = DB::table('daily_registers')
            ->join('kids', 'kids.id', '=', 'daily_registers.kid_id')
            ->join('groups', 'groups.id', '=', 'daily_registers.group_id')
            ->join('parents', 'parents.id', '=', 'daily_registers.parent_id')
            ->select('daily_registers.*', 'kids.first_name as fName', 'kids.last_name as lName', 'kids.id as kiid', 'groups.name as groupName', 'parents.first_name as pfName', 'parents.last_name as plName')
            ->where('daily_registers.added_date', '=', $request->mydate)
            ->get();

        if ($register) {
            return view('kita/register_add', ['register' => $register]);
        } else if (!$register) {
            return view('kita/register_add', ['register' => $emptyArray]);
        }
    }

    public function deleteNews(Request $request)
    {
        $nid = $request->news_id;
        $status = DB::table('news')
            ->where('id', '=', $nid)
            ->delete();
        if ($status == 1) {
            return redirect('/new-news');
        } else if ($status == 0) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function deleteParent(Request $request)
    {
        $nid = $request->parent_id;
        $status = DB::table('parents')
            ->where('id', '=', $nid)
            ->delete();
        if ($status == 1) {
            return redirect('/new-parent');
        } else if ($status == 0) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function deleteKid(Request $request)
    {
        $nid = $request->kids_id;
        $status = DB::table('kids')
            ->where('id', '=', $nid)
            ->delete();
        if ($status == 1) {
            return redirect('/new-kid');
        } else if ($status == 0) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function getNewsData(Request $request)
    {
        $news = DB::table('news')
            ->where('id', $request->news_id)
            ->first();

        $emptyArray = array();
        if ($news) {
            echo json_encode($news);
        } else if (!$news) {
            echo json_encode($emptyArray);
        }
    }

    public function getKidsData(Request $request)
    {
        $kids = DB::table('kids')
            ->where('id', $request->kid_id)
            ->first();

        $emptyArray = array();
        if ($kids) {
            echo json_encode($kids);
        } else if (!$kids) {
            echo json_encode($emptyArray);
        }
    }

    public function getParentData(Request $request)
    {
        $parents = DB::table('parents')
            ->where('id', $request->parent_id)
            ->first();

        $emptyArray = array();
        if ($parents) {
            echo json_encode($parents);
        } else if (!$parents) {
            echo json_encode($emptyArray);
        }
    }

    public function getParentDetails(Request $request)
    {
        $parents = DB::table('parents')
            ->get();

        $emptyArray = array();
        if ($parents) {
            echo json_encode($parents);
        } else if (!$parents) {
            echo json_encode($emptyArray);
        }
    }

    public function getGroupData(Request $request)
    {
        $groups = DB::table('groups')
            ->where('id', $request->group_id)
            ->first();

        $emptyArray = array();
        if ($groups) {
            echo json_encode($groups);
        } else if (!$groups) {
            echo json_encode($emptyArray);
        }
    }

    public function getMealData(Request $request)
    {
        $meals = DB::table('meals')
            ->where('id', $request->meal_id)
            ->first();

        $emptyArray = array();
        if ($meals) {
            echo json_encode($meals);
        } else if (!$meals) {
            echo json_encode($emptyArray);
        }
    }

    public function getKitaData(Request $request)
    {
        $users = DB::table('all_users')
            ->where('id', $request->kita_id)
            ->first();

        echo json_encode($users);
        exit();

        $emptyArray = array();
        if ($users) {
            echo json_encode($users);
        } else if (!$users) {
            echo json_encode($emptyArray);
        }
    }

    public function editNews(Request $request)
    {
        $photos = $request->file('photoss');
        if ($request->hasFile('photoss')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            foreach ($photos as $photo) {
                $filename = $photo->getClientOriginalName();
                $new_file_name = md5($photo->getClientOriginalName());
                $extension = $photo->getClientOriginalExtension();
                $disk = 'public';
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = '/uploads/photos/';
                    $filePath = $folder . md5($photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
                    $file = $photo->storeAs($folder, $new_file_name . '.' . $photo->getClientOriginalExtension(), $disk);

                    $status = DB::table('news')
                        ->where('id', $request->new_id)
                        ->where('kita_admin_id', Session::get('loggedUserId'))
                        ->update([
                            'title' => $request->titles, 'description' => $request->dess, 'added_date' => $request->mydates,
                            'image' => $filePath,
                        ]);

                    if ($status) {
                        return redirect('/new-news');
                    } else if (!$status) {
                        echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
                    }
                }
            }
        } else if (!$request->hasFile('photoss')) {
            $status = DB::table('news')
                ->where('id', $request->new_id)
                ->where('kita_admin_id', Session::get('loggedUserId'))
                ->update([
                    'title' => $request->titles, 'description' => $request->dess, 'added_date' => $request->mydates,
                    'image' => NULL,
                ]);

            if ($status) {
                return redirect('/new-news');
            } else if (!$status) {
                echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
            }
        }
    }

    public function editGroup(Request $request)
    {
        $photos = $request->file('photoss');
        if ($request->hasFile('photoss')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            foreach ($photos as $photo) {
                $filename = $photo->getClientOriginalName();
                $new_file_name = md5($photo->getClientOriginalName());
                $extension = $photo->getClientOriginalExtension();
                $disk = 'public';
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = '/uploads/photos/';
                    $filePath = $folder . md5($photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
                    $file = $photo->storeAs($folder, $new_file_name . '.' . $photo->getClientOriginalExtension(), $disk);

                    $status = DB::table('groups')
                        ->where('id', $request->gr_id)
                        ->where('kita_admin_id', Session::get('loggedUserId'))
                        ->update([
                            'name' => $request->names, 'description' => $request->dess, 'color' => $request->colors,
                            'image' => $filePath,
                        ]);

                    if ($status) {
                        return redirect('/new-group');
                    } else if (!$status) {
                        echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
                    }
                }
            }
        } else if (!$request->hasFile('photoss')) {
            $status = DB::table('groups')
                ->where('id', $request->gr_id)
                ->where('kita_admin_id', Session::get('loggedUserId'))
                ->update([
                    'name' => $request->names, 'description' => $request->dess, 'color' => $request->colors,
                    'image' => NULL,
                ]);

            if ($status) {
                return redirect('/new-group');
            } else if (!$status) {
                echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
            }
        }
    }

    public function editKita(Request $request)
    {
        $photos = $request->file('photoss');
        if ($request->hasFile('photoss')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            foreach ($photos as $photo) {
                $filename = $photo->getClientOriginalName();
                $new_file_name = md5($photo->getClientOriginalName());
                $extension = $photo->getClientOriginalExtension();
                $disk = 'public';
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $folder = '/uploads/photos/';
                    $filePath = $folder . md5($photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();
                    $file = $photo->storeAs($folder, $new_file_name . '.' . $photo->getClientOriginalExtension(), $disk);

                    $status = DB::table('all_users')
                        ->where('id', $request->kita_id)
                        ->update([
                            'first_name' => $request->fnameU, 'last_name' => $request->lnameU, 'kindergarden_name' => $request->kinameU,
                            'city' => $request->cityU, 'state' => $request->stateU, 'postal_code' => $request->zipU, 'address' => $request->addressU,
                            'image' => $filePath, 'email' => $request->emailU, 'telephone' => $request->teleU
                        ]);

                    if ($status) {
                        return redirect('/admin-dashboard');
                    } else if (!$status) {
                        echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
                    }
                }
            }
        } else if (!$request->hasFile('photoss')) {
            $status = DB::table('all_users')
                ->where('id', $request->kit_id)
                ->update([
                    'first_name' => $request->fnameU, 'last_name' => $request->lnameU, 'kindergarden_name' => $request->kinameU,
                    'city' => $request->cityU, 'state' => $request->stateU, 'postal_code' => $request->zipU, 'address' => $request->addressU,
                    'image' => NULL, 'email' => $request->emailU, 'telephone' => $request->teleU
                ]);

            if ($status) {
                return redirect('/admin-dashboard');
            } else if (!$status) {
                echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
            }
        }
    }

    public function editParent(Request $request)
    {
        $notif = 0;
        $eml = 0;
        if ($request->notis) {
            $notif = 1;
        } else if (!$request->notis) {
            $notif = 0;
        }

        if ($request->emas) {
            $eml = 1;
        } else if (!$request->emas) {
            $eml = 0;
        }

        $status = DB::table('parents')
            ->where('id', $request->pa_id)
            ->where('kita_admin_id', Session::get('loggedUserId'))
            ->update([
                'email' => $request->emails, 'telephone' => $request->teles, 'first_name' => $request->fnames,
                'last_name' => $request->lnames, 'notification_access' => $notif, 'email_allow' => $eml,
                'parent_type' => $request->typess,
            ]);

        if ($status) {
            return redirect('/new-parent');
        } else if (!$status) {
            echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function editKid(Request $request)
    {
        $status = DB::table('kids')
            ->where('id', $request->k_id)
            ->where('kita_admin_id', Session::get('loggedUserId'))
            ->update([
                'first_name' => $request->fnames, 'last_name' => $request->lnames, 'year' => $request->years,
                'group_id' => $request->groupss, 'parent_id' => $request->parentss, 'parent_type' => $request->typess,
            ]);

        if ($status) {
            return redirect('/new-kid');
        } else if (!$status) {
            echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function deleteMeal(Request $request)
    {
        $nid = $request->meal_id;
        $status = DB::table('meals')
            ->where('id', '=', $nid)
            ->delete();
        if ($status == 1) {
            return redirect('/new-meal');
        } else if ($status == 0) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function deleteEvent(Request $request)
    {
        $nid = $request->event_id;
        $status = DB::table('events')
            ->where('id', '=', $nid)
            ->delete();
        if ($status == 1) {
            return redirect('/new-event');
        } else if ($status == 0) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function deleteGroup(Request $request)
    {
        $nid = $request->group_id;
        $status = DB::table('groups')
            ->where('id', '=', $nid)
            ->delete();
        if ($status == 1) {
            return redirect('/new-group');
        } else if ($status == 0) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to dashboard</a>";
        }
    }

    public function sendMessage($app_id, $message)
    {
        $content = array(
            "en" => $message,
        );
        $hashes_array = array();
        array_push($hashes_array, array(
            "id" => "like-button",
            "text" => "Like",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://yoursite.com",
        ));
        array_push($hashes_array, array(
            "id" => "like-button-2",
            "text" => "Like2",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://yoursite.com",
        ));
        $fields = array(
            'app_id' => $app_id,
            'included_segments' => array(
                'Subscribed Users',
            ),
            'data' => array(
                "foo" => "bar",
            ),
            'contents' => $content,
            'web_buttons' => $hashes_array,
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic MzQwYmJmMzYtNmNmMy00YWFhLTg5NjQtYmJkMjg1NWU3ZDQ1',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function getparentFeedbacks()
    {
        $feedbacks = DB::table('feedbacks')
            ->join('events', 'events.id', '=', 'feedbacks.message_id')
            ->join('parents', 'parents.id', '=', 'feedbacks.parent_id')
            ->select('feedbacks.feedback as feedback', 'parents.first_name as parentName', 'events.description as message')
            // ->groupBy('daily_register.id')
            ->get();

        $emptyArray = array();
        if ($feedbacks) {
            echo json_encode($feedbacks);
        } else if (!$feedbacks) {
            echo json_encode($emptyArray);
        }
    }

    public function parentFeedbacks()
    {
        return view('admin/parent_feedbacks');
        // $emptyArray = array();
        // $feedbacks = DB::table('block_boards')->get();
        // if ($feedbacks) {
        //     return view('admin/parent_feedbacks', ['feedbacks' => $feedbacks]);
        // } else if (!$feedbacks) {
        //     return view('admin/parent_feedbacks', ['feedbacks' => $emptyArray]);
        // }
    }

    public function user_login_parent(Request $request)
    {
        $userName = 'chamara_054912';
        $password = '2103110549';
        $emptyArray = array();

        $parent = DB::table('parents')
            ->where('username', $userName)
            ->where('password', md5($password))
            ->first();
        if ($parent) {
            $parentData = DB::table('parents')
                ->where('username', $userName)
                ->first();

            $parentDatas = DB::table('parents')
                ->join('all_users', 'all_users.id', '=', 'parents.kita_admin_id')
                ->select('all_users.*')
                ->where('parents.kita_admin_id', '=', $parentData->kita_admin_id)
                ->orderBy('all_users.id')
                ->first();

            $msg = "success";
            $data = array(
                'status' => $msg,
                'parent' => $parentDatas,
            );
            echo json_encode($data);
        } else if (!$parent) {
            $msg = "error";
            $data = array(
                'status' => $msg,
                'parent' => $emptyArray,
            );
            echo json_encode($data);
        }
    }

    public function getAllKids(Request $request)
    {
        $emptyArray = array();

        $kids = DB::table('kids')
            ->join('groups', 'groups.id', '=', 'kids.group_id')
            ->select('kids.*', 'groups.name as groupName', 'groups.description as groupDescription')
            ->where('kids.parent_id', '=', 13)
            ->orderBy('kids.id')
            ->get();

        if ($kids) {
            echo json_encode($kids);
        } else if (!$kids) {
            echo json_encode($emptyArray);
        }
    }

    public function dateRange()
    {
        $Date = $this->getDatesFromRange('2021-05-17', '2021-05-20');

        $dateAR = json_encode($Date);
        foreach (json_decode($dateAR) as $dt) {
            echo $dt . '<br>';
        }
    }

    public function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {

        // Declare an empty array
        $array = array();

        // Variable that store the date interval
        // of period 1 day
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        // Use loop to store date into array
        foreach ($period as $date) {
            $array[] = $date->format($format);
        }

        // Return the array elements
        return $array;
    }

    public function addHtmlPages()
    {
        return view('admin/html_pages');
    }

    public function getHtmlPages()
    {
        $html = DB::table('html_pages')->get();

        $emptyArray = array();
        if ($html) {
            echo json_encode($html);
        } else if (!$html) {
            echo json_encode($emptyArray);
        }
    }

    public function addNewHTML(Request $request)
    {
        $html = new htmlPages();
        $html->page_name = $request->pageName;
        $html->page_content = $request->pageContent;
        $status = $html->save();

        if ($status) {
            return redirect('/html-pages');
        } else if (!$status) {
            echo "<h1>something went wrong</h1><br><a href='/'>back to home</a>";
        }
    }

    public function getPageContent(Request $request)
    {
        $emptyArray = array();
        $html = DB::table('html_pages')->where('id', $request->page_id)->first();
        if ($html) {
            echo json_encode($html);
        } else if (!$html) {
            echo json_encode($emptyArray);
        }
    }

    public function editHTMLContent(Request $request)
    {
        $status = DB::table('html_pages')
            ->where('id', $request->page_id)
            ->update([
                'page_name' => $request->pageNameU, 'page_content' => $request->pageContentU
            ]);

        if ($status) {
            return redirect('/html-pages');
        } else if (!$status) {
            echo "<h1>nothing to update</h1><br><a href='/'>back to dashboard</a>";
        }
    }
}
