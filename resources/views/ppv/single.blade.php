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
        <h1>{{$ppv->title}}</h1>
        @if($permissions['access'] or $permissions['season_pass'])
                <p>Content: {{$ppv->content}}</p>
                @if(!$permissions['season_pass'])
                    <form action="/ppv/{{$ppv->id}}/remove_permission">
                        <input type="submit" value="Revoke" />
                    </form>
                @endif
        @else
                <p>Content: Access Denied</p>
                <form action="/ppv/{{$ppv->id}}/add_permission">
                    <input type="submit" value="Add" />
                </form>
        @endif
    </div>
@endsection
