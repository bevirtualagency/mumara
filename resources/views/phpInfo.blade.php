@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<style type="text/css">
	body {
	    background-color: #f2f3f8 !important;
	    color: #222;
	    font-family: sans-serif;
	}
	a:link {
	    color: #1caf9a;
	    text-decoration: none;
	    background-color: transparent;
	}
	.kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__link, .kt-aside-menu .kt-menu__nav>.kt-menu__item>.kt-menu__submenu .kt-menu__subnav>.kt-menu__item>.kt-menu__link {
	    background: #123;
	}
	.kt-aside__brand .kt-aside__brand-logo a {
	    background: #0a1725;
	}
	.kt-quick-panel .kt-quick-panel__nav .nav-tabs .nav-link {
	    border: 1px solid transparent;
	    border-top-left-radius: .25rem;
	    border-top-right-radius: .25rem;
	    border-bottom: 1px solid #bec4d0;
	    padding-bottom: 0px !important;
	    height: 39px;
	}
	h1.p {
	    font-size: 20px;
	    padding-top: 20px;
	}
	.row.filter_bottom>.col-md-12 {
		font-size: 0;
		overflow-x: overlay;
	}
	.row.filter_bottom>.col-md-12 .center {
	    font-size: initial !important;
	}
	.e {
	    background-color: #cfcfcf !important;
	    width: 300px;
	    font-weight: bold;
	}
	.h {
	    background-color: #cfcfcf !important;
	    font-weight: bold;
	}
	tr.h td a img, tr.v td a img  {
	    float: right;
	    border: 0;
	    -webkit-filter: grayscale(100%);
	    filter: grayscale(100%);
	}
</style>
@endsection

@section('page_scripts')
<script src="/js/includes/common.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//$("style").remove();
	});
</script>
@endsection

@section(decide_content())
<div class="col-md-8" data-name="YjiTYdxF">
    <div class="row" data-name="HmRlAgqG">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="DsXlrGPz">
            <div class="kt-portlet__body" data-name="pofwmEvI">
                <div class="row filter_bottom" data-name="jCafgwNR">
                    <div class="col-md-12" data-name="fTYflwUN">
                        {{phpinfo()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection