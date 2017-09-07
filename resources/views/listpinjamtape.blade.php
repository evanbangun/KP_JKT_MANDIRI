@extends('apppeminjaman')
@section('title')
    Detail Tape   
@endsection

@section('smallcontent-header')
    Peminjaman / Daftar Tiket / List Tape
@endsection


@section('content-header')
     List Tape Pinjam 
@endsection


@section('content') 
  <div class="panel panel-default">
    <div class="panel-body">
       <br>
        <div>
         
          <div style="margin:0px">
          <!--  <a class="btn btn-primary" href="\openticket"><i class="fa fa-plus-circle"></i> Daftar New Ticket</a> -->
            <a href="{{ route('pdfviewtiket',['id'=>$tiket{0}->no_tiket]) }}">Download PDF</a>
            <table style="width: 100%" class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                          <td><b>No Tiket</b></td>
                           <td><b>No Label Tape</b></td>
                           <td><b>Lokasi Sumber Tape</b></td>
                           <td><b>Lokasi Tujuan Tape</b></td> 
                           
                           
                       </tr>
                   </thead>
                     @foreach($tiket as $t)
                       <tr>
                          <td>{{ $t->no_tiket}}</td>
                           <td>{{ $t->nomor_label_tape }}</td>
                           <td>{{ $t->Sumber}}</td>
                           <td>{{ $t->Tujuan}}</td>
  
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
