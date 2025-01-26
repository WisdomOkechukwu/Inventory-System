@extends('layouts.vertical', ['title' => 'Product List'])

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">All Product List</h4>

                    <a href="{{ route('product.add') }}" class="btn btn-sm btn-primary">
                        Add Product
                    </a>

                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover table-centered">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $p)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div
                                                    class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                    <img src="{{ $p->image }}" alt="" class="avatar-md">
                                                </div>
                                                <div>
                                                    <a href="#!"
                                                        class="text-dark fw-medium fs-15">{{ $p->name }}</a>
                                                </div>
                                            </div>

                                        </td>
                                        <td>NGN {{ number_format($p->price) }}</td>
                                        <td>
                                            <p class="mb-1 text-muted"><span
                                                    class="text-dark fw-medium">{{ number_format($p->stock) }}
                                                    Item(s)</span> Left</p>
                                        </td>
                                        <td>{{ $p->category?->name }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('product.edit',[$p->id]) }}"
                                                    class="btn btn-soft-primary btn-sm"><iconify-icon
                                                        icon="solar:pen-2-broken"
                                                        class="align-middle fs-18"></iconify-icon></a>
                                                <form action="{{ route('product.hide') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                                                    <button type="submit" class="btn btn-soft-danger btn-sm">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                            class="align-middle fs-18"></iconify-icon>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
                {{ $product->links() }}
            </div>
        </div>

    </div>
@endsection
