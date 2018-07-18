@extends('shoppinglist.template.app')

@section('content')
    <form action="/lists/{{$id}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="item">Item Name</label>
            <input type="text" name='item' placeholder="Item Name" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name='price' placeholder="Price" class="form-control">
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-success">
    </form>
@endsection