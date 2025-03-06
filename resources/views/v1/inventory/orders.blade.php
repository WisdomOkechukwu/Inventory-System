@extends('layouts.vertical', ['title' => 'Orders'])

@section('content')
    @livewire('orders-list')
    {{-- <livewire:orders-list /> --}}
    {{-- <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="pt-3 px-3">
                        <div class="float-end">
                        </div>
                        <h5 class="card-title mb-3">Order List</h5>
                    </div>
                    <div class="mb-3" data-simplebar style="max-height: 600px;" >
                        <div class="table-responsive table-centered table-nowrap px-3">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Payment Used</th>
                                        <th class="text-center">Total Amount</th>
                                        <th class="text-center">Total Quantity</th>
                                        <th class="text-center">Performed By</th>
                                        <th class="text-center">Performed At</th>
                                        <th class="text-center">View</th>
                                    </tr>
                                </thead> <!-- end thead -->
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ $order->reference }}</td>
                                            <td class="text-center">{{ $order->status }}</td>
                                            <td class="text-center">{{ $order->payment_type ?? 'Nothing Selected' }}
                                            </td>
                                            <td class="text-center">{{ number_format($order->total_amount) }}</td>
                                            <td class="text-center">{{ number_format($order->total_quantity) }}</td>
                                            <td class="text-center">{{ $order->user_name }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('d, M, Y. h:iA') }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('view.orders',[$order->id]) }}"
                                                    class="btn btn-primary me-1">view</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> <!-- end tbody -->

                            </table> <!-- end table -->
                        </div> <!-- end table responsive -->
                    </div>
                    {{ $orders->links() }}
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div>
    </div> <!-- end row --> --}}


@endsection

@section('script-bottom')
@vite(['resources/js/pages/widgets.js'])
@endsection