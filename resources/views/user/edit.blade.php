@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cài đặt tài khoản chung') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}"  enctype="multipart/form-data">    
                        @method('PUT')
                        @csrf
                            
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-start">{{ __('Tên tài khoản') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{ $info->name }}" value="{{ old('phonenumber') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phonenumber" class="col-md-3 col-form-label text-md-start">{{ __('Số điện thoại') }}</label>

                            <div class="col-md-6">
                                <input id="phonenumber" type="tel" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" maxlength="12" value="{{ $info->phonenumber }}" value="{{ old('phonenumber') }}"  required autocomplete="phonenumber" autofocus>

                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birthday" class="col-md-3 col-form-label text-md-start">{{ __('Ngày sinh') }}</label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <select name="birthday_day" id="day" class="form-select" aria-label="Default select example" required autocomplete="birthday" autofocus>
                                        @for ($i = 1; $i <= 31; $i++)
                                            @if ($i == $info->birthday->format('d'))
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                            @endif
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    
                                    @error('birthday_day')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <select name="birthday_month" id="month" class="form-select" aria-label="Default select example" required autocomplete="birthday" autofocus>
                                        @for ($i = 1; $i <= 12; $i++)
                                            @if ($i ==  $info->birthday->format('m'))
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                            @endif
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    
                                    @error('birthday_month')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <select name="birthday_year" id="year" class="form-select" aria-label="Default select example" required autocomplete="birthday" autofocus>
                                        @for ($i = 2022; $i >= 1900; $i--)
                                            @if ($i ==  $info->birthday->format('Y'))
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                            @endif
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    
                                    @error('birthday_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="sex" class="col-md-3 col-form-label text-md-start">{{ __('Giới tính') }}</label>

                            <div class="col-md-6">
                                <div class="input-group mt-2">
                                    <div class="form-check form-check-inline">
                                        <input id="sexRadio1" type="radio" class="form-check-input @error('sex') is-invalid @enderror" name="sex" value="0" required autocomplete="sex" autofocus {{ $info->sex == 0 ? "checked" : "" }}>
                                   
                                        <label class="form-check-label" for="sexRadio1">Nữ</label> 
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="sexRadio2" type="radio" class="form-check-input @error('sex') is-invalid @enderror" name="sex" value="1" required autocomplete="sex" autofocus {{ $info->sex == 1 ? "checked" : "" }}>
                                        <label class="form-check-label" for="sexRadio2">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="sexRadio3" type="radio" class="form-check-input @error('sex') is-invalid @enderror" name="sex" value="2" required autocomplete="sex" autofocus {{ $info->sex == 2 ? "checked" : "" }}>

                                        <label class="form-check-label" for="sexRadio3">Khác</label>
                                    </div>
                                </div> 

                                @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  
                        </div>

                        <div class="row mb-3">
                            <label  class="col-md-3 col-form-label text-md-start" for="inputGroupFile01">Upload</label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input name="photo" type="file" class="form-control" id="inputGroupFile01">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-start" for="inputGroupFile01">Giới thiệu</label>
                            <div class="col-md-12">
                                <textarea id="description" cols="10" rows="15" class="ckeditor form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus>{{ $info->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="my-3 p-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Lưu') }}
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