<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

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

    public static function getGrade($value)
    {
        if ($value == 12) {
            $grade = "A";
        }
        if ($value == 11) {
            $grade = "A-";
        }
        if ($value == 10) {
            $grade = "B+";
        }
        if ($value == 9) {
            $grade = "B";
        }
        if ($value == 8) {
            $grade = "B-";
        }
        if ($value == 7) {
            $grade = "C+";
        }
        if ($value == 6) {
            $grade = "C";
        }
        if ($value == 5) {
            $grade = "C-";
        }
        if ($value == 4) {
            $grade = "D+";
        }
        if ($value == 3) {
            $grade = "D";
        }
        if ($value == 2) {
            $grade = "D-";
        }
        if ($value == 1) {
            $grade = "E";
        }
        if ($value == 0) {
            $grade = "";
        }
        return $grade;
    }

    public function meanGrade($AGP)
    {
        switch ($AGP) {
            case $AGP > 80:
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
                $meanGrage = "NO GRADE YET";
        }
        return $meanGrage;
    }

    public static function AGP()
    {
        $profile = profile::where('userid', Auth::user()->id)->first();
        if ($profile === null) {
            $profile = new profile;
            $profile->userid = Auth::user()->id;
            if ($profile->save()) {
                $profile = profile::where('userid', Auth::user()->id)->first();
            }
        }
        //Group II

        if (($profile->biology > $profile->physics) && ($profile->biology > $profile->chemistry)) {
            $science1 = $profile->biology;
        } elseif (($profile->physics > $profile->biology) && ($profile->physics > $profile->chemistry)) {
            $science1 = $profile->physics;
        } elseif (($profile->chemistry > $profile->physics) && ($profile->chemistry > $profile->biology)) {
            $science1 = $profile->chemistry;
        } elseif (($profile->chemistry == $profile->physics) && ($profile->chemistry > $profile->biology)) {
            $science1 = $profile->chemistry;
        } elseif (($profile->chemistry == $profile->biology) && ($profile->chemistry > $profile->physics)) {
            $science1 = $profile->chemistry;
        } elseif (($profile->biology == $profile->physics) && ($profile->chemistry < $profile->biology)) {
            $science1 = $profile->biology;
        } elseif (($profile->chemistry == $profile->physics) && ($profile->chemistry == $profile->biology)) {
            $science1 = $profile->chemistry;
            $science2 = $profile->chemistry;
        } else {
            return redirect()->back()->with("error", "Opps!!, Something went wrong please try again later !!!");
        }

        if ($science1 == "biology") {
            if ($profile->physics > $profile->chemistry) {
                $science2 = $profile->physics;
            } else {
                $science2 = $profile->chemistry;
            }
        } elseif ($science1 == "biology" && $profile->physics == $profile->chemistry) {
            $science2 == $profile->physics;
        } elseif ($science1 == "physics" && $profile->biology == $profile->chemistry) {
            $science2 == $profile->biology;
        } elseif ($science1 == "chemistry" && $profile->physics == $profile->biology) {
            $science2 == $profile->physics;
        } elseif (($science1 == "physics")) {
            if ($profile->biology > $profile->chemistry) {
                $science2 = $profile->biology;
            } else {
                $science2 = $profile->chemistry;
            }
        } else {
            if ($profile->physics > $profile->biology) {
                $science2 = $profile->physics;
            } else {
                $science2 = $profile->biology;
            }
        }

        //Group III

        if ($profile->geography > $profile->histroy && $profile->geography > $profile->cre) {
            $group3 = $profile->geography;
        } elseif ($profile->histroy > $profile->geography && $profile->histroy > $profile->cre) {
            $group3 = $profile->histroy;
        } elseif ($profile->cre > $profile->histroy && $profile->cre > $profile->geography) {
            $group3 = $profile->cre;
        } elseif ($profile->cre == $profile->histroy && $profile->cre == $profile->geography) {
            $group3 = $profile->cre;
        } elseif (($profile->geography == $profile->histroy) && ($profile->geography > $profile->cre)) {
            $science1 = $profile->geography;
        } elseif (($profile->geography == $profile->cre) && ($profile->geography > $profile->histroy)) {
            $science1 = $profile->geography;
        } elseif (($profile->cre == $profile->histroy) && ($profile->geography < $profile->cre)) {
            $science1 = $profile->cre;
        } else {
            return redirect()->back()->with("error", "Opps!!, Something went wrong with group 3 subjects please try again later !!!");
        }


        //Group IV and V

        if ($profile->agriculture > 0) {
            $group4 = $profile->agriculture;
        } else {
            $group4 = $profile->business;
        }

        $AGP = $profile->kiswahili + $profile->english + $profile->mathematics
            + $science1 + $science2 + $group3 + $group4;

        return $AGP;
    }


    public function profile()
    {
        $profile = profile::where('userid', Auth::user()->id)->first();
        if ($profile === null) {
            $profile = new profile;
            $profile->userid = Auth::user()->id;
            if ($profile->save()) {
                $profile = profile::where('userid', Auth::user()->id)->first();
            }
        }
        $AGP = $this->AGP();
        $meanGrade = $this->meanGrade($AGP);
        $clusterDetails = $this->getCluster();
        $clusters = $clusterDetails['clusters'];
        $clusterSubjects = $clusterDetails['clusterSubjects'];
        return view('dashboard.profileview', compact('profile', 'AGP', 'meanGrade', 'clusters', 'clusterSubjects'));
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
        $validator = Validator::make($request->all(), [
            "avatar" => 'mimes:png,jpg,jpeg',
            "kiswahili" => 'required',
            "english" => 'required',
            "mathematics" => 'required',
            "biology" => 'required',
            "physics" => 'required',
            "chemistry" => 'required',
            "geography" => 'required',
            "religion" => 'required',
            "history" => 'required',
            "agriculture" => 'required',
            "business" => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->biology == 0 && $request->physics == 0 && $request->chemistry == 0) {
            return redirect()->back()->with('error', "Sorry, You must select atleast two Group Two subjects");
        }

        if (($request->biology == 0 && $request->physics == 0) || ($request->chemistry == 0 && $request->physics == 0)) {
            return redirect()->back()->with('error', "Sorry, You must select atleast two Group Two subjects");
        }

        if ($request->history == 0 && $request->geography == 0 && $request->religion == 0) {
            return redirect()->back()->with('error', "Sorry, You must select atleast two Group Three subjects");
        }

        if (($request->history == 0 && $request->geography == 0) || ($request->religion == 0 && $request->geography == 0)) {
            return redirect()->back()->with('error', "Sorry, You must select atleast two Group Three subjects");
        }
        if ($request->agriculture == 0 && $request->business == 0) {
            return redirect()->back()->with('error', "Sorry, You must select atleast one Group Four subjects");
        }


        $profile = profile::where('userid', Auth::user()->id)->first();
        if ($profile === null) {
            $profile = new profile;
            $profile->userid = Auth::user()->id;
            if ($profile->save()) {
                $profile = profile::where('userid', Auth::user()->id)->first();
            }
        }
        $fileName = $profile->avatar;
        if ($request->hasFile('avatar')) {
            if ($profile->avatar && $profile->avatar != "default.png") {
                unlink(public_path('/images/avatar/') . $profile->avatar);
            }
            $userName = Auth::user()->name;
            $image = $request->file('avatar');
            $imageName = $image->getClientOriginalName();
            $fileName = $userName . "_profile" . $imageName;

            $directory = public_path('/images/avatar/');
            $imageUrl = $directory . $fileName;
            Image::make($image)->resize(200, 200)->save($imageUrl);
        }

        $profile->avatar = $fileName;
        $profile->userid = Auth::user()->id;
        $profile->kiswahili = $request->get('kiswahili', '0');
        $profile->english = $request->get('english', '0');
        $profile->mathematics = $request->get('mathematics', '0');
        $profile->biology = $request->get('biology', '0');
        $profile->chemistry = $request->get('chemistry', '0');
        $profile->physics = $request->get('physics', '0');
        $profile->geography = $request->get('geography', '0');
        $profile->histroy = $request->get('history', '0');
        $profile->cre = $request->get('religion', '0');
        $profile->agriculture = $request->get('agriculture', '0');
        $profile->business = $request->get('business', '0');
        $profile->status = true;
        $status = $profile->save();
        if ($status) {
            return redirect()->back()->with('success', 'Your profile was updated successifully');
        }
    }


    public static function getCluster()
    {
        $profile = profile::where('userid', Auth::user()->id)->first();
        if ($profile === null) {
            $profile = new profile;
            $profile->userid = Auth::user()->id;
            if ($profile->save()) {
                $profile = profile::where('userid', Auth::user()->id)->first();
            }
        }
        $english = $profile->english;
        $kiswahili = $profile->kiswahili;
        $mathematics = $profile->mathematics;
        $biology = $profile->biology;
        $chemistry = $profile->chemistry;
        $physics = $profile->physics;
        $geography = $profile->geography;
        $history = $profile->histroy;
        $religion = $profile->cre;
        $agriculture = $profile->agriculture;
        $business = $profile->business;

        // $clusterSubjects = [];
        // $clusterSubjects2 = [];

        // if ($kiswahili > $english) {
        //     $language = $kiswahili;
        //     $language2 = $english;
        //     $clusterSubjects['kiswahili'] =  $kiswahili;
        //     $clusterSubjects2['English'] = $english;
        // } else {
        //     $language = $english;
        //     $language2 = $kiswahili;
        //     $clusterSubjects['english'] =  $english;
        //     $clusterSubjects2['Kiswahili'] = $kiswahili;


        // }

        // if ($biology > $physics && $biology > $chemistry) {
        //     $science = $biology;
        //     $science2 = $chemistry;
        //     $clusterSubjects['biology'] =  $biology;
        // } elseif ($physics > $biology && $physics > $chemistry) {
        //     $science = $physics;
        //     $clusterSubjects['physics'] =  $physics;
        //     $science2 = $chemistry;

        // } elseif ($biology == $physics && $biology > $chemistry) {
        //     $science = $biology;
        //     $clusterSubjects['biology'] =  $biology;
        //     $science2 = $physics;

        // } elseif ($physics == $chemistry && $physics > $biology) {
        //     $science = $physics;
        //     $clusterSubjects['physics'] =  $physics;

        //     $science2 = $biology;

        // } else {
        //     $science = $chemistry;
        //     $clusterSubjects['chemistry'] =  $chemistry;

        //     $science2 = $physics;
        // }

        // if ($geography > $history && $geography > $religion) {
        //     $groupThree = $geography;
        //     $clusterSubjects['geography'] =  $geography;

        // } elseif ($history > $geography && $history > $religion) {
        //     $groupThree = $history;
        //     $clusterSubjects['history'] =  $history;

        // } elseif ($history == $geography && $history > $religion) {
        //     $groupThree = $history;
        //     $clusterSubjects['history'] =  $history;

        // } elseif ($history == $religion && $history > $geography) {
        //     $groupThree = $history;
        //     $clusterSubjects['history'] =  $history;

        // } elseif ($history == $geography && $history == $religion) {
        //     $groupThree = $history;
        //     $clusterSubjects['history'] =  $history;

        // } else {
        //     $groupThree = $religion;
        //     $clusterSubjects['religion'] =  $religion;

        // }
        // if ($business > $agriculture) {
        //     $groupFour = $business;
        //     $clusterSubjects['business'] =  $business;

        // } elseif ($agriculture > $business) {
        //     $groupFour = $agriculture;
        //     $clusterSubjects['agriculture'] =  $agriculture;

        // } else {
        //     $groupFour = $agriculture;
        //     $clusterSubjects['agriculture'] =  $agriculture;
        // }
        // if ($groupFour > $groupThree) {
        //     $humanity = $groupFour;
        // } else {
        //     $humanity = $groupThree;
        // }


        // ENG MATH PHY AGR
        $cluster1 = ProfileController::calculateCluster(($english + $mathematics + $physics + $agriculture));
        $subjetcs1 = [];
        $subjetcs1['English'] = $english;
        $subjetcs1['Mathematics'] = $mathematics;
        $subjetcs1['Physics'] = $physics;
        $subjetcs1['Agriculture'] = $agriculture;
        // ENG MATH PHY BUS
        $cluster2 = ProfileController::calculateCluster(($english + $mathematics + $physics + $business));
        $subjetcs2 = [];
        $subjetcs2['English'] = $english;
        $subjetcs2['Mathematics'] = $mathematics;
        $subjetcs2['Physics'] = $physics;
        $subjetcs2['Business'] = $business;
        // ENG MATH CHEM AGR
        $cluster3 = ProfileController::calculateCluster(($english + $mathematics + $chemistry + $agriculture));
        $subjetcs3 = [];
        $subjetcs3['English'] = $english;
        $subjetcs3['Mathematics'] = $mathematics;
        $subjetcs3['Chemistry'] = $chemistry;
        $subjetcs3['Agriculture'] = $agriculture;
        // ENG MATH CHEM BUS
        $cluster4 = ProfileController::calculateCluster(($english + $mathematics + $chemistry + $business));
        $subjetcs4 = [];
        $subjetcs4['English'] = $english;
        $subjetcs4['Mathematics'] = $mathematics;
        $subjetcs4['Chemistry'] = $chemistry;
        $subjetcs4['Business'] = $business;
        // ENG MATH BIO AGR
        $cluster5 = ProfileController::calculateCluster(($english + $mathematics + $biology + $agriculture));
        $subjetcs5 = [];
        $subjetcs5['English'] = $english;
        $subjetcs5['Mathematics'] = $mathematics;
        $subjetcs5['Biology'] = $biology;
        $subjetcs5['Agriculture'] = $agriculture;
        // ENG MATH BIO BUS
        $cluster6 = ProfileController::calculateCluster(($english + $mathematics + $biology + $business));
        $subjetcs6 = [];
        $subjetcs6['English'] = $english;
        $subjetcs6['Mathematics'] = $mathematics;
        $subjetcs6['Biology'] = $biology;
        $subjetcs6['Business'] = $business;

        // KIS MATH PHY AGR
        $cluster7 = ProfileController::calculateCluster(($kiswahili + $mathematics + $physics + $agriculture));
        $subjetcs7 = [];
        $subjetcs7['Kiswahili'] = $kiswahili;
        $subjetcs7['Mathematics'] = $mathematics;
        $subjetcs7['Physics'] = $physics;
        $subjetcs7['Agriculture'] = $agriculture;
        // KIS MATH PHY BUS
        $cluster8 = ProfileController::calculateCluster(($kiswahili + $mathematics + $physics + $business));
        $subjetcs8 = [];
        $subjetcs8['Kiswahili'] = $kiswahili;
        $subjetcs8['Mathematics'] = $mathematics;
        $subjetcs8['Physics'] = $physics;
        $subjetcs8['Business'] = $business;
        // KIS MATH CHEM AGR
        $cluster9 = ProfileController::calculateCluster(($kiswahili + $mathematics + $chemistry + $agriculture));
        $subjetcs9 = [];
        $subjetcs9['Kiswahili'] = $kiswahili;
        $subjetcs9['Mathematics'] = $mathematics;
        $subjetcs9['Chemistry'] = $chemistry;
        $subjetcs9['Agriculture'] = $agriculture;
        // KIS MATH CHEM BUS
        $cluster10 = ProfileController::calculateCluster(($kiswahili + $mathematics + $chemistry + $business));
        $subjetcs10 = [];
        $subjetcs10['Kiswahili'] = $kiswahili;
        $subjetcs10['Mathematics'] = $mathematics;
        $subjetcs10['Chemistry'] = $chemistry;
        $subjetcs10['Business'] = $business;
        // KIS MATH BIO AGR
        $cluster11 = ProfileController::calculateCluster(($kiswahili + $mathematics + $biology + $agriculture));
        $subjetcs11 = [];
        $subjetcs11['Kiswahili'] = $kiswahili;
        $subjetcs11['Mathematics'] = $mathematics;
        $subjetcs11['Biology'] = $biology;
        $subjetcs11['Agriculture'] = $agriculture;
        // KIS MATH BIO BUS
        $cluster12 = ProfileController::calculateCluster(($kiswahili + $mathematics + $biology + $business));
        $subjetcs12 = [];
        $subjetcs12['Kiswahili'] = $kiswahili;
        $subjetcs12['Mathematics'] = $mathematics;
        $subjetcs12['Biology'] = $biology;
        $subjetcs12['Business'] = $business;

        // ENG MATH PHY CRE
        $cluster13 = ProfileController::calculateCluster(($english + $mathematics + $physics + $religion));
        $subjetcs13 = [];
        $subjetcs13['English'] = $english;
        $subjetcs13['Mathematics'] = $mathematics;
        $subjetcs13['Physics'] = $physics;
        $subjetcs13['Religion'] = $religion;
        // ENG MATH PHY GEO
        $cluster14 = ProfileController::calculateCluster(($english + $mathematics + $physics + $geography));
        $subjetcs14 = [];
        $subjetcs14['English'] = $english;
        $subjetcs14['Mathematics'] = $mathematics;
        $subjetcs14['Physics'] = $physics;
        $subjetcs14['Geography'] = $geography;
        // ENG MATH CHEM HIST
        $cluster15 = ProfileController::calculateCluster(($english + $mathematics + $chemistry + $history));
        $subjetcs15 = [];
        $subjetcs15['English'] = $english;
        $subjetcs15['Mathematics'] = $mathematics;
        $subjetcs15['Chemistry'] = $chemistry;
        $subjetcs15['History'] = $history;
        // ENG MATH CHEM CRE
        $cluster16 = ProfileController::calculateCluster(($english + $mathematics + $chemistry + $religion));
        $subjetcs16 = [];
        $subjetcs16['English'] = $english;
        $subjetcs16['Mathematics'] = $mathematics;
        $subjetcs16['Chemistry'] = $chemistry;
        $subjetcs16['Religion'] = $religion;
        // ENG MATH BIO GEO
        $cluster17 = ProfileController::calculateCluster(($english + $mathematics + $biology + $geography));
        $subjetcs17 = [];
        $subjetcs17['English'] = $english;
        $subjetcs17['Mathematics'] = $mathematics;
        $subjetcs17['Biology'] = $biology;
        $subjetcs17['Geography'] = $geography;
        // ENG MATH BIO HIST
        $cluster18 = ProfileController::calculateCluster(($english + $mathematics + $biology + $history));
        $subjetcs18 = [];
        $subjetcs18['English'] = $english;
        $subjetcs18['Mathematics'] = $mathematics;
        $subjetcs18['Biology'] = $biology;
        $subjetcs18['History'] = $history;

        // KIS MATH PHY CRE
        $cluster19 = ProfileController::calculateCluster(($kiswahili + $mathematics + $physics + $religion));
        $subjetcs19 = [];
        $subjetcs19['Kiswahili'] = $kiswahili;
        $subjetcs19['Mathematics'] = $mathematics;
        $subjetcs19['Biology'] = $biology;
        $subjetcs19['Business'] = $business;
        // KIS MATH PHY HIST
        $cluster20 = ProfileController::calculateCluster(($kiswahili + $mathematics + $physics + $history));
        $subjetcs20 = [];
        $subjetcs20['Kiswahili'] = $kiswahili;
        $subjetcs20['Mathematics'] = $mathematics;
        $subjetcs20['Physics'] = $physics;
        $subjetcs20['History'] = $history;
        // KIS MATH CHEM GEO
        $cluster21 = ProfileController::calculateCluster(($kiswahili + $mathematics + $physics + $history));
        $subjetcs21 = [];
        $subjetcs21['Kiswahili'] = $kiswahili;
        $subjetcs21['Mathematics'] = $mathematics;
        $subjetcs21['Chemistry'] = $chemistry;
        $subjetcs21['Geography'] = $geography;
        // KIS MATH CHEM HIST
        $cluster22 = ProfileController::calculateCluster(($kiswahili + $mathematics + $chemistry + $geography));
        $subjetcs22 = [];
        $subjetcs22['Kiswahili'] = $kiswahili;
        $subjetcs22['Mathematics'] = $mathematics;
        $subjetcs22['Chemistry'] = $chemistry;
        $subjetcs22['History'] = $history;
        // KIS MATH BIO CRE
        $cluster23 = ProfileController::calculateCluster(($kiswahili + $mathematics + $biology + $religion));
        $subjetcs23 = [];
        $subjetcs23['Kiswahili'] = $kiswahili;
        $subjetcs23['Mathematics'] = $mathematics;
        $subjetcs23['Biology'] = $biology;
        $subjetcs23['Religion'] = $religion;
        // KIS MATH BIO GEO
        $cluster24 = ProfileController::calculateCluster(($kiswahili + $mathematics + $biology + $geography));
        $subjetcs24 = [];
        $subjetcs24['Kiswahili'] = $kiswahili;
        $subjetcs24['Mathematics'] = $mathematics;
        $subjetcs24['Biology'] = $biology;
        $subjetcs24['Geography'] = $geography;

        // $R = $language + $mathematics + $science + $humanity;
        // $R2 = $language + $mathematics + $science2 + $humanity;
        // $subjects2 = [$clusterSubjects[0], $clusterSubjects[1], $clusterSubjects[3] ];

        // $R3 = $language2 + $mathematics + $science2 + $humanity;
        // $subjects3 = [ $language2, $clusterSubjects[1], $clusterSubjects[3]];

        // $R4 = $language2 + $mathematics + $science + $humanity;
        // $subjects4 = [$language2, $clusterSubjects[1], $clusterSubjects[2], $clusterSubjects[3]];


        // $cluster1 =  ProfileController::calculateCluster($R);
        // $cluster2 =  ProfileController::calculateCluster($R2);
        // $cluster3 =  ProfileController::calculateCluster($R3);
        // $cluster4 =  ProfileController::calculateCluster($R4);

        $clusters = [
            $cluster1, $cluster2, $cluster3, $cluster4,
            $cluster5, $cluster6, $cluster7, $cluster8,
            $cluster9, $cluster10, $cluster11, $cluster12,
            $cluster13, $cluster14, $cluster15, $cluster16,
            $cluster17, $cluster18, $cluster19, $cluster20,
            $cluster21, $cluster22, $cluster23, $cluster24
        ];

        $clusterSubjects =  [
            $subjetcs1, $subjetcs2, $subjetcs3, $subjetcs4,
            $subjetcs5, $subjetcs6, $subjetcs7, $subjetcs8,
            $subjetcs9, $subjetcs10, $subjetcs11, $subjetcs12,
            $subjetcs13, $subjetcs14, $subjetcs15, $subjetcs16,
            $subjetcs17, $subjetcs18, $subjetcs19, $subjetcs20,
            $subjetcs21, $subjetcs22, $subjetcs23, $subjetcs24
        ];


        $clustersNoZero = [];
        $clusterIndexWithZeros = [];

        foreach ($clusterSubjects as $key1 => $subject) {
            $hasZero = false;
            foreach ($subject as $key2 => $sb) {
                if ($sb === 0) {
                    $hasZero = true;
                    array_push($clusterIndexWithZeros, $key1);
                }
            }

            if (!$hasZero) {
                array_push($clustersNoZero, $subject);
            }
        }

        foreach ($clusterIndexWithZeros as $index) {
            unset($clusters[$index]);
        }

        $clusters = array_values($clusters);

        return [
            'clusters' => $clusters,
            'clusterSubjects' => $clustersNoZero
        ];
    }

    public static function calculateCluster($R)
    {
        $AGP = ProfileController::AGP();
        $CR = $R / 48;
        $CAGP = $AGP / 84;
        $CRCAGP = $CR * $CAGP;
        $sqrtCRCAGP = sqrt($CRCAGP);
        return round(($sqrtCRCAGP * 48), 3);
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
