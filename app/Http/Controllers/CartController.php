<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //Add Product to cart Method
    public function addProduct(Product $product){

        // dd($product);

        // add the product to cart
            //import cart from global namespace
        \Cart::session(auth()->id())->add(array(
            'id' => $product->id ,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return redirect()->route('cart.index');
    }

    //View Cart Items method
    public function index(){

        $cartItems = \Cart::session(auth()->id())->getContent();

        return view('cart.index', compact('cartItems'));

    }

    //Destroy Cart Items method
    public function destroy($itemId){

         \Cart::session(auth()->id())->remove($itemId);

        return back();

    }

    public function update($rowId){
        // update the item on cart
        \Cart::session(auth()->id())->update($rowId,[
            'quantity' => array(
                'relative' => false,
                'value' => request('quantity')
            ),
        ]);

        return back();
    }

    public function checkOut(){

        return view('cart.checkout');
    }
}
