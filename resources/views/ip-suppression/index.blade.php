@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/ip-suppression.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
<style>
#modal-ip-suppression {
    z-index: 9999;
}
    .select2-results {
        z-index: 9999;
    }
</style>

@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/common.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script>
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {

        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Lists/Suppression#ip-suppression");

        $(".m-select2").select2({
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });

        $("#ip-suppression-frm").validate({
          rules: {
            ip_range: {
              required: true
            },
            list_id: {
              required: true
            }
          }
        });
       // function in master2 layout
        var page_limit=show_per_page('','ip_suppression_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#ip_suppression').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,5]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getSuppressIps') }}",
             "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
        objTable = table;
     page_limit=show_per_page(table,'ip_suppression_pageLength'); 
    });
    // edit ip suppression
    function editIPSupress (id, ip_range, list_id , reference)
    {
        $.ajax({
            url: "{{route('suppressionIpEdit',"")}}"+'/'+id,
            type: "get",
            dataType:'json',
            success: function(result) {
                if(result.status) {
                    $('#list_id').empty();
                    $('#list_id').html(result.html);
                    $('#list_id').select2({
                         templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                    });
                    $('#suppress_modal').trigger('click');
                    $('#model_ip_edit').val(ip_range);
                    $('#list_id').val(list_id);
                    $('#ip_supress_id').val(id);
                    $('#reference').val(reference);
                    if(result.is_client) {
                        var html = '<span class="alert-text">{{trans('page_title.admin.on.client')}}: (<a href="javascript:;" target="_blank"><b>'+result.owner.name+'</b></a>, '+result.owner.id+')</span>';
                        $('#adminOnClient').empty();
                        $('#adminOnClient').html(html);
                        $('#adminOnClient').show();
                    }
                    else{
                        $('#adminOnClient').empty();
                        $('#adminOnClient').hide();
                    }
                }
            }
        });
    }
    // delete ip suppression
    function IPDelete(id)
    {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/suppression-ip/'+id,
                    type: "DELETE",
                    success: function(result) {
                        if(result == 'delete') {
                            Command: toastr["success"] ("{{trans('common.message.delete')}}"); 
                        }
                    }
                });
            }
    }
    // delete ip suppression reference
    function deleteRefrenceIps(id) {
        if(confirm('{{trans('suppression.ip.message.delete_ip_with_reference')}}')) {
                $.ajax({
                    url: "{{ url('/') }}"+'/suppression-ip/'+id,
                    type: "DELETE",
                    data: {reference: 'reference'},
                    success: function(result) {
                        Command: toastr["success"] ("{{trans('common.message.delete')}}"); 
                        if(result == 'delete') {
                              location.reload();
                        }
                    }
                });
            }
    }
    // delete selected ip suppression
    function deleteAll ()
    {
        if($('input:checked').length==0){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var ipsuppression = $('input:checked').map(function() {
                return this.value;
            }).get();

            $.ajax({
                type : "DELETE",
                url: "{{ url('/') }}"+'/suppression-ip/'+ip_suppression,
                data : {ids: ipsuppression},
                beforeSend: function () {
                    for (var key in ipsuppression) {
                        if (ipsuppression.hasOwnProperty(key)) {
                            id  = ipsuppression[key];
                            row_id = '#row_'+id;
                            $('tr'+row_id+' td').addClass('kt-shape-bg-color-1');
                            $('.kt-shape-bg-color-1').removeClass('sorting_1');
                        }
                    }
                },
                success: function(result) {
                    if(result == 'delete') {
                        //window.location.href = ""+"/suppression-ip";
                        Command: toastr["success"] ("{{trans('common.message.delete')}}");
                        $('#ip_suppression').DataTable().ajax.reload();

                    }
                }
            });
        }
    }
    // to clear Modal data on close
    $('#modal-ip-suppression').on('hidden.bs.modal', function () {
    $('.modal-body').find('textarea,#ip_supress_id,#reference,#list_id').val('');
    $('.modal-body').find('#list_id').val(0);
    });
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())


