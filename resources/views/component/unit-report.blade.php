@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Unit Report')
@section('page-title','Unit Report')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('report.unit') }}">Unit Report</a>
</li>
@endpush

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma Sentral</h4>
        </div>
        <div class="card-body">
            <table>
                <thead>
                @foreach($sentralYearMC as $key => $value)
                    <tr>
                        <td>{{ $key }} : {{ $value }} </td>
                    </tr>
                @endforeach
                </thead>
            </table>
            
        </div>
    </div>
</div>
