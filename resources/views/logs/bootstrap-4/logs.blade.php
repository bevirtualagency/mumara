@extends(decide_template())
@section('title', $pageTitle)
@section('page_styles')
<link href="/resources/assets/css/debug-logs-list.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
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

@section(decide_content())

<div class="col-md-12" data-name="hJFCYpOP">
    <div class="row" data-name="zIbaoUqA">
        <div class="kt-portlet kt-portlet--bordered" data-name="CgfEroFN">
            <div class="kt-portlet__head" data-name="hzYOcurA">
                @include('logs.bootstrap-4.nav')
            </div>
            <div class="kt-portlet__body" data-name="ymYCduNu">
                <div class="row" data-name="FSnPsQWI">
                    <div class="col-md-12" data-name="BzoyQvdD">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover responsive">
                                <thead>
                                    <tr>
                                        @foreach($headers as $key => $header)
                                        <th scope="col" class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                            @if ($key == 'date')
                                                <span class="badge badge-info">{{ $header }}</span>
                                            @else
                                                <span class="badge badge-level-{{ $key }}">
                                                    {!! log_styler()->icon($key) . ' ' . trans('logs.level.'.lcfirst($header)) !!}
                                                </span>
                                            @endif
                                        </th>
                                        @endforeach
                                        <th scope="col" class="text-right">@lang('common.label.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows->count() > 0)
                                        @foreach($rows as $date => $row)
                                        <tr>
                                            @foreach($row as $key => $value)
                                                <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                                    @if ($key == 'date')
                                                        <span class="badge badge-primary">{{ $value }}</span>
                                                    @elseif ($value == 0)
                                                        <span class="badge empty">{{ $value }}</span>
                                                    @else
                                                        <a href="{{ route('showByLevel', [$date, $key]) }}">
                                                            <span class="badge badge-level-{{ $key }}">{{ $value }}</span>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endforeach
                                            <td class="text-right">
                                                <a href="{{ route('showLog', [$date]) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                                <a href="{{ route('downloadLog', ['date'=>$date]) }}" class="btn btn-sm btn-success">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-log-date="{{ $date }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="11" class="text-center">
                                                <span class="badge badge-secondary"><?php echo  trans('logs.general.empty-logs'); ?></span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

{{-- DELETE MODAL --}}
<div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog" data-name="uVZgZQPv">
    <div class="modal-dialog" role="document" data-name="EKiSPnsq">
        <form id="delete-log-form" action="{{ route('deleteLog') }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="date" value="">
            <div class="modal-content" data-name="dvQfXwpd">
                <div class="modal-header" data-name="HPmvruTW">
                    <h5 class="modal-title">@lang('logs.debug.delete_log_file')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-name="cBXpvNXJ">
                    <p></p>
                </div>
                <div class="modal-footer" data-name="LbQuXrJK">
                    <button type="button" class="btn btn-sm btn-secondary mr-auto" data-dismiss="modal">@lang('common.form.buttons.close')</button>
                    <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">@lang('logs.debug.delete_log_file')</button>
                </div>
            </div>
        </form>
    </div>
</div>                        

    {!! $rows->render() !!}
@endsection


    


@section('page_scripts')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            $("a[href='#delete-log-modal']").on('click', function(event) {
                event.preventDefault();
                var date = $(this).data('log-date');
                deleteLogForm.find('input[name=date]').val(date);
                deleteLogModal.find('.modal-body p').html(
                    '@lang("logs.message.delete_alert") <span class="badge badge-primary">' + date + '</span> ?'
                );

                deleteLogModal.modal('show');
            });

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.reload();
                        }
                        else {
                            alert('@lang("logs.message.ajax_error")');
                            console.error(data);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('@lang("logs.message.ajax_error")');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            deleteLogModal.on('hidden.bs.modal', function() {
                deleteLogForm.find('input[name=date]').val('');
                deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
@endsection