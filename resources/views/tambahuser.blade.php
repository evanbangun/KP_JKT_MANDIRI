@extends('appmanageuser')
@section('title')
    Tambah User
@endsection

@section('smallcontent-header')
    Daftar User/ Tambah User
@endsection

@section('content-header')
    Tambah Tape User
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
        {!! Form::open(array('method' => 'post', 'url' => '/user')) !!}
        <div class="form-group">
          {!! Form::label('email', 'Email') !!}
          {!! Form::text('email', null , array('class' => 'form-control')) !!}
        </div>
          <div class="form-group">
          {!! Form::label('name', 'Name') !!}
          {!! Form::text('name', null , array('class' => 'form-control')) !!}
        </div>
     
        <div class="form-group">
          {!! Form::label('password', 'Password') !!}
          {!! Form::text('password', null , array('class' => 'form-control')) !!}
        </div>

          <div class="form-group">
          {!! Form::label('role', 'Role') !!}
          {!! Form::select('role', ['0' => 'Administrator', '1' => 'Librarian', '2' => 'Mandiri', '3' => 'Operator'], null , array('class' => 'form-control')) !!}
        </div>
        <br>
        {!! Form::button(' Tambah', array('type' => 'Submit', 'class' => 'btn btn-primary'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
      </div>
    </div>
@endsection
