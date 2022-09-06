@extends('layouts.app')

@section('content')
<div class="graybg authorpage">
    <div class="container">
        <div class="listrecent listrelated">
            <div class="authorpostbox">
                @if(session()->get('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="section-title">
                            <h2><span>Sửa nội dung</span></h2>
                        </div>
                        <form method="POST" action="{{ route('blog.update', ['id' => $post->id]) }}" aria-label="{{ __('Upload') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="photo" class="col-sm-2 col-form-label text-md-left">{{ __('Tải ảnh lên') }}</label>
                                <div class="col-md-10">
                                    <input type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" name="photos[]" id="photo" multiple>
                                    @if ($errors->has('photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-floating col-12 p-0 my-2">
                                    <textarea class="form-control" name="content" placeholder="Leave a content here" id="floatingTextarea2" style="height: 100px">{{ $post->content }}</textarea>
                                    <label for="floatingTextarea2">Hãy viết gì đó...</label>
                                </div>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 offset-md-12 p-0">
                                    <button type="submit" class="btn btn-primary btn-block">
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
</div>
@endsection