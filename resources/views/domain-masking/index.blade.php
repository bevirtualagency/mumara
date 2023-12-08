@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/domain-masking-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
<link href="/themes/default/css/sweetalert2.min.css" rel="stylesheet" type="text/css">
<style>
.fa-play:before {
    content: "\f04b";
} 
.ls-status {
    padding-left: 5px;
}   
.ls-status .warn-load {
    color: #777;
    line-height: 1;
}
.ls-status a.btn-warn {
    display: none;
}
h2#swal2-title {
    font-size: 24px;
}
.swal2-html-container {
    font-size: 14px;
}
button.swal2-styled {
    padding: 9px 18px;
    font-size: 13px !important;
    font-weight: 500;
}
.swal2-html-container {
    overflow: unset !important;
}
#deleteMe .alert-danger {
    word-break: break-word !important;
    padding-left: 44px !important;
    display: block !important;
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/sweetalert2.min.js" type="text/javascript"></script>
<script>
    var objTable;
    var record_type = 'our_records';
    var columns = "{{ $columns }}";
    var sortt = 5;
    if(columns==9) { 
        sortt = 6;
    }
    $(document).ready(function() {

      

        setTimeout(() => {
            $(".checkCloaking").each(function() {
                var id = $(this).attr('data-id');
                var dataDomain = $(this).attr('data-domain');
                var warnLoad = '<i class=\"fa fa-spinner fa-spin warn-load\"></i>';
                var awarnLoad = '<a href=\"javascript:;\" class=\"btn-warn\"><i class=\"fa fa-exclamation-triangle text-warning\"></i></a>';
                $(this).html(warnLoad);
                // Ajax call to check cloaking file
                $.ajax({
                    url: "{{ url('/checkCloakingVersion') }}",
                    type: 'POST',
                    data: {domain_id: id},
                    success: function (result) {
                        $(".warn-load").hide();
                        $("a.btn-warn").css("display", "inline");
                        if(result == 'success') {
                            $(".checkCloaking" + id).html("");
                        } else if(result == 'notfound') {
                           
                            var awarnLoad = '<a href=\"javascript:;\" data-domain=' + dataDomain + '  class=\"btn-warn btn-warnnotfound\"><i class=\"fa fa-exclamation-triangle text-warning\"></i></a>';
                            $(".checkCloaking" + id).html(awarnLoad);
                            $(".warn-load").hide();
                            $("a.btn-warn").css("display", "inline");
                        } else {
                            var awarnLoad = '<a href=\"javascript:;\" data-domain=' + dataDomain + '  class=\"btn-warn btn-warnfailed\"><i class=\"fa fa-exclamation-triangle text-warning\"></i></a>';
                            $(".checkCloaking" + id).html(awarnLoad);
                            $(".warn-load").hide();
                            $("a.btn-warn").css("display", "inline");
                        }
                    }
                });
            });
            
            // $(".warn-load").hide();
            // $("a.btn-warn").css("display", "inline");
        }, 1500);

        $("body").on("click", ".btn-warnnotfound",function() {
            var dataDomain = $(this).attr('data-domain');
            var domain = "<?php echo route('domain.phpredirect.download'); ?>";
            Swal.fire({
                title: "There is an issue",
                html: "We were unable to test the cloaking. Download the cloaking file and upload it to your tracking domain  <code>" + dataDomain + "</code> root folder.",
                icon: 'warning',
                // showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonColor: '#5578eb',
                // cancelButtonColor: '#d33',
                confirmButtonText: "Download File" 
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Download successful",
                        text: "The download has been started.",
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    // window.location.href = '/storage/amazonsns.txt';
                    var valFileDownloadPath = domain;
                    window.open(valFileDownloadPath , '_blank');
                }
            });
        });
        $("body").on("click", ".btn-warnfailed",function() {
            var dataDomain = $(this).attr('data-domain');
            var domain = "<?php echo route('domain.phpredirect.download'); ?>";
            Swal.fire({
                title: "There is an issue",
                html: "The cloaking file placed on your tracking domain <code>" + dataDomain + "</code> is old and needs to be updated. Download the latest file and upload to your tracking domain root folder.",
                icon: 'warning',
                // showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonColor: '#5578eb',
                // cancelButtonColor: '#d33',
                confirmButtonText: "Download File" 
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Download successful",
                        text: "The download has been started.",
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    // window.location.href = '/storage/amazonsns.txt';
                    var valFileDownloadPath = domain;
                    window.open(valFileDownloadPath , '_blank');
                }
            });
        });
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Sending-Domains");
        

        var page_limit = 50;
        if(localStorage.getItem("dm_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("dm_pageLength");
        }

        // function in master2 layout
        var page_limit=show_per_page('','dm_pageLength',10);  // Params (table,page,default_limit=10)
        var table= $('#domain_masking').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,1,2,3,4,columns,sortt-1,-1]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[sortt, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/getMaskedDomains?verified={{$verified}}",
            "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
        page_limit=show_per_page(table,'dm_pageLength');
        objTable = table;

        $(document).on('mousemove',"table", function(e) {
            $(".tooltips").tooltip();
        });
        $(document).on('mousemove',".tooltips", function(e) {
            $(".tooltips").tooltip();
        });
    });

    function dnsCheck(id, email_selector, domain_name) {
       $(".loader1_"+id).show();
       var dns_domain = email_selector + '._domainkey.' + domain_name;

       $.ajax({
            url: "{{ URL::route('domain.generate.dns') }}",
            type: 'POST',
            data: {key: 'verify-dns', domain: domain_name, dns_domain: dns_domain},
            success: function (result) {
                if(result == 'available') {
                    $('#verify-dns-'+id).show();
                    $('#verify-dns'+id).html('<i class="fa fa-check text-success tooltips" data-original-title="{{trans('sending_domains.dkim_verified')}}"></i>');
                    $(".loader1_"+id).hide();
                    $('#confirm').hide();
                } else {
                    $(".loader1_"+id).hide();
                    $('#verify-dns-'+id).show();
                    $('#verify-dns-'+id).html('<i class="fa fa-close text-danger tooltips" data-original-title="{{trans('sending_domains.dkim_failed')}}"></i>');
                }
            }
        });
     //  alert(dns_domain);
    }

    function trackdomainCheck(id, tracking_domain, domain_name, ctype) {
        $(".loader2_"+id).show();
        var track_domain = tracking_domain + '.' + domain_name;
        $.ajax({
            url: "{{ URL::route('domain.generate.vtd') }}",
            type: 'POST',
            data: {key: 'verify-track-domain', domain: domain_name, track_domain: track_domain, ctype: ctype},
            success: function (data) {
                // console.log(data);
                if(data == 'available') {
                    $('#verify-masking-htaccess-'+id).show();
                    $('#verify-masking-htaccess-'+id).html('<i class="fa fa-check text-success tooltips" data-original-title="{{trans('sending_domains.tracking_domain_verified')}}"></i>');
                //    $('#verify-masking-cname').show();
                //    $('#verify-masking-cname').html('<i class="fa fa-check text-success"></i>');
                    $(".loader2_"+id).hide();
                //    $('.checked2').hide();
                    $('#confirm').hide();
                } else {
                //    $('#verify-masking-cname').show();
                //    $('#verify-masking-cname').html('<i class="fa fa-close text-danger"></i>');
                    $('#verify-masking-htaccess-'+id).show();
                    $('#verify-masking-htaccess-'+id).html('<i class="fa fa-close text-danger tooltips" data-original-title="{{trans('sending_domains.tracking_domain_failed')}}"></i>');
                    $(".loader2_"+id).hide();
                //    $('.checked2').hide();
                }
            }
        });
    }

    function checkBoth(id, email_selector, tracking_domain, domain_name, type) {

        trackdomainCheck(id, tracking_domain, domain_name, type);
        dnsCheck(id, email_selector, domain_name);

    }

    function viewDomain(id) {
        $.ajax({
            url: "{{ url('/') }}"+'/domain/view/'+id,
            type: "GET",
            success: function(result) {
             //   $(".blockUI").hide();
                $('#domain-data').html(result);
                $("#modal-domain-masking").modal('show');
            }
        });
    }
    $("body").on("click" , '#confirmDelete' , function() {
        var id = $(this).attr("data-id");
        var domain_id = $("#NewDomain").val();
        if(domain_id == "") {
            alert("Please select domain");
            return false;
        }

        var form_data = {
            id:id,
            domain_id:domain_id
        };

        $.ajax({
            url: "{{ url('/') }}"+'/domain/confirm_delete',
            type: "POST",
            data:form_data,
            success: function(result) {
             //   $(".blockUI").hide();
                $('#domain-data-confirm').html(result.content);
                $("#modal-domain-masking").modal('hide');
                $("#modal-confirm_delete").modal('show');
                setTimeout(function(){
                location.reload();
                },2000);
            }
        });
    });

    function maskingDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {

                $.ajax({
                    url: "{{ url('/') }}"+'/domain/'+id,
                    type: "DELETE",
                    success: function(result) {
                        if(result.action == 'delete') {
                            $("#row_"+id).attr("style", "display:none");
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.delete')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-success ');
                        }else{
                            $('#assignedAssets').html(result.content);
                            $("#deleteMe").modal('show');
                            $("#itemToDelete").html('{!!trans('domains.delete_domain.alert')!!}'.replace(':domain',result.domain));
                            $("#new_id").html(result.options);
                            $("#sm").html('{!!trans('sending_domains.assign.to_other')!!}');
                            $("#unassignedAssets").show();
                            $("#moveToLabel").html(result.moveToLabel);
                            $('#mdlTitle').html(result.mdl_title);
                        }
                           
                        
                    }
                });
            }
    }

    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var domain_masking = $('input:checkbox:checked').map(function() {
                return this.value;
        }).get();

        $.ajax({
            type    : "Delete",
            url: "{{ url('/') }}"+'/domain/delete/all/'+domain_masking,
            data    : {ids: domain_masking},
            success: function(result) {
                if(result == 'delete') {
                    location.reload();
                    $('#msg-text').html('{{trans('common.message.delete')}}');
                }
                else{
                    $('#assignedAssets').html(result.content);
                    $("#deleteMe").modal('show');
                    $("#itemToDelete").html('{!!trans('domains.delete_domain.alert')!!}'.replace(':domain',result.domain));
                    $("#new_id").html(result.options);
                    $("#sm").html('{!!trans('sending_nodes.assign.to_other')!!}');
                    $("#unassignedAssets").show();
                    $("#moveToLabel").html(result.moveToLabel);
                    $('#mdlTitle').html(result.mdl_title);
                }

            }
        });

        }
    }

    function setConfirm(id) {
        $.ajax({
            url: "{{ url('/') }}"+'/domain/confirm/'+id,
            type: "GET",
            success: function(result) {
                if(result == 'success'){
                    alert('{{trans('sending_domains.message.congrats_domain_confirmed')}}');
                    location.reload();
                }else{
                    alert('{{trans('sending_domains.message.technical_error')}}');
                }
            }
        });
    }

    function changeStatus(id , status) { 
        $.ajax({
            url: "{{ url('domain/tracking_status') }}",
            type: 'POST',
            data: {id: id, status: status},
            success: function (result) {
                
            }
        });
    }
    $('#deleteItem').live('click',function (){
        new_id = $('#new_id').val();
        old_id = $('#old_id').val();
        $('#new_id-error').html('').hide();
        if(new_id=="")
            $('#new_id-error').html('{{trans('sending_domains.index_blade.select_domain_html')}}').show();
        else{
            $.ajax({
                url: "{{ route('confirmDeleteDomain') }}",
                type: 'POST',
                data: {'id': old_id, 'domain_id': new_id},
                success: function (result) {
                        if(result.action=='delete')
                        {
                            toastr.success(result.content);
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                }
            });
        }

    });
    $('#new_id').live('change',function (){
       val =  $('#new_id').val();
       if(val=="")
           $('#deleteItem').hide();
       else
           $('#deleteItem').show();
    });
</script>
    @include('includes.view-pages-filter-script')
@endsection


@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="ethivfmS">
    {{ Session::get('msg') }}
</div>
@endif
@if (Session::has('alert'))
<div class="alert alert-danger" data-name="AKCytSLn">
    {{ Session::get('alert') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="BERjWjzh">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="JfNhLTTg">
    <div class="col-md-12" data-name="POPvYgxx">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
         <div class="kt-portlet kt-portlet--height-fluid" data-name="HQkDiEMy">
            <div class="kt-portlet__body" data-name="CltfLsmz">
                <div class="table-toolbar" data-name="FZXwEtLB">
                    <div class="form-group row" data-name="xQBZPTba">
                        <div class="col-md-12" data-name="qIcCezjJ">
                            @if(routeAccess('domain.create'))
                            <div class="btn-group" data-name="NtyggGYl">
                                <a href="{{ route('domain.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                            @endif
                            @if($sending_domain_limit > 0)
                            <button class="btn btn-label-warning btn-sm" id="contacts_limit">{{trans('sending_domains.index_blade.domain_limit_button')}}: {{$total_sending_domain}} / {{$sending_domain_limit}}</button>
                            @endif
                        
                            <input type="hidden" name="verified" value="1">
                        </div>
                    </div>
                </div>
                @include('includes.view-pages-filter')
                           
                <table class="table table-striped table-hover table-checkable responsive" id="domain_masking" role="grid" >
                    <thead>
                        <tr role="row">
                            <!-- <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th> -->
                            <th>{{trans('sending_domains.table_headings.sending_domain')}}</th>
                            <th>{{trans('sending_domains.table_headings.tracking_prefix')}}</th>
                            <th>{{trans('sending_domains.table_headings.redirection_type')}}</th>
                            <th>{{trans('sending_domains.table_headings.dkim')}}</th>
                            <th>{{trans('sending_domains.table_headings.tracking_domain')}}</th>
                            @if($columns==9)
                            <th>{{trans('sending_domains.table_headings.verified')}}</th>
                            @endif
                            <th>{{trans('sending_domains.table_headings.created_on')}}</th>
                        <!--    <th>{{trans('app.domain_masking.view_all.table_headings.last_checked')}}</th> -->
                            <th>{{trans('sending_domains.table_headings.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<div id="modal-domain-masking" class="modal" role="dialog" aria-hidden="true" style="display: none" data-name="SxJlzYrI">
    <div class="modal-dialog" style="width: 600px;" data-name="ZuEQVgDt">
        <div class="modal-content" data-name="cBItbyFV">
            <div class="modal-header" data-name="YeKhyfFm">
                <h5 class="modal-title">{{trans('sending_domains.table_headings.sending_domain')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="JsZSVkDo">
                <div class="row" data-name="wOrWKJTl">
                    <div class="col-md-12" data-name="ZdJFscPT">
                        <span class="alert alert-danger"> {{trans('common.message.alert_delete')}} </span>
                    </div>
                </div>
                <div class="row" data-name="hIEztatv">
                    <div class="col-md-12" data-name="IKQszkeO">
                        <div id="domain-data" data-name="IOILIuJf"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modal-confirm_delete" class="modal" role="dialog" aria-hidden="true" style="display: none" data-name="fCUnevNf">
    <div class="modal-dialog" style="width: 600px;" data-name="UsZijeHJ">
        <div class="modal-content" data-name="fvOzWCwN">
            <div class="modal-header" data-name="NJaiLLqP">
                <h5 class="modal-title"> @lang('sending_domains.page.data_moved')
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="location.reload()" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="PQtTNSxS">
                <div class="row" data-name="MMQRhXbX">
                    <div class="col-md-12" data-name="KndEownx">
                        <span class="alert alert-success">
                            <div id="domain-data-confirm" data-name="ucEYvKfE"></div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('common.deleteAssetsModal')
@endsection