@extends('apphome')
@section('title')
    Tape Storage
@endsection

@section('smallcontent-header')
    HOME 
@endsection

@section('content-header')
    Home 
@endsection

@section('content')

@if(session('role') == 0)

<!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Tape</div>
                            <div class="text">{{$tape}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text"> Request Tape </div>
                            <div class="text">{{$tiket}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Aktivitas</div>
                            <div class="text">{{$aktivitas}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah User</div>
                            <div class="text">{{$user}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
<div class="container">
    <h1>Main Menu</h1>
    <div class="row cf">
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
       <i class="fa fa-file-o" style="font-size:36px;"></i>
          <div class="line"> <a href="\tapekosong"><h2><b><font color="white">Mengelola Tape Kosong</font></b></h2></a></div>
        </div>
      </div>
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
         <i class="fa fa-file" style="font-size:36px;"></i>
          <div class="line"> <a href="\tape"><h2><b><font color="white">Mengelola Tape Terpakai</font></b></h2></a></div>
         
        </div>
      </div>
      <div class="three col">
         <div class="hamburger" id="hamburger-1">
         <i class="fa fa-location-arrow " style="font-size:36px;"></i>
          <div class="line"> <a href="\daftarlokasi"><h2><b><font color="white">Mengelola Lokasi</font></b></h2></a></div>
         
          
        </div>
      </div>
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
          <i class="fa fa-hdd-o" style="font-size:36px;"></i>
          <div class="line"> <a href="\daftarrak"><h2><b><font color="white">Mengelola Rak</font></b></h2></a></div>
         
        </div>
      </div>
    </div>
    <div class="row cf">
      <div class="three col">
         <div class="hamburger" id="hamburger-1">
          <i class="fa fa-ticket" style="font-size:36px;"></i>
          <div class="line"> <a href="\daftartiket"><h2><b><font color="white">Tiket Request Tape</font></b></h2></a></div>
          
        </div>
      </div>
      <div class="three col">
         <div class="hamburger" id="hamburger-1">
         <i class="fa fa-file-text" style="font-size:36px;"></i>
          <div class="line"> <a href="\testingtape"><h2><b><font color="white">Mengelola Testing Tape</font></b></h2></a></div>
          
        </div>
      </div>
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
         <i class="fa fa-institution" style="font-size:36px;"></i>
          <div class="line"> <a href="\stockopname"><h2><b><font color="white">Mengelola Stock Opname</font></b></h2></a></div>
          
        </div>
      </div>
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
         <i class="fa fa-bullseye" style="font-size:36px;"></i>
          <div class="line"> <a href="\daftarjenistape"><h2><b><font color="white">Mengelola Jenis Tape</font></b></h2></a></div>
          
        </div>
      </div>
    </div>
    <div class="row cf">
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
         <i class="fa fa-user" style="font-size:36px;"></i>
          <div class="line"> <a href="/manageuser"><h2><b><font color="white">Mengelola User</font></b></h2></a></div>
          
        </div>
      </div>
      <div class="three col">
       <div class="hamburger" id="hamburger-1">
         <i class="fa fa-laptop" style="font-size:36px;"></i>
          <div class="line"> <a href="\audittrail"><h2><b><font color="white">Monitoring Audit Trail</font></b></h2></a></div>
          
        </div>
      </div>
      <div class="three col">
         <div class="hamburger" id="hamburger-1">
         <i class="fa fa-truck" style="font-size:36px;"></i>
          <div class="line"> <a href="\movingtape"><h2><b><font color="white">Mengelola Moving Tape</font></b></h2></a></div>
          
        </div>
      </div>
      <div class="three col">
          <div class="hamburger" id="hamburger-1">
         <i class="fa fa-check" style="font-size:36px;"></i>
          <div class="line"> <a href="/testingtape"><h2><b><font color="white">Mengelola Report Testing</font></b></h2></a></div>
          
        </div>
      </div>
    </div>
  </div>



@elseif(session('role') == 1)

<!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Overdue Ticket</div>
                            <div class="text">{{$overduetiket}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text"> New Request Ticket </div>
                            <div class="text">{{$newtiket}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">Done Ticket</div>
                            <div class="text">{{$donetiket}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Close Ticket</div>
                            <div class="text">{{$closetiket}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

<div class="container">
    <h1>Main Menu</h1>
    <div class="row cf">
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
       <i class="fa fa-file-o" style="font-size:36px;"></i>
          <div class="line"> <a href="\tapekosong"><h2><b><font color="white">Mengelola Tape Kosong</font></b></h2></a></div>
        </div>
      </div>
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
         <i class="fa fa-file" style="font-size:36px;"></i>
          <div class="line"> <a href="\tape"><h2><b><font color="white">Mengelola Tape Terpakai</font></b></h2></a></div>
         
        </div>
      </div>
     
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
          <i class="fa fa-hdd-o" style="font-size:36px;"></i>
          <div class="line"> <a href="\daftarrak"><h2><b><font color="white">Mengelola Rak</font></b></h2></a></div>
         
        </div>
      </div>
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
         <i class="fa fa-bullseye" style="font-size:36px;"></i>
          <div class="line"> <a href="\daftarjenistape"><h2><b><font color="white">Mengelola Jenis Tape</font></b></h2></a></div>
          
        </div>
      </div>
    </div>
    <div class="row cf">
      <div class="three col">
         <div class="hamburger" id="hamburger-1">
          <i class="fa fa-ticket" style="font-size:36px;"></i>
          <div class="line"> <a href="\daftartiket"><h2><b><font color="white">Tiket Request Tape</font></b></h2></a></div>
          
        </div>
      </div>
      
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
         <i class="fa fa-institution" style="font-size:36px;"></i>
          <div class="line"> <a href="\stockopname"><h2><b><font color="white">Mengelola Stock Opname</font></b></h2></a></div>
          
        </div>
      </div>


      <div class="three col">
         <div class="hamburger" id="hamburger-1">
         <i class="fa fa-truck" style="font-size:36px;"></i>
          <div class="line"> <a href="\movingtape"><h2><b><font color="white">Mengelola Moving Tape</font></b></h2></a></div>
          
        </div>
      </div>
      
    </div>
    <div class="row cf">
     
    
  
    </div>
  </div>

    
@elseif(session('role') == 2)
<!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Tape</div>
                            <div class="text">{{$tape}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text"> Jumlah Lokasi</div>
                            <div class="text">{{$lokasi}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Rak</div>
                            <div class="text">{{$rak}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Aktivitas</div>
                            <div class="text">{{$aktivitas}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

<div class="container">
    <h1>Main Menu</h1>
    <div class="row cf">
     
      
      <div class="three col">
         <div class="hamburger" id="hamburger-1">
         <i class="fa fa-location-arrow " style="font-size:36px;"></i>
          <div class="line"> <a href="\daftarlokasi"><h2><b><font color="white">Mengelola Lokasi</font></b></h2></a></div>
         
          
        </div>
      </div>
      <div class="three col">
        <div class="hamburger" id="hamburger-1">
          <i class="fa fa-hdd-o" style="font-size:36px;"></i>
          <div class="line"> <a href="\daftarrak"><h2><b><font color="white">Mengelola Rak</font></b></h2></a></div>
         
        </div>
      </div>

      <div class="three col">
       <div class="hamburger" id="hamburger-1">
         <i class="fa fa-laptop" style="font-size:36px;"></i>
          <div class="line"> <a href="\audittrail"><h2><b><font color="white">Monitoring Audit Trail</font></b></h2></a></div>
    </div>
    </div>

     <div class="three col">
          <div class="hamburger" id="hamburger-1">
         <i class="fa fa-check" style="font-size:36px;"></i>
          <div class="line"> <a href="/testingtape"><h2><b><font color="white">Mengelola Report Testing</font></b></h2></a></div>
          
        </div>
      </div>
      </div>
    <!-- <div class="row cf">
    </div> -->
   <!--  <div class="row cf">
    </div> -->
  </div>

   
@elseif(session('role') == 3)    
    <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text"> Tape On Delivery</div>
                            <div class="text">{{$ondelivery}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text"> Jumlah Ticket</div>
                            <div class="text">{{$tiket}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">Testing Tape</div>
                            <div class="text">{{$testing}}</div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text"></div>
                            <div class="text">4</div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- #END# Widgets -->
<div class="container">
    <h1>Main Menu</h1>
    <div class="row cf">
      <div class="three col">
         <div class="hamburger" id="hamburger-1">
          <i class="fa fa-ticket" style="font-size:36px;"></i>
          <div class="line"> <a href="\daftartiket"><h2><b><font color="white">Tiket Request Tape</font></b></h2></a></div>
          
        </div>
      </div>
      
      
      <div class="three col">
         <div class="hamburger" id="hamburger-1">
         <i class="fa fa-file-text" style="font-size:36px;"></i>
          <div class="line"> <a href="\testingtape"><h2><b><font color="white">Mengelola Testing Tape</font></b></h2></a></div>
          
        </div>
      </div>
  
    </div>
    <!-- <div class="row cf">
      
      
    </div> -->
<!--     <div class="row cf"> 
    </div> -->
  </div>

@endif
@endsection