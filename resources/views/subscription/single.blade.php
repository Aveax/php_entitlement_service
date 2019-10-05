@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <h1>{{$sub->name}}</h1>
        <p>Categories: {{$categories}}</p>
        @if(!$permission)
                <form action="/subscription/{{$sub->id}}/buy/{{ auth()->user()->id }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="submit" value="Buy Plan" />
                </form>
        @else
            <p>You have this subscription or better one</p>
        @endif
    </div>
@endsection
