@extends('layouts.master2')

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/import-subscribers-new.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

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

<script>
    // on page load next button disable
    $("#next-btn").prop("disabled",true);
    // set variable
     var form_error="{{trans('common.message.form_error')}}";
     var preparing_file = "{{trans('common.message.preparing_file')}}";
     var delete_all_files = "{{ trans('suppression.message.delete_all_files') }}";
     var import_error = "{{trans('contacts.message.email_mapping_error')}}";
     var token = "{{ csrf_token() }}";
      var cancel_import_label = "{{trans('suppression.cancel_import')}}";
      // Normal import html labels
    var total_records_label = "{{trans('common.import.normal.total_contacts')}}";
    var imported_label = "{{trans('common.import.normal.imported')}}";
    var duplicates_label = "{{trans('common.import.normal.duplicates')}}";
    var invalids_label = "{{trans('common.import.normal.invalids')}}";
    var view_contacts_label = "{{trans('common.label.view_contacts')}}";
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Contacts/Import-Contacts");
        
        $(".m-select2").select2({
            placeholder: 'Select Option'
        });
    });
</script>
<script src="/themes/default/js/includes/import.js?t={{time()}}" type="text/javascript"></script>
<script>
    var max_file = <?php echo $max_file = (file_upload_max_size() / 1024) / 1024; ?>;
    // validate file size
    function ValidateSizes(file) {
        $("#FileSizeError").hide();
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > max_file) {
           $("#FileSizeError").show();
            reset();
        } else {
            uploadFile();
           
        }
    }
    // upload file 
    function uploadFile(){
            $("#next-btn").prop("disabled",true); 
            $(".uploading-blk i.ups-check").hide();
            $("#cancel-pen,#import-id-error").hide();
            $("#import-id").addClass("pen");
            $("#import-file-selection").addClass("pen");
            $("#uploading-progress").css("width", "0%");
            $(".uploading-blk").show(1000);
           
            var formData = new FormData($("#subscriber-frm")[0]);
            $.ajax({
              xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                    $(".uploading-blk i.fa-spin").hide();
                     $(".uploading-blk .ups-counter").css("display", "inline-block");
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                      var elem = document.getElementById("uploading-progress");
                          elem.style.width = percentComplete + "%";
                        $(".uploading-blk .ups-counter>.count").html(percentComplete);

                  }
                }, false);

                return xhr;
              },
               url: "{{ route('contact.import') }}",
               type: 'POST',
               async: true,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
              success: function(result) {
                if(result.success){
                $("#FileSizeError").hide();
                $('#js_file_name').val(result.file_name);
                  $("#import-id").val('').prop('required',false);
                  reset();
                }else{
                  $("#FileSizeError").text(result.message);
                  $("#FileSizeError").show();
                  $("#js_file_name").val("");
                  $("#import-id").addClass("pen");
                  $("#import-file-selection").removeClass("pen");
                  $(".select2.select2-container").removeClass("pen");
                  $("#select2-list-id-container").removeClass("pen"); 
                  $("#import-id").removeClass("pen");
                }
                 $(".uploading-blk .ups-counter").hide();
              },
              error: function (err) {
                $('.uploading-blk').hide();
                $("#FileSizeError").text(err.responseJSON.message);
                $("#FileSizeError").show();
                $("#js_file_name").val("");
                reset();
                }
            });
    }    
    function reset(){
        $(".uploading-blk i.fa-spin").hide();
        $(".uploading-blk i.fa.fa-check").css("display", "inline-block");
        $("#cancel-pen").css("display", "inline-block");
        $("#import-id").removeClass("pen");
        // $("#cancel-pen").hide();
        $("#import-file-selection").removeClass("pen");
        $(".select2.select2-container").removeClass("pen");
        $("#select2-list-id-container").removeClass("pen"); 
        $("#next-btn").prop("disabled",false); 
    }
    // cancel the upload file
     $("#cancel-pen").click(function() {
            $(".blockUI").show();
            setTimeout(function() {
                $(this).hide();
                $(".uploading-blk i.ups-check").hide();
                $(".blockUI").hide();
                $(".uploading-blk").hide();
                $(".uploading-blk i.la-refresh").show();
                $("#import-id").removeClass("pen");
                $("#uploading-progress").css("width", "0%");
                $("#import-file-selection").removeClass("pen");
                $(".select2.select2-container").removeClass("pen");
                $("#select2-list-id-container").removeClass("pen");
                $("#import-id").val("");
                $("#customFile1").text("Choose file");
                $(".custom-file>label.custom-file-label").text("Choose file");
                $("#suppression-frm")[0].reset();
            }, 1000);
        });
    if ($('#listid').val() != ''){
        $("#list-id").attr('disabled','disabled');

        $("#next-btn").click(function () {
            $("#list-id").attr('disabled', false);
        });
    }
    $('.date_').on('change',function () {
        txt = $(this).children(":selected").text();
        id_i = this.id;
        el = $("select[name=" + id_i +"]");
        //val = el.val();

        if(txt=='None') {
           el.removeClass('is-invalid');
           el.removeAttr('required');
        }
        else{
            el.attr('required','required');
        }

    });

    function showOrHide() {
        if($("#creation_date").is(':checked')) {
            $("#override_date_select").slideDown('slow');
            $("#override_date_select_1").slideDown('slow');
            $("#override_date_select").attr('required','required');
            $("#override_date_select_1").attr('required','required');
        }
        else {
            $("#override_date_select_1").slideUp('slow');
            $("#override_date_select").slideUp('slow');
            $("#override_date_select").removeAttr('required');
            $("#override_date_select_1").removeAttr('required');
            $('#override_date_select-error').remove();
            $('#override_date_select_1-error').remove();
        }

    }
    $('#rocket_speed_switch').change();
