@extends('layouts.vertical', ['title' => 'Widgets'])

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-md bg-soft-primary rounded">
                                <iconify-icon icon="solar:cart-5-bold-duotone"
                                    class="avatar-title fs-32 text-primary"></iconify-icon>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-6 text-end">
                            <p class="text-muted mb-0 text-truncate">Total Orders</p>
                            <h3 class="text-dark mt-1 mb-0">{{ number_format($totalOrders) }}</h3>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-md bg-soft-primary rounded">
                                <i class="bx bx-award avatar-title fs-24 text-primary"></i>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-6 text-end">
                            <p class="text-muted mb-0 text-truncate">Order Amount</p>
                            <h3 class="text-dark mt-1 mb-0">{{ abbreviateNumber($totalAmount, 2) }}</h3>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-md bg-soft-primary rounded">
                                <i class="bx bxs-backpack avatar-title fs-24 text-primary"></i>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-6 text-end">
                            <p class="text-muted mb-0 text-truncate">Out of Stock</p>
                            <h3 class="text-dark mt-1 mb-0">{{ number_format($out_of_stock) }}</h3>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-md bg-soft-primary rounded">
                                <i class="bx bx-dollar-circle avatar-title text-primary fs-24"></i>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-6 text-end">
                            <p class="text-muted mb-0 text-truncate">In Stock</p>
                            <h3 class="text-dark mt-1 mb-0">{{ number_format($in_stock) }}</h3>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- end row-->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="pt-3 px-3">
                        <div class="float-end">
                            {{-- <input type="date-time" placeholder="search order id" wire:model.live="searchOrder" class="form-control"> --}}
                        </div>
                        <h5 class="card-title mb-3">Order List</h5>
                    </div>
                    <div class="mb-3" data-simplebar style="max-height: 324px;">
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
                                        </tr>
                                    @endforeach
                                </tbody> <!-- end tbody -->

                            </table> <!-- end table -->
                        </div> <!-- end table responsive -->
                    </div>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="pt-3 px-3">
                        <div class="float-end">
                            <a href="javascript:void(0);" class="text-primary">
                                {{-- <i class="bx bx-export ms-1"></i> --}}
                            </a>
                        </div>
                        <h5 class="card-title mb-3">Out Of Stock</h5>
                    </div>
                    <div class="mb-3" data-simplebar style="max-height: 324px;">
                        <div class="table-responsive table-centered table-nowrap px-3">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead> <!-- end thead -->
                                <tbody>
                                    @foreach ($out_stock_product as $transaction)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="{{ $transaction->image }}" alt=""
                                                            class="avatar-md">
                                                    </div>
                                                    <div>
                                                        <a href="#!"
                                                            class="text-dark fw-medium fs-15">{{ $transaction->name }}</a>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>NGN {{ number_format($transaction->price) }}</td>
                                            <td>
                                                <p class="mb-1 text-muted"><span
                                                        class="text-dark fw-medium">{{ number_format($transaction->stock) }}
                                                        Item(s)</span> Left</p>
                                            </td>
                                            <td>{{ $transaction->category?->name }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('product.edit', [$transaction->id]) }}"
                                                        class="btn btn-soft-primary btn-sm"><iconify-icon
                                                            icon="solar:pen-2-broken"
                                                            class="align-middle fs-18"></iconify-icon></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> <!-- end tbody -->

                            </table> <!-- end table -->
                        </div> <!-- end table responsive -->
                    </div>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="pt-3 px-3">
                        <div class="float-end">
                            <a href="javascript:void(0);" class="text-primary">
                                {{-- <i class="bx bx-export ms-1"></i> --}}
                            </a>
                        </div>
                        <h5 class="card-title mb-3">In Stock</h5>
                    </div>
                    <div class="mb-3" data-simplebar style="max-height: 324px;">
                        <div class="table-responsive table-centered table-nowrap px-3">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead> <!-- end thead -->
                                <tbody>
                                    @foreach ($in_stock_product as $transaction)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="{{ $transaction->image }}" alt=""
                                                            class="avatar-md">
                                                    </div>
                                                    <div>
                                                        <a href="#!"
                                                            class="text-dark fw-medium fs-15">{{ $transaction->name }}</a>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>NGN {{ number_format($transaction->price) }}</td>
                                            <td>
                                                <p class="mb-1 text-muted"><span
                                                        class="text-dark fw-medium">{{ number_format($transaction->stock) }}
                                                        Item(s)</span> Left</p>
                                            </td>
                                            <td>{{ $transaction->category?->name }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('product.edit', [$transaction->id]) }}"
                                                        class="btn btn-soft-primary btn-sm"><iconify-icon
                                                            icon="solar:pen-2-broken"
                                                            class="align-middle fs-18"></iconify-icon></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> <!-- end tbody -->

                            </table> <!-- end table -->
                        </div> <!-- end table responsive -->
                    </div>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div>
    </div> <!-- end row -->


@endsection

@section('script-bottom')
@vite(['resources/js/pages/widgets.js'])
@endsection