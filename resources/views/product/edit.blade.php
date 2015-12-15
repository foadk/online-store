@extends('app')

@section('content')

<div class="col-md-offset-1 col-md-10">

<div class="panel panel-default">
<div class="panel-body">

    <div class="col-md-12">
        <h1>Edit Product</h1>
        <hr/><br/>

        {!! Form::model($product, ['method' => 'patch', 'role' => 'form', 'enctype' => 'multipart/form-data', 'action' => ['ProductController@update', $product->id]]) !!}

            @include('product._form', ['submitButtonText' => 'Update Product'])

        {!! Form::close() !!}

    </div>
</div>
</div>
</div>

@stop