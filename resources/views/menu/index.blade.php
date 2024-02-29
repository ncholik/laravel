@extends('adminlte::page')
@section('title', 'List Menu')
@section('plugins.Select2', true)
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@push('css')
    <link rel="stylesheet" href="/assets/css/jquery.nestable.min.css">
    <link rel="stylesheet" href="/assets/css/menu-manager.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<h1>Menus</h1>
				<div class="lead">
					Kelola Menu
					<a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm float-right">Tambah menu</a>
				</div>		
				<div class="mt-2">
					@include('layouts.partials.messages')
				</div>                

                <hr />
                <div class="dd" id="nestable">
				@php
                    $html_menu = BCL_menuTree();
                    echo (empty($html_menu)) ? '<ol class="dd-lisat"></ol>' : $html_menu;                    
                @endphp
                </div>
                
                <hr />
                <form action="" method="post">
                    @csrf
                    <input type="hidden" id="nestable-output" name="menu">
                    <button type="submit" class="btn btn-primary">Save Menu</button>
                </form>
			</div>
        </div>
    </div>

    
</div>
@stop

@push('js')
    <script src="/assets/js/jquery.nestable.min.js"></script>
    <script src="/assets/js/menu-manager.js"></script>
    <script src="/assets/js/bootstrap-select.min.js"></script>
    <script>
         $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            $('#tt').selectpicker();
         });
        function setIcon(nama){
            $("#icon").val(nama);
            $('#modalIcon').modal('toggle');
        }
        
    </script>
@endpush