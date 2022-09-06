@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if(session()->get('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
      <div class="card">
        <div class="card-header">Tạo bài viết</div>
        <div class="card-body">
        <form method="POST" action="{{ route('news.create') }}" aria-label="{{ __('Upload') }}" accept-charset="UTF-8" enctype="multipart/form-data">
          @csrf
            <div class="form-group row">
              <label for="category" class="col-sm-2 col-form-label text-md-right">{{ __('Thể loại') }}</label>
              <div class="col-md-9">
                <select class="custom-select form-control" name="category" id="category">
                  @foreach ($categories as $row)
                    <option value="{{ $row->id }}">{{ $row->name }}</option>  
                  @endforeach
                </select>
                @if ($errors->has('category'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('category') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="photo" class="col-sm-2 col-form-label text-md-right">{{ __('Chọn ảnh bìa') }}</label>
              <div class="col-md-9">
                <input type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" name="photo" id="photo" required>
                @if ($errors->has('photo'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('photo') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="title" class="col-sm-2 col-form-label text-md-right">{{ __('Tiêu đề') }}</label>
              <div class="col-md-9">
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus />
                @if ($errors->has('title'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="introduction" class="col-sm-2 col-form-label text-md-right">{{ __('Giới thiệu') }}</label>
              <div class="col-md-9">
                <textarea id="introduction" cols="10" rows="8" class="form-control{{ $errors->has('introduction') ? ' is-invalid' : '' }}" name="introduction" value="{{ old('introduction') }}" autofocus></textarea>
                @if ($errors->has('introduction'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('introduction') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="content" class="col-sm-2 col-form-label text-md-right">{{ __('Nội dung') }}</label>
              <div class="col-md-9">
                <textarea id="content" cols="10" rows="15" class="ckeditor form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}" required autofocus></textarea>
                @if ($errors->has('content'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('content') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-2 offset-md-2">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Đăng bài') }}
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