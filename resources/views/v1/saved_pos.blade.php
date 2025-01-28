@extends('layouts.vertical', ['title' => 'Saved Orders'])

@section('content')

<div class="row">
    @foreach ($orders as $order)
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between my-3">
                    <div>
                        <h4 class="mb-1">{{ substr($order->reference, 0, 16) }}</h4>
                        <div>
                            <a href="#!" class="link-primary fs-16 fw-medium">{{ $order->created_at }}</a>
                        </div>
                    </div>
                </div>
                <div class="p-2 pb-0 mx-n3 mt-2">
                    <div class="row text-center g-2">
                        
                        <div class="col-lg-4 col-4 border-end">
                            <h5 class="mb-1">{{ abbreviateNumber($order->order_details_count) }}</h5>
                            <p class="text-muted mb-0">Order Size</p>
                        </div>
                        <div class="col-lg-4 col-4">
                            <h5 class="mb-1">{{ abbreviateNumber($order->total_amount) }}</h5>
                            <p class="text-muted mb-0">Order Am.</p>
                        </div>
                        <div class="col-lg-4 col-4 border-end">
                            <h5 class="mb-1">{{ abbreviateNumber($order->total_quantity) }}</h5>
                            <p class="text-muted mb-0">Order Qua.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer border-top gap-1 hstack">
                <form method="POST" action="{{ route('pos.view.order',[$order->id]) }}">
                    @csrf
                    <button class="btn btn-primary w-100">View Order</button>
                </form>
                <form method="POST" action="{{ route('pos.cancel.order',[$order->id]) }}">
                    @csrf
                <button class="btn btn-danger w-100">Cancel Order</button></div>
                </form>
        </div>
    </div>
    @endforeach
</div>

@endsection

@section('script-bottom')
@vite(['resources/js/pages/app-ecommerce-seller.js'])
@endsection