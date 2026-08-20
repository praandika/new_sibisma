<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Delivery Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Sale Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">SPK Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Customer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Phone</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Address</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Address Shipment</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Delivery Type</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Driver</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Backup Driver</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Frame No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Engine No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Year MC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Payment Method</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Salesman</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Notes</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->dealer_code }}</td>

            <td>{{ $o->dealer->dealer_name }}</td>
            <td>{{ $o->do_date }}</td>
            <td>{{ $o->sale->sale_date }}</td>
            <td>{{ $o->spk->spk_date }}</td>
            <td>{{ $o->sale->customer_name }}</td>
            <td>{{ $o->sale->phone }}</td>
            <td>{{ $o->sale->address }}</td>
            <td>{{ $o->sale->address_shipment }}</td>
            <td>{{ $o->self_pickup == 1 ? 'Self Pickup' : 'Dealer Delivery' }}</td>
            <td>{{ $o->driver_name }}</td>
            <td>{{ $o->backup_driver }}</td>
            <td>{{ $o->sale->model_name }}</td>
            <td>{{ $o->sale->frame_no }}</td>
            <td>{{ $o->sale->engine_no }}</td>
            <td>{{ $o->sale->faktur_color }}</td>
            <td>{{ $o->sale->year_mc }}</td>
            <td>{{ $o->sale->payment_method }}</td>
            <td>{{ $o->sale->manpower }}</td>
            <td>{{ $o->notes }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="20" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
