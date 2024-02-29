@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop
@section('css')
	 <!--some css-->
    <link rel="stylesheet" href="/assets/css/login_custom.css">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header')
		<b>MEMBER LOGIN</b>
		{{--  <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
			@if (config('services.oauth_server.sso_enable'))
			<li class="pt-2 px-3"><h3 class="card-title">Tipe Login</h3></li>
			<li class="nav-item">
			<a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">SSO</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Web</a>
			</li>
			@else
			<li class="nav-item">
			<a class="nav-link active" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Web</a>
			</li>
			@endif
			
		</ul>--}}
@stop

@section('auth_body')
@include('layouts.partials.messages')
	<div class="tab-content" id="custom-tabs-two-tabContent">
			@if (config('services.oauth_server.sso_enable'))
			<div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">		
				<center><a href="{{ route('ssoLogin') }}" class="btn btn-primary"><b>Masuk</b></a></center>
			</div>
			@endif
			@if (config('services.oauth_server.sso_enable'))
			<div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
			@else
			<div class="tab-pane fade active show" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
			@endif
				<form action="{{ $login_url }}" method="post">
					@csrf

					{{-- Email field --}}
					<div class="input-group mb-3">
						<input type="username" name="username" class="form-control @error('username') is-invalid @enderror"
							   value="{{ old('username') }}" placeholder="username" autofocus>

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
							</div>
						</div>

						
					</div>

					{{-- Password field --}}
					<div class="input-group mb-3">
						<input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
							   placeholder="{{ __('adminlte::adminlte.password') }}">

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
							</div>
						</div>

						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					{{-- Login field --}}
					<div class="row">
						<div class="col-7">
							<div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
								{{-- <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

								<label for="remember">
									Ingatkan Saya
								</label> --}}
							</div>
						</div>

						<div class="col-5">
							<button type=submit class="btn btn-block btn-flat btn-danger{{-- config('adminlte.classes_auth_btn','btn-flatbtn-danger') --}}">
								<span class="fas fa-sign-in-alt"></span>
								Masuk
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
@stop


@section('auth_footer')
    {{-- Password reset link 
    @if($password_reset_url)
        <p class="my-0">
			@if (config('services.oauth_server.sso_enable'))
            <a href="https://sso.poliwangi.ac.id/password/reset">
                Lupa Password
            </a>
			@else
			 <a href="{{ $password_reset_url }}">
                Lupa Password
            </a>
			@endif
        </p>
    @endif--}}
@stop
