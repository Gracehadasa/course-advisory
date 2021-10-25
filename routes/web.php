<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/adminHome', 'HomeController@adminHome')->name('adminHome')->middleware('auth');
Route::get('/about', 'GeneralController@about')->name('about');
Route::get('/courses', 'GeneralController@courses')->name('courses');
Route::get('/contact', 'GeneralController@contact')->name('contact')->middleware('auth');

Route::get('/courses', 'CourseController@index')->name('courses')->middleware('auth');
Route::get('/courseform', 'CourseController@create')->name('courseform')->middleware('auth');
Route::get('/managecourses', 'CourseController@show')->name('managecourses')->middleware('auth');
Route::Post('/addcourse', 'CourseController@store')->name('addcourse')->middleware('auth');
Route::get('/managecoursesform/{id}', 'CourseController@edit')->name('managecoursesform')->middleware('auth');
Route::Post('/updatecourse/{id}', 'CourseController@update')->name('updatecourse')->middleware('auth');
Route::get('/deletecourse/{id}', 'CourseController@destroy')->name('deletecourse')->middleware('auth');
Route::get('/programs/{program}', 'CourseController@showProgam')->name('programmes')->middleware('auth');
Route::get('/userProgam', 'CourseController@userProgam')->name('userProgam')->middleware('auth');
Route::get('/getSelectedCourse/{id}', 'CourseController@getSelectedCourse')->name('getSelectedCourse')->middleware('auth');
Route::get('/course/details/{id}', 'CourseController@getCourseDetails')->name('coursedetails')->middleware('auth');

Route::get('detail/create', 'DetailController@create')->name('detail.create');
Route::get('details', 'DetailController@index')->name('detail.index');
Route::post('detail/create', 'DetailController@store')->name('detail.store');
Route::get('detail/{id}', 'DetailController@show')->name('detail.show');
Route::post('detail/update/{id}', 'DetailController@update')->name('detail.update');
Route::get('detail/delete/{id}', 'DetailController@destroy')->name('detail.delete');


Route::get('/universities', 'UniversityController@index')->name('universities')->middleware('auth');
Route::get('/universityform', 'UniversityController@create')->name('universityform')->middleware('auth');
Route::Post('/adduniversity', 'UniversityController@store')->name('adduniversity')->middleware('auth');
Route::get('/manageuniversity', 'UniversityController@show')->name('manageuniversity')->middleware('auth');
Route::get('/updateform/{id}', 'UniversityController@edit')->name('updateform')->middleware('auth');
Route::post('/update/{id}', 'UniversityController@update')->name('update')->middleware('auth');
Route::get('/delete/{id}', 'UniversityController@destroy')->name('delete')->middleware('auth');

Route::get('/all', 'MessageController@index')->name('allmessages')->middleware('auth');
Route::Post('/sendmessage', 'MessageController@store')->name('sendmessage')->middleware('auth');
Route::get('/replymessages', 'MessageController@show')->name('replymessages')->middleware('auth');
Route::get('/showoutbox', 'MessageController@showoutbox')->name('showoutbox')->middleware('auth');
Route::get('/replyform/{id}', 'MessageController@edit')->name('replyform')->middleware('auth');
Route::post('/reply/{id}', 'MessageController@update')->name('reply')->middleware('auth');
Route::get('/deletemessage/{id}', 'MessageController@destroy')->name('deletemessage')->middleware('auth');
Route::get('/userSentMessages', 'MessageController@userSentMessages')->name('userSentMessages')->middleware('auth');
Route::get('/userInbox', 'MessageController@userInbox')->name('userInbox')->middleware('auth');
Route::get('/userReply/{id}', 'MessageController@userReply')->name('userreplyform')->middleware('auth');
Route::post('/userreply/{id}', 'MessageController@postUserReply')->name('userreply')->middleware('auth');


Route::get('/users', 'HomeController@users')->name('users')->middleware('auth');
Route::get('/deleteuser/{id}', 'HomeController@destroy')->name('deleteuser')->middleware('auth');
Route::get('/allusers', 'HomeController@allusers')->name('allusers')->middleware('auth');
Route::get('/reports', 'HomeController@reports')->name('reports')->middleware('auth');



/* User routes */
Route::get('/profile','ProfileController@index')->name('profile')->middleware('auth');
Route::post('/updateprofile','ProfileController@store')->name('updateprofile')->middleware('auth');
Route::get('/myprofile','ProfileController@profile')->name('myprofile')->middleware('auth');

/* institutions */
Route::get('/institution/{institution}','UniversityController@institution')->name('institutions')->middleware('auth');
Route::get('/institutions','UniversityController@allInstitution')->name('allInstitution')->middleware('auth');
Route::get('/uni','UniversityController@uni')->name('uni')->middleware('auth')->middleware('auth');
Route::get('/cole','UniversityController@cole')->name('cole')->middleware('auth')->middleware('auth');

Route::post('/addcoursetobasket/{id}','ProgramController@store')->name('addcoursetobasket')->middleware('auth');
Route::get('/basket','ProgramController@index')->name('basket')->middleware('auth');
Route::get('/basket2','ProgramController@index2')->name('basket2')->middleware('auth');
Route::get('/basketdelete/{id}','ProgramController@destroy')->name('deletebasket')->middleware('auth');

Route::get('/createSms','SMSController@createSms')->name('createSms')->middleware('auth');


Route::post('/checkPhone','OTPController@checkPhone')->name('checkPhone');
Route::post('/updatePassword','OTPController@updatePassword')->name('updatePassword');
Route::get('/reset','OTPController@reset')->name('reset');





