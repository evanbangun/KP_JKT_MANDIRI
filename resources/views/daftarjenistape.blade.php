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
<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link data-require="bootstrap-css@*" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="style.css" />
<script src="script.js"></script>
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
	     <br>
        <div>
          <div>
            <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-plus-circle"></i> Tambah Jenis Tape</a>
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
                            <td align="center"><a href="/jenistapeedit/{{$jt->nomor_jenis}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&emsp;<?php echo '<a href="#edit-modal" data-toggle="modal" id="'.$jt->nomor_jenis.'" data-target="#edit-modal">' ?><i class="fa fa-times-circle" aria-hidden="true"></i><?php echo '</a>' ?></td>
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
              {{ csrf_field() }}
              {!! Form::close()!!}
            </div>
        </div>
      </div>
    </div>
    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title modal-delete-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body edit-content">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
<script>
    $('#edit-modal').on('show.bs.modal', function(e) {
        
        var $modal = $(this),
            esseyId = e.relatedTarget.id;
        
//            $.ajax({
//                cache: false,
//                type: 'POST',
//                url: 'backend.php',
//                data: 'EID='+essay_id,
//                success: function(data) 
//                {
                $modal.find('.modal-delete-title').html('Input password to delete jenis tape '+esseyId);
                $modal.find('.edit-content').html('<form method="POST" action="/jenistapedelete/'+esseyId+'"><input type="password" name="password" class="form-control"><br><br><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="submit" name="confirm" value="Confirm" class="btn btn-primary"></form>');
//                }
//            });
        
    })
</script>
@endsection
<script>
    function onclickfunc(id) {
        if(confirm("Do you want to delete this item ?"))
        {
          window.location.href = '/tapedelete/'+id;
        }
    }
</script>