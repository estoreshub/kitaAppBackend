<?php

namespace App\Http\Controllers;

use App\allUsers;
use App\Comments;
use App\Feedbacks;
use App\DailyRegister;
use App\selectedEvents;
use App\Posts;
use DB;
use Illuminate\Http\Request;
use DateInterval;
use DatePeriod;
use DateTime;

class ApiController extends Controller
{
	public function getAllEvents(Request $request)
    {
        $emptyArray = array();
        $events = DB::table('events')
            ->where('kita_admin_id', '=', $request->kitaAdminID)
            ->get();
        if ($events) {
            echo json_encode($events);
        } else if (!$events) {
            echo json_encode($emptyArray);
        }
    }
	
	    public function getCalEvents(Request $request)
    {
        $emptyArray = array();
        $events = DB::table('events')
            ->where('kita_admin_id', '=', $request->kitaAdminID)
            ->where('event_type', '=', 1)
            ->get();
        if ($events) {
            echo json_encode($events);
        } else if (!$events) {
            echo json_encode($emptyArray);
        }
    }
	
	    public function getSelectedEvents(Request $request){
        $emptyArray = array();
        $events = DB::table('selected_events')
            ->where('kita_admin_id', '=', $request->kitaAdminID)
            ->where('parent_id', '=', $request->parentID)
            ->where('event_type', '=', 1)
            ->get();
        if ($events) {
            echo json_encode($events);
        } else if (!$events) {
            echo json_encode($emptyArray);
        }
    }
	
	    public function addNewEvent(Request $request)
    {
        $events = DB::table('events')
            ->where('kita_admin_id', '=', $request->kitaAdminID)
            ->where('id', '=', $request->eventID)
            ->get();

        foreach ($events as $evt) {
            $event = new selectedEvents();
            $event->kita_admin_id = $request->kitaAdminID;
            $event->parent_id = $request->parentID;
            $event->added_date = $evt->added_date;
            $event->start_time = $evt->start_time;
            $event->end_time = $evt->end_time;
            $event->date = $evt->date;
            $event->month = $evt->month;
			$event->year = $evt->year;
            $event->title = $evt->title;
            $event->description = $evt->description;
            $event->event_type = $evt->event_type;
            $event->images = $evt->images;
            $event->users = $evt->users;
            $status = $event->save();

            if ($status) {
                $msg = "event added";
                echo json_encode($msg);
            } else if (!$status) {
                $msg = "something went wrong";
                echo json_encode($msg);
            }
        }
    }
	
	public function getAllPosts(Request $request)
    {
        $emptyArray = array();

        $posts = DB::table('posts')
        ->where('parent_id', '=', $request->parentID)
        ->get();

        if ($posts) {
            echo json_encode($posts);
        } else if (!$posts) {
            echo json_encode($emptyArray);
        }
    }

    public function getAllMeals()
    {
        $emptyArray = array();
        $meals = DB::table('meals')->get();
        if ($meals) {
            echo json_encode($meals);
        } else if (!$meals) {
            echo json_encode($emptyArray);
        }
    }

    public function getAllKids(Request $request)
    {
        $emptyArray = array();

        $kids = DB::table('kids')
            ->join('groups', 'groups.id', '=', 'kids.group_id')
            ->select('kids.*', 'groups.name as groupName', 'groups.description as groupDescription')
            ->where('kids.parent_id', '=', $request->parentID)
			->where('kids.status', '=', 1)
            ->orderBy('kids.id')
            ->get();

        if ($kids) {
            echo json_encode($kids);
        } else if (!$kids) {
            echo json_encode($emptyArray);
        }
    }

    public function dailyAttendance(Request $request)
    {
        $status = 0;
        $kidsData = DB::table('kids')
            ->where('id', $request->kidID)
            ->first();
		
		$Date = $this->getDatesFromRange('2021-05-17', '2021-05-20');

        $dateAR=json_encode($Date);
		foreach(json_decode($dateAR) as $dt){
			
		$dr = new DailyRegister();
        $dr->kita_admin_id = $kidsData->kita_admin_id;
        $dr->kid_id = $request->kidID;
        $dr->group_id = $kidsData->group_id;
        $dr->parent_id = $kidsData->parent_id;
        $dr->added_date = $dt;
        $dr->from_date = $request->fromDate;
        $dr->to_date = $request->toDate;
        $dr->reason = $request->reason;
        $dr->status = 0;
        $status = $dr->save();
		}

        if ($status) {
            $msg = "success";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        } else if (!$status) {
            $msg = "error";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        }
    }

