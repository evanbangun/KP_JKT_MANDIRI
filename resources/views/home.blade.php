@extends('app')
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
    <div class="quick-actions_homepage">

      <ul class="quick-actions">
          <li class="bg_lb"> <a href="#"> <i class="icon-dashboard"></i> <!-- <span class="label label-important">20</span> --> Mengelola User </a> </li>
        
          <li class="bg_lb"> <a href="widgets.html"> <i class="icon-inbox"></i><!-- <span class="label label-success">101</span> --> Mengelola Request Ticket Tape </a> </li>
          <li class="bg_lb"> <a href="tables.html"> <i class="icon-th"></i> List Request Tiket</a> </li>
          <li class="bg_lb"> <a href="\movingtape"> <i class="icon-fullscreen"></i> Mengelola Mutasi Tape</a> </li>
         <li class="bg_lb"> <a href="form-common.html"> <i class="icon-th-list"></i> Mengelola Rak </a> </li>
          <li class="bg_lb"> <a href="form-common.html"> <i class="icon-th-list"></i> Mengelola Tape Terpakai </a> </li>
          <li class="bg_lb"> <a href="\tapekosong"> <i class="icon-th-list"></i> Mengelola Tape Kosong </a> </li>
          <li class="bg_lb"> <a href="form-common.html"> <i class="icon-th-list"></i> Mengelola Lokasi </a> </li>
           <li class="bg_lb"> <a href="form-common.html"> <i class="icon-th-list"></i> Mengelola Stock Opname </a> </li>
         <!--  <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
          <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
          <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
          <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li>
 -->
        </ul>

    </div>




@elseif(session('role') == 1)
    <div class="quick-actions_homepage">
<ul class="quick-actions">
          <li class="bg_lb"> <a href="index.html"> <i class="icon-dashboard"></i> <!-- <span class="label label-important">20</span> --> Mengelola Stock Opname</a> </li>
        <!--   <li class="bg_lg span3"> <a href="charts.html"> <i class="icon-signal"></i> Charts</a> </li> -->
          <li class="bg_lb"> <a href="widgets.html"> <i class="icon-inbox"></i><!-- <span class="label label-success">101</span> --> Mengelola Request Ticket Tape </a> </li>
          <li class="bg_lb"> <a href="tables.html"> <i class="icon-th"></i> List Request Tiket</a> </li>
          <li class="bg_lb"> <a href="/movingtape"> <i class="icon-fullscreen"></i> Mengelola Mutasi Tape</a> </li>
         <li class="bg_lb"> <a href="form-common.html"> <i class="icon-th-list"></i> Mengelola Rak </a> </li>
           <li class="bg_lb"> <a href="form-common.html"> <i class="icon-th-list"></i> Mengelola Tape Terpakai </a> </li>
          <li class="bg_lb"> <a href="\tapekosong"> <i class="icon-th-list"></i> Mengelola Tape Kosong </a> </li>
         <!--  <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
          <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
          <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
          <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li>
 -->
        </ul>

    </div>
@elseif(session('role') == 2)
    <div class="quick-actions_homepage">
    
    <ul class="quick-actions">
        <li class="bg_lb"> <a href="index.html"> <i class="icon-info-sign   "></i> <!-- <span class="label label-important">20</span> --> Pembuatan Report Testing Tape </a> </li>
        
        <!-- <li class="bg_ly"> <a href="widgets.html"> <i class="icon-inbox"></i><span class="label label-success">101</span> Widgets </a> </li> -->
        <!-- <li class="bg_lo"> <a href="tables.html"> <i class="icon-th"></i> Tables</a> </li>
        <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li> -->
        <li class="bg_lb"> <a href="form-common.html"> <i class="icon-th-list"></i> Mengelola Lokasi</a> </li>
        <!-- <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Pembuatan Report Testing</a> </li> -->
       <!--  <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
        <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
        <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li>
 -->
      </ul>
    </div>
@elseif(session('role') == 3)    
    <div class="quick-actions_homepage">

      <ul class="quick-actions">
          <li class="bg_lb"> <a href="/testingtape"> <i class="icon-dashboard"></i> <!-- <span class="label label-important">20</span> --> Testing Tape</a> </li>
          <!-- <li class="bg_lg span3"> <a href="charts.html"> <i class="icon-signal"></i> Charts</a> </li>
          <li class="bg_ly"> <a href="widgets.html"> <i class="icon-inbox"></i><span class="label label-success">101</span> Widgets </a> </li> -->
          <li class="bg_lb"> <a href="tables.html"> <i class="icon-th"></i> List Request Tiket</a> </li>
         <!--  <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li> -->
          <li class="bg_lb"> <a href="form-common.html"> <i class="icon-th-list"></i> Membuat Tiket Request Tape </a> </li>
         <!--  <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
          <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
          <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
          <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li>
 -->
        </ul>

    </div>
@endif
@endsection