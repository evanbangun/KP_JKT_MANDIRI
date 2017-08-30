@extends('app')
@section('title')
    Tambah Tape
@endsection

@section('smallcontent-header')
    Daftar Tape/Terpakai/Tambah Tape
@endsection

@section('content-header')
    Tambah Tape
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
        {!! Form::open(array('url' => '/tape')) !!}
        <div class="form-group">
          {!! Form::label('jenis_tape', 'Jenis Tape') !!}
          {!! Form::select('jenis_tape', $jenistape ,null , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('status_tape', 'Status Tape') !!}
          {!! Form::text('status_tape', null , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('lokasi_tape', 'Lokasi Tape') !!}
          {!! Form::select('lokasi_tape', $lokasitape, null , array('class' => 'form-control')) !!}
        </div>
        <!-- <div class="form-group">
          {!! Form::label('kode_rak_tape', 'Rak Tape') !!}
          {!! Form::select('kode_rak_tape', $raktape, null , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('lapis_tape', 'Lapis Tape') !!}
          {!! Form::text('lapis_tape', null , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('baris_tape', 'Baris Tape') !!}
          {!! Form::text('baris_tape', null , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('slot_tape', 'Slot Tape') !!}
          {!! Form::text('slot_tape', null , array('class' => 'form-control')) !!}
        </div> -->
        <div class="form-group">
          {!! Form::label('keterangan_tape', 'Keterangan Tape') !!}
          {!! Form::text('keterangan_tape', null , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::hidden('digunakan_tape', '1') !!}
        </div>
        <div class="form-group">
          {!! Form::label('bulan_tahun', 'Backup') !!}
          {!! Form::select('bulan', [
               '1' => 'Januari',
               '2' => 'Februari',
               '3' => 'Maret',
               '4' => 'April',
               '5' => 'Mei',
               '6' => 'Juni',
               '7' => 'Juli',
               '8' => 'Agustus',
               '9' => 'September',
               '10' => 'Oktober',
               '11' => 'November',
               '12' => 'Desember'], null, ['class' => 'form-control', 'placeholder' => 'Bulan']
            ) !!}
            <br><br>
          {!! Form::text('tahun', null , array('class' => 'form-control', 'placeholder' => 'Tahun')) !!}
        </div>
        <div class='form-group'>
          {!! Form::label('nomor_label_tape', 'Kode Label Tape') !!}
          {!! Form::textarea('nomor_label_tape', null , array('class' => 'form-control')) !!}     
        </div>
        <br>
        {!! Form::button(' Tambah', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        {!! Form::button(' Batal', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
      </div>
    </div>
  </div>
@endsection
