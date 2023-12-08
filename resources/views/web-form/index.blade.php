@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/webform-view.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/timepicker-init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>

<script>
   function showCaptcha(key)
    {
            $.ajax({
                url: 'https://www.google.com/recaptcha/api.js?render='+key,
                dataType: 'script',
                success: function ()
                {

                }
                ,complete: function (data) {
                    grecaptcha.ready(function() {
                        grecaptcha.execute(key, {action: "addContact"}).then(function(token) {
                            if (token) {
                                $('.grecaptcha-badge').show();
                                document.getElementById("recaptcha").value = token;
                            }
                            else{

                            }
                        });
                    });

            }
            });
    }
    function hideGcaptcha()
    {
        $('.grecaptcha-badge').hide();
        $('#recaptcha').val('');
        location.reload(true);
    }
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Web-Forms");

        $('.m-select2').select2({
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
        // function in master2 layout
        var page_limit=show_per_page('','web_forms_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#web_forms').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,2,3,5]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[4, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getWebForms') }}",
             "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
            aoData.push({"name": "record_type", "value": record_type});
            aoData.push({"name": "clients", "value": $("#clients").val()});
            aoData.push({"name": "admins", "value": $("#admins").val()});
        },
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
         page_limit=show_per_page(table,'web_forms_pageLength');
         objTable = table;
    });

    function webformDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/form/'+id,
                    type: "DELETE",
                    dataType:'json',
                    success: function(result) {
                    if(result.status == 'success') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html(result.message);
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');
                        objTable.draw();
                    }
                }
                });
            }
    }
    function copy_link(containerid) {
        var range = document.createRange();
        range.selectNode(containerid); //changed here
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        Command: toastr["success"] ("{{ trans('web_forms.copy_url.success') }}!");
    }
    function copyFormURL(id) {
            $.ajax({
                url: "{{ url('/') }}"+'/get-form-url/'+id,
                type: "get",
                dataType:'json',
                success: function(result) {
                if(result.status == 'success') {
                   var url = result.data.url;
                   $("#formUrl").val(url);
                   
                   var dummyContent = $("#formUrl").val();
                   $("#user_port").html(dummyContent);
                   copy_link(user_port);
                  // var dummy = $('<input>').val(dummyContent).appendTo('#formUrldata').select()
                   //var dummy = $("#formUrldata").val("dummyContent").select();
                   
                  // document.execCommand('copy')
                  // Command: toastr["success"] ("{{ trans('web_forms.copy_url.success') }}");                    
                }
            }
            });                       
    }
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var webforms = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/form/"+webforms,
                data    : {ids: webforms},
                dataType:'json',
                success: function(result) {
                   if(result.status == 'success') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html(result.message);
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');
                        objTable.draw();
                    }
                }
            });
        }
    }

    function getFormData(id,type,design_id=0)
    {
        $.ajax({
        url: "{{ url('/') }}"+'/form/load/data/'+id,
        type: "GET",
        data: {type: type},
        success: function (data) {
            $('#custom-fields-data').html(data);            
            $("#webFormdesignpopUp").removeClass("modal-lg");
            if(design_id > 0){
                $("#webFormdesignpopUp").addClass("modal-lg");
            }
            $("#modal-web-form").modal('show');
            //webFormdesignpopUp
            }
        });
    }

</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="xdFutVzs">
    {{ Session::get('msg') }}
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger" data-name="jBashwjJ">
    {{ Session::get('error') }}
</div>
@endif

<div id="msg" class="display-hide" data-name="sdFsfVPt">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>

<div class="row" data-name="nGwEQivl">
    <div class="col-md-12" data-name="xQEnqYLg">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <span id="user_port" style="height: 0;width: 0; font-size: 0px;"></span>
        <div class="kt-portlet kt-portlet--height-fluid" data-name="PRROOaVT">
            <div class="kt-portlet__body" data-name="zpsDKRXS">
                <div class="table-toolbar" data-name="ZFAwxcsx">
                    <div class="form-group row" data-name="iWdREVOu">
                        <div class="col-md-12" data-name="BtKXrmcs">
                            <input type="hidden" name="formUrl" id="formUrl" value="" />
                            
                           @if(routeAccess('form.create'))
                            <div class="btn-group" data-name="CIIwjeJb">
                                <a href="{{ route('form.templates') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif
                           @if(routeAccess('view.web.form.design'))
                            <div class="btn-group" data-name="CIIwjeJb">
                                <a href="{{ route('view.web.form.design') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                     {{trans('web_forms.add_new.form.web_form_templates')}} 
                                </button></a>
                            </div>
                           @endif
                           @if(routeAccess('form.destroy'))
                           <div class="btn-group pull-right" data-name="lsmcdZRk">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @include('includes.view-pages-filter')

                    <table class="table table-striped table-hover responsive table-checkable" id="web_forms" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('web_forms.table_headings.name')}}</th>
                                <th>{{trans('web_forms.table_headings.double_option')}}</th>
                                <th>{{trans('web_forms.table_headings.thankyou_action')}}</th>
                                <th>{{trans('web_forms.table_headings.added_on')}}</th>
                                <th>{{trans('web_forms.table_headings.actions')}}</th>
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
<!-- Model -->
<div id="modal-web-form" class="modal" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true" data-name="uhSQeVsh">
    <div class="modal-dialog modal-lg modal-dialog-centered" data-name="NsfRGBln" id="webFormdesignpopUp">
        <div class="modal-content" data-name="JCqAnOpN">
            <div class="modal-header" data-name="QFZimGOJ">
                <h5 class="modal-title">{{trans('web_forms.subscription_form')}}</h5>
                <button type="button" class="close popovers" data-dismiss="modal" aria-hidden="true" onclick="hideGcaptcha()" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="left" data-content="Close Webform Preview"></button>
            </div>
            <div class="modal-body" data-name="zmalptYC">
                <form action="{{ route('form.subscription.data') }}" method="POST" class="kt-form kt-form--label-left">
                    <div class="custom-fields-data" id="custom-fields-data" data-name="SrgbNkcq"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection