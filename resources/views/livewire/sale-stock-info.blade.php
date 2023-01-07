<!-- Sale Stock Info container -->
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Sales Stock Info</h5>
            <div class="card-category">Bisma Group</div>
        </div>
        <div class="card-body">
            <table>
                @foreach($data as $o)
                    <tr>
                        <td> {{ $o->history_date }} | {{ $o->dealer->dealer_name }} = {{ $o->sale_qty }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
