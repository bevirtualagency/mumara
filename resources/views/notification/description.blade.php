@extends('layouts.master')

@section('title', trans('app.settings.notifications.view_all.title'))

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="LovqDpif">
    <ul class="page-breadcrumb">
        <li>
            <span>
                {{trans('app.settings.title')}}
            </span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>
                <a href="{{ route('view.notification') }}">{{trans('app.settings.notifications.title')}}</a>
            </span>
        </li>
    </ul>
</div>
<br>
<div class="row" data-name="XDyYQmum">
    <div class="col-md-12" data-name="GDUrtJJV">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet box green" data-name="tZqxZmRv">
                            <div class="portlet-title" data-name="giqemAwD">
                            <ul class="pagination pagination-sm">
                                <li>
                                    @if($previous)
                                    <a href="{{ route('notification.show',  $previous) }}">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    @endif
                                </li>
                                 <li>
                                    @if($next)
                                    <a href="{{ route('notification.show',  $next ) }}">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    @endif
                                </li>
                                </ul>
                                <div class="caption" data-name="AgSBxqJA">
                                    <i></i>{{$notifications->title}}</div>
                            </div>
                            <div class="portlet-body" data-name="MOVkqHsy">
                                <div class="scroller" style="height:200px" data-name="Hyntzzzs">
                                     {{$notifications->description}} </div>
                            </div>
                        </div>

    </div>
</div>
@endsection