@extends('adminlte::page')
@section('title', 'Permissions')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
			<div class="card-header d-flex justify-content-between">
				Aktifitas Login
				
			</div>
            <div class="card-body">
			
			
				<table class="table  table-hover">
				  <thead class="thead-dark">
					<tr>
						@role('admin')<th>User</th>@endrole
						<th>User Agent</th>
						<th>IP</th>
						<th style="width:12%" >Tanggal</th>
					</tr>
				  </thead>
				  <tbody>
					@foreach ($loginActivities as $device)
					<tr>
						@role('admin')<td>{{ $device->getUser->username }}</td>@endrole
						<td>{{ $device->user_agent }}</td>
						<td>{{ $device->ip_address }}</td>
						<td>{{ $device->created_at }}</td>
					</tr>
					@endforeach
				  </tbody>
				</table>	
				
				<div class="paginate">
					{!! $loginActivities->links('pagination::bootstrap-4') !!}
				</div>
			
			</div>
        </div>
    </div>
</div>
@stop