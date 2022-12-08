<!-- Notification -->
<li class="nav-item dropdown hidden-caret">
    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        @if($count > 0)
        <span class="notification">{{ $count }}</span>
        @endif
    </a>
    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
        @if(Auth::user()->dealer_code == 'group')
            @forelse($data as $o)
            <li>
                <div class="notif-scroll scrollbar-outer">
                    <div class="notif-center">
                        <a href="{{ route('stock-history.edit',$o->id) }}">
                            <div class="notif-img">
                                <img src="{{ asset('img/icon-warning.png') }}" alt="Img Profile">
                            </div>
                            <div class="notif-content">
                                <span class="block">
                                    {{ $o->dealer_code }} Fill in Faktur & Service !
                                </span>
                                <span class="time">{{ $o->history_date }}</span>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            @empty
            <li>
                <div class="notif-scroll scrollbar-outer">
                    <div class="notif-center">
                        <a href="#">
                            <div class="notif-img">
                                <img src="{{ asset('img/icon-ok.png') }}" alt="Img Profile">
                            </div>
                            <div class="notif-content">
                                <span class="block">
                                    All is up to date
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            @endforelse
        @else
        <li>
            <div class="dropdown-title">Notification</div>
        </li>
            @forelse($data as $o)
            <li>
                <div class="notif-scroll scrollbar-outer">
                    <div class="notif-center">
                        <a href="{{ route('stock-history.edit',$o->id) }}">
                            <div class="notif-img">
                                <img src="{{ asset('img/icon-warning.png') }}" alt="Img Profile">
                            </div>
                            <div class="notif-content">
                                <span class="block">
                                    Fill in Faktur & Service !
                                </span>
                                <span class="time">{{ $o->history_date }}</span>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            @empty
            <li>
                <div class="notif-scroll scrollbar-outer">
                    <div class="notif-center">
                        <a href="#">
                            <div class="notif-img">
                                <img src="{{ asset('img/icon-ok.png') }}" alt="Img Profile">
                            </div>
                            <div class="notif-content">
                                <span class="block">
                                    All is up to date
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            @endforelse
        @endif
    </ul>
</li>
<!-- END Notification -->
