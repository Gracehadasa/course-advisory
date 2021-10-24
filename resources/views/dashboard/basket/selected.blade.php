@extends('dashboard.index')
@section('content')

<div class="container">

   <div class="card" style="background-color:cadelight; border-color:darkblue;">
     <img class="card-img-top" src="holder.js/100x180/" alt="">
     <div class="card-body">
       <h4 class="card-title">{{$program->name}}</h4>
       <p class="card-text">These are the institutions that offer {{$program->name}} program. Select your favourite and submit.</p>
       <div class="dropdown-divider col-md-12" ></div>
       <form action="{{route('addcoursetobasket',$program->id)}}" method="post">
           @csrf
        <div class="row">
            <div class="col-md-10 row">
                @foreach($program->universities as $uni)
                <div class="col-md-7">
                   <b class="text-info"> {{$uni}} </b>
                </div>
                <div class="col-md-2">
                         <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $program->userAverageRating }}" data-size="xs">
                         <input type="hidden" name="id" required="" value="{{ $program->id }}">
                </div>
                <div class="col md 1"><input type="radio" name="institution" value="{{$uni}}" id=""></div>
                <div class="dropdown-divider col-md-12" ></div>
                @endforeach
                               @error('institution')
                                    <div class="col-md-6 float-right">
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    </div>
                                @enderror
                <div class="col-md-12">
                <button class="btn btn-primary float-right" type="submit">Save Program</button>
                </div>
                
            </div>
            <div class="col-md-2 text-center">
            <div class="site-logo">
                <a href="/" class="d-block">
                <img src="{{asset('images/logo.jpg')}}" alt="Image" class="img-fluid">
                </a>
            </div>    
            <strong class="text-info">Thanks for Choosing Academia.</strong><br>
            <b class="text-primary">Great <br><i class="fa fa-heart text-danger" style="font-size:25px;" aria-hidden="true"></i></b>
            </div>
        </div>
       
       </form>
     </div>
   </div>


</div>

@endsection