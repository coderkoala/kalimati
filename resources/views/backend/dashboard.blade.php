@extends('backend.layouts.app')

@section('title', appName() . ' | ' . __('Dashboard'))

@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info h-100">
                <div class="card-body pb-0">
                    <i class="fa fa-bold fa-3x"></i>
                    <div><a class="text-white"
                            href="{{ route('admin.commodities.index') }}"><br>{{ __('Registered Commodities') }}</a>
                    </div>
                    <div class="text-value pt-3">{{ \App\Models\Backend\Commodities::count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-stack-overflow h-100">
                <div class="card-body pb-0">
                    <i class="fa fa-truck-loading fa-3x"></i>
                    <div><a class="text-white"
                            href="{{ route('admin.traderdues.index') }}"><br>{{ __('Active Trader Dues') }}</a></div>
                    <div class="text-value pt-3">{{ __idf(\App\Models\Backend\TraderDues::count(), false) }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body pb-0">
                    <i class="fa fa-newspaper fa-3x"></i>
                    <div class="text-black"><a class="text-white"
                            href="{{ route('admin.articles.index') }}"><br>{{ __('Articles Pending Approval') }}</a>
                    </div>
                    <div class="text-value pt-3">
                        {{ __idf(\App\Models\Backend\Articles::where('status', 'draft')->count(), false) }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body pb-0">
                    <i class="fa fa-paperclip fa-3x"></i>
                    <div><a class="text-white"
                            href="{{ route('admin.traderduespayment.index') }}"><br>{{ 'Completed Payments' }}</a>
                    </div>
                    <div class="text-value pt-3">
                        {{ __idf(\App\Models\Backend\TraderDuesPayment::where('status', 'verified')->count(), false) }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>{{ __('Website Hit sources') }}</b> | {{ __idf($date[0], false) }} {{ __('to') }}
                    {{ __idf(end($date), false) }}
                </div>
                <div class="card-body">
                    <div class="container">
                        <canvas id="hits"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>{{ __('Visitor Types') }}</b> | {{ __idf($date[0], false) }} {{ __('to') }}
                    {{ __idf(end($date), false) }}
                </div>
                <div class="card-body">
                    <div class="container">
                        <canvas id="type"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>{{ __('Page Views Report') }}</b> | {{ __idf($date[0], false) }} {{ __('to') }}
                    {{ __idf(end($date), false) }}
                </div>
                <div class="card-body">
                    <div class="container">
                        <canvas id="pageViews"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>{{ __('Top Browsers Report') }}</b> | {{ __idf($date[0], false) }} {{ __('to') }}
                    {{ __idf(end($date), false) }}
                </div>
                <div class="card-body">
                    <div class="container">
                        <canvas id="TopBrowsers"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>{{ __('Most Visited Pages Report') }}</b> | {{ __idf($date[0], false) }} {{ __('to') }}
                    {{ __idf(end($date), false) }}
                </div>
                <div class="card-body">
                    <div class="container">
                        <canvas id="mostVisitedPages"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script>
    var ctx = document.getElementById('pageViews').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                @foreach ($date as $dateTuple)
                    '{{ $dateTuple }}',
                @endforeach
            ],
            datasets: [{
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    borderColor: "#3e95cd",
                    label: '{{ __('Page Views') }}',
                    data: [
                        @foreach ($pageViews as $pageViewsTuple)
                            {{ $pageViewsTuple }},
                        @endforeach
                    ],
                    fill: false,
                    borderWidth: 2
                },
                {
                    label: '{{ __('Unique Visitors') }}',
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    borderColor: "#3cba9f",
                    data: [
                        @foreach ($visitors as $visitorsTuple)
                            {{ $visitorsTuple }},
                        @endforeach
                    ],
                    fill: false,
                    borderWidth: 2,

                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                label: '{{ __('Top 3 Hits') }}',
                data: [
                    @foreach ($topReferrers as $topReferrersTuple)
                        {{ $topReferrersTuple['pageViews'] }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($topReferrers as $topReferrersTuple)
                        '#' + (0x1000000 + (Math.random()) * 0xffffff).toString(16).substr(1, 6),
                    @endforeach
                ],
            }],
            labels: [
                @foreach ($topReferrers as $topReferrersTuple)
                    '{{ ucfirst(str_replace(['(', ')'], '', $topReferrersTuple['url'])) }}',
                @endforeach
            ]
        },
        options: {
            responsive: true
        }
    };
    var ctx = document.getElementById('hits').getContext('2d');
    window.myPie = new Chart(ctx, config);

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                label: '{{ __('Visitor Type') }}',
                data: [
                    @foreach ($visitorType as $visitorTypeTuple)
                        {{ $visitorTypeTuple['sessions'] }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($visitorType as $v)
                        '#' + (0x1000000 + (Math.random()) * 0xffffff).toString(16).substr(1, 6),
                    @endforeach
                ],
            }],
            labels: [
                @foreach ($visitorType as $visitorTypeTuple)
                    '{{ $visitorTypeTuple['type'] }}',
                @endforeach
            ]
        },
        options: {
            responsive: true
        }
    };
    var ctx = document.getElementById('type').getContext('2d');
    window.myPie = new Chart(ctx, config);

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                label: '{{ __('Top Browsers') }}',
                data: [
                    @foreach ($TopBrowsers as $TopBrowsersTuple)
                        {{ $TopBrowsersTuple['sessions'] }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($TopBrowsers as $v)
                        '#' + (0x1000000 + (Math.random()) * 0xffffff).toString(16).substr(1, 6),
                    @endforeach
                ],
            }],
            labels: [
                @foreach ($TopBrowsers as $TopBrowsersTuple)
                    '{{ $TopBrowsersTuple['browser'] }}',
                @endforeach
            ]
        },
        options: {
            responsive: true
        }
    };
    var ctx = document.getElementById('TopBrowsers').getContext('2d');
    window.myPie = new Chart(ctx, config);

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                label: '{{ __('Most Visited Pages') }}',
                data: [
                    @foreach ($mostVisitedPages as $mostVisitedPagesTuple)
                        {{ $mostVisitedPagesTuple['pageViews'] }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach ($mostVisitedPages as $v)
                        '#' + (0x1000000 + (Math.random()) * 0xffffff).toString(16).substr(1, 6),
                    @endforeach
                ],
            }],
            labels: [
                @foreach ($mostVisitedPages as $mostVisitedPagesTuple)
                    '{{ $mostVisitedPagesTuple['url'] }}',
                @endforeach
            ]
        },
        options: {
            responsive: true
        }
    };
    var ctx = document.getElementById('mostVisitedPages').getContext('2d');
    window.myPie = new Chart(ctx, config);
</script>
@endpush
