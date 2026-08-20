<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">SPK Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Sale Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">DO Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Frame No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Engine No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Year MC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">OTR</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Customer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Phone</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">NIK</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">KK</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Address</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Address Shipment</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Payment Method</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Leasing Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Microfinance</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Downpayment</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Deposit</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Discount</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Bunga</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Tenor</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Credit Status</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Pemohon</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->dealer_code }}</td>
            <td>{{ $o->dealer->dealer_name }}</td>
            <td>{{ $o->spk->spk_date }}</td>
            <td>{{ $o->sale_date }}</td>
            <td>{{ $o->spk->do_date }}</td>
            <td>{{ $o->model_name }}</td>
            <td>{{ strtoupper($o->frame_no) }}</td>
            <td>{{ strtoupper($o->engine_no) }}</td>
            <td>{{ $o->faktur_color }}</td>
            <td>{{ $o->year_mc }}</td>
            <td>{{ $o->price }}</td>
            <td>{{ $o->customer_name }}</td>
            <td>{{ $o->phone }}</td>
            <td>{{ "'" . $o->nik }}</td>
            <td>{{ "'" . $o->spk->kk_number }}</td>
            <td>{{ $o->address }}</td>
            <td>{{ $o->address_shipment }}</td>
            <td>{{ $o->payment_method }}</td>
            <td>{{ $o->leasing_name }}</td>
            <td>{{ $o->microfinance }}</td>
            <td>{{ $o->spk->downpayment }}</td>
            <td>{{ $o->spk->deposit }}</td>
            <td>{{ $o->spk->discount }}</td>
            <td>{{ $o->spk->bunga }}</td>
            <td>{{ $o->spk->tenor }}</td>
            <td>{{ $o->spk->credit_status }}</td>
            <td>{{ $o->spk->pemohon }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="27" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
