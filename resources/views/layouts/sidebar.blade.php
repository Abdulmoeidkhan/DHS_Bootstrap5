@auth
<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{route('pages.dashboard')}}" class="text-nowrap logo-img">
                <!-- <img src="{{asset('assets/images/logos/dark-logo.svg')}}" width="180" alt="" /> -->
                <img src="{{asset('images/icons/Badar-Logo-Black.png')}}" width="180" alt="">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.dashboard')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.userPanel')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-plus"></i>
                        </span>
                        <span class="hide-menu">User Panel</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.delegationsPage')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-mail"></i>
                        </span>
                        <span class="hide-menu">Delegations</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.liasons')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-shield-half-filled"></i>
                        </span>
                        <span class="hide-menu">Liasons</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.interpreters')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-language"></i>
                        </span>
                        <span class="hide-menu">Interpreters</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.receivings')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-heart-handshake"></i>
                        </span>
                        <span class="hide-menu">Receiving Officer</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.programs')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-list-details"></i>
                        </span>
                        <span class="hide-menu">Programs</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="delegate")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.members',session()->get('user')->uid)}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Members</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="delegate")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.delegation')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-mail"></i>
                        </span>
                        <span class="hide-menu">Delegation</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="delegate")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.renderSpecificLiason')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-shield-half-filled"></i>
                        </span>
                        <span class="hide-menu">Liason</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="liason" || session()->get('user')->roles[0]->name =="receiving"|| session()->get('user')->roles[0]->name =="interpreter")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.delegationAssigned')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-mail"></i>
                        </span>
                        <span class="hide-menu">Delegation</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.flights')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-plane-departure"></i>
                        </span>
                        <span class="hide-menu">Flights</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.hotels')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building-skyscraper"></i>
                        </span>
                        <span class="hide-menu">Hotel</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.cars')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-car"></i>
                        </span>
                        <span class="hide-menu">Cars</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.badges')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-id-badge-2"></i>
                        </span>
                        <span class="hide-menu">Badges</span>
                    </a>
                </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.events')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar-event"></i>
                        </span>
                        <span class="hide-menu">Events</span>
                    </a>
                </li>
            </ul>
            <!-- <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./index.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">UI COMPONENTS</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Buttons</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-alert-circle"></i>
                        </span>
                        <span class="hide-menu">Alerts</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-cards"></i>
                        </span>
                        <span class="hide-menu">Card</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Forms</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-typography"></i>
                        </span>
                        <span class="hide-menu">Typography</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">AUTH</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-login"></i>
                        </span>
                        <span class="hide-menu">Login</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-plus"></i>
                        </span>
                        <span class="hide-menu">Register</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">EXTRA</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-mood-happy"></i>
                        </span>
                        <span class="hide-menu">Icons</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>
                        <span class="hide-menu">Sample Page</span>
                    </a>
                </li>
                @if(true)
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>
                        <span class="hide-menu">Sample Page</span>
                    </a>
                </li>
                @endif
            </ul> -->
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
@endauth