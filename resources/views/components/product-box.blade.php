<section class="product-box">
    <div class="image">
        <img src="{{ asset('storage/' . $product->image) }}" alt="">

        @auth
        @if (auth()->user()->wishlist->contains($product))
        <form action="{{ route('removeFromWishlist', $product->id) }}" method="post">
            @csrf
            <button class="add-to-wishlist" type="submit">Remove from wishlist</button>
        </form>

        @else
        <form action="{{ route('addToWishlist',$product->id) }}" method="post">
            @csrf
            <button class="add-to-wishlist" type="submit">Add to wishlist</button>
        </form>
        @endif
        @endauth
    </div>
    <a href="{{route('product',$product->id)}}">

        <div class="product-title">{{$product->title}}</div>
        <div class="color-prop">
            @foreach ($product->colors as $color)
            <div class="color-props" style="background:{{$color->code}}"></div>
            @endforeach
        </div>
        <div class="product-category">{{$product->category->name}}</div>
        <div class="product-price">${{$product->price/100}}.00</div>
    </a>
</section>