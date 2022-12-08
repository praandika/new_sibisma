<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Delivery Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Status</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Destination</th>
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
            <td>{{ $o->out->stock->dealer->dealer_code }}</td>
            <td>{{ $o->out->stock->dealer->dealer_name }}</td>
            <td>{{ $o->out_delivery_date }}</td>
            <td>{{ ucfirst($o->status) }}</td>
            <td>{{ $o->out->dealer->dealer_name }}</td>
            <td>{{ $o->out->dealer->phone }}</td>
            <td>{{ $o->out->dealer->address }}</td>
            <td>{{ $o->mainDriver->name }}</td>
            <td>{{ $o->backupDriver->name }}</td>
            <td>{{ $o->out->stock->unit->model_name }}</td>
            <td>{{ $o->out->frame_no }}</td>
            <td>{{ $o->out->engine_no }}</td>
            <td>{{ $o->out->stock->unit->color->color_name }}</td>
            <td>{{ $o->out->stock->unit->year_mc }}</td>
            <td>{{ $o->out->out_qty }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="15" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
