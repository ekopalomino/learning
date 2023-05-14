@extends('apps.layouts.main')
@section('pageTitle', 'User Profile')
@section('content')
<div class="page-content">
<div class="container">
    <div class="row">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<h1 class="page-title"> Profil Saya</h1>       
    <div class="row">
        <div class="col-lg-3">
            <div class="thumbnail" style="min-height: 514px;">
                <img class="rounded-circle" src="/public/{{ $user->avatar }}" />
                <div class="caption">
                    <h3>{{$user->name}}</h3>
                    <p> Hak Akses :
                        @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        {{$v}}
                    @endforeach
                    @endif
                    </p>
                    <p>Divisi : {{$user->Divisions->name}}</p>
                    <p>Departemen</p>
                    </p>
                    <p>Created date :  {{ date("d F Y",strtotime($user->created_at)) }} jam {{date("g:ha",strtotime($user->created_at)) }}</p>
                    <p>Login Terakhir : {{ date("d F Y",strtotime($user->last_login_at)) }} jam {{date("g:ha",strtotime($user->last_login_at)) }}</p> 
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <h3>Ubah Avatar</h3>
            {!! Form::open(array('route' => 'user.avatar','method'=>'POST', 'files' => true)) !!}
                @csrf
                <div class="form-group">
                    {!! Form::file('avatar', array('placeholder' => 'Avatar File','class' => 'form-control')) !!}
                    <small id="fileHelp" class="form-text text-muted"> Ukuran avatar tidak lebih dari 150x150.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            {!! Form::close() !!}
        </div>
        <div class="col-lg-3">
            <h3>Ubah Password</h3>
            {!! Form::open(array('route' => 'user.password','method'=>'POST', 'files' => true)) !!}
                @csrf
                <div class="form-group">
                    <label class="control-label">Password</label>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <label class="control-label">Confirm Password</label>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>       
@endsection