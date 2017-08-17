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
        <br>
        @if(count($tape))
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
                   @foreach($tape as $t)
                       <tr>
                           <td>{{ $t->kode_label_tape }}</td>
                           <td>{{ $t->nomor_jenis_tape }}</td>
                           <td>{{ $t->kode_rak_tape }}</td>
                           <td>
                           @if($t->status === 1)
                           	Available
                           @elseif($t->status === 0)
                           	Unavailable
                           @endif
                           </td>
                           <td>{{ $t->nomor_baris_tape }}</td>
                           <td>{{ $t->peminjam }}</td>
                       </tr>
                   @endforeach
              </table>
          </div>
        @else
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-triangle"></i> Data Mahasiswa belum ada
            </div>
        @endif
    </div>
    </div>
@endsection
