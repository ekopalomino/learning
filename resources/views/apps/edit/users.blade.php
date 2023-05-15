@extends('apps.layouts.main') 
@section('content')
<div class="page-content">
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
	<div class="row">
		<div class="col-md-12">
			{!! Form::model($user, ['method' => 'POST','route' => ['user.update', $user->id]]) !!}
            @csrf
            <div class="row">
            	<div class="col-md-12">
                	<div class="form-group">
                		<label class="control-label">Name</label>
                		{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                	</div>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
                	<div class="form-group">
                		<label class="control-label">NIK</label>
                		{!! Form::text('employee_id', null, array('placeholder' => 'NIK','class' => 'form-control')) !!}
                	</div>
                </div>
            </div>
            <div class="row">                                        
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Confim Password</label>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                    </div>
               </div>                                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Divisi</label>
                        {!! Form::select('division_id', $ukers,old('division_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>                                                              
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Departemen</label>
                        {!! Form::select('department_id', $departments,old('department_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>                                                              
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Hak Akses</label>
                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        {!! Form::select('status_id', array('7'=>'Active','8'=>'Suspended'),old('status_id'), array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="close" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                <button id="register" type="submit" class="btn green">Simpan</button>
            </div>
            {!! Form::close() !!}
		</div>
	</div>
</div>       
@endsection
