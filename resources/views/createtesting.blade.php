@extends('appactivity')
@section('title')
    Testing Tape
@endsection

@section('smallcontent-header')
    Activity / Testing Tape / New Test
@endsection

@section('content-header')
    Testing Tape
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover table-condensed tfix">
          <thead align="center">
             <tr>
                <td><b>Label Tape</b></td>
                <td><b>Jenis Tape</b></td>
                <td><b>Umur</b></td>
             </tr>
             <tr>
              <?php
                  $i=0
                ?>
            {!! Form::open(array('url' => '/konfirmasitesting')) !!}
            <div class="form-group">
              {!! Form::label('nama_penguji', 'Nama Penguji') !!}
              {!! Form::text('nama_penguji', null , array('class' => 'form-control')) !!}
            </div>
                @foreach($jenistape as $jt)
                  <tr>
                    <td rowspan="4">{{$jt->nomor_jenis}}</td>
                    <td>
                      @if($months3[$i] AND $months3[$i]->jenis_tape == $jt->nomor_jenis)
                        {!! Form::hidden('months3save[]', $months3[$i]->nomor_label_tape) !!}
                        {{$months3[$i]->nomor_label_tape}}
                      @else
                        {!! Form::hidden('months3save[]', '') !!}
                        Tidak Ada Data
                      @endif
                    </td>
                    <td>3 Bulan</td>
                  </tr>
                  <tr>
                    <td>
                    @if($months6[$i] AND $months6[$i]->jenis_tape == $jt->nomor_jenis)
                        {!! Form::hidden('months6save[]', $months6[$i]->nomor_label_tape) !!}
                        {{$months6[$i]->nomor_label_tape}}
                      @else
                        {!! Form::hidden('months6save[]', '') !!}
                        Tidak Ada Data
                      @endif
                    </td>
                    <td>6 Bulan</td>
                  </tr>
                  <tr>
                    <td>
                    @if($years1[$i] AND $years1[$i]->jenis_tape == $jt->nomor_jenis)
                        {!! Form::hidden('years1save[]', $years1[$i]->nomor_label_tape) !!}
                        {{$years1[$i]->nomor_label_tape}}
                      @else
                        {!! Form::hidden('years1save[]', '') !!}
                        Tidak Ada Data
                      @endif
                    </td>
                    <td>1 Tahun</td>
                  </tr>
                  <tr>
                    <td>
                    @if($years3[$i] AND $years3[$i]->jenis_tape == $jt->nomor_jenis)
                        {!! Form::hidden('years3save[]', $years3[$i]->nomor_label_tape) !!}
                        {{$years3[$i]->nomor_label_tape}}
                      @else
                        {!! Form::hidden('years3save[]', '') !!}
                        Tidak Ada Data
                      @endif
                    </td>
                    <td>3 Tahun</td>
                  </tr>
                @endforeach
             </tr>
          </thead>
        </table>
        {!! Form::button('Konfirmasi', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
    </div>
  </div>
@endsection
