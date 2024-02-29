@extends('adminlte::page')
@section('title', 'List Menu')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@push('css')
    <link rel="stylesheet" href="/assets/css/jquery.nestable.min.css">
    <link rel="stylesheet" href="/assets/css/menu-manager.css">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<h1>Menus</h1>
								
				<div class="mt-2">
					@include('layouts.partials.messages')
				</div>

                <form id="add-item" class="form-group">
                    <div class="input-group  mb-3">
                        <input type="text" name="name" id="inName" placeholder="Name" class="form-control  col-sm-4">
                    </div>
                    <div class="input-group  mb-3">
                        <input type="text" name="url" id="inUrl" placeholder="Url" class="form-control  col-sm-4">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="icon" id="icon" placeholder="icon" class="form-control col-sm-4" value="far fa-circle">
                        <div class="input-group-append">
                            <a href="#" class="input-group-text" data-toggle="modal" data-target="#modalIcon"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <button type="submit"  class="btn btn-primary">Add Menu</button>
                </form>

                <hr />
                <div class="dd" id="nestable">
				@php
                    $html_menu = BCL_menuTree();
                    echo (empty($html_menu)) ? '<ol class="dd-lisat"></ol>' : $html_menu;                    
                @endphp
                </div>

				<hr />
                <form action="menu.php" method="post">
                    <input type="hidden" id="nestable-output" name="menu">
                    <button type="submit" class="btn btn-primary">Save Menu</button>
                </form>

			</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalIcon" tabindex="-1" aria-labelledby="modalIcon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Icon</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @php
                $icons = BCL_getIconName();
            @endphp
            @foreach ( $icons as $i)
                <span class="btn btn-light" style="width:10%;margin-top:4px;" alt="{{ $i }}" onclick="setIcon('{{ $i }}')"><i class="{{ $i }}"></i></span>
            @endforeach
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</div>
@stop

@push('js')
    <script src="/assets/js/jquery.nestable.min.js"></script>
    <script src="/assets/js/menu-manager.js"></script>
    <script>
        function setIcon(nama){
            $("#icon").val(nama);
            $('#modalIcon').modal('toggle');
        }
    </script>
@endpush