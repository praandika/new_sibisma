<li class="nav-item {{ Route::is('report.*') || Route::is('stock-history.edit') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#report">
        <i class="fas fa-file-alt"></i>
        <p>Report</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('report.*') || Route::is('stock-history.edit') ? 'show' : '' }}" id="report">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('report.stock-history') ? 'active' : '' }}">
                <a href="{{ route('report.stock-history') }}">
                    <span class="sub-item">Stock History</span>
                </a>
            </li>
            <li class="{{ Route::is('report.send-report') || Route::is('stock-history.edit') ? 'active' : '' }}">
                <a
                    href="{{ Auth::user()->dealer_code == 'group' ? url('report/group/all') : route('report.send-report') }}">
                    <span class="sub-item">Send Report</span>
                </a>
            </li>
            @if(Auth::user()->dealer_code == 'group')
            <li class="{{ Route::is('report.search-id') ? 'active' : '' }}">
                <a href="{{ route('report.search-id') }}">
                    <span class="sub-item">Search Report</span>
                </a>
            </li>
            @endif
            <li class="{{ Route::is('report.adjust') ? 'active' : '' }}">
                <a href="{{ route('report.adjust') }}">
                    <span class="sub-item">Adjust Report</span>
                </a>
            </li>
            <li class="{{ Route::is('report.unit') ? 'active' : '' }}">
                <a href="{{ route('report.unit') }}">
                    <span class="sub-item">Unit Report</span>
                </a>
            </li>
        </ul>
    </div>
</li>
