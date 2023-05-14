@extends('apps.layouts.main')
@section('content')
<div class="page-content">
	<div class="row">
		<div class="col-md-12">
			<img class="rounded-circle" src="/public/{{ $user->avatar }}" />
			<br>
			<br>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Nama</th>
						<td>{{ $user->name}}</td>
					</tr>
					<tr>
						<th>Hak Akses</th>
						<td>
							@if(!empty($user->getRoleNames()))
			                @foreach($user->getRoleNames() as $v)
			                    {{$v}}
			                @endforeach
			                @endif
			            </td>
					</tr>
					<tr>
						<th>Divisi</th>
						<td>{{ $user->Divisions->name}}</td>
					</tr>
					<tr> 
						<th>Departemen</th>
						<td>{{ $user->Departments->department_name}}</td>
					</tr>
					<tr>
						<th>Tgl Dibuat</th>
						<td>
							{{ date("d F Y",strtotime($user->created_at)) }} jam {{date("g:ha",strtotime($user->created_at)) }}
						</td>
					</tr>
					<tr>
						<th>Login Terakhir</th>
						<td>@if(!empty($user->last_login_at))
							{{ date("d F Y",strtotime($user->last_login_at)) }} jam {{date("g:ha",strtotime($user->last_login_at)) }}
							@endif
						</td>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>       
@endsection