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
                 <td><b>Label</b></td>
                 <td><b>Jenis</b></td>
                 <td><b>Umur</b></td>
                 <td><b>Status</b></td>
                 <td><b>Keterangan</b></td>
             </tr>
             <?php
                $i=0;
             ?>
            @foreach($listtesting as $lt)
             <tr>
                 <td>
                    {!! Form::hidden('label_tape_testing['.$i.']', $lt->label_tape_testing) !!}
                    {{$lt->label_tape_testing}}
                 </td>
                 <td>{{$lt->jenis_tape}}</td>
                 <td>
                    @if($lt->umur_tape_testing == 12)
                        1 Tahun
                    @elseif($lt->umur_tape_testing == 36)
                        3 Tahun
                    @else
                        {{$lt->umur_tape_testing}} Bulan
                    @endif
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
          </thead>
        </table>
        {!! Form::button('Update', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
        {{ csrf_field() }}
        {!! Form::close()!!}
      </div>
    </div>
    </div>
@endsection
