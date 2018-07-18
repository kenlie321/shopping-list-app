@extends('shoppinglist.template.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Hello, {{Auth::user()->name}}</h3>
                    <h4>You Have {{count($list)}} Shopping Lists</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
