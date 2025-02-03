<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PointOfSale extends Component
{
    public $search = '';
    public $products = [];
    public $cart = [];
    public $reference = '';

    public function mount($reference)
    {
        $this->reference = $reference;
        $this->cart = Session::get('cart', []);

        // dd($reference);
    }

    public function updatedSearch()
    {
        if($this->search == '') {
            $this->products = [];
        }else{
            $this->products = Product::where('name', 'like', '%' . $this->search . '%')
                ->where('company_id', Auth::user()->company_id)
                ->get();
        }
    }

    public function addToCart($product)
    {
        $product = (object)$product;
        $productId = $product->id;
        
        if ($product) {
            if (isset($this->cart[$productId])) {
                $this->cart[$productId]['quantity']++;
                $this->cart[$productId]['total'] += $product->price;
            } else {
                $this->cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => 1,
                    'total' => $product->price
                ];
            }
        }
    }

    public function removeFromCart($productId)
    {
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
        }
    }

    public function increaseQuantity($productId)
    {
        if (isset($this->cart[$productId])) {
            $product = Product::find($productId);
            if ($product) {
                $this->cart[$productId]['quantity']++;
                $this->cart[$productId]['total'] += $product->price;

            }
        }
    }

    public function decreaseQuantity($productId)
    {
        if (isset($this->cart[$productId])) {
            $product = Product::find($productId);
            if ($product && $this->cart[$productId]['quantity'] > 1) {
                $this->cart[$productId]['quantity']--;
                $this->cart[$productId]['total'] -= $product->price;
            } elseif ($this->cart[$productId]['quantity'] === 1) {
                unset($this->cart[$productId]);
            }
        }
    }

    public function saveCart(){
        if($this->reference == ''){
            $reference = now('Africa/Lagos')->format('YmdHi') . rand(111111, 999999) . time();

            $order = new Order();
            $order->reference = $reference;
            $order->company_id = Auth::user()->company_id;
            $order->user_id = Auth::user()->id;
            $order->save();

            foreach ($this->cart as $key => $value) {
                $orderDetail = new OrderDetails();
                $orderDetail->product_id = $key;
                $orderDetail->order_id = $order->id;
                $orderDetail->quantity = $value['quantity'];
                $orderDetail->total = $value['total'];

                $orderDetail->save();
            }
        } else{
            $order = Order::where('reference', $this->reference)->first();

            if($order){
                foreach ($this->cart as $key => $value) {
                    $orderDetail = OrderDetails::where('product_id',$key)
                        ->where('order_id',$order->id)
                        ->first();

                    if($orderDetail){
                        $orderDetail->quantity = $value['quantity'];
                        $orderDetail->total = $value['total'];
                        $orderDetail->save();
                    }else{
                        $orderDetail = new OrderDetails();
                        $orderDetail->product_id = $key;
                        $orderDetail->order_id = $order->id;
                        $orderDetail->quantity = $value['quantity'];
                        $orderDetail->total = $value['total'];
                        $orderDetail->save();
                    }
                }
            }
        }

        $this->clearCart();
    }

    public function authorizePayment($payment_chanel){
        $reference = '';
        if($this->reference == ''){
            $reference = now('Africa/Lagos')->format('YmdHi') . rand(111111, 999999) . time();

            $order = new Order();
            $order->reference = $reference;
            $order->payment_type = $payment_chanel;
            $order->status = 'success';
            $order->company_id = Auth::user()->company_id;
            $order->user_id = Auth::user()->id;
            $order->save();

            foreach ($this->cart as $key => $value) {
                $orderDetail = new OrderDetails();
                $orderDetail->product_id = $key;
                $orderDetail->order_id = $order->id;
                $orderDetail->quantity = $value['quantity'];
                $orderDetail->total = $value['total'];

                $orderDetail->save();

                $product = Product::find($key);
                $product->stock -= $value['quantity'];
                $product->save();
            }
        } else{
            $reference = $this->reference;
            $order = Order::where('reference', $this->reference)->first();
            $order->payment_type = $payment_chanel;
            $order->status = 'success';
            $order->save();

            if($order){
                foreach ($this->cart as $key => $value) {
                    $orderDetail = OrderDetails::where('product_id',$key)
                        ->where('order_id',$order->id)
                        ->first();
                    if($orderDetail){
                        $orderDetail->quantity = $value['quantity'];
                        $orderDetail->total = $value['total'];
                        $orderDetail->save();
                    }else{
                        $orderDetail = new OrderDetails();
                        $orderDetail->product_id = $key;
                        $orderDetail->order_id = $order->id;
                        $orderDetail->quantity = $value['quantity'];
                        $orderDetail->total = $value['total'];
                        $orderDetail->save();
                    }

                    $product = Product::find($key);
                    $product->stock -= $value['quantity'];
                    $product->save();
                }
            }
        }

        $this->printReceipt($reference);
        $this->clearCart();
    }

    public function printReceipt($reference)
    {
        $this->dispatch('printReceipt', reference: $reference);
    }

    public function clearCart(){
        $this->cart = [];
        Session::forget('cart');
    }

    public function render()
    {
        Session::put('cart', $this->cart);
        return view('livewire.point-of-sale');
    }
}
