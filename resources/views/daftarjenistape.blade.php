@extends('appdaftar')
@section('title')
    Detail Tape
@endsection

@section('smallcontent-header')
    Detail / Tape
@endsection

@section('content-header')
    Detail Tape
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
	     <br>
        <div>
          <div>
            <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#"><i class="fa fa-plus-circle"></i> Tambah Jenis Tape</a>
            <table class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Versi Tape</b></td>
                           <td><b>Merek</b></td>
                           <td><b>Jumlah Terpakai</b></td>
                           <td><b>Jumlah Kosong</b></td>
                           <td><b>Total</b></td>
                       </tr>
                   </thead>
                   @foreach($jenistape as $jt)
                       <tr>
                           <td>{{$jt->nomor_jenis}}</td>
                           <td>{{$jt->nama_jenis}}</td>
                           <td>
                              <?php
                                $found = 0;
                              ?>
                              @foreach($tapeterpakai as $tt)
                                @if($tt->jenis_tape == $jt->nomor_jenis)
                                  {{$tt->jumlah_tape}}
                                  <?php
                                    $found = 1;
                                  ?>
                                @endif
                              @endforeach
                              @if ($found == 0)
                                0
                              @endif
                           </td>
                           <td>
                              <?php
                                $found = 0;
                              ?>
                              @foreach($tapekosong as $tk)
                                @if($tk->jenis_tape == $jt->nomor_jenis)
                                  {{$tk->jumlah_tape}}
                                  <?php
                                    $found = 1;
                                  ?>
                                @endif
                              @endforeach
                              @if ($found == 0)
                                0
                              @endif
                           </td>
                           <td>
                              <?php
                                $found = 0;
                              ?>
                              @foreach($totaltape as $total)
                                @if($total->jenis_tape == $jt->nomor_jenis)
                                  {{$total->jumlah_tape}}
                                  <?php
                                    $found = 1;
                                  ?>
                                @endif
                              @endforeach
                              @if ($found == 0)
                                0
                              @endif
                           </td>
                       </tr>
                   @endforeach
              </table>
          </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Tambah Jenis Tape</h4>
          </div>
            <div class="modal-body">
              {!! Form::open(array('url' => '/tambahjenistape')) !!}
              <div class="form-group">
                {!! Form::label('nomor_jenis', 'Kode Jenis Tape') !!}
                {!! Form::text('nomor_jenis', null , array('class' => 'form-control')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('nama_jenis', 'Nama Jenis') !!}
                {!! Form::text('nama_jenis', null , array('class' => 'form-control')) !!}
              </div>
              {!! Form::button(' Tambah', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
              {!! Form::button(' Batal', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal'))!!}
              {{ csrf_field() }}
              {!! Form::close()!!}
            </div>
        </div>
      </div>
    </div>
@endsection
