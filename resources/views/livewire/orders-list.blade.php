<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between gap-3 mb-3">
                    <div class="flex-grow-0" style="min-width: 250px">
                        <input wire:model.live="search" type="text" class="form-control" placeholder="Search orders...">
                    </div>
                    
                    <div class="d-flex gap-2 ">
                        <input wire:model.live="dateFrom" type="datetime-local" class="form-control" placeholder="From Date">
                        <input wire:model.live="dateTo" type="datetime-local" class="form-control" placeholder="To Date">
                    </div>
                </div>

                <div class="table-responsive table-centered table-nowrap">
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
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $order->reference }}</td>
                                    <td class="text-center">{{ $order->status }}</td>
                                    <td class="text-center">{{ $order->payment_type ?? 'Nothing Selected' }}</td>
                                    <td class="text-center">{{ number_format($order->total_amount) }}</td>
                                    <td class="text-center">{{ number_format($order->total_quantity) }}</td>
                                    <td class="text-center">{{ $order->user_name }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d, M, Y. h:iA') }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('view.orders',[$order->id]) }}" class="btn btn-primary me-1">view</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
