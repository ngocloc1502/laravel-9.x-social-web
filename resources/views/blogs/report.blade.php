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
        <div class="card-header">Báo cáo</div>
        <div class="card-body">
        <form method="POST" action="{{ route('blog.report', ['id' => $id]) }}" aria-label="{{ __('Upload') }}" accept-charset="UTF-8">
          @csrf
            <div class="form-group row">
              <label for="checkBox" class="col-sm-2 col-form-label text-md-right">{{ __('Nội dung') }}</label>
              <div class="col-md-9">
                @foreach ($form as $row)    
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="checks[]" value="{{ $row->id }}" id="checkBox">
                      <label class="form-check-label" for="checkBox">
                      {{ $row->name }}
                      </label>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="form-group row">
              <label for="content" class="col-sm-2 col-form-label text-md-right">{{ __('Ghi chú') }}</label>
              <div class="col-md-9">
                <textarea id="content" cols="10" rows="8" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" value="{{ old('content') }}" autofocus></textarea>
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
                      {{ __('Gửi') }}
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