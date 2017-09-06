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
        @if(session('role') == 0 || session('role') == 1)
        <a class="btn btn-primary" href="/tambahtapekosong"><i class="fa fa-plus-circle"></i> Tambah Data</a>
        @endif
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
                           <td align="center"><a href="/tapeedit/{{$t->nomor_label_tape}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&emsp;<?php echo '<a href="#" onClick=onclickfunc("'.$t->nomor_label_tape.'"); return false; >' ?><i class="fa fa-times-circle" aria-hidden="true"></i><?php echo '</a>' ?></td>
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
<script>
    function onclickfunc(id) {
        if(confirm("Do you want to delete this item ?"))
        {
          window.location.href = '/tapedelete/'+id;
        }
    }
</script>