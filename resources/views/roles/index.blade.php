@extends('adminlte::page')
@section('title', 'Roles')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<h1>Roles</h1>
				<div class="lead">
					Manage your roles here.
					<a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Add role</a>
				</div>
				
				<div class="mt-2">
					@include('layouts.partials.messages')
				</div>

				<table class="table table-bordered">
				  <tr>
					 <th width="1%">No</th>
					 <th>Name</th>
					 <th width="3%" colspan="3">Action</th>
				  </tr>
					@foreach ($roles as $key => $role)
					<tr>
						<td>{{ $role->id }}</td>
						<td>{{ $role->name }}</td>
						<td>
							<a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Show</a>
						</td>
						<td>
							<a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
						</td>
						<td>
							{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
				</table>

				<div class="d-flex">
					{!! $roles->links('pagination::bootstrap-4') !!}
				</div>

			</div>
        </div>
    </div>
</div>
@endsection
