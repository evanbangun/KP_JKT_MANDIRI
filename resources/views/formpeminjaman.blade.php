@extends('appform')
@section('title')
    Peminjaman Tape
@endsection

@section('smallcontent-header')
    Form/Peminjaman Tape
@endsection

@section('content-header')
    Peminjaman Tape
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
      {!! Form::open(array('url' => '/tape')) !!}
      <div class="form-group">
        {!! Form::label('kode_label_tape', 'Kode Label Tape') !!}
        {!! Form::text('kode_label_tape', null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('nomor_baris_tape', 'Baris Tape') !!}
        {!! Form::text('nomor_baris_tape', null , array('class' => 'form-control')) !!}
      </div>
      {!! Form::button(' Submit', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
    </div>
    </div>
@endsection
