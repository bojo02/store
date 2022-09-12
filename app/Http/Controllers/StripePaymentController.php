<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Illuminate\Support\Facades\Mail;


$email = '';
   

class StripePaymentController extends Controller
{
       /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripe()

    {

        return view('stripe');

    }

  

    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripePost(Request $request)

    {
      

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "EUR",
                "source" => $request->stripeToken,
                "description" => $request->email . ' / ' . $request->firstname . ' ' . $request->lastname . ' / ' . $request->phone,
        ]);

        //return $charge->payment_method_details->card->last4;

        if($charge['status'] == 'succeeded') {

            $order = Order::create([
                'total' => $request->amount,
                'payment_id' =>'1',
                'delivery_id' => '1',
                'user_id' => Auth::user()->id,
                'status_id' => '1',
                'address' => $request->address,
                'zip' => $request->postal_code,
                'city' => $request->city,
                'country' => $request->country,
            ]);

            foreach(session()->get('cart') as $item){
                $order_item = OrderItem::create([
                    'price' =>  $item['price'],
                    'quanity' =>  $item['quantity'],
                    'product_id' =>  $item['id'],
                    'order_id' =>  $order->id,
                ]);
            }

            $total = 0;

            foreach(session()->get('cart') as $product){
                $total += $product['price'] * $product['quantity'];
            }

            $this->email = $request->email;

            $data = [
                'order_id' => $order->id,
                'total' => $total,
            ];
        
            Mail::send('emails.test', $data,function($message){
                $message->to($this->email)->subject('New order received');
            });

            session()->forget('cart');

            return redirect('/')->with('alert_success', 'Плащането бе успешно!');

        } else {
            return redirect('/')->with('alert_danger', 'Плащането се провали...');
        }
    }
}
