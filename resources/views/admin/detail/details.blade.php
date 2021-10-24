@extends('admin.dashboard')

@section('content')
<div class="mx-5">
   <div class="card border-primary">
     <img class="card-img-top" src="holder.js/100px180/" alt="">
     <div class="card-body">
       <h4 class="card-title text-primary"><i class="fa fa-graduation-cap mx-3" aria-hidden="true"> <strong>Registered Courses</strong></i></h4>
       <div class="dropdown-divider col-md-12 my-4"></div>
       <table class="table table-light table-striped table-bordered table-hover" id="mytable">
        <thead>
          <th>#</th>
          <th>Course</th>
          <th>Salary</th>
          <th>Description</th>
          <th>Field Work</th>
          <th>Edit</th>
          <th>Delete</th>
        </thead>
        <tbody>
        <?php
          $no = 1;
        ?>
        @foreach($details as $course)
          <tr>
          <td>{{$no}}</td>
          <td>{{$course->course->name}}</td>
          <td>{{$course->salary}}</td>
          <td>{{$course->description}}</td>
          <td>{{$course->field_work}}</td>
          <td>
            <a href="{{route('detail.show', $course->id)}}" class="btn btn-sm btn-info">edit</a>
          </td>
          <td>
            <a href="{{route('detail.delete', $course->id )}}" class="btn btn-sm btn-danger">delete</a> 
          </td>
          </tr>
          <?php
          $no ++;
        ?>
        @endforeach
        </tbody>
        <tfoot>
        <th>#</th>
        <th>Course</th>
        <th>Salary</th>
        <th>Description</th>
        <th>Field Work</th>
        <th>Edit</th>
          <th>Delete</th>
        </tfoot>
    </table>
     </div>
   </div>
</div>
@endsection
