<div class="kt-subheader   kt-grid__item" id="kt_subheader" data-name="JOMdnIFt">
    <div class="kt-subheader__main" data-name="cWVDaLYN">
        <!-- Getting $vars from layout -->
        @php
        $html=hook_get_output('BreadcrumbNav',$vars);
        @endphp
        @if($html)
        {!! $html !!}
        @else
        <div class="kt-subheader__breadcrumbs" data-name="laGWhFXB">

            <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-link">{{trans('breadcrumbs.dashboard')}}</a>
            <?php if(empty($useBreadCrum)) $breadCrum = breadcrums(); ?>
            @if(!empty($breadCrum))
            @foreach($breadCrum as $rowCrum)
                @if(!empty($rowCrum['url']))
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ $rowCrum['url'] }}" class="kt-subheader__breadcrumbs-link">{!! $rowCrum['title'] !!}</a>
                @else 
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span class="kt-subheader__desc">{!! $rowCrum['title'] !!}</span>
                @endif
            @endforeach
            @endif

        </div>
        @endif
    </div>
    <div class="pull-right" data-name="rfhkOLOM">
        @if(empty(config('appSettings.help_disable'))) 
        <a href="#" target="_blank" class="btn btn-label-warning btn-sm pull-right help-article" id="help-article"><i class="la la-exclamation-circle"></i>{{trans('sending_nodes.include_breadcrum_blade.action_help_article')}} </a>
        @endif

        <!-- <a href="#modal-bug-report" data-toggle="modal" class="btn btn-label-info btn-sm btn-bold repoBugBrCr">
            <span class="kt-menu__link-text">{{trans('common.header.report_a_bug')}}</span>
        </a> -->
    </div>
</div>