@if($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger" data-name="oyuCbdyg">
        <div class="alert-text" data-name="wayLGuky">{{ $error }}</div>
    </div>
    @endforeach
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="yUrlrInV">
    {{ Session::get('msg') }}
</div>
@endif
@if(Session::has('error_msg'))
<div class="alert alert-danger" data-name="IRjzJQMt">
    {{ Session::get('error_msg') }}
</div>
@endif

<?php  
    $runningMinutes =  \App\UserCronSetting::getCronTime("suppress_subscribers"); 
    $runningMinute = $runningMinutes;
    if($runningMinutes < 0 ||  $runningMinutes == NULL) $runningMinute = 5;
    if($runningMinutes === "0" || $runningMinutes === 0 ) $runningMinute = 0;
?>

@if($runningMinute == 0)
@if(Auth::user()->is_client)
<div class="alert alert-warning" data-name="QkKcmvtm">
    {!!trans('suppression.suppression_running_disable_user')!!}
</div>
@else 
<div class="alert alert-warning" data-name="QkKcmvtm">
    {!!trans('suppression.suppression_running_disable')!!}
</div>
@endif
@endif

<div id="msg" class="display-hide" data-name="uvTRGtkc">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="BLYdSOIn">
    <div class="col-md-12" data-name="pwSdujXE">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="UhjUwAXb">
            <div class="kt-portlet__body" data-name="yUTOpqzn">
                <div class="table-toolbar" data-name="iKrAKnyo">
                    <div class="form-group row" data-name="WVUndRnT">
                        <div class="col-md-12" data-name="dvbbZBWJ">
                           @if (routeAccess('suppression-ip.store'))
                            <div class="btn-group" data-name="nzAUjcDM">
                                <a href="#modal-ip-suppression" data-toggle="modal">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}}
                                </button></a>
                            </div>
                           @endif
                           @if (routeAccess('suppression-ip.destroy'))
                           <div class="btn-group pull-right" data-name="jAbcyxJI">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu  dropdown-menu-right">
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
                <div class="rel-block">
                    @if($runningMinute > 0)
                        <div class="user-table-warning">{!!trans('suppression.suppression_running_time', ['minutes' => $runningMinute])!!}</div>
                    @endif
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover table-checkable" id="ip_suppression" role="grid" >
                            <thead>
                                <tr role="row">
                                    <th style="width: 25px;">
                                        <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                            <input type="checkbox" class="checkboxes checkbox-all-index">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>{{trans('suppression.ip.table_headings.ip_address')}}</th>
                                    <th>{{trans('suppression.ip.table_headings.contact_list')}}</th>
                                    <th>{{trans('suppression.ip.table_headings.reference')}}</th>
                                    <th>{{trans('suppression.ip.table_headings.added_on')}}</th>
                                    <th>{{trans('suppression.ip.table_headings.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<!-- Add new IP Suppression Model -->
<div id="modal-ip-suppression" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="vksaHEEr">
    <div class="modal-dialog modal-lg" data-name="UicPycNl">
        <div class="modal-content" data-name="SKJtmHev">
            <div class="modal-header" data-name="ONDQNRyY">
                <h5 class="modal-title">{{ $pageTitle}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" data-name="IaxvHdzA">
                <div id="adminOnClient" class="alert alert-warning" style="display: none;" data-name="tLTDAzsn">

                </div>
            <!-- Form Start -->
            <form action="{{route('suppression-ip.store')}}" method="POST" id="ip-suppression-frm" class="kt-form kt-form--label-right">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="ip_supress_id" id="ip_supress_id" value="">
                <div class="form-group row" data-name="NuRpBmud">
                        <label class="col-form-label col-md-3">{{trans('suppression.ip.modal.field.ip_address')}}
                            <span class="required"> * </span>
                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.ip.modal.field.ip_address_help')}}" data-original-title="{{trans('common.description')}}"></i>
                        </label>
                        <div class="col-md-8" data-name="PSEXwafa">
                            <div class="input-icon right" data-name="WLyGszTI">
                                <textarea required="required" name="ip_range" id="model_ip_edit" value="{{isset($ip_suppression->ip_range) ? $ip_suppression->ip_range : '' }}" class="form-control" placeholder="One per line e.g. 192.168.1.0 or 192.168.1.0-20 or 192.168.1.0/28" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" data-name="IwaCtbul">
                            <label class="col-form-label col-md-3">{{trans('suppression.ip.modal.field.contact_list')}}
                                 <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.select_list_help',['type'=>'domain(s)'])}}" data-original-title="{{trans('common.description')}}"></i>
                            </label>
                            <div class="col-md-8" data-name="yRdESNcz">
                                <select class="form-control m-select2" name="list_id" id="list_id" >
                                    <option value="0">{{trans('suppression.global')}}</option>
                                    @foreach($group_lists as $key => $group)
                                        <optgroup label="{{$group['name']}}">
                                            @foreach($group['children'] as $list)
                                            <option value="{{ $list['id'] }}" {{ (isset($ip_suppression->list_id) && ($list['id']  == $ip_suppression->list_id)) || (!empty($list_id) && $list['id'] == $list_id) ? 'selected' : '' }}>
                                            {{ $list['name'] }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                            </select>
                            </div>
                    </div>
                    <div class="form-group row" data-name="YVmVxwLn">
                        <label class="col-form-label col-md-3">{{trans('suppression.ip.modal.field.reference')}}
                             <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.reference_help')}}" data-original-title="{{trans('common.description')}}"></i>
                        </label>
                        <div class="col-md-8" data-name="TsQCkfbd">
                            <div class="input-icon right" data-name="XGlBPatY">
                                <input type="text" name="reference" id="reference" value="" class="form-control" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-actions" data-name="dLCKFDai">
                        <div class="row" data-name="lkcobGLV">
                            <label class="col-form-label col-md-3"></label>
                            <div class="col-md-9" data-name="HgEsSQWL">
                                <button type="submit" class="btn btn-success">{{trans('common.form.buttons.submit')}}</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('common.form.buttons.close') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<!-- Add new IP Suppression Model -->
<a data-toggle="modal" id="suppress_modal" style="display: none;" href="#modal-ip-suppression"></a>
@endsection