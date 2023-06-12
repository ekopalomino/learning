@extends('apps.layouts.main')
@section('header.title')
Learning Development | Training Management
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
                        <i class="fa fa-database"></i>Data Training 
                    </div>
                </div>  
                <div class="portlet-body">
                    <div class="col-md-6">
                            <div class="form-group">
                                <tr>
                                    <td>
                                        <a class="btn red btn-outline sbold" data-toggle="modal" href="#basic"> Cari Pegawai </a>
                                    </td>
                                </tr>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="modal fade" id="basic" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        {!! Form::open(array('route' => 'training.store','method'=>'POST','files'=>'true')) !!}
                                        @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">Cari Pegawai</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    
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
                        </div>
                	<table class="table table-striped table-bordered table-hover" id="sample_2">
                		<thead>
                			<tr>
                                <th>No</th>
                                <th>ID Training</th>
                				<th>Nama Training</th>
                                <th>Trainer</th>
                                <th>Level</th>
                                <th>Nilai Pre Test</th>
                                <th>Nilai Post Test</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                				<th>Status</th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($data as $key => $val)
                			<tr>
                				<td>{{ $key+1 }}</td>
                                <td>{{ $val->Trainings->training_id }}</td>
                				<td>{{ $val->Trainings->training_name }}</td>
                                <td>{{ $val->Trainings->Trainers->facilitator_name }}</td>
                                <td>{{ $val->Trainings->Level->level_name }}</td>
                                <td>{{ $val->pre_score }}</td>
                                <td>{{ $val->post_score }}</td>
                                <td>{{date("d F Y H:i",strtotime($val->Trainings->start_date)) }}</td>
                                <td>{{date("d F Y H:i",strtotime($val->Trainings->end_date)) }}</td>
                                <td>
                                    @if($val->status == '1')
                                    <label class="label label-sm label-info">{{ $val->Trainings->Statuses->name }}</label>
                                    @elseif($val->status == '2')
                                    <label class="label label-sm label-warning">{{ $val->Trainings->Statuses->name }}</label>
                                    @else
                                    <label class="label label-sm label-success">{{ $val->Trainings->Statuses->name }}</label>
                                    @endif    
                                </td>
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
<script>
    function ConfirmDelete()
    {
    var x = confirm("Data Akan Dihapus?");
    if (x)
        return true;
    else
        return false;
    }
    function ConfirmStart()
    {
    var x = confirm("Data Akan Dihapus?");
    if (x)
        return true;
    else
        return false;
    }
</script>
@endsection