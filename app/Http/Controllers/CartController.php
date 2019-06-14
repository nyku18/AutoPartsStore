<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $session_id = session()->get( '_token' );

      $cart = Cart::where( 'session_id', '=', $session_id )->first();

      $products = [];
      if ( $cart )
      {
        $products = $cart->products;
      }

      return view('cart.show', compact('products', 'cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function add(Product $product)
    {
      // print_r($product);
      // //print_r($request->all());
      // die('---');

      $product = Product::where( 'id', $product->id )->first();
      if ( $product == null )
      {
        return abort( 404 );
      }

      $session_id = session()->get( '_token' );

      $cart = Cart::where( 'session_id', '=', $session_id )->first();

      if ( $cart )
      {
        // product is already in cart
        if ( $cart->products->contains($product) )
        {
          //increase amount
          $amount = $cart->products()->findOrFail($product->id, ['amount'])->pivot->amount;
          $cart->products()->updateExistingPivot($product->id, ['amount' => $amount + 1]);
        }
        else
        {
          //add product
          $cart->products()->attach($product, array("amount" => 1) );
        }
      }
      else
      {
          $cart = Cart::create([
            'user_id' => Auth::user()->id,
            'session_id' => $session_id
          ]);

          $cart->products()->attach($product, array("amount" => 1) );
      }

      return redirect()->route('cart.show');

    }
}
