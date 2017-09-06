@extends('appaudittrail')
@section('title')
    Audit Trail
@endsection

@section('smallcontent-header')
    Audit Trail
@endsection

@section('content-header')
    Audit Trail
@endsection

@section('content')	
<div class="panel panel-default">
    <div class="panel-body">
       <br>
        <div>
          <div>
            <table class="table table-bordered table-striped table-hover table-condensed tfix">
                   <thead align="center">
                       <tr>
                           <td><b>Actor</b></td>
                           <td><b>Keterangan</b></td>
                           <td><b>Waktu</b></td>
                       </tr>
                   </thead>
                     @foreach($audittrail as $at)
                           <tr>
                               <td>{{ $at->actor_at }}</td>
                               <td>{{ $at->keterangan_at }}</td>
                               <td>{{ \Carbon\Carbon::parse($at->waktu_at)->format('j-n-Y H:i:s')}}</td>
                            </tr>
                       @endforeach
              </table>
          </div>
        </div>
    </div>
    </div>
@endsection
