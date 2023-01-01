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
            @foreach($sentralYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($sentral as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma Cokro</h4>
        </div>
        <div class="card-body">
            @foreach($cokroYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($cokro as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma Hasanuddin</h4>
        </div>
        <div class="card-body">
            @foreach($udbismaYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($udbisma as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma TTS</h4>
        </div>
        <div class="card-body">
            @foreach($ttsYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($tts as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma Imbo</h4>
        </div>
        <div class="card-body">
            @foreach($imboYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($imbo as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma Mandiri</h4>
        </div>
        <div class="card-body">
            @foreach($mandiriYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($mandiri as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma Supratman</h4>
        </div>
        <div class="card-body">
            @foreach($supratmanYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($supratman as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma Sunset Road</h4>
        </div>
        <div class="card-body">
            @foreach($sunsetYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($sunset as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma Dalung</h4>
        </div>
        <div class="card-body">
            @foreach($dalungYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($dalung as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-info-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma FSS</h4>
        </div>
        <div class="card-body">
            @foreach($fssYearMC as $tahun => $total)
            <span class="badge badge-dark" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #cf0257; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($fss as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card">
        <div class="card-header bg-dark-gradient skew-shadow">
            <h4 class="card-title" style="color: #fff;">Bisma Group</h4>
        </div>
        <div class="card-body">
            @foreach($groupYearMC as $tahun => $total)
            <span class="badge badge-secondary" style="border-radius: 0 0 0 5px;
                                -moz-transform: skew(-15deg, 0deg);
                                -webkit-transform: skew(-15deg, 0deg);
                                -o-transform: skew(-15deg, 0deg);
                                -ms-transform: skew(-15deg, 0deg);
                                transform: skew(-15deg, 0deg);">
                <strong>{{ $tahun }}</strong>
                &nbsp;
                <span style="background-color: #371B58; padding: 5px; margin-right: -11px;">
                    <strong>{{ $total }}</strong>
                    &nbsp;
                </span>
            </span>
            &nbsp;&nbsp;
            @endforeach
            <hr>
            <table>
                @foreach($group as $o)
                    <tr>
                        <td><span style="width: 3px; height: 3px; display: inline-block; background-color: <?php echo $o->unit->color->color_code ?>;"></span> {{ $o->qty }} | {{ $o->unit->model_name }} | {{ $o->unit->color->color_name }} | {{ $o->unit->year_mc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
