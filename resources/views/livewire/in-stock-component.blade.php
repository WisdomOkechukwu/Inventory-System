<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between gap-3 mb-3">
                    <div class="flex-grow-0" style="min-width: 250px">
                        <input wire:model.live="search" type="text" class="form-control" placeholder="Search orders...">
                    </div>

                    <div class="d-flex gap-2 ">
                        {{-- <input wire:model.live="dateFrom" type="datetime-local" class="form-control"
                            placeholder="From Date">
                        <input wire:model.live="dateTo" type="datetime-local" class="form-control"
                            placeholder="To Date"> --}}
                    </div>
                </div>

                <div class="table-responsive table-centered table-nowrap">
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
                                                <img src="{{ $transaction->image }}" alt="" class="avatar-md">
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

                    </table>
                </div>
                <div class="mt-3">
                    {{ $in_stock_product->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
