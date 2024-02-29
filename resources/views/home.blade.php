@extends('adminlte::page')

@section('title', 'Dasbor Simlitabmas')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!
                    <button type="button" class="btn btn-primary m-1" id="btnOpenSaltB">Open Sweetalert2 (Basic)</button>
                    <button type="button" class="btn btn-success m-1" id="btnOpenSaltC">Open Sweetalert2 (Custom)</button>
					</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
	 <!--some css
    <link rel="stylesheet" href="/assets/css/admin_custom.css">-->
@stop

@push('js')
<script>
    $(document).ready(function() {
        $('#btnOpenSaltB').click(function() {
            Swal.fire(
                'Good job!',
                'You clicked the button!',
                'success'
            );
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('#btnOpenSaltC').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            });
        });
    })
</script>
@endpush