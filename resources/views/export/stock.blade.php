<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Mutation Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Mutation Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Year MC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Price</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Frame No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Engine No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Receive Time</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Assembly Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Info</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Status</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Location</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->dealer_code }}</td>
            <td>{{ $o->dealer->dealer_name }}</td>
            <td>{{ $o->point_code }}</td>
            <td>{{ $o->point->dealer_name }}</td>
            <td>{{ $o->model_name }}</td>
            <td>{{ $o->faktur_color }}</td>
            <td>{{ $o->year_mc }}</td>
            <td>{{ $o->price }}</td>
            <td>{{ $o->frame_no }}</td>
            <td>{{ $o->engine_no }}</td>
            <td>{{ $o->receive_time }}</td>
            <td>{{ $o->assembly_date }}</td>
            <td>{{ $o->info }}</td>
            <td>{{ $o->status }}</td>
            <td>{{ $o->location }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="15" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
