<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.profile");
    }

    public static function getGrade($value){
        if($value == 12){
            $grade = "A";
        }
        if($value == 11){
            $grade = "A-";
        }
        if($value == 10){
            $grade = "B+";
        }
        if($value == 9){
            $grade = "B";
        }
        if($value == 8){
            $grade = "B-";
        }
        if($value == 7){
            $grade = "C+";
        }
        if($value == 6){
            $grade = "C";
        }
        if($value == 5){
            $grade = "C-";
        }
        if($value == 4){
            $grade = "D+";
        }
        if($value == 3){
            $grade = "D";
        }
        if($value == 2){
            $grade = "D-";
        }
        if($value == 1){
            $grade = "E";
        }
        if($value == 0) {
            $grade = "";
        }
        return $grade;
    }

    public function meanGrade($AGP){
        switch ($AGP){
            case $AGP > 80 :
                $meanGrage = "A";
            break;
            case $AGP > 73 && $AGP < 81:
                $meanGrage = "A-";
            break;
            case $AGP > 66 && $AGP < 74:
                $meanGrage = "B+";
            break; 
            case $AGP > 59 && $AGP < 67:
                $meanGrage = "B";
            break;
            case $AGP > 52 && $AGP < 60:
                $meanGrage = "B-";
            break;
            case $AGP > 45 && $AGP < 53:
                $meanGrage = "C+";
            break;
            case $AGP > 38 && $AGP < 46:
                $meanGrage = "C";
            break;
            case $AGP > 31 && $AGP < 39:
                $meanGrage = "C-";
            break;
            case $AGP > 24 && $AGP < 32:
                $meanGrage = "D+";
            break;
            case $AGP > 17 && $AGP < 25:
                $meanGrage = "D";
            break;
            case $AGP > 10 && $AGP < 18:
                $meanGrage = "D-";
            break;
            case $AGP > 6 && $AGP < 11:
                $meanGrage = "E";
            break;
            default:
            $meanGrage ="NO GRADE YET";
        }
        return $meanGrage;
    }

    public static function AGP(){
        $profile = profile::where('userid',Auth::user()->id)->first();
        if($profile === null){
            $profile = new profile;
            $profile->userid = Auth::user()->id;
            if($profile->save()){
                $profile = profile::where('userid',Auth::user()->id)->first();
            }
        }
       //Group II

       if( ($profile->biology > $profile->physics) && ($profile->biology > $profile->chemistry)){
        $science1 = $profile->biology;
    }
    elseif(($profile->physics > $profile->biology) && ($profile->physics > $profile->chemistry)){
        $science1 = $profile->physics;
    }

    elseif(($profile->chemistry > $profile->physics) && ($profile->chemistry > $profile->biology)){
        $science1 = $profile->chemistry;
    }
    elseif(($profile->chemistry == $profile->physics) && ($profile->chemistry > $profile->biology)){
         $science1 = $profile->chemistry;
    }
    elseif(($profile->chemistry == $profile->biology ) && ($profile->chemistry > $profile->physics)){
        $science1 = $profile->chemistry;
   }
   elseif(($profile->biology == $profile->physics) && ($profile->chemistry < $profile->biology)){
    $science1 = $profile->biology;
}
    elseif(($profile->chemistry==$profile->physics) && ($profile->chemistry==$profile->biology)){
        $science1 = $profile->chemistry;
        $science2 =$profile->chemistry;
    }
    else {
        return redirect()->back()->with("error","Opps!!, Something went wrong please try again later !!!");
    }

    if($science1 == "biology"){
       if($profile->physics > $profile->chemistry){
           $science2 = $profile->physics;
       }
       else {
           $science2 = $profile->chemistry;
       }
    }
    elseif($science1 == "biology" && $profile->physics == $profile->chemistry){
         $science2 == $profile->physics;
    }
    elseif($science1 == "physics" && $profile->biology == $profile->chemistry){
        $science2 == $profile->biology;
   }
   elseif($science1 == "chemistry" && $profile->physics == $profile->biology){
    $science2 == $profile->physics;
   }
    elseif(($science1 == "physics")){
        if($profile->biology > $profile->chemistry){
            $science2 = $profile->biology;
        }
        else {
            $science2 = $profile->chemistry;
        }
    }else{
        if($profile->physics > $profile->biology){
            $science2 = $profile->physics;
        }
        else {
            $science2 = $profile->biology;
        }
    }

    //Group III

    if( $profile->geography > $profile->histroy && $profile->geography > $profile->cre){
        $group3 = $profile->geography;
    }
    elseif($profile->histroy > $profile->geography && $profile->histroy > $profile->cre){
        $group3 = $profile->histroy;
    }

    elseif($profile->cre > $profile->histroy && $profile->cre > $profile->geography){
        $group3 = $profile->cre;
    }
    elseif($profile->cre == $profile->histroy && $profile->cre == $profile->geography){
        $group3 = $profile->cre;
    }
    elseif(($profile->geography == $profile->histroy) && ($profile->geography > $profile->cre)){
        $science1 = $profile->geography;
   }
   elseif(($profile->geography == $profile->cre ) && ($profile->geography > $profile->histroy)){
       $science1 = $profile->geography;
  }
  elseif(($profile->cre == $profile->histroy) && ($profile->geography < $profile->cre)){
   $science1 = $profile->cre;
  }
else {
    return redirect()->back()->with("error","Opps!!, Something went wrong with group 3 subjects please try again later !!!");
}


    //Group IV and V

    if($profile->agriculture >0){
        $group4 = $profile->agriculture;
    }
    else{
        $group4 = $profile->business;
    }

    $AGP = $profile->kiswahili + $profile->english + $profile->mathematics 
            + $science1 + $science2 + $group3 + $group4;

            return $AGP;

    }


    public function profile(){
        $profile = profile::where('userid',Auth::user()->id)->first();
        if($profile === null){
            $profile = new profile;
            $profile->userid = Auth::user()->id;
            if($profile->save()){
                $profile = profile::where('userid',Auth::user()->id)->first();
            }
        }
        $AGP = $this->AGP();
        $meanGrade = $this->meanGrade($AGP);
        $cluster = $this->getCluster();
        return view('dashboard.profileview',compact('profile','AGP','meanGrade','cluster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $validator = Validator::make($request->all(),[
             "avatar"=> 'mimes:png,jpg,jpeg',
            "kiswahili"=>'required',
            "english"=>'required',
            "mathematics"=>'required',
            "biology"=>'required',
            "physics"=>'required',
            "chemistry"=>'required',
            "geography"=>'required',
            "religion"=>'required',
            "history"=>'required',
            "agriculture"=>'required',
            "business"=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        if($request->biology==0 && $request->physics==0 && $request->chemistry==0){
            return redirect()->back()->with('error',"Sorry, You must select atleast two Group Two subjects");
        }

        if(($request->biology==0 && $request->physics==0) || ($request->chemistry==0 && $request->physics==0)){
            return redirect()->back()->with('error',"Sorry, You must select atleast two Group Two subjects");
        }

        if($request->history==0 && $request->geography==0 && $request->religion==0){
            return redirect()->back()->with('error',"Sorry, You must select atleast two Group Three subjects");
        }

        if(($request->history==0 && $request->geography==0) || ($request->religion==0 && $request->geography==0)){
            return redirect()->back()->with('error',"Sorry, You must select atleast two Group Three subjects");
        }
        if($request->agriculture == 0 && $request->business==0){
            return redirect()->back()->with('error',"Sorry, You must select atleast one Group Four subjects");

        }

       
        $profile = profile::where('userid',Auth::user()->id)->first();
        if($profile === null){
            $profile = new profile;
            $profile->userid = Auth::user()->id;
            if($profile->save()){
                $profile = profile::where('userid',Auth::user()->id)->first();
            }
        }
        $fileName= $profile->avatar;
        if($request->hasFile('avatar')) {
            if ($profile->avatar && $profile->avatar != "default.png"){
                unlink(public_path('/images/avatar/').$profile->avatar);
            }
            $userName = Auth::user()->name;
            $image = $request->file('avatar');
            $imageName = $image->getClientOriginalName();
            $fileName = $userName . "_profile".$imageName;
    
            $directory = public_path('/images/avatar/');
            $imageUrl = $directory.$fileName;
            Image::make($image)->resize(200, 200)->save($imageUrl);
        }

        $profile->avatar=$fileName;
        $profile->userid = Auth::user()->id;
        $profile->kiswahili = $request->get('kiswahili','0');
        $profile->english= $request->get('english','0');
        $profile->mathematics = $request->get('mathematics','0');
        $profile->biology = $request->get('biology','0');
        $profile->chemistry = $request->get('chemistry','0');
        $profile->physics = $request->get('physics','0');
        $profile->geography = $request->get('geography','0');
        $profile->histroy = $request->get('history','0');
        $profile->cre = $request->get('religion','0');
        $profile->agriculture = $request->get('agriculture','0');
        $profile->business = $request->get('business','0');
        $profile->status = true;
        $status = $profile->save();
        if($status){
            return redirect()->back()->with('success','Your profile was updated successifully');
        }
    }


    public static function getCluster(){
       $profile = profile::where('userid',Auth::user()->id)->first();
       if($profile === null){
        $profile = new profile;
        $profile->userid = Auth::user()->id;
        if($profile->save()){
            $profile = profile::where('userid',Auth::user()->id)->first();
        }
    }
       $english = $profile->english;
       $kiswahili = $profile->kiswahili;
       $mathematics = $profile->mathematics;
       $biology = $profile->biology ; 
       $chemistry = $profile->chemistry;
       $physics = $profile->physics;
       $geography = $profile->geography;
       $history = $profile->histroy ;
       $religion = $profile->cre ;
       $agriculture = $profile->agriculture ;
       $business = $profile->business;

       if($kiswahili > $english){
           $language = $kiswahili;
       }
       else{
           $language = $english;
       }

       if($biology > $physics && $biology > $chemistry){
           $science = $biology;
       }
       elseif($physics>$biology && $physics > $chemistry){
            $science = $physics;
       }
       elseif($biology == $physics && $biology> $chemistry){
           $science = $biology;
       }
       elseif($physics== $chemistry && $physics > $biology){
           $science = $physics;
       }
       else{
           $science = $chemistry;
       }

       if($geography > $history && $geography > $religion){
           $groupThree = $geography;
       }
       elseif($history > $geography && $history > $religion){
           $groupThree = $history;
       }
       elseif($history==$geography && $history> $religion){
           $groupThree = $history;
       }
       elseif($history==$religion && $history>$geography){
           $groupThree = $history;
       }
       elseif($history==$geography && $history==$religion){
           $groupThree = $history;
       }
       else{
           $groupThree = $religion;
       }
       if($business > $agriculture){
           $groupFour = $business;
       }
       elseif($agriculture > $business){
           $groupFour = $agriculture;
       }
       else{
           $groupFour = $agriculture;
       }
       if($groupFour> $groupThree){
           $humanity = $groupFour;
       }
       else{
           $humanity =$groupThree;
       }

       $R = $language + $mathematics + $science + $humanity;
       $AGP = ProfileController::AGP();
       $CR = $R / 48;
       $CAGP = $AGP / 84;
       $CRCAGP = $CR * $CAGP;
       $sqrtCRCAGP = sqrt($CRCAGP);
       $Cluster = $sqrtCRCAGP * 48;
       return round($Cluster,3);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
