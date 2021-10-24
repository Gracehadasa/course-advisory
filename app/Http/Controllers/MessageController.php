<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
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
        $messages = Message::all();
        return view('admin.messages.all')->with("messages",$messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'message' => 'required',
        ]);

        $message = new Message;
        $message->userid = Auth::user()->id;
        $message->firstname =$request->firstname;
        $message->lastname = $request->lastname;
        $message->email = Auth::user()->email;
        $message->phone=Auth::user()->phone;
        $message->message = $request->message;

        $status = $message->save();
        if($status){
            return redirect()->back()->with("success","Message sent successifully. Please wait for our feedback");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $messages = Message::where([['messagetype','=',false],['readstatus','=',false]])->get();
        return view('admin.messages.messages')->with("messages",$messages);
    }

    public function showoutbox(Message $message)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $messages = Message::where([['messagetype','=',true],['readstatus','=',true]])->get();
        return view('admin.messages.outbox')->with("messages",$messages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        $replyMessage = Message::find($id);
        return view('admin.messages.replyMessage')->with('message',$replyMessage);
    }

    public function userReply($id)
    {
        $replyMessage = Message::find($id);
        return view('dashboard.messages.replyMessage')->with('message',$replyMessage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
         }
        //validation
        $this->validate($request,[
            'message'=>'required'
        ]);

        $messageToReply = Message::where('id',$id)->get()->first();
        $messageToReply->readstatus = true;
        $updatestatus = $messageToReply->save();

        if($updatestatus){
        $message = new Message;
        $message->userid = $messageToReply->userid;
        $message->firstname =$messageToReply->firstname;
        $message->lastname = $messageToReply->lastname;
        $message->email = $messageToReply->email;
        $message->phone=$messageToReply->phone;
        $message->message = $request->message;
        $message->messagetype = true;
        $message->readstatus = true;

        $status = $message->save();
        if($status){
            return redirect()->back()->with("success","Message sent successifully. Please wait for our feedback");
        }
        }
    }


    

    public function postUserReply(Request $request, $id)
    {
        //validation
        $this->validate($request,[
            'message'=>'required'
        ]);

        $messageToReply = Message::where('id',$id)->get()->first();
        $messageToReply->readstatus = false;
        $updatestatus = $messageToReply->save();

        if($updatestatus){
        $message = new Message;
        $message->userid = $messageToReply->userid;
        $message->firstname =$messageToReply->firstname;
        $message->lastname = $messageToReply->lastname;
        $message->email = $messageToReply->email;
        $message->phone=$messageToReply->phone;
        $message->message = $request->message;
        $message->messagetype = false;
        $message->readstatus = false;

        $status = $message->save();
        if($status){
            return redirect()->route('userSentMessages')->with("success","Message sent successifully. Please wait for our feedback");
        }
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message, $id)
    {
        $deleteMessage = Message::find($id);
        $status = $deleteMessage->delete();
        if($status){
            return redirect()->back()->with("success","Message deleted successifull !!!");
        }
    }
    //User
    public function userSentMessages(Message $message)
    {
        $messages = Message::where([['messagetype','=',false],['userid','=',Auth::user()->id]])->get();
        return view('dashboard.messages.outbox')->with("messages",$messages);
    }
    public function userInbox(Message $message)
    {
        $messages = Message::where([['messagetype','=',true],['userid','=',Auth::user()->id]])->get();
        return view('dashboard.messages.inbox')->with("messages",$messages);
    }
}
