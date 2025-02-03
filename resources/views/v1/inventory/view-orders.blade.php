@extends('layouts.vertical', ['title' => 'Orders'])

@section('content')


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="pt-3 px-3">
                        <div class="float-end">
                        </div>
                        <h5 class="card-title mb-3">Products Bought</h5>
                    </div>
                    <div class="mb-3" data-simplebar style="max-height: 600px;" >
                        <div class="table-responsive table-centered table-nowrap px-3">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Total Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead> <!-- end thead -->
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="{{ $order->product?->image }}" alt=""
                                                            class="avatar-md">
                                                    </div>
                                                    <div>
                                                        <a href="#!"
                                                            class="text-dark fw-medium fs-15">{{ ($order->product?->name) }}</a>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>NGN {{ number_format($order->total) }}</td>
                                            <td>
                                                <p class="mb-1 text-muted"><span
                                                        class="text-dark fw-medium">{{ number_format($order->quantity) }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> <!-- end tbody -->

                            </table> <!-- end table -->
                        </div> <!-- end table responsive -->
                    </div>
                    {{-- {{ $orders->links() }} --}}
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div>
    </div> <!-- end row -->


@endsection

@section('script-bottom')
@vite(['resources/js/pages/widgets.js'])
@endsection