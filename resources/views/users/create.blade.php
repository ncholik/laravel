@extends('adminlte::page')

@section('title', 'Tambah User')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<h1>Tambah User</h1>
				<div class="lead">
					Add new user and assign role.
				</div>

				<div class="container mt-4">
					<form method="POST" action="">
						@csrf
						<div class="mb-3">
							<label for="name" class="form-label">Name</label>
							<input value="{{ old('name') }}" 
								type="text" 
								class="form-control" 
								name="name" 
								placeholder="Name" required>

							@if ($errors->has('name'))
								<span class="text-danger text-left">{{ $errors->first('name') }}</span>
							@endif
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input value="{{ old('email') }}"
								type="email" 
								class="form-control" 
								name="email" 
								placeholder="Email address" required>
							@if ($errors->has('email'))
								<span class="text-danger text-left">{{ $errors->first('email') }}</span>
							@endif
						</div>
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input value="{{ old('username') }}"
								type="text" 
								class="form-control" 
								name="username" 
								placeholder="Username" required>
							@if ($errors->has('username'))
								<span class="text-danger text-left">{{ $errors->first('username') }}</span>
							@endif
						</div>

						<button type="submit" class="btn btn-primary">Save user</button>
						<a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
					</form>
				</div>

			
			</div>
        </div>
    </div>
</div>
@stop

