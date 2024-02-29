@extends('adminlte::page')
@section('plugins.Select2', true)
@section('title', 'Edit User')

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<h1>Update user</h1>
				
				<div class="container mt-4">
					<form method="post" action="{{ route('users.update', $user->id) }}">
						@method('patch')
						@csrf
						<div class="mb-3">
							<label for="name" class="form-label">Name</label>
							<input value="{{ $user->name }}" 
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
							<input value="{{ $user->email }}"
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
							<input value="{{ $user->username }}"
								type="text" 
								class="form-control" 
								name="username" 
								placeholder="Username" required>
							@if ($errors->has('username'))
								<span class="text-danger text-left">{{ $errors->first('username') }}</span>
							@endif
						</div>
						<div class="mb-3">
							<label for="role" class="form-label">Role</label>
							<select class="form-control select2" 
								name="role[]" required multiple="multiple">
								<option value="">Select role</option>
								@foreach($roles as $role)
									<option value="{{ $role->id }}"
										{{ in_array($role->name, $userRole) 
											? 'selected'
											: '' }}>{{ $role->name }}</option>
								@endforeach
							</select>
							@if ($errors->has('role'))
								<span class="text-danger text-left">{{ $errors->first('role') }}</span>
							@endif
						</div>

						<button type="submit" class="btn btn-primary">Update user</button>
						<a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
					</form>
				</div>
		
			</div>
        </div>
    </div>
</div>

@stop

@push('js')
    <script>
         $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
         });
        
        
    </script>
@endpush