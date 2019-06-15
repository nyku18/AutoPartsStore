<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
      $session_id = session()->get( '_token' );
      $cart = Cart::where( 'session_id', '=', $session_id )->first();

      if ( $cart )
      {
        if ( !$cart->products->isEmpty())
        {
          $order = Order::create([
            'user_id' => Auth::user()->id,
            'status' => 'in progress'
          ]);
          foreach ($cart->products as $product)
          {
            $order->products()->attach($product, array(
              'amount' => $product->pivot->amount,
              'product_price' => $product->price
            ) );

            $cart->products()->detach($product->id);
          }

          $cart->delete();
        }
      }

      return redirect()->route('orders.index');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
