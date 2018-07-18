@extends('shoppinglist.template.app')

@section('content')
    <h3>Edit List</h3>
{{-- <pre>{{var_dump()}}</pre> --}}
    {!! Form::open(['url' => "/lists/".$list->list_id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}        
    @csrf
        <div class="form-group">
            {{Form::label('name','Name')}}
            {{Form::text('name',$list->name,['id' => "name", 'class' => "form-control"])}}
        </div>
        <div class="form-group">
            {{Form::label('description','Description')}}
            {{Form::text('description', $list->description, ['id' => "description", 'class' => "form-control"])}}
        </div>
        <div class="form-group">
            <input type="file" name="cover" id="cover">
        </div>
        <input type="submit" value="Submit Changes" class="btn btn-success">
    {!! Form::close() !!}
@endsection