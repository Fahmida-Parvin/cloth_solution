@extends('layouts.master')
@section('name', 'Home Page')
@section('content')
<main class="homepage">

    @include('pages.components.home.header')

        <section class="products-section">
            <div class="container">
                <h1 class="section-title">Featured Products</h1>
                <div class="products-row">

                    @foreach ($products as $product)
                    <x-product-box :product="$product" />
                    @endforeach
                    
                </div>
            </div>
        </section>

        <section class="banner-section">
            <div class="container">
                <div class="banner-content">
                    <h2 class="banner-title">Summer Sale</h2>
                    <p class="banner-description">Up to 50% off on selected items</p>
                    <a href="#" class="btn btn-primary banner-button">Shop Now</a>
                </div>
            </div>
        </section>

</main>
@endsection