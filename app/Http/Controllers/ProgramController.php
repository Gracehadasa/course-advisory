<?php

namespace App\Http\Controllers;

use App\Program;
use App\University;
use App\Course;
use Illuminate\Http\Request;
use Auth;


class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myprograms = Program::where('userid',Auth::user()->id)->get();
        return view('dashboard.basket.basket',compact('myprograms'));
    }
    public function index2()
    {
        $myprograms = Program::where('userid',Auth::user()->id)->get();
        return view('dashboard.basket.basketprintpreview',compact('myprograms'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {

        //vallidation
        $this->validate($request,[
            "institution"=>'required',
            'rate' => 'required'
        ]);

        $coursebasketsize = Program::where('userid',Auth::user()->id)->count();
        if($coursebasketsize > 4){
            return redirect()->route('basket')->with("error","Sorry, You have reached the maximum progrmas required !!!");
        }
        $uni = $request->institution;
        $userid = Auth::user()->id;
        $programSelect = Course::where('id',$id)->first();
        $institution = University::where('name',$uni)->first();

        $similarProgram = Program::where([
            ['userid','=',Auth::user()->id],
            ['institution','=',$uni],
            ['program','=',$programSelect->name]])->first();
            if($similarProgram){
                return redirect()->route('basket')->with("error","Sorry, You have selected a similar programme !!!");
  
            }

        $program = new Program;
        $program->userid = $userid;
        $program->institution = $uni;
        $program->institutiontype = $institution->institution;
        $program->program = $programSelect->name;
        $program->programtype = $programSelect->program;

        if($program->save()){
            $post = Course::find($request->id);
            $rating = new \willvincent\Rateable\Rating;
            $rating->rating = $request->rate;
            $rating->user_id = Auth::user()->id;
            $post->ratings()->save($rating);
            return redirect()->route('basket')->with('success','Program added to course busket successifully !!!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program, $id)
    {
        //
        $basketToDelete = Program::where('id',$id)->first();
    if($basketToDelete->delete()){
        return redirect()->back()->with("success","The program was deleted successifully !!!");
    }
    }
}
