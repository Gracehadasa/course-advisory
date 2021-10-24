@extends('admin.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">{{ __('Add Program') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('addcourse') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Program Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cluster" class="col-md-4 col-form-label text-md-right">{{ __('Previous cluster') }}</label>

                            <div class="col-md-6">
                                <input id="cluster" type="text" class="form-control @error('cluster') is-invalid @enderror" name="cluster" required autocomplete="current-cluster">

                                @error('cluster')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cluster" class="col-md-4 col-form-label text-md-right">{{ __('Program Type') }}</label>

                            <div class="col-md-6">
                                <select name="program" id="program" class="form-control program">
                                <option disabled selected>select program type</option>
                                <option value="degree">Degree program</option>
                                <option value="diploma">Diploma program</option> 
                                <option value="certificate">Certificate program</option>
                                <option value="artisan">Artisan Programs</option>
                                </select>

                                @error('subjects')
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
                                <option disabled selected>select subject combinations</option>
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

                        <div class="dropdown-divider"></div>
                        <div class="form-group row justfy-content-center">
                            <label for="cluster" class="text-primary col-md-12 col-form-label text-md-center">{{ __('Select the Universities where the course is offered') }}</label>
                         
                            <div class="col-md-12 row checkboxes">
                               
                            </div>
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