@extends('layouts.app')

@section('content')

<div class="container text-center">

    <div class="row">

        @foreach ($AllProducts as $product)
            <div class="col-4">
                <div class="card" style="margin: 5px; padding: 5px;">

                    <img class="card-img-top" src="{{ asset('default-product-image.jpg') }}" alt="Card image cap">

                        <div class="card-body">
                        <h4 class="card-title"> {{ $product->name }} </h4>
                        <p class="card-text"> {{ $product->description }} </p>
                        </div>

                        <div class="card-footer">
                            <a href=" {{ route('cart.add', $product->id) }} " class="btn btn-outline-success card-link">Add to Cart</a>
                        </div>
                </div>
            </div>
        @endforeach

    </div>

</div>

@endsection
