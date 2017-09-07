@extends('appactivity')
@section('title')
    Testing Tape
@endsection

@section('smallcontent-header')
    Activity / Testing Tape
@endsection

@section('content-header')
    Testing Tape
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
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-condensed tfix">
          <thead align="center">
             <tr>
                 <td><b>Kode Tes</b></td>
                 <td><b>Nama Penguji</b></td>
                 <td><b>Tanggal Testing</b></td>
                 <td><b>Status</b></td>
             </tr>
             <?php
              $index = 0;
             ?>
            @foreach($jumlahtest as $jt)
             <tr>
                 <td><a href='/edittest/{{ $jt->kode_tape_testing }}'>{{$jt->kode_tape_testing}}</a></td>
                 <td>{{$jt->penguji_tape_testing}}</td>
                 <td>{{date_create($jt->created_at)->format('d-m-Y')}}</td>
                 <td>{{$hasil[$index]}} </td>
                 @if($hasil[$index] == 'Finished')
                 <td><a target="blank" href='/pdfviewtesting/{{$jt->kode_tape_testing}}'>Export to pdf</a></td>
                 @endif
             </tr>
             <?php
              $index++;
             ?>
            @endforeach
          </thead>
        </table>
        <a href="/createtesting" class="btn btn-primary">Uji Baru</a>
      </div>
    </div>
    </div>
@endsection
