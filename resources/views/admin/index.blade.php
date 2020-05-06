@extends('admin.templates.layout')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$users->count()}}</h3>

                <p>Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$posts->count()}}</h3>

                <p>Posts</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$categories->count()}}</h3>

                <p>Categories</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    <section class="col-lg-12 connectedSortable">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Post Statistics</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.row (main row) -->
@endsection

@push('scripts')
<script>
    var jan = {{ App\Post::whereMonth('created_at', 1)->count() }};
    var feb = {{ App\Post::whereMonth('created_at', 2)->count() }};
    var mar = {{ App\Post::whereMonth('created_at', 3)->count() }};
    var apr = {{ App\Post::whereMonth('created_at', 4)->count() }};
    var mei = {{ App\Post::whereMonth('created_at', 5)->count() }};
    var jun = {{ App\Post::whereMonth('created_at', 6)->count() }};
    var jul = {{ App\Post::whereMonth('created_at', 7)->count() }};
    var aug = {{ App\Post::whereMonth('created_at', 8)->count() }};
    var sept = {{ App\Post::whereMonth('created_at', 9)->count() }};
    var oct = {{ App\Post::whereMonth('created_at', 10)->count() }};
    var nov = {{ App\Post::whereMonth('created_at', 11)->count() }};
    var dec = {{ App\Post::whereMonth('created_at', 12)->count() }};
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Posts per month',
            data: [jan, feb, mar, apr, mei, jun, jul, aug, sept, oct, nov, dec],
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<script>
    
    // (function ($) {
    //     'use strict'
    //     var areaChartData = {
    //         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    //         datasets: [{
    //                 label: 'Posts',
    //                 backgroundColor: 'rgba(60,141,188,0.9)',
    //                 borderColor: 'rgba(60,141,188,0.8)',
    //                 pointRadius: false,
    //                 pointColor: '#3b8bba',
    //                 pointStrokeColor: 'rgba(60,141,188,1)',
    //                 pointHighlightFill: '#fff',
    //                 pointHighlightStroke: 'rgba(60,141,188,1)',
    //                 data: [jan, feb, mar, apr, mei, jun, jul, aug, sept, oct, nov, dec]
    //             }
    //         ]
    //     }
    //     //-------------
    //     //- BAR CHART -
    //     //-------------
    //     var barChartCanvas = $('#barChart').get(0).getContext('2d')
    //     var barChartData = jQuery.extend(true, {}, areaChartData)
    //     var temp0 = areaChartData.datasets[0]
    //     barChartData.datasets[0] = temp1

    //     var barChartOptions = {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         datasetFill: false
    //     }

    //     var barChart = new Chart(barChartCanvas, {
    //         type: 'bar',
    //         data: barChartData,
    //         options: barChartOptions
    //     })
    // })(jQuery)

</script>
@endpush
