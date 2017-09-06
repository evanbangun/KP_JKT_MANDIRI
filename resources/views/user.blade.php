@extends('appmanageuser')
@section('title')
    User
@endsection

@section('smallcontent-header')
    Daftar User
@endsection

@section('content-header')
    Daftar User
@endsection

@section('content')	
	<div class="panel panel-default">
    <div class="panel-body">
        <a class="btn btn-primary" href="/tambahuser"><i class="fa fa-plus-circle"></i> Tambah User</a>
        @if(count($user))
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-condensed tfix">
                    <thead align="center">
                       <tr>
                           <td><b>Email</b></td>
                           <td><b>Name</b></td>
                           <!-- <td><b>Password</b></td> -->
                           <td><b>Role</b></td>
                       </tr>
                   </thead>
                   @foreach($user as $u)
                       <tr>
                           <td>{{ $u->email }}</td>
                           <td>{{ $u->name }}</td>
                           <!-- <td>{{ $u->password }}</td> -->
                           <td>
                                @if($u->role == 0)
                                  Administrator
                                @elseif($u->role == 1)
                                  Librarian
                                @elseif($u->role == 2)
                                  Mandiri
                                @elseif($u->role == 3)
                                  Operator
                                @endif
                           </td>
                           <td align="center"><a href="/user/{{$u->email}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&emsp;<a href="/deleteuser/{{$u->email}}"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                      </tr>
                   @endforeach
              </table>
          </div>
        @else
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-triangle"></i> Tidak Ada Data
            </div>
        @endif
    </div>
    </div>
@endsection
