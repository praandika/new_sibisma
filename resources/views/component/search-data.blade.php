@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Search')
@section('page-title','Search')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dashboard') }}">Dashboard</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Data Search</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Search "{{ $search }}"</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year MC</th>
                            <th>Dealer</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year MC</th>
                            <th>Dealer</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->model_name }}</td>
                            <td style="background-color: <?php echo $o->color_code ?>50 ;">
                            {{ $o->color_name }}</td>
                            <td>{{ $o->year_mc }}</td>
                            <td>{{ $o->dealer_name }}</td>
                            <td @if($o->qty == 0) style="background-color: maroon; color: #fff;" @endif >{{ $o->qty }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="https://wa.me/{{ $o->phone2 }}?text=_Pesan%20dari%20sibisma_%0AStok%20*{{ $o->model_name }}%20{{ $o->color_name }}*%20masih%20ada?@if($o->image == 'noimage.jpg' || $o->image == '')%0ATerimakasih @else%0ACheck%20detail:%0A%0Ahttps://sibisma.yamahabismagroup.com/public/search/{{ $o->image }} @endif" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Ask to Branch Head" style="color:green;" target="_blank"><i
                                            class="fab fa-whatsapp"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('stock.show', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Detail" style="color:orange;"><i
                                            class="fa fa-eye"></i></a>
                                    
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('search.image', $o->image) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Show Image" style="color:red;" target="_blank"><i
                                            class="fa fa-image" @if($o->image == "noimage.jpg" || $o->image == "") hidden @endif></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
