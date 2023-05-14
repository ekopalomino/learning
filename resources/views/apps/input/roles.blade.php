@extends('apps.layouts.main')
@section('header.title')
Learning Development | Buat Akses
@endsection
@section('header.plugins')
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
	<div class="row">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Form Hak Akses</span>
                </div>
            </div>
            <div class="portlet-body">
            	<div class="row">
            		<div class="col-md-12">
            			{!! Form::open(array('route' => 'role.store','method'=>'POST', 'class' => 'horizontal-form')) !!}
						@csrf
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"><strong>Nama Akses</strong></label>
										{!! Form::text('name', null, array('placeholder' => 'Role Name','class' => 'form-control')) !!}
									</div>
								</div>
							</div>
                            <div class="row">
								<table class="table table-striped table-bordered table-hover order-column" id="role">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Modul</th>
											<th>View</th>
											<th>Create</th>
											<th>Edit</th>
											<th>Delete</th>
											<th>Start</th>
											<th>Stop</th>
											<th>Upload</th>
											<th>Report</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Konfigurasi Umum</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="58" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="51" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="52" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="53" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
											</td>
											<td>
											</td>
											<td>
											</td>
											<td>
											</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Manajemen User</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="2" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="20" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="21" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="22" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
											</td>
											<td>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="20" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
											</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Training</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="58" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="51" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="52" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="53" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="55" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="56" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="54" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="57" name="permission[]" />
													<span></span>
												</label>
											</td>
										</tr>
										<tr>
										<td>4</td>
											<td>Reports</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="58" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="51" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
										</tr>
										<td>5</td>
											<td>Admin Dashboard</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="59" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
										</tr>
										<td>6</td>
											<td>User Dashboard</td>
											<td>
												<label class="mt-checkbox mt-checkbox-outline">
													<input type="checkbox" value="60" name="permission[]" />
													<span></span>
												</label>
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
											<td>
												
											</td>
										</tr>
									</tbody>
								</table>
							</div>
                            <div class="form-actions right">
	                            <a button type="button" class="btn default" href="{{ route('role.index') }}">Tutup</a>
	                            <button type="submit" class="btn blue">
	                                <i class="fa fa-check"></i> Simpan</button>
	                        </div>
	                    {!! Form::close() !!}
	                </div>
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
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/table-datatables-scroller.min.js') }}" type="text/javascript"></script>
@endsection