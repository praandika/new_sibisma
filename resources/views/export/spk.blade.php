<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Payment Method</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Credit Status</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Order Status</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Sale Status</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">SPK No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Order Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">STNK Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Customer Phone</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Customer Address</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Unit</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Leasing</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Down Payment</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Discount</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Payment</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Salesman</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Description</th>
        </tr>
    </thead>
    <tbody>
        @php($no = 1)
        @forelse($data as $o)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $o->stock->dealer->dealer_code }}</td>
            <td>{{ $o->stock->dealer->dealer_name }}</td>
            <td>{{ $o->spk_date }}</td>
            <td>{{ $o->payment_method }}</td>
            <td>{{ $o->credit_status }}</td>
            <td>{{ $o->order_status }}</td>
            <td>{{ $o->sale_status }}</td>
            <td>{{ $o->spk_no }}</td>
            <td>{{ $o->order_name }}</td>
            <td>{{ $o->stnk_name }}</td>
            <td>{{ $o->spk_phone }}</td>
            <td>{{ $o->customer_address }}</td>
            <td>{{ $o->stock->unit->model_name }}</td>
            <td>{{ $o->stock->unit->color->color_name }}</td>
            <td>{{ $o->leasing->leasing_name }}</td>
            <td>Rp {{ number_format($o->downpayment, 0, ',','.') }}</td>
            <td>Rp {{ number_format($o->discount, 0, ',','.') }}</td>
            <td>Rp {{ number_format($o->payment, 0, ',','.') }}</td>
            <td>{{ $o->manpower->name }}</td>
            <td>{{ $o->description }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="21" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
