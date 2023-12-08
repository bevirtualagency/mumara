@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/drip-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script type="text/javascript">
    "use strict";
    var objTable;
    var record_type = 'our_records';
    var KTDatatablesAdvancedRowGrouping = function() {

        var initTable1 = function() {
             // function in master2 layout
        var page_limit=show_per_page('','View-Drip-Groups-pageLength',10);  // Params (table,page,default_limit=10)
            var table = $('#autoresponders');

            // begin first table
            table.DataTable({
                responsive: true,
                sAjaxSource: "{{ url('/getDrips/'.$id) }}",
                'pageLength' : page_limit,
                "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
                 'aLengthMenu': [[10, 50, 100, 500], [10, 50, 100, 500]],
                order: [[7, 'asc']],
                drawCallback: function(settings) {
                    var api = this.api();
                    var rows = api.rows({page: 'current'}).nodes();
                    var last = null;

                    api.column(2, {page: 'current'}).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="10">' + group + '</td></tr>',
                            );
                            last = group;
                        }
                    });
                    
                },
                columnDefs: [
                    {
                        // hide columns by index number
                        targets: [2],
                        visible: false,
                    },

                    {
                        // hide columns by index number
                        targets: [7],
                        visible: false,
                    },

                    {
                        targets: [0,1,2,3,4,5,6,7],
                        orderable: false,
                    },
                    {
                        targets: 4,
                        render: function(data, type, full, meta) {
                            var status = {
                                1: {'title': 'Active', 'class': 'kt-badge--brand'},
                                2: {'title': 'Inactive', 'class': ' kt-badge--danger'},
                                3: {'title': 'Canceled', 'class': ' kt-badge--primary'},
                                4: {'title': 'Success', 'class': ' kt-badge--success'},
                                5: {'title': 'Info', 'class': ' kt-badge--info'},
                                6: {'title': 'Active', 'class': ' kt-badge--success'},
                                7: {'title': 'Warning', 'class': ' kt-badge--warning'},
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="kt-badge fs ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
                        },
                    },
                ],
            });
              page_limit=show_per_page(table,'View-Drip-Groups-pageLength');
        };
        return {

            //main function to initiate the module
            init: function() {
                initTable1();
            },

        };

    }();

    jQuery(document).ready(function() {
        KTDatatablesAdvancedRowGrouping.init();

    });


    function loadTableData(){
        var idsStr = $("#typeFilter").val();
        $('#autoresponders').DataTable().ajax.url('{{ url('/getDrips/') }}/'+idsStr).load();
        //$('#autoresponders').DataTable().ajax.reload();
    }
