<li class="nav-item {{ Route::is('contactlist.*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#crm">
        <i class="fas fa-headset"></i>
        <p>CRM</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('contactlist.*') ? 'show' : '' }}" id="crm">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('contactlist.index') ? 'active' : '' }}">
                <a href="{{ route('contactlist.index') }}">
                    <span class="sub-item">Contact List Helper</span>
                </a>
            </li>
            <li class="{{ Route::is('contactlist.report') ? 'active' : '' }}">
                <a href="{{ route('contactlist.report') }}">
                    <span class="sub-item">Follow Up Report</span>
                </a>
            </li>
        </ul>
    </div>
</li>
