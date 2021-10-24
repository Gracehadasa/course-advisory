@extends('admin.dashboard')

@section('content')
<div class="container">
<div class="card border-primary">
     <img class="card-img-top" src="holder.js/100px180/" alt="">
     <div class="card-body">
       <h4 class="card-title text-primary"> <i class="fas fa-pen-alt   mx-3  "></i> <strong>Institutions Management</strong></i></h4>
       <div class="dropdown-divider col-md-12 my-4"></div>
    <table class="table table-light table-striped table-bordered" id="mytable">
       <thead>
         <th>#</th>
        <th>University</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Update</th>
        <th>Delete</th>
       </thead>
       <tbody>
       <?php
         $no = 1;
       ?>
       @foreach($universities as $university)
        <tr>
        <td>{{$no}}</td>
        <td>{{$university->name}}</td>
        <td>{{$university->phone}}</td>
        <td>{{$university->email}}</td>
        <td><a href="{{route('updateform',$university->id)}}"><i class="fas fa-edit "></i></a></td>
        <td><a href="{{route('delete',$university->id)}}"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a></td>
        </tr>
        <?php
         $no ++;
       ?>
       @endforeach
       </tbody>
       <tfoot>
       <th>#</th>
       <th>University</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Update</th>
        <th>Delete</th>
       </tfoot>
    </table>
    </div>
    </div>
</div>
@endsection
