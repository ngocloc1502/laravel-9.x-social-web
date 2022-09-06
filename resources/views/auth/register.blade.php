@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tạo tài khoản') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Tên tài khoản') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Nhập lại mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="birthday" class="col-md-4 col-form-label text-md-end">{{ __('Ngày sinh') }}</label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <select name="birthday_day" id="day" class="form-select" aria-label="Default select example" required autocomplete="birthday" autofocus>
                                        @for ($i = 1; $i <= 31; $i++)
                                            @if ($i == $date['day'])
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                            @endif
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>

                                    <select name="birthday_month" id="month" class="form-select" aria-label="Default select example" required autocomplete="birthday" autofocus>
                                        @for ($i = 1; $i <= 12; $i++)
                                            @if ($i == $date['month'])
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                            @endif
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    
                                    <select name="birthday_year" id="year" class="form-select" aria-label="Default select example" required autocomplete="birthday" autofocus>
                                        @for ($i = 2022; $i >= 1900; $i--)
                                            @if ($i == $date['year'])
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                            @endif
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    
                                    @error('phonenumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="sex" class="col-md-4 col-form-label text-md-end">{{ __('Giới tính') }}</label>

                            <div class="col-md-6">
                                <div class="form-check-inline">
                                    <input id="sexRadio1" type="radio" class="form-check-input @error('sex') is-invalid @enderror" name="sex" value="0" required autocomplete="sex" autofocus>

                                    <label class="form-check-label" for="sexRadio1">Nữ</label>
                                </div>
                                <div class="form-check-inline">
                                    <input id="sexRadio2" type="radio" class="form-check-input @error('sex') is-invalid @enderror" name="sex" value="1" required autocomplete="sex" autofocus>

                                    <label class="form-check-label" for="sexRadio2">Nam</label>
                                </div>
                                <div class="form-check-inline">
                                    <input id="sexRadio3" type="radio" class="form-check-input @error('sex') is-invalid @enderror" name="sex" value="2" required autocomplete="sex" autofocus>

                                    <label class="form-check-label" for="sexRadio3">Khác</label>
                                </div>

                                @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Đăng kí') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
