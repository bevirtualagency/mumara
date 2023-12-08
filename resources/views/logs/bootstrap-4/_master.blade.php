<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="LogViewer">
    <meta name="author" content="ARCANEDEV">
    <title>{{trans('logs.logs_bootstrap_master.title_log_created_by')}} </title>
    {{-- Styles --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            font-size: .875rem;
            margin-bottom: 60px;
        }

        .main-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #E8EAF6;
        }

        .main-footer p {
            margin-bottom: 0;
        }

        .main-footer .fa.fa-heart {
            color: #C62828;
        }

        .page-header {
            border-bottom: 1px solid #8a8a8a;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding: .75rem 1rem;
            font-size: 1rem;
        }

        .navbar-nav .nav-link {
            padding-right: .5rem;
            padding-left: .5rem;
        }

        /*
         * Boxes
         */

        .box {
            display: block;
            padding: 0;
            min-height: 70px;
            background: #fff;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: .25rem;
        }

        .box > .box-icon > i,
        .box .box-content .box-text,
        .box .box-content .box-number {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .box > .box-icon {
            border-radius: 2px 0 0 2px;
            display: block;
            float: left;
            height: 70px; width: 70px;
            text-align: center;
            font-size: 40px;
            line-height: 70px;
            background: rgba(0,0,0,0.2);
        }

        .box .box-content {
            padding: 5px 10px;
            margin-left: 70px;
        }

        .box .box-content .box-text {
            display: block;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .box .box-content .box-number {
            display: block;
        }

        .box .box-content .progress {
            background: rgba(0,0,0,0.2);
            margin: 5px -10px 5px -10px;
        }

        .box .box-content .progress .progress-bar {
            background-color: #FFF;
        }

        /*
         * Log Menu
         */

        .log-menu .list-group-item.disabled {
            cursor: not-allowed;
        }

        .log-menu .list-group-item.disabled .level-name {
            color: #D1D1D1;
        }

        /*
         * Log Entry
         */

        .stack-content {
            color: #AE0E0E;
            font-family: consolas, Menlo, Courier, monospace;
            white-space: pre-line;
            font-size: .8rem;
        }

        /*
         * Colors: Badge & Infobox
         */

        .badge.badge-env,
        .badge.badge-level-all,
        .badge.badge-level-emergency,
        .badge.badge-level-alert,
        .badge.badge-level-critical,
        .badge.badge-level-error,
        .badge.badge-level-warning,
        .badge.badge-level-notice,
        .badge.badge-level-info,
        .badge.badge-level-debug,
        .badge.empty {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .badge.badge-level-all,
        .box.level-all {
            background-color: {{ log_styler()->color('all') }};
        }

        .badge.badge-level-emergency,
        .box.level-emergency {
            background-color: {{ log_styler()->color('emergency') }};
        }

        .badge.badge-level-alert,
        .box.level-alert  {
            background-color: {{ log_styler()->color('alert') }};
        }

        .badge.badge-level-critical,
        .box.level-critical {
            background-color: {{ log_styler()->color('critical') }};
        }

        .badge.badge-level-error,
        .box.level-error {
            background-color: {{ log_styler()->color('error') }};
        }

        .badge.badge-level-warning,
        .box.level-warning {
            background-color: {{ log_styler()->color('warning') }};
        }

        .badge.badge-level-notice,
        .box.level-notice {
            background-color: {{ log_styler()->color('notice') }};
        }

        .badge.badge-level-info,
        .box.level-info {
            background-color: {{ log_styler()->color('info') }};
        }

        .badge.badge-level-debug,
        .box.level-debug {
            background-color: {{ log_styler()->color('debug') }};
        }

        .badge.empty,
        .box.empty {
            background-color: {{ log_styler()->color('empty') }} !important;
        }

        .badge.badge-env {
            background-color: #6A1B9A;
        }
        div#navbarNav {
            position: absolute;
            line-height: 1;
            left: 130px;
            padding-top: 0px;
            font-size: 14px;
        }
        #navbarNav ul.navbar-nav.mr-auto {
            width: 100%;
            display: block;
        }
        #navbarNav ul li.nav-item {
            position: relative;
            float: left;
        }
        .table td:last-child, .table th:last-child {
            white-space: nowrap !important;
            min-width: 50px;
            text-align: left !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark p-0">
        <a href="{{ route('log-viewer::dashboard') }}" class="navbar-brand mr-0">
            <i class="fa fa-fw fa-book"></i> {{trans('logs.logs_bootstrap_master.log_viewer_action')}} 
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" data-name="ZodOCYYE">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Route::is('log-viewer::dashboard') ? 'active' : '' }}">
                    <a href="{{ route('log-viewer::dashboard') }}" class="nav-link">
                        <i class="fa fa-dashboard"></i> {{trans('logs.logs_bootstrap_master.dashboard_action')}} 
                    </a>
                </li>
                <li class="nav-item {{ Route::is('log-viewer::logs.list') ? 'active' : '' }}">
                    <a href="{{ route('log-viewer::logs.list') }}" class="nav-link">
                        <i class="fa fa-archive"></i> {{trans('logs.logs_campaign_blade.logs_txt_span')}}
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" data-name="QCfygZEe">
        <main role="main" class="pt-3">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    <footer class="main-footer">
        <div class="container-fluid" data-name="LzJguceN">
            <p class="text-muted pull-left">
                {{trans('logs.logs_bootstrap_master.log_viewer_action')}} - <span class="badge badge-info">{{trans('logs.logs_bootstrap_master.version_para')}} {{ log_viewer()->version() }}</span>
            </p>
            <p class="text-muted pull-right">
              {{trans('logs.logs_bootstrap_master.created_with_para')}}   <i class="fa fa-heart"></i>{{trans('logs.logs_bootstrap_master.arcanedev_with_para')}}  <sup>&copy;</sup>
            </p>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

    @yield('modals')
    @yield('scripts')
</body>
</html>