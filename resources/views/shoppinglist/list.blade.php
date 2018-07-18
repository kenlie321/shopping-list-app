@extends('shoppinglist.template.app')

@section('content')
    <h1>My Shopping List</h1>
    @if(count($lists) > 0)
        <table class="table">
            <thead>
                <tr>
                    <td>Shopping Lists</td>
                    <td>Created On</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $list)
                    <tr>
                        <td><a href="/lists/{{$list->list_id}}">{{$list -> name}}</a></td>
                        <td>{{$list -> created_at}}</td>
                        <td><a href="/lists/{{$list->list_id}}/edit" class="btn btn-info">Edit</a></td>
                        <td>{{$list->user->name}}</td>
                        <td>
                        {!! Form::open(['url' => '/lists/'.$list->list_id, 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        </td>
                    </tr>
                    {{-- {{$lists->links()}} --}}
                @endforeach
            </tbody>
        </table>
    @else
        <h3>You Have no Shopping Lists</h3>
    @endif
    <a href="/lists/create" class="btn btn-primary">Add List</a>
@endsection