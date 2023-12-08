<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
    <a href="{{ route('logViewer') }}" class="navbar-brand mr-0">
        <i class="fa fa-fw fa-book"></i> @lang('logs.log_viewer')
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" data-name="kykmaYkf">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Route::is('tools/logs/debug') ? 'active' : '' }}">
                <a href="{{ route('logViewer') }}" class="nav-link">
                    <i class="fa fa-dashboard"></i> @lang('dashboard.page.title')
                </a>
            </li>
            <li class="nav-item {{ Route::is('tools/logs/debug/list') ? 'active' : '' }}">
                <a href="{{ route('logsList') }}" class="nav-link">
                    <i class="fa fa-archive"></i>  @lang('logs.title')
                </a>
            </li>
        </ul>
    </div>
</nav>