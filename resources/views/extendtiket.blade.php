@extends('appdaftar')
@section('title')
    Extend Tiket
@endsection

@section('smallcontent-header')
   
@endsection

@section('content-header')
    Extend Tiket
@endsection

@section('content')
<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif    --> 	
	<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open(array('url' => '/extendupdate/'.$getno_tiket->no_tiket)) !!}
       <div class="form-group">

            {!! Form::label('select', 'Pengembalian', ['class' => 'col-lg-2 control-label'] )  !!}
                {!!Form::date('lama_peminjaman', $getno_tiket->lama_peminjaman,['class' => 'form-control']) !!}
            </div>

       <div class="form-group">
        {!! Form::label('keterangan', 'Keterangan Extend') !!}
        {!! Form::textarea('keterangan', $getno_tiket->keterangan , array('class' => 'form-control')) !!}
      </div>
        {!! Form::button('Update', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
    </div>
  </div>
@endsection
