@extends('apps.layouts.main')
@section('header.title')
Learning Development | Data Training Tim
@endsection
@section('header.plugins')
<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('header.styles')
<link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<div class="profile-sidebar">
				<div class="portlet light profile-sidebar-portlet ">
					<div class="profile-userpic">
						<img src="/6427307.png" class="img-responsive" alt="">
					</div>
					<div class="profile-usertitle">
						<div class="profile-usertitle-name"></div>
					</div>
				</div>
			</div>
			<div class="profile-content">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet light ">
							<div class="portlet-title tabbable-line">
								<div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Detail Training</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
									</li>
                                </ul>
                            </div>
							<div class="portlet-body">
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1_1">
										<div class="col-md-12">
                                        	<div class="portlet box red">
                                        		<div class="portlet-title">
                                        			<div class="caption">
                                            			<i class="fa fa-user"></i>Daftar Training {{ $key->employee_name }}
                                            		</div>
                                            	</div>
                                            	<div class="portlet-body">
		                                        	<table class="table table-striped table-bordered table-hover" id="sample_2">
		                                        		<thead>
								                			<tr>
																<th>No</th>
																<th>Nama Training</th>
																<th>Tanggal Mulai</th>
                                                                <th>Tanggal Selesai</th>
																<th>Pre Test</th>
																<th>Post Test</th>
																<th>Status</th>
															</tr>
								                		</thead>
								                		<tbody>
                                                            @foreach($data as $key => $item)
								                			<tr>
								                				<td>{{ $key+1 }}</td>
																<td>{{ $item->training_name }}</td>
                                                                <td>{{date("d F Y H:i",strtotime($item->start_date)) }}</td>
                                                                <td>{{date("d F Y H:i",strtotime($item->end_date)) }}</td>
                                                                <td>{{ $item->pre_score }}</td>
                                                                <td>{{ $item->post_score }}</td>
                                                                <td>
																	@if($item->status_id == '1')
																		<label class="label label-sm label-info">{{ $item->name }}</label>
																		@elseif($item->status_id == '5')
																		<label class="label label-sm label-success">{{ $item->name }}</label>
																		@elseif($item->status_id == '4')
																		<label class="label label-sm label-warning">{{ $item->name }}</label>
																		@else
																		<label class="label label-sm label-danger">{{ $item->name }}</label>
																	@endif  
                                                                </td>
                                                            </tr>
								                			@endforeach
								                		</tbody>
								                	</table>
													Jumlah Data : {{ $data->total() }} <br/>
													{{ $data->links() }}
								                </div>
							                </div>
						                </div>
                                        <div class="col-md-12">
                                        	<div class="portlet box blue">
                                        		<div class="portlet-title">
                                        			<div class="caption">
                                            			<i class="fa fa-users"></i>Daftar Training Anggota Tim 
                                            		</div>
                                            	</div>
                                            	<div class="portlet-body">
		                                        	<table class="table table-striped table-bordered table-hover" id="sample_2">
		                                        		<thead>
								                			<tr>
																<th>No</th>
                                                                <th>Nama Pegawai</th>
																<th>Nama Training</th>
																<th>Tanggal Mulai</th>
                                                                <th>Tanggal Selesai</th>
																<th>Pre Test</th>
																<th>Post Test</th>
																<th>Status</th>
															</tr>
								                		</thead>
								                		<tbody>
                                                            @foreach($getMember as $key => $item)
								                			<tr>
								                				<td>{{ $key+1 }}</td>
                                                                <td>{{ $item->employee_name }}</td>
																<td>{{ $item->training_name }}</td>
                                                                <td>{{date("d F Y H:i",strtotime($item->start_date)) }}</td>
                                                                <td>{{date("d F Y H:i",strtotime($item->end_date)) }}</td>
                                                                <td>{{ $item->pre_score }}</td>
                                                                <td>{{ $item->post_score }}</td>
                                                                <td>
                                                                    @if($item->status_id == '1')
																		<label class="label label-sm label-info">{{ $item->name }}</label>
																		@elseif($item->status_id == '5')
																		<label class="label label-sm label-success">{{ $item->name }}</label>
																		@elseif($item->status_id == '4')
																		<label class="label label-sm label-warning">{{ $item->name }}</label>
																		@else
																		<label class="label label-sm label-danger">{{ $item->name }}</label>
																	@endif  
                                                                </td>
                                                            </tr>
								                			@endforeach
								                		</tbody>
								                	</table>
													Jumlah Data : {{ $getMember->total() }} <br/>
													{{ $getMember->links() }}
								                </div>
							                </div>
						                </div>
						                <div class="col-md-6">
							                <div class="form-group">
		                            			<tr> 
					                                <td>
					                                    <a button type="close" class="btn red btn-outline sbold" href="{{ route('teamTraining.index')}}">Tutup</a>
					                                </td>
					                            </tr>
	                        				</div>
	                        			</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/profile.min.js') }}" type="text/javascript"></script>
@endsection
