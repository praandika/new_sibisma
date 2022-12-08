<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Delivery Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Status</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Customer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Phone</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Address</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Driver</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">PIC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Frame No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Engine No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Year MC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Qty</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->sale->stock->dealer->dealer_code }}</td>
            <td>{{ $o->sale->stock->dealer->dealer_name }}</td>
            <td>{{ $o->sale_delivery_date }}</td>
            <td>{{ ucfirst($o->status) }}</td>
            <td>{{ $o->sale->customer_name }}</td>
            <td>{{ $o->sale->phone }}</td>
            <td>{{ $o->sale->address }}</td>
            <td>{{ $o->mainDriver->name }}</td>
            <td>{{ $o->backupDriver->name }}</td>
            <td>{{ $o->sale->stock->unit->model_name }}</td>
            <td>{{ $o->sale->frame_no }}</td>
            <td>{{ $o->sale->engine_no }}</td>
            <td>{{ $o->sale->stock->unit->color->color_name }}</td>
            <td>{{ $o->sale->stock->unit->year_mc }}</td>
            <td>{{ $o->sale->sale_qty }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="15" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
