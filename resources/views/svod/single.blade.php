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
        <h1>{{$svod->title}}</h1>
        <p>Category: {{$category}}</p>
        @if($permission)
                <p>Content: {{$svod->content}}</p>
        @else
                <p>Content: Access Denied</p>
        @endif
    </div>
@endsection
