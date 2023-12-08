@extends('layouts.master')

@section('title', trans('app.settings.notifications.view_all.title'))

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="eclaMtTl">
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
<div class="row" data-name="DKANuVZY">
    <div class="col-md-12" data-name="bRCrcnLm">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="HdeFqxUZ">
            <div class="portlet-body" data-name="XmRqtNZb">
                <div class="table-toolbar" data-name="BLRBnSwN">
                    <div class="row" data-name="kzKQAQwp">
                        <div class="portlet light" data-name="VDjgRJjk">
                            <div class="portlet-title tabbable-line" data-name="IqoyzhtJ">
                                <div class="caption caption-md" data-name="oGAjGriT">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison">{{trans('app.settings.notifications.title')}}</span>
                                </div>
                                <ul class="nav nav-tabs">
                                </ul>
                            </div>
                                <div class="portlet-body" data-name="wSxABVRQ">
                                <!--BEGIN TABS-->
                                <div class="tab-content" data-name="qkddhvne">
                                            <ul class="feeds">
                                            @foreach($user_notifications as $notification)
                                                <li>
                                                    <div class="col1" data-name="mCPlCzIj">
                                                        <div class="cont" data-name="sqyvBLep">
                                                            <div class="cont-col1" data-name="beRCtwZy">
                                                                <div class="label label-sm label-success" data-name="HjyPoVBz">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2" data-name="niOdxNzi">
                                                                <div class="desc" data-name="ieZDSNHl"> 
                                                                <a href="{{ route('notification.show',  $notification->notification_id ) }}" style="text-decoration:none">
                                                                @if($notification->is_read)
                                                                {{$notification->notification_title}}
                                                                @else
                                                                <b>{{$notification->notification_title}}</b>
                                                                @endif
                                                                </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="date pull-right" data-name="UCYfvqQY"> {{ showDateTime(Auth::user()->id, $notification->created_at, 1)}} </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                    </div>
                                <!--END TABS-->
                                </div>
                    </div>
                </div>
                    <div class="pull-right" data-name="oRGHnWRV">{{ $user_notifications->links() }}</div>
                <div class="dataTables_wrapper no-footer" data-name="aaEPxGhq">
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection