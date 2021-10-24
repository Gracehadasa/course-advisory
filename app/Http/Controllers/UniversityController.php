<?php

namespace App\Http\Controllers;

use App\University;
use Illuminate\Http\Request;
use Auth;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $universities = University::all();
        return view('admin.universities.universities')->with("universities",$universities);
    }
    
    public function allInstitution(){
        $institutions = University::all();
         return response()->json($institutions);
    }

    public function institution($institution){
        $institutions = University::where('institution',$institution)->get();
        return response()->json($institutions);
    }
    public function uni(){
        $institutions = University::where('institution',"university")->get();
        return view('dashboard.institutions.universities')->with('universities',$institutions);
    }
    public function cole(){
        $institutions = University::where('institution',"college")->get();
        return view('dashboard.institutions.colleges')->with('universities',$institutions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        return view('admin.universities.addUniversity');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        //Validation
        $this->validate($request,[
           'name' => 'required | unique:universities',
           'institution'=> 'required',
           'phone' => 'required | min:10 | min:10 | unique:universities',
           'location' => 'required',
           'email' => 'required | email | unique:universities',
           'rate'=>'required | min:0 | max:5',
        ]);

        //Store
        $university = new University;
        $university->name =$request->name;
        $university->institution =$request->get('institution');
        $university->phone = $request->phone;
        $university->email = $request->email;
        $university->location = $request->location;
        $status = $university->save();
        if($status){
            $post = University::find($university->id);
            $rating = new \willvincent\Rateable\Rating;
            $rating->rating = $request->rate;
            $rating->user_id = Auth::user()->id;
            $post->ratings()->save($rating);
            return redirect()->back()->with("success","Instituiton added successifully");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $universities = University::all();
        return view('admin.universities.manageuniversities')->with('universities',$universities);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $updateItem = University::find($id);
        return view('admin.universities.updateform')->with("university", $updateItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        //Validation
        $this->validate($request,[
            'name' => 'required ',
           'institution'=> 'required',
           'phone' => 'required | min:10 | min:10',
           'location' => 'required',
           'email' => 'required | email',
           'rate'=>'required | min:0 | max:5',
         ]);
 
         //Store
         $university = University::where('id',$id)->get()->first();
         $university->name =$request->name;
         $university->phone = $request->phone;
         $university->email = $request->email;
         $university->location = $request->location;
         $university->institution =$request->get('institution');
         $status = $university->save();
         if($status){
            $post = University::find($id);
            $rating = new \willvincent\Rateable\Rating;
            $rating->rating = $request->rate;
            $rating->user_id = Auth::user()->id;
            $post->ratings()->save($rating);
            $universities=University::all();
             return view('admin.universities.manageuniversities',compact('universities'))->with("success","Update submitted successifully !!!");
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $universityToDelete = University::find($id);
        $universityToDelete->delete();
        return redirect()->back()->with('success',"The university was deleted successifully !!!");
    }
}
