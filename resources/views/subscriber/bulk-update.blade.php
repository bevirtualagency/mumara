@extends('layouts.master2')

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/subscriber-bulk-import.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection
<?php
$max_file = (file_upload_max_size()/1024)/1024;
    ?>
@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datepicker-init.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="{{ asset('themes/default/js/includes/form-validator.js') }}?t={{time()}}" type="text/javascript"></script>
<script>
    function cancelUpdate(id)
    {
        $.ajax({
            type: 'POST',
            url: '{{route('cancelUpdate')}}',
            data: {'id':id},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if (data.status==true) {

                }
                else {
                }
                return false;
            },complete: function (data) {

                $('.blockUI').hide();


            }
        });
    }
    var form_error="{{trans('common.message.form_error')}}";
   $(document).ready(function (){
       $('#uploadData').click(function (e){
           e.preventDefault();
           $('#file-error').css('display','hide');
           id = '0';
           formId = '#updateContacts';
           route = '{{route('uploadContacts')}}';
           method = 'POST';
           max_file = {{$max_file}};
           data = $(formId).serialize()+'&'+'btn'+'=1';
        if($('#import-file-selection').val()!=='folder') {
            var FileSize = $('#file')[0].files[0].size / 1024 / 1024;
            if (FileSize > max_file) {
                $('#file-error').html("{!! trans('common.message.FileSizeError',['max_file'=>$max_file."MB"]) !!}");
                $('#file-error').css('display', 'block');
                return false;
            }
        }
           var formData = new FormData();
           formData.append('file', $('#file')[0].files[0]);
           $("select, input:checked").each(function(){
               key = $(this).attr('name');
               val = $(this).val()
               formData.append(key, val);
           });
           $.ajax({
               type: method,
               url: route,
               processData: false,
               contentType: false,
               data: formData,
               cache: false,
               dataType: 'json',
               beforeSend: function() {
                   $('.blockUI').show();
                   $('.form-control').removeClass('is-invalid');
                   $('.error').css('display','none');
                   $('#error').hide();
                   $('#success').hide();
                   $('#progress-import').hide();
               },
               success: function (data) {
                   $('.blockUI').hide();
                   if (data.status==true) {
                       if(method=='post' || method=='POST')
                           $(formId).trigger("reset");
                       $('#modal-group-label').hide();
                       if(data.message!==undefined) {
                            //   $('#success').show();
                             //  $('#success').html(data.message);
                       }
                       $('html, body').animate({
                           scrollTop: $('#success').offset().top
                       }, 800);
                       $('#progress-import').show();
                       $('#ajax-spinner-text').html('<i class="fa fa-spinner fa-spin"></i>{{trans('contacts.bulk_update.task.preparing')}} <strong>'+data.lists+' </strong> {{trans('contacts.bulk_update.task.using')}} '+data.file+'')
                       $('#updateContacts').hide();
                       updateBar(0,data.count,data.task_id,0,data.cancel_id,data.contacts,false,false,data.lists,data.file)
                   }
                   else {
                       if(data.status=='validation_failed')
                       {
                           var x;
                           messages = data.messages;
                           for (x in messages) {
                               $('#'+x).addClass('is-invalid');
                               id = '#'+x+'-error';
                               $(id).html(messages[x]);
                               $(id).css('display','block');
                           }
                       }
                       if(data.message!==undefined) {
                               $('#error').show();
                               $('#error').html(data.message);
                       }
                       $('html, body').animate({
                           scrollTop: $('#error').offset().top
                       }, 800);

                   }
                   return false;
               },complete: function (data) {

                   $('.blockUI').hide();

                   var  status = data['status']
                   if(status==422)
                   {
                       var response =data['responseJSON']['errors'];
                       for (x in response) {
                           $('#'+x).addClass('is-invalid');
                           id = '#'+x+'-error';
                           $(id).html(response[x]);
                           $(id).css('display','block');
                       }
                      // console.log(response);
                   }

               }
           });
       }) ;
   });
