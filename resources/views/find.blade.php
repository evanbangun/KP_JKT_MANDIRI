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
	{!! Form::open(array('method'=>'get', 'url' => '/searchdata')) !!}
    	{!! Form::label('search', 'Search') !!}
        {!! Form::text('search',null, array('class'=>'form-control', 'placeholder'=>'Cari menurut nomor tape, jenis tape, kode rak, dll.')) !!}
    {!! Form::close()!!}
        <br>
        <a href="/advancedsearch" class="btn btn-default"><i class="fa fa-search"></i> Advanced Search</a>
        <br>
        @if(count($found))
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Nomor Tape</b></td>
                           <td><b>Jenis Tape</b></td>
                           <td><b>Status</b></td>
                           <td><b>Lokasi Rak</b></td>
                           <td><b>Backup</b></td>
                       </tr>
                   </thead>
                   @foreach($found as $f)
                       <tr>
                           <td>{{ $f->nomor_label_tape }}</td>
                           <td>{{ $f->jenis_tape }}</td>
                           <td>{{ $f->status_tape }}</td>
                           <td>
                           @if($f->digunakan_tape == 1)
                              {{ $f->nama_lokasi }}
                              @if($f->nomor_rak != '')
                                , Rak {{ $f->nomor_rak }}, Slot {{ $f->slot_tape }}
                              @endif
                           @elseif($f->digunakan_tape == 0)
                              {{ $f->nama_lokasi }}
                           </td>
                           @endif
                           <td>
                            @if($f->bulan_tahun != '')
                                {{ \Carbon\Carbon::parse($f->bulan_tahun)->format('j-n-Y')}}
                            @endif
                           </td>
                       </tr>
                   @endforeach
              </table>
          </div>
        @else
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-triangle"></i> Data Tidak Ditemukan
            </div>
        @endif
    </div>
    </div>
@endsection
