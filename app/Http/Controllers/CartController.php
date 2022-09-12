<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $cart = session()->get('cart', []);

        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;

        } else {

            $cart[$request->id] = [

                "id" => $product->id,
                "name" => $product->title,
                "quantity" => 1,
                "price" => $product->price,
                "photo" => $product->photo->path
            ];
        }

        session()->put('cart', $cart);

        //session()->forget('cart');

        $cart_number = count($cart);


        $alert = view('layouts.store.components.alert')->with('alert_success', 'Продуктът е добавен в количката!')->render();
        $cart = view('layouts.store.components.cart')->render();

        return response()->json(['alert' => $alert, 'cart' => $cart]);
        

    }

    public function clearCart()
    {
        session()->forget('cart');

        return redirect(route('cart'))->with('alert_success', 'Количката е изчистена!');
    }
    public function clearCartElement($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect(route('cart'))->with('alert_success', 'Продуктът е премахнат от количката!');
    }
    public function updateCart(Request $request)
    {
        $total = 0;
        
        for($i = 0; $i < count($request->id); $i++){
            $cart = session()->get('cart');
            $cart[$request->id[$i]]["quantity"] = $request->quantity[$i];
            session()->put('cart', $cart);
            
        }
        foreach(session()->get('cart') as $product){
            $total += $product['price'] * $product['quantity'];
        }


        return view('pages.cart.index', compact('total'))->with('alert_success', 'Количката е обновена успешно!');
    }
    public function displayCart(){

        $total = 0;

        if(!session()->get('cart')){
            return view('pages.cart.index', compact('total'));
        }
       

        foreach(session()->get('cart') as $product){
            $total += $product['price'] * $product['quantity'];
        }

        return view('pages.cart.index', compact('total'));
    }

    public function checkout(){

        $total = 0;

        foreach(session()->get('cart') as $product){
            $total += $product['price'] * $product['quantity'];
        }

        return view('pages.cart.checkout', compact('total'));
    }
}
