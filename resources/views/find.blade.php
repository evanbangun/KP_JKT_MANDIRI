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
	{!! Form::open(array('method'=>'get', 'url' => '/search')) !!}
    	{!! Form::label('search', 'Search') !!}
        {!! Form::text('search',null, array('class'=>'form-control', 'placeholder'=>'Cari menurut nomor tape, jenis tape, kode rak, dll.')) !!}
    {!! Form::close()!!}
        <br>
        @if(count($found))
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Nomor Tape</b></td>
                           <td><b>Jenis Tape</b></td>
                           <td><b>Kode Rak</b></td>
                           <td><b>Status</b></td>
                           <td><b>Nomor Baris</b></td>
                           <td><b>Peminjam</b></td>
                       </tr>
                   </thead>
                   @foreach($found as $f)
                       <tr>
                           <td>{{ $f->kode_label_tape }}</td>
                           <td>{{ $f->nomor_jenis_tape }}</td>
                           <td>{{ $f->kode_rak_tape }}</td>
                           <td>
                           @if($f->status === 1)
                           	Available
                           @elseif($f->status === 0)
                           	Unavailable
                           @endif
                           </td>
                           <td>{{ $f->nomor_baris_tape }}</td>
                           <td>{{ $f->peminjam }}</td>
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
@endsection
