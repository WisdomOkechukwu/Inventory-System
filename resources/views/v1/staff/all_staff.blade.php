@extends('layouts.vertical', ['title' => 'Staff List('.number_format($total_staff).')'])

@section('content')
    <div class="card overflow-hiddenCoupons">
        <div class="card-body p-0">
            <div class="table-responsive">
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
            <!-- end table-responsive -->
        </div>
        {{ $staff->links() }}
        {{-- <div class="row g-0 align-items-center justify-content-between text-center text-sm-start p-3 border-top">
            <div class="col-sm">
                <div class="text-muted">
                    Showing <span class="fw-semibold">10</span> of <span class="fw-semibold">59</span> Results
                </div>
            </div>
            <div class="col-sm-auto mt-3 mt-sm-0">
                <ul class="pagination  m-0">
                    <li class="page-item">
                        <a href="#" class="page-link"><i class='bx bx-left-arrow-alt'></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="#" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">2</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link">3</a>
                    </li>
                    <li class="page-item">
                        <a href="#" class="page-link"><i class='bx bx-right-arrow-alt'></i></a>
                    </li>
                </ul>
            </div>
        </div> --}}
    </div> <!-- end card -->
@endsection
