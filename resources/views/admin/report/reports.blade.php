@extends('admin.dashboard')
@section('content')
<style>
      
nav > .nav.nav-tabs{

border: none;
  color:#fff;
  background:#272e38;
  border-radius:0;

}
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
border: none;
  padding: 18px 25px;
  color:#fff;
  background:#272e38;
  border-radius:0;
}

nav > div a.nav-item.nav-link.active:after
{
content: "";
position: relative;
bottom: -60px;
left: -10%;
border: 15px solid transparent;
border-top-color: #e74c3c ;
}
.text-darkii{
  color:#2d2d2d !important;
}
.tab-content{
background: #fdfdfd;
  line-height: 25px;
  border: 1px solid #ddd;
  border-top:5px solid blue;
  border-bottom:5px solid blue;
  padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
border: none;
  background: #e74c3c;
  color:#fff;
  border-radius:0;
  transition:background 0.20s linear;
}
</style>
<div class="container">
              <div class="row">
                <div class="col-xs-12 ">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General report</a>
                     <!--  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Daily Reports</a>
                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Monthly Reports</a>
                      <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Annual reports</a> -->
                     
                    </div>
                  </nav>
                  <div class="tab-content text-darkii py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                          <div class="container report">
                              <div class="card" style="background:#E5E3E3;">
                                <img class="card-img-top" src="holder.js/100px180/" alt="">
                                <div class="card-body">
                                  <h4 class="card-title">General reports</h4> <br> <br>
                                   <div class="row">
                                     <div class="col-md-6">
                                     <table class="table table-striped  table-responsive" style="width:100%;">
                                     <thead class="thead-inverse">
                                       <tr>
                                         <th>#</th>
                                         <th>Description</th>
                                         <th> Value</th>
                                      
                                       </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <td scope="row">1</td>
                                           <td>Number of registered Users</td>
                                           <td>{{$users}}</td>
                                         </tr>
                                         <tr>
                                           <td scope="row">2</td>
                                           <td>Submited Applications</td>
                                           <td>{{$applications}}</td>
                                         </tr>
                                         <tr>
                                           <td scope="row">3</td>
                                           <td>Number of registered Universities</td>
                                           <td>{{$universities}}</td>
                                         </tr>
                                         <tr>
                                           <td scope="row">4</td>
                                           <td>Number of registered Courses</td>
                                           <td>{{$courses}}</td>
                                         </tr>
                            
                                       </tbody>
                                   </table>
                                  
                                     </div>
                                     <div class="col-md-6" style="height:200px">
                                     {!! $chart->container() !!}
                                     </div>
                                     <div class="dropdown-divider col-md-12 my-4"></div>
                                     <div class="col-md-6" style="height:200px">
                                     {!! $chartapp->container() !!}
                                     </div>
                                     <div class="col-md-6" style="height:200px">
                                     {!! $chart3->container() !!}
                                     </div>
                                     <div class="dropdown-divider col-md-12 my-4"></div>
                                     <div class="col-md-6" style="height:200px">
                                     {!! $chart4->container() !!}
                                     </div>
                                     <div class="col-md-6" style="height:200px">
                                     {!! $chart5->container() !!}
                                     </div>
                                   </div>
                                </div>
                              </div>
                          </div>
                          <button class="btn-primary btn-sm float-right" id="printreport"><i class="fas fa-print    "></i> print</button>
                    </div>
                    <!-- <div class="tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      34 et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div>
                    <div class="tab-pane" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                      36 et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div>
                    <div class="tab-pane" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                      37 et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div> -->
                  </div>
                
                </div>
              </div>
        </div>
      </div>
</div>
{!! $chart->script() !!}
{!! $chartapp->script() !!}
{!! $chart3->script() !!}
{!! $chart4->script() !!}
{!! $chart5->script() !!}
@endsection