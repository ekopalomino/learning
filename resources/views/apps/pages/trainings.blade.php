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
                    @can('Can Create Training')
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="{{ route('training.create') }}"><button id="sample_editable_1_new" class="btn red btn-outline sbold"> Tambah Training
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
                                <th>Trainer</th>
                                <th>Level</th>
                                <th>Minimum Score</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                				<th>Status</th>
                				<th>Tgl Dibuat</th>
                				<th></th>
                			</tr>
                		</thead>
                		<tbody>
                            @foreach($data as $key => $val)
                			<tr>
                				<td>{{ $key+1 }}</td>
                                <td>{{ $val->training_id }}</td>
                				<td>{{ $val->training_name }}</td>
                                <td>{{ $val->Trainers->facilitator_name }}</td>
                                <td>{{ $val->Level->level_name }}</td>
                                <td>{{ $val->minimum_score }}</td>
                                <td>{{date("d F Y H:i",strtotime($val->start_date)) }}</td>
                                <td>{{date("d F Y H:i",strtotime($val->end_date)) }}</td>
                                <td>
                                    @if($val->status == '1')
                                    <label class="label label-sm label-info">{{ $val->Statuses->name }}</label>
                                    @elseif($val->status == '2')
                                    <label class="label label-sm label-warning">{{ $val->Statuses->name }}</label>
                                    @elseif($val->status == '9')
                                    <label class="label label-sm label-danger">{{ $val->Statuses->name }}</label>
                                    @endif    
                                </td>
                				<td>{{date("d F Y H:i",strtotime($val->created_at)) }}</td>
                				<td>
                                    @can('Can Edit Training')
                                    @if($val->status == '1')
                                    <a class="btn btn-xs btn-info modalMd" href="#" value="{{ action('Apps\TrainingManagementController@trainingEdit',['id'=>$val->id]) }}" title="Edit Data" data-toggle="modal" data-target="#modalMd"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @endcan
                                    @can('Can View Training')
                                    <a class="btn btn-xs btn-warning" href="{{ route('trainingPeople.show',$val->id) }}" title="Lihat" ><i class="fa fa-search"></i></a>
                                    @endcan
                                    @can('Can Delete Training')
                                    @if($val->status == '1')
                                    {!! Form::open(['method' => 'POST','route' => ['training.destroy', $val->id],'style'=>'display:inline','onsubmit' => 'return ConfirmDelete()']) !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>',['type'=>'submit','class' => 'btn btn-xs btn-danger','title'=>'Delete Training']) !!}
                                    {!! Form::close() !!}
                                    @endif
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