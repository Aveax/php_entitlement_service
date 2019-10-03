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
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Categories</td>
                <td colspan="1">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($subs as $sub)
                <tr>
                    <td>{{$sub->id}}</td>
                    <td>{{$sub->name}}</td>
                    <td>{{$categories[$sub->id]}}</td>
                    <td><a href="/subscription/{{$sub->id}}" class="btn btn-primary">Show</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
     </div>
@endsection