</script>
<script>
    $(document).ready(function() {

        @if(isset($id) && $id>0)
            
        @else 
            $("#typeFilter").multiselect('selectAll', true);
        @endif

    });
    var pid = $("#pid").val();
    // delete drip
    function deleteAutoresponder(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
                $.ajax({
                    url: "{{ url('/') }}"+'/drips/'+id,
                    type: "DELETE",
                    success: function(result) {
                    if(result == 'delete') {
                      //  console.log(id);
                        $("#row_"+id).hide();
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');
                        //window.location.href = "{{ url('/') }}"+"/drips?id="+pid;
                    }
                }
                });
            }
    }
    // delete selected drip
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
        var autoresponder = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type    : "Delete",
            url: "{{ url('/') }}"+'/drips/'+autoresponder,
            data    : {ids: autoresponder},
            success: function(result) {
                if(result == 'delete') {
                    window.location.href = "{{ url('/') }}"+"/drips";
                }
            }
          });

        }
    }

    $('#perform-action-event').change(function () {
        var action = $('#perform-action-event').val();
        if (action == 'after') {
            $('#perform-action-datetime-count').prop("disabled", false);
            $('#perform-action-datetime-frequency').prop("disabled", false);
        } else {
            $('#perform-action-datetime-count').prop("disabled", true);
            $('#perform-action-datetime-frequency').prop("disabled", true);
        }
    });
    var action_event = $('#perform-action-event').val();
    if(action_event == 'after'){
        $('#perform-action-datetime-count').prop("disabled", false);
        $('#perform-action-datetime-frequency').prop("disabled", false);
    }

    function updateDateTime (id , count , frequency)
    {  
     if(count == 0 && frequency == ''){
            count = null;
            $('#perform-action-datetime-count').prop("disabled", true);
            $('#perform-action-datetime-frequency').prop("disabled", true);
            $('#perform-action-event').val('on_event');
        }else{
            $('#perform-action-datetime-count').prop("disabled", false);
            $('#perform-action-datetime-frequency').prop("disabled", false);
            $('#perform-action-event').val('after');
        }
            $('#autoresponder_id').val(id);
            $('#perform-action-datetime-count').val(count);
            $('#perform-action-datetime-frequency').val(frequency);
    }

    function copyAutoresponder(id){
        if(confirm('{{trans('drip_campaigns.message.alert_copy')}}')) {
            $.ajax({
                url: "{{ url('/') }}"+'/drips/copy/'+id,
                type: "POST",
                success: function(result) {
                    if(result == 'copy') {
                        window.location.href = "{{ url('/') }}"+"/drips";
                    }
                }
            });
        }
    }
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="yjcLiHNx">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="gZlNfAua">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<input type="hidden" name="pageid" value="{{ $id }}" id="pid">
<div class="row" data-name="TXpkIbmo">
    <div class="col-md-12" data-name="LvOwnFiU">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="LkZODuyZ">
            <div class="kt-portlet__body" data-name="bRsCPHrN">
                <div class="table-toolbar" data-name="JmgGfOIg">
                    <div class="form-group row" data-name="pajtEDNI">
                        <div class="col-md-12" data-name="ehkMukKX">
                          @if (routeAccess('drips.group.view'))
                            <div class="btn-group" data-name="SXRXLkjq">
                                <a href="{{ route('drips.group.view') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    {{trans('drip_campaigns.page.button.drip_groups')}} 
                                </button></a>
                            </div>
                            @endif
                            @if (routeAccess('drips.create'))
                            <div class="btn-group" data-name="nKqJibOl">
                                <a href="{{ route('drips.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('drip_campaigns.page.button.add_new_drip')}} 
                                </button></a>
                            </div>
                           @endif
                             @if (routeAccess('drips.destroy'))
                           <div class="btn-group pull-right" data-name="jgdEOyUl">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                            
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}</a>
                                    </li>
                               
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-3" data-name="UjXWTeyB">

                            <div class="form-group status_filter" data-name="UoPtJyND">
                                <select onchange="loadTableData();" class="mt-multiselect btn btn-default" multiple="multiple" data-label="left" name="typeFilter[]" id="typeFilter" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="true" data-placeholder="{{trans('common.label.select_group')}}">
                                    @foreach($autoresponderGroups as $group)
                                    @if(isset($id) && $id>0)
                                        <option  value="{{ $group->id }}" @if($group->id==$id) selected @endif>{{ $group->name }}</option>
                                    @else
                                        <option  value="{{ $group->id }}" selected>{{ $group->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @include('includes.view-pages-filter')
                <table id="autoresponders" class="table table-striped table-hover responsive">
                    <thead>
                        <tr>
                            <th>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('drip_campaigns.table_headings.name')}}</th>
                            <th>{{trans('drip_campaigns.table_headings.group')}}</th>
                            <th>{{trans('drip_campaigns.table_headings.delay')}}</th>
                            <th>{{trans('drip_campaigns.table_headings.status')}}</th> 
                            <th>{{trans('drip_campaigns.table_headings.added_on')}}</th>
                            <th class="text-center">{{trans('drip_campaigns.table_headings.actions')}}</th>
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
<div id="modal-send-datetime" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="OAzqUyCM">
    <div class="modal-dialog" data-name="kAbZHELE">
        <div class="modal-content" data-name="lZTdbDMW">
            <div class="modal-header" data-name="GNLqwNaC">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{trans('app.campaigns.drip.update_date_time')}}</h4>
            </div>
            <div id="error-msg" class="display-hide" data-name="CPoIulzZ">
                <span id='error-text'><span>
            </div>
            <div class="modal-body" data-name="YYAOOnTF">
            <form action="{{ route('drips.datetime.update') }}" id="" method="post" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="autoresponder_id" id="autoresponder_id" value="" >
                <div class="form-group" data-name="MuDhKFGQ">
                    <label class="control-label col-md-4">
                        {{trans('app.campaigns.drip.when_to_send')}}
                    </label>
                    <div class="col-md-8" data-name="PuUzWrKG">
                        <div class="input-icon right" data-name="YQDwkcel">
                            <select class="form-control" name="perform_action_event" id="perform-action-event">
                                <option value="on_event">{{trans('app.campaigns.drip.upon_triggering')}}</option>
                                <option value="after">{{trans('app.campaigns.drip.after_previous_followup')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" data-name="WiyuxwLw">
                    <label class="control-label col-md-4">
                    </label>
                    <div class="col-md-4" data-name="NZaDjidz">
                        <div class="input-icon right" data-name="IBYwUcTb">
                            <input class="form-control" name="perform_action_datetime_count" id="perform-action-datetime-count" value="" disabled="" />
                        </div>
                    </div>
                    <div class="col-md-4" data-name="TaCjhaEy">
                        <div class="input-icon right" data-name="WQsXGCRs">
                            <select class="form-control" name="perform_action_datetime_frequency" id="perform-action-datetime-frequency" disabled="">
                                <option value="minutes">{{trans('app.dashboard.lang.minutes')}}</option>
                                <option value="hours">{{trans('app.dashboard.lang.hours')}}</option>
                                <option value="days">{{trans('app.dashboard.lang.days')}}</option>
                                <option value="weeks">{{trans('app.dashboard.lang.weeks')}}</option>
                                <option value="months">{{trans('app.dashboard.lang.months')}}</option>
                                <option value="years">{{trans('app.dashboard.lang.years')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-actions" data-name="oRuYRJbi">
                    <div class="row" data-name="NanDLIrQ">
                        <div class="col-md-offset-4 col-md-9" data-name="JzZKgNhM">
                            <button type="submit" class="btn green">{{trans('common.form.buttons.submit')}}</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<div id="modal-loading" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="rnIbjLfb">
    <i class="fa fa-spinner fa-spin fa-5x"></i>
</div>
@endsection