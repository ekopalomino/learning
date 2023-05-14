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
					<div class="col-md-4">
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Info Penjualan 
                                </div>
                            </div>
                            <div class="portlet-body">
                            	<div class="row">
                            		<div class="col-md-12">
                            			<div class="form-group">
											<label class="control-label">Sales Order</label>
											{!! Form::text('sales_ref', null, array('placeholder' => 'No Order','class' => 'form-control')) !!}
										</div>    		
										<div class="form-group">
											<label class="control-label">Customer</label>
											{!! Form::select('customer_id', [null=>'Please Select'] + $getCustomer,[], array('class' => 'form-control')) !!}
										</div>
										<div class="form-group">
											<label class="control-label">Produk</label>
											{!! Form::select('product_id', [null=>'Please Select'] + $getProduct,[], array('class' => 'form-control')) !!}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Tanggal Pembelian 
                                </div>
                            </div>
                            <div class="portlet-body">
                            	<div class="row">
                            		<div class="col-md-12">    		
										<div class="form-group">
											<label class="control-label">From</label>
											{!! Form::date('from_date', '', array('id' => 'datepicker','class' => 'form-control')) !!}
										</div>
										<div class="form-group">
											<label class="control-label">To</label>
											{!! Form::date('to_date', '', array('id' => 'datepicker','class' => 'form-control')) !!}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="portlet box blue-hoki">
							<div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Info Pengiriman 
                                </div>
                            </div>
                            <div class="portlet-body">
                            	<div class="row">
                            		<div class="col-md-12">
                            			<div class="form-group">
											<label class="control-label">Delivery Order</label>
											{!! Form::text('do_ref', null, array('placeholder' => 'No Order','class' => 'form-control')) !!}
										</div>
										<div class="form-group">
											<label class="control-label">Jasa Pengiriman</label>
											{!! Form::select('service_id', [null=>'Please Select'] + $getServices,[], array('class' => 'form-control')) !!}
										</div>    		
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions left">
					<a button type="button" class="btn default" href="{{ route('sale.table') }}">Tutup</a> 
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