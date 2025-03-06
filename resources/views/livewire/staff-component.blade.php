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
                    <table class="table align-middle mb-0 table-hover table-centered text-center">
                    <div class="text-md-end m-3 mt-md-0">
                        <a href="{{ route('staff.add') }}"
                            class="btn btn-primary me-1"><i class="bx bx-plus"></i> Add New Staff</a>
                    </div>
                    <thead class="bg-light-subtle">
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                            {{-- <th class="text-center">Status</th> --}}
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $s)
                            
                        
                        <tr>
                            <td class="align-middle">{{ $s->name }}</td>
                            <td class="align-middle">{{ $s->email }}</td>
                            <td class="align-middle">{{ $s->role }}</td>
                            {{-- <td class="align-middle">{{ $s->status }}</td> --}}
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('staff.show', [$s->id]) }}" class="btn btn-soft-primary btn-sm">
                                        <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                    </a>
                                    <form action="{{ route('staff.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="staff_id" value="{{ $s->id }}">
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
                <div class="mt-3">
                    {{ $staff->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
