@extends('dashboard.index')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>Kiswahili</th>
                            <th>English</th>
                            <th>Mathematics</th>
                            <th>Biology</th>
                            <th>Physics</th>
                            <th>Chemistry</th>
                            <th>Geography</th>
                            <th>History</th>
                            <th>CRE/HRE/IRE</th>
                            <th>{{$profile->agriculture > 0 ? "Agriculture" : "Business"}}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$profile->kiswahili}}</td>
                                <td>{{$profile->english}}</td>
                                <td>{{$profile->mathematics}}</td>
                                <td>{{$profile->biology}}</td>
                                <td>{{$profile->physics}}</td>
                                <td>{{$profile->chemistry}}</td>
                                <td>{{$profile->geography}}</td>
                                <td>{{$profile->histroy}}</td>
                                <td>{{$profile->cre}}</td>
                                <td>{{$profile->agriculture > 0 ? $profile->agriculture : $profile->business}}</td>


                            </tr>
                            <tr>
                                <td>{{App\Http\Controllers\ProfileController::getGrade($profile->kiswahili)}}</td>
                                <td>{{App\Http\Controllers\ProfileController::getGrade($profile->english)}}</td>
                                <td>{{App\Http\Controllers\ProfileController::getGrade($profile->mathematics)}}</td>
                                <td>{{App\Http\Controllers\ProfileController::getGrade($profile->biology)}}</td>
                                <td>{{App\Http\Controllers\ProfileController::getGrade($profile->physics)}}</td>
                                <td>{{App\Http\Controllers\ProfileController::getGrade($profile->chemistry)}}</td>
                                <td>{{App\Http\Controllers\ProfileController::getGrade($profile->geography)}}</td>
                                <td>{{App\Http\Controllers\ProfileController::getGrade($profile->histroy)}}</td>
                                <td>{{App\Http\Controllers\ProfileController::getGrade($profile->cre)}}</td>
                                <td>{{$profile->agriculture > 0 ? App\Http\Controllers\ProfileController::getGrade($profile->agriculture): App\Http\Controllers\ProfileController::getGrade($profile->business)}}</td>

                            </tr>
                        </tbody>
                    </table>

                    <div class="card-header mt-5 text-bold text-info">Your results</div>
                    <table class="table table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Mean Grade</th>
                            <th>AGP</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{Auth::user()->name}}</td>
                                <td>{{$meanGrade}}</td>
                                <td>{{$AGP}} points</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="table table-bordered">
                    <thead>

                        <th>cluster</th>
                        <td>Subjects</td>
                    </thead>
                    <tbody>
                        @foreach($clusters as $i => $cluster)
                        <tr>

                            <td style="font-size: 40px; font-weight:100;">
                                <div class="mb-0" style="height: 100%; display: flex; align-items:center; justify-content:center;">
                                    {{$cluster}}
                                </div>
                            </td>
                            <td>
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            @foreach($clusterSubjects[$i] as $key => $subject)
                                            <th>{{ $key }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tr>
                                        @foreach($clusterSubjects[$i] as $key => $subject)
                                        <td>{{$subject}}</td>
                                        @endforeach
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection