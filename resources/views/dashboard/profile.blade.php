@extends('dashboard.index')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <form action="{{route('updateprofile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h4>Upload your profile picture (<i>optional</i>)</h4>
                        <div class="form-group row">
                            <label for="avatar" class="col-md-2 col-form-label text-md-right">{{ __('Profile Picture') }}</label>
                            <div class="col-md-10">
                                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" autofocus>

                                @error('avatar')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 dropdown-divider"></div>
                        <h4 class="text-success">Compulsory subjects</h4>
                        <div class="form-group row">
                            <label for="english" class="col-md-2 col-form-label text-md-right text-success">{{ __('English') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="english" type="radio" class="mx-2" name ="english" value="12">
                                    <b>A-</b><input id="english" type="radio" class="mx-2" name ="english" value="11">
                                    <b>B+</b><input id="english" type="radio" class="mx-2" name ="english" value="10">
                                    <b>B</b><input id="english" type="radio" class="mx-2" name ="english" value="9">
                                    <b>B-</b><input id="english" type="radio" class="mx-2" name ="english" value="8">
                                    <b>C+</b><input id="english" type="radio" class="mx-2" name ="english" value="7">
                                    <b>C</b><input id="english" type="radio" class="mx-2" name ="english" value="6">
                                    <b>C-</b><input id="english" type="radio" class="mx-2" name ="english" value="5">
                                    <b>D+</b><input id="english" type="radio" class="mx-2" name ="english" value="4">
                                    <b>D</b><input id="english" type="radio" class="mx-2" name ="english" value="3">
                                    <b>D-</b><input id="english" type="radio" class="mx-2" name ="english" value="2">
                                    <b>E</b><input id="english" type="radio" class="mx-2" name ="english" value="1">
            
                                </div>
                                @error('english')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                <!--         @if (count($errors) > 0)
         <div class = "alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif -->
                        <div class="form-group row">
                            <label for="kiswahili" class="col-md-2 col-form-label text-md-right text-success">{{ __('Kiswahili') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="12">
                                    <b>A-</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="11">
                                    <b>B+</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="10">
                                    <b>B</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="9">
                                    <b>B-</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="8">
                                    <b>C+</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="7">
                                    <b>C</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="6">
                                    <b>C-</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="5">
                                    <b>D+</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="4">
                                    <b>D</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="3">
                                    <b>D-</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="2">
                                    <b>E</b><input id="kiswahili" type="radio" class="mx-2" name ="kiswahili" value="1">
            
                                </div>
                                @if($errors->has('kiswahili'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('kiswahili')}}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row ">
                            <label for="mathematics" class="col-md-2 col-form-label text-md-right text-success">{{ __('Mathematics') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="12">
                                    <b>A-</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="11">
                                    <b>B+</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="10">
                                    <b>B</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="9">
                                    <b>B-</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="8">
                                    <b>C+</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="7">
                                    <b>C</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="6">
                                    <b>C-</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="5">
                                    <b>D+</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="4">
                                    <b>D</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="3">
                                    <b>D-</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="2">
                                    <b>E</b><input id="mathematics" type="radio" class="mx-2" name ="mathematics" value="1">
            
                                </div>
                                @error('mathematics')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-12 dropdown-divider"></div>
                        <h4 class="text-primary">Group Two Subjects </h4>

                        <div class="form-group row">
                            <label for="biology" class="col-md-2 col-form-label text-md-right text-primary">{{ __('Biology') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="biology" type="radio" class="mx-2" name ="biology" value="12">
                                    <b>A-</b><input id="biology" type="radio" class="mx-2" name ="biology" value="11">
                                    <b>B+</b><input id="biology" type="radio" class="mx-2" name ="biology" value="10">
                                    <b>B</b><input id="biology" type="radio" class="mx-2" name ="biology" value="9">
                                    <b>B-</b><input id="biology" type="radio" class="mx-2" name ="biology" value="8">
                                    <b>C+</b><input id="biology" type="radio" class="mx-2" name ="biology" value="7">
                                    <b>C</b><input id="biology" type="radio" class="mx-2" name ="biology" value="6">
                                    <b>C-</b><input id="biology" type="radio" class="mx-2" name ="biology" value="5">
                                    <b>D+</b><input id="biology" type="radio" class="mx-2" name ="biology" value="4">
                                    <b>D</b><input id="biology" type="radio" class="mx-2" name ="biology" value="3">
                                    <b>D-</b><input id="biology" type="radio" class="mx-2" name ="biology" value="2">
                                    <b>E</b><input id="biology" type="radio" class="mx-2" name ="biology" value="1">
                                    <b>N/A</b><input id="biology" type="radio" class="mx-2" name ="biology" value="0">
            
                                </div>
                                @error('biology')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="physics" class="col-md-2 col-form-label text-md-right text-primary">{{ __('Physics') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="physics" type="radio" class="mx-2" name ="physics" value="12">
                                    <b>A-</b><input id="physics" type="radio" class="mx-2" name ="physics" value="11">
                                    <b>B+</b><input id="physics" type="radio" class="mx-2" name ="physics" value="10">
                                    <b>B</b><input id="physics" type="radio" class="mx-2" name ="physics" value="9">
                                    <b>B-</b><input id="physics" type="radio" class="mx-2" name ="physics" value="8">
                                    <b>C+</b><input id="physics" type="radio" class="mx-2" name ="physics" value="7">
                                    <b>C</b><input id="physics" type="radio" class="mx-2" name ="physics" value="6">
                                    <b>C-</b><input id="physics" type="radio" class="mx-2" name ="physics" value="5">
                                    <b>D+</b><input id="physics" type="radio" class="mx-2" name ="physics" value="4">
                                    <b>D</b><input id="physics" type="radio" class="mx-2" name ="physics" value="3">
                                    <b>D-</b><input id="physics" type="radio" class="mx-2" name ="physics" value="2">
                                    <b>E</b><input id="physics" type="radio" class="mx-2" name ="physics" value="1">
                                    <b>N/A</b><input id="physics" type="radio" class="mx-2" name ="physics" value="0">
            
                                </div>
                                @error('physics')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chemistry" class="col-md-2 col-form-label text-md-right text-primary">{{ __('Chemistry') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="12">
                                    <b>A-</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="11">
                                    <b>B+</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="10">
                                    <b>B</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="9">
                                    <b>B-</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="8">
                                    <b>C+</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="7">
                                    <b>C</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="6">
                                    <b>C-</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="5">
                                    <b>D+</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="4">
                                    <b>D</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="3">
                                    <b>D-</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="2">
                                    <b>E</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="1">
                                    <b>N/A</b><input id="chemistry" type="radio" class="mx-2" name ="chemistry" value="0">
            
                                </div>
                                @error('chemistry')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 dropdown-divider"></div>
                        <h4 class="text-info">Group Three Subjects </h4>

                        <div class="form-group row">
                            <label for="geography" class="col-md-2 col-form-label text-md-right text-info">{{ __('Geography') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="geography" type="radio" class="mx-2" name ="geography" value="12">
                                    <b>A-</b><input id="geography" type="radio" class="mx-2" name ="geography" value="11">
                                    <b>B+</b><input id="geography" type="radio" class="mx-2" name ="geography" value="10">
                                    <b>B</b><input id="geography" type="radio" class="mx-2" name ="geography" value="9">
                                    <b>B-</b><input id="geography" type="radio" class="mx-2" name ="geography" value="8">
                                    <b>C+</b><input id="geography" type="radio" class="mx-2" name ="geography" value="7">
                                    <b>C</b><input id="geography" type="radio" class="mx-2" name ="geography" value="6">
                                    <b>C-</b><input id="geography" type="radio" class="mx-2" name ="geography" value="5">
                                    <b>D+</b><input id="geography" type="radio" class="mx-2" name ="geography" value="4">
                                    <b>D</b><input id="geography" type="radio" class="mx-2" name ="geography" value="3">
                                    <b>D-</b><input id="geography" type="radio" class="mx-2" name ="geography" value="2">
                                    <b>E</b><input id="geography" type="radio" class="mx-2" name ="geography" value="1">
                                    <b>N/A</b><input id="geography" type="radio" class="mx-2" name ="geography" value="0">
            
                                </div>
                                @error('geography')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="history" class="col-md-2 col-form-label text-md-right text-info">{{ __('History') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="history" type="radio" class="mx-2" name ="history" value="12">
                                    <b>A-</b><input id="history" type="radio" class="mx-2" name ="history" value="11">
                                    <b>B+</b><input id="history" type="radio" class="mx-2" name ="history" value="10">
                                    <b>B</b><input id="history" type="radio" class="mx-2" name ="history" value="9">
                                    <b>B-</b><input id="history" type="radio" class="mx-2" name ="history" value="8">
                                    <b>C+</b><input id="history" type="radio" class="mx-2" name ="history" value="7">
                                    <b>C</b><input id="history" type="radio" class="mx-2" name ="history" value="6">
                                    <b>C-</b><input id="history" type="radio" class="mx-2" name ="history" value="5">
                                    <b>D+</b><input id="history" type="radio" class="mx-2" name ="history" value="4">
                                    <b>D</b><input id="history" type="radio" class="mx-2" name ="history" value="3">
                                    <b>D-</b><input id="history" type="radio" class="mx-2" name ="history" value="2">
                                    <b>E</b><input id="history" type="radio" class="mx-2" name ="history" value="1">
                                    <b>N/A</b><input id="history" type="radio" class="mx-2" name ="history" value="0">
            
                                </div>
                                @error('history')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="religion" class="col-md-2 col-form-label text-md-right text-info">{{ __('CRE/IRE/HRE') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="religion" type="radio" class="mx-2" name ="religion" value="12">
                                    <b>A-</b><input id="religion" type="radio" class="mx-2" name ="religion" value="11">
                                    <b>B+</b><input id="religion" type="radio" class="mx-2" name ="religion" value="10">
                                    <b>B</b><input id="religion" type="radio" class="mx-2" name ="religion" value="9">
                                    <b>B-</b><input id="religion" type="radio" class="mx-2" name ="religion" value="8">
                                    <b>C+</b><input id="religion" type="radio" class="mx-2" name ="religion" value="7">
                                    <b>C</b><input id="religion" type="radio" class="mx-2" name ="religion" value="6">
                                    <b>C-</b><input id="religion" type="radio" class="mx-2" name ="religion" value="5">
                                    <b>D+</b><input id="religion" type="radio" class="mx-2" name ="religion" value="4">
                                    <b>D</b><input id="religion" type="radio" class="mx-2" name ="religion" value="3">
                                    <b>D-</b><input id="religion" type="radio" class="mx-2" name ="religion" value="2">
                                    <b>E</b><input id="religion" type="radio" class="mx-2" name ="religion" value="1">
                                    <b>N/A</b><input id="religion" type="radio" class="mx-2" name ="religion" value="0">
            
                                </div>
                                @error('religion')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 dropdown-divider"></div>
                        <h4 class="text-success">Group Four and Five Subjects </h4>


                        <div class="form-group row">
                            <label for="agriculture" class="col-md-2 col-form-label text-md-right text-success">{{ __('Agriculture') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="12">
                                    <b>A-</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="11">
                                    <b>B+</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="10">
                                    <b>B</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="9">
                                    <b>B-</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="8">
                                    <b>C+</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="7">
                                    <b>C</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="6">
                                    <b>C-</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="5">
                                    <b>D+</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="4">
                                    <b>D</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="3">
                                    <b>D-</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="2">
                                    <b>E</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="1">
                                    <b>N/A</b><input id="agriculture" type="radio" class="mx-2" name ="agriculture" value="0">
            
                                </div>
                                @error('agriculture')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="business" class="col-md-2 col-form-label text-md-right text-success">{{ __('Business') }}</label>
                            <div class="col-md-10">
                                <div class="mt-2">
                                    <b>A</b><input id="business" type="radio" class="mx-2" name ="business" value="12">
                                    <b>A-</b><input id="business" type="radio" class="mx-2" name ="business" value="11">
                                    <b>B+</b><input id="business" type="radio" class="mx-2" name ="business" value="10">
                                    <b>B</b><input id="business" type="radio" class="mx-2" name ="business" value="9">
                                    <b>B-</b><input id="business" type="radio" class="mx-2" name ="business" value="8">
                                    <b>C+</b><input id="business" type="radio" class="mx-2" name ="business" value="7">
                                    <b>C</b><input id="business" type="radio" class="mx-2" name ="business" value="6">
                                    <b>C-</b><input id="business" type="radio" class="mx-2" name ="business" value="5">
                                    <b>D+</b><input id="business" type="radio" class="mx-2" name ="business" value="4">
                                    <b>D</b><input id="business" type="radio" class="mx-2" name ="business" value="3">
                                    <b>D-</b><input id="business" type="radio" class="mx-2" name ="business" value="2">
                                    <b>E</b><input id="business" type="radio" class="mx-2" name ="business" value="1">
                                    <b>N/A</b><input id="business" type="radio" class="mx-2" name ="business" value="0">
            
                                </div>
                                @error('business')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
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