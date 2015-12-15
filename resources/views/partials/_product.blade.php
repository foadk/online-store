<div class="col-md-3 col-sm-6 item-row">
    <div class="thumbnail item">
        <img src="{{ $product->thumbnail }}" alt="">
        <div class="caption">
            <p><b>{{ $product->name }}</b></p>
            <p>{{ $product->description }}</p>
            <p>
                {!! Form::open(['role' => 'form', 'action' => 'OrderController@store']) !!}
                    {!! Form::hidden('product_id', $product->id) !!}
                    {!! Form::hidden($product->id, 1) !!}
                    {!! Form::submit('Add To Basket!', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
                <a href="#" class="btn btn-default">More Info</a>
            </p>
        </div>
    </div>
</div>