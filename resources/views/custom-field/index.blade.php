@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/custom-fields-view.css?v={{$local_version}}.022" rel="stylesheet" type="text/css">
<link href="/themes/default/css/sweetalert2.min.css" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/common.js" type="text/javascript"></script>
    <script src="/themes/default/js/sweetalert2.min.js" type="text/javascript"></script>
    <script>
        var objTable;
        var record_type = 'our_records';
        $(document).ready(function () {
            $("a#help-article").css("display", "block");
            $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Lists/Custom-Fields");
            // function in master2 layout
            var page_limit = show_per_page('', 'cf_pageLength', 9);  // Params (table,page,default_limit=10)
            var table = $('#custom-fields').DataTable({
                "aoColumnDefs": [{"bSortable": false, "aTargets": [4]}],
                "bProcessing": true,
                "bServerSide": true,
                "aaSorting": [[0, "desc"]],
                "sPaginationType": "full_numbers",
                "sAjaxSource": "{{ url('/getCustomFields') }}",
                "pageLength": page_limit,
                "fnServerParams": function (aoData) {
                    aoData.push({"name": "record_type", "value": record_type});
                    aoData.push({"name": "clients", "value": $("#clients").val()});
                    aoData.push({"name": "admins", "value": $("#admins").val()});
                },
                "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]],
                "fnPreDrawCallback": function (sAjaxSource) {
                    //   console.log(sAjaxSource);
                    if (sAjaxSource._iRecordsTotal == 0) {
                        //$(".subscribers-tbl-ajax").hide();
                    } else {
                        ///        $(".subscribers-tbl-ajax").show();
                    }
                },
            });
            objTable = table;
            page_limit = show_per_page(table, 'cf_pageLength');

        });

        // delete custom field function
        function deleteCustomField(id,force=null) {
            $.ajax({
                url: "{{ route('fields.destroy','') }}/" + id,
                type: "DELETE",
                beforeSend:function (){
                    $(".blockUI").show();
                    $("#deleteMe").modal('hide');
                    $("#mdlTitle").html('');
                    $(".issue-1").hide();
                    $(".issue-2").hide();
                    $("#assignedAssets").html('');
                    $("#deleteItem").removeAttr('onclick');
                },
                data:{'force':force},
                success: function (result) {
                    $(".blockUI").hide();
                    if (result == 'delete') {
                        $("#row_" + id).attr("style", "display:none");
                        Command: toastr["success"]("{{trans('common.message.delete')}}");
                    }
                    else if(result == 'no_data')
                    {
                        Swal.fire({
                            title: "",
                            text: "Are you sure you want to delete custom field?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            cancelButtonText: "Cancel",
                            confirmButtonText: "Yes Delete!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{ route('fields.destroy','') }}/" + id,
                                    type: "DELETE",
                                    data: {'force': 1},
                                    success: function (result) {
                                        Swal.fire({
                                            text: "Custom field deleted successfully!",
                                            icon: "success",
                                            showConfirmButton: false,
                                            closeClick: false,
                                            timer: 2000
                                        })
                                        objTable.draw();
                                    }
                                });

                            }
                        });
                    }
                    else  {
                        $("#mdlTitle").html(result.alert);
                        $("#assignedAssets").html(result.data);
                        if(result.error_1)
                            $(".issue-1").show();
                        else
                            $(".issue-2").show();
                        $("#deleteItem").attr('onclick',result.method);
                        $("#deleteMe").modal('show');
                    }
                }
            });
        }

        $(document).ready(function() {



            $(".delete-list").click(function() {
                var check = $(this).is(":checked");
                if(check === true) {
                    $("#deleteItem").removeAttr("disabled");
                } else {
                    $("#deleteItem").attr("disabled", "disabled");
                }
            });
            $(".delete-list2").click(function() {
                var check = $(this).is(":checked");
                if(check === true) {
                    $("#deleteItem").removeAttr("disabled");
                } else {
                    $("#deleteItem").attr("disabled", "disabled");
                }
            });
        });
    </script>

    @include('includes.view-pages-filter-script')
