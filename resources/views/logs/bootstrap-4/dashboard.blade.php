@extends(decide_template())

@section('title', $pageTitle )

@section('page_styles')
<link href="/resources/assets/css/debug-logs.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
<style type="text/css">
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
</style>
@endsection
@section('page_scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
      <script>
        $(function() {
            new Chart(document.getElementById("stats-doughnut-chart"), {
                type: 'doughnut',
                data: {!! $chartData !!},
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    </script>
@endsection
  
@section(decide_content())

<div class="col-md-12" data-name="OIsvoAhn">
    <div class="row" data-name="eTjgsMld">
        <div class="kt-portlet kt-portlet--bordered" data-name="JoGPndQn">
            <div class="kt-portlet__head" data-name="rcLbuFuW">
                @include('logs.bootstrap-4.nav')
            </div>
            <div class="kt-portlet__body" data-name="zXkBVfeu">
                <div class="row" data-name="DrOpzBbg">
                    <div class="col-md-6 col-lg-3" data-name="BGSKHZPU">
                        <canvas id="stats-doughnut-chart" height="300" class="mb-3"></canvas>
                    </div>
            
                    <div class="col-md-6 col-lg-9" data-name="HbkQBIDu">
                        <div class="row" data-name="CeYQsjaI">
                            @foreach($percents as $level => $item)
                                <div class="col-sm-6 col-md-4 col-lg-4 mb-3" data-name="NMZpWRGl">
                                    <div class="box level-{{ $level }} {{ $item['count'] === 0 ? 'empty' : '' }}" data-name="QaWOPjCJ">
                                        <div class="box-icon" data-name="RDyTreNr">
                                            {!! log_styler()->icon($level) !!}
                                        </div>
            
                                        <div class="box-content" data-name="VjhFFlhJ">
                                            <span class="box-text">@lang('logs.level.'.lcfirst($item['name']))</span>
                                            <span class="box-number">
                                                {{ $item['count'] }} entries - {!! $item['percent'] !!} %
                                            </span>
                                            <div class="progress" style="height: 3px;" data-name="aUbvLTfR">
                                                <div class="progress-bar" style="width: {{ $item['percent'] }}%" data-name="OZszxYhI"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection