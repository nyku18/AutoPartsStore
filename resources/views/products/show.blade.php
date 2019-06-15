@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-secondary text-white">Product details</div>

          <div class="card-body">

            @if($product->photo)
              <div class="form-group">
                <img src="{{ url('uploads/products') . '/' . $product->photo }}?v={{ time() }}" alt="Product photo">
              </div>
            @endif

            <div class="form-group">
              <label class="label font-weight-bold" for="title">Title</label>

              <div class="control">
                <p class="input form-control">{{ $product->title}}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="description">Description</label>

              <div class="control">
                <p class="textarea form-control">{{ $product->description}}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="brand">Brand</label>

              <div class="control">
                <p class="input form-control">{{ $product->model->brand->name }}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="model">Model</label>

              <div class="control">
                <p class="input form-control">{{ $product->model->name }}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="category">Category</label>

              <div class="control">
                <p class="input form-control">{{ $product->category->title }}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="title">Stock</label>

              <div class="control">
                <p class="input form-control">{{ $product->stock }}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="title">Price</label>

              <div class="control">
                <p class="input form-control">€{{ $product->price }}</p>
              </div>
            </div>

            <div class="form-group">
                  <p class="checkbox">{{ $product->original ? 'Original' : 'Unoriginal' }}</p>
            </div>

            @if(Auth::user()->id == $product->user_id)
              <div class="form-group">
                <div class="control">
                  <a href="{{ route('products.edit', ['product' => $product]) }}" class="btn btn-primary button is-link">
                    Settings
                  </a>
                </div>
              </div>

            @else
              <div class="form-group">
                <div class="control">
                  <a href="{{ route('cart.add', ['product' => $product]) }}" class="btn btn-primary button is-link">
                    Add to cart
                  </a>
                </div>
              </div>
            @endif

            <div class="card-body">
              <form method="POST" action="{{ route('comments.store') }}">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="form-group">
                  <label class="label font-weight-bold" for="description">Comments</label>

                  <div class="control">
                    <textarea name="comment" class="textarea form-control" placeholder="Comment" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="control">
                    <button type="submit" class="btn btn-primary button is-link">Add comment</button>
                  </div>
                </div>

                @include ('errors')
              </form>

              @if($product->comments)
                @foreach($product->comments as $comment)
                  <div class="control">
                    <p>{{ $comment->user->name }}</p>
                    <p class="input form-control">{{ $comment->comment }}</p>
                  </div>
                @endforeach
              @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