@endsection
@section(decide_content())

    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="VbGHZFMf">
            {{ Session::get('msg') }}
        </div>
    @endif
    <div id="msg" class="display-hide" data-name="wuciFdae">
        <button class="close" data-close="alert"></button>
        <span id='msg-text'><span>
    </div>
    <div class="row" data-name="UKaChrmV">
        <div class="col-md-12" data-name="jzdJeknz">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="kt-portlet kt-portlet--height-fluid" data-name="lMSeNHuL">
                <div class="kt-portlet__body" data-name="NcZctTie">
                    <div class="table-toolbar" data-name="vRJjWcLs">
                        <div class="form-group row" data-name="RCqDLbdE">
                            <div class="col-md-12" data-name="fottQcCk">
                                @if (routeAccess('fields.create'))
                                    <div class="btn-group" data-name="uUREPBjU">
                                        <a href="{{ route('fields.create') }}">
                                            <button id="sample_editable_1_new" class="btn btn-label-success">
                                                <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}}
                                            </button>
                                        </a>
                                    </div>
                                @endif
                               {{-- @if (routeAccess('fields.destroy'))
                                    <div class="btn-group pull-right" data-name="mGPmTciy">
                                        <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                            {{ trans('common.actions') }}
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">

                                            <li>
                                                <a href="javascript:;" onclick="deleteAll();" class=""> <i
                                                            class="la la-close"></i> {{trans('common.form.buttons.delete')}}
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                @endif--}}
                            </div>
                        </div>
                    </div>
                    @include('includes.view-pages-filter')
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover table-checkable" id="custom-fields"
                            role="grid">
                            <thead>
                            <tr role="row">
                                <th>{{trans('custom_fields.table_headings.name')}}</th>
                                <th>{{trans('custom_fields.table_headings.sorting_order')}}</th>
                                <th>{{trans('custom_fields.table_headings.type')}}</th>
                                <th>{{trans('custom_fields.table_headings.created_at')}}</th>
                                <th>{{trans('custom_fields.table_headings.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!--Delete modal-->
    <div id="deleteMe" class="modal deleteMe show" role="dialog" aria-hidden="true" data-keyboard="false"
         data-backdrop="static" data-name="dUYpphtk">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 600px;" data-select2-id="13" data-name="GFioYzVb">
            <div class="modal-content" data-select2-id="12" data-name="JJWvkHWS">
                <div class="modal-header" data-name="hVxuPKRo">
                <h5 id="mdlTitle" class="modal-title"></h5>
                </div>
                <div class="modal-body" data-name="gbkdXWDM">
                    <div class="row" data-name="JDrCwZwv" style="display:none">
                        <div class="col-md-12" data-name="TGaZsong">
                            <span class="alert-delete-message" id="itemToDelete"></span>
                        </div>
                    </div>
                    <div class="issue-1 fs-5 fw-bold mb1">{{trans('custom_fields.delete_field.issue_1')}}</div>
                    <div class="issue-2 fs-5 fw-bold mb1">{{trans('custom_fields.delete_field.issue_2')}}</div>
                    
                    <span class="alert alert-danger issue-1">
                        <span class="alert-text">{!!trans('custom_fields.delete_field.warning_1')!!}</span>
                    </span>
                    <span class="alert alert-warning issue-2">
                        <span class="alert-text">{!!trans('custom_fields.delete_field.warning_2')!!}</span>
                    </span>

                    <div id="domain-data" class="issue-1" data-name="oyaHdXQR">
                        <div class="list-block" data-name="bDplkoVS">
                            <div id="assignedAssets" class="row list-scroll" data-name="BwVlKOtK">

                            </div>
                        </div>
                    </div>

                    <div class="delete-options issue-1" data-name="oyaHdXQR">
                        <div class=" col-md-12">
                            <label class="col-form-label">{{trans('custom_fields.table_headings.actions')}}</label>
                            <p>{{trans('custom_fields.delete_field.alert_1')}}</p>
                            <div class="kt-checkbox-list mb2">
                                <label class="kt-checkbox kt-checkbox-outline">
                                    <input class="delete-list" type="checkbox" id="unassign" name="unasign" />
                                    {{trans('custom_fields.delete_field.alert_2')}}
                                    <span></span>
                                </label>
                            </div>
                            <span class="alert alert-info mb0">
                                <span class="alert-text">{!!trans('custom_fields.delete_field.note')!!}</span>
                            </span>
                        </div>
                    </div>

                    <div class="delete-options issue-2" data-name="oyaHdXQR">
                        <div class=" col-md-12">
                            <div class="kt-checkbox-list">
                                <label class="kt-checkbox kt-checkbox-outline">
                                    <input class="delete-list2" type="checkbox" id="understand" name="understand" />
                                    {{trans('custom_fields.delete_field.consent')}}
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer" data-name="lCYRZcBU">
                    <button type="button" class="btn btn-secondary btn-sm pull-left" data-dismiss="modal">{{trans('custom_fields.delete_field.cancel_btn')}}</button>
                    <button  type="button" class="btn btn-danger btn-sm pull-right" id="deleteItem" disabled>{{trans('custom_fields.delete_field.delete_btn')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection