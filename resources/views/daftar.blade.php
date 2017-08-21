@extends('appdaftar')
@section('title')
    Daftar Lokasi dan Rak
@endsection

@section('smallcontent-header')
    Daftar Lokasi dan Rak
@endsection

@section('content-header')
    Daftar Lokasi dan Rak
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
	{!! Form::open(array('method'=>'get', 'url' => '/')) !!}
    	{!! Form::label('search', 'Search') !!}
        {!! Form::text('search',null, array('class'=>'form-control', 'placeholder'=>'Cari menurut nomor tape, jenis tape, kode rak, dll.')) !!}
    {!! Form::close()!!}
        <br>
        <div>
          <div style="width: 31%; float:left; margin:0px">
            <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#"><i class="fa fa-plus-circle"></i> Tambah Lokasi</a>
            <table style="width: 90%" class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Nama Lokasi</b></td>
                       </tr>
                   </thead>
                   @foreach($lokasi as $l)
                       <tr>
                           <td>{{ $l->nama_lokasi }}</td>
                       </tr>
                   @endforeach
              </table>
          </div>
          <div style="width: 35%; float:left; margin:0px">
            <a class="btn btn-primary" data-toggle="modal" data-target="#myModal2" href="#"><i class="fa fa-plus-circle"></i> Tambah Rak</a>
            <table style="width: 90%" class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Kode Rak</b></td>
                           <td><b>Lokasi Rak</b></td>
                           <td><b>Kode Tape Rak</b></td>
                       </tr>
                   </thead>
                     @foreach($rak as $r)
                         <tr>
                             <td>{{ $r->nomor_rak }}</td>
                             <td>{{ $r->nama_lokasi }}</td>
                             <td>{{ $r->jenis_tape_rak }}</td>
                         </tr>
                     @endforeach
            </table>  
          </div>
          <div style="width: 34%; float:left; margin:0px">
            <a class="btn btn-primary" data-toggle="modal" data-target="#myModal3" href="#"><i class="fa fa-plus-circle"></i> Tambah Jenis Tape</a>
            <table style="width: 75%" class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Kode Jenis</b></td>
                           <td><b>Nama Jenis</b></td>
                       </tr>
                   </thead>
                     @foreach($jenistape as $j)
                         <tr>
                             <td>{{ $j->nomor_jenis }}</td>
                             <td>{{ $j->nama_jenis }}</td>
                         </tr>
                     @endforeach
            </table>  
          </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Tambah Lokasi</h4>
            </div>
            <div class="modal-body">
              {!! Form::open(array('url' => '/tambahlokasi')) !!}
              <div class="form-group">
                {!! Form::label('nama_lokasi', 'Nama Lokasi') !!}
                {!! Form::text('nama_lokasi', null , array('class' => 'form-control')) !!}
              </div>
              {!! Form::button(' Tambah', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
              {!! Form::button(' Batal', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal'))!!}
              {{ csrf_field() }}
              {!! Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Tambah Rak</h4>
          </div>
            <div class="modal-body">
              {!! Form::open(array('url' => '/tambahrak')) !!}
              <div class="form-group">
                {!! Form::label('nomor_rak', 'Kode Rak') !!}
                {!! Form::text('nomor_rak', null , array('class' => 'form-control')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('lokasi_rak', 'Nama Lokasi') !!}
                {!! Form::select('lokasi_rak', $listlokasi, null , array('class' => 'form-control')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('jenis_tape_rak', 'Kode Tape Rak') !!}
                {!! Form::select('jenis_tape_rak', $listjenis, null , array('class' => 'form-control')) !!}
              </div>
              {!! Form::button(' Tambah', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
              {!! Form::button(' Batal', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal'))!!}
              {{ csrf_field() }}
              {!! Form::close()!!}
            </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Tambah Jenis Tape</h4>
          </div>
            <div class="modal-body">
              {!! Form::open(array('url' => '/tambahjenistape')) !!}
              <div class="form-group">
                {!! Form::label('nomor_jenis', 'Kode Jenis Tape') !!}
                {!! Form::text('nomor_jenis', null , array('class' => 'form-control')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('nama_jenis', 'Nama Jenis') !!}
                {!! Form::text('nama_jenis', null , array('class' => 'form-control')) !!}
              </div>
              {!! Form::button(' Tambah', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
              {!! Form::button(' Batal', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal'))!!}
              {{ csrf_field() }}
              {!! Form::close()!!}
            </div>
        </div>
      </div>
    </div>
@endsection
