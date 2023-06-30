@extends('apps.layouts.main')
@section('header.title')
Learning Development | Employee Management
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
                        <i class="fa fa-database"></i>Data Pegawai 
                    </div>
                    <div class="tools"> </div>
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
                            <tr>
                                <td>
                                    <a class="btn red btn-outline sbold" data-toggle="modal" href="#upload"> Upload Pegawai </a>
                                </td>
                            </tr>
                        </div>
                    </div>
                    @endcan
                    <div class="col-md-6">
                        <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    {!! Form::open(array('route' => 'userUpload.store','method'=>'POST','files'=>'true')) !!}
                                    @csrf
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Upload Pegawai Baru</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Data Pegawai</label>
                                                    {!! Form::file('users', null, array('placeholder' => 'Participant File','class' => 'form-control')) !!}
                                                </div>
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
                	<table class="table table-striped table-bordered table-hover yajra-datatable" id="yajra-datatable">
                		<thead>
                			<tr>
                                <th>No</th>
                				<th>Nama</th>
                                <th>NIK</th>
                                <th>Jabatan</th>
                				<th>Divisi</th>
                				<th>Departemen</th>
                                <th>Group</th>
                				<th>Atasan</th>
                				<th>Status</th>
                				<th>Tgl Dibuat</th>
                			</tr>
                		</thead>
                		<tbody>
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
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        orderable: true, 
        searchable: true,
        ajax: "{{ route('employee.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'employee_name', name: 'employee_name'},
            {data: 'employee_id', name: 'employee_id'},
            {data: 'job_title', name: 'job_title'},
            {data: 'divisions', name: 'division_id'},
            {data: 'departments', name: 'department_id'},
            {data: 'groups', name: 'group_id'},
            {data: 'parent', name: 'report_to'},
            {data: 'statuses', name: 'status_id'},
            {data: 'created_at', name: 'created_at'},
        ]
    });
    
  });
</script>
@endsection