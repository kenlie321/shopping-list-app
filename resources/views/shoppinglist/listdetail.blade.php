@extends('shoppinglist.template.app')

@section('content')
    <a href="/lists"><- Go Back</a><br>
    {{-- <pre>{{die(var_dump('/lists/'.$id.'/edit_item/'))}}</pre> --}}
    <img src="/storage/cover/{{$cover}}" alt="cover">
    <h3>{{$title}}</h3>
        <hr>
        @if($list[0]->item !== NULL)
        <table class="table">
            <thead>
                <tr>
                    <td>Item</td>
                    <td>Price</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $test)
                <tr>
                    <td>{{$test->item}}</td>
                    <td>${{$test->price}}.00</td>
                    <td><a href="/lists/{{$id}}/edit_item/{{$test->item_id}}" class="btn btn-info">Edit</a></td>
                    <td>
                    {!! Form::open(['url'=>'/lists/'.$id.'/'.$test->item_id, 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td><strong>Total</strong></td>
                    <td>${{$list->sum('price')}}.00</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @else
        <h3>No Items Yet!</h3>
    @endif
    <a href="/lists/{{$id}}/add_item" class="btn btn-primary">Add Items</a>
@endsection