@extends('adminlte::page')
@section('title', 'List Menu')
{{-- @section('plugins.Select2', true) --}}
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop

@push('css')
   
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1>Hello World</h1>

                <p>
                    This view is loaded from module: {!! config('kepegawaian.name') !!}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
         
        
    </script>
@endpush