<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="{{ route('second', [ 'dashboards' , 'index']) }}" class="logo-dark">
            <img src="/images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="/images/logo-dark.png" class="logo-lg" alt="logo dark">
        </a>

        <a href="{{ route('second', [ 'dashboards' , 'index']) }}" class="logo-light">
            <img src="/images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="/images/logo-light.png" class="logo-lg" alt="logo light">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>
        <ul class="navbar-nav" id="navbar-nav">

            

            <li class="menu-title">Inventory List</li>
            @if (auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                   aria-expanded="false" aria-controls="sidebarProducts">
                         <span class="nav-icon">
                               <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                         </span>
                    <span class="nav-text"> Dashboard </span>
                </a>
                <div class="collapse" id="sidebarProducts">
                    <ul class="nav sub-navbar-nav">
                    <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('dashboard')}}">Overview</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('orders')}}">Orders</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('in_stock')}}">In Stock</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="{{ route('out_stock')}}">Out Of Stock</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('staff.list') }}">
                         <span class="nav-icon">
                              <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                         </span>
                    <span class="nav-text"> Staff </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('category.list') }}">
                         <span class="nav-icon">
                              <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                         </span>
                    <span class="nav-text"> Categories </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.list') }}">
                         <span class="nav-icon">
                              <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                         </span>
                    <span class="nav-text"> Products </span>
                </a>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{ route('pos.index') }}">
                         <span class="nav-icon">
                              <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                         </span>
                    <span class="nav-text"> Point Of Sales </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('pos.saved') }}">
                         <span class="nav-icon">
                              <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                         </span>
                    <span class="nav-text"> Saved Orders </span>
                </a>
            </li>

            

            
        </ul>
    </div>
</div>
