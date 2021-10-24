<?php

namespace App\Http\Controllers;

use App\SMS;
use App\Program;
use Auth;
use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSms()
    {
        $message ="Dear ".Auth::user()->name." ,You have selected \n";
        $programs = Program::where('userid',Auth::user()->id)->get();
          foreach($programs as $program){
              $message = $message.$program->programtype."programme in ".$program->program ." in ".$program->institution." ,\n";
          }
          $message =$message.' Academia ltd.';

          $no = Auth::user()->phone;
          $new = substr($no,1);
          $phone = '+254'.$new;
          $username = 'cagimu'; 
          $apiKey   = '8e5fa927d51f1143bb49c5f7acc046f398ae11c4611333df1a3d45fb8c1f63c5'; 
            $AT       = new AfricasTalking($username, $apiKey);

            // Get one of the services
            $sms      = $AT->sms();

            // Use the service
            $result   = $sms->send([
                'to'      => $phone,
                'message' => $message
            ]);
           // $data = json_encode($result);
             $data =$result['data'];
             $smsdata =get_object_vars($data);
             $SMSMessageData = $smsdata['SMSMessageData'];
              $msgData = get_object_vars($SMSMessageData);
             $Recipients = $msgData['Recipients'];
             $rcpt = get_object_vars($Recipients[0]);
             $dirtyCost = $rcpt['cost'];
             $cost =substr($dirtyCost,4);
        
             if($result['status']=="success"){
                 $mySms = new SMS;
                 $mySms->userid = Auth::user()->id;
                 $mySms->Message = $message;
                 $mySms->phone = $rcpt['number'];
                 $mySms->amount = $cost;

                 if($mySms->save()){
                    return redirect()->back()->with("success","Course basket Saved Successifully.A confirmmation message has been sent to your phone");
                 }
             }
            return redirect()->back()->with("success","Course basket Saved Successifully.");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function show(SMS $sMS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function edit(SMS $sMS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SMS $sMS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sMS)
    {
        //
    }
}
