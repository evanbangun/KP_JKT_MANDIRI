@extends('apppeminjaman')
@section('title')
    Tambah Tiket
@endsection

@section('smallcontent-header')
    Tiket/Form Tambah Tiket
@endsection

@section('content-header')
    Tambah Tiket
@endsection

@section('content')	
  <div class="panel panel-default">
    <div class="panel-body">
      {!! Form::open(array('url' => '/postpeminjaman')) !!}
      <div class="form-group" hidden="true">
        {!! Form::label('no_tiket', 'No Tiket') !!}
        {!! Form::text('no_tiket', null , array('class' => 'form-control')) !!}
      </div>
      
      <div class="form-group">
        {!! Form::label('nomor_label_tape', 'Nomor Label Tape') !!}
        {!! Form::text('nomor_label_tape', null , array('class' => 'form-control')) !!}
      </div>

        <div class="form-group">
          {!! Form::label('lokasi', 'Lokasi sumber Tape') !!}
          {!! Form::select('lokasi_sumber', $lokasitape, null , array('class' => 'form-control') ) !!}
        </div>

        <div class="form-group">
          {!! Form::label('lokasi', 'Lokasi Tujuan Tape') !!}
          {!! Form::select('lokasi_tujuan', $lokasitape, null , array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">

            {!! Form::label('select', 'Pengembalian', ['class' => 'col-lg-2 control-label'] )  !!}
                {!!Form::date('lama_peminjaman', \Carbon\Carbon::now(),['class' => 'form-control']) !!}
            </div>

      <div class="form-group">
        {!! Form::label('keterangan', 'Keterangan Pinjam') !!}
        {!! Form::textarea('keterangan', null , array('class' => 'form-control')) !!}
      </div>
      {!! Form::button(' Submit', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
    </div>
    </div>
@endsection
