@extends('appactivity')
@section('title')
    Moving Tape
@endsection

@section('smallcontent-header')
    Activity / Moving Tape
@endsection

@section('content-header')
    Moving Tape
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open(array('url' => '/movetape')) !!}
      <div class="form-group">
        {!! Form::label('lokasi', 'Tujuan') !!}
        {!! Form::select('lokasi', $listlokasi, null, array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('nomor_label_tape', 'Nomor Label Tape') !!}
        {!! Form::textarea('nomor_label_tape', null , array('class' => 'form-control')) !!}
      </div>
      {!! Form::button('Move', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
      </div>
    </div>
@endsection
