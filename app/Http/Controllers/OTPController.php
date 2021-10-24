<?php

namespace App\Http\Controllers;

use App\OTP;
use App\User;
use App\SMS;
use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class OTPController extends Controller
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
    public function checkPhone(Request $request)
    {
        //validation
        $this->validate($request,[
            //"phone" => 'required',
        ]);
         $phone = $request->phone;
        $phoneStatus = User::where('phone',$phone )->first();
        if($phoneStatus === null){
            return redirect()->back()->with('error',"You phone number does not exist in our records");
            
        }
        else{
              
            $otp = rand(1000,9999);
            $newOtp = new OTP;
            $newOtp->userid = $phoneStatus->id;
            $newOtp->phone = $phone;
            $newOtp->otp = $otp;
            if($newOtp->save()){

          $no = $phone;
          $new = substr($no,1);
          $phone = '+254'.$new;
          $username = 'cagimu'; 
          $apiKey   = '8e5fa927d51f1143bb49c5f7acc046f398ae11c4611333df1a3d45fb8c1f63c5'; 
          $AT       = new AfricasTalking($username, $apiKey);
          $message = "Your otp code is: " .$otp;

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
                 $mySms->userid = $phoneStatus->id;
                 $mySms->Message = $message;
                 $mySms->phone = $rcpt['number'];
                 $mySms->amount = $cost;

                 if($mySms->save()){
                    return view('auth.passwords.reset',compact('phone'));
                 }
            }


            return view('auth.passwords.reset',compact('phone'));
        }
     }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(),[
            'otp' => 'required',
            'password'=>'required | min:8'
        ]);
        if($validator->fails()){
            return redirect()->route('reset')->withErrors($validator);
        }
        
        $otp = $request->otp;
        $otpStatus = OTP::where('otp',$otp)->first();
        if($otpStatus===null){
            return redirect()->back()->with('error','The otp Code your entered does not match our records.');
        }
        elseif($otpStatus->status == 1){
            return redirect()->back()->with('error','The otp Code your entered has been used.Please request a new code.');
        }
        else{
           $otpStatus->status = true;
           if($otpStatus->save()){
               $userId = $otpStatus->userid;
               $user = User::where('id',$userId)->first();
               $user->password = Hash::make($request->password);
               if($user->save()){
                   return view('auth.login')->with('success','Your password was changed successifully');
               }
           }

   
        }

        
        
    }

    public function reset(){
        return view('auth.passwords.reset');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OTP  $oTP
     * @return \Illuminate\Http\Response
     */
    public function show(OTP $oTP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OTP  $oTP
     * @return \Illuminate\Http\Response
     */
    public function edit(OTP $oTP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OTP  $oTP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OTP $oTP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OTP  $oTP
     * @return \Illuminate\Http\Response
     */
    public function destroy(OTP $oTP)
    {
        //
    }
}
