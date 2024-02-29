@extends('adminlte::page')
@section('plugins.Select2', true)
@section('title', 'Tambah User')

@push('css')
    <link rel="stylesheet" href="/assets/css/bootstrap-select.min.css">
@endpush

@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<h1>Tambah Menu</h1>				

				<div class="container mt-4">
					<form method="POST" action="">
						@csrf
						<div class="mb-3">
							<label for="name" class="form-label">Nama</label>
							<input value="{{ old('name') }}" 
								type="text" 
								class="form-control  col-sm-8"
								name="name" 
								placeholder="Name" required>

							@if ($errors->has('name'))
								<span class="text-danger text-left">{{ $errors->first('name') }}</span>
							@endif
						</div>
						<div class="mb-3">
							<label for="url" class="form-label">Url</label>
							<input value="{{ old('url') }}"
								type="text" 
								class="form-control  col-sm-8"
								name="url" 
								placeholder="Url">
							@if ($errors->has('url'))
								<span class="text-danger text-left">{{ $errors->first('url') }}</span>
							@endif
						</div>
						<div class="mb-3">
							<label for="can" class="form-label">Menu Induk</label> <br>                   
							<select name="parent_id" class="form-control col-sm-8">   
								<option value='0'> --- Menu Utama --- </option>                                 
								@foreach ($menus as $m)									
									<option value={{ $m->id }}>{{ (($m->getChild() || $m->parent_id==0)?'|   ':'--> ')." ".$m->label }}</option>
								@endforeach
							</select>
						</div>
						<div class="mb-3">
							<label for="can" class="form-label">Hak Akases</label> <br>                   
							<select name="can[]" multiple="multiple" class="form-control select2 col-sm-8">                                    
								@foreach ($roles as $r)
									<option value={{ $r->name }}>{{ $r->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group  mb-3">  
							<label for="icon" class="form-label">Icon</label> 
							<div class="input-group mb-3">                                    
								<select name="icon" id="tt" class="form-control  col-sm-8"  data-show-content="true">                                        
									@php
										$icons = BCL_getIconName();
									@endphp
									@foreach ( $icons as $i)
										<option data-content="<i class='{{ $i }}' aria-hidden='true'></i>&nbsp;&nbsp;{{ $i }}"  value="{{ $i }}">{{ $i }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Save Menu</button>
						<a href="{{ route('menus.index') }}" class="btn btn-default">Back</a>
					</form>
				</div>

			
			</div>
        </div>
    </div>
</div>
@stop

@push('js')
    <script src="/assets/js/bootstrap-select.min.js"></script>
    <script>
         $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            $('#tt').selectpicker();
         });
        
        
    </script>
@endpush