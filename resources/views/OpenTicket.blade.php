@extends('apppeminjaman')
@section('title')
    Open Ticket
@endsection

@section('smallcontent-header')
    Open Ticket
@endsection

@section('content-header')
    Daftar Open Tiket
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
	     <br>
        <div>
         
          <div style="float:left; margin:0px">
           <!--  <a class="btn btn-primary" data-toggle="modal" data-target="#myModal2" href="#"><i class="fa fa-plus-circle"></i> Tambah Rak</a> -->
            <table style="width: 100%" class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                          <td><b>No Tiket</b></td>
                           <td><b>No Label Tape</b></td>
                           <td><b>Lokasi Sumber Tape</b></td>
                           <td><b>Lokasi Tujuan Tape</b></td> 
                           <td><b>Tanggal Akhir Peminjaman</b></td>
                           
                           
                           <td><b>Keterangan </b></td>
                           <td><b>Status</b></td>
                           <td><b>Data Created</b></td>
                           <td><b>Data Updated</b></td>
                           <td><b>Action</b></td>
                           
                       </tr>
                   </thead>
                     @foreach($tiket as $t)
                       <tr>
                          <td>{{ $t->no_tiket}}</td>
                           <td>{{ $t->nomor_label_tape }}</td>
                           <td>{{ $t->Sumber}}</td>
                           <td>{{ $t->Tujuan}}</td>
                           <td>{{ $t->lama_peminjaman }}</td>
                           
                           <td>{{ $t->keterangan}}</td>
                           <td>{{ $t->status }}</td>
                           <td>{{ $t->created_at}}</td>
                           <td>{{ $t->updated_at}}</td>
                           <td><a href = '/updatedopen/{{ $t->no_tiket}}'> Open Ticket</a></td>
                           
                       </tr>
                   @endforeach
                  
            </table>   
          </div>
      
        </div>
    </div>
    </div>
    
     
    <!-- Modal -->

    <!-- Modal -->
    
@endsection