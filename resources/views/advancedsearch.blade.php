@extends('app')
@section('title')
    Advanced Search
@endsection

@section('smallcontent-header')
    Tape Storage/Advanced Search
@endsection

@section('content-header')
    Advanced Search
@endsection

@section('content')
	<div class="panel panel-default">
    <div class="panel-body">
      {!! Form::open(array('url' => '/advsearchdata')) !!}
      <div class="form-group">
        {!! Form::label('kode_rak_tape', 'Rak Tape') !!}
        {!! Form::select('kode_rak_tape', $raktape, null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('jenis_tape', 'Jenis Tape') !!}
        {!! Form::select('jenis_tape', $jenistape, null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('lokasi_tape', 'Lokasi Tape') !!}
        {!! Form::select('lokasi_tape', $lokasitape, null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('nomor_label_tape', 'Label Tape') !!}
        {!! Form::text('nomor_label_tape', null , array('class' => 'form-control')) !!}
      </div>
      {!! Form::button(' Search', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
    </div>
    </div>
@endsection
