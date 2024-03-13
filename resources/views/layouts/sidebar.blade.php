@auth
<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{route('pages.dashboard')}}" class="text-nowrap logo-img">
                <!-- <img src="{{asset('assets/images/logos/dark-logo.svg')}}" width="180" alt="" /> -->
                <img src="{{asset('images/icons/Badar-Depo.png')}}" width="180" alt="">
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
                @if(session()->get('user')->roles[0]->name =="admin" || session()->get('user')->roles[0]->name =="dho")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.delegationsPage')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-mail"></i>
                        </span>
                        <span class="hide-menu">Delegations</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.delegatesPage')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-mail"></i>
                        </span>
                        <span class="hide-menu">Delegates</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.officer')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-shield-half-filled"></i>
                        </span>
                        <span class="hide-menu">Officers</span>
                    </a>
                </li>
                @endif
                <!-- @if(session()->get('user')->roles[0]->name =="admin")
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
                @endif -->
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
                    <a class="sidebar-link" href="{{route('pages.members',session()->get('user')->delegationUid)}}" aria-expanded="false">
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
                        <span class="hide-menu">Officers</span>
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
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.hotelPlans')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-mail"></i>
                        </span>
                        <span class="hide-menu">Hotel Plan</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin" || session()->get('user')->roles[0]->name =="airport")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.airport')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-plane-departure"></i>
                        </span>
                        <span class="hide-menu">Airport</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.flights')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-plane-departure"></i>
                        </span>
                        <span class="hide-menu">Flights</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.category')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-category-2"></i>
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                </li> -->
                @endif
                @if(session()->get('user')->roles[0]->name =="admin")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.category')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-category"></i>
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin"|| session()->get('user')->roles[0]->name =="hotels")

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.hotels')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building-skyscraper"></i>
                        </span>
                        <span class="hide-menu">Hotel</span>
                    </a>
                </li>

                @endif
                @if(session()->get('user')->roles[0]->name =="admin" || session()->get('user')->roles[0]->name =="dho" || session()->get('user')->roles[0]->name =="vendor")
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
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.wishPage')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-gift"></i>
                        </span>
                        <span class="hide-menu">Wishlists</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.events')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar-event"></i>
                        </span>
                        <span class="hide-menu">Events</span>
                    </a>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="admin"|| session()->get('user')->roles[0]->name =="dho")
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Reports</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Delegation</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('pages.listOfAllDelegation')}}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">List Of All Delegation</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('pages.listOfAllDelegates')}}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">List Of All Delegates</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegate Badge Count</span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="{{route('pages.delegationAttendance')}}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegation Attendance</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Invitation & Response</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('pages.countryReport')}}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Country</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('pages.vipDelegationReport')}}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('pages.countryAndVipReport')}}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Country & VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('pages.selfRepReport')}}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Self/Rep</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">List of Invited Dignitaries</span>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <!-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Meeting Request & Delegation</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="../main/blog-posts.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Posts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Details</span>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Airports</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('pages.delegationArrivalStatusReport')}}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegation Arrival Status - Country</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegation Arrival Status - VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Arrival Status - Country</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Arrival Status - VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Arrival Details</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegation Arrival Status - Country</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegation Arrival Status - VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Arrival Status - Country</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Arrival Status - VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Departure Details</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Hotels</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="../main/blog-posts.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegation Check-In Status - Country</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegation Check-In Status - VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Check-In Status - Country</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Check-In Status - VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Hotel Check-In Details</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegation Check-Out Status - Country</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegation Check-Out Status - VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Check-Out Status - Country</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Delegates Check-Out Status - VIP</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Hotel Check-Out Details</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Officers</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="../main/blog-posts.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Responsibilities - LOs</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Responsibilities - ROs</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">Responsibilities - Interpreters</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Persons</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="../main/blog-posts.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">List of VIPs</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">List of Officer</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../main/blog-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">List of Driver</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Tracking</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="../main/blog-posts.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grain"></i>
                                </div>
                                <span class="hide-menu">View Delegates Status</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(session()->get('user')->roles[0]->name =="delegate")
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('pages.e-listEBadge')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-id-badge-2"></i>
                        </span>
                        <span class="hide-menu">E-Badges</span>
                    </a>
                </li>
                @endif
                <li class="sidebar-item">
                    <!-- <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                    </a> -->
                </li>
                <li class="sidebar-item">
                    <!-- <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                    </a> -->
                </li>
                <li class="sidebar-item">
                    <!-- <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                    </a> -->
                </li>
                <li class="sidebar-item">
                    <!-- <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                    </a> -->
                </li>
                <li class="sidebar-item">
                    <!-- <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                    </a> -->
                </li>
                <li class="sidebar-item">
                    <!-- <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                    </a> -->
                </li>
            </ul>
            <!-- <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                <div class="d-flex">
                    <br />
                </div>
            </div> -->

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