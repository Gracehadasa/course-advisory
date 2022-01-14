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

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [HomeController::class, "index"])->name('home')->middleware('auth');
Route::get('/adminHome', [HomeController::class, "adminHome"])->name('adminHome')->middleware('auth');
Route::get('/about', [GeneralController::class, 'about'])->name('about');
Route::get('/courses', [GeneralController::class, 'courses'])->name('courses');
Route::get('/contact', [GeneralController::class, 'contact'])->name('contact')->middleware('auth');

Route::get('/courses', [CourseController::class, 'index'])->name('courses')->middleware('auth');
Route::get('/courseform', [CourseController::class, 'create'])->name('courseform')->middleware('auth');
Route::get('/managecourses', [CourseController::class, 'show'])->name('managecourses')->middleware('auth');
Route::Post('/addcourse', [CourseController::class, 'store'])->name('addcourse')->middleware('auth');
Route::get('/managecoursesform/{id}', [CourseController::class, 'edit'])->name('managecoursesform')->middleware('auth');
Route::Post('/updatecourse/{id}', [CourseController::class, 'update'])->name('updatecourse')->middleware('auth');
Route::get('/deletecourse/{id}', [CourseController::class, 'destroy'])->name('deletecourse')->middleware('auth');
Route::get('/programs/{program}', [CourseController::class, 'showProgam'])->name('programmes')->middleware('auth');
Route::get('/userProgam', [CourseController::class, 'userProgam'])->name('userProgam')->middleware('auth');
Route::get('/getSelectedCourse/{id}', [CourseController::class, 'getSelectedCourse'])->name('getSelectedCourse')->middleware('auth');
Route::get('/course/details/{id}', [CourseController::class, 'getCourseDetails'])->name('coursedetails')->middleware('auth');

Route::get('detail/create', [DetailController::class, 'create'])->name('detail.create');
Route::get('details', [DetailController::class, 'index'])->name('detail.index');
Route::post('detail/create', [DetailController::class, 'store'])->name('detail.store');
Route::get('detail/{id}', [DetailController::class, 'show'])->name('detail.show');
Route::post('detail/update/{id}', [DetailController::class, 'update'])->name('detail.update');
Route::get('detail/delete/{id}', [DetailController::class, 'destroy'])->name('detail.delete');


Route::get('/universities', [UniversityController::class, 'index'])->name('universities')->middleware('auth');
Route::get('/universityform', [UniversityController::class, 'create'])->name('universityform')->middleware('auth');
Route::Post('/adduniversity', [UniversityController::class, 'store'])->name('adduniversity')->middleware('auth');
Route::get('/manageuniversity', [UniversityController::class, 'show'])->name('manageuniversity')->middleware('auth');
Route::get('/updateform/{id}', [UniversityController::class, 'edit'])->name('updateform')->middleware('auth');
Route::post('/update/{id}', [UniversityController::class, 'update'])->name('update')->middleware('auth');
Route::get('/delete/{id}', [UniversityController::class, 'destroy'])->name('delete')->middleware('auth');

Route::get('/my-messages', [MessageController::class, 'index'])->name('allmessages')->middleware('auth');
Route::get('/livechat', [MessageController::class, 'liveChat'])->name('liveChat')->middleware('auth');
Route::get('/adminlivechat', [MessageController::class, 'adminLiveChat'])->name('adminLiveChat')->middleware('auth');
Route::Post('/sendmessage', [MessageController::class, 'store'])->name('sendmessage')->middleware('auth');
Route::get('/replymessages', [MessageController::class, 'show'])->name('replymessages')->middleware('auth');
Route::get('/showoutbox', [MessageController::class, 'showoutbox'])->name('showoutbox')->middleware('auth');
Route::get('/replyform/{id}', [MessageController::class, 'edit'])->name('replyform')->middleware('auth');
Route::post('/reply/{id}', [MessageController::class, 'update'])->name('reply')->middleware('auth');
Route::get('/deletemessage/{id}', [MessageController::class, 'destroy'])->name('deletemessage')->middleware('auth');
Route::get('/userSentMessages', [MessageController::class, 'userSentMessages'])->name('userSentMessages')->middleware('auth');
Route::get('/userInbox', [MessageController::class, 'userInbox'])->name('userInbox')->middleware('auth');
Route::get('/userReply/{id}', [MessageController::class, 'userReply'])->name('userreplyform')->middleware('auth');
Route::post('/userreply/{id}', [MessageController::class, 'postUserReply'])->name('userreply')->middleware('auth');


Route::get('/users', [HomeController::class, 'users'])->name('users')->middleware('auth');
Route::get('/deleteuser/{id}', [HomeController::class, 'destroy'])->name('deleteuser')->middleware('auth');
Route::get('/allusers', [HomeController::class, 'allusers'])->name('allusers')->middleware('auth');
Route::get('/reports', [HomeController::class, 'reports'])->name('reports')->middleware('auth');



/* User routes */
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/updateprofile', [ProfileController::class, 'store'])->name('updateprofile')->middleware('auth');
Route::get('/myprofile', [ProfileController::class, 'profile'])->name('myprofile')->middleware('auth');

/* institutions */
Route::get('/institution/{institution}', [UniversityController::class, 'institution'])->name('institutions')->middleware('auth');
Route::get('/institutions', [UniversityController::class, 'allInstitution'])->name('allInstitution')->middleware('auth');
Route::get('/uni', [UniversityController::class, 'uni'])->name('uni')->middleware('auth')->middleware('auth');
Route::get('/cole', [UniversityController::class, 'cole'])->name('cole')->middleware('auth')->middleware('auth');

Route::post('/addcoursetobasket/{id}', [ProgramController::class, 'store'])->name('addcoursetobasket')->middleware('auth');
Route::get('/basket', [ProgramController::class, 'index'])->name('basket')->middleware('auth');
Route::get('/basket2', [ProgramController::class, 'index2'])->name('basket2')->middleware('auth');
Route::get('/basketdelete/{id}', [ProgramController::class, 'destroy'])->name('deletebasket')->middleware('auth');

Route::get('/createSms',[SMSController::class, 'createSms'])->name('createSms')->middleware('auth');


Route::post('/checkPhone', [OTPController::class, 'checkPhone'])->name('checkPhone');
Route::post('/updatePassword', [OTPController::class, 'updatePassword'])->name('updatePassword');
Route::get('/reset', [OTPController::class, 'reset'])->name('reset');





