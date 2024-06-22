<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Stripe\Climate\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $productItems = [];
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        foreach(session('cart') as $datalist){
            // $id = $datalist['id'];
            $email = auth()->user()->email;
            $product_name= $datalist['description'];
            $total = $datalist['price'];
            $quantity = $datalist['qunantity'];
            $two0 ='00';
            $unit_amount ="$total$two0";

            $productItems[]=
            [
                'price_data'=>
                [
                    'product_data'=>
                    [
                        'name'=>$product_name,
                        // 'id'  =>$product_id,
                    ],
                    'currency'=>'USD',
                    'unit_amount' =>$unit_amount,
                ],
                'quantity' => $quantity
            ];
        }
        // dd($productItems);
        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items'  => [$productItems],
            'mode'       => 'payment',
            'allow_promotion_codes'      => true,
            'metadata'   =>[
                'user_id' =>'0001'
            ],
            'customer_email' => "$email",
            'success_url' => route('success'),
            'cancel_url'=> route('cancel'),
        ]);
        return redirect()->away($checkoutSession->url);
        // return view('User.payment');
    }


    public function success(){
        return ('your checkout is successfly');
        // $cartData = session('cart');
        // if($cartData){
        //     foreach($cartData as $product =>$cartItem){
        //         $user_id = auth()->user()->id;
        //         $product_id = $cartItem['id'];

        //         $order = new Order ;
                
        //         $order->user_id = $user_id;
        //         $order->product_id = $product_id;

        //         $order->save();
        //     }
        // }
        
        // return redirect('dashboard')->with('checkout','your order id saved');
    }


    public function cancel(){
        return "cancel";
    }
}

