@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Report Allocation')
@section('page-title','Report Allocation')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('allocation.report') }}">Data Report Allocation</a>
</li>
<li class="separator">
    <i class="flaticon-right-arrow"></i>
</li>
<li class="nav-item">
    <a href="#">Report Allocation</a>
</li>
@endpush

<div class="col-sm-6 col-md-4">
    <div class="card card-stats card-round" style="background-color: #519259; color: white;">
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                </div>
                <div class="col-7 col-stats">
                    <div class="numbers">
                        <p class="card-category" style="color: white;">Entry</p>
                        <h4 class="card-title" style="color: white;">{{ number_format($entry,0) }} Units</h4>
                        <p class="card-category" style="color: white; font-size: 12px;">
                            {{ \Carbon\Carbon::parse($today)->isoFormat('MMMM YYYY') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="card card-stats card-round" style="background-color: #B91646; color: white;">
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="col-7 col-stats">
                    <div class="numbers">
                        <p class="card-category" style="color: white;">Sold</p>
                        <h4 class="card-title" style="color: white;">{{ number_format($sold,0) }} Units</h4>
                        <p class="card-category" style="color: white; font-size: 12px;">
                            {{ \Carbon\Carbon::parse($today)->isoFormat('MMMM YYYY') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="card card-stats card-round" style="background-color: #133E87; color: white;">
        <div class="card-body ">
            <div class="row">
                <div class="col-5">
                    <div class="icon-big text-center">
                        <i class="fas fa-warehouse"></i>
                    </div>
                </div>
                <div class="col-7 col-stats">
                    <div class="numbers">
                        <p class="card-category" style="color: white;">In Stock</p>
                        <h4 class="card-title" style="color: white;">{{ number_format($stock,0) }} Units</h4>
                        <p class="card-category" style="color: white; font-size: 12px;">
                            {{ \Carbon\Carbon::parse($today)->isoFormat('MMMM YYYY') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('component.search-box')

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Stock Ratio</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="stockRatio"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Most Stock</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="mostStock" style="width: 50%; height: 50%"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Allocation Activity</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="allocationActivity"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Allocation Sold</div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="sold"></canvas>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<!-- Chart JS -->
<script src="{{ asset('js/chart.min.js') }}"></script>

<script>
    // Pass PHP data to JavaScript
    let chartStockRatio = @json($chartStockRatio);
    let chartMostStock = @json($chartMostStock);
    let chartSold = @json($chartSold);

    let stockRatio = document.getElementById('stockRatio').getContext('2d');
    let mostStock = document.getElementById('mostStock').getContext('2d');
    let allocationActivity = document.getElementById('allocationActivity').getContext('2d');
    let sold = document.getElementById('sold').getContext('2d');

    let mystockRatio = new Chart(stockRatio, {
        type: 'bar',
        data: {
            labels: chartStockRatio.labels,
            datasets: [{
                label: "Ratio",
                borderColor: "#d68c0b",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#d68c0b",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: chartStockRatio.ratio,
                type: 'line',
            }, {
                label: "Entry",
                borderColor: "#519259",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#519259",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: '#519259',
                fill: true,
                borderWidth: 2,
                data: chartStockRatio.entry
            }, {
                label: "Sold",
                borderColor: "#B91646",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#B91646",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: '#B91646',
                fill: true,
                borderWidth: 2,
                data: chartStockRatio.sold
            }, {
                label: "Stock",
                borderColor: "#133E87",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#133E87",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: '#133E87',
                fill: true,
                borderWidth: 2,
                data: chartStockRatio.instock
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'top',
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            layout: {
                padding: {
                    left: 15,
                    right: 15,
                    top: 15,
                    bottom: 15
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        color: '#e8e8e8', // Change gridline color
                        lineWidth: 0, // Adjust gridline thickness
                        drawOnChartArea: true, // Show gridlines in the chart area
                        drawTicks: true, // Show gridline ticks
                        zeroLineColor: '#e8e8e8', // Change zero-line color
                        zeroLineWidth: 3 // Adjust zero-line thickness
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: 'transparent', // Change gridline color
                        lineWidth: 1, // Adjust gridline thickness
                        drawOnChartArea: false, // Disable gridlines in the chart area
                        drawTicks: true, // Show gridline ticks
                        zeroLineColor: 'transparent', // Change zero-line color
                        zeroLineWidth: 2 // Adjust zero-line thickness
                    }
                }]
            }
        }
    });

    var myMostStock = new Chart(mostStock, {
        type: 'pie',
        data: {
            datasets: [{
                data: chartMostStock.data,
                backgroundColor: ["#A02334", "#FFAD60", "#F0DBAF", "#96CEB4", "#2C4E80"],
                borderWidth: 0
            }],
            labels: chartMostStock.labels
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    fontColor: 'rgb(154, 154, 154)',
                    fontSize: 11,
                    usePointStyle: true,
                    padding: 20
                }
            },
            pieceLabel: {
                render: 'percentage',
                fontColor: 'white',
                fontSize: 14,
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    })

    var myallocationActivity = new Chart(allocationActivity, {
        type: 'bar',
        data: {
            labels: chartStockRatio.labels,
            datasets: [{
                label: "Stock",
                backgroundColor: '#133E87',
                borderColor: '#133E87',
                data: chartStockRatio.instock,
            }, {
                label: "Entry",
                backgroundColor: '#96CEB4',
                borderColor: '#96CEB4',
                data: chartStockRatio.entry,
            }, {
                label: "Sold",
                backgroundColor: '#B91646',
                borderColor: '#B91646',
                data: chartStockRatio.sold,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Traffic Stats'
            },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            responsive: true,
            scales: {
                xAxes: [{
                    stacked: true,
                    gridLines: {
                        color: '#e8e8e8', // Change gridline color
                        lineWidth: 0, // Adjust gridline thickness
                        drawOnChartArea: true, // Show gridlines in the chart area
                        drawTicks: true, // Show gridline ticks
                        zeroLineColor: '#e8e8e8', // Change zero-line color
                        zeroLineWidth: 3 // Adjust zero-line thickness
                    }
                }],
                yAxes: [{
                    stacked: true,
                    gridLines: {
                        color: 'transparent', // Change gridline color
                        lineWidth: 1, // Adjust gridline thickness
                        drawOnChartArea: false, // Disable gridlines in the chart area
                        drawTicks: true, // Show gridline ticks
                        zeroLineColor: 'transparent', // Change zero-line color
                        zeroLineWidth: 2 // Adjust zero-line thickness
                    }
                }]
            }
        }
    });

    var mySold = new Chart(sold, {
        type: 'line',
        data: {
            labels: chartStockRatio.labels,
            datasets: [{
                label: chartSold.year1,
                borderColor: "#1d7af3",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#1d7af3",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: chartSold.data1
            }, {
                label: chartSold.year2,
                borderColor: "#59d05d",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#59d05d",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: chartSold.data2
            }, {
                label: chartSold.year3,
                borderColor: "#f3545d",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#f3545d",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: chartSold.data3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'top',
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            layout: {
                padding: {
                    left: 15,
                    right: 15,
                    top: 15,
                    bottom: 15
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        color: '#e8e8e8', // Change gridline color
                        lineWidth: 0, // Adjust gridline thickness
                        drawOnChartArea: true, // Show gridlines in the chart area
                        drawTicks: true, // Show gridline ticks
                        zeroLineColor: '#e8e8e8', // Change zero-line color
                        zeroLineWidth: 3 // Adjust zero-line thickness
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: 'transparent', // Change gridline color
                        lineWidth: 1, // Adjust gridline thickness
                        drawOnChartArea: false, // Disable gridlines in the chart area
                        drawTicks: true, // Show gridline ticks
                        zeroLineColor: 'transparent', // Change zero-line color
                        zeroLineWidth: 2 // Adjust zero-line thickness
                    }
                }]
            }
        }
    });

</script>
@endpush
