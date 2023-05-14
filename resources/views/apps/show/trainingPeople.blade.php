@extends('apps.layouts.main')
@section('header.title')
Learning Development | Data Peserta
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
						<div class="profile-usertitle-name">{{ $training->training_name}}</div>
						@can('Can Start Training')
						@if($training->status == 1)
						{!! Form::open(['method' => 'POST','route' => ['training.start', $training->id],'style'=>'display:inline']) !!}
						{!! Form::button('<i class="fa fa-check">Mulai</i>',['type'=>'submit','class' => 'btn green btn-outline sbold','title'=>'Start Training']) !!}
						{!! Form::close() !!}
						<a class="btn blue btn-outline sbold modalMd" href="#" value="{{ action('Apps\TrainingManagementController@trainingPeopleCreate',['id'=>$training->id]) }}" title="Upload Peserta Baru" data-toggle="modal" data-target="#modalMd"><i class="fa fa-user">Tambah</i></a>
						@endif
						@endcan
						@can('Can Stop Training')
						@if($training->status == 2)
						{!! Form::open(['method' => 'POST','route' => ['training.stop', $training->id],'style'=>'display:inline']) !!}
                        {!! Form::button('<i class="fa fa-close">Selesai</i>',['type'=>'submit','class' => 'btn red btn-outline sbold','title'=>'Stop Training']) !!}
						{!! Form::close() !!}
						@endif
						@endcan
						@can('Can Upload Score')
						@if($training->status == 3)
						<a class="btn yellow btn-outline sbold modalMd" href="#" value="{{ action('Apps\TrainingManagementController@trainingScoreCreate',['id'=>$training->id]) }}" title="Upload Nilai Training" data-toggle="modal" data-target="#modalMd"><i class="fa fa-list">Nilai</i></a>
						@endif
						@endcan
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
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Kategori : {{ $training->Categories->category_name }}</label>
                                                <p></p> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Level : {{ $training->Level->level_name }}</label>
                                            </div>
											<div class="form-group">
                                                <label class="control-label">Trainer : {{ $training->Trainers->facilitator_name }}</label>
                                            </div>
											<div class="form-group">
                                                <label class="control-label">Jumlah Peserta : {{ $participants }}</label>
                                            </div>                                           
                                        </div>
                                        <div class="col-md-6">
											<div class="form-group">
                                                <label class="control-label">Tanggal Mulai : {{date("d F Y H:i",strtotime($training->start_date)) }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Tanggal Selesai : {{date("d F Y H:i",strtotime($training->end_date)) }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Status Kelas:
												@if($training->status == '1')
													<label class="label label-sm label-info">{{ $training->Statuses->name }}</label>
													@elseif($training->status == '0fb7f4e6-e293-429d-8761-f978dc850a97')
													<label class="label label-sm label-danger">{{ $training->Statuses->name }}</label>
													@else
													<label class="label label-sm label-success">{{ $training->Statuses->name }}</label>
												@endif
												</label>
                                            </div>
										</div>
										<div class="col-md-12">
                                        	<div class="portlet box red">
                                        		<div class="portlet-title">
                                        			<div class="caption">
                                            			<i class="fa fa-users"></i>Data Peserta
                                            		</div>
                                            	</div>
                                            	<div class="portlet-body">
		                                        	<table class="table table-striped table-bordered table-hover" id="sample_2">
		                                        		<thead>
								                			<tr>
																<th>No</th>
																<th>NIK</th>
																<th>Nama Peserta</th>
																<th>Pre Test</th>
																<th>Post Test</th>
																<th>Status</th>
																<th></th>
								                			</tr>
								                		</thead>
								                		<tbody>
								                			@foreach($data as $key => $item)
								                			<tr>
								                				<td>{{ $key+1 }}</td>
																<td>{{ $item->employee_nik }}</td>
																<td>{{ $item->employee_name }}</td>
																<td>{{ $item->pre_score }}</td>
																<td>{{ $item->post_score }}</td>
																<td>
																	@if($item->status_id == '1')
																		<label class="label label-sm label-info">{{ $item->Statuses->name }}</label>
																		@elseif($item->status_id == '5')
																		<label class="label label-sm label-info">{{ $item->Statuses->name }}</label>
																		@elseif($item->status_id == '4')
																		<label class="label label-sm label-success">{{ $item->Statuses->name }}</label>
																		@else
																		<label class="label label-sm label-danger">{{ $item->Statuses->name }}</label>
																	@endif
																</td>
																<td>
																	@can('Can Edit Training')
																	@if($training->status == '3')
																	<a class="btn btn-xs btn-info modalMd" href="#" value="{{ action('Apps\TrainingManagementController@trainingPeopleScore',['id'=>$item->id]) }}" title="Nilai" data-toggle="modal" data-target="#modalMd"><i class="fa fa-edit"></i></a>
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
						                <div class="col-md-6">
							                <div class="form-group">
		                            			<tr>
					                                <td>
					                                    <a button type="close" class="btn red btn-outline sbold" href="{{ url()->previous() }}">Tutup</a>
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
