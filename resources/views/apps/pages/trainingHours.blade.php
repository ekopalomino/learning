@extends('apps.layouts.main')
@section('header.title')
Learning Development | Training Hours
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
                        <i class="fa fa-database"></i>Data Training Hours
                    </div>
                </div>
                <div class="portlet-body">
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
                    @can('Can Create Setting')
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="{{ route('people.create') }}"><button id="sample_editable_1_new" class="btn red btn-outline sbold"> Record Baru
                            </button></a>
                        </div>
                    </div>
                    @endcan
                	<table class="table table-striped table-bordered table-hover" id="sample_2">
                		<thead>
                			<tr>
                                <th>No</th>
                                <th>ID Training</th>
                				<th>Nama Training</th>
                                <th>Level</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Avg Score</th>
                                <th>Jml Peserta</th>
                				<th>Status</th>
                				<th>Tgl Dibuat</th>
                				<th></th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($data as $key => $val) 
                			<tr>
                				<td>{{ $key+1 }}</td>
                                <td>{{ $val->Trainings->training_id }}</td>
                				<td>{{ $val->Trainings->training_name }}</td>
                                <td>{{ $val->Trainings->Level->level_name }}</td>
                                <td>{{date("d F Y",strtotime($val->Trainings->start_date)) }}</td>
                                <td>{{date("d F Y",strtotime($val->Trainings->end_date)) }}</td>
                                <td></td>
                                <td></td>
                                <td>
                                    @if($val->Trainings->status == '00c4df56-a91b-45c6-a59c-e02577442072')
                                    <label class="label label-sm label-info">{{ $val->Trainings->Statuses->name }}</label>
                                    @elseif($val->Trainings->status == '0fb7f4e6-e293-429d-8761-f978dc850a97')
                                    <label class="label label-sm label-danger">{{ $val->Trainings->Statuses->name }}</label>
                                    @else
                                    <label class="label label-sm label-success">{{ $val->Trainings->Statuses->name }}</label>
                                    @endif    
                                </td>
                				<td>{{date("d F Y H:i",strtotime($val->Trainings->created_at)) }}</td>
                				<td>
                                    <a class="btn btn-xs btn-success modalMd" href="#" value="{{ action('Apps\TrainingManagementController@trainingEdit',['id'=>$val->id]) }}" title="Edit Data" data-toggle="modal" data-target="#modalMd"><i class="fa fa-edit"></i></a> 
                                    @can('Can Delete Contact')
                                    {!! Form::open(['method' => 'POST','route' => ['training.destroy', $val->id],'style'=>'display:inline','onsubmit' => 'return ConfirmDelete()']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>',['type'=>'submit','class' => 'btn btn-xs btn-danger','title'=>'Delete Training']) !!}
                                    {!! Form::close() !!}
                                    @endcan
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
</script>
@endsection