<!-- Top Bar -->
<header class="top-bar">

    <!-- Menu Toggler -->
    <button type="button" class="menu-toggler la la-bars" data-toggle="menu"></button>

    <!-- Brand -->
    <span class="brand">Blog</span>


    <!-- Right -->
    <div class="flex items-center ltr:ml-auto rtl:mr-auto">

        <!-- Dark Mode -->
        <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
            <input id="darkModeToggler" type="checkbox">
            <span></span>
        </label>

        <!-- Fullscreen -->
        <button id="fullScreenToggler" type="button"
                class="hidden lg:inline-block btn-link ltr:ml-3 rtl:mr-3 px-2 text-2xl leading-none la la-expand-arrows-alt"
                data-toggle="tooltip" data-tippy-content="Tam Ekran"></button>

        <!-- User Menu -->
        <div class="dropdown">
            <button class="flex items-center ltr:ml-4 rtl:mr-4" data-toggle="custom-dropdown-menu"
                    data-tippy-arrow="true" data-tippy-placement="bottom-end">
                <span class="avatar">{{substr(Auth::user()->name,0,1)}}{{substr(Auth::user()->surname,0,1)}}</span>
            </button>
            <div class="custom-dropdown-menu w-64">
                <div class="p-5">
                    <h5 class="uppercase">{{Auth::user()->name}} {{Auth::user()->surname}}</h5>
                    <p>{{(Auth::user()->role == 1) ? 'Admin' : 'Yazar'}}</p>
                </div>
                <hr>
                <div class="p-5">
                    <a href="{{route('logout')}}" class="flex items-center text-normal hover:text-primary">
                        <span class="la la-power-off text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                        Çıkış Yap
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Menu Bar -->
<aside class="menu-bar menu-sticky">
    <div class="menu-items">
        <div class="menu-header hidden">
            <a href="{{asset('syspanel')}}/#" class="flex items-center mx-8 mt-8">
                <span class="avatar w-16 h-16">JD</span>
                <div class="ltr:ml-4 rtl:mr-4 ltr:text-left rtl:text-right">
                    <h5>John Doe</h5>
                    <p class="mt-2">Editor</p>
                </div>
            </a>
            <hr class="mx-8 my-4">
        </div>

        <a href="{{route('home')}}" class="link" data-toggle="tooltip-menu" data-tippy-content="home">
            <span class="icon la la-home"></span>
            <span class="title">Ana Sayfa</span>
        </a>

        @if(Auth::user()->role == 1)

            <a href="{{route('system-settings')}}" class="link" data-toggle="tooltip-menu" data-tippy-content="SystemSettings">
                <i class="icon la la-sliders-h"></i>
                <span class="title">Sistem Ayarları</span>
            </a>

        @endif

        @if(Auth::user()->role == 1)

            <a href="{{route('user-management')}}" class="link" data-toggle="tooltip-menu" data-tippy-content="UserManagement">
                <i class="icon la la-users"></i>
                <span class="title">Kullanıcı Yönetimi</span>
            </a>

        @endif

        @if(Auth::user()->role == 1)

            <a href="{{route('category-management')}}" class="link" data-toggle="tooltip-menu" data-tippy-content="CategoryManagement">
                <span class="icon la la-bars"></span>
                <span class="title">Kategori Yönetimi</span>
            </a>

        @endif

        <a href="{{route('blog-management')}}" class="link" data-toggle="tooltip-menu" data-tippy-content="BlogManagement">
            <span class="icon la la-blog"></span>
            <span class="title">Blog Yönetimi</span>
        </a>

        <a href="{{route('logout')}}" class="link" data-toggle="tooltip-menu" data-tippy-content="BlogManagement">
            <span class="icon la la-power-off"></span>
            <span class="title">Çıkış Yap</span>
        </a>


    </div>


    <!-- UI -->
    <div class="menu-detail" data-menu="ui">
        <div class="menu-detail-wrapper">
            <h6 class="uppercase">Form</h6>
            <a href="{{asset('syspanel')}}/form-components.html">
                <span class="la la-cubes"></span>
                Components
            </a>
            <a href="{{asset('syspanel')}}/form-input-groups.html">
                <span class="la la-stop"></span>
                Input Groups
            </a>
            <a href="{{asset('syspanel')}}/form-layout.html">
                <span class="la la-th-large"></span>
                Layout
            </a>
            <a href="{{asset('syspanel')}}/form-validations.html">
                <span class="la la-check-circle"></span>
                Validations
            </a>
            <a href="{{asset('syspanel')}}/form-wizards.html">
                <span class="la la-hand-pointer"></span>
                Wizards
            </a>
            <hr>
            <h6 class="uppercase">Components</h6>
            <a href="{{asset('syspanel')}}/components-alerts.html">
                <span class="la la-bell"></span>
                Alerts
            </a>
            <a href="{{asset('syspanel')}}/components-avatars.html">
                <span class="la la-user-circle"></span>
                Avatars
            </a>
            <a href="{{asset('syspanel')}}/components-badges.html">
                <span class="la la-certificate"></span>
                Badges
            </a>
            <a href="{{asset('syspanel')}}/components-buttons.html">
                <span class="la la-play"></span>
                Buttons
            </a>
            <a href="{{asset('syspanel')}}/components-cards.html">
                <span class="la la-layer-group"></span>
                Cards
            </a>
            <a href="{{asset('syspanel')}}/components-collapse.html">
                <span class="la la-arrow-circle-right"></span>
                Collapse
            </a>
            <a href="{{asset('syspanel')}}/components-colors.html">
                <span class="la la-palette"></span>
                Colors
            </a>
            <a href="{{asset('syspanel')}}/components-dropdowns.html">
                <span class="la la-arrow-circle-down"></span>
                Dropdowns
            </a>
            <a href="{{asset('syspanel')}}/components-modal.html">
                <span class="la la-times-circle"></span>
                Modal
            </a>
            <a href="{{asset('syspanel')}}/components-popovers-tooltips.html">
                <span class="la la-thumbtack"></span>
                Popovers & Tooltips
            </a>
            <a href="{{asset('syspanel')}}/components-tabs.html">
                <span class="la la-columns"></span>
                Tabs
            </a>
            <a href="{{asset('syspanel')}}/components-tables.html">
                <span class="la la-table"></span>
                Tables
            </a>
            <a href="{{asset('syspanel')}}/components-toasts.html">
                <span class="la la-bell"></span>
                Toasts
            </a>
            <hr>
            <h6 class="uppercase">Extras</h6>
            <a href="{{asset('syspanel')}}/extras-carousel.html">
                <span class="la la-images"></span>
                Carousel
            </a>
            <a href="{{asset('syspanel')}}/extras-charts.html">
                <span class="la la-chart-area"></span>
                Charts
            </a>
            <a href="{{asset('syspanel')}}/extras-editors.html">
                <span class="la la-keyboard"></span>
                Editors
            </a>
            <a href="{{asset('syspanel')}}/extras-sortable.html">
                <span class="la la-sort"></span>
                Sortable
            </a>
        </div>
    </div>

    <!-- Pages -->
    <div class="menu-detail" data-menu="pages">
        <div class="menu-detail-wrapper">
            <h6 class="uppercase">Authentication</h6>
            <a href="{{asset('syspanel')}}/auth-login.html">
                <span class="la la-user"></span>
                Login
            </a>
            <a href="{{asset('syspanel')}}/auth-forgot-password.html">
                <span class="la la-user-lock"></span>
                Forgot Password
            </a>
            <a href="{{asset('syspanel')}}/auth-register.html">
                <span class="la la-user-plus"></span>
                Register
            </a>
            <hr>
            <h6 class="uppercase">Blog</h6>
            <a href="{{asset('syspanel')}}/blog-list.html">
                <span class="la la-list"></span>
                List
            </a>
            <a href="{{asset('syspanel')}}/blog-list-card-rows.html">
                <span class="la la-list"></span>
                List - Card Rows
            </a>
            <a href="{{asset('syspanel')}}/blog-list-card-columns.html">
                <span class="la la-list"></span>
                List - Card Columns
            </a>
            <a href="{{asset('syspanel')}}/blog-add.html">
                <span class="la la-layer-group"></span>
                Add Post
            </a>
            <hr>
            <h6 class="uppercase">Errors</h6>
            <a href="{{asset('syspanel')}}/errors-403.html" target="_blank">
                <span class="la la-exclamation-circle"></span>
                403 Error
            </a>
            <a href="{{asset('syspanel')}}/errors-404.html" target="_blank">
                <span class="la la-exclamation-circle"></span>
                404 Error
            </a>
            <a href="{{asset('syspanel')}}/errors-500.html" target="_blank">
                <span class="la la-exclamation-circle"></span>
                500 Error
            </a>
            <a href="{{asset('syspanel')}}/errors-under-maintenance.html" target="_blank">
                <span class="la la-exclamation-circle"></span>
                Under Maintenance
            </a>
            <hr>
            <a href="{{asset('syspanel')}}/pages-pricing.html">
                <span class="la la-dollar"></span>
                Pricing
            </a>
            <a href="{{asset('syspanel')}}/pages-faqs-layout-1.html">
                <span class="la la-question-circle"></span>
                FAQs - Layout 1
            </a>
            <a href="{{asset('syspanel')}}/pages-faqs-layout-2.html">
                <span class="la la-question-circle"></span>
                FAQs - Layout 2
            </a>
            <a href="{{asset('syspanel')}}/pages-invoice.html">
                <span class="la la-file-invoice-dollar"></span>
                Invoice
            </a>
        </div>
    </div>

    <!-- Applications -->
    <div class="menu-detail" data-menu="applications">
        <div class="menu-detail-wrapper">
            <a href="{{asset('syspanel')}}/applications-media-library.html">
                <span class="la la-image"></span>
                Media Library
            </a>
            <a href="{{asset('syspanel')}}/applications-point-of-sale.html">
                <span class="la la-shopping-bag"></span>
                Point Of Sale
            </a>
            <a href="{{asset('syspanel')}}/applications-to-do.html">
                <span class="la la-check-circle"></span>
                To Do
            </a>
            <a href="{{asset('syspanel')}}/applications-chat.html">
                <span class="la la-comment"></span>
                Chat
            </a>
        </div>
    </div>

    <!-- Menu -->
    <div class="menu-detail" data-menu="menu">
        <div class="menu-detail-wrapper">
            <a href="{{asset('syspanel')}}/#no-link">
                <span class="la la-cube"></span>
                Default
            </a>
            <a href="{{asset('syspanel')}}/#no-link">
                <span class="la la-file-alt"></span>
                Content
            </a>
            <a href="{{asset('syspanel')}}/#no-link">
                <span class="la la-shopping-bag"></span>
                Ecommerce
            </a>
            <hr>
            <a href="{{asset('syspanel')}}/#no-link">
                <span class="la la-layer-group"></span>
                Main Level
            </a>
            <a href="{{asset('syspanel')}}/#no-link">
                <span class="la la-arrow-circle-right"></span>
                Grand Parent
            </a>
            <a href="{{asset('syspanel')}}/#no-link" class="active" data-toggle="collapse" data-target="#menuGrandParentOpen">
                <span class="collapse-indicator la la-arrow-circle-down"></span>
                Grand Parent Open
            </a>
            <div id="menuGrandParentOpen" class="collapse open">
                <a href="{{asset('syspanel')}}/#no-link">
                    <span class="la la-layer-group"></span>
                    Sub Level
                </a>
                <a href="{{asset('syspanel')}}/#no-link">
                    <span class="la la-arrow-circle-right"></span>
                    Parent
                </a>
                <a href="{{asset('syspanel')}}/#no-link" class="active" data-toggle="collapse" data-target="#menuParentOpen">
                    <span class="collapse-indicator la la-arrow-circle-down"></span>
                    Parent Open
                </a>
                <div id="menuParentOpen" class="collapse open">
                    <a href="{{asset('syspanel')}}/#no-link">
                        <span class="la la-layer-group"></span>
                        Sub Level
                    </a>
                </div>
            </div>
            <hr>
            <h6 class="uppercase">Menu Types</h6>
            <a href="{{asset('syspanel')}}/#no-link" data-toggle="menu-type" data-value="default">
                <span class="la la-hand-point-right"></span>
                Default
            </a>
            <a href="{{asset('syspanel')}}/#no-link" data-toggle="menu-type" data-value="hidden">
                <span class="la la-hand-point-left"></span>
                Hidden
            </a>
            <a href="{{asset('syspanel')}}/#no-link" data-toggle="menu-type" data-value="icon-only">
                <span class="la la-th-large"></span>
                Icons Only
            </a>
            <a href="{{asset('syspanel')}}/#no-link" data-toggle="menu-type" data-value="wide">
                <span class="la la-arrows-alt-h"></span>
                Wide
            </a>
        </div>
    </div>
</aside>