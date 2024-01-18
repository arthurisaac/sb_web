@extends('layouts.app', ["subtitle" => "Statistiques du jour"])

@section('content')
    <div class="home-tab">
        {{--<div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab"
                       href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                </li>
                --}}{{--<li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences"
                       role="tab" aria-selected="false">Audiences</a>
                </li>--}}{{--
            </ul>
            <div>
                <div class="btn-wrapper">
                    --}}{{--<a href="#" class="btn btn-otline-dark align-items-center"><i
                            class="icon-share"></i> Share</a>--}}{{--
                    <a onclick="window.print()" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                    --}}{{--<a href="#" class="btn btn-primary text-white me-0"><i
                            class="icon-download"></i> Exporter</a>--}}{{--
                </div>
            </div>
        </div>
        <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel"
                 aria-labelledby="overview">
                --}}{{--<div class="row">
                    <div class="col-sm-12">
                        <div
                            class="statistics-details d-flex align-items-center justify-content-between">
                            <div>
                                <p class="statistics-title">Bounce Rate</p>
                                <h3 class="rate-percentage">32.53%</h3>
                                <p class="text-danger d-flex"><i
                                        class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                            </div>
                            <div>
                                <p class="statistics-title">Page Views</p>
                                <h3 class="rate-percentage">7,682</h3>
                                <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span>
                                </p>
                            </div>
                            <div>
                                <p class="statistics-title">New Sessions</p>
                                <h3 class="rate-percentage">68.8</h3>
                                <p class="text-danger d-flex"><i
                                        class="mdi mdi-menu-down"></i><span>68.8</span></p>
                            </div>
                            <div class="d-none d-md-block">
                                <p class="statistics-title">Avg. Time on Site</p>
                                <h3 class="rate-percentage">2m:35s</h3>
                                <p class="text-success d-flex"><i
                                        class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                            </div>
                            <div class="d-none d-md-block">
                                <p class="statistics-title">New Sessions</p>
                                <h3 class="rate-percentage">68.8</h3>
                                <p class="text-danger d-flex"><i
                                        class="mdi mdi-menu-down"></i><span>68.8</span></p>
                            </div>
                            <div class="d-none d-md-block">
                                <p class="statistics-title">Avg. Time on Site</p>
                                <h3 class="rate-percentage">2m:35s</h3>
                                <p class="text-success d-flex"><i
                                        class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                            </div>
                        </div>
                    </div>
                </div>--}}{{--
                <div class="row">
                    <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div
                                            class="d-sm-flex justify-content-between align-items-start">
                                            <div>
                                                <h4 class="card-title card-title-dash">Commandes</h4>
                                                <p class="card-subtitle card-subtitle-dash">Commandes de l'année
                                                    à hier</p>
                                            </div>
                                            --}}{{--<div>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                                        type="button" id="dropdownMenuButton2"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        This month
                                                    </button>
                                                    <div class="dropdown-menu"
                                                         aria-labelledby="dropdownMenuButton2">
                                                        <h6 class="dropdown-header">Settings</h6>
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another
                                                            action</a>
                                                        <a class="dropdown-item" href="#">Something
                                                            else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated
                                                            link</a>
                                                    </div>
                                                </div>
                                            </div>--}}{{--
                                        </div>
                                        <div
                                            class="d-sm-flex align-items-center mt-1 justify-content-between">
                                            <div
                                                class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                <h2 class="me-2 fw-bold">{{ $amountTotal  }}</h2>
                                                --}}{{--<h4 class="text-success">(+1.37%)</h4>--}}{{--
                                            </div>
                                            <div class="me-3">
                                                <div id="marketing-overview-legend"></div>
                                            </div>
                                        </div>
                                        <div class="chartjs-bar-wrapper mt-3">
                                            <canvas id="marketingOverview"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div
                                            class="d-sm-flex justify-content-between align-items-start">
                                            <div>
                                                <h4 class="card-title card-title-dash">Commandes en attentes</h4>
                                                <p class="card-subtitle card-subtitle-dash">Vous avez 0 commandes en
                                                    attentes</p>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <div class="table-responsive  mt-1">
                                            <table class="table select-table">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <div
                                                            class="form-check form-check-flat mt-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox"
                                                                       class="form-check-input"
                                                                       aria-checked="false"><i
                                                                    class="input-helper"></i></label>
                                                        </div>
                                                    </th>
                                                    <th>Client</th>
                                                    <th>Coffret</th>
                                                    <th>Livraison</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>
                                                            <div
                                                                class="form-check form-check-flat mt-0">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox"
                                                                           class="form-check-input"
                                                                           aria-checked="false"><i
                                                                        class="input-helper"></i></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <img
                                                                    src="https://ui-avatars.com/api/?name={{ $order->User->nom }}+{{ $order->User->prenom }}"
                                                                    alt="">
                                                                <div>
                                                                    <h6>{{ $order->User->nom ?? "" }} {{ $order->User->prenom ?? "" }}</h6>
                                                                    <p>{{ $order->User->country ?? "" }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $order->Box->name ?? "Box supprimé" }}</h6>
                                                            <p>{{ $order->Box->price ?? "" }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $order->delivery}}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $order->created_at }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-grow">
                            <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body card-rounded">
                                        <h4 class="card-title  card-title-dash">Evenements réçents</h4>
                                        --}}{{--<div class="list align-items-center border-bottom py-2">
                                            <div class="wrapper w-100">
                                                <p class="mb-2 font-weight-medium">
                                                    Change in Directors
                                                </p>
                                                <div
                                                    class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-calendar text-muted me-1"></i>
                                                        <p class="mb-0 text-small text-muted">Mar
                                                            14, 2019</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>--}}{{--

                                        --}}{{--<div class="list align-items-center pt-3">
                                            <div class="wrapper w-100">
                                                <p class="mb-0">
                                                    <a href="#" class="fw-bold text-primary">Show
                                                        all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                                </p>
                                            </div>
                                        </div>--}}{{--
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div
                                            class="d-flex align-items-center justify-content-between mb-3">
                                            <h4 class="card-title card-title-dash">Activités</h4>
                                            <p class="mb-0"></p>
                                        </div>
                                        <ul class="bullet-line-list">
                                            --}}{{--<li>
                                                <div class="d-flex justify-content-between">
                                                    <div><span
                                                            class="text-light-green">Ben Tossell</span>
                                                        assign you a task
                                                    </div>
                                                    <p>Just now</p>
                                                </div>
                                            </li>--}}{{--
                                        </ul>
                                        --}}{{-- <div class="list align-items-center pt-3">
                                             <div class="wrapper w-100">
                                                 <p class="mb-0">
                                                     <a href="#" class="fw-bold text-primary">Show
                                                         all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                                 </p>
                                             </div>
                                         </div>--}}{{--
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex flex-column">
                        --}}{{--<div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div
                                                    class="d-flex justify-content-between align-items-center">
                                                    <h4 class="card-title card-title-dash">Todo
                                                        list</h4>
                                                    <div class="add-items d-flex mb-0">
                                                        <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                                                        <button
                                                            class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p">
                                                            <i class="mdi mdi-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="list-wrapper">
                                                    <ul class="todo-list todo-list-rounded">
                                                        <li class="d-block">
                                                            <div class="form-check w-100">
                                                                <label class="form-check-label">
                                                                    <input class="checkbox"
                                                                           type="checkbox"> Lorem
                                                                    Ipsum is simply dummy text of
                                                                    the printing <i
                                                                        class="input-helper rounded"></i>
                                                                </label>
                                                                <div class="d-flex mt-2">
                                                                    <div
                                                                        class="ps-4 text-small me-3">
                                                                        24 June 2020
                                                                    </div>
                                                                    <div
                                                                        class="badge badge-opacity-warning me-3">
                                                                        Due tomorrow
                                                                    </div>
                                                                    <i class="mdi mdi-flag ms-2 flag-color"></i>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-block">
                                                            <div class="form-check w-100">
                                                                <label class="form-check-label">
                                                                    <input class="checkbox"
                                                                           type="checkbox"> Lorem
                                                                    Ipsum is simply dummy text of
                                                                    the printing <i
                                                                        class="input-helper rounded"></i>
                                                                </label>
                                                                <div class="d-flex mt-2">
                                                                    <div
                                                                        class="ps-4 text-small me-3">
                                                                        23 June 2020
                                                                    </div>
                                                                    <div
                                                                        class="badge badge-opacity-success me-3">
                                                                        Done
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="form-check w-100">
                                                                <label class="form-check-label">
                                                                    <input class="checkbox"
                                                                           type="checkbox"> Lorem
                                                                    Ipsum is simply dummy text of
                                                                    the printing <i
                                                                        class="input-helper rounded"></i>
                                                                </label>
                                                                <div class="d-flex mt-2">
                                                                    <div
                                                                        class="ps-4 text-small me-3">
                                                                        24 June 2020
                                                                    </div>
                                                                    <div
                                                                        class="badge badge-opacity-success me-3">
                                                                        Done
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="border-bottom-0">
                                                            <div class="form-check w-100">
                                                                <label class="form-check-label">
                                                                    <input class="checkbox"
                                                                           type="checkbox"> Lorem
                                                                    Ipsum is simply dummy text of
                                                                    the printing <i
                                                                        class="input-helper rounded"></i>
                                                                </label>
                                                                <div class="d-flex mt-2">
                                                                    <div
                                                                        class="ps-4 text-small me-3">
                                                                        24 June 2020
                                                                    </div>
                                                                    <div
                                                                        class="badge badge-opacity-danger me-3">
                                                                        Expired
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--}}{{--
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div
                                                    class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="card-title card-title-dash">Coffrets</h4>
                                                </div>
                                                <canvas class="my-auto" id="doughnutChart"
                                                        height="200"></canvas>
                                                <div id="doughnut-chart-legend"
                                                     class="mt-5 text-center"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div
                                                    class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Utilisateurs</h4>
                                                    </div>
                                                    --}}{{--<div>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                                                type="button"
                                                                id="dropdownMenuButton3"
                                                                data-bs-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false"> Month Wise
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                 aria-labelledby="dropdownMenuButton3">
                                                                <h6 class="dropdown-header">week
                                                                    Wise</h6>
                                                                <a class="dropdown-item" href="#">Year
                                                                    Wise</a>
                                                            </div>
                                                        </div>
                                                    </div>--}}{{--
                                                </div>
                                                <div class="mt-3">
                                                    <canvas id="leaveReport"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div
                                                    class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Meilleur client</h4>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    @foreach($bestClients as $client)
                                                        <div
                                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                            <div class="d-flex">
                                                                <img class="img-sm rounded-10"
                                                                     src="images/faces/face1.jpg"
                                                                     alt="profile">
                                                                <div class="wrapper ms-3">
                                                                    <p class="ms-1 mb-1 fw-bold">{{ $client->User->nom ?? "Utilisateur inexistant" }} {{ $client->User->prenom ?? "-" }}</p>
                                                                    <small class="text-muted mb-0">{{ $client->Payments->max("amount") ?? 0 }}</small>
                                                                </div>
                                                            </div>
                                                            --}}{{--<div class="text-muted text-small">
                                                                1h ago
                                                            </div>--}}{{--
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
@endsection
@push('other-scripts')
    <script>
        const mounths = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
        const orderToday = @json($yearlyOrders);
        const users = @json($yearlyUsers);
        const dataCoffrets = @json($coffretStats);
        let dataOrder = [];
        let dataUser = [];
        let labelCoffret = [];
        let dataCoffret = [];

        for(let i = 0; i <= 12; i++) {
            orderToday.map((order, index) => {
                if (orderToday[index].month_name === mounths[i]) {
                    dataOrder[i] = orderToday[index].total;
                } else {
                    dataOrder[i] = 0;
                }
            })
            users.map((order, index) => {
                if (users[index].month_name === mounths[i]) {
                    dataUser[i] = users[index].total;
                } else {
                    dataUser[i] = 0;
                }
            })
        }
        console.log(dataCoffrets)
        dataCoffrets.map((coffret, index) => {
            dataCoffret[index] = coffret.total
            labelCoffret[index] = coffret?.box?.name
        });

        if ($("#marketingOverview").length) {
            var marketingOverviewChart = document.getElementById("marketingOverview").getContext('2d');
            var marketingOverviewData = {
                labels: mounths,
                datasets: [{
                    label: 'Cette année',
                    data: dataOrder,
                    backgroundColor: "#52CDFF",
                    borderColor: [
                        '#52CDFF',
                    ],
                    borderWidth: 0,
                    fill: true, // 3: no fill

                }/*, {
                    label: 'This week',
                    data: [215, 290, 210, 250, 290, 230, 290, 210, 280, 220, 190, 300],
                    backgroundColor: "#1F3BB3",
                    borderColor: [
                        '#1F3BB3',
                    ],
                    borderWidth: 0,
                    fill: true, // 3: no fill
                }*/]
            };

            var marketingOverviewOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true,
                            drawBorder: false,
                            color: "#F0F0F0",
                            zeroLineColor: '#F0F0F0',
                        },
                        ticks: {
                            beginAtZero: true,
                            autoSkip: true,
                            maxTicksLimit: 5,
                            fontSize: 10,
                            color: "#6B778C"
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        barPercentage: 0.35,
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            beginAtZero: false,
                            autoSkip: true,
                            maxTicksLimit: 12,
                            fontSize: 10,
                            color: "#6B778C"
                        }
                    }],
                },
                legend: false,
                legendCallback: function (chart) {
                    var text = [];
                    text.push('<div class="chartjs-legend"><ul>');
                    for (var i = 0; i < chart.data.datasets.length; i++) {
                        console.log(chart.data.datasets[i]); // see what's inside the obj.
                        text.push('<li class="text-muted text-small">');
                        text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
                        text.push(chart.data.datasets[i].label);
                        text.push('</li>');
                    }
                    text.push('</ul></div>');
                    return text.join("");
                },

                elements: {
                    line: {
                        tension: 0.4,
                    }
                },
                tooltips: {
                    backgroundColor: 'rgba(31, 59, 179, 1)',
                }
            }
            var marketingOverview = new Chart(marketingOverviewChart, {
                type: 'bar',
                data: marketingOverviewData,
                options: marketingOverviewOptions
            });
            document.getElementById('marketing-overview-legend').innerHTML = marketingOverview.generateLegend();
        }

        if ($("#leaveReport").length) {
            var leaveReportChart = document.getElementById("leaveReport").getContext('2d');
            var leaveReportData = {
                labels: mounths,
                datasets: [{
                    label: 'Cette année',
                    data: dataUser,
                    backgroundColor: "#52CDFF",
                    borderColor: [
                        '#52CDFF',
                    ],
                    borderWidth: 0,
                    fill: true, // 3: no fill

                }]
            };

            var leaveReportOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true,
                            drawBorder: false,
                            color:"rgba(255,255,255,.05)",
                            zeroLineColor: "rgba(255,255,255,.05)",
                        },
                        ticks: {
                            beginAtZero: true,
                            autoSkip: true,
                            maxTicksLimit: 5,
                            fontSize: 10,
                            color:"#6B778C"
                        }
                    }],
                    xAxes: [{
                        barPercentage: 0.5,
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            beginAtZero: false,
                            autoSkip: true,
                            maxTicksLimit: 7,
                            fontSize: 10,
                            color:"#6B778C"
                        }
                    }],
                },
                legend:false,

                elements: {
                    line: {
                        tension: 0.4,
                    }
                },
                tooltips: {
                    backgroundColor: 'rgba(31, 59, 179, 1)',
                }
            }
            var leaveReport = new Chart(leaveReportChart, {
                type: 'bar',
                data: leaveReportData,
                options: leaveReportOptions
            });
        }

        if ($("#doughnutChart").length) {
            var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
            var doughnutPieData = {
                datasets: [{
                    data: dataCoffret,
                    backgroundColor: [
                        "#1F3BB3",
                        "#FDD0C7",
                        "#52CDFF",
                        "#81DADA"
                    ],
                    borderColor: [
                        "#1F3BB3",
                        "#FDD0C7",
                        "#52CDFF",
                        "#81DADA"
                    ],
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: labelCoffret
            };
            var doughnutPieOptions = {
                cutoutPercentage: 50,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                legend: false,
                legendCallback: function (chart) {
                    var text = [];
                    text.push('<div class="chartjs-legend"><ul class="justify-content-center">');
                    for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                        text.push('<li><span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '">');
                        text.push('</span>');
                        if (chart.data.labels[i]) {
                            text.push(chart.data.labels[i]);
                        }
                        text.push('</li>');
                    }
                    text.push('</div></ul>');
                    return text.join("");
                },

                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                },
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return data['labels'][tooltipItem[0]['index']];
                        },
                        label: function(tooltipItem, data) {
                            return data['datasets'][0]['data'][tooltipItem['index']];
                        }
                    },

                    backgroundColor: '#fff',
                    titleFontSize: 14,
                    titleFontColor: '#0B0F32',
                    bodyFontColor: '#737F8B',
                    bodyFontSize: 11,
                    displayColors: false
                }
            };
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
            document.getElementById('doughnut-chart-legend').innerHTML = doughnutChart.generateLegend();
        }
    </script>
@endpush
