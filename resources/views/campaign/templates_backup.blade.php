@extends(decide_template())

@section('title', $pageTitle)
<link href="/resources/assets/css/templates.css" rel="stylesheet" type="text/css" />
@section('page_styles')
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $("#templates").dataTable();
        $("#close-popup").on("click",function() {
			$(".popupImgBlk").removeClass("show").addClass("hide");
		});
		$("#templates").on("click", ".viewImage", function() {
			var image =$(this).attr("data-image");
			$("#tempImg").attr("src", image)
			$(".blockUI").show();
			setTimeout(() => {
				$(".popupImgBlk").removeClass("hide").addClass("show");
				$(".blockUI").hide();
			}, 500);
			console.log(image);
		});
        $("#templates").on("click", "a.btn-new", function() {
			var name =$(this).attr("data-name");
			window.localStorage.setItem('temp-name', name);
			window.location = '/broadcast/add';
		});
    });
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="popupImgBlk hide">
	<div class="flaticon2-cross text-link" id="close-popup"></div>
	<div class="pic scroll">
		<img id="tempImg" src="/public/img/empty.png" >
	</div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                <div class="table-toolbar">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="btn-group">
                                <a href="{{ route('broadcasts.template') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    {{trans('broadcasts.templates.button_upload')}}
                                </button></a>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('broadcasts.template') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    {{trans('broadcasts.templates.button_marketplace')}}
                                </button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-checkable responsive" id="templates" role="grid" >
                    <thead>
                        <tr role="row">
                            <th>{{trans('broadcasts.templates.table.name')}}</th>
                            <th>{{trans('broadcasts.templates.table.category')}}</th>
                            <th>{{trans('broadcasts.templates.table.reiews')}}</th>
                            <th>{{trans('broadcasts.templates.table.created_on')}}</th>
                            <th>{{trans('broadcasts.templates.table.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white ">
                                            <img src="/public/img/templates/Catalog.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Catalog.png">{{trans('broadcasts.templates_backup_blade.catalog_collection_action')}}</a>
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                    <!-- <div class="title-hober-block">
                                        <img src="/public/img/templates/Catalog.png" alt="Template">
                                        <span>
                                            Catalog Collection
                                            <span>{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                        </span>
                                    </div> -->
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.catalog_span')}}</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(247)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 29, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Invoice.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Invoice.png">{{trans('broadcasts.templates_backup_blade.invoice_template_action')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.invoice_txt_span')}}</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}} </span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(154)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 26, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-01.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-01.png">{{trans('broadcasts.templates_backup_blade.main_one_template_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_one_span')}}</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(98)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 23, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-02.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-02.png">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-02 {{trans('broadcasts.templates_backup_blade.template_text_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-02</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(87)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 21, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-03.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-03.png">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-03 {{trans('broadcasts.templates_backup_blade.template_text_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-03</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(298)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 19, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-04.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-04.png">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-04 {{trans('broadcasts.templates_backup_blade.template_text_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-04</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(384)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 15, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-05.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-05.png">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-05 {{trans('broadcasts.templates_backup_blade.template_text_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-05</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(132)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 13, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-06.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-06.png">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-06 {{trans('broadcasts.templates_backup_blade.template_text_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-06</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(239)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 11, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-07.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-07.png">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-07 {{trans('broadcasts.templates_backup_blade.template_text_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-07</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(19)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 09, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-08.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-08.png">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-08 {{trans('broadcasts.templates_backup_blade.template_text_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-08</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(78)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 05, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-09.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-09.png">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-09 {{trans('broadcasts.templates_backup_blade.template_text_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-09</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(267)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 03, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light mr-4">
                                        <span class="symbol-label bg-white">
                                            <img src="/public/img/templates/Main-10.png" alt="Template">
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 viewImage" data-image="/public/img/templates/Main-10.png">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-10 {{trans('broadcasts.templates_backup_blade.template_text_span')}}</a> 
                                        <span class="text-muted font-weight-bolder d-block font-md">{{trans('broadcasts.templates_backup_blade.mumara_template_span')}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block">{{trans('broadcasts.templates_backup_blade.main_text_span')}}-10</span>
                                <span class="text-muted font-weight-bolder font-md">{{trans('broadcasts.templates_backup_blade.campaign_group_span')}}</span>
                            </td>
                            <td>
                                <div class="reviews-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="review-count">(356)</span>
                                </div>
                            </td>
                            <td>
                                {{trans('broadcasts.templates_backup_blade.july_month')}} 01, 2021
                            </td>
                            <td>
                                <a href="javascript:;" class="btn btn-icon text-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-success active">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-warning">
                                    <i class="fa fa-ban"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-icon text-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection