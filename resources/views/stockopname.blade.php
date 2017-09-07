@extends('appactivity')
@section('title')
    Stock Opname
@endsection

@section('smallcontent-header')
    Activity/Stock Opname
@endsection

@section('content-header')
    Stock Opname
@endsection

@section('content')
<style>
/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#all">All</a></li>
    <li><a data-toggle="tab" href="#bylokasi">By Location</a></li>
    <li><a data-toggle="tab" href="#byrak">By Rak</a></li>
    <!-- <li><a data-toggle="tab" href="#byyear">By Year</a></li> -->
  </ul>

  <div class="tab-content">
    <div id="all" class="tab-pane fade in active">
      <br>
      {!! Form::open(array('method'=>'get', 'url' => '/opnamelist')) !!}
      {!! Form::hidden('opname_by', 0)!!}
      {!! Form::button('Get Tapes', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
      <br>
    </div>
    <div id="bylokasi" class="tab-pane fade">
      {!! Form::open(array('method'=>'get', 'url' => '/opnamelist')) !!}
      <div class="form-group">
        {!! Form::hidden('opname_by', 1)!!}
        {!! Form::label('lokasi_opname', 'Lokasi Tape') !!}
        {!! Form::select('lokasi_opname', $lokasi, null , array('class' => 'form-control')) !!}
        <br>
      </div>
      {!! Form::button('Get Tapes', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
    </div>
    <div id="byrak" class="tab-pane fade">
      {!! Form::open(array('method'=>'get', 'url' => '/opnamelist')) !!}
      <div class="form-group">
        {!! Form::hidden('opname_by', 2)!!}
        {!! Form::label('rak_opname', 'Rak Tape') !!}
        {!! Form::select('rak_opname', $rak, null , array('class' => 'form-control')) !!}
        <br>
      </div>
      {!! Form::button('Get Tapes', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
    </div>
    <!-- <div id="byyear" class="tab-pane fade">
      {!! Form::open(array('method'=>'get', 'url' => '/opnamelist')) !!}
      <div class="form-group">
        {!! Form::hidden('opname_by', 3)!!}
        {!! Form::label('tahun_opname', 'Tape Tahun') !!}
        {!! Form::text('tahun_mulai', null , array('class' => 'form-control')) !!}
        <br>
      </div>
      {!! Form::button('Get Tapes', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
    </div> -->
  </div>
@endsection