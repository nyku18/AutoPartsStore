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
}
