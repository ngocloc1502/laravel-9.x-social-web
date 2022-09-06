@extends('layouts.app')

@section('content')
    {{ $item->getInformRelation }}

    <form method="POST" action="{{ route('progress.update', ['id' => $item->id]) }}">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">User name</label>
            <input name="uri" type="id" class="form-control" value="{{ $item->uri }}" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea name="messages" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $item->note }}</textarea>
        </div>
        <button type="submit" name="" id="" class="btn btn-primary">Button</button>
    </form>
@endsection