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
        {!! Form::model($useredit,['method'=>'PATCH','action'=>['UserController@update',$useredit->email]]) !!}
        <div class="form-group">
          {!! Form::label('email', 'Email') !!}
          {!! Form::text('email', $useredit->email , array('class' => 'form-control')) !!}
        </div>
          <div class="form-group">
          {!! Form::label('name', 'Name') !!}
          {!! Form::text('name', $useredit->name , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('password', 'Password') !!}
          {!! Form::text('password', '' , array('class' => 'form-control')) !!}
        </div>
        @if($useredit->role != 0)
        <div class="form-group">
          {!! Form::label('role', 'Role') !!}
          {!! Form::select('role', ['0' => 'Administrator', '1' => 'Librarian', '2' => 'Mandiri', '3' => 'Operator'], $useredit->role , array('class' => 'form-control')) !!}
        </div>
        @else
          {!! Form::hidden('role', $useredit->role) !!}
        @endif
        <br>
        {!! Form::button(' Update', array('type' => 'Update', 'class' => 'btn btn-primary'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
      </div>
    </div>
@endsection
