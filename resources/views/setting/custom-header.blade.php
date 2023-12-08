@extends(decide_template())

@section('title', $pageTitle )

@section('page_styles')
<link href="/resources/assets/css/custom-header.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        //header_label
        $("#header_label").keypress(function(){
            var str = $('#header_label').val();
            $('#header_label').val((str.replace(/[^a-z0-9-]/gi, '').trim().replace(/[_\s]/g, '-')));
        });
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Settings/Global-Headers");
        
        // function in master2 layout
        var page_limit=show_per_page('','custom_header_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#custom_header').DataTable({
            "columnDefs": [ 
                { "orderable": false, "targets": [0,1,2,4] }
            ],
            "aaSorting": [[3, "desc"]],
            "pageLength" : page_limit,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]],
            searching: false, paging: false, info: false
        });
        page_limit=show_per_page(table,'custom_header_pageLength');
    });

  function editcustomheader (id, header_label, header_value)
    {
        $('#header_label').val(header_label);
        $('#header_value').val(header_value);
        $('#custom_header_id').val(id);
    }

    function addcustomheader (id, header_label, header_value)
    {
        $('#header_label').val('');
        $('#header_value').val('');
    }

    function customheaderDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ route('delete.header') }}/"+id,
                    type: "DELETE",
                    success: function(result) {
                    if(result == 'delete') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');
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
        var customheader = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
                type    : "Delete",
                url: "{{ url('/') }}"+'/settings/headers/'+custom_header,
                data    : {ids: customheader},
                success: function(result) {
                        if(result == 'delete') {
                            window.location.href = "{{ url('/') }}"+"/settings/headers/{{$id}}";
                        }
                    }
              });
        }
    }
    // to clear Modal data on close
    $('#modal-custom-header').on('hidden.bs.modal', function () {
            $('.modal-body').find('#header_label,#header_value,#custom_header_id').val('');
    });
</script>
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="wBCKSTmj">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="PupLTcRj">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="DUdJqrob">
    <div class="col-md-12" data-name="vFYbnRTl">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="TBLqYtyp">
            <div class="kt-portlet__body" data-name="LXeAVgeH">
                <div class="table-toolbar" data-name="AIgEBlGY">
                    <div class="form-group row" data-name="xXcyHwjw">
                        <div class="col-md-12" data-name="oIqbYwCT">
                         @if(rolePermission(261) || rolePermission(285))
                            <a href="#modal-custom-header" data-toggle="modal" onclick="addcustomheader()">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button>
                            </a>
                          @endif
                          <div class="btn-group pull-right" data-name="oSJgoTWa">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('common.actions')}}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                     <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="custom_header" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('settings.header.column.label')}}</th>
                                <th>{{trans('settings.header.column.value')}}</th>
                                <th>{{trans('settings.header.column.added_on')}}</th>
                                <th>{{trans('settings.header.column.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($custom_headers as $custom_header)
                            <tr class="gradeX odd" role="row" id="row_{{ $custom_header->id }}">
                                <td>
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-index" value="{{ $custom_header->id }}">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="sorting_1">{{$custom_header->header_label}}</td>
                                <td>{{$custom_header->header_value}}</td>
                                <td>{{showDateTime(Auth::user()->id, $custom_header->created_at)}}</td>
                                <td>
                                    <div class="dropdown" data-name="mAjejMYl">
                                        <a class="btn btn-label-success btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-expanded="false"><i class="flaticon-more-1"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        @if(rolePermission(263))
                                            <li>
                                                <a href="#modal-custom-header" data-toggle="modal" onclick="editcustomheader('{{ $custom_header->id }}', '{{ $custom_header->header_label }}', '{{ $custom_header->header_value }}')"> <i class="fa fa-edit icon-size"></i> {{trans('common.form.buttons.edit')}}</a>
                                            </li>
                                        @endif
                                        @if(rolePermission(264))
                                            <li>
                                                <a href="javascript:;" onclick="customheaderDelete({{ $custom_header->id }})" id='customheader-delete'> <i class="fa fa-remove icon-size"></i>{{trans('common.form.buttons.delete')}} </a>
                                            </li>
                                        @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- Model -->
<div id="modal-custom-header" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="kqvwBETu">
    <div class="modal-dialog" data-name="epgetBHg">
        <div class="modal-content" data-name="fArkjHmx">
            <form action="{{ route('setting.header', $id) }}" method="POST" id="custom-header-frm" class="kt-form kt-form--label-right">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="custom_header_id" id="custom_header_id" value="">
            <div class="modal-header" data-name="JRVfarBD">
                <h5 class="modal-title">{{ $pageTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="AZwTlvsG">
                <div class="form-group row" data-name="UyumMFpZ">
                    <label class="col-form-label col-md-4 text-left">{{trans('settings.header.form.label')}}
                        <span class="required"> * </span>
                        {!! popover('settings.header.form.label_help','common.description') !!}
                    </label>
                    <div class="col-md-12" data-name="oePsTOHW">
                        <div class="input-icon right" data-name="nXUYusWp">
                            <input type="text" name="header_label" id="header_label" value="{{isset($custom_header->header_label) ? $custom_header->header_label : '' }}" class="form-control" required />
                            <span class="text-help">{{trans('settings.header.form.label_help')}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row" data-name="ciZcJLlH">
                    <label class="col-form-label col-md-4 text-left">{{trans('settings.header.form.value')}}
                        <span class="required"> * </span>
                        {!! popover('settings.header.form.value_help','common.description') !!}
                    </label>
                    <div class="col-md-12" data-name="mWpIExKK">
                        <div class="input-icon right" data-name="npaKIqlm">
                            <input type="text" name="header_value" id="header_value" value="{{isset($custom_header->header_value) ? $custom_header->header_value : '' }}" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justfy-column" data-name="AZwTlvsG">
                <button type="reset" class="btn btn-default">{{trans('common.form.buttons.reset')}}</button>
                <button type="submit" class="btn btn-success ">{{trans('common.form.buttons.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection