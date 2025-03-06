<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center gap-1">
                <h4 class="card-title flex-grow-1">All Categories List
                    <a href="{{ route('category.add')}}" class="btn btn-sm btn-primary">
                        Add Category
                    </a>
                </h4>
                <div class="flex-grow-0" style="min-width: 250px">
                        <input wire:model.live="search" type="text" class="form-control" placeholder="Search categories...">
                    </div>


            </div>
            <div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover table-centered">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th>Categories</th>
                                <th>Created by</th>
                                <th>No of Product</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $c)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                            <img src="{{ $c->image }}" alt="" class="avatar-md">
                                        </div>
                                        <p class="text-dark fw-medium fs-15 mb-0">{{ $c->name }}</p>
                                    </div>

                                </td>
                                <td>{{ $c->user?->name }}</td>
                                <td>{{ $c->products_count }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('product.category',[$c->id]) }}" class="btn btn-soft-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                        <a href="{{ route('category.edit',[$c->id]) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
            {{ $category->links() }}
        </div>
    </div>
</div>
