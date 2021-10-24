@extends('admin.dashboard')
@section('content')
<div class="container">
    <div class="row  justify-content-center">
        <div class="col-md-10">
            <div class="card mt-3 px-5">
                <div class="card-header">{{ __('Add Course Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('detail.update', $details->id) }}">
                        @csrf

                        <div class="form-group  ">
                            <label for="name" class="col-md-4 col-form-label  ">{{ __('Salary') }}</label>

                            <div class=" ">
                                <input id="salary" type="text" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ $details->salary }}" required autocomplete="salary" autofocus>

                                @error('salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group  ">
                            <label for="description" class="col-md-4 col-form-label  ">{{ __('Description') }}</label>

                            <div class=" ">
                                <textarea id="description" class="form-control form-control-lg @error('description') is-invalid @enderror" name="description" required>{{$details->description}}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group  ">
                            <label for="field_work" class="col-md-4 col-form-label  ">{{ __('Field Work') }}</label>

                            <div class=" ">
                                <textarea id="field_work" type="text" class="form-control form-control-lg @error('field_work') is-invalid @enderror" name="field_work" required autocomplete="current-cluster">{{$details->field_work}}</textarea>

                                @error('field_work')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group  ">
                            <label for="companies" class="col-md-4 col-form-label  ">{{ __('Companies') }}</label>

                            <div class=" ">
                                <textarea id="companies" class="form-control form-control-lg @error('companies') is-invalid @enderror" name="companies" required autocomplete="current-cluster">{{$details->companies}}</textarea>

                                @error('companies')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group   mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add course details') }}
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