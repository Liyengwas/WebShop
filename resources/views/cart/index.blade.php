@extends('layouts.app')

@section('content')

    <h2 class="text-center">Your Cart Items</h2>

    <br>

    <div class="row offset-1 col-10 offset-1">
        <table class="table table-stripped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Product </th>
                    <th>Price</th>
                    <th class="text-center">Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($cartItems as $item)
                <tr>
                    <td scope="row"> {{ $item->name }} </td>
                    <td>
                        {{ $item->price }}
                    </td>
                    <td class="container">
                        <form action=" {{route('cart.update', $item->id) }}  " class="row">
                            <input type="number" class="form-control  offset-1 col-4 offset-1" value="{{ $item->quantity }}" name="quantity">
                            <input type="submit" class="btn btn-outline-dark offset-1 col-4 offset-1" value="Update Quantity">
                        </form>
                    </td>
                    <td>
                        {{ Cart::session(auth()->id())->get($item->id)->getPriceSum() }}
                    </td>
                    <td>

                        <a href=" {{ route('cart.destroy', $item->id) }} " class="btn btn-outline-danger"> <span><i class="fas fa-trash-alt"></i>Delete </span> </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <br>

    <div class="container offset-4 col-4 offset-4 text-center">
        <div class="card">
            <div class="card-header ">
                <h2 class="text-info">Cart Summary</h2>
            </div>
            <div class="card-body">
                <h3>Total Price
                    <br>
                    Kes: {{ \Cart::session(auth()->id())->getTotal() }}
                </h3>
            </div>
            <div class="card-footer">
                <a href="#"><button class="btn btn-outline-success"> Checkout</button> </a>
            </div>
        </div>
    </div>

@endsection
