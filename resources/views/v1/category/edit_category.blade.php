@extends('layouts.vertical', ['title' => 'Categories List'])

@section('css')
    @vite(['node_modules/choices.js/public/assets/styles/choices.min.css'])
@endsection

@section('content')
    <div class="row">

        <form method="POST" action="{{ route('category.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-xl-12 col-lg-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Category</h4>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <div class="col-lg-12 mt-2">
                            <h6 class="card-title">Category Image</h6>
                            <img src="{{ $category->image }}" alt="" class="avatar-xxl">
                        </div>

                        <div class="col-lg-12 mt-2">
                            <input type="file" id="image_input" name="image" class="form-control">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                            <div id="image_preview" class="mt-3"></div>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <div class="mb-3">
                                <label for="category-title" class="form-label">Category Title</label>
                                <input type="text" name="title" id="category-title" class="form-control"
                                    value="{{ $category->name }}"
                                    placeholder="Enter Title">
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                        </div>
                        <!-- end dropzon-preview -->
                    </div>
                </div>
                <div class="p-3 bg-light mb-3 rounded">
                    <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-outline-primary w-100">Update Category</button>
                        </div>
                        <div class="col-lg-2">
                            <a href="#!" class="btn btn-outline-danger w-100" onclick="history.back()">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('image_input').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('image_preview');
            previewContainer.innerHTML = '';

            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-image img-fluid';
                    img.style.maxWidth = '100%';
                    img.style.height = 'auto';
                    img.style.maxHeight = '300px';
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

@section('script-bottom')
    @vite(['resources/js/pages/ecommerce-product-details.js'])
@endsection
