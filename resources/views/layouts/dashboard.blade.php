<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ucfirst(explode('.', Route::currentRouteName())[0])}} {{ $id ?? ''}} - {{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{asset('font/iconsmind-s/css/iconsminds.css')}}" />
    <link rel="stylesheet" href="{{asset('font/simple-line-icons/css/simple-line-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.rtl.only.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/fullcalendar.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/dataTables.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/datatables.responsive.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/glide.core.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap-stars.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/nouislider.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/bootstrap-datepicker3.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/vendor/component-custom-switch.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet-src.js"></script>
</head>

<body id="app-container" class="menu-default show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>

            <div class="search" data-search-path="Pages.Search.html?q=">
                <input placeholder="Search...">
                <span class="search-icon">
                    <i class="simple-icon-magnifier"></i>
                </span>
            </div>
        </div>


        <a class="navbar-logo" href="{{route('dashboard.index')}}">
            <span style="font-size:14pt;">{{ config('app.name', 'Laravel') }}</span>
            <!-- <span class="logo d-none d-xs-block"></span>
            <span class="logo-mobile d-block d-xs-none"></span> -->
        </a>

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <div class="d-none d-md-inline-block align-text-bottom mr-3">
                    <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                         data-toggle="tooltip" data-placement="left" title="Dark Mode">
                        <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                        <label class="custom-switch-btn" for="switchDark"></label>
                    </div>
                </div>

                <div class="position-relative d-none d-sm-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                        <a href="{{route('users.index')}}" class="icon-menu-item">
                            <i class="iconsminds-male-female d-block"></i>
                            <span>Users</span>
                        </a>
                        <a href="{{route('documentation.index')}}" class="icon-menu-item">
                            <i class="iconsminds-newspaper d-block"></i>
                            <span>Documentation</span>
                        </a>
                    </div>
                </div>

                <div class="position-relative d-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="notificationButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-bell"></i>
                        <span class="count">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                        <div class="scroll">
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{asset('img/profiles/l-2.jpg')}}" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{asset('img/notifications/1.jpg')}}" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">1 item is out of stock!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{asset('img/notifications/2.jpg')}}" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 ">
                                <a href="#">
                                    <img src="{{asset('img/notifications/3.jpg')}}" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">3 items just added to wish list by a user!
                                        </p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name">{{Auth::user()->name}}</span>
                    <?php
                        $email = Auth::user()->email;
                        $hash = md5( strtolower( trim( $email ) ) );
                        $size = 150;
                        $grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
                    ?>
                    <span>
                        <img alt="Profile Picture" src="{{$grav_url}}" />
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li class="@if(str_contains(Route::currentRouteName(), 'dashboard.')) active @endif">
                        <a href="{{route('dashboard.index')}}">
                            <i class="iconsminds-shop-4"></i>
                            <span>Dashboards</span>
                        </a>
                    </li>
                    <li class="@if(str_contains(Route::currentRouteName(), 'monitoring.')) active @endif">
                        <a href="{{route('monitoring.index')}}">
                            <i class="iconsminds-monitoring"></i>
                            <span>Monitoring</span>
                        </a>
                    </li>
                    <li class="@if(str_contains(Route::currentRouteName(), 'nodes.')) active @endif">
                        <a href="{{route('nodes.index')}}">
                            <i class="iconsminds-router"></i>
                            <span>Nodes</span>
                        </a>
                    </li>
                    <li class="@if(str_contains(Route::currentRouteName(), 'alerts.')) active @endif">
                        <a href="{{route('alerts.index')}}">
                            <i class="iconsminds-danger"></i>
                            <span>Alerts</span>
                        </a>
                    </li>
                    <li class="@if(str_contains(Route::currentRouteName(), 'settings.')) active @endif">
                        <a href="{{route('settings.index')}}">
                            <i class="iconsminds-security-settings"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="page-footer">
        <div class="footer-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <p class="mb-0 text-muted">Muhammad Habib Ulil Albaab - {{ config('app.name', 'Laravel') }} {{date('Y')}}</p>
                    </div>
                    <div class="col-sm-6 d-none d-sm-block">
                        <ul class="breadcrumb pt-0 pr-0 float-right">
                            <li class="breadcrumb-item mb-0">
                                <a href="{{route('documentation.index')}}" class="btn-link">Documentation</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{asset('js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/vendor/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('js/vendor/chartjs-plugin-datalabels.js')}}"></script>
    <script src="{{asset('js/vendor/moment.min.js')}}"></script>
    <script src="{{asset('js/vendor/fullcalendar.min.js')}}"></script>
    <script src="{{asset('js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('js/vendor/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/vendor/progressbar.min.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('js/vendor/select2.full.js')}}"></script>
    <script src="{{asset('js/vendor/nouislider.min.js')}}"></script>
    <script src="{{asset('js/vendor/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/vendor/Sortable.js')}}"></script>
    <script src="{{asset('js/vendor/mousetrap.min.js')}}"></script>
    <script src="{{asset('js/vendor/glide.min.js')}}"></script>
    <script src="{{asset('js/dore.script.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    
    <script>
        $(".data-table-nodeReport").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('nodes.ajax', $id ?? '0')}}",
            sDom: '<"row view-filter"<"col-sm-12"<"float-right"l><"float-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
            columns: [
            { "data": "created_at"},
            { "data": "node_id" },
            { "data": "owner" },
            { "data": "btn_warn" },
            { "data": "co2" },
            { "data": "co" },
            { "data": "ch4" },
            { "data": "temperature" },
            { "data": "humidity" },
            { "data": "lat" },
            { "data": "lng" }
            ],
            drawCallback: function () {
            $($(".dataTables_wrapper .pagination li:first-of-type"))
                .find("a")
                .addClass("prev");
            $($(".dataTables_wrapper .pagination li:last-of-type"))
                .find("a")
                .addClass("next");

            $(".dataTables_wrapper .pagination").addClass("pagination-sm");
            },
            language: {
                paginate: {
                    previous: "<i class='simple-icon-arrow-left'></i>",
                    next: "<i class='simple-icon-arrow-right'></i>"
                },
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                lengthMenu: "Items Per Page _MENU_"
            },
            order: [0, 'desc'],
        });
        $(".data-table-nodes").DataTable({
            sDom: '<"row view-filter"<"col-sm-12"<"float-right"l><"float-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
            "columns": [
            { "data": "Node ID" },
            { "data": "Owned" },
            { "data": "Latest Connected" },
            { "data": "Action" }
            ],
            drawCallback: function () {
            $($(".dataTables_wrapper .pagination li:first-of-type"))
                .find("a")
                .addClass("prev");
            $($(".dataTables_wrapper .pagination li:last-of-type"))
                .find("a")
                .addClass("next");

            $(".dataTables_wrapper .pagination").addClass("pagination-sm");
            },
            language: {
            paginate: {
                previous: "<i class='simple-icon-arrow-left'></i>",
                next: "<i class='simple-icon-arrow-right'></i>"
            },
            search: "_INPUT_",
            searchPlaceholder: "Search...",
            lengthMenu: "Items Per Page _MENU_"
            },
            order: [2, 'desc'],
        });
        $(".data-table-alert").DataTable({
            sDom: '<"row view-filter"<"col-sm-12"<"float-right"l><"float-left"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
            "columns": [
            { "data": "Datetime" },
            { "data": "Type" },
            { "data": "Variable" },
            { "data": "Indicated Node" },
            { "data": "Status" },
            { "data": "Solved Date" },
            { "data": "Action" }
            ],
            drawCallback: function () {
            $($(".dataTables_wrapper .pagination li:first-of-type"))
                .find("a")
                .addClass("prev");
            $($(".dataTables_wrapper .pagination li:last-of-type"))
                .find("a")
                .addClass("next");

            $(".dataTables_wrapper .pagination").addClass("pagination-sm");
            },
            language: {
            paginate: {
                previous: "<i class='simple-icon-arrow-left'></i>",
                next: "<i class='simple-icon-arrow-right'></i>"
            },
            search: "_INPUT_",
            searchPlaceholder: "Search...",
            lengthMenu: "Items Per Page _MENU_"
            },
            order: [4, 'asc'],
        });
    </script>
    @if(str_contains(Route::currentRouteName(), 'dashboard.'))
    <script>
    var xValues = [
        "{{date('D', strtotime('-6 days'))}}",
        "{{date('D', strtotime('-5 days'))}}",
        "{{date('D', strtotime('-4 days'))}}",
        "{{date('D', strtotime('-3 days'))}}",
        "{{date('D', strtotime('-2 days'))}}",
        "{{date('D', strtotime('-1 days'))}}",
        "{{date('D')}}"
    ];
    var yValues = [
        {{$alertReport->whereDate('created_at', date('Y-m-d', strtotime('-6 days')))->count()}},
        {{$alertReport->whereDate('created_at', date('Y-m-d', strtotime('-5 days')))->count()}},
        {{$alertReport->whereDate('created_at', date('Y-m-d', strtotime('-4 days')))->count()}},
        {{$alertReport->whereDate('created_at', date('Y-m-d', strtotime('-3 days')))->count()}},
        {{$alertReport->whereDate('created_at', date('Y-m-d', strtotime('-2 days')))->count()}},
        {{$alertReport->whereDate('created_at', date('Y-m-d', strtotime('-1 days')))->count()}},
        {{$alertReport->whereDate('created_at', date('Y-m-d'))->count()}}
    ];
    new Chart("salesChartt", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgb(57, 106, 140)",
                data: yValues
            }]
        },
        options: {
            plugins: {
              datalabels: {
                display: false
              }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItems, data) {
                        return ' ' + tooltipItems.yLabel + ' Alert';
                    }
                }

            },
            legend: {display: false},
            scales: {
                yAxes: [{ticks: {min: 0,beginAtZero: true,stepSize: 1}}],
            }
        }
    });
    </script>
    @endif
    @if(str_contains(Route::currentRouteName(), 'forecast.'))
    <script>
    @if (session('latestIndex'))
    @if (session('duration') == 'daily')
    var xValues = [
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*1)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*2)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*3)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*4)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*5)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*6)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*7)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*8)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*9)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*10)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*11)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*12)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*13)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*14)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*15)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*16)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*17)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*18)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*19)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*20)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*21)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*22)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*23)}}",
        "{{date('Y-m-d H', strtotime(session('latestIndex').':00:00') + 60*60*24)}}",
    ];
    var yValues = [
        "{{round(session('regression')->predict([session('latestCount')+1]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+2]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+3]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+4]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+5]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+6]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+7]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+8]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+9]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+10]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+11]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+12]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+13]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+14]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+15]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+16]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+17]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+18]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+19]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+20]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+21]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+22]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+23]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+24]),2)}}",
    ];
    @elseif (session('duration') == 'weekly')
    var xValues = [
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*1)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*2)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*3)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*4)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*5)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*6)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*7)}}",
    ];
    var yValues = [
        "{{round(session('regression')->predict([session('latestCount')+1]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+2]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+3]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+4]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+5]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+6]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+7]),2)}}",
    ];
    @elseif (session('duration') == 'monthly')
    var xValues = [
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*1)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*2)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*3)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*4)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*5)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*6)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*7)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*8)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*9)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*10)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*11)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*12)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*13)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*14)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*15)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*16)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*17)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*18)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*19)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*20)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*21)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*22)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*23)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*24)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*25)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*26)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*27)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*28)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*29)}}",
        "{{date('Y-m-d', strtotime(session('latestIndex')) + 60*60*24*30)}}",
    ];
    var yValues = [
        "{{round(session('regression')->predict([session('latestCount')+1]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+2]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+3]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+4]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+5]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+6]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+7]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+8]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+9]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+10]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+11]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+12]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+13]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+14]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+15]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+16]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+17]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+18]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+19]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+20]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+21]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+22]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+23]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+24]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+25]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+26]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+27]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+28]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+29]),2)}}",
        "{{round(session('regression')->predict([session('latestCount')+30]),2)}}",
    ];
    @endif
    new Chart("forecast-report", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: false,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgb(57, 106, 140)",
                data: yValues
            }]
        },
        options: {
            plugins: {
              datalabels: {
                display: false
              }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItems, data) {
                        return ' ' + tooltipItems.yLabel + "{{session('label')}}";
                    }
                }

            },
            legend: {display: false},
            scales: {
                yAxes: [{ticks: {min: 0,beginAtZero: true}}],
            }
        }
    });
    @endif
    </script>
    @endif
</body>

</html>