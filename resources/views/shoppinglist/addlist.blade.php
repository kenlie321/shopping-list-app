@extends('shoppinglist.template.app')

@section('content')
    <h3>Add List</h3>
    <form action="/lists" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">List Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control">
        </div>
        <div class="form-group">
            <input type="file" name="cover" id="cover">
        </div>
        <input type="submit" value="Submit" class="btn btn-success">
    </form>
@endsection