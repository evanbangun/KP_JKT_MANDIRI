@extends('apptiket')
@section('title')
    Daftar Tiket
@endsection

@section('smallcontent-header')
    Tiket/Daftar Tiket 
@endsection

@section('content-header')
    Daftar Tiket
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
                           <td><b>From</b></td>
                           <td><b>Help Topic</b></td>
                           <td><b>Department</b></td>
                           
                           
                           <td><b>Due Date</b></td>
                           <td><b>Issue Summary</b></td>
                           <td><b>Issue Details</b></td>
                           <td><b>File</b></td>
                           <td><b>Priority</b></td>
                           <td><b>Periode Waktu</b></td>
                           <td><b>Status</b></td>
                           <td><b>Download</b></td>
                           
                       </tr>
                   </thead>
                     @foreach($tiket as $t)
                       <tr>
                           <td>{{ $t->no_tiket}}</td>
                           <td>{{ $t->FullName }}</td>
                           <td>{{ $t->HelpTopic}}</td>
                           <td>{{ $t->Departement }}</td>
                           
                           <td>{{ $t->DueDate}}</td>
                           <td>{{ $t->IssueSummary }}</td>
                           <td>{{ $t->IssueDetails}}</td>
                           <td>{{ $t->file}}</td>
                           <td>{{ $t->Priority }}</td>
                           <td>{{ $t->PeriodeWaktu}}</td>
                           <td>{{ $t->status}}</td>

                           <td>
                           
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
