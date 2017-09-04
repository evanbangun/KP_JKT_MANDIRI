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
	{!! Form::open(array('method'=>'get', 'url' => '/searchdata')) !!}
    	{!! Form::label('search', 'Search') !!}
        {!! Form::text('search',null, array('class'=>'form-control', 'placeholder'=>'Cari menurut nomor tape, jenis tape, kode rak, dll.')) !!}
    {!! Form::close()!!}
        <br>
        <a href="/advancedsearch" class="btn btn-default"><i class="fa fa-search"></i> Advanced Search</a>
        <br>
        <a class="btn btn-primary" href="/tape/create"><i class="fa fa-plus-circle"></i> Tambah Data</a>
        Jumlah Seluruh Tape : {{ $jumlahtotaltape }} &emsp; &emsp;
        Terpakai : {{ $jumlahtapeterpakai }} &emsp; &emsp;
        Kosong : {{ $jumlahtotaltape - $jumlahtapeterpakai }} &emsp; &emsp;
        @if(count($tape))
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
                   @foreach($tape as $t)
                       <tr>
                           <td>{{ $t->nomor_label_tape }}</td>
                           <td>{{ $t->jenis_tape }}</td>
                           <td>{{ $t->status_tape }}</td>
                           <td>{{ $t->nama_lokasi }} 
                                @if($t->nomor_rak != NULL)
                                  , Rak {{ $t->nomor_rak }}, Slot {{ $t->slot_tape }}
                                @endif
                           </td>
                           <td>{{ \Carbon\Carbon::parse($t->bulan_tahun)->format('j-n-Y')}}</td>
                           
                          @if(session('role') == 0)
                            <td align="center"><a href="/tapeedit/{{$t->nomor_label_tape}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&emsp;<a href="/tapedelete/{{$t->nomor_label_tape}}"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                          @endif
                     </tr>
                   @endforeach
              </table>
          </div>
        @else
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-triangle"></i> Tidak Ada Data
            </div>
        @endif
    </div>
    </div>
@endsection
