@extends('apptiket')
@section('title')
    Tambah Tiket
@endsection

@section('smallcontent-header')
    Tiket/Form Tambah Tiket
@endsection

@section('content-header')
    Tambah Tiket
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
        {!! Form::open(array('url' => '/tiket')) !!}
      
        <div id="room_fileds">
              
            <fieldset> 

            <legend> User Information </legend>
              <div class="form-group">
              {!! Form::label('Email', 'Email:', ['class' => 'col-lg-2 control-label']) !!}
               <div class="col-lg-10">
                {!! Form::email('Email', $value = null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
                </div>
                </div>
                <br>
                <br>
              <div class="form-group">
              {!! Form::label('FullName', 'Full Name:', ['class' => 'col-lg-2 control-label']) !!}
               <div class="col-lg-10">
               {!! Form::text('FullName', null , array('class'   => 'form-control')) !!} 
                </div>
                </div>
                <br>
                <br>
                </fieldset>

                <fieldset>
                <legend>Ticket Information and Options</legend>
                <div class="form-group">
            {!! Form::label('select', 'Ticket Source', ['class' => 'col-lg-2 control-label'] )  !!}
            <div class="col-lg-10">
                {!!  Form::select('TicketSource', array('Server'=>'Server', 'Mobile'=>'Mobile'),'Server', ['class' => 'form-control' ]) !!}
            </div>
            
                <br>
                <br>

                <div class="form-group">
            {!! Form::label('select', 'Help Topic', ['class' => 'col-lg-2 control-label'] )  !!}
            <div class="col-lg-10">
                {!!  Form::select('HelpTopic', array('Help'=>'Help', 'Restore'=>'Restore'),  'Help', ['class' => 'form-control' ]) !!}
            </div>
              <br>
                <br>

                <div class="form-group">
            {!! Form::label('select', 'Departement', ['class' => 'col-lg-2 control-label'] )  !!}
            <div class="col-lg-10">
                {!!  Form::select('Departement', array('External Department'=>'External Department',  'IT Infra'=>'IT Infra'),  'External Department', ['class' => 'form-control' ]) !!}
            </div>
            <br>
                <br>
                <div class="form-group">
            {!! Form::label('select', 'SLA Plan', ['class' => 'col-lg-2 control-label'] )  !!}
            <div class="col-lg-10">
                {!!  Form::select('SLAplan', array('Plan A'=>'Plan A',  'Plan B'=>'Plan B', 'Plan C'=>'Plan C'),  'Plan A', ['class' => 'form-control' ]) !!}
            </div>
                <br>
                <br>
                <br>
                <br>
          <div class="form-group">
            {!! Form::label('select', 'Due Date', ['class' => 'col-lg-2 control-label'] )  !!}
            <div class="col-lg-10">
                {!!Form::date('DueDate', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
            </div>
           
        </fieldset>
        <fieldset>
          <legend>Ticket Details</legend>

           <div class="form-group">
              {!! Form::label('issue', 'Issue Summary:', ['class' => 'col-lg-2 control-label']) !!}
               <div class="col-lg-10">
               {!! Form::text('IssueSummary', null , array('class'   => 'form-control')) !!} 
                </div>
                </div>
                <br>
                <br>
                 <div class="form-group">
            {!! Form::label('issueDetails', 'Issue Details:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::textarea('IssueDetails', $value = null, ['class' => 'form-control', 'rows' => 3]) !!}
                {!! Form::file('file', null,array('class'   => 'form-control')) !!}

            </div>
        </div>

                <br>
                <br>
                <br>
                 <br>
                <br>
                
        <div class="form-group">
            {!! Form::label('select', 'Priority Level:', ['class' => 'col-lg-2 control-label'] )  !!}
            <div class="col-lg-10">
                {!!  Form::select('Priority', array('High'=>'High',  'Medium'=>'Medium','Low'=>'Low'),  'High', ['class' => 'form-control' ]) !!}
            </div>
            <br>
                <br>
              <div class="form-group">
              {!! Form::label('JumlahFile', 'Jumlah File:', ['class' => 'col-lg-2 control-label']) !!}
               <div class="col-lg-10">
               {!! Form::text('jumlahFile', null , array('class'   => 'form-control')) !!} 
                </div>

                <br>
                <br>
              <div class="form-group">
              {!! Form::label('PeriodeWaktu', 'Periode Waktu:', ['class' => 'col-lg-2 control-label']) !!}
               <div class="col-lg-10">
               {!! Form::text('PeriodeWaktu', null , array('class'   => 'form-control')) !!} 
                </div>

                 <br>
                <br>
              <div class="form-group">
              {!! Form::label('DataSource', 'Data Source (Nama Aplikasi / Server):', ['class' => 'col-lg-2 control-label']) !!}
               <div class="col-lg-10">
               {!! Form::text('DataSource', null , array('class'   => 'form-control')) !!} 
                </div>
        </fieldset>
        </div>


        

          
        
          <br>

       <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
            </div>
        </div>
      
        {{ csrf_field() }}
        {!! Form::close()!!}
      </div>
    </div>
  </div>


@endsection
