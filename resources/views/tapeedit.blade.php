@extends('app')
@section('title')
    Edit Tape
@endsection

@section('smallcontent-header')
    Daftar Tape/Terpakai/Edit Tape
@endsection

@section('content-header')
    Edit Tape
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
        {!! Form::open(array('url' => '/tapeupdate/'.$datatape->nomor_label_tape)) !!}
        <div class="form-group">
          {!! Form::label('jenis_tape', 'Jenis Tape') !!}
          {!! Form::select('jenis_tape', $listjenis , $datatape->jenis_tape , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('lokasi_tape', 'Lokasi Tape') !!}
          {!! Form::select('lokasi_tape', $listlokasi, $datatape->lokasi_tape , array('class' => 'form-control')) !!}
        </div>
        @if($datatape->digunakan_tape)
        <div class="form-group">
          {!! Form::label('status_tape', 'Status Tape') !!}
          {!! Form::text('status_tape', $datatape->status_tape , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('kode_rak_tape', 'Rak Tape') !!}
          {!! Form::select('kode_rak_tape', $listrak, $datatape->kode_rak_tape , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('slot_tape', 'Slot Tape') !!}
          {!! Form::text('slot_tape', $datatape->slot_tape , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('digunakan_tape', 'Terpakai') !!}
          {!! Form::select('digunakan_tape', array('1' => 'Ya', '0' => 'Tidak'), $datatape->digunakan_tape , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('keterangan_tape', 'Keterangan Tape') !!}
          {!! Form::text('keterangan_tape', $datatape->keterangan_tape , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('bulan_tahun', 'Backup') !!}
          {!! Form::date('bulan_tahun', $datatape->bulan_tahun, array('class' => 'form-control')) !!}
        </div>
        @endif
        <div class='form-group'>
          {!! Form::label('nomor_label_tape', 'Kode Label Tape') !!}
          {!! Form::text('nomor_label_tape', $datatape->nomor_label_tape , array('class' => 'form-control')) !!}     
        </div>
        <br>
        {!! Form::button(' Update', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
      </div>
    </div>
  </div>
@endsection
