@extends('layouts.master2')

@section('title', 'Lists')

@section('page_styles')
<style type="text/css">
	.page-header.navbar.headerMain {
	    display: none;
	}
	.page-sidebar-wrapper {
	    display: none;
	}
	.page-content-wrapper .page-content {
	    margin-left: 0 !important;
	}
	.page-header.navbar .menu-toggler.sidebar-toggler {
	    display: none;
	}
	.center {text-align: center;}
	img.image {
	    margin: 100px auto 20px;
	    max-width: 60%;
	}
	h2.main-title {
	    font-size: 24px;
	    font-weight: 600;
	    margin-bottom: 10px;
	    line-height: 1.5;
	    margin-top: 15px;
	}
	.message {
	    font-size: 24px;
	}
	.content {
	    font-size: 16px;
	    margin-top: 10px;
	}
	.page-header.navbar .top-menu .navbar-nav {
	    display: none !important;
	}
	.ctime .clock {
	    padding: 20px 30px 20px 10px;
	}
	.page-content {
	    background: url(resources/assets/images/bg5.jpg);
	    background-position: right center;
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	h1.heading {
	    font-size: 110px;
	    font-weight: bold;
	    line-height: 1;
	    color: #324da8;
	    margin-top: 100px;
	    margin-bottom: 0;
	}
	.menus {
	    max-width: 600px;
	}
	.menus ul {
	    padding: 0;
	    list-style-type: none;
	    width: 100%;
	}
	.menus ul li {
	    line-height: 1;
	    font-size: 13px;
	    padding: 10px 10px 10px 15px;
	    margin-bottom: 5px;
	    border-left: 5px solid #36c6d3;
	    transition: 1s all;
	    cursor: help;
	    width: 48%;
	    float: left;
	    display: inline-block;
	}
	.menus ul li:hover {
	    transition: 1s all;
	    padding-left: 17px;
	    background: #f7f7f7;
	    border-color: #333;
	}
	.menus ul li:hover a {
		color: #333;
	}
	.mb25 {margin-bottom: 25px;}
	@media (max-width: 1400px) {
		h1.heading {
		    font-size: 70px;
		    margin-top: 50px;
		}
		h2.main-title {
		    font-size: 18px;
		    margin-bottom: 5px;
		}
	}
	@media (max-width: 767px) {
		.menus ul li {
		    clear: both;
		}
		.page-content {
		    background-position: 80% 50%;
		}
	}
</style>
@endsection

@section('content')
<div class="row" data-name="NtXLnDDt">
    <div class="col-md-6 col-md-offset-1 mb25" data-name="GKtCwPDa">
    	<h1 class="heading">{{trans('notifications.woops_blade.woop_heading')}} ...!</h1>
    	<h2 class="main-title">{{trans('notifications.woops_blade.look_page_heading')}}</h2>
    	<div class="col-md-6" data-name="SCYFLvmb">
    		<div class="row" data-name="IXDuaShT">
    			<div class="form-group" data-name="uhFVENjg">
	    			{{trans('notifications.woops_blade.variations_random_div')}}
	    		</div>
    		</div>
    		<form class="form-horizontal" method="post" action="">
    			<div class="form-group" data-name="paBZhwpb">
	    			<textarea class="form-control" name="woops" placeholder="Ask here if you need any assistance."></textarea>
	    		</div>
    			<div class="form-group" data-name="RorolbtM">
	    			<button type="button" class="btn btn-success">{{trans('notifications.woops_blade.button_submit')}}</button>
	    		</div>	
	    	</form>
    	</div>
    </div>

    <div class="col-md-6 col-md-offset-1" data-name="VxrvizSV">
    	<h2 class="main-title">{{trans('notifications.woops_blade.helpful_links_button')}}</h2>
    	<div class="menus" data-name="QFLlmydL">
    		<ul>
    			<li><a href="{{ URL('/') }}">{{trans('notifications.woops_blade.action_dashboard')}} </a></li>
    			<li><a href="{{ URL('/list') }}">{{trans('notifications.woops_blade.action_view_lists')}} </a></li>
    			<li><a href="{{ URL('/contact') }}">{{trans('notifications.woops_blade.action_view_contacts')}} </a></li>
    			<li><a href="{{ URL('/broadcasts') }}">{{trans('notifications.woops_blade.action_view_campaings')}} </a></li>
    			<li><a href="{{ URL('/form/create') }}">{{trans('notifications.woops_blade.action_create_webform')}} </a></li>
    			<li><a href="{{ URL('/setting/general') }}">{{trans('notifications.woops_blade.action_application_settings')}} </a></li>
    			<li><a href="{{ URL('/setting/whitelabel') }}">{{trans('notifications.woops_blade.action_white_labeling')}} </a></li>
    			<li><a href="{{ URL('/statistics/broadcasts') }}">{{trans('notifications.woops_blade.action_broadcast_stats')}} </a></li>
    			<li><a href="{{ URL('/setting/update') }}">{{trans('notifications.woops_blade.action_update_application')}} </a></li>
    		</ul>
    	</div>
    </div>

</div>
@endsection