@extends('layouts.vertical', ['title' => 'In Stock'])

@section('content')

    <div class="row">
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
                    <div class="mb-3" data-simplebar style="max-height: 600px;">
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
                    {{ $in_stock_product->links() }}
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div>
    </div> <!-- end row -->


@endsection

@section('script-bottom')
@vite(['resources/js/pages/widgets.js'])
@endsection