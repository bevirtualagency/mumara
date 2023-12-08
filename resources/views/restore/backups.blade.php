@extends('layouts.master2')

@section('title', trans('app.sidebar.primary_domain'))

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/setting-domain.css?v={{$local_version}}.01">
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".m-select2").select2();
        $("body").on("change" , "#db_update" , function() { 
            $("#db_update_value").val("no");
            if($(this).is(":checked")) { 
                $("#db_update_value").val("yes");
            }
        });
        $("body").on("click" , "#savee_buttonn" , function() { 

            if( $("#backup_file").val() == "") { 
                Command: toastr["error"] ("{{trans('restore.backups_blade.select_backup_file_command')}}");
                return false;
            }
            $(".blockUI").show();
            var file = $("#backup_file").val();
            var db_update = $("#db_update_value").val();
            var form_data = {
                file:file,
                db_update:db_update
            };
            $.ajax({
                url: "{{ url('/') }}"+'/restore_file',
                type: 'POST',
                data:form_data,
                success: function(data) {
                    $(".blockUI").hide();
                    Command: toastr["success"] ("{{trans('restore.backups_blade.backup_successfully_command')}}");
                    $("#primary_domain_form")[0].reset();
                }
            });
        });
    });

</script>
@endsection

@section('content')




<!-- BEGIN WIZARD-->

<div class="tab-pane active" id="tab2" data-name="XAKSTHYH">
    <div class="dataTables_wrapper no-footer" data-name="dNGqrgsB">
        <div class="row" data-name="IGfZMepI">
            <div class="col-md-12" data-name="YpNirLMj">
                <form action="javascript:void(0);" id="primary_domain_form" method="POST" class="kt-form kt-form--label-right">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="kt-portlet kt-portlet--height-fluid" data-name="koydFdZK">
                        <div class="kt-portlet__head" data-name="lngRczcq">
                            <div class="kt-portlet__head-label" data-name="sWdHPaXp">
                                <h3 class="kt-portlet__head-title">
                                    {{trans('restore.backups_blade.backup_restore_heading')}} 
                                </h3>
                            </div>
                            
                        </div>
                        <div class="kt-portlet__body" data-name="DgnXXaIH">
                            <div class="form-body" data-name="WOpVuMpO">
                                <div class="form-group row" data-name="yWrjDAbK">
                                    <label class="col-form-label col-md-3">{{trans('restore.backups_blade.label_restore_db')}}</label>
                                    <div class="col-md-6" data-name="MPZoxNhX">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                            <label>
                                                <input type="checkbox" name="db_update" value="no" id="db_update">
                                                <span></span>
                                            </label>
                                        </span>
                                        <input type="hidden" name="db_update_value" value="no" id="db_update_value" >
                                    </div>
                                </div>
                                <div class="form-group row" data-name="LowgVRyD">
                                    <label class="col-form-label col-md-3">
                                        {{trans('restore.backups_blade.select_backup_label')}}
                                    </label>
                                    <div class="col-md-6" data-name="UXgRqyqD">
                                        <div class="input-icon right" data-name="iSECiONM">
                                            <select  required name="backup_file m-select2" id="backup_file" class="form-control" data-placeholder="{{trans('restore.backups_blade.select_backup_label')}}"> 
                                                <option value="">{{trans('restore.backups_blade.select_backup_label')}}</option>
                                                @foreach($files as $file)
                                                @php 
                                                $parts = explode("/", $file);
                                                @endphp
                                                <option value="{{$file}}">{{end($parts)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row" data-name="WpiJaxdA">
                                    <div class="col-md-6 offset-md-3" data-name="ElfOfriT">
                                        <button type="submit" class="btn btn-success" id="savee_buttonn" name='button'>
                                            {{trans('restore.backups_blade.update_now_button')}} </button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection