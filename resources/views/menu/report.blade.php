<li class="nav-item 
    @if(Auth::user()->access != 'owner') 
        {{ Route::is('report.*') || Route::is('stock-history.edit') || Route::is('stu.*') || Route::is('kwitansi.*') || Route::is('do-kwitansi.leasing') ? 'active' : '' }}
    @else
        {{ Route::is('report.*') || Route::is('stock-history.edit') || Route::is('sale.history') || Route::is('entry.history') || Route::is('out.history') ? 'active' : '' }}
    @endif">
    <a data-toggle="collapse" href="#report">
        <i class="fas fa-file-alt"></i>
        <p>Report</p>
        <span class="caret"></span>
    </a>
    <div class="collapse 
    @if(Auth::user()->access != 'owner') 
        {{ Route::is('report.*') || Route::is('stock-history.edit') || Route::is('stu.*') || Route::is('kwitansi.*') || Route::is('do-kwitansi.leasing') ? 'show' : '' }}
    @else
        {{ Route::is('report.*') || Route::is('stock-history.edit') || Route::is('sale.history') || Route::is('entry.history') || Route::is('out.history') ? 'show' : '' }}
    @endif" id="report">
        <ul class="nav nav-collapse">
            @if(Auth::user()->access == 'owner')
            <li class="{{ Route::is('sale.history') ? 'active' : '' }}">
                <a href="{{ route('sale.history') }}">
                    <span class="sub-item">Sales Report</span>
                </a>
            </li>

            <li class="{{ Route::is('entry.history') ? 'active' : '' }}">
                <a href="{{ route('entry.history') }}">
                    <span class="sub-item">Entries Report</span>
                </a>
            </li>

            <li class="{{ Route::is('out.history') ? 'active' : '' }}">
                <a href="{{ route('out.history') }}">
                    <span class="sub-item">Unit Out Report</span>
                </a>
            </li>
            @endif

            <li class="{{ Route::is('report.stock-history') ? 'active' : '' }}">
                <a href="{{ route('report.stock-history') }}">
                    <span class="sub-item">Stock History</span>
                </a>
            </li>

            <li class="{{ Route::is('report.send-report') || Route::is('stock-history.edit') || Route::is('report.send-group')? 'active' : '' }}">
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

            <li class="{{ Route::is('kwitansi.index') ? 'active' : '' }}" @if(Auth::user()->crud == 'simple') hidden @endif>
                <a href="{{ route('kwitansi.index') }}">
                    <span class="sub-item">Kwitansi</span>
                </a>
            </li>

            <li class="{{ Route::is('do-kwitansi.leasing') ? 'active' : '' }}" @if(Auth::user()->crud == 'simple') hidden @endif>
                <a href="{{ route('do-kwitansi.leasing') }}">
                    <span class="sub-item">Leasing</span>
                </a>
            </li>

            @if(Auth::user()->dealer_code == 'group')
            <li class="{{ Route::is('stu.index') ? 'active' : '' }}">
                <a href="{{ route('stu.index') }}">
                    <span class="sub-item">Input STU</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</li>
