@extends('layouts.master')

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
	}
	h2.main-title {
	    font-size: 36px;
	    font-weight: 600;
     	margin-bottom: 10px;
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
</style>
@endsection

@section('content')
<div class="row" data-name="FbLpHkrv">
    <div class="container" data-name="oTLrQfQJ">
        <div class="col-md-8 col-md-offset-2 center" data-name="IkFQuZai">
        	<img class="image" src="{{ asset('resources/assets/images/subcomp.jpg') }}" >
        	<h2 class="main-title">{{trans('notifications.errors_subscription_blade.subscription_sucessful_heading')}} </h2>
        	<div class="message" data-name="DTJpBQYn">{{trans('notifications.errors_subscription_blade.subscription_complete_div')}} </div>
        	<div class="content" data-name="RRxHKeUx">{{trans('notifications.errors_subscription_blade.subscription_contact_list_div')}} </div>
        </div>
    </div>
</div>
@endsection