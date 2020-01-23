@extends('apps.layouts.main')
@section('header.title')
FiberTekno | Sales Report
@endsection
@section('content')
<div class="page-content">
	<div class="portlet box red ">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-database"></i> Query Laporan Penjualan
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
			{!! Form::open(array('route' => 'sale-table.view','method'=>'POST', 'class' => 'horizontal-form')) !!}
			@csrf
			<div class="form-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Tanggal Awal</label>
							{!! Form::date('from_date', '', array('id' => 'datepicker','class' => 'form-control')) !!}
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Tanggal Akhir</label>
							{!! Form::date('to_date', '', array('id' => 'datepicker','class' => 'form-control')) !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Customer</label>
							{!! Form::select('customer_id', [null=>'Please Select'] + $getCustomer,[], array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Produk</label>
							{!! Form::select('product_id', [null=>'Please Select'] + $getProduct,[], array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Sales</label>
							{!! Form::select('sales_id', [null=>'Please Select'] + $getSales,[], array('class' => 'form-control')) !!}
						</div>
					</div>
				</div>
				<div class="form-actions left">
					<a button type="button" class="btn default" href="{{ route('sale.table') }}">Cancel</a> 
					<button type="submit" class="btn blue">
						<i class="fa fa-check"></i> Run
					</button>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection