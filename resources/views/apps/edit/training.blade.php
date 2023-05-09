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
			{!! Form::model($data, ['method' => 'POST','route' => ['training.update', $data->id]]) !!}
            @csrf
            <div class="row">
            	<div class="col-md-12">
                	<div class="form-group">
                		<label class="control-label">ID Training</label>
                		{!! Form::text('training_id', null, array('placeholder' => 'ID Training','class' => 'form-control','readonly')) !!}
                	</div>
                    <div class="form-group">
                        <label class="control-label">Nama Training</label>
                        {!! Form::text('training_name', null, array('placeholder' => 'Training Name','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kategori Training</label>
                        {!! Form::select('category', [null=>'Please Select'] + $categories,[], array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nama Trainer</label>
                        {!! Form::select('facilitator_id', [null=>'Please Select'] + $facilitator,[], array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Level Training</label>
                        {!! Form::select('level', $level,old('level'), array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Minimum Score</label>
                        {!! Form::text('minimum_score', null, array('placeholder' => 'Minimum Score','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal Mulai</label>
                        {{ Form::input('dateTime-local', 'start_date',null, ['id' => 'start-date', 'class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal Selesai</label>
                        {{ Form::input('dateTime-local', 'end_date',null, ['id' => 'start-date', 'class' => 'form-control']) }}
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
