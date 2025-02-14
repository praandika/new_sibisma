<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;" width="100">Link Code</th>
        </tr>
    </thead>
    <tbody>
        @php($no = 1)
        @forelse($data as $code)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $code }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>
