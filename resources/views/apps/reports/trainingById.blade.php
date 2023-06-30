@extends('apps.layouts.main')
@section('header.title')
FiberTekno | Laporan Penjualan
@endsection
@section('header.styles')
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-database"></i>Laporan Penjualan 
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                	<table class="table table-striped table-bordered table-hover" id="sample_2">
                		<thead>
                			<tr>
                                <th>No</th>
                				<th>Sales Order</th>
                                <th>Nama Pembeli</th>
                                <th>Jumlah Pembelian</th>
                                <th>Total Pembelian</th>
                                <th>Estimasi Dikirim</th>
                                <th>Aktual Dikirim</th>
                                <th>Kurir</th>
                                <th>No Resi</th>
                                <th>Biaya Kirim</th>
                				<th>Sales</th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($data as $key => $val)
                			<tr>
                				<td>{{ $key+1 }}</td>
                				<td>{{ $val->order_ref }}</td>
                                <td>{{ $val->Customers->name }}</td>
                                <td>{{ number_format($val->quantity,0,',','.')}}</td>
                                <td>{{ number_format($val->total,2,',','.')}}</td>
                                <td>{{date("d F Y H:i",strtotime($val->delivery_date)) }}</td>
                                <td>{{date("d F Y H:i",strtotime($val->updated_at)) }}</td>
                                <td>{{ $val->Deliveries->Courier->delivery_name }}</td>
                                <td>{{ $val->Deliveries->receipt }}</td>
                                <td>{{ number_format($val->Deliveries->delivery_cost,2,',','.')}}</td>
                                <td>{{ $val->created_by }}</td>
                			</tr>
                            @endforeach
                		</tbody>
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/table-datatables-buttons.min.js') }}" type="text/javascript"></script>
@endsection