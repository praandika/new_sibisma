<li class="nav-item {{ Route::is('specification.*') || Route::is('sparepart.*') || Route::is('jobvacancy.*') || Route::is('about.*') || Route::is('banner.*') ? 'show' : '' }}">
    <a data-toggle="collapse" href="#dataWebsite">
        <i class="fas fa-globe"></i>
        <p>Data Website</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('specification.*') || Route::is('sparepart.*') || Route::is('jobvacancy.*') || Route::is('about.*') || Route::is('banner.*') ? 'show' : '' }}" id="dataWebsite">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('banner.index') ? 'active' : '' }}">
                <a href="{{ route('banner.index') }}">
                    <span class="sub-item">Data Banner</span>
                </a>
            </li>
            <li class="{{ Route::is('sparepart.index') ? 'active' : '' }}">
                <a href="{{ route('sparepart.index') }}">
                    <span class="sub-item">Data Sparepart</span>
                </a>
            </li>
            <li class="{{ Route::is('specification.index') ? 'active' : '' }}">
                <a href="{{ route('specification.index') }}">
                    <span class="sub-item">Data Specification</span>
                </a>
            </li>
            <li class="{{ Route::is('jobvacancy.index') ? 'active' : '' }}">
                <a href="{{ route('jobvacancy.index') }}">
                    <span class="sub-item">Data Job Vacancy</span>
                </a>
            </li>
            <li class="{{ Route::is('about.index') ? 'active' : '' }}">
                <a href="{{ route('about.index') }}">
                    <span class="sub-item">Data About Us</span>
                </a>
            </li>
        </ul>
    </div>
</li>
