@extends('admin.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">{{ __('Add Course') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('updatecourse',$course->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Course Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$course->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cluster" class="col-md-4 col-form-label text-md-right">{{ __('cluster') }}</label>

                            <div class="col-md-6">
                                <input id="cluster" type="text" class="form-control @error('cluster') is-invalid @enderror" name="cluster" value="{{$course->cluster}}" required autocomplete="current-cluster">

                                @error('cluster')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cluster" class="col-md-4 col-form-label text-md-right">{{ __('Subjects') }}</label>

                            <div class="col-md-6">
                                <select name="subjects" id="subjects" class="form-control">
                                <option value="{{$course->subjects}}" selected>{{$course->subjects}}</option>
                                <option value="EMPC">ENG,MATH,PHY,CHEM</option>
                                <option value="EMPB">ENG,MATH,PHY,BIO</option>
                                <option value="KMPC">KIS,MATH,PHY,CHEM</option>
                                <option value="KMPB">KIS,MATH,PHY,BIO</option>
                                </select>

                                @error('subjects')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justfy-content-center">
                            <label for="cluster" class="col-md-12 col-form-label text-md-center">{{ __('Select the Universities where the course is offered') }}</label>
                            @foreach($universities as $university)
                                <div class="col-md-6">
                                  <!--  -->
                                          <input type="checkbox" name="universities[]" value="{{$university->name}}" id="{{$university->name}}" {{ in_array($university->name,$course->universities) ? 'checked' : ''}}>
                                    {{$university->name}}
                                    
                                   
                                </div>
                            @endforeach
                            @error('universities')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register the Course') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection