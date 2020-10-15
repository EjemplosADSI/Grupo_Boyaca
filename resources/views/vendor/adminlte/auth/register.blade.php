@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        {{ csrf_field() }}

        {{-- nombre --}}
        <div class="input-group mb-3">
            <input type="text" minlength="2" maxlength="80" name="nombre" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                value="{{ old('nombre') }}" placeholder="Nombres" required
                   autocomplete = 'nombre' style="text-transform: capitalize"
                   autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('nombre'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </div>
            @endif
        </div>

        {{-- apellido --}}
        <div class="input-group mb-3">
            <input type="text" minlength="2" maxlength="80" name="apellido" class="form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}"
                   autocomplete = 'apellido' style="text-transform: capitalize" value="{{ old('apellido') }}" placeholder="Apellidos">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('apellido'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('apellido') }}</strong>
                </div>
            @endif
        </div>

        {{-- tipo_documento --}}
        <div class="mb-3">
                <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Tipo Documento</option>
                    @foreach(\App\Enums\TipoDocumento::getValues() as $option => $data)
                        <option value="{{ $data }}" >{{ $data }}</option>
                    @endforeach
                </select>
            @if($errors->has('tipo_documento'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('tipo_documento') }}</strong>
                </div>
            @endif
        </div>

        {{-- documento --}}
        <div class="input-group mb-3">
            <input type="text" name="documento" class="form-control {{ $errors->has('documento') ? 'is-invalid' : '' }}"
                   value="{{ old('documento') }}" placeholder="Documento">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('documento'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('documento') }}</strong>
                </div>
            @endif
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password"
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
