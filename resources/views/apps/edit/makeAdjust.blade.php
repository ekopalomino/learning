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
			{!! Form::model($data, ['method' => 'POST','route' => ['store.adjust', $data->id]]) !!}
            @csrf
            <div class="row">
            	<div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Stok Tambah</label>
                        {!! Form::number('plus_amount', null, array('placeholder' => 'Jumlah','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Stok Kurang</label>
                        {!! Form::number('min_amount', null, array('placeholder' => 'Jumlah','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label class="control-label">Catatan</label>
                        {!! Form::textarea('notes', null, array('placeholder' => 'Catatan','class' => 'form-control')) !!}
                    </div>
                    {{ Form::hidden('product_id', $data->product_id) }}
                    {{ Form::hidden('product_name', $data->product_name) }}
                    {{ Form::hidden('warehouse_name', $data->warehouse_name) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="close" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button id="register" type="submit" class="btn green">Save changes</button>
            </div>
            {!! Form::close() !!}
		</div>
	</div>
</div>       
@endsection
