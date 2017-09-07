@extends('appactivity')
@section('title')
    Update Testing
@endsection

@section('smallcontent-header')
    Activity / Testing Tape / Update {{$listtesting{0}->kode_tape_testing}} 
@endsection

@section('content-header')
    Update {{$listtesting{0}->kode_tape_testing}} 
@endsection

@section('content')
<style >
  input[type=checkbox] {
    visibility: hidden;
    &:checked + label:after {
      opacity: 1;
    }
  }    
  input[type=text] {
    outline: none;
    border: 0px solid;
    width: 100%;
  }    
}
/* end .squaredFour */
</style>
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
        {!! Form::open(array('url' => '/updatetesting')) !!}
        {!! Form::hidden('kode_tape_testing', $listtesting{0}->kode_tape_testing) !!}
        <table class="table table-bordered table-striped table-hover table-condensed tfix">
          <thead align="center">
             <tr>
                  <th>Nomor Label Tape / Tanggal Backup</th>
                  <th>Nama File/Object</th>
                  <th>Library</th>
                  <th>Direstore ke Library</th>
                  <th>Nama File/Object Baru</th>
                  <th colspan="2">Keterangan Status Uji</th>
             </tr>
             <?php
                $i=0;
             ?>
            @if(session('role') == 3 || session('role') == 0)
                @foreach($listtesting as $lt)
                 <tr>
                     <td>
                        {!! Form::hidden('label_tape_testing['.$i.']', $lt->label_tape_testing) !!}
                        {{$lt->label_tape_testing}}
                     </td>
                     <td>
                        {!! Form::text('object_awal_testing['.$i.']', $lt->object_awal_testing) !!}
                     </td>
                     <td>
                        {!! Form::text('library_awal_testing['.$i.']', $lt->library_awal_testing) !!}
                     </td>
                     <td>
                        {!! Form::text('library_tujuan_testing['.$i.']', $lt->library_tujuan_testing) !!}
                     </td>
                     <td>
                        {!! Form::text('object_new_testing['.$i.']', $lt->object_new_testing) !!}
                     </td>
                     <td>
                        @if($lt->hasil_tape_testing == 1)
                            {{ Form::hidden('hasil_testing['.$i.']', '0') }}
                            {{ Form::checkbox('hasil_testing['.$i.']', 1, true, ['id' => 'squaredFour']) }}
                        @else
                            {{ Form::hidden('hasil_testing['.$i.']', '0') }}
                            {{ Form::checkbox('hasil_testing['.$i.']', 1, null, ['id' => 'squaredFour']) }}
                        @endif
                     </td>
                     <td>
                        {!! Form::text('keterangan_testing['.$i.']', $lt->keterangan_tape_testing) !!}
                     </td>
                 </tr>
                 <?php
                    $i++;
                 ?>
                @endforeach
            @else
                 @foreach($listtesting as $lt)
                 <tr>
                     <td>
                        {{$lt->label_tape_testing}}
                     </td>
                     <td>
                        {{$lt->object_awal_testing}}
                     </td>
                     <td>
                        {{$lt->library_awal_testing}}
                     </td>
                     <td>
                        {{$lt->library_tujuan_testing}}
                     </td>
                     <td>
                        {{$lt->object_new_testing}}
                     </td>
                     <td>
                        @if($lt->hasil_tape_testing == 1)
                            {{ Form::checkbox('hasil_testing['.$i.']', 1, true, ['id' => 'squaredFour', 'disabled']) }}
                        @else
                            {{ Form::checkbox('hasil_testing['.$i.']', 1, null, ['id' => 'squaredFour', 'disabled']) }}
                        @endif
                     </td>
                     <td>
                        {{$lt->keterangan_tape_testing}}
                     </td>
                 </tr>
                 <?php
                    $i++;
                 ?>
                @endforeach
            @endif
          </thead>
        </table>
        @if(session('role') == 3 || session('role') == 0)
            {!! Form::button('Update', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        @endif
        {{ csrf_field() }}
        {!! Form::close()!!}
      </div>
    </div>
    </div>
@endsection
