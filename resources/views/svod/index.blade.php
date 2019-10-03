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
                <td>Title</td>
                <td>Category</td>
                <td colspan="1">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($svods as $svod)
                <tr>
                    <td>{{$svod->id}}</td>
                    <td>{{$svod->title}}</td>
                    <td>{{$categories[$svod->id]}}</td>
                    <td><a href="/svod/{{$svod->id}}" class="btn btn-primary">Show</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <td><a href="/svod/create" class="btn btn-primary">Add</a></td>
     </div>
@endsection
