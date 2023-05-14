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
			{!! Form::model($data, ['method' => 'POST','route' => ['facilitator.update', $data->id],'files'=>'true']) !!}
            @csrf
            <div class="row">
            	<div class="col-md-12">
                	<div class="form-group">
                		<label class="control-label">Nama Lengkap</label>
                		{!! Form::text('facilitator_name', null, array('placeholder' => 'Trainer Name','class' => 'form-control')) !!}
                	</div>
                    <div class="form-group">
                        <label class="control-label">Deskripsi Singkat</label>
                        {!! Form::textarea('descriptions', null, array('placeholder' => 'Department Name','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Foto Trainer</label>
                        {!! Form::file('facilitator_picture', null, array('placeholder' => 'Bank Statement File','class' => 'form-control')) !!}
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
