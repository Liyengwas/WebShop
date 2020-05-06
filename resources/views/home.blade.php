@extends('layouts.app')

@section('content')

<div class="container text-center">

    <div class="row">

        @foreach ($AllProducts as $product)
            <div class="card col-4">

                <img class="card-img-top" src="{{ asset('default-product-image.jpg') }}" alt="Card image cap" style="margin: 5px; padding: 3px;">

                    <div class="card-body">
                    <h4 class="card-title"> {{ $product->name }} </h4>
                    <p class="card-text"> {{ $product->description }} </p>
                    </div>

                    <div class="card-footer">
                        <a href="#" class="btn btn-outline-success card-link">Add to Cart</a>
                    </div>
            </div>
        @endforeach

    </div>

</div>

@endsection
