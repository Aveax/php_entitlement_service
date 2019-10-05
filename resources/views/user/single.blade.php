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
            <h1>{{$user->name}}</h1>
            <p>Email: {{$user->email}}</p>
            <p>Subscription Type: {{$user->subscription}}</p>
            <p>Subscription end date: {{$user->sub_end_date}}</p>
            <p>Season Pass end date: {{$user->season_pass}}</p>
            @if($permission)
                @if($season_pass == false)
                    <form action="/user/{{$user->id}}/buy_season_pass" method="post">
                        @method('PUT')
                        @csrf
                        <input type="submit" value="Buy Season Pass" />
                    </form>
                @endif
            @endif
    </div>
@endsection
