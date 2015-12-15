<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\StockManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Http\Requests\FinalizeOrderRequest;

class OrderController extends Controller
{
    protected $stockManager;

    public function __construct(StockManager $stockManager)
    {
        $this->middleware('auth');

        $this->stockManager = $stockManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [$request->input('product_id') => 'minOneProduct']);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $user = Auth::user();
        $order = null;
        if($user->hasActiveOrder()) {
            $order = $user->getActiveOrder();
            if($order->hasProduct($request->input('product_id')))
                return redirect()->action('OrderController@showActive');
        }
        else {
            $order = $user->orders()->create(array());
        }

        $total_price = Product::findOrFail($request->input('product_id'))->price;
        $order->products()->attach($request->input('product_id'), ['total_price' => $total_price]);
        $this->stockManager->updateStock($request->input('product_id'), 1);

        return redirect()->action('OrderController@showActive');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show user's Basket.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showActive()
    {
        $user = Auth::user();
        $order = $user->getActiveOrder();
        if(!empty($order)) {
            $total = $order->getOrderTotalPrice();
        }
        return view('order.active', compact('order', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified product from order.
     *
     * @param $product_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProduct($product_id)
    {
        $user = Auth::user();
        $order = $user->getActiveOrder();
        $this->stockManager->updateDifference($product_id, 0);
        $order->products()->detach($product_id);
        if($order->isEmpty()) {
            $order->delete();
            return redirect('home');
        }
        return redirect()->action('OrderController@showActive');
    }

    /**
     *
     *
     * @param FinalizeOrderRequest|Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finalizeOrder(FinalizeOrderRequest $request)
    {
        $order = Auth::user()->getActiveOrder();
        foreach($order->products as $product) {
            $this->stockManager->updateDifference($product->id, $request->input('quantity')[$product->id]);
            $quantity = $request->input('quantity')[$product->id];
            $order->products()->updateExistingPivot($product->id, ['quantity' => $quantity]);
            $order->products()->updateExistingPivot($product->id, ['total_price' => $quantity * $product->price]);
        }
        return redirect()->action('OrderController@showActive');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finalizePurchase(Request $request)
    {
        Auth::user()->getActiveOrder()->update([
            'ship_address' => $request->input('ship_address'),
            'shipped' => true,
            'paid' => true
        ]);
        return redirect()->action('CategoryController@show', [1]);
    }
}
