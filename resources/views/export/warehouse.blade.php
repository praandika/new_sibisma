<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">In Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Year MC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Engine No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Frame No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Status</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Out Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Gudang</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">PIC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Note</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->dealer_code }}</td>
            <td>{{ $o->code }}</td>
            <td>{{ $o->in_date }}</td>
            <td>{{ $o->model_name }}</td>
            <td>{{ $o->color_name }}</td>
            <td>{{ $o->year_mc }}</td>
            <td>{{ $o->engine_no }}</td>
            <td>{{ $o->frame_no }}</td>
            <td>{{ $o->status }}</td>
            <td>{{ $o->out_date }}</td>
            <td>{{ $o->gudang }}</td>
            <td>{{ $o->pic }}</td>
            <td>{{ $o->note }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="13" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
