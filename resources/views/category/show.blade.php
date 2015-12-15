@extends('app')

@section('content')

    <div class="col-md-offset-1 col-md-10 content">

        @foreach($products->chunk(4) as $chunk)
            <div class="row text-center">
            @foreach($chunk as $product)
                @include('partials._product')
            @endforeach
            </div>
        @endforeach

    </div>

@stop

@section('pagination')

    {!! $products->render() !!}

@stop