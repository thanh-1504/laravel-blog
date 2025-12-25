@extends('back.layout.auth-layout')
@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Đăng ký</h2>
        </div>
        <form action="{{ route('register_handler') }}" method="POST">
            <x-form-alerts></x-form-alerts>
            @csrf
            <div class="input-group custom mb-1">
                <input type="email" class="form-control form-control-lg" placeholder="Email" name="email"
                    value="{{ old('email') }}" />
                <div class="input-group-append custom">
                    <span class="input-group-text">
                        <i class="icon-copy dw dw-email"></i>
                    </span>
                </div>
            </div>

            @error('email')
                <span class="text-danger ml-1">{{ $message }}</span>
            @enderror

            <div class="input-group custom mb-1 mt-2">
                <input type="password" class="form-control form-control-lg" placeholder="**********" name="password" />
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
            </div>
            @error('password')
                <span class="text-danger ml-1">{{ $message }}</span>
            @enderror
            <div class="row pb-30">
                <div class="col-12">
                    <div class="mt-2">
                        <a href="{{ route('login') }}">Đã có tài khoản?</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-0">
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Đăng ký">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
