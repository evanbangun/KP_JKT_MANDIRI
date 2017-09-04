@extends('appdaftar')
@section('title')
    Detail Rak
@endsection

@section('smallcontent-header')
    Detail / Rak
@endsection

@section('content-header')
    Detail Rak
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open(array('url' => '/rakupdate/'.$rak->kode_rak)) !!}
        <div class="form-group">
          {!! Form::label('lokasi_rak', 'Nama Lokasi') !!}
          {!! Form::select('lokasi_rak', $lokasi, $rak->lokasi_rak , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('jenis_tape_rak', 'Kode Tape Rak') !!}
          {!! Form::select('jenis_tape_rak', $jenistape, $rak->jenis_tape_rak , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('kapasitas_rak', 'Kapasitas Rak') !!}
          {!! Form::text('kapasitas_rak', $rak->kapasitas_rak , array('class' => 'form-control')) !!}
        </div>
        {!! Form::button('Update', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
    </div>
    </div>
@endsection
