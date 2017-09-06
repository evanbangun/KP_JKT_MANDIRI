@extends('appdaftar')
@section('title')
    Detail Tape
@endsection

@section('smallcontent-header')
    Detail / Tape / Edit
@endsection

@section('content-header')
    Detail Tape
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif    	
	<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open(array('url' => '/jenistapeupdate/'.$getjenistape->nomor_jenis)) !!}
        <div class="form-group">
          {!! Form::label('nomor_jenis', 'Nomor Jenis') !!}
          {!! Form::text('nomor_jenis', $getjenistape->nomor_jenis , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('nama_jenis', 'Merek') !!}
          {!! Form::text('nama_jenis', $getjenistape->nama_jenis , array('class' => 'form-control')) !!}
        </div>
        {!! Form::button('Update', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
    </div>
  </div>
@endsection
