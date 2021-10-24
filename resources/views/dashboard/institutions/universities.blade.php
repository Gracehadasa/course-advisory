@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="card" style="background-color:cadetprimary; border-color:darkblue;">
      <img class="card-img-top" src="holder.js/100x180/" alt="">
      <div class="card-body">
        <h4 class="card-title text-info"><i class="fa fa-table" aria-hidden="true"></i> The Registered Universities</h4>
        <table class="table table-light table-striped table-bordered table-hover" id="mytable">
       <thead>
         <th>#</th>
        <th>University</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Rating</th>
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
        <td><input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $university->averageRating }}" data-size="xs" disabled=""></td>
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
        <th>Rating</th>
       </tfoot>
    </table>
      </div>
    </div>
</div>
@endsection
