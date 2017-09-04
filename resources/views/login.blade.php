<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<link href="/css/style.css" rel="stylesheet"> <!-- MANDATORY -->
  <link href="/css/theme.css" rel="stylesheet"> <!-- MANDATORY -->
  <link href="/css/ui.css" rel="stylesheet"> <!-- MANDATORY -->
      <link rel="stylesheet" href="css/stylelogin.css">

  
</head>

<body>
<div class="pen-title">
  <h1>LOGIN</h1>
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li style="text-align:center">{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif    
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="form">
    <h2>Login to your account</h2>
  </div>
  <div class="form">
    {!! Form::open(array('url' => '/loginpost')) !!}
        {!! Form::email('email',null, array('class'=>'form-control', 'placeholder'=>'E-mail')) !!}
        {!! Form::password('password', array( 'class'=>'form-control', 'placeholder'=>'Password')) !!}
        {!! Form::button(' Login', array('type' => 'submit', 'class' => 'btn btn-primary'))!!}
<!--         {{ csrf_field() }} -->
    {!! Form::close()!!}
  </div>
</div>
</body>
</html>
