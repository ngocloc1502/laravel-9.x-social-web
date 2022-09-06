@extends('layouts.app')

@section('content')
    @foreach ($inform as $item)
            
        <a href="{{ route('report.show', ['id' => $item->id]) }}">
            {{ $item }}
            <br>
            <br>
            <br>
            <br>
        </a>
    @endforeach

    {{ $inform->links() }}
@endsection