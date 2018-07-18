@extends('shoppinglist.template.app')

@section('content')
    <div class="jumbotron text-center" style="background:url(pinkdots.png)">
        <h1>{{$title}}</h1>
        <div>
            <a href="/login" class="btn btn-success">Login</a> <a href="register" class="btn btn-primary">Register</a>
        </div>
    </div>
@endsection