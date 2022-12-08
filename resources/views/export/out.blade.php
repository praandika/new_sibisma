<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Out Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Frame No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Engine No.</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Year MC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Destination</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Qty</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->stock->dealer->dealer_code }}</td>
            <td>{{ $o->stock->dealer->dealer_name }}</td>
            <td>{{ $o->out_date }}</td>
            <td>{{ $o->stock->unit->model_name }}</td>
            <td>{{ $o->frame_no }}</td>
            <td>{{ $o->engine_no }}</td>
            <td>{{ $o->stock->unit->color->color_name }}</td>
            <td>{{ $o->stock->unit->year_mc }}</td>
            <td>{{ $o->dealer->dealer_name }}</td>
            <td>{{ $o->out_qty }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="10" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
