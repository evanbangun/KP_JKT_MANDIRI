@extends('app')
@section('title')
    Tambah Tape Kosong
@endsection

@section('smallcontent-header')
    Daftar Tape/Kosong/Tambah Tape Kosong
@endsection

@section('content-header')
    Tambah Tape Kosong
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open(array('url' => '/tambahtapebatch')) !!}
        <div class="form-group">
          {!! Form::label('jenis_tape', 'Jenis Tape') !!}
          {!! Form::select('jenis_tape', $jenistape ,null , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::label('lokasi_tape', 'Lokasi Tape') !!}
          {!! Form::select('lokasi_tape', $lokasitape, null , array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {!! Form::hidden('digunakan_tape', '0') !!}
        </div>
        <div id="room_fileds">
            <div class='form-group' id="wrapper">
              {!! Form::label('nomor_label_tape', 'Kode Label Tape') !!}
              {!! Form::text('input[0][nomor_label_tape]', null , array('class' => 'form-control')) !!}     
            </div>
            <input type="button" class="btn btn-default" id="more_fields" onclick="add_fields();" value="Tambah" />
            <br>
            <br>
        </div>
        {!! Form::button(' Submit', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        {!! Form::button(' Batal', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
      </div>
    </div>
  </div>
  <script>
  var itemindex=1;
    function add_fields()
    {
      var newspan = document.createElement('span');
      newspan.innerHTML = '<br><br><input name="input['+ itemindex++ +'][nomor_label_tape]" type="text" class="form-control">';
      document.getElementById('wrapper').appendChild(newspan);
    }
  </script>
@endsection
