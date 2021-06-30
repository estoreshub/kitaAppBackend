<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/all_students', 'ApiController@getAllStudents');

Route::post('/add_kita-admin', 'ApiController@saveKitaUser');

Route::post('/validate_qr_code', 'ApiController@validateQrCode');

Route::post('/user_login', 'ApiController@user_login_parent');

Route::post('/get_events', 'ApiController@getAllEvents');

Route::post('/get_meals', 'ApiController@getAllMeals');

Route::post('/validate_kid_code', 'ApiController@validateQrCodeChild');

Route::post('/get_kids', 'ApiController@getAllKids');

Route::post('/send_feedback', 'ApiController@sendFeedbacks');

Route::post('/add_post', 'ApiController@addNewPost');

Route::post('/edit_post', 'ApiController@editPost');

Route::post('/add_comments', 'ApiController@addNewComment');

Route::post('/get_posts', 'ApiController@getAllPosts');

Route::post('/all_comments', 'ApiController@getAllComments');

Route::post('/add_feedbacks', 'ApiController@addFeedback');

Route::post('/daily_attendance', 'ApiController@dailyAttendance');

Route::post('/page_content', 'ApiController@getPageContent');

Route::post('/absent_kids', 'ApiController@getAbsentKids');

Route::post('/verify_kid', 'ApiController@verifyKid');

Route::post('/update_kid', 'ApiController@updateKid');

Route::post('/get_cal_events', 'ApiController@getCalEvents');

Route::post('/get_all_selected_events', 'ApiController@getSelectedEvents');

Route::post('/add_new_event', 'ApiController@addNewEvent');