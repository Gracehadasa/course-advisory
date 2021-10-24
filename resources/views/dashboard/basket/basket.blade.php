@extends('dashboard.index')
@section('content')

<div class="container">
    <div class="card" style="background-color:cadetlight; border-color:darkblue;">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <h4 class="card-title row">My best Programmes</h4> <a href="{{route('basket2')}}" class="btn btn-info btn-sm mx-3"
                ><small>Print</small><i class="ml-1 fa fa-print" aria-hidden="true"></i></a>
            <div class="">
            <div class="col-md-12 dropdown-divider"></div>
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <div class="text-cente">
                            <div class="site-logo">
                                <a href="/" class="d-block">
                                    <img src="{{asset('images/logo.jpg')}}" alt="Image" class="img-fluid">
                                </a>
                                <Strong>Academia ltd</Strong> <br>
                            </div>
                            <small>po. Box 23,kisumu</small><br>
                            <small>www.academia.co.ke</small><br>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                                <small><strong>Printed by: </strong>{{ Auth::user()->name}}</small><br>
                                 <small><strong>Phone: </strong> {{ Auth::user()->phone}}</small><br>
                                 <small><strong>Email: </strong> {{ Auth::user()->email}}</small><br>
                            </div>
                    <div class="col-md-12 dropdown-divider"></div>
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <strong>Institution Name</strong>
                        </div>
                        <div class="col-md-2">
                            <strong>Institution Type</strong>
                        </div>
                        <div class="col-md-3">
                            <strong>Programme</strong>
                        </div>
                        <div class="col-md-2">
                            <strong>Programme type</strong>
                        </div>
                        <div class="col-md-1">
                            <strong>Action</strong>
                        </div>
                    </div>
                    <div class="col-md-12 dropdown-divider"></div>
                    @foreach($myprograms as $program)
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i><strong
                                class="ml-2 text-info">{{$program->institution}}</strong>
                        </div>
                        <div class="col-md-2">
                            <strong>{{$program->institutiontype}}</strong>
                        </div>
                        <div class="col-md-3 text-primary">
                            <strong>{{$program->program}}</strong>
                        </div>
                        <div class="col-md-2">
                            <strong>{{$program->programtype}}</strong>
                        </div>
                        <div class="col-md-1">
                            <a href="{{route('deletebasket',$program->id)}}" class="btn btn-sm btn-danger"><i
                                    class="fa fa-trash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-12 dropdown-divider"></div>
                    @endforeach
                    <div class="col-md-12">
                    @if(App\Program::where('userid',Auth::user()->id)->count()==5)
                    <a href="{{route('createSms')}}" class="btn btn-success btn-sm float-right">Save Busket</a>
                   @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection