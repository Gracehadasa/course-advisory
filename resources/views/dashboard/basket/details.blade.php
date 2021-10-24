@extends('dashboard.index')
@section('content')

<div class="container" >
    @if ($details->detail)
    <h1 class="my-3">{{$details->name}}</h1>

    <h2 class="my-3">Average saraly: {{$details->detail->salary}}</h2>

    <h3 class="my-3">Course Description</h3>
    <p class="paragraph">{{$details->detail->description}}</p>

    <h3 class="my-3">Field Work</h3>
    <p class="paragraph">{{$details->detail->field_work}}</p>

    <h3 class="my-3">Companies you can work with </h3>
    <p class="paragraph">{{$details->detail->companies}}</p>
    @else
        <h1 class="my-5">The Course has no details</h1>
    @endif

</div>
@endsection