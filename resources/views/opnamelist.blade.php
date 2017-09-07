@extends('appactivity')
@section('title')
    Stock Opname
@endsection

@section('smallcontent-header')
    Activity / Stock Opname / Opname List
@endsection

@section('content-header')
    Opname List
@endsection

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
	      @if(count($tapes))
          <a class="btn btn-primary" href='/pdfviewopname/{{$opnameby}}/{{$id}}'>Download PDF Form</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Nomor Tape</b></td>
                           <td><b>Jenis Tape</b></td>
                           <td><b>Status</b></td>
                           <td><b>Lokasi Rak</b></td>
                       </tr>
                   </thead>
                   @foreach($tapes as $t)
                       <tr>
                           <td>{{ $t->nomor_label_tape }}</td>
                           <td>{{ $t->jenis_tape }}</td>
                           <td>{{ $t->status_tape }}</td>
                           <td>{{ $t->nama_lokasi }} 
                                @if($t->nomor_rak != NULL)
                                  , Rak {{ $t->nomor_rak }}, Slot {{ $t->slot_tape }}
                                @endif
                           </td>
                     </tr>
                   @endforeach
              </table>
          </div>
        @endif
    </div>
    </div>
@endsection
