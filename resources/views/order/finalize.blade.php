@extends('app')

@section('content')

<div class="col-md-offset-1 col-md-10">
<div class="panel panel-default">
<div class="panel-body">

    @if(empty($order))
        <p>Your Basket is empty.</p>
    @else
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-body">--}}
    <table class="table">
        <thead>
            <th>Product</th><th>Count</th><th>Price</th><th>Total Price</th>
        </thead>
        <tbody>
        @foreach($order->products as $product)
            <tr>
                <td>
                    <b>{{ $product->name }}</b>
                </td>
                <td>
                    <b>{{ $product->pivot->quantity }}</b>
                </td>
                <td>
                    <b>{{ $product->price }}</b>
                </td>
                <td>
                    <b>{{ $product->pivot->total_price }}</b>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr/>

    <div class="row">
    <div class="col-md-3">
        <a href="{{ url('/basket') }}"><button class="btn btn-default">Edit Order</button></a>
    </div>
    <div class="col-md-4 col-md-offset-5">
        <p><b>Total Price: </b>{{ $total }}</p>
        {{--{{ $order->getOrderTotalPrice }}--}}
    </div>
    </div>

    {{--</div>--}}
    {{--</div>--}}
    <br/><br/>

    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-body">--}}
    {!! Form::open(['role' => 'form', 'action' => 'OrderController@finalizePurchase']) !!}

        <div class="form-group">
        {!! Form::label('ship_address', 'Ship Address:', ['class' => 'control-label']) !!}
        {!! Form::Text('ship_address', null, ['class' => 'form-control', 'id' => 'ship_address']) !!}
        </div>

        {!! Form::submit('submit', ['class' => 'btn btn-primary']) !!}

    {!! Form::close()!!}
    {{--</div>--}}
    {{--</div>--}}
    @endif


</div>
</div>
</div>

@stop