    public function sendFeedbacks(Request $request)
    {
        $eventData = DB::table('events')
            ->where('id', $request->messageID)
            ->first();

        $feedback = new Feedbacks();
        $feedback->message_id = $request->messageID;
        $feedback->parent_id = $request->parentID;
        $feedback->kita_admin_id = $eventData->kita_admin_id;
        $feedback->feedback = $request->feedback;
        $status = $feedback->save();

        if ($status) {
            $msg = "success";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        } else if (!$status) {
            $msg = "error";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        }
    }

 	public function addNewPost(Request $request)
    {
		//$photos = json_encode($request->file('photo'));
		//echo $photos;
		//exit();

         //if ($request->hasFile("photo")) {
             //$allowedfileExtension = ['jpg', 'png'];
             //foreach ($photos as $photo) {
                 //$filename = $request->filename;
				 //echo $filename;
				 //exit();
                 /*$new_file_name = md5($request->filename);
                 $extension = $request->filetype;
                 $disk = 'public';
                 $check = in_array($extension, $allowedfileExtension);
                 if ($check) {
                     $folder = '/uploads/photos/';
                     $filePath = $folder . md5($request->filename) . '.' . $request->filetype;
                     $file = $photo->storeAs($folder, $new_file_name . '.' . $request->filetype, $disk);*/

                     $parentData = DB::table('parents')
                         ->where('id', $request->parentID)
                       ->first();

                    $post = new Posts();
                    $post->parent_id = $request->parentID;
                    $post->kita_admin_id = $parentData->kita_admin_id;
                    $post->title = $request->title;
                    $post->description = $request->description;
                    $post->image = '';
                    $post->status = 'available';
                    $status = $post->save();

                    if ($status) {
                         $posts = DB::table('posts')->get();
                         $msg = "success";
                         $data = array(
                             'status' => $msg,
                             'all_posts' => $posts,
                         );
                         echo json_encode($data);
                     } else if (!$status) {
                        $emptyArray = array();
                        $msg = "error";
                         $data = array(
                             'status' => $msg,
                             'all_posts' => $emptyArray,
                         );
                         echo json_encode($data);
                     }
                 //}
           // }
        //}
    }

    public function editPost(Request $request)
    {
        $postData = DB::table('posts')
            ->where('id', $request->postID)
            ->first();

        $status = DB::table('posts')
            ->where('id', $request->postID)
            ->where('parent_id', $postData->parent_id)
            ->where('kita_admin_id', $postData->kita_admin_id)
            ->update([
                'title' => $request->title, 'description' => $request->description,
                'image' => '','status'=> $request->status
            ]);

        if ($status) {
            $posts = DB::table('posts')
                ->get();
            $msg = "success";
            $data = array(
                'status' => $msg,
                'all_posts' => $posts,
            );
            echo json_encode($data);
        } else if (!$status) {
            $emptyArray = array();
            $msg = "error";
            $data = array(
                'status' => $msg,
                'all_posts' => $emptyArray,
            );
            echo json_encode($data);
        }
    }

    public function addNewComment(Request $request)
    {
        $postData = DB::table('posts')
            ->where('id', $request->postID)
            ->first();

        $comment = new Comments();
        $comment->parent_id = $postData->parent_id;
        $comment->kita_admin_id = $postData->kita_admin_id;
        $comment->post_id = $request->postID;
        $comment->comment = $request->comment;
        $status = $comment->save();

        if ($status) {
            $msg = "success";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        } else if (!$status) {
            $msg = "error";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        }
    }

    public function validateQrCode(Request $request)
    {
        $userCode = $request->qrCode;

        $parent = DB::table('parents')
            ->where('usercode', $userCode)
            ->first();
        if ($parent) {
            $msg = "success";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        } else if (!$parent) {
            $msg = "error";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        }
    }

