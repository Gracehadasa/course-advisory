<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\User;
use App\Course;
use App\University;
use App\Program;
use App\SMS;
use App\Charts\SampleChart;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome(){
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
            $username = 'cagimu'; 
            $apiKey   = '4364fea1f320e7d417614fc23bd4f8bc312268e29b1cf000c45c0cc0772036eb'; 
           
//Checking Account Balance
           try{
            $AT       = new AfricasTalking($username, $apiKey);
            $data = $AT->application()->fetchApplicationData();
            $newData = $data['data'];
            $UserData = get_object_vars($newData);
            $newUserData = $UserData['UserData'];
            $balanced = get_object_vars($newUserData);
            $newBalance = $balanced['balance'];
            $BAL = substr($newBalance,4);
           } catch(\Throwable $th){
             $BAL = 0;
           }

         $smses = SMS::all();
         $cost = 0;
         foreach($smses as $sms){
           $cost = $cost + $sms->amount;
         }
        return view('admin.home',compact('cost','BAL'));
    }

    public function allusers(){
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $users = User::all();
        return view("admin.users.all")->with("users",$users);
    }
    
    public function users(){
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $users = User::all();
        return view("admin.users.users")->with("users",$users);
    }

    public function destroy($id){
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $userToDelete = User::find($id);
        $status = $userToDelete->delete();
        if($status){
            return redirect()->back()->with("success","User was deleted sussessifully !!!");
        }
    }

    public function reports(){
         /* Chart one */
        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();
        $users = User::whereMonth('created_at', date('m'))->count();
        $users_1 = User::whereMonth('created_at', date('m', strtotime('-1 month', time())))->count();
        $users_2 = User::whereMonth('created_at', date('m', strtotime('-2 month', time())))->count();
        $users_3 = User::whereMonth('created_at', date('m', strtotime('-3 month', time())))->count();
        $users_4 = User::whereMonth('created_at', date('m', strtotime('-4 month', time())))->count();
        $chart = new SampleChart();
        $chart->title("Registered users for the previous 5 months",  $font_size = 14, $color = '#278478', $bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
        $chart->labels([date("F Y", strtotime("-4 months")), date("F Y", strtotime("-3 months")), date("F Y", strtotime("-2 months")), date("F Y", strtotime("-1 months")),date('F Y')]);
        $chart->dataset('Data', 'bar', [$users_4,$users_3,$users_2,$users_1,$users, ])->backgroundColor(collect(['red', 'green', 'blue', 'yellow', 'orange', 'cyan', 'magenta']));
        
        /* Chart 2 */
        $Programs = Program::whereMonth('created_at', date('m'))->count();
        $Programs_1 = Program::whereMonth('created_at', date('m', strtotime('-1 month', time())))->count();
        $Programs_2 = Program::whereMonth('created_at', date('m', strtotime('-2 month', time())))->count();
        $Programs_3 = Program::whereMonth('created_at', date('m', strtotime('-3 month', time())))->count();
        $Programs_4 = Program::whereMonth('created_at', date('m', strtotime('-4 month', time())))->count();
        $chartapp = new SampleChart;
        $chartapp->title("Submit applications for the previous 5 months",  $font_size = 14, $color = '#278478', $bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
        $chartapp->labels([date("F Y", strtotime("-4 months")), date("F Y", strtotime("-3 months")), date("F Y", strtotime("-2 months")), date("F Y", strtotime("-1 months")),date('F Y')]);
        $chartapp->dataset('Data', 'bar', [$Programs_4,$Programs_3,$Programs_2,$Programs_1,$Programs, ])->backgroundColor(collect(['red', 'green', 'blue', 'yellow', 'orange', 'cyan', 'magenta']));
        
        /* Chart 3 */
         $universities =  University::count();
         $courses = Course::count();
         $chart3 = new SampleChart;
        $chart3->title("Institutions vs Courses",  $font_size = 14, $color = '#278478', $bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
        $chart3->labels(['Institutions', 'Courses']);
        $chart3->dataset('','pie', [$universities,$courses ])->backgroundColor(collect(['green',  'orange']));
        
        /* Chart 4 */
        $data = DB::table('programs')->select('program', DB::raw('COUNT(program) AS occurrences'))
            ->groupBy('program')
            ->orderBy('occurrences', 'DESC')
            ->limit(5)
            ->get();
            $occ = array();
            $prog = array();
            foreach($data as $dt){
                $occ[] = $dt->occurrences;
                $prog[] = $dt->program;
            }

        $chart4 = new SampleChart;
        $chart4->title("Top 5 selected courses",  $font_size = 14, $color = '#278478', $bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
        $chart4->labels($prog);
        $chart4->dataset('','doughnut', $occ)->backgroundColor(collect(['red', 'green', 'blue', 'yellow', 'orange', 'cyan', 'magenta']));
        
         /* Chart 5 */
         $SMSs = SMS::whereMonth('created_at', date('m'))->sum('amount');
         $SMSs_1 = SMS::whereMonth('created_at', date('m', strtotime('-1 month', time())))->sum('amount');
         $SMSs_2 = SMS::whereMonth('created_at', date('m', strtotime('-2 month', time())))->sum('amount');
         $SMSs_3 = SMS::whereMonth('created_at', date('m', strtotime('-3 month', time())))->sum('amount');
         $SMSs_4 = SMS::whereMonth('created_at', date('m', strtotime('-4 month', time())))->sum('amount');
         $chart5 = new SampleChart;
         $chart5->title("SMS usage for last 5 months",  $font_size = 14, $color = '#278478', $bold = true, $font_family = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
         $chart5->labels([date("F Y", strtotime("-4 months")), date("F Y", strtotime("-3 months")), date("F Y", strtotime("-2 months")), date("F Y", strtotime("-1 months")),date('F Y')]);
         $chart5->dataset('SMS', 'line', [$SMSs_4,$SMSs_3,$SMSs_2,$SMSs_1,$SMSs, ])->backgroundColor(collect([ '#145397',]));
         
         /* Others */

         $users = User::count();
         $applications = Program::count();
         $universities = University::count();
         $courses = Course::count();
         
        return view('admin.report.reports',
        compact('chart','chartapp','chart3','chart4','chart5','users','applications','universities','courses'));
    }
   

}