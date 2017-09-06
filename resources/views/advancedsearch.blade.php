@extends('app')
<style>
/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
@section('title')
    Advanced Search
@endsection

@section('smallcontent-header')
    Tape Storage/Advanced Search
@endsection

@section('content-header')
    Advanced Search
@endsection

@section('content')
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#searchbycategory">Search By Category</a></li>
    <li><a data-toggle="tab" href="#searchbykeyword">Search By Keyword</a></li>
  </ul>

  <div class="tab-content">
    <div id="searchbycategory" class="tab-pane fade in active">
      {!! Form::open(array('url' => '/advsearchdatabc')) !!}
      <div class="form-group">
        {!! Form::label('kode_rak_tape', 'Rak Tape') !!}
        {!! Form::select('kode_rak_tape', $raktape, null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('jenis_tape', 'Jenis Tape') !!}
        {!! Form::select('jenis_tape', $jenistape, null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('lokasi_tape', 'Lokasi Tape') !!}
        {!! Form::select('lokasi_tape', $lokasitape, null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('backup_tahun', 'Tahun Backup') !!}
        {!! Form::text('backup_tahun', null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('nomor_label_tape', 'Label Tape') !!}
        {!! Form::text('nomor_label_tape', null , array('class' => 'form-control')) !!}
      </div>
      {!! Form::button(' Search', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
      <br><br>
    </div>
    <div id="searchbykeyword" class="tab-pane fade">
      {!! Form::open(array('url' => '/advsearchdatakw')) !!}
      <div class="form-group">
        {!! Form::label('kode_rak_tape', 'Rak Tape') !!}
        {!! Form::select('select_rak', ['1' => 'Any', '2' => 'Start With', '3' => 'End With'], 1) !!}
        <br>
        {!! Form::text('kode_rak_tape', null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('jenis_tape', 'Jenis Tape') !!}
        {!! Form::select('select_jenis', ['1' => 'Any', '2' => 'Start With', '3' => 'End With'], 1) !!}
        <br>
        {!! Form::text('jenis_tape', null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('lokasi_tape', 'Lokasi Tape') !!}
        {!! Form::select('select_lokasi', ['1' => 'Any', '2' => 'Start With', '3' => 'End With'], 1) !!}
        <br>
        {!! Form::text('lokasi_tape', null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('nomor_label_tape', 'Label Tape') !!}
        {!! Form::select('select_label', ['1' => 'Any', '2' => 'Start With', '3' => 'End With'], 1) !!}
        <br>
        {!! Form::text('nomor_label_tape', null , array('class' => 'form-control')) !!}
      </div>
      <div class="form-group">
        {!! Form::label('tahun', 'Tahun Backup') !!}
        {!! Form::select('select_tahun', ['1' => 'Any', '2' => 'Start With', '3' => 'End With'], null) !!}
        <br>
        {!! Form::text('tahun', null , array('class' => 'form-control')) !!}
      </div>
      {!! Form::button(' Search', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
      {{ csrf_field() }}
      {!! Form::close()!!}
    </div>
  </div>

</body>
</html>
@endsection