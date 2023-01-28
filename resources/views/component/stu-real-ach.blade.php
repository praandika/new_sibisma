@section('title','STU vs Real')
@section('page-title','STU vs Real')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dashboard') }}">Dashboard </a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">STU vs Real</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">STU vs Real per {{ \Carbon\Carbon::parse($yesterday)->format('d M Y') }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>Dealer</td>
                                <th>Real</th>
                                <th>STU</th>
                                <th>vs STU</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td>Dealer</td>
                                <th>Real</th>
                                <th>STU</th>
                                <th>vs STU</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Bisma Sentral</td>
                                <td>{{ $real_01 }}</td>
                                <td>{{ $stu_01 }}</td>                                
                                <td @if($vs_01 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_01 > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_01 < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_01 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Cokro</td>
                                <td>{{ $real_02 }}</td>
                                <td>{{ $stu_02 }}</td>                                
                                <td @if($vs_02 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_02 > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_02 < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_02 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Hasanuddin</td>
                                <td>{{ $real_04 }}</td>
                                <td>{{ $stu_04 }}</td>                                
                                <td @if($vs_04 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_04 > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_04 < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_04 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma TTS</td>
                                <td>{{ $real_05 }}</td>
                                <td>{{ $stu_05 }}</td>                                
                                <td @if($vs_05 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_05 > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_05 < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_05 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Imbo</td>
                                <td>{{ $real_06 }}</td>
                                <td>{{ $stu_06 }}</td>                                
                                <td @if($vs_06 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_06 > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_06 < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_06 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Mandiri</td>
                                <td>{{ $real_07 }}</td>
                                <td>{{ $stu_07 }}</td>                                
                                <td @if($vs_07 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_07 > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_07 < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_07 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Supratman</td>
                                <td>{{ $real_08 }}</td>
                                <td>{{ $stu_08 }}</td>                                
                                <td @if($vs_08 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_08 > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_08 < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_08 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma SR</td>
                                <td>{{ $real_09 }}</td>
                                <td>{{ $stu_09 }}</td>                                
                                <td @if($vs_09 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_09 > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_09 < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_09 }} %</td>
                            </tr>
                            <tr>
                                <td>Bisma Dalung</td>
                                <td>{{ $real_0401 }}</td>
                                <td>{{ $stu_0401 }}</td>
                                <td @if($vs_0401 == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_0401 > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_0401 < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_0401 }} %</td>
                            </tr>
                            <tr>
                                <td>Flagship Shop</td>
                                <td>{{ $real_04F }}</td>
                                <td>{{ $stu_04F }}</td>
                                <td @if($vs_04F == 0)
                                    style="background-color: transparent"
                                    @elseif($vs_04F > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs_04F < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs_04F }} %</td>
                            </tr>
                            <tr>
                                <th>Bisma Group</th>
                                <th>{{ $real }}</th>
                                <th>{{ $stu }}</th>
                                <td @if($vs == 0)
                                    style="background-color: transparent"
                                    @elseif($vs > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vs < 0)
                                    style="background-color: #e81a1a50"
                                    @else
                                    style="background-color: transparent"
                                    @endif>
                                    {{ $vs }} %</td>
                            </tr>
                            <tr>
                                <th>Bisma Group + FSS</th>
                                <th>{{ $realPlus }}</th>
                                <th>{{ $stuPlus }}</th>
                                <td @if($vsPlus == 0)
                                    style="background-color: transparent"
                                    @elseif($vsPlus > 0) 
                                    style="background-color: #32a85250"
                                    @elseif($vsPlus < 0)
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
