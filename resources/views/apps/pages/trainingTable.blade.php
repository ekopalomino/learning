@extends('apps.layouts.main')
@section('header.title')
Learning Development | Laporan Training
@endsection
@section('content')
<div class="page-content">
	<div class="portlet box red ">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-database"></i> Query Laporan Training
			</div>
		</div>
		<div class="portlet-body form">
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
			{!! Form::open(array('route' => 'training.index','method'=>'POST', 'class' => 'horizontal-form')) !!}
			@csrf
			<div class="form-body">
				<div class="row">
					<div class="col-md-4">
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Info Training 
                                </div>
                            </div>
                            <div class="portlet-body">
                            	<div class="row">
                            		<div class="col-md-12">
                            			<div class="form-group">
											<label class="control-label">ID Training</label>
											{!! Form::text('sales_ref', null, array('placeholder' => 'ID Training','class' => 'form-control')) !!}
										</div>    		
										<div class="form-group">
											<label class="control-label">Nama Training</label>
											{!! Form::select('customer_id', [null=>'Please Select'] + $getName,[], array('class' => 'form-control')) !!}
										</div>
										<div class="form-group">
											<label class="control-label">Kategori Training</label>
											{!! Form::select('product_id', [null=>'Please Select'] + $getCategory,[], array('class' => 'form-control')) !!}
										</div>
                                        <div class="form-group">
											<label class="control-label">Level Training</label>
											{!! Form::select('product_id', [null=>'Please Select'] + $getCategory,[], array('class' => 'form-control')) !!}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions left">
					<a button type="button" class="btn default" href="{{ route('reportTraining.index') }}">Tutup</a> 
					<button type="submit" class="btn blue">
						<i class="fa fa-search"></i> Cari
					</button>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection