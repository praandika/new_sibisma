<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">User ID</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Username</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Email</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Access</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Activity</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Timestamps</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $o)
        <tr>
            <td>{{ $o->log_date }}</td>
            <td>{{ $o->user_id }}</td>
            <td>{{ $o->user->username }}</td>
            <td>{{ $o->user->name }}</td>
            <td>{{ $o->user->email }}</td>
            <td>{{ $o->user->dealer_code }}</td>
            <td>{{ $o->user->access }}</td>
            <td>{{ $o->activity }}</td>
            <td>{{ $o->created_at }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="9" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
