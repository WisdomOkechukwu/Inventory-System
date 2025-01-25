<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials/title-meta', ['title' => $title])
    @yield('css')
    @include('layouts.partials/head-css')
</head>

<body>

    <div class="wrapper">

        @include('layouts.partials/topbar', ['title' => $title])
        @include('layouts.partials/main-nav')

        <div class="page-content">

            <div class="container-fluid">
                @yield('content')
            </div>

            @include('layouts.partials/footer')

        </div>

    </div>

    {{-- @include("layouts.partials/right-sidebar") --}}
    @include('layouts.partials/footer-scripts')
    
    @if (session()->has('success'))
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal('Great', "{{ session()->get('success') }} ", 'success');
        </script>
    @endif

    @if (session()->has('error'))
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script>
            swal('Oops!!', "{{ session()->get('error') }} ", 'error');
        </script>
    @endif

    @vite(['resources/js/app.js', 'resources/js/layout.js'])
</body>

</html>