function updateBar(progress,total_records,task_id,total_import=0,cancel_id,contacts,canceled=false,stop=false,list_names,file_name)
{
    if(progress>100)
        progress = 100;
    $("#import_progress_bar").width(progress + '%').html(progress + '%');
    //$(".import-progress").html("No of Records Processed: " + line_no);
    $("#normal_import").show();
    var table="<table class='table table-hover table-striped table-result'><tbody>" +
        "<tr><td width='50%'>"+'{{trans('contacts.bulk_update.task.records_in_file')}}'+":</td><td width='50%''>" + total_records + "</td></tr>" +
        "<tr><td width='50%'>"+'{{trans('contacts.bulk_update.task.records_in_lists')}}'+":</td><td width='50%''>" + contacts + "</td></tr>" +
        "<tr><td width='50%'>"+'{{trans('contacts.bulk_update.task.processed')}}'+":</td><td width='50%''>" +  total_import + "</td>";

/*    var summary="<tr class='summary'><td width='50%'>"+label+":</td><td id='duplicates_found1' width='50%''>" + duplicate_found + "</td>" +
        "<tr class='summary'><td width='50%'>"+invalids_label+":</td><td id='invalid_found1'  width='50%''>" + invalid_email + "</td>";*/
   // table+=summary;
    if(!canceled)
    table+='<tr><td></td><td><a id="cancel_up" href="javascript:;" style="float: none;" onclick="cancelUpdate('+cancel_id+')"  class="text-danger">'+'Cancel'+'</a></td></tr>';
    table+="</tbody></table>";
    $("#normal_import").html(table);
    $.ajax({
        type: 'POST',
        url: '{{route('getUpdateContactsStatus')}}',
        data: {'task_id':task_id,'update_id':cancel_id},
        cache: false,
        dataType: 'json',
        beforeSend: function() {

        },
        success: function (data) {
            $('.blockUI').hide();
            if (data.status==true) {
                if(data.canceled==false) {
                    if(data.running)
                        $('#ajax-spinner-text').html('<i class="fa fa-spinner fa-spin"></i>{{trans('contacts.bulk_update.task.updating')}}<strong>'+list_names+' </strong> {{trans('contacts.bulk_update.task.using')}} '+file_name+'')
                    progress = Math.round((parseInt(data.processed) / parseInt(total_records)) * 100);
                    updateBar(progress, total_records, data.task_id, data.processed, cancel_id, contacts,false,false,list_names,file_name)
                }
                else {
                    if(!stop)
                    updateBar(progress, total_records, data.task_id, data.processed, cancel_id, contacts, true,true, list_names, file_name);
                    $('#ajax-spinner-text').html('<i class="fa fa-times text-danger"></i><strong>'+list_names+' </strong> {{trans('contacts.bulk_update.task.cancel')}}');
                    $('#scheduled').hide();
                }
            }
            else {
                if(!stop) {
                    updateBar(progress, total_records, null, data.processed, cancel_id, contacts, false, true,list_names,file_name);
                    $('#cancel_up').remove();
                    $('#scheduled').hide();
                    $('#ajax-spinner-text').html('<i class="fa fa-check text-success"></i><strong>'+list_names+' </strong> {{trans('contacts.bulk_update.task.updated')}} '+file_name+'')
                }


            }
            return false;
        },complete: function (data) {

            $('.blockUI').hide();

            var  status = data['status']
            if(status==422)
            {
                var response =data;
               // console.log(response);
            }

        }
    });
}
   $('.group-selector-subscriber').click(function () {
        var group = this.id;
        if($(this).is(':checked')) {
            $('.group-subscriber-'+group).prop('checked', true);
        } else {
            $('.group-subscriber-'+group).prop('checked', false);
        }
    });
    $(document).ready(function(){

        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Contacts/Bulk-Update");

        $('#import-file-selection').on('change', function () {
            var import_file_selection = $('#import-file-selection').val();
            if (import_file_selection == 'computer') {
                $("#file-from-computer").show();
                $("#file-from-folder").hide();
                $("#import-id").attr("required", "required");
                $("#folder-import-id").removeAttr("required");
            } else {
                $("#file-from-folder").show();
                $("#file-from-computer").hide();
                $("#folder-import-id").attr("required", "required");
                $("#import-id").removeAttr("required");
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".m-select2").select2();
    });
</script>
@endsection

@section('content')

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="FovGrCqq">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<div style="display: none;" id="success" class="alert alert-success" data-name="oufPKkGu">

</div>


<div style="display: none;" id="error"  class="alert alert-danger" data-name="vIMVdtDb">

</div>
<div id="progress-import" style="display: none" data-name="gJxfYPFv">
    <div class="col-md-12" data-name="oOJLJarh">
        <div class="kt-portlet kt-portlet--height-fluid" style="display: block;" data-name="QsUqaCGO">
            <div class="kt-portlet__head" data-name="hHLbLbqh">
                <div class="kt-portlet__head-label" data-name="azhNSDgu">
                    <h3 class="kt-portlet__head-title">
                        {{trans('contacts.bulk_update.task.title')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="QxaQNSEj">


                <div id="scheduled" class="alert alert-info alert-light alert-bold" role="alert" data-name="isDiRLXV">
                    <div class="alert-text" data-name="OezOyvsp">{{trans('contacts.bulk_update.task.background')}}</div>
                </div>

                <div class="row" data-name="IAnXrlfm">

                    <div class="col-md-12" data-name="YHxpIGyO">
                        <div style="display: block;" id="ajax-spinner-text" data-name="KlALZecv"></div>
                        <div class="alert alert-warning alert-light alert-bold" role="alert" id="aborted" style="display: none;" data-name="elPSZFMk">{{trans('contacts.bulk_update.operation_aborated_div')}}</div>
                        <div class="alert alert-success alert-light alert-bold" role="alert" id="resultbar" style="display:none;" data-name="mtCihams">
                            <div class="alert-text" data-name="HJyDwlFv"><b id="imported_alert">0</b>&nbsp;{{trans('contacts.bulk_update.new_contact_div')}}&nbsp;<span id="grammar">were</span>&nbsp;{{trans('contacts.bulk_update.imported_div')}}<span id="updated_alert"></span>&nbsp;{{trans('contacts.bulk_update.out_of_div')}} &nbsp;<b id="total_alert">0</b>&nbsp;{{trans('contacts.bulk_update.Import_rules_div')}}</div>
                        </div>
                    </div>
                    <div class="col-md-12" data-name="hCKzrwfg">
                        <div class="progress progress-striped active" data-name="BFgzvgSd">
                            <div id="import_progress_bar" class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 1%;" data-name="moCgilXX">1%</div>
                        </div>
                    </div>
                </div>

                <div id="import-result" class="table-responsive" style="" data-name="hldoxczK">
                    <div id="normal_import" style="" class="table-responsive" data-name="nQsjjFhL"><table class="table table-hover table-striped table-result"><tbody><tr><td width="50%">{{trans('contacts.bulk_update.total_contact_td')}}</td><td width="50%" '="">249999</td></tr><tr><td width="50%">{{trans('contacts.bulk_update.imported_td')}}</td><td width="50%" '="">1829</td></tr><tr class="summary"><td width="50%">{{trans('contacts.bulk_update.duplicates_td')}}</td><td id="duplicates_found1" width="50%" '="">0</td></tr><tr class="summary"><td width="50%">{{trans('contacts.bulk_update.invalids_td')}}</td><td id="invalid_found1" width="50%" '="">0</td></tr><tr><td></td><td><a href="javascript:;" style="float: none;" onclick="cancelImport(53,0,1)" class="text-danger">{{trans('contacts.bulk_update.cancel_import_td')}}</a></td></tr></tbody></table></div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- will be used to show any messages -->



<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="zmhURRYI">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<form novalidate method="post" class="kt-form kt-form--label-right" enctype="multipart/form-data" id="updateContacts">
    <div class="row" data-name="UAazAqfq">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-6 create-form" data-name="teVbflzy">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="LgsDtsqh">
                <div class="kt-portlet__head" data-name="ezWLEJom">
                    <div class="kt-portlet__head-label" data-name="jEXxWLlr">
                        <h3 class="kt-portlet__head-title">
                            {{ $pageTitle }}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="kGTqoFPR">
                    <div class="form-body" data-name="VCHCGUJZ">
                        <div class="form-group row" data-name="VoJYvGtr">
                            <div class="col-md-12" data-name="XjjBPEaj">
                                <label class="col-form-label">{{trans('contacts.import.form.import_file')}}
                                     {!! popover( 'contacts.import.form.import_file_help','common.description' ) !!}
                                </label>
                                <select class="form-control" name="import_file_selection" id="import-file-selection">
                                    <option value="computer">  {{trans('suppression.modal.form.upload_csv_file')}}</option>
                                    <option value="folder">{{trans('suppression.modal.form.select_file_from_server')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="file-from-computer" data-name="buIQsRAf">
                            <div class="col-md-12" data-name="pgQDuVBi">
                                <label class="col-form-label">{{trans('suppression.modal.form.select_file')}}
                                    <span class="required"> * </span>
                                    <small> ({{trans('suppression.modal.form.max_file_size')}}  {{ $max_file}}MB)</small>
                                     {!! popover( 'contacts.import.form.select_file_help','common.description' ) !!}
                                </label>
                                <div class="custom-file" data-name="oiuqJdcO">
                                    <input type="file" class="custom-file-input" required id="file" name="file" >
                                    <label class="custom-file-label" for="customFile">{{trans('suppression.modal.form.choose_file')}}</label>
                                    <small class="error" style="display:none; color: red;"  id="file-error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="file-from-folder" style="display:none;" data-name="prQlxBcs">
                            <div class="col-md-12" data-name="lHCVZTnJ">
                                <label class="col-form-label">{{trans('suppression.modal.form.select_file')}} <span class="required"> * </span>
                                {!! popover( 'contacts.import.form.select_file_help','common.description' ) !!}
                                </label>
                                <select class="form-control m-select2" name="folder_file_import" id="folder-import-id" data-placeholder="{{trans('app.contacts.import.select_import_file')}}">
                                    <option>{{trans('suppression.modal.form.select_file')}}</option>
                                    @foreach ($folder_files as $file)
                                        <option value="{{ $file['basename'] }}">{{ $file['basename'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" data-name="AiuLjZhs">

                            <div class="col-md-12" data-name="aBEGhHFg">
                                <label class="col-form-label">{{trans('common.label.contact_list')}}
                                    {!! popover( 'contacts.bulk_update.form.contact_list_help','common.description' ) !!}
                                </label>
                                <small class="error" style="display:none; color: red;"  id="lists-error"></small>
                                <div class="kt-portlet kt-portlet--height-fluid scroll scroll-300" data-name="mWkfunGn">
                                    <div class="kt-portlet__body" data-name="UkDkDTQJ">
                                        @foreach ($list_tree as $group_metadata)
                                            <div class="kt-checkbox-list" style="padding: 5px 0;" data-name="CUtdAkwA">
                                                <label class="kt-checkbox">
                                                    <input class="group-selector-subscriber" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group[]"> <strong>{{ $group_metadata['name'] }}</strong>
                                                    <span></span>
                                                </label>
                                            </div>
                                            @foreach ($group_metadata['children'] as $list_metadata)
                                                <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="qzJYYfab">
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox" value="{{ $list_metadata['id'] }}" name="lists[]" class="group-subscriber-{{ $group_metadata['id'] }}" {{ isset($lists['lists_ids']) && in_array($list_metadata['id'] , $lists['lists_ids']) ? 'checked' : '' }}> {{ $list_metadata['name'] }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="xbhGZQXD">
                            <div class="col-md-12" data-name="WWsaMWyf">
                                <label class="col-form-label">{{trans('contacts.bulk_update.form.action')}}
                                    {!! popover( 'contacts.bulk_update.form.action_help','common.description' ) !!}
                                </label>
                                <select class="form-control m-select2" name="action" data-placeholder="{{trans('contacts.bulk_update.form.choose_action')}}">
                                    <option value="">{{trans('contacts.bulk_update.form.choose_action')}}</option>
                                    <option value="delete">
                                        {{trans('contacts.bulk_update.form.actions.delete')}}
                                    </option>
                                    <option value="unsubscribe">
                                        {{trans('contacts.bulk_update.form.actions.unsubscribe')}}
                                    </option>
                                    <option value="not_unsubscribe">
                                        {{trans('contacts.bulk_update.form.actions.unsubscribed_as_active')}}
                                    </option>
                                    <option value="soft_bounce">
                                        {{trans('contacts.bulk_update.form.actions.soft_bounce')}}
                                    </option>
                                    <option value="hard_bounce">
                                        {{trans('contacts.bulk_update.form.actions.hard_bounce')}}
                                    </option>
                                    <option value="active">
                                        {{trans('contacts.bulk_update.form.actions.active')}}
                                    </option>
                                    <option value="inactive">
                                        {{trans('contacts.bulk_update.form.actions.inactive')}}
                                    </option>
                                    <option value="confirmed">
                                        {{trans('contacts.bulk_update.form.actions.confirmed')}}
                                    </option>
                                    <option value="un_confirmed">
                                        {{trans('contacts.bulk_update.form.actions.unconfirmed')}}
                                    </option>
                                    <option value="html">
                                        {{trans('contacts.bulk_update.form.actions.html')}}
                                    </option>
                                    <option value="text">
                                        {{trans('contacts.bulk_update.form.actions.text')}}
                                    </option>
                                </select>
                                <small class="error" style="display:none; color: red;"  id="action-error"></small>
                            </div>
                        </div>
                        <div class="form-group row" data-name="TFaugAje">
                            <div class="col-md-12" data-name="zgHOCgYL">
                                <label class="col-form-label">{{trans('suppression.modal.form.line_contains_headers')}}
                                    {!! popover( 'suppression.modal.form.line_contains_headers_help','common.description' ) !!}
                                </label>
                                <select class="form-control" name="header">
                                    <option value="1">
                                        {{trans('common.form.buttons.yes')}}
                                    </option>
                                    <option value="0">
                                        {{trans('common.form.buttons.no')}}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="EnFCOKHO">
                    <div class="row" data-name="FAOpvGfr">
                        <div class="col-md-12 col-sm-12 action-buttons" data-name="nAkKWUTO">
                            <button id="uploadData" name="save_add" class="btn btn-success" value="save_add">{{trans('common.form.buttons.submit')}}</button>
                            <button type="reset" class="btn btn-default">{{trans('common.form.buttons.reset')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END FORM-->
@endsection