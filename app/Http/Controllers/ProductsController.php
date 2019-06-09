<?php

namespace App\Http\Controllers;

use App\Product as Product;
use App\CarBrand as CarBrand;
use App\CarModel as CarModel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $products = Product::all();

      return view('products.index', compact('products'));
    }

    public function create()
    {
      $brands = CarBrand::all();
      $models = CarModel::all();
      return view('products.create', compact('brands', 'models'));
    }

    public function store(Request $request)
    {
      // $version = new CarVersion;
      // $version->description = $request->version;
      // $version->id_model = $request->id_model;
      // $version->save();
      // $request['id_version'] = $version->id;
      $request['original'] = $request->original ? 1 : 0;
      $request['category_id'] = 0;

      Product::create(request()->validate([
        'user_id' => ['required'],
        'model_id' => ['required'],
        'category_id' => ['required'],
        'original' => ['required'],
        'title' => ['required', 'min:3'],
        'description' => ['required', 'min:3'],
        'stock' => ['required', 'min:0'],
        'price' => ['required', 'min:0'],
        'photo' => ['required']
      ]));

      return redirect('/products');
    }

    public function show(Product $product)
    {
      $brands = CarBrand::all();
      $models = CarModel::all();

      return view('products.show', compact('product', 'brands', 'models'));
    }

    public function edit(Product $product)
    {
      $brands = CarBrand::all();
      $models = CarModel::all();

      return view('products.edit', compact('product', 'brands', 'models'));
    }

    public function update(Product $product)
    {
      $product->update(request(['model_id', 'title', 'description', 'stock', 'price', 'original', 'photo']));

      return redirect('/products');
    }

    public function destroy(Product $product)
    {
      $product->delete();

      return redirect('/products');
    }
}
