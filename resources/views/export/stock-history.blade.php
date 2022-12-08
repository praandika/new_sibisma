<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">History Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">First Stock</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">In</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Out</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Sale</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Last Stock</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Faktur</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Service</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->dealer->dealer_code }}</td>
            <td>{{ $o->dealer->dealer_name }}</td>
            <td>{{ $o->history_date }}</td>
            <td>{{ $o->first_stock }}</td>
            <td>{{ $o->in_qty }}</td>
            <td>{{ $o->out_qty }}</td>
            <td>{{ $o->sale_qty }}</td>
            <td>{{ $o->last_stock }}</td>
            <td>{{ $o->faktur }}</td>
            <td>{{ $o->service }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="10" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
