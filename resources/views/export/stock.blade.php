<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Category</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Year MC</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Qty</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Price</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->dealer->dealer_code }}</td>
            <td>{{ $o->dealer->dealer_name }}</td>
            <td>{{ $o->unit->model_name }}</td>
            <td>{{ $o->unit->color->color_name }}</td>
            <td>{{ $o->unit->category }}</td>
            <td>{{ $o->unit->year_mc }}</td>
            <td>{{ $o->qty }}</td>
            <td>{{ $o->unit->price }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
