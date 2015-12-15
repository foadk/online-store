<div class="form-group @if($errors->get('name')) alert alert-danger @endif">
    {!! Form::label('name', 'Product Name:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
</div>

<div class="form-group @if($errors->get('price')) alert alert-danger @endif">
    {!! Form::label('price', 'Price:', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'price']) !!}
</div>

<div class="form-group">
    {!! Form::label('stock', 'Stock:', ['class' => 'control-label']) !!}
    {!! Form::text('stock', null, ['class' => 'form-control', 'id' => 'stock']) !!}
</div>

<div class="form-group @if($errors->get('description')) alert alert-danger @endif">
    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description']) !!}
</div>

<div class="form-group @if($errors->get('category_id')) alert alert-danger @endif">
    {!! Form::label('category_id', 'Category:', ['class' => 'control-label']) !!}
    {!! Form::select('category_id', $categories, null, ['id' => 'category_id', 'class' => 'form-control']) !!}
</div>

 <div class="form-group @if($errors->get('image')) alert alert-danger @endif">
    {!! Form::label('image', 'Image File:', ['class' => 'control-label']) !!}
    <br/>
    {!! Form::file('image', ['title' => 'Browse...']) !!}
</div>

@include('...errors._product_form_errors')

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}