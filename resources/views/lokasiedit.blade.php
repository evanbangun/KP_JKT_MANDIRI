@extends('appdaftar')
@section('title')
    Detail Lokasi
@endsection

@section('smallcontent-header')
    Detail / Lokasi / Edit
@endsection

@section('content-header')
    Detail Lokasi
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
        {!! Form::open(array('url' => '/lokasiupdate/'.$getlokasi->kode_lokasi)) !!}
        <div class="form-group">
          {!! Form::label('nama_lokasi', 'Nama Lokasi') !!}
          {!! Form::text('nama_lokasi', $getlokasi->nama_lokasi , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('kode_lokasi', 'Kode Lokasi') !!}
          {!! Form::text('kode_lokasi', $getlokasi->kode_lokasi , array('class' => 'form-control')) !!}
        </div>
        {!! Form::button('Update', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
    </div>
  </div>
@endsection
