<?php

namespace App\Http\Controllers;

use App\Events\AdminSentMessage;
use App\Events\MessageSentEvent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id =Auth::id();
        return Message::with('user')->where('user_id', $id)->orWhere('receiver_id', $id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liveChat()
    {
        return view('dashboard.messages.livechat');
    }

    public function adminLiveChat()
    {
        return view('admin.messages.livechat');
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
        $this->validate($request, [
            'message' => 'required',
            'user_id' => 'required'
        ]);

        $id =  $request->user_id;
         
        if($id === 'admin') {
            $id = User::where('role', 1)->first()->id;
        }

        // dd($id);

        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->message,
            'receiver_id' => $id
        ]);

        $message->load('user');


        if ($user->role === 1) {
          broadcast(new AdminSentMessage($message, $id))->toOthers();
        } else {
            broadcast(new MessageSentEvent($message))->toOthers();
        }
        



        return response()->json([
            'status' => true,
            'message' => $message,
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        if (Auth::user()->role != 1) {
            return redirect()->route('home');
        }
        $messages = Message::where([['messagetype', '=', false], ['readstatus', '=', false]])->get();
        return view('admin.messages.messages')->with("messages", $messages);
    }

    public function showoutbox(Message $message)
    {
        if (Auth::user()->role != 1) {
            return redirect()->route('home');
        }
        $messages = Message::where([['messagetype', '=', true], ['readstatus', '=', true]])->get();
        return view('admin.messages.outbox')->with("messages", $messages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (Auth::user()->role != 1) {
            return redirect()->route('home');
        }
        $replyMessage = Message::find($id);
        return view('admin.messages.replyMessage')->with('message', $replyMessage);
    }

    public function userReply($id)
    {
        $replyMessage = Message::find($id);
        return view('dashboard.messages.replyMessage')->with('message', $replyMessage);
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
        if (Auth::user()->role != 1) {
            return redirect()->route('home');
        }
        //validation
        $this->validate($request, [
            'message' => 'required'
        ]);

        $messageToReply = Message::where('id', $id)->get()->first();
        $messageToReply->readstatus = true;
        $updatestatus = $messageToReply->save();

        if ($updatestatus) {
            $message = new Message;
            $message->user_id = $messageToReply->user_id;
            $message->firstname = $messageToReply->firstname;
            $message->lastname = $messageToReply->lastname;
            $message->email = $messageToReply->email;
            $message->phone = $messageToReply->phone;
            $message->message = $request->message;
            $message->messagetype = true;
            $message->readstatus = true;

            $status = $message->save();
            if ($status) {
                return redirect()->back()->with("success", "Message sent successifully. Please wait for our feedback");
            }
        }
    }




    public function postUserReply(Request $request, $id)
    {
        //validation
        $this->validate($request, [
            'message' => 'required'
        ]);

        $messageToReply = Message::where('id', $id)->get()->first();
        $messageToReply->readstatus = false;
        $updatestatus = $messageToReply->save();

        if ($updatestatus) {
            $message = new Message;
            $message->user_id = $messageToReply->user_id;
            $message->firstname = $messageToReply->firstname;
            $message->lastname = $messageToReply->lastname;
            $message->email = $messageToReply->email;
            $message->phone = $messageToReply->phone;
            $message->message = $request->message;
            $message->messagetype = false;
            $message->readstatus = false;

            $status = $message->save();
            if ($status) {
                return redirect()->route('userSentMessages')->with("success", "Message sent successifully. Please wait for our feedback");
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
        if ($status) {
            return redirect()->back()->with("success", "Message deleted successifull !!!");
        }
    }
    //User
    public function userSentMessages(Message $message)
    {
        $messages = Message::where([['messagetype', '=', false], ['user_id', '=', Auth::user()->id]])->get();
        return view('dashboard.messages.outbox')->with("messages", $messages);
    }
    public function userInbox(Message $message)
    {
        $messages = Message::where([['messagetype', '=', true], ['user_id', '=', Auth::user()->id]])->get();
        return view('dashboard.messages.inbox')->with("messages", $messages);
    }
}
