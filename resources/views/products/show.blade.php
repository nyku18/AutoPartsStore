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
                <p>{{ $product->title}}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="description">Description</label>

              <div class="control">
                <p>{{ $product->description}}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="brand">Brand</label>

              <div class="control">
                <p>{{ $product->model->brand->name }}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="model">Model</label>

              <div class="control">
                <p>{{ $product->model->name }}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="category">Category</label>

              <div class="control">
                <p>{{ $product->category->title }}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="title">Stock</label>

              <div class="control">
                <p>{{ $product->stock }}</p>
              </div>
            </div>

            <div class="form-group">
              <label class="label font-weight-bold" for="title">Price</label>

              <div class="control">
                <p>€{{ $product->price }}</p>
              </div>
            </div>

            <div class="form-group">
                  <p>{{ $product->original ? 'Original' : 'Unoriginal' }}</p>
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
          </div>
        </div>

        @if(Auth::user()->id != $product->user_id)
          <div class="card reviews my-4">
            <div class="card-header bg-secondary text-white">Reviews</div>
            <div class="card-body">
              @if(!$product->reviews->isEmpty())
                <div class="rating">
                  @php
                    $average=0;
                  @endphp

                  @foreach ($product->reviews as $review)
                    @php
                      $average+=$review->review;
                    @endphp
                  @endforeach

                  @php
                    $average/=$product->reviews->count();
                  @endphp

                  <h3>Rating - <span class="small">average is {{ number_format($average, 2, '.', ',') }}</span></h3>

                  <div class="rating-stars">
                    @for($i=1; $i <= 5; $i++)
                      <span class="display-4 fa fa-star {{ ($i <= $average) ? 'text-warning' : 'text-dark' }}"></span>
                    @endfor
                  </div>
                </div>
              @else
                <h3>There are no reviews yet!</h3>
              @endif

              <form method="POST" action="{{ route('reviews.store') }}" class="mt-3">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="form-group">
                  <div class="control">
                    <select class="input form-control" name="review" required>
                      @for ($i = 1; $i <= 5; $i++)
                        <option>{{ $i }}</option>
                      @endfor
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="control">
                    <button type="submit" class="btn btn-success button is-link">Add review</button>
                  </div>
                </div>
              </form>
              @include ('errors')

                {{--
                @if($product->reviews)
                  @foreach($product->reviews as $review)
                    <div class="comments-content my-3">
                      <span class="font-weight-bold">{{ $review->user->name }}:</span>
                      <span>{{ $review->review }}</span>
                    </div>
                  @endforeach
                @endif
                --}}

              </div>
            </div>

          <div class="card comments my-4">
            <div class="card-header bg-secondary text-white">Comments</div>
            <div class="card-body">
              <form method="POST" action="{{ route('comments.store') }}">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="form-group">
                  <div class="control">
                    <textarea name="comment" class="textarea form-control" placeholder="Comment" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="control">
                    <button type="submit" class="btn btn-success button is-link">Add comment</button>
                  </div>
                </div>

                @include ('errors')
              </form>

              @if($product->comments)
                @foreach($product->comments as $comment)
                  <div class="comments-content d-flex flex-column my-3">
                    <div class="font-weight-bold">{{ $comment->user->name }}:</div>
                    <div>{{ $comment->comment }}</div>
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
