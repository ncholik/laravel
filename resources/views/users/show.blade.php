@extends('adminlte::page')
@section('title', 'Show User')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<div class="bg-light p-4 rounded">
					<h1>Show user</h1>
					<div class="lead">
						
					</div>
					
					<div class="container mt-4">
						<div>
							Name: {{ $user->name }}
						</div>
						<div>
							Email: {{ $user->email }}
						</div>
						<div>
							Username: {{ $user->username }}
						</div>
					</div>

				</div>
				<div class="mt-4">
					<a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
					<a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
				</div>
	
			</div>
        </div>
    </div>
</div>
@stop