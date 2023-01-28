@section('title','Stock Ratio')
@section('page-title','Stock Ratio')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Stock Ratio</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stock Ratio Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Dealer</th>
                            <th>Entry</th>
                            <th>Total (<span style="color: green;">Sales</span> + <span style="color: crimson;">Out</span>)</th>
                            <th>Stock</th>
                            <th>Ratio</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Dealer</th>
                            <th>Entry</th>
                            <th>Total (<span style="color: green;">Sales</span> + <span style="color: crimson;">Out</span>)</th>
                            <th>Stock</th>
                            <th>Ratio</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Bisma Sentral</td>
                            <td>{{ $monthEntry_01 }}</td>
                            <td>{{ $monthSaleOut_01 }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_01 }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_01 }}</span>)
                            </td>
                            <td>{{ $stockQty_01 }}</td>
                            <td>{{ $ratio_01 }}</td>
                        </tr>
                        <tr>
                            <td>Bisma Cokro</td>
                            <td>{{ $monthEntry_02 }}</td>
                            <td>{{ $monthSaleOut_02 }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_02 }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_02 }}</span>)
                            </td>
                            <td>{{ $stockQty_02 }}</td>
                            <td>{{ $ratio_02 }}</td>
                        </tr>
                        <tr>
                            <td>Bisma Hasanuddin</td>
                            <td>{{ $monthEntry_04 }}</td>
                            <td>{{ $monthSaleOut_04 }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_04 }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_04 }}</span>)
                            </td>
                            <td>{{ $stockQty_04 }}</td>
                            <td>{{ $ratio_04 }}</td>
                        </tr>
                        <tr>
                            <td>Bisma TTS</td>
                            <td>{{ $monthEntry_05 }}</td>
                            <td>{{ $monthSaleOut_05 }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_05 }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_05 }}</span>)
                            </td>
                            <td>{{ $stockQty_05 }}</td>
                            <td>{{ $ratio_05 }}</td>
                        </tr>
                        <tr>
                            <td>Bisma Imbo</td>
                            <td>{{ $monthEntry_06 }}</td>
                            <td>{{ $monthSaleOut_06 }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_06 }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_06 }}</span>)
                            </td>
                            <td>{{ $stockQty_06 }}</td>
                            <td>{{ $ratio_06 }}</td>
                        </tr>
                        <tr>
                            <td>Bisma Mandiri</td>
                            <td>{{ $monthEntry_07 }}</td>
                            <td>{{ $monthSaleOut_07 }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_07 }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_07 }}</span>)
                            </td>
                            <td>{{ $stockQty_07 }}</td>
                            <td>{{ $ratio_07 }}</td>
                        </tr>
                        <tr>
                            <td>Bisma Supratman</td>
                            <td>{{ $monthEntry_08 }}</td>
                            <td>{{ $monthSaleOut_08 }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_08 }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_08 }}</span>)
                            </td>
                            <td>{{ $stockQty_08 }}</td>
                            <td>{{ $ratio_08 }}</td>
                        </tr>
                        <tr>
                            <td>Bisma SR</td>
                            <td>{{ $monthEntry_09 }}</td>
                            <td>{{ $monthSaleOut_09 }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_09 }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_09 }}</span>)
                            </td>
                            <td>{{ $stockQty_09 }}</td>
                            <td>{{ $ratio_09 }}</td>
                        </tr>
                        <tr>
                            <td>Bisma Dalung</td>
                            <td>{{ $monthEntry_0401 }}</td>
                            <td>{{ $monthSaleOut_0401 }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_0401 }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_0401 }}</span>)
                            </td>
                            <td>{{ $stockQty_0401 }}</td>
                            <td>{{ $ratio_0401 }}</td>
                        </tr>
                        <tr>
                            <td>Flagship Shop</td>
                            <td>{{ $monthEntry_04F }}</td>
                            <td>{{ $monthSaleOut_04F }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales_04F }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut_04F }}</span>)
                            </td>
                            <td>{{ $stockQty_04F }}</td>
                            <td>{{ $ratio_04F }}</td>
                        </tr>
                        <tr>
                            <th>Bisma Group</th>
                            <th>{{ $monthEntry }}</th>
                            <th>{{ $monthSaleOut }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSales }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOut }}</span>)
                            </th>
                            <th>{{ $stockQty }}</th>
                            <th>{{ $ratio }}</th>
                        </tr>
                        <tr>
                            <th>Bisma Group + FSS</th>
                            <th>{{ $monthEntryPlus }}</th>
                            <th>{{ $monthSaleOutPlus }}
                                &nbsp;
                                (<span style="color: green;">{{ $monthSalesPlus }}</span>
                                +
                                <span style="color: crimson;">{{ $monthOutPlus }}</span>)
                            </th>
                            <th>{{ $stockQtyPlus }}</th>
                            <th>{{ $ratioPlus }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
