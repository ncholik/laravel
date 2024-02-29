@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
	<link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop




@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif
		
        @php
            echo base64_decode('PGZvb3RlciBjbGFzcz0ibWFpbi1mb290ZXIiPgogICAgICAgIDxkaXYgY2xhc3M9ImZsb2F0LXJpZ2h0IGQtbm9uZSBkLXNtLWJsb2NrIj4KICAgICAgICA8Yj5WZXJzaW9uPC9iPiAxLjAuMAogICAgICAgIDwvZGl2PgogICAgICAgIDxzdHJvbmc+Q29weXJpZ2h0IMKpIDIwMjMtMjAyNCA8YSBocmVmPSJodHRwczovL3d3dy55b3V0dWJlLmNvbS9AYmFuZ2Nob2xpayI+QmFuZ0Nob2xpazwvYT4uPC9zdHJvbmc+IEFsbCByaWdodHMgcmVzZXJ2ZWQuCiAgICAgICAgPC9mb290ZXI+CjwvZGl2Pgo8eC1ub3RpZmljYXRpb24tY29tcG9uZW50Lz4=');
        @endphp
@stop


@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
