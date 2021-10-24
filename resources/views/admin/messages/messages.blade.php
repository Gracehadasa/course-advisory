@extends('admin.dashboard')

@section('content')
<div class="container">
<div class="card border-primary">
     <img class="card-img-top" src="holder.js/100px180/" alt="">
     <div class="card-body">
       <h4 class="card-title text-primary">  <i class="fa fa-envelope-open  mx-3" aria-hidden="true"></i> <strong>Inbox Messages</strong></i></h4>
       <div class="dropdown-divider col-md-12 my-4"></div>
    <table class="table table-light table-striped table-bordered table-hover" id="mytable">
       <thead>
         <th>#</th>
        <th>FirstName</th>
        <th>PhoneNumber</th>
         <th>Email</th>
        <th>Message</th>
        <th>Reply</th>
        <th>delete</th>
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
        <td><a href="{{route('replyform',$message->id)}}" class="btn btn-primary btn-small"><i class="fa fa-reply" aria-hidden="true"></i></a></td>
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
        <th>Reply</th>
        <th>delete</th>
       </tfoot>
    </table>
    </div>
    </div>
</div>
@endsection
