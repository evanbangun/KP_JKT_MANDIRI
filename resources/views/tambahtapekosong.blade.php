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
        {!! Form::open(array('url' => '/tambahtapebatch' , 'onkeypress' => 'return event.keyCode != 13;', 'id' => 'inputform')) !!}
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
        <div id="room_fields">
            <div class='form-group' id="wrapper">
              {!! Form::label('nomor_label_tape', 'Kode Label Tape') !!}
              {!! Form::text('input[0][nomor_label_tape]', null , array('class' => 'form-control')) !!}     
            </div>
            <input type="button" class="btn btn-default" id="more_fields" onchange="check_spaces();" onclick="add_fields();" value="Tambah" />
            <br>
            <br>
        </div>
        {!! Form::button(' Submit', array('type' => 'Submit', 'class' => 'btn btn-primary'))!!}
        {!! Form::button(' Batal', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
      </div>
    </div>
  </div>
  <script>
    window.onload = function() {
        var el = $("input:text").get(0);
        el.focus();
      }
    var itemindex=1;
    window.onkeypress = function(event)
    {
     if (event.keyCode == 13) 
     {
          var newspan = document.createElement('span');
          newspan.innerHTML = '<br><br><input name="input['+ itemindex++ +'][nomor_label_tape]" type="text" class="form-control">';
          document.getElementById('wrapper').appendChild(newspan);
          var el = $("input:text").get(itemindex-1);
          el.focus();
      }
    }
    function add_fields()
    {
      var newspan = document.createElement('span');
      newspan.innerHTML = '<br><br><input name="input['+ itemindex++ +'][nomor_label_tape]" type="text" class="form-control">';
      document.getElementById('wrapper').appendChild(newspan);
    }
  </script>
@endsection
