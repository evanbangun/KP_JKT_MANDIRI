@extends('app')
@section('title')
    Tape Kosong
@endsection

@section('smallcontent-header')
    Daftar Tape/Kosong
@endsection

@section('content-header')
    Tape Kosong
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
        <a class="btn btn-primary" href="/tambahtapekosong"><i class="fa fa-plus-circle"></i> Tambah Data</a>
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
                           <td><b>Lokasi Tape</b></td>
                       </tr>
                   </thead>
                   @foreach($tape as $t)
                       <tr>
                           <td>{{ $t->nomor_label_tape }}</td>
                           <td>{{ $t->jenis_tape }}</td>
                           <td>{{ $t->nama_lokasi }}</td>
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
