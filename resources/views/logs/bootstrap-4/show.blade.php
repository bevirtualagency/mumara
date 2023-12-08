@extends(decide_template())
@section('title', $pageTitle)
@section('page_styles')
<link href="/resources/assets/css/debug-logs-show.css?v={{$local_version}}.03" rel="stylesheet" type="text/css">
@endsection

@section(decide_content())

@include('logs.bootstrap-4.nav')

<div class="col-md-12" data-name="UkjOLcqc">
    <div class="row" data-name="doluybdb">
        <div class="kt-portlet kt-portlet--bordered" data-name="HZAtqsLg">
            <div class="kt-portlet__head" data-name="QEnJWNxz">
                <div class="kt-portlet__head-label" data-name="EtFmeYPP">
                    <h3 class="kt-portlet__head-title">{{trans('logs.logs_show_blade.log_heading')}} [{{ $log->date }}]</h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="XRZSFzDO">
                <div class="row log-full" data-name="MSudUHaQ">
                    <div class="col-lg-2" data-name="jHEfBhcj">
                        {{-- Log Menu --}}
                        <div class="card mb-4" data-name="srftGDJS">
                            <div class="card-header" data-name="rRgrcpjD"><i class="fa fa-fw fa-flag"></i> @lang('logs.levels')</div>
                            <div class="list-group list-group-flush log-menu" data-name="OGXGiXqT">
                                @foreach($log->menu() as $levelKey => $item)
                           
                                    @if ($item['count'] === 0)
                                        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                                            <span class="level-name">{!! $item['icon'] !!} @lang('logs.level.'.lcfirst($item['name']))</span>
                                            <span class="badge empty">{{ $item['count'] }}</span>
                                        </a>
                                    @else
                                        <a href="{{ route('showByLevel',['date'=>$date,'level'=>strtolower($item['name'])]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center level-{{ $levelKey }}{{ $level === $levelKey ? ' active' : ''}}">
                                            <span class="level-name">{!! $item['icon'] !!} @lang('logs.level.'.lcfirst($item['name']))</span>
                                            <span class="badge badge-level-{{ $levelKey }}">{{ $item['count'] }}</span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10" data-name="MCKUwNnq">
                        {{-- Log Details --}}
                        <div class="card mb-4" data-name="bmkEQaPs">
                            <div class="card-header" data-name="ixUSiFfS">
                                @lang('logs.info') :
                                <div class="group-btns pull-right" data-name="FMNGjAon">
                                    <a href="{{ route('downloadLog', [$log->date]) }}" class="btn btn-sm btn-success">
                                        <i class="fa fa-download"></i> @lang('common.label.download')
                                    </a>
                                    <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-toggle="modal">
                                        <i class="fa fa-trash-o"></i> @lang('common.form.buttons.delete')
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-condensed mb-0 responsive log-info">
                                    <tbody>
                                        <tr>
                                            <td>@lang('logs.file_path') :</td>
                                            <td colspan="7">{{ $log->getPath() }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('logs.log_entries') : </td>
                                            <td>
                                                <span class="badge badge-primary">{{ $entries->total() }}</span>
                                            </td>
                                            <td>@lang('logs.size') :</td>
                                            <td>
                                                <span class="badge badge-primary">{{ $log->size() }}</span>
                                            </td>
                                            <td>@lang('logs.created_at') :</td>
                                            <td>
                                                <span class="badge badge-primary">{{ $log->createdAt() }}</span>
                                            </td>
                                            <td>@lang('logs.updated_at') :</td>
                                            <td>
                                                <span class="badge badge-primary">{{ $log->updatedAt() }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer" data-name="MxmTwmNH">
                                {{-- Search --}}
                                <form action="{{ route('searchLog', [$log->date, $level]) }}" method="GET">
                                    <div class=form-group" data-name="lWIWSeQK">
                                        <div class="input-group" data-name="seVSveTK">
                                            <input id="query" name="query" class="form-control"  value="{!! $query !!}" placeholder="Type here to search">
                                            <div class="input-group-append" data-name="kQbuETjx">
                                                @unless (is_null($query))
                                                    <a href="{{ route('showLog', [$log->date]) }}" class="btn btn-secondary">
                                                        ({{ $entries->count() }} results) <i class="fa fa-fw fa-times"></i>
                                                    </a>
                                                @endunless
                                                <button id="search-btn" class="btn btn-primary">
                                                    <span class="fa fa-fw fa-search"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
            
                        {{-- Log Entries --}}
                        <div class="card mb-4" data-name="KeoCXPCZ">
                            @if ($entries->hasPages())
                                <div class="card-header" data-name="pjLQPnvM">
                                    <span class="badge badge-info float-right">
                                       {{trans('logs.logs_show_blade.span_page_txt')}}  {{ $entries->currentPage() }} {{trans('logs.logs_show_blade.span_of_txt')}} {{ $entries->lastPage() }}
                                    </span>
                                </div>
                            @endif
            
                            <div class="table-responsive">
                                <table id="entries" class="table mb-0 responsive">
                                    <thead>
                                        <tr>
                                            <th>@lang('logs.ENV')</th>
                                            <th style="width: 120px;">@lang('logs.Level')</th>
                                            <th style="width: 65px;">@lang('logs.Time')</th>
                                            <th>@lang('logs.Header')</th>
                                            <th class="text-right">@lang('logs.Actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($entries as $key => $entry)
                                            <?php /** @var  Arcanedev\LogViewer\Entities\LogEntry  $entry */ ?>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-env">{{ $entry->env }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-level-{{ $entry->level }}">
                                                        {!! $entry->level() !!}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-secondary">
                                                        {{ $entry->datetime->format('H:i:s') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $entry->header }}
                                                </td>
                                                <td class="text-right">
                                                    @if ($entry->hasStack())
                                                        <a class="btn btn-sm btn-light" role="button" data-toggle="collapse" href="#log-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                                                            <i class="fa fa-toggle-on"></i> @lang('logs.stack')
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if ($entry->hasStack())
                                                <tr>
                                                    <td colspan="5" class="stack py-0">
                                                        <div class="stack-content collapse" id="log-stack-{{ $key }}" data-name="dvLTOAcg">
                                                            {!! $entry->stack() !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <span class="badge badge-secondary">{{ trans('logs.general.empty-logs') }}</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
            
                        {!! $entries->appends(compact('query'))->render() !!}
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

{{-- DELETE MODAL --}}
<div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog" data-name="CvDgXkxp">
    <div class="modal-dialog" role="document" data-name="FwJWTjup">
        <form id="delete-log-form" action="{{ route('deleteLog') }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="date" value="{{ $log->date }}">
            <div class="modal-content" data-name="zOkExLuW">
                <div class="modal-header" data-name="fQHunKAa">
                    <h5 class="modal-title">@lang('logs.debug.delete_log_file')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-name="xHkzhZpM">
                    <p>@lang("logs.message.delete_alert") <span class="badge badge-primary">{{ $log->date }}</span> ?</p>
                </div>
                <div class="modal-footer" data-name="JAMWdjLC">
                    <button type="button" class="btn btn-sm btn-secondary mr-auto" data-dismiss="modal">@lang('common.form.buttons.close')</button>
                    <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">@lang('logs.debug.delete_log_file')</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('page_scripts')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

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
                            location.replace("{{ route('logViewer') }}");
                        }
                        else {
                            alert('@lang("logs.message.lack_of_coffee")')
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

            @unless (empty(log_styler()->toHighlight()))
            $('.stack-content').each(function() {
                var $this = $(this);
                var html = $this.html().trim()
                    .replace(/({!! implode('|',log_styler()->toHighlight()) !!})/gm, '<strong>$1</strong>');

                $this.html(html);
            });
            @endunless
        });
    </script>
@endsection