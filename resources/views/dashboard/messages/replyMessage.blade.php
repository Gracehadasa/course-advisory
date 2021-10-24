@extends('dashboard.index')

@section('content')
<div class="container mt-5">
<div class="site-section">
    <form action="{{route('userreply',$message->id)}}" method="post">
    @csrf
    <div class="container">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="fname">First Name</label>
                    <input type="text" id="firstname" value="{{$message->firstname}}" disabled name="firstname" class="form-control form-control-lg" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" value="{{$message->lastname}}" disabled  class="form-control form-control-lg" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="eaddress">Email Address</label>
                    <input type="text" id="eaddress" class="form-control form-control-lg" value="{{$message->email}}" disabled >
                </div>
                <div class="col-md-6 form-group">
                    <label for="tel">Tel. Number</label>
                    <input type="text" id="tel" class="form-control form-control-lg" value="{{$message->phone}}" disabled >
                </div>
            </div>
            <div class=" alert alert-info">
            {{ $message->message}}
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Send Message" class="btn btn-primary btn-lg px-5">
                </div>
            </div>
        </div>
    </form>
        
    </div>
</div>

@endsection