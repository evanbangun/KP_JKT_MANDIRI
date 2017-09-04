@extends('appdaftar')
@section('title')
    Detail Rak
@endsection

@section('smallcontent-header')
    Detail / Rak
@endsection

@section('content-header')
    Detail Rak
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
	     <br>
        <div>
          <div>
            <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#"><i class="fa fa-plus-circle"></i>Tambah Rak</a>
            <table class="table table-bordered table-striped table-hover table-condensed tfix">
                   <thead align="center">
                       <tr>
                           <td><b>Kode</b></td>
                           <td><b>Jenis</b></td>
                           <td><b>Kapasitas</b></td>
                       </tr>
                   </thead>
                     @foreach($rak as $r)
                           <tr>
                               <td>{{ $r->nomor_rak }}</td>
                               <td>{{ $r->jenis_tape_rak }}</td>
                               <td>
                                <?php
                                  $found = 0;
                                ?>
                                @foreach($tapeperrak as $tpr)
                                  @if ($tpr->krt == $r->kode_rak)
                                    {{$tpr->jumlah_tape}}
                                    <?php
                                      $found = 1;
                                    ?>
                                  @endif
                                @endforeach
                                @if ($found == 0)
                                  0
                                @endif 
                                / {{ $r->kapasitas_rak }}</td>
                                @if(session('role') == 0)
                                  <td align="center"><a href="/rakedit/{{$r->kode_rak}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&emsp;<a href="/rakdelete/{{$r->kode_rak}}"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                                @endif
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
            <h4 class="modal-title" id="myModalLabel">Tambah Rak</h4>
          </div>
            <div class="modal-body">
              {!! Form::open(array('url' => '/tambahrak')) !!}
              <div class="form-group">
                {!! Form::label('lokasi_rak', 'Nama Lokasi') !!}
                {!! Form::select('lokasi_rak', $listlokasi, null , array('class' => 'form-control')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('jenis_tape_rak', 'Kode Tape Rak') !!}
                {!! Form::select('jenis_tape_rak', $listjenis, null , array('class' => 'form-control')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('kapasitas_rak', 'Kapasitas Rak') !!}
                {!! Form::text('kapasitas_rak', null , array('class' => 'form-control')) !!}
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
