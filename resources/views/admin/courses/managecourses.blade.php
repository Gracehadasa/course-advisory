@extends('admin.dashboard')

@section('content')
<div class="container">
<div class="card border-primary">
     <img class="card-img-top" src="holder.js/100px180/" alt="">
     <div class="card-body">
       <h4 class="card-title text-primary"> <i class="fas fa-edit  mx-3  "></i> <strong>Programmes Management</strong></i></h4>
       <div class="dropdown-divider col-md-12 my-4"></div>
    <table class="table table-light table-striped table-bordered table-hover" id="mytable">
       <thead>
         <th>#</th>
        <th>Course</th>
        <th>cluster</th>
        <th>Subjects</th>
        <th>universities</th>
        <th>Update</th>
        <th>Delete</th>
       </thead>
       <tbody>
       <?php
         $no = 1;
       ?>
       @foreach($courses as $course)
        <tr>
        <td>{{$no}}</td>
        <td>{{$course->name}}</td>
        <td>{{$course->cluster}}</td>
        <td>{{$course->subjects}}</td>
        <td>
           @foreach($course->universities as $uni)

            <ul>{{$uni}}</ul>

           @endforeach
        
        </td>
        <td><a href="{{route('managecoursesform',$course->id)}}" class="text-info"><i class="fas fa-edit    "></i></a></td>
        <td><a href="{{route('deletecourse',$course->id)}}" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
        <?php
         $no ++;
       ?>
       @endforeach
       </tbody>
       <tfoot>
       <th>#</th>
       <th>Course</th>
        <th>cluster</th>
        <th>Subjects</th>
        <th>universities</th>
        <th>Update</th>
        <th>Delete</th>
       </tfoot>
    </table>
</div>
</div>
</div>
@endsection
