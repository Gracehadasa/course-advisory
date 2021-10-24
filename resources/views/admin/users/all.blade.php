@extends('admin.dashboard')

@section('content')
<div class="container">
<div class="card border-primary">
     <img class="card-img-top" src="holder.js/100px180/" alt="">
     <div class="card-body">
       <h4 class="card-title text-primary"> <i class="fa fa-users mx-3" aria-hidden="true"></i> <strong>System Users</strong></i></h4>
       <div class="dropdown-divider col-md-12 my-4"></div>
    <table class="table table-light table-striped table-bordered table-hover" id="mytable">
       <thead>
         <th>#</th>
        <th>Name</th>
        <th>PhoneNumber</th>
         <th>Email</th>
       </thead>
       <tbody>
       <?php
         $no = 1;
       ?>
       @foreach($users as $user)
        <tr>
        <td>{{$no}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->phone}}</td>
        <td>{{$user->email}}</td>
        </tr>
        <?php
         $no ++;
       ?>
       @endforeach
       </tbody>
       <tfoot>
       <th>#</th>
        <th>Name</th>
        <th>PhoneNumber</th>
         <th>Email</th>
       </tfoot>
    </table>
    </div>
    </div>
</div>
@endsection
