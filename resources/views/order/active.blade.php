@extends('app')

@section('content')

<div class="col-md-offset-1 col-md-10 content">
<div class="panel panel-default">
<div class="panel-body">

    @if(empty($order))
        <p>Your basket is empty.</p>
    @else
    {!! Form::open(['role' => 'form', 'id' => 'basket-form', 'action' => 'OrderController@finalizeOrder']) !!}
    <div class="panel panel-default">
    <div class="panel-body">
    <table class="table">
        <thead>
            <th>Product</th><th>Price</th><th>Count</th><th>Total Price</th><th>delete</th>
        </thead>
        <tbody>
        @foreach($order->products as $product)
            <tr @if($errors->get("quantity.$product->id")) class="alert alert-danger" @endif>
                <td>
                    <b>{{ $product->name }}</b>
                    @if($errors->get("quantity.$product->id"))
                        <p>{{ $errors->get("quantity.$product->id")[0] }}</p>
                    @endif
                </td>
                <td>
                    {{ $product->price }}
                </td>
                <td>
                    <div class="row">
                    <div class="col-md-8">
                        {!! Form::select("quantity[$product->id]", array_combine(range(1, 10), range(1, 10)),
                                $product->pivot->quantity, ['class' => 'form-control', 'onchange' => 'change()']) !!}
                    </div>
                    </div>
                </td>
                <td>
                    {{ $product->pivot->total_price }}
                </td>
                <td>
                    {{--<a href="{{ url('/orders_products/' . $product->id . '/delete') }}">--}}
                    <a href="{{ action("OrderController@removeProduct", [$product->id]) }}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-8">
            <p><b>Total Price: </b>{{ $total }}</p>
            {{--{{ $order->getOrderTotalPrice }}--}}
        </div>
    </div>
    {{--{!! Form::submit('Finalize Your Purchase!', ['class' => 'btn btn-primary']) !!}--}}
    {!! Form::close() !!}
    {{--<a href="{{ action('OrderController@showFinalize') }}">--}}
        {{--<button class="btn btn-primary">Finalize Your Purchase!</button>--}}
    {{--</a>--}}

    {!! Form::open(['role' => 'form', 'action' => 'OrderController@finalizePurchase']) !!}

        <div class="row">
        <div class="col-md-11">
        <div class="form-group">
        {!! Form::label('ship_address', 'Ship Address:', ['class' => 'control-label']) !!}
        {!! Form::Text('ship_address', null, ['class' => 'form-control', 'id' => 'ship_address']) !!}
        </div>

        {!! Form::submit('Finalize Your Purchase!', ['class' => 'btn btn-primary']) !!}
        </div>
        </div>

    {!! Form::close()!!}

    @endif

</div>
</div>
</div>

<script src="/js/quantity-select.js"></script>

@stop