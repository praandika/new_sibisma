<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="dark2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">

            <!-- Account Info -->
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                        class="avatar-img rounded-circle">
                    @else
                    <div class="avatar-img rounded-circle">
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    @endif
                </div>

                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->first_name }}
                            <span class="user-level">{{ Auth::user()->access }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('profile.show') }}">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.editpass',Auth::user()->id) }}">
                                    <span class="link-collapse">Password</span>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post" style="cursor: pointer;">
                                @csrf
                                    <a onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <span class="link-collapse" style="color: red;">Logout</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END Account Info -->

            <ul class="nav nav-primary">
            @if(Auth::user()->access != 'warehouse')
            
                @if(Auth::user()->access != 'user')
                    @if(Auth::user()-> access != 'salesman')
                            @include('menu.dashboard')
                        @if(Auth::user()->allocation_tools == 'yes')
                            @include('menu.allocation')
                        @endif
                        @if(Auth::user()-> access != 'owner')
                            @include('menu.stock')
                            @include('menu.spk')
                            @include('menu.manage-stock')
                            @include('menu.delivery')
                            @include('menu.opname')
                            @include('menu.dealer')
                            @include('menu.manpower')
                            @include('menu.dokumen')
                        @endif

                        @include('menu.report')

                        @if(Auth::user()-> access == 'admin')
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Admin</h4>
                            </li>
                            @include('menu.user')
                        @endif

                        @if(Auth::user()->access == 'master')
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">Admin</h4>
                            </li>
                            @include('menu.datamaster')
                            @include('menu.datawebsite')
                            @include('menu.user')
                            @include('menu.idcard')
                            @include('menu.log')
                        @endif
                    @endif

                    @if(Auth::user()->access == 'salesman')
                        @include('menu.stock')
                    @endif
                @endif

                @if(Auth::user()->access == 'user')
                    @include('menu.dashboard')
                    @include('menu.crm')
                    @include('menu.dealer')
                @endif
                
            @endif

            @if(Auth::user()->access == 'warehouse')
                @include('menu.warehouse')
            @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
