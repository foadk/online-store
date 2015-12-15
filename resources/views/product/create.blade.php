@extends('app')

@section('content')

<div class="col-md-offset-1 col-md-10">

<div class="panel panel-default">
<div class="panel-body">

    <div class="col-md-12">
        <h1>New Product</h1>
        <hr/><br/>

        {!! Form::open(['role' =>'form', 'action' => 'ProductController@store', 'enctype' => 'multipart/form-data']) !!}

            @include('product._form', ['submitButtonText' => 'Create Product'])

        {!! Form::close() !!}

    </div>

</div>
</div>
</div>
@stop