</script>
@endsection

@section('content')


    @if($errors->any())
        <!-- For PHP validations errors-->
        <div class="alert alert-danger" data-name="CXBRwMze">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    @if(Session::has('error-msg'))
        <div class="alert alert-danger" data-name="qVajSdrR">
            {{ Session::get('error-msg') }}
        </div>
    @endif

    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide" data-name="ysxdOion">
    <span id='msg-text'><span>
    </div>

    <div class="row" data-name="UlRRRQat">
        @if($isListExist==0)
            <div class="col-md-12" data-name="IQjSIGvA">
                {{trans('contacts.message.no_list_error')}}
                 <a href="{{ route('list.create') }}">
                    <button class="btn btn-primary"> {{trans('contacts.import.form.create_a_list')}} </button>
                </a>
            </div>
        @else
            <div class="col-md-6 create-form" data-name="PzyacOOA">

            <!--  Loader DIV  -->
            <div class="loading usman" id="loading" style="" data-name="bSKSnWvt">
                <div class="loader" data-name="GxRHiTGw"></div>
                <div id="js_msg" data-name="EksxciIf"></div>
            </div>
            @if ($action == 'first')
                <!-- BEGIN FORM-->
                    <form action="{{ route('contact.import') }}" method="POST" id="subscriber-frm" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="next">
                        <input type="hidden" name="file_name" id="js_file_name">
                        <input type="hidden" id="listid" value="{{$list_id}}">
                        <div class="row" data-name="UVJzymJV">
                            <div class="col-md-12" data-name="oKbyLOlJ">
                                <div class="kt-portlet kt-portlet--height-fluid" data-name="OBWteQxf">
                                    <div class="kt-portlet__head" data-name="XEvaDrZP">
                                        <div class="kt-portlet__head-label" data-name="kIaXSBwo">
                                            <h3 class="kt-portlet__head-title">{{trans('contacts.import.form.heading')}}</h3>
                                        </div>
                                    </div>
                                    @php
                                    $app_settings =  getApplicationSettings();
                                    $user_can_select_file_from_server=config('appSettings.user_can_select_file_from_server');
                                    $rocket_import_default_mode =config('appSettings.rocket_import_default_mode');
                                    @endphp
                                    <div class="kt-portlet__body" id="blk1" data-name="oftkisSO">
                                        <div class="form-body" data-name="zYzpTBrg">
                                            <div class="form-group row" @if($user_can_select_file_from_server != "off") style="display: block;" @else style="display: none;" @endif data-name ="smrDlbef">
                                                <div class="col-md-12" data-name="lQLXBfMv">
                                                    <label class="col-form-label">{{trans('contacts.import.form.import_file')}}
                                                         {!! popover( 'contacts.import.form.import_file_help','common.description' ) !!}
                                                    </label>
                                                    <select class="form-control" name="import_file_selection" id="import-file-selection">
                                                        <option value="computer"> {{trans('suppression.modal.form.upload_csv_file')}}</option>
                                                        @if( $user_can_select_file_from_server != "off")
                                                        <option value="folder">{{trans('suppression.modal.form.select_file_from_server')}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="file-from-computer" data-name="pkLNEmzu">
                                                <div class="col-md-12" data-name="YdKLrWXS">
                                                    <label class="col-form-label">{{trans('suppression.modal.form.select_file')}} 
                                                        <span class="required"> * </span>
                                                        <small> ({{trans('suppression.modal.form.max_file_size')}}  {{ $max_file = (file_upload_max_size()/1024)/1024}}MB)</small>
                                                             {!! popover( 'contacts.import.form.select_file_help','common.description' ) !!}
                                                    </label>
                                                    <div class="custom-file" data-name="MTwntaLE">
                                                        <input type="file" class="custom-file-input" onchange="ValidateSizes(this)" name="file_import" id="import-id">
                                                        <label class="custom-file-label"  for="customFile" id="importIdLabel">{{trans('suppression.modal.form.choose_file')}} </label>
                                                        <span style="color:red; display:none"  id="FileSizeError">{!! trans('common.message.FileSizeError',['max_file'=>$max_file."MB"]) !!}  <span>
                                                    </div>
                                                    <div class="uploading-blk" data-name="haLBoUOT">
                                                    <div class="upl-text" data-name="WbigPoqy">{{trans('suppression.modal.form.uploading_file')}}: </div>
                                                    <div class="myProgress" data-name="nMajSrDY">
                                                        <div class="bg-info" id="uploading-progress" data-name="FISXKIcF"></div>
                                                    </div>
                                                    <i class="la la-refresh fa-spin"></i>
                                                    <span class="ups-counter"><span class="count">0</span>%</span>
                                                    <i class="fa fa-check text-success ups-check"></i>
                                                    <a href="javascript:;" id="cancel-pen"><i class="fa fa-times text-danger"></i></a>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="file-from-folder" style="display:none;" data-name="QsVXRPpD">
                                                    
                                                <div class="col-md-12" data-name="ZYvpydYr">
                                                    <label class="col-form-label">{{trans('contacts.import.form.import_file')}}
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <select data-placeholder="{{trans('common.label.select_file')}}" class="form-control m-select2" name="folder_file_import" id="folder-import-id">
                                                        <option></option>
                                                        @foreach ($folder_files as $file)
                                                            <option value="{{ $file['basename'] }}">{{ $file['basename'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <br />
                                                    <div class="help-text" data-name="UZQSoyPg">{{ trans('suppression.upload_dir',['path'=>'/storage/users/'.Auth::id().'/files/imports/subscribers/']) }}</div>
                                                    <a class="text-danger" href="javascript:void(0)" id="delete_import_files">{{trans('common.delete_all_uploaded_files')}}</a>
                                                </div>
                                                <div class="help-side" data-name="qrZuKrZg">{{trans('common.import.import_allowed_file_formats')}}</div>
                                            </div>
                                           
                                            <?php  if(!extension_loaded('fileinfo')){ ?>
                                            <div class="form-group" data-name="NSMYWhVG">
                                                            <div class="alert alert-danger alert-bold" role="alert" data-name="yIfybpdO">
                                                            <div class="alert-text" data-name="RMJDOEWI">{{trans('common.message.file_info_disabled')}}</div>
                                                        </div>
                                            </div>
                                
                                            <?php }?>
                                            <div class="form-group row" data-name="mAQdYdky">
                                                <label class="col-form-label pl12">{{trans('suppression.modal.form.rocket_speed')}}</label>
                                                <div class="col-md-8" data-name="inzMcTLJ">
                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                        <label>
                                                            <input type="checkbox" @if($rocket_import_default_mode== "rocket") checked readonly @endif name="rocket_speed" id="rocket_speed_switch" onchange="showHandleRocketSpeed(this)" />
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                               
                                                
                                            </div>
                                             <div class="col-md-12 form-group" data-name="AkZjkncb">
                                                    <div class="form-group row" id="info_msg_div" style="display: none; margin-bottom: -20px;" data-name="fRFrpbaY">
                                                        <div class="col-md-12" id="info_msg_div2" data-name="qpkGaqQk">
                                                            <div class="alert alert-danger alert-bold" role="alert" data-name="jygqdArn">
                                                            <div class="alert-text" data-name="XssikilC">
                                                                 {!! trans('common.message.local_infile') !!}
                                                            </div>
                                                        </div>
                                                          
                                                        </div>
                                                    </div>
                                                </div>


                                            <div class="form-group row" data-name="VeEYbnRy">
                                                    
                                                <div class="col-md-6" data-name="AOYiOSac">
                                                    <label class="col-form-label">{{trans('common.label.contact_list')}}
                                                        <span class="required"> * </span>
                                                        {!! popover( 'contacts.import.form.contact_list_help','common.description' ) !!}
                                                    </label>
                                                    <select class="form-control m-select2" data-placeholder="{{trans('contacts.choose_a_list')}}" name="list_id" id="list-id" required>
                                                        <option value="">{{trans('contacts.choose_a_list')}}</option>
                                                        @foreach($group_lists as $key => $group)
                                                            <optgroup label="{{$key}}">
                                                                @foreach($group as $list)
                                                                @if($list["disable_import"] != 1 || !isClient(Auth::user()))
                                                                    <option value="{{ $list['id'] }}" {{ isset($subscriber->list_id) && ($list['id']  == $subscriber->list_id) || (!empty($list_id) && $list['id'] == $list_id) ? 'selected' : '' }}>
                                                                        &nbsp;&nbsp;
                                                                        {{ $list['name']  }}</option>
                                                                @endif
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6" id="threads_div" data-name="aaQHmaMN">
                                                    <label class="col-form-label" >{{trans('contacts.import.form.import_speed')}}
                                                        {!! popover( 'contacts.import.form.import_speed_help','common.description' ) !!}
                                                    </label>
                                                    <select class="form-control custom-field-id_1" name="threads" >
                                                        <option value="1">1x</option>
                                                        <option value="2">2x</option>
                                                        <option value="3">3x</option>
                                                        <option value="4" selected>4x</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" data-name="GRkSYNwB">
                                                    <label class="col-form-label" >{{trans('common.label.format')}}
                                                         {!! popover( 'contacts.import.form.format_help','common.description' ) !!}
                                                    </label>
                                                    <select class="form-control" name="format">
                                                        <option value="html">{{trans('common.label.html')}}</option>
                                                        <option value="text">{{trans('common.label.text')}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" data-name="tjMEDAbn">
                                                    <label class="col-form-label">{{trans('contacts.import.form.confirmation_status')}}
                                                         {!! popover( 'contacts.import.form.confirmation_status_help','common.description' ) !!}
                                                    </label>
                                                    @php 
                                                     $allow_sending_email_unconfirmed = getSetting("user_import_contacts_confirmed");
                                                    @endphp
                                                    <select class="form-control" name="is_confirmed">
                                                        @if($allow_sending_email_unconfirmed != "on")
                                                        <option value="1">{{trans('common.confirmed')}}</option>
                                                        @endif
                                                        <option value="0">{{trans('common.unconfirmed')}}</option>
                                                    </select>
                                                    @if($allow_sending_email_unconfirmed == "on")
                                                        <small style="color:red">{{trans('contacts.import_blade.small_note_confirm_email')}}</small>
                                                    @endif

                                                </div>
                                                <div class="col-md-6" data-name="mmxvAcAM">
                                                    <label class="col-form-label">{{trans('contacts.import.form.contact_status')}}
                                                         {!! popover( 'contacts.import.form.contact_status_help','common.description' ) !!}
                                                    </label>
                                                    <select class="form-control" name="is_active">
                                                        <option value="1">{{trans('common.label.active')}}</option>
                                                        <option value="0">
                                                            {{trans('common.label.inactive')}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" data-name="zfMUWNUw">
                                                    <label class="col-form-label">{{trans('suppression.modal.form.line_contains_headers')}}
                                                         {!! popover( 'contacts.import.form.line_contains_headers_help','common.description' ) !!}
                                                    </label>
                                                    <select class="form-control" name="headers_include">
                                                        <option value="1">{{trans('common.form.buttons.yes')}}</option>
                                                        <option value="0">{{trans('common.form.buttons.no')}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" data-name="NIOSTFck">
                                                    <label class="col-form-label">{{trans('contacts.import.form.file_format')}}
                                                         {!! popover( 'contacts.import.form.file_format_help','common.description' ) !!}
                                                    </label>
                                                    <select class="form-control" name="file_format">
                                                        <option value="csv">{{trans('common.label.csv')}}</option>
                                                        <option value="txt">{{trans('common.label.text')}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" data-name="oPmurvgJ">
                                                    <label class="col-form-label">{{trans('common.label.duplicates')}}
                                                         {!! popover( 'contacts.import.form.duplicates_help','common.description' ) !!}
                                                    </label>
                                                    <select class="form-control" name="duplicates" id="select_duplicate_id">
                                                        <option value="skip">{{trans('common.label.skip')}}</option>
                                                        <option value="overwrite">{{trans('common.label.overwrite')}}</option>
                                                        <option value="update" id="updateOption">{{trans('common.label.update')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="kt-portlet__foot" data-name="aDmqyLGA">
                                        <div class="form-actions" data-name="VYhVCnPj">
                                            <div class="row" data-name="pXFPAqfG">
                                                <div class="col-md-12" data-name="rjZKrZeB">


                                                    <button type="submit" NO NUMERIC NOISE KEY 1023 disabled 1022 id =next-btn class="btn btn-success">{{trans('common.form.buttons.next')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM -->
                @elseif ($action == 'next')
                    <div id="mapping-data-id" data-name="ooceoRqt">
                        <!-- BEGIN FORM-->
                        <form action="/contact/import" method="POST" id="subscriber-frm" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="action" id="action" value="import">
                            <input type="hidden" name="file_name" id="file_name_js" value="{{ $file_name }}">
                            <input type="hidden"   id="sub-emails" name="sub_emails" value="">
                            <input type="hidden"  name="threads" value="{{$threads}}">
                            <input type="hidden"  name="rocket_speed" value="{{$rocket_speed ? 1 : 0}}">
                            @foreach ($last_page_request as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <div class="row" data-name="UeosVCBH">
                                <div class="col-md-12" data-name="PoavOvwC">
                                    <div class="kt-portlet kt-portlet--height-fluid" data-name="kCBIjpXS">
                                        <div class="kt-portlet__head" data-name="jCspKDHG">
                                            <div class="kt-portlet__head-label" data-name="rsoUSvtB">
                                                <h3 class="kt-portlet__head-title">{{trans('contacts.import.form.contacts_from')}} <strong>{{ $file_name }}</strong> to {{$list_name}}</h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="nWHZjSoR">
                                            <div class="form-body" data-name="oFdpPryS">

                                                <div class="form-group row" data-name="QqqmCgGx">
                                                        
                                                    <div class="col-md-12" data-name="GmZpzFRf">
                                                        <label class="col-form-label">{{trans('contacts.add_new.form.email_address')}} <sup style="color: red;">*</sup>
                                                            <input type="hidden" name="custom_field_id[]" class="custom-field-id" value="0">
                                                             {!! popover( 'contacts.import.form.email_address_help','common.description' ) !!}
                                                        </label>
                                                        <select class="form-control file_field_id" name="file_field_id[]" required id="cf_0">
                                                            <option value="" >{{trans('contacts.import.form.select_none')}}</option>
                                                            @foreach ($file_headers as $key => $header)
                                                                <option value="{{ $key }}" {{strpos($header, 'Email')!== false?'selected':''}}>{{ $header }}</option>
                                                            @endforeach}}
                                                        </select>
                                                    </div>
                                                </div>
                                              
                                             
                                                    @foreach ($list_fields as $field)
                                                        @if($field['type']!='date')
                                                            <div class="form-group row mb1" data-name="mNzmOeJc">
                                                                    
                                                                <div class="col-md-12" data-name="pikofixN">
                                                                    <label class="col-form-label">{{ $field['name'] }}
                                                                        <input type="hidden" name="custom_field_id[]" class="custom-field-id" value="{{$field['id']}}">
                                                                    </label>
                                                                    <select class="form-control file_field_id {{$field['type']=='date'?'date':''}}" name="file_field_id[]"  id="cf_{{$field['id']}}" >
                                                                         <option value="" >{{trans('contacts.import.form.select_none')}}</option>
                                                                        @foreach ($file_headers as $key => $header)
                                                                            <option value="{{ $key }}" {{strpos($header, $field['name'])!== false?'selected':''}}>{{ $header }}</option>
                                                                        @endforeach}}
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($field['type']=='date')
                                                            <div class="form-group row mb1" data-name="yNVBxtIL">
                                                                    
                                                                <div class="col-md-12" data-name="UBzTjtDv">
                                                                    <label class="col-form-label">{{ $field['name'] }}
                                                                        <input type="hidden" name="custom_field_id[]" class="custom-field-id" value="{{$field['id']}}">
                                                                    </label>
                                                                    <div class="row" data-name="kXMjLiPU">
                                                                        <div class="col-md-6" data-name="ejjkFOqh">
                                                                            <select class="form-control file_field_id {{$field['type']=='date'?'date':''}}" name="file_field_id[]" @if($field['type']=='date') id="cf_{{$field['id']}}" @endif>
                                                                                 <option value="" >{{trans('contacts.import.form.select_none')}}</option>
                                                                                @foreach ($file_headers as $key => $header)
                                                                                    <option value="{{ $key }}" {{strpos($header, $field['name'])!== false?'selected':''}}>{{ $header }}</option>
                                                                                @endforeach}}
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6" data-name="PamyPTCI">
                                                                            <select class="form-control date_format"  @if($field['type']=='date') name="csv_date_format[{{$field['id']}}]" @endif>
                                                                                @php($formats = ['yyyy-mm-dd','dd-mm-yyyy','yyyy/mm/dd','dd/mm/yyyy','yy-mm-dd','dd-mm-yy','yy/mm/dd','dd/mm/yy','mm/dd/yyyy','mm-dd-yyyy'])
                                                                                <option value="" >{{__('contacts.import.form.select_date_format')}}</option>
                                                                                @foreach($formats as $format)
                                                                                <option value="{{$format}}" >{{$format}}</option>
                                                                                    @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @if(!$rocket_speed)
                                                    <div class="form-group row mb1" data-name="eGUpOvPT">
                                                        <div class="col-md-12" data-name="rlKbVtcV">
                                                            <div class="row" data-name="putTdjSo">
                                                                <div class="col-md-12" data-name="qcqtsbnM">
                                                                    <div class="kt-checkbox-list" data-name="PZjIdUFx">
                                                                        <label for="creation_date" class="kt-checkbox">
                                                                            <input class="group-selector-subscriber" type="checkbox" onchange="showOrHide()" id="creation_date" name="creation_date" value="1"  >  {{__('contacts.import.form.override_creation_date')}}
                                                                            <span></span>
                                                                            {!! popover( 'contacts.import.form.override_creation_date_help','common.description' ) !!}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                             
                                                   
                                                <div class="form-group row mb1" data-name="SeynKywv">
                                                    <label class="col-form-label">

                                                    </label>
                                                    <div class="col-md-12" data-name="qVsbzVcL">
                                                        <div class="row" data-name="skafuMPj">
                                                            <div class="col-md-6" data-name="EdeEwtGy">
                                                                <select class="form-control date_" name="override_date" id="override_date_select" style="display: none;">
                                                                    <option value="" >{{trans('contacts.import.form.select_none')}}</option>
                                                                    @foreach ($file_headers as $key => $header)
                                                                        <option value="{{ $key }}" >{{ $header }}</option>
                                                                    @endforeach}}
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6" data-name="FVtqdKju">
                                                                <select class="form-control date_format"  id="override_date_select_1" name="override_date_select" style="display: none;">
                                                                    @php($formats = ['yyyy-mm-dd','dd-mm-yyyy','yyyy/mm/dd','dd/mm/yyyy','yy-mm-dd','dd-mm-yy','yy/mm/dd','dd/mm/yy','mm/dd/yyyy','mm-dd-yyyy'])
                                                                    <option value="" >{{__('contacts.import.form.select_date_format')}}</option>
                                                                    @foreach($formats as $format)
                                                                        <option value="{{$format}}" >{{$format}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                @endif
                                                {{----}}
                                            </div>
                                            
                                        </div>
                                        <div class="kt-portlet__foot" data-name="atHwiLFU">
                                            <div class="form-actions" data-name="qunKxsnP">
                                                <div class="row" data-name="qBqQOnyL">
                                                    <div class="col-md-12" data-name="cHSkSgXv">
                                                        <button type="submit" class="btn btn-success" id="btn-next">{{trans('common.form.buttons.next')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM -->
                    </div>
                    <div id="progress-import" style="display: none;" data-name="GytVGgYx">
                        <div class="col-md-12" data-name="DXRbBOsz">
                            <div class="kt-portlet kt-portlet--height-fluid" data-name="RSaijioa">
                                <div class="kt-portlet__head" data-name="RYfPVPuu">
                                    <div class="kt-portlet__head-label" data-name="TMLqyIvu">
                                        <h3 class="kt-portlet__head-title">
                                            {{ $pageTitle }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body" data-name="OBlvRwLh">
                                 
                                   
                                       <div class="alert alert-info alert-light alert-bold" role="alert" data-name="LdvvTEDJ">
                                            <div class="alert-text" data-name="rEJsMGzr">{{trans('contacts.import.form.notification')}}</div>
                                        </div>

                                    <div class="row" data-name="tMbPMalT">

                                        <div class="col-md-12" data-name="kkLzpEDk">
                                            <div style="display: block;" id="ajax-spinner-text" data-name="nGBlRBPc"><i class="fa fa-spinner fa-spin"></i><i class="fa fa-check text-success"></i> {{trans('common.label.importing')}} {{ $file_name }} {{trans('common.label.to')}} <strong>{{$list_name}}</strong></div>
                                            <div class='alert alert-warning alert-light alert-bold' role='alert' id='aborted' style="display: none;" data-name="mQSpjpFI">{{ trans('common.message.import_operation_aborted') }}</div>
                                             <div class="alert alert-success alert-light alert-bold" role="alert" id="resultbar" data-name="HAGkFaQj">
                                                <div class="alert-text" data-name="DBuEmmng">{!! trans('common.message.import_operation_success') !!}</div>
                                            </div>
                                        </div>
                                        @if(!$rocket_speed)
                                        <div class="col-md-12" data-name="UUYYknMU">
                                            <div class="progress progress-striped active" data-name="rkUdiqtW" >
                                                <div id="import_progress_bar" class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%" data-name="DOBdIuLu">0%</div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                <div id="import-result" class="table-responsive" style="display: none;" data-name="HipbEaPV">
                     <div id="normal_import" style="display: none;" class="table-responsive" data-name="jxDejiSL"></div>
                     @if($rocket_speed)
                     <div id="rocket_import"  class="table-responsive" data-name="lkoscuna">
                    <table class="table table-hover table-striped table-result">
                        <tbody>
                            <tr id="total_contacts_row">
                                <td width="43%">{{trans('common.import.rocket.total_contacts')}}:</td>
                                <td width="90px"><span style="display: none;" class="zero1">0</span><span id="total_contacts_js">0</span></td>
                                <td width="270px">
                                    <div class="progress progress-sm" data-name="sEtyEtWg" >
                                        <div class="progress-bar bg-success" style="width: 100%;" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="progressbar1" data-name="ghMmwjCu">100%</div>
                                    </div>
                                </td>
                                <td width="38%">
                                    <div id="tl-counts" data-name="KzPNVrDf">
                                        <i class="fa fa-spinner fa-spin waiting" style="display: none;"></i>
                                        <span style="display: none;" class="counter"><span class="count1">100</span>%</span>
                                        <i class="fa fa-check check1" style="display: block;"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr id="importing_contacts_row">
                                <td>{{trans('common.import.rocket.imported')}}:</td>
                                <td><span id="total_imported_js">0</span></td>
                                <td>
                                    <div class="progress progress-sm" data-name="PthwXeEJ" >
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressbar2" data-name="pVeQBcJz"></div>
                                    </div>
                                </td>
                                <td>
                                    <div id="imp-counts" data-name="VreJIFGm">
                                        <span class="waiting2 waitings">{{trans('common.label.waiting')}} <span>.</span><span>.</span><span>.</span></span>
                                        <span class="counter2"><span class="count2" id="progress_count">100</span>%</span>
                                        <i class="fa fa-check check2"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr id="removing_duplicates_row">
                                @if(isset($last_page_request['duplicates']) && $last_page_request['duplicates']=="overwrite")
                                <td>Overwritten:</td>
                                @else
                                <td>{{trans('common.import.rocket.removing_duplicates')}}:</td>
                                @endif
                                <td><span  id="duplicates_found">0</span>&nbsp;&nbsp;
                                    <a id="download-duplicates" href="#"><i class="fa fa-download"></i></a>
                                </td>
                                <td>
                                    <div class="progress progress-sm" data-name="aUOGHzkI" >
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressbar3" data-name="hTvLdqvN"></div>
                                    </div>
                                </td>
                                <td>
                                    <div id="dp-counts" data-name="UPBCDqgt">
                                        <span class="waiting3 waitings">{{trans('common.label.waiting')}} <span>.</span><span>.</span><span>.</span></span>
                                        <span class="counter3"><span id="duplicate_count_progress" class="count3">0</span></span>
                                        <i class="fa fa-check check3"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr id="invalid_row">
                                <td>{{trans('common.import.rocket.removing_invalids')}}:</td>
                                <td><span id="invalid_found">0</span>&nbsp;&nbsp;
                                    <a id="download-invalid" href="#"><i class="fa fa-download"></i></a>
                                </td>
                                <td>
                                    <div class="progress progress-sm" data-name="RXoWmEgl" >
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="invalid_progress_bar" data-name="cTzuMInY"></div>
                                    </div>
                                </td>
                                <td>
                                    <div id="inv-counts" data-name="ZRhZpifx">
                                        <span class="waiting4 waitings">{{trans('common.label.waiting')}} <span>.</span><span>.</span><span>.</span></span>
                                        <span class="counter4"><span class="count4" id="invalid_found_percent">0</span></span>
                                        <i class="fa fa-check check4"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    
                                </td>
                                <td>
                                    <a href="#" id="view-contacts">
                                        <button type="button" style="float: none;" name="save_add" class="btn btn-success btn-sm pull-right" value="View Contacts">{{trans('common.label.view_contacts')}}</button> 
                                    </a>
                                    <div id="cancel_div" data-name="aBGWBxah">
                                    
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                     @endif
                </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection