@extends('app')

@section('content')

    <div class="col-md-offset-1 col-md-10 content">
        @foreach($productList as $products)
            <div class="row text-center">
                @foreach($products as $product)
                    @include('partials._product')
                @endforeach
            </div>
        @endforeach
    </div>

@stop