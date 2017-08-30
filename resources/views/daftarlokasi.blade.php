@extends('appdaftar')
@section('title')
    Detail Lokasi
@endsection

@section('smallcontent-header')
    Detail / Lokasi
@endsection

@section('content-header')
    Detail Lokasi
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
	     <br>
        <div>
          <div>
            <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#"><i class="fa fa-plus-circle"></i> Tambah Lokasi</a>
            <table class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Nama</b></td>
                           <td><b>Kode</b></td>
                           <td><b>Jumlah Rak</b></td>
                           <td><b>Jumlah Tape</b></td>
                       </tr>
                   </thead>
                   @foreach($lokasi as $l)
                           <tr>
                               <td>{{ $l->kode_lokasi }}</td>
                               <td>{{ $l->nama_lokasi }}</td>
                               <td>
                                 <?php
                                    $found = 0;
                                  ?>
                                 @foreach($rakperlokasi as $rpl)
                                    @if ($rpl->lokasi_rak == $l->kode_lokasi)
                                      {{$rpl->jumlah_rak}}
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
                                 @foreach($tapeperlokasi as $tpl)
                                    @if ($tpl->lokasi_tape == $l->kode_lokasi)
                                      {{$tpl->jumlah_tape}}
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
              <h4 class="modal-title" id="myModalLabel">Tambah Lokasi</h4>
            </div>
            <div class="modal-body">
              {!! Form::open(array('url' => '/tambahlokasi')) !!}
              <div class="form-group">
                {!! Form::label('nama_lokasi', 'Nama Lokasi') !!}
                {!! Form::text('nama_lokasi', null , array('class' => 'form-control')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('kode_lokasi', 'Kode Lokasi') !!}
                {!! Form::text('kode_lokasi', null , array('class' => 'form-control')) !!}
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