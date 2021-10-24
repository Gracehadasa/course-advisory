@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="card border-primary">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <h4 class="card-title text-info"> <i class="fa fa-tablet" aria-hidden="true"></i> Registered Programmes</h4>
        <div class="dropdown-divider col-md-12 my-3"></div>
        <table class="table table-light table-striped table-bordered table-hover" id="mytable">
       <thead>
         <th>#</th>
        <th>Course</th>
        <th>cluster</th>
        <th>Subjects</th>
        <th>universities</th>
        <th>Rating</th>
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
        <td><input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $course->averageRating }}" data-size="xs" disabled=""></td>
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
        <th>Rating</th>
       </tfoot>
    </table>
      </div>
    </div>
</div>
@endsection
