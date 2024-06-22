<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(){
        return view('User.card');
    }

    public function store($id){
        $product = product::findOrFail($id);
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            $cart[$id]['qunantity'] ++ ;  
        }
        else{
            $cart[$id]=[
                "id"         =>$product->id,
                "type"       => $product->type ,
                "price"      => $product->price,
                "description"=>$product->description,
                'photo'      => $product->photo,
                "qunantity"  => 1
            ];
        }
        session()->put('cart',$cart);
        return redirect()->back()->with('add_successfully','product add to cart successfully');
    }

    public function delete($itemId)
    {
    $items = session()->get('cart');
    // Check if the item exists in the session array
    if (!array_key_exists($itemId, $items)) {
        return redirect()->back(); // Handle case where item doesn't exist in session
    }

    // Remove the item using `unset`
    unset($items[$itemId]);
    session()->put('cart', $items);

    return redirect()->back()->with('success', 'Item removed from session successfully!'); // Optional success message
}
    
}
