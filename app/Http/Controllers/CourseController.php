<?php

namespace App\Http\Controllers;

use App\Course;
use App\Detail;
use App\University;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.courses')->with('courses',$courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $universities = University::all();
        return view('admin.courses.addCourse')->with("universities",$universities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $this->validate($request,[
            'name'=>"required",
            'cluster'=>"required | integer | max:70",
            'program'=>"required",
            'subjects'=>"required",
            'universities'=>"required",
        ]);
        $course = new Course;
        $course->name = $request->name;
        $course->cluster = $request->cluster;
        $course->program = $request->program;
        $course ->subjects =   $request->subjects;
        $course->universities = $request->input('universities');
        $status = $course->save();
        if($status){
            return redirect()->back()->with("success","Course added successifully !!!");
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {   
        if(Auth::user()->role != 1){
           return redirect()->route('home');
        }
        $courses = Course::all();
        return view('admin.courses.managecourses')->with('courses',$courses);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course ,$id)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $course = Course::find($id);
        $universities = University::all();
        return view('admin.courses.manageCoursesForm')->with(["course"=>$course,"universities"=>$universities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
         //Validation
         $this->validate($request,[
            'name'=>"required",
            'cluster'=>"required | integer | max:70",
            'subjects'=>"required",
            'universities'=>"required",
        ]);
        $course = Course::find($id);
        $course->name = $request->name;
        $course->cluster = $request->cluster;
        $course ->subjects = $request->subjects;
        $course->universities = $request->input('universities');
        $status = $course->save();
        if($status){
            return redirect()->route('managecourses')->with("success","Course updated successifully !!!");
        }
    }


    public function showProgam($program){
        $programs = Course::where('program',$program)->get();

        return view('dashboard.programmes.programmes')->with('courses',$programs);
    }

    public function userProgam(){
        $cluster = ProfileController::getCluster();
        if($cluster==0){
            return redirect()->route('profile')->with("error","Please complete your profile first !!!");
        }
        $courses = Course::where([['cluster','<=',$cluster],['program','=','degree']])->get();
        $courses1 = Course::where([['cluster','<=',$cluster],['program','=','diploma']])->get();
        $courses2 = Course::where([['cluster','<=',$cluster],['program','=','certificate']])->get();
        $courses3 = Course::where([['cluster','<=',$cluster],['program','=','artisan']])->get();

        return view('dashboard.basket.courses',compact('courses','courses1','courses2','courses3'));
    }
    
    public function getSelectedCourse($id){
        $program = Course::where('id',$id)->first();
        return view('dashboard.basket.selected',compact('program'));
    }

   public function getCourseDetails($id) {
    
    $details = Course::with('detail')->findOrFail($id);
    return view('dashboard.basket.details', compact('details'));
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, $id)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $courseToDelete = $course->find($id);
        $deleteStatus = $courseToDelete->delete();
        if($deleteStatus){
            return redirect()->back()->with("success","Course deleted successifully !!!");
        }
    }
}
