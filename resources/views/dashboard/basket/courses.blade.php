@extends('dashboard.index')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="alert col-md-11 text-info">
     <i class="fa fa-check-circle" aria-hidden="true"></i> <strong>You qualify for the following programs</strong>
    </div>
   <div class="col-md-6">
     <h5 class="text-info"><p class="badge badge-primary mx-1">1</p>Degree Programmes</h5>
   <table class="table table-info table-striped table-bordered table-hover" id="mytable">
       <thead>
         <th>#</th>
        <th>Course</th>
        <th>cluster</th>
        <th>Subjects</th>
        <th>Busket</th>
        <th>Details</th>
       </thead>
       <tbody>
       <?php
         $no = 1;
       ?>
       @foreach($courses as $course)
        <tr>
        <td>{{$no}}</td>
        <td><small>{{$course->name}}</small></td>
        <td><small>{{$course->cluster}}</small></td>
        <td><small>{{$course->subjects}}</small></td>
        <td><a href="{{route('getSelectedCourse',$course->id)}}" class="btn btn-primary btn-sm"><small>Add to Busket</small></a></td>
        <td><a href="{{route('coursedetails',$course->id)}}" class="btn btn-success btn-sm"><small>view</small></a></td>
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
        <th>Busket</th>
        <th>Details</th>
       </tfoot>
    </table>
   </div>

   <div class="col-md-6">
   <h5 class="text-primary"><p class="badge badge-info mx-1">2</p>Diploma Programmes</h5>
   <table class="table table-primary table-striped table-bordered table-hover" id="mytable2">
       <thead>
         <th>#</th>
        <th>Course</th>
        <th>cluster</th>
        <th>Subjects</th>
        <th>Busket</th>
        <th>Details</th>
       </thead>
       <tbody>
       <?php
         $no = 1;
       ?>
       @foreach($courses1 as $course)
        <tr>
        <td>{{$no}}</td>
        <td><small>{{$course->name}}</small></td>
        <td><small>{{$course->cluster}}</small></td>
        <td><small>{{$course->subjects}}</small></td>
        <td><a href="{{route('getSelectedCourse',$course->id)}}" class="btn btn-info btn-sm"><small>Add to Busket</small></a></td>
        <td><a href="{{route('coursedetails',$course->id)}}" class="btn btn-success btn-sm"><small>view</small></a></td>
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
        <th>Busket</th>
        <th>Details</th>
       </tfoot>
    </table>
   </div>
  </div>
  <div class="row mt-2">
    <div class="dropdown-divider col-md-12 mb-2"></div>
   <div class="col-md-6">
     <h5 class="text-primary"><p class="badge badge-info mx-1">3</p>Certificate Programmes</h5>
   <table class="table table-primary table-striped table-bordered table-hover" id="mytable">
       <thead>
         <th>#</th>
        <th>Course</th>
        <th>cluster</th>
        <th>Subjects</th>
        <th>Busket</th>
        <th>Details</th>
       </thead>
       <tbody>
       <?php
         $no = 1;
       ?>
       @foreach($courses2 as $course)
        <tr>
        <td>{{$no}}</td>
        <td><small>{{$course->name}}</small></td>
        <td><small>{{$course->cluster}}</small></td>
        <td><small>{{$course->subjects}}</small></td>
        <td><a href="{{route('getSelectedCourse',$course->id)}}" class="btn btn-info btn-sm"><small>Add to Busket</small></a></td>
        <td><a href="{{route('coursedetails',$course->id)}}" class="btn btn-success btn-sm"><small>view</small></a></td>
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
        <th>Busket</th>
        <th>Details</th>
       </tfoot>
    </table>
   </div>

   <div class="col-md-6">
   <h5 class="text-primary"><p class="badge badge-info mx-1">4</p>Artisan Programmes</h5>
   <table class="table table-info table-striped table-bordered table-hover" id="mytable2">
       <thead>
         <th>#</th>
        <th>Course</th>
        <th>cluster</th>
        <th>Subjects</th>
        <th>Busket</th>
        <th>Details</th>
       </thead>
       <tbody>
       <?php
         $no = 1;
       ?>
       @foreach($courses3 as $course)
        <tr>
        <td>{{$no}}</td>
        <td><small>{{$course->name}}</small></td>
        <td><small>{{$course->cluster}}</small></td>
        <td><small>{{$course->subjects}}</small></td>
        <td><a href="{{route('getSelectedCourse',$course->id)}}" class="btn btn-primary btn-sm"><small>Add to Busket</small></a></td>
        <td><a href="{{route('coursedetails',$course->id)}}" class="btn btn-success btn-sm"><small>view</small></a></td>
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
        <th>Busket</th>
        <th>Details</th>
       </tfoot>
    </table>
   </div>
  </div>
</div>
@endsection
