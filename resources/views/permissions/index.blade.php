@extends('adminlte::page')
@section('title', 'Permissions')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<h2>Permissions</h2>
				<div class="lead">
					Manage your permissions here.
					<a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Add permissions</a>
				</div>
				
				<div class="mt-2">
					@include('layouts.partials.messages')
				</div>

				<table class="table table-striped">
					<thead>
					<tr>
						<th scope="col" width="15%">Name</th>
						<th scope="col">Guard</th> 
						<th scope="col" colspan="3" width="1%"></th> 
					</tr>
					</thead>
					<tbody>
						@foreach($permissions as $permission)
							<tr>
								<td>{{ $permission->name }}</td>
								<td>{{ $permission->guard_name }}</td>
								<td><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm">Edit</a></td>
								<td>
									{!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="d-flex">
					{!! $permissions->links('pagination::bootstrap-4') !!}
				</div>
			</div>
        </div>
    </div>
</div>
@stop
