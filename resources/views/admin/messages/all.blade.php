@extends('admin.dashboard')

@section('content')
<div class="container">
<div class="card border-primary">
     <img class="card-img-top" src="holder.js/100px180/" alt="">
     <div class="card-body">
       <h4 class="card-title text-primary"> <i class="fas fa-envelope-open-text  mx-3  "></i> <strong>All Messages</strong></i></h4>
       <div class="dropdown-divider col-md-12 my-4"></div>
    <table class="table table-light table-striped table-bordered table-hover" id="mytable">
       <thead>
         <th>#</th>
        <th>FirstName</th>
        <th>PhoneNumber</th>
         <th>Email</th>
        <th>Message</th>
        <th>Message Type</th>
        <th>Status</th>
        <th>Delete</th>
       </thead>
       <tbody>
       <?php
         $no = 1;
       ?>
       @foreach($messages as $message)
        <tr>
        <td>{{$no}}</td>
        <td>{{$message->firstname}}</td>
        <td>{{$message->phone}}</td>
        <td>{{$message->email}}</td>
        <td>{{$message->message}}</td>
        <td>
           @if($message->messagetype)
           <a href="" class="text-info"> <i class="fa fa-share-square" aria-hidden="true"></i> outbox</a>
           @else
           <a href="" class="text-success">  <i class="fa fa-inbox text-success" aria-hidden="true"></i> inbox</a>
           @endif
        </td>
        <td>
            @if($message->readstatus && !$message->messagetype)
            <a href=""><i class="fa fa-envelope-open text-success" aria-hidden="true"></i></a>
            @endif
            @if(!$message->readstatus && !$message->messagetype)
            <a href="{{route('replyform',$message->id)}}"><i class="fa fa-envelope text-info " aria-hidden="true"></i> </a>
            @endif
            @if($message->readstatus && $message->messagetype)
                 <i class="fa fa-check text-success" aria-hidden="true"></i>
                 <i class="fa fa-check text-success" aria-hidden="true"></i>
            @endif
        </td>
        <td><a href="{{route('deletemessage',$message->id)}}" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        <?php
         $no ++;
       ?>
       @endforeach
       </tbody>
       <tfoot>
       <th>#</th>
        <th>FirstName</th>
        <th>PhoneNumber</th>
         <th>Email</th>
        <th>Message</th>
        <th>Message Type</th>
        <th>Status</th>
        <th>Delete</th>
       </tfoot>
    </table>
    </div>
    </div>
</div>
@endsection
