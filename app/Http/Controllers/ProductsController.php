<?php

namespace App\Http\Controllers;

use App\Product as Product;
use App\CarBrand as CarBrand;
use App\CarModel as CarModel;
use App\Category as Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $products = Auth::user()->products;

      return view('products.index', compact('products'));
    }

    public function create()
    {
      $brands = CarBrand::all();
      $models = CarModel::all();
      $categories = Category::all();
      return view('products.create', compact('brands', 'models', 'categories'));
    }

    public function store(Request $request)
    {
       if ( $request->file('product_photo') ) {
            $file = $request->file('product_photo');
            $image_extension = $file->getClientOriginalExtension();
            $image_name = 'placeholder.jpg';

            $request['photo'] = $image_name;
            $request['original'] = $request->original ? 1 : 0;

            $product = Product::create(request()->validate([
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

            $image_name = $product->id . '.' . $image_extension;
            $path = public_path( 'uploads/products/' );
            File::makeDirectory( $path, 0775, true, true );

            $image = Image::make( $request->file('product_photo'));

            $image->resize(350, 220)->save( $path .'/'.$image_name );

            $product['photo'] = $image_name;
            $product->save();
          }

      return redirect('/products');
    }

    public function show(Product $product)
    {
      $brands = CarBrand::all();
      $models = CarModel::all();
      $categories = Category::all();

      return view('products.show', compact('product', 'brands', 'models', 'categories'));
    }

    public function edit(Product $product)
    {
      $brands = CarBrand::all();
      $models = CarModel::all();
      $categories = Category::all();

      return view('products.edit', compact('product', 'brands', 'models', 'categories'));
    }

    public function update(Product $product, Request $request)
    {
      if ( $request->file('product_photo') ) {
           $file = $request->file('product_photo');
           $image_extension = $file->getClientOriginalExtension();
           $image_name = $product->id . '.' . $image_extension;

           $path = public_path( 'uploads/products/' );
           File::makeDirectory( $path, 0775, true, true );

           $image = Image::make( $request->file('product_photo'));

           $image->resize(350, 220)->save( $path .'/'.$image_name );

           $request['original'] = $request->original ? 1 : 0;
           $request['photo'] = $image_name;
           $product->update(request(['model_id', 'title', 'description', 'stock', 'price', 'original', 'photo']));

      }
      return redirect('/products');
    }

    public function destroy(Product $product)
    {
      $product->delete();

      return redirect('/products');
    }
}
