<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function contact(){
        return view('generals.contact');
    }

    public function about(){
        return view('generals.about');
    }
    public function courses(){
        return view('generals.courses');
    }
}
