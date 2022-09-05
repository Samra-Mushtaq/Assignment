
 <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="/dashboard" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img"  src="{{ asset('images/logo.png') }}" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img"  src="{{ asset('images/logo-dark.png') }}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small"  src="{{ asset('images/logo-small.png') }}" srcset="./images/logo-small2x.png 2x" alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{ asset('/users-info') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-bag"></em></span>
                            <span class="nk-menu-text">Users</span><span class="nk-menu-badge">HOT</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    @can('role-list')
                    <li class="nk-menu-item">
                        <a href="{{ asset('/roles') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-bag"></em></span>
                            <span class="nk-menu-text">Roles</span><span class="nk-menu-badge">HOT</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    @endcan
                   
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Applications</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ asset('/categories') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-activity-round-fill"></em></span>
                            <span class="nk-menu-text">Categories</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ asset('/products') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-cart-fill"></em></span>
                            <span class="nk-menu-text">Products</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    
                    <li class="nk-menu-item">
                        <a href="{{ asset('/notifications') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-growth-fill"></em></span>
                            <span class="nk-menu-text">Notification</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ asset('/translations') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-growth-fill"></em></span>
                            <span class="nk-menu-text">Translation</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                   
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>