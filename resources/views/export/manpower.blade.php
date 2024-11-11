<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Gender</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Category</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Position</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Join Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Resign Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Education</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Phone</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Birthday</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Address</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Status</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">System User</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->dealer_code }}</td>
            <td>{{ $o->dealer_name }}</td>
            <td>{{ $o->name }}</td>
            <td>{{ $o->gender }}</td>
            <td>{{ $o->category }}</td>
            <td>{{ $o->position }}</td>
            <td>{{ $o->join_date }}</td>
            <td>{{ $o->resign_date }}</td>
            <td>{{ $o->education }}</td>
            <td>{{ $o->phone }}</td>
            <td>{{ $o->birthday }}</td>
            <td>{{ $o->address }}</td>
            <td>{{ $o->status }}</td>
            <td>{{ $o->user_id == 0 ? "No" : "Yes" }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="14" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
