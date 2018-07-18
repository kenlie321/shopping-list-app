@extends('shoppinglist.template.app')

@section('content')
    <h3>Edit List</h3>
    @foreach($items as $item)
    {!! Form::open(['url' => "/lists/".$id."/".$item->item_id, 'method' => 'PUT']) !!}        
    @csrf
        
        <div class="form-group">
            {{Form::label('item','Item Name')}}
            {{Form::text('item',$item->item,['id' => "item", 'class' => "form-control"])}}
        </div>
        <div class="form-group">
            {{Form::label('price','Price')}}
            {{Form::number('price',$item->price, ['id' => "price", 'class' => "form-control"])}}
        </div>
        <input type="submit" value="Submit Changes" class="btn btn-success">
    {!! Form::close() !!}
    @endforeach
@endsection