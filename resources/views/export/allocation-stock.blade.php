<table>
    <thead>
        <tr>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Model Name</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Color</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Frame No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Engine No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Faktur No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">NIK No</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Received</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Allocation Date</th>
            <th style="color: white; background-color: #0f5abc; font-weight: bold;">Dealer Code</th>
        </tr>
    </thead>
    <tbody>
        @php($no = 1)
        @forelse($data as $o)
        <tr>
            <td>{{ $no ++ }}</td>
            <td>{{ $o->model }}</td>
            <td>{{ $o->model_name }}</td>
            <td>{{ $o->color }}</td>
            <td>{{ $o->frame_no }}</td>
            <td>{{ $o->engine_no }}</td>
            <td>{{ $o->faktur_no }}</td>
            <td>{{ $o->nik_no }}</td>
            <td>{{ $o->received }}</td>
            <td>{{ $o->allocation_date }}</td>
            <td>{{ $o->dealer_code }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="12" style="text-align: center;">No data available</td>
        </tr>
        @endforelse
    </tbody>
</table>