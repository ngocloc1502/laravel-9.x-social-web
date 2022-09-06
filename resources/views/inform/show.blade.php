@extends('layouts.app')

@section('content')
    {{ $inform }}
    @foreach ($inform->getUserProgessRelation as $item)
        {{ $item }}
    @endforeach
    <form method="POST" action="{{ route('report.update', ['id' => $inform->id]) }}">
        @method('DELETE')
        @csrf
        <button type="submit" name="" id="" class="btn btn-danger">Close task</button>
    </form>

    <form method="POST" action="{{ route('inform.create', ['id' => $item->id]) }}">
        @csrf
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">User name</label>
          <input name="name" type="id" class="form-control" id="exampleFormControlInput1" list="users">
  
          <datalist id="users">        
            @foreach ($users as $user)
              <option value="{{ $user->name }}">            
            @endforeach
          </datalist>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
          <textarea name="messages" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div>
          <p class="fallbackLabel">Enter your birthday:</p>
          <div class="fallbackDatePicker">
            <span>
              <label for="day">Day:</label>
              <select id="day" name="day">
                @for ($i = 1; $i <= 31; $i++)
                  @if ($i == date('d', time())  )
                    <option value="{{ $i }}" selected>{{ $i }}</option>                        
                  @endif
                  <option value="{{ $i }}">{{ $i }}</option>                        
                @endfor
                
              </select>
            </span>
            <span>
              <label for="month">Month:</label>
              <select id="month" name="month">
                @for ($i = 1; $i <= 12; $i++)
                  @if ($i == date('m', time()))
                    <option value="{{ $i }}" selected>{{ "Tháng ".$i }}</option>
                  @endif
                  <option value="{{ $i }}">{{ "Tháng".$i }}</option>
                @endfor
              </select>
            </span>
            <span>
              <label for="year">Year:</label>
              <select id="year" name="year">
                @for ($i = 2000; $i < 2100; $i++)
                  @if ($i == date('Y', time()))
                    <option value="{{ $i }}" selected>{{ $i }}</option>
                  @endif
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </span>
          </div>
        </div>
        <button type="submit" name="" id="" class="btn btn-primary">Button</button>
    </form>

    
@endsection