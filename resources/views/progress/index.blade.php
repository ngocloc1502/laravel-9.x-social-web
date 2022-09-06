@extends('layouts.app')

@section('content')
    @foreach ($inform as $item)
        {{ $item->id }}

        @foreach ($item->getUserProgessRelation as $key => $value)
            @if ($key < $count)
                {{ $value->note }}
                <form method="POST" action="{{ route('progress.delete', ['id' => $value->id]) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" name="" id="" class="btn btn-danger">Button</button>
                </form>
                <br>
            @endif
        @endforeach

        <form method="POST" action="{{ route('progress.create', ['id' => $item->id]) }}">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">User name</label>
                <input name="uri" type="id" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea name="messages" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" name="" id="" class="btn btn-primary">Button</button>
        </form>
    @endforeach
@endsection