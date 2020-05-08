@extends('layouts.app')

@section('content')

    <h2 class="text-center">Your Cart Items</h2>

    <br>

    <div class="row">
        <div class="row col-8">
            <table class="table table-stripped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Product </th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Action</th>
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
                                <button type="submit" class="btn btn-outline-success offset-1 col-4 offset-1"><i class="far fa-edit"></i> Update</button>
                                {{-- <input type="submit" class="btn btn-outline-dark offset-1 col-4 offset-1" value="Update Quantity"> --}}
                            </form>
                        </td>
                        <td>
                            {{ Cart::session(auth()->id())->get($item->id)->getPriceSum() }}
                        </td>
                        <td>

                            <a href=" {{ route('cart.destroy', $item->id) }} " class="btn btn-outline-danger"> <span><i class="fas fa-trash-alt"></i> Delete</span> </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <br>
        <div class="container col-4  text-center">
            <div class="card">
                <div class="card-header ">
                    <h2 class="text-info">Summary</h2>
                </div>
                <div class="card-body">
                    <h3>Total Price
                        <br>
                        Kes: {{ \Cart::session(auth()->id())->getTotal() }}
                    </h3>
                </div>
                <div class="card-footer">
                    <a href="#"><button class="btn btn-outline-success"><i class="fas fa-money-check-alt"></i> Proceed to Checkout</button> </a>
                </div>
            </div>
        </div>
    </div>

@endsection
