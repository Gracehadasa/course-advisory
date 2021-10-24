@extends('dashboard.index')

@section('content')
<section class="content">
      <div class="container-fluid mt-3">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{App\Course::where('program','degree')->count()}}</h3>

                <p>Degree programmes</p>
              </div>
              <div class="icon">
                <i class="fab fa-accusoft    "></i>
              </div>
              <a href="{{route('programmes','degree')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{App\Course::where('program','diploma')->count()}}</h3>

                <p>Diploma Programmes</p>
              </div>
              <div class="icon">
              <i class="fas fa-dragon    "></i>
              </div>
              <a href="{{route('programmes','diploma')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{App\Course::where('program','certificate')->count()}}</h3>

                <p>Certificate Programmes</p>
              </div>
              <div class="icon">
                <i class="fa fa-certificate" aria-hidden="true"></i>
              </div>
              <a href="{{route('programmes','certificate')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{App\Course::where('program','artisan')->count()}}</h3>

                <p>Artisan Programmes</p>
              </div>
              <div class="icon">
                <i class="fab fa-acquisitions-incorporated    "></i>
              </div>
              <a href="{{route('programmes','artisan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{App\University::where('institution','university')->count()}}</h3>

                <p>Registered Universities</p>
              </div>
              <div class="icon">
               <i class="fa fa-graduation-cap" aria-hidden="true"></i>
              </div>
              <a href="{{route('uni')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{App\University::where('institution','college')->count()}}</h3>

                <p>Registered Colleges</p>
              </div>
              <div class="icon">
                <i class="fas fa-school    "></i>
              </div>
              <a href="{{route('cole')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{App\Message::where([['readstatus','=',true],['messagetype','=',true],['userid','=',Auth::user()->id]])->count()}}</h3>

                <p>Unread message</p>
              </div>
              <div class="icon">
                <i class="fab fa-modx    "></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
@endsection
