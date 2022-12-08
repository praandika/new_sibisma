@section('title','Sales Achievement')
@section('page-title','Sales Achievement')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dashboard') }}">Dashboard </a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Sales Achievement</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sales Achievement Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>Dealer</td>
                                <th>Last @if($param == 'lm') Month @else Year @endif</th>
                                <th>This @if($param == 'lm') Month @else Year @endif</th>
                                <th>vs @if($param == 'lm') LM @else LY @endif</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td>Dealer</td>
                                <th>Last @if($param == 'lm') Month @else Year @endif</th>
                                <th>This @if($param == 'lm') Month @else Year @endif</th>
                                <th>vs @if($param == 'lm') LM @else LY @endif</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Bisma Sentral</td>
                                <td>{{ $last_01 }}</td>
                                <td>{{ $data_01 }}</td>
                                <td @if($vs_01 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_01 > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_01 < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_01 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Cokro</td>
                                <td>{{ $last_02 }}</td>
                                <td>{{ $data_02 }}</td>
                                <td @if($vs_02 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_02 > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_02 < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_02 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Hasanuddin</td>
                                <td>{{ $last_04 }}</td>
                                <td>{{ $data_04 }}</td>
                                <td @if($vs_04 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_04 > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_04 < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_04 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma TTS</td>
                                <td>{{ $last_05 }}</td>
                                <td>{{ $data_05 }}</td>
                                <td @if($vs_05 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_05 > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_05 < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_05 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Imbo</td>
                                <td>{{ $last_06 }}</td>
                                <td>{{ $data_06 }}</td>
                                <td @if($vs_06 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_06 > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_06 < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_06 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Mandiri</td>
                                <td>{{ $last_07 }}</td>
                                <td>{{ $data_07 }}</td>
                                <td @if($vs_07 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_07 > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_07 < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_07 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Supratman</td>
                                <td>{{ $last_08 }}</td>
                                <td>{{ $data_08 }}</td>
                                <td @if($vs_08 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_08 > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_08 < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_08 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma SR</td>
                                <td>{{ $last_09 }}</td>
                                <td>{{ $data_09 }}</td>
                                <td @if($vs_09 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_09 > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_09 < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_09 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Dalung</td>
                                <td>{{ $last_0401 }}</td>
                                <td>{{ $data_0401 }}</td>
                                <td @if($vs_0401 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_0401 > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_0401 < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_0401 }} %</td>
                            </tr>
                            <tr>
                                <td>Flagship Shop</td>
                                <td>{{ $last_04F }}</td>
                                <td>{{ $data_04F }}</td>
                                <td @if($vs_04F == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_04F > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_04F < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_04F }} %</td>
                            </tr>
                            <tr>
                                <th>Bisma Group</th>
                                <th>{{ $last }}</th>
                                <th>{{ $data }}</th>
                                <td @if($vs == 0)
                                    style="background-color: transparent"
                                    @elseif($vs > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vs < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs }} %</td>
                            </tr>
                            <tr>
                                <th>Bisma Group + FSS</th>
                                <th>{{ $lastPlus }}</th>
                                <th>{{ $dataPlus }}</th>
                                <td @if($vsPlus == 0)
                                    style="background-color: transparent"
                                    @elseif($vsPlus > 100) 
                                    style="background-color: #32a85250"
                                    @elseif($vsPlus < 100)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vsPlus }} %</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
