@extends('layouts.master')

@section('title', trans('web_templates.accessdenied_blade.title_access_denied'))

@section('page_styles')
	<style type="text/css">
		h1, h2, h3, h4, h5, h6, p {
		    font-family: "Open Sans", sans-serif !important;
		    color: #5c6873 !important;
		    font-weight: 400 !important;
		    letter-spacing: 0.1px !important;
		}
		h1.m-form__heading-title.text-success.text-center {
			font-size: 60px;
			font-weight: bold;
		}
		.m-main {
			height: auto !important;
		}
		.m-main .m-portlet__body {
			padding: 25px !important;
			height: 100%;
		}
		.m-body .m-content {
			padding: 30px;
		}
		.m-portlet .m-portlet__head .m-portlet__head-caption .m-portlet__head-title .m-portlet__head-text {
			font-size: 2.3rem;
		}
		.form-body ul {
			list-style-type: none;
			margin: 10px 0;
			padding: 0;
		}
		.form-body ul li {
			line-height: 1.6;
		}
		.form-body ul li input[type=radio] {
			width: 16px;
			height: 16px;
			vertical-align: middle;
		}
		.m-subheader {
			display: none;
		}
		.m-portlet {
			margin-bottom: 0;
		}

		.m-grid .m-grid__item .m-wrapper {
			//max-width: 50%;
			margin: auto;
		}
		.m-grid .m-grid__item .m-wrapper .m-main {
			width: 100%;
			margin: 0;
			padding: 0;
		}
		@media (min-width: 1025px) {
			.m-footer--push.m-aside-left--enabled:not(.m-footer--fixed) .m-aside-right, .m-footer--push.m-aside-left--enabled:not(.m-footer--fixed) .m-wrapper {
				//max-width: 50%;
				margin: auto;
			}
		}
		@media (max-width: 1024px) {
			.m-grid .m-grid__item .m-wrapper {
				max-width: 90%;
			}
		}
		@media (max-width: 767px) {
			.image-center img {
				max-height: 250px;
			}
			.mainContent.m-portlet__body.m-portlet__body--no-padding {
				text-align: center;
			}
			h2.m-portlet__head-text {
				font-size: 120px !important;
				margin-top: 0 !important;
			}
			.mainContent p {
				margin: 0;
				padding: 0;
				display: inline;
				margin-right: 5px;
			}
			.mainContent button#submit {
				display: block;
				float: none;
				text-align: center;
				margin: 0 auto;
				margin-top: 10px;
				margin-bottom:15px;
			}
		}
		@media (max-width: 480px) {
			.m-grid .m-grid__item .m-wrapper {
				max-width: 100%;
			}
			.m-body .m-content {
				padding: 0px;
			}
		}

		.m-portlet .m-portlet__head {
			height: 0px;
			border-bottom: 0 !important;
		}
		.mainContent {
			padding: 25px 0 0;
		}
		h2.m-portlet__head-text {
			font-size: 150px;
			font-weight: 100 !important;
			line-height: 1;
			margin-bottom: 40px;
			margin-top: 140px;
			color: #5c6873;
		}
		.image-center {
			text-align: center;
		}
		.image-center img {
			text-align: center;
			margin: 20px auto 30px;
			width: auto;
			max-height: 600px;
		}
		a {
			color: #34bfa3;
		}
		@media (min-width: 992px){
			.page-content-wrapper .page-content {
			    min-height: 90vh !important;
			}
		}
	</style>
@endsection

@section('page_scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			
			$("#submit").click(function() {
				window.location.href = app_url+"/";
			});
		});
	</script>
@endsection

@section('content')
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body" data-name="SbEckMZF">
	<div class="m-grid__item m-grid__item--fluid m-wrapper" data-name="bZrWRArK">
		<div class="m-main" data-name="MLszHHgm">
			<div class="m-content" data-name="SJAlUjqY">
				<div class="m-portlet m-portlet--full-height" data-name="bPdhEuRU">
					<div class="m-portlet__head" data-name="hQuPvyEf">&nbsp;</div>

					<div class="row" data-name="ccsVBFbO">
						<div class="col-md-5 image-center" data-name="pywrQgaB"><img src="../resources/assets/images/403.png"></div>
						<div class="col-md-7" data-name="ktxJLzli">
							<div class="mainContent m-portlet__body m-portlet__body--no-padding" data-name="hSQTyEBB">
								<h2 class="m-portlet__head-text counterUp">{{trans('web_templates.accessdenied_blade.heading_ops')}} </h2>

								<h2 class="title">{{trans('web_templates.accessdenied_blade.gate_closed_heading')}}</h2>

								<p>{{trans('web_templates.accessdenied_blade.this_gate_publicly_para')}} </p>
								<button class="btn btn-success button-submit" id="submit" type="button">{{trans('web_templates.accessdenied_blade.go_to_dashboard_button')}}</button>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection