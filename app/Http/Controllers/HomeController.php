<?php

namespace App\Http\Controllers;

use App\Product as Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');

        $products = Product::all();
        return view('home', compact('products'));
    }

    public function welcome()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    public function search(Request $request) {
        if($request->search_word) {
            $products = Product::where('title', 'LIKE', '%' . $request->search_word . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search_word . '%')->get();

            if($products->isEmpty()) {
                // no products found with search criteria
                return redirect()->route('welcome')->with('search_message', 'No products found.');
            }
            else {
                // products found with search criteria
                return view('welcome', compact('products'));
            }
        }

        // empty search word
        return redirect()->route('welcome');
    }
}
