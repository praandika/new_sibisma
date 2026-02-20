<li class="nav-item {{ Route::is('promotion.*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#promotion">
        <i class="fas fa-map"></i>
        <p>Promotion</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('promotion.*') || Route::is('activities.*') || Route::is('proposal.*') ? 'show' : '' }}" id="promotion">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('activities.*') ? 'active' : '' }}">
                <a href="{{ route('activities.index') }}">
                    <span class="sub-item">Activities</span>
                </a>
            </li>
            <li class="{{ Route::is('proposal.*') ? 'active' : '' }}">
                <a href="{{ route('proposal.index') }}"> 
                    <span class="sub-item">Proposal</span>
                </a>
            </li>
        </ul>
    </div>
</li>