    public function user_login_parent(Request $request)
    {
        $userName = $request->userName;
        $password = $request->pass;
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
				'parentData' => $parentData
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

    public function validateQrCodeChild(Request $request)
    {
        $userCode = $request->userCode;

        $kid = DB::table('kids')
            ->where('user_code', $userCode)
            ->first();
        if ($kid) {
            $msg = "success";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        } else if (!$kid) {
            $msg = "error";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        }
    }

    public function saveKitaUser(Request $request)
    {
        $msg = "";
        $cDate = date('Ymd');
        $username = $request->fname . '' . $cDate;

        $usr = new allUsers();
        $usr->first_name = $request->fname;
        $usr->last_name = $request->lname;
        $usr->email = $request->email;
        $usr->password = $request->password;
        $usr->telephone = $request->tele;
        $usr->user_type_id = 2;
        $usr->username = $username;
        $status = $usr->save();
        if ($status == 1) {
            // start email
            // $from = 'superadmin@mail.com';
            // $to = $request->email;

            // Session::put('htmlEmailFrom', $from);
            // Session::put('htmlEmailTo', $to);

            // $data = array(
            //     'name' => $request->fname,
            //     'username' => $username,
            //     'password' => $request->password,
            // );

            // Mail::send('mail/credentials', $data, function ($message) {
            //     $message->to(Session::get('htmlEmailTo'), 'Tutorials Point')->subject('Login Credentials');
            //     $message->from(Session::get('htmlEmailFrom'), 'www.kitaproject.com');
            // });
            // end email
            $msg = "success";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        } else if ($status == 0) {
            $msg = "error";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        }
    }
	
    public function getAllComments(Request $request)
    {
        $emptyArray = array();
        $comments = DB::table('comments')
            ->join('parents', 'parents.id', '=', 'comments.parent_id')
            ->select('comments.*', 'parents.first_name as firstName', 'parents.last_name as lastName')
            ->where('comments.post_id', '=', $request->postID)
            ->orderBy('comments.id')
            ->get();
        if ($comments) {
            echo json_encode($comments);
        } else if (!$comments) {
            echo json_encode($emptyArray);
        }
    }
	
	public function addFeedback(Request $request)
    {
        $parentData = DB::table('parents')
            ->where('id', $request->parentID)
            ->first();

        $feedback = new Feedbacks();
        $feedback->message_id = $request->messageID;
        $feedback->parent_id = $request->parentID;
        $feedback->kita_admin_id = $parentData->kita_admin_id;
        $feedback->feedback = $request->feedback;
        $feedback->dataURL = $request->dataURL;
        $status = $feedback->save();

        if ($status) {
            $msg = "success";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        } else if (!$status) {
            $msg = "error";
            $data = array(
                'status' => $msg,
            );
            echo json_encode($data);
        }
    }
	
	    public function getPageContent(Request $request)
    {
        $emptyArray = array();
        $pages = DB::table('html_pages')
            ->where('page_name', '=', $request->pageName)
            ->get();

        if ($pages) {
            echo json_encode($pages);
        } else if (!$pages) {
            echo json_encode($emptyArray);
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
	
	    public function getAbsentKids(Request $request)
    {
        $cDate = date('Y-m-d');
        $emptyArray = array();

        $abkids = DB::table('daily_registers')
            ->where('parent_id', '=', $request->parentID)
            ->where('added_date', '=', $cDate)
            ->get();

        if ($abkids) {
            echo json_encode($abkids);
        } else if (!$abkids) {
            echo json_encode($emptyArray);
        }
    }
	
	    public function verifyKid(Request $request)
    {
        $kidsData = DB::table('kids')
            ->where('parent_id', '=', $request->parentID)
            ->where('user_code', '=', $request->kidCode)
            ->get();

        $emptyArray=array();

        if ($kidsData) {
            echo json_encode($kidsData);
        } else if (!$kidsData) {
            echo json_encode($emptyArray);
        }
    }
	
	    public function updateKid(Request $request)
    {
        $parentData = DB::table('parents')
            ->where('id', '=', $request->parentID)
            ->where('username', '=', $request->userName)
            ->where('password', '=', $request->passWord)
            ->get();

        if ($parentData) {
            $status = DB::table('kids')
                ->where('parent_id', $request->parentID)
                ->where('user_code', $request->kidCode)
                ->update([
                    'status' => 1
                ]);

            if ($status) {
                $msg = 'Kid Added';
                echo json_encode($msg);
            } else if (!$status) {
                $msg = 'Something Went Wrong';
                echo json_encode($msg);
            }
        } else if (!$parentData) {
            $msg = 'Authentication Error';
            echo json_encode($msg);
        }
    }
}
