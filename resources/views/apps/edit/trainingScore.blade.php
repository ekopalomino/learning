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
			{!! Form::model($data, ['method' => 'POST','route' => ['peopleScore.update', $data->id]]) !!}
            @csrf
            <div class="row">
            	<div class="col-md-12">
                	<div class="form-group">
                		<label class="control-label">Nama Peserta</label>
                		{!! Form::text('employee_name', null, array('placeholder' => 'Level Name','class' => 'form-control','readonly')) !!}
                	</div>
                </div>
                <div class="col-md-12">
                	<div class="form-group">
                		<label class="control-label">Nilai Pre Test</label>
                		{!! Form::number('pre_score', null, array('placeholder' => 'Nilai Pre Test','class' => 'form-control')) !!}
                	</div>
                </div>
                <div class="col-md-12">
                	<div class="form-group">
                		<label class="control-label">Nilai Post Test</label>
                		{!! Form::number('post_score', null, array('placeholder' => 'Nilai Post Test','class' => 'form-control')) !!}
                	</div>
                </div>
                <div class="col-md-12">
                	<div class="form-group">
                		<label class="control-label">Status</label>
                		{!! Form::select('status_id', array('5'=>'Passed','4'=>'Remedial','6'=>'Failed','10'=>'On Leave','11' => 'No Show'),old('status_id'), array('class' => 'form-control')) !!}
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
