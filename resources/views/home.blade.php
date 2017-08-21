@extends('app')
@section('title')
    Tape Storage
@endsection

@section('smallcontent-header')
    Tape Storage
@endsection

@section('content-header')
    Tape Storage
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
	{!! Form::open(array('method'=>'get', 'url' => '/searchdata')) !!}
    	{!! Form::label('search', 'Search') !!}
        {!! Form::text('search',null, array('class'=>'form-control', 'placeholder'=>'Cari menurut nomor tape, jenis tape, kode rak, dll.')) !!}
    {!! Form::close()!!}
        <br>
        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#"><i class="fa fa-plus-circle"></i> Tambah Data</a>
        @if(count($tape))
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Nomor Tape</b></td>
                           <td><b>Jenis Tape</b></td>
                           <td><b>Status</b></td>
                           <td><b>Lokasi Rak</b></td>
                           <td><b>Keterangan</b></td>
                       </tr>
                   </thead>
                   @foreach($tape as $t)
                       <tr>
                           <td>{{ $t->nomor_label_tape }}</td>
                           <td>{{ $t->jenis_tape }}</td>
                           <td>{{ $t->status_tape }}</td>
                           <td>{{ $t->nama_lokasi }}, Rak {{ $t->nomor_rak }}, Lapis {{ $t->lapis_tape }}, Baris {{ $t->baris_tape }}, Slot {{ $t->slot_tape }}</td>
                           <td>{{ $t->keterangan_tape }}</td>
                       </tr>
                   @endforeach
              </table>
          </div>
        @else
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-triangle"></i> ERROR
            </div>
        @endif
    </div>
    </div>
    <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Tambah Tape</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => '/tape')) !!}
                <div class="form-group">
                  {!! Form::label('nomor_label_tape', 'Kode Label Tape') !!}
                  {!! Form::text('nomor_label_tape', null , array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('jenis_tape', 'Jenis Tape') !!}
                  {!! Form::select('jenis_tape', $jenistape ,null , array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('status_tape', 'Status Tape') !!}
                  {!! Form::text('status_tape', null , array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('lokasi_tape', 'Lokasi Tape') !!}
                  {!! Form::select('lokasi_tape', $lokasitape, null , array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('kode_rak_tape', 'Rak Tape') !!}
                  {!! Form::select('kode_rak_tape', $raktape, null , array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('lapis_tape', 'Lapis Tape') !!}
                  {!! Form::text('lapis_tape', null , array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('baris_tape', 'Baris Tape') !!}
                  {!! Form::text('baris_tape', null , array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('slot_tape', 'Slot Tape') !!}
                  {!! Form::text('slot_tape', null , array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('keterangan_tape', 'Keterangan Tape') !!}
                  {!! Form::text('keterangan_tape', null , array('class' => 'form-control')) !!}
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
