@extends(decide_template())
@section('title', trans('addons.page.title'))

@section('page_styles')
<link href="/themes/default/css/lightgallery.css?v={{$local_version}}.01" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/resources/assets/css/addons.css?v={{$local_version}}.01">
<style type="text/css">
    .fa-unlock-alt:before {
    content: "\f13e";
}
.fa-drivers-license:before, .fa-id-card:before {
    content: "\f2c2";
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/picturefill.min.js"></script>
<script src="/themes/default/js/lightgallery-all.min.js"></script>
<script src="/themes/default/js/jquery.mousewheel.min.js"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>

<script type="text/javascript">
   
    $(document).on('click','.license_key',function(){
        var addon= $(this).data('name');
        var key= $(this).data('key');
        $('#license_submit').prop('disabled',true);
        $('#license_error,#license_success').empty();
        $('#addon_name').val(addon);
        $('#key').val(key);
        $('#license_modal').modal('show');
    }); 
    $(document).on('click','#verify_license_key',function(){
        $('#license_error,#license_success').empty();
        var addon=$('#addon_name').val();
        var key= $('#key').val();
        if(key==''){
           $('#license_error').text("{{trans('addons.index_blade.enter_license_txt')}}"); 
           return false;
        }
         $.ajax({
            type: 'post',
            url: '{{route("addon_checkLicense")}}',
            data:{name:addon, key:key, verify_license:1},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('#license_submit').prop('disabled',true);
                $('.blockUI').show();
            },
            success: function (data) {
                    $('.blockUI').hide();
                if(data.status) {
                    $('#license_submit').prop('disabled',false);
                    $('#license_success').text(data.message);
                }
                else{
                    $('#license_submit').prop('disabled',true);
                    $('#license_error').text(data.message);
                }
                

            },
            error: function () {
            $('.blockUI').hide();
            }
        });
    }); 

    $(document).on('submit','#license-frm',function(e){
        e.preventDefault();
         $.ajax({
            type: 'post',
            url: '{{route('addon_checkLicense')}}',
            data:$(this).serialize(),
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
               $('.blockUI').hide();
                if(data.status) {
                    toastr.success(data.message);
                    $('#license_modal').modal('hide');
                }
                else{
                    toastr.error(data.message);
                }
            }
        });
    });
    function checkLicense(addon,flag=0) {
        $.ajax({
            type: 'post',
            url: '{{route('markAsResolvedAddon')}}',
            data:{'id':addon_id,'flag':flag},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if(data.status) {
                    if(data.message=='call_again') {
                        markAsResolved(addon_id, 1);
                    }else {
                        toastr.success(data.message);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                }
                else{
                    toastr.error(data.message);
                }

            },complete: function (data) {
                $('.blockUI').hide();
            }
        });
    }
    function markAsResolved(addon_id,flag=0) {
        $.ajax({
            type: 'post',
            url: '{{route('markAsResolvedAddon')}}',
            data:{'id':addon_id,'flag':flag},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if(data.status) {
                    if(data.message=='call_again') {
                        markAsResolved(addon_id, 1);
                    }else {
                        toastr.success(data.message);
                        setTimeout(function () {
                            window.location.href="{{ route('addons') }}";
                        }, 1000);
                    }
                }
                else{
                    toastr.error(data.message);
                }

            },complete: function (data) {
                $('.blockUI').hide();
            }
        });
    }
    function installAddon(name)
    {
        $.ajax({
            type: 'post',
            url: '{{route('installAddon')}}',
            data:{'name':name},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if(data.status) {
                    toastr.success(data.message);
                    setTimeout(function() {
                        window.location.href="{{ route('addons') }}";
                    }, 1000);
                }
                else{
                    // $('#' + name + '_alert').show();
                    // $('#' + name + '_alert .alert-text').html(data.message);
                    toastr.error(data.message);
                }

            },complete: function (data) {
                $('.blockUI').hide();
            }
        });
    }

    function unInstallAddon(name)
    {
        $.ajax({
            type: 'post',
            url: '{{route('unInstallAddon')}}',
            data:{'name':name},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if(data.status) {
                    toastr.success(data.message);
                    setTimeout(function() {
                        window.location.href="{{ route('addons') }}";
                    }, 1000);
                }
                else{
                    $('#' + name + '_alert').show();
                    $('#' + name + '_alert .alert-text').html(data.message);
                }

            },complete: function (data) {
                $('.blockUI').hide();
            }
        });
    }

    function removeAddon(name)
    {
        $.ajax({
            type: 'post',
            url: '{{route('removeAddon')}}',
            data:{'name':name},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if(!data.status) {
                    // toastr.error(data.message);
                    $('#' + name + '_alert').show();
                    $('#' + name + '_alert .alert-text').html(data.message);
                    return;
                }
                    setTimeout(function() {
                        window.location.href="{{ route('addons') }}";
                    }, 1000);
                    toastr.success(data.message);


            }
        });
    }

    function changeStatusAddon(id,status,name)
    {
        $.ajax({
            type: 'post',
            url: '{{route('changeStatusAddon')}}',
            data:{'id':id,'status':status},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if(data.status) {
                    toastr.success(data.message);
                    // if(status=='active') {
                    //     $('#' + name + '_active').hide()
                    //     $('#'+name+'_launch').show();
                    //     $('#' + name + '_inactive').show();
                    // }
                    // else if(status=='inactive') {
                    //     $('#'+name+'_launch').hide();
                    //     $('#' + name + '_inactive').hide();
                    //     $('#' + name + '_active').show();
                    //     $('#' + name + '_uninstall').show();
                    // }
                    // $('#'+name+'_update').hide();
                    window.location.href="{{ route('addons') }}";
                }
                else{
                    // toastr.error(data.message);
                    $('#' + name + '_alert').show();
                    $('#' + name + '_alert .alert-text').html(data.message);
                }

            },complete: function (data) {
                $('.blockUI').hide();
            }
        });
    }
       function update_addon(name)
    {
        $.ajax({
            type: 'post',
            url: '{{route('update_addon')}}',
            data:{'name':name,'action':"update"},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if(data.status==false) {
                    toastr.error(data.message);
                    $("#ae_alert").css("display", "flex");
                    $("#ae_alert_text").html(data.message);
                    return false;
                }
                $("#msg").removeClass("display-hide");
                toastr.success(data.message);
                $("#msg-text").html(data.message);
                window.location.href="{{ route('addons') }}";

            }
        });
    };

    function check_update(name,selector)
    {
        $.ajax({
            type: 'post',
            url: '{{route('check_update')}}',
            data:{'name':name},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                if(name)
                  $(selector,"button.btn-update2>i.la").addClass("fa-spin");
                $('.blockUI').show();
            },
            success: function (data) {
                if(name)
                $(selector,"button.btn-update2>i.la").removeClass("fa-spin");
                $('.blockUI').hide();
                if(data.status==false) {
                    toastr.error(data.message);
                    return false;
                }
                toastr.success(data.message);
                 setTimeout(function() {
                    window.location.reload();
                 }, 3000);

            }
        });
    };

    // function check_update2()
    // {
    //     $(".btn-update2>i").addClass("fa-spin");
    //     $(".btn-update22>i").addClass("fa-spin");
    //     $('.blockUI').show();
    //     setTimeout(function() {
    //         $('.blockUI').hide();
    //         $(".btn-update22>i").removeClass("fa-spin");
    //         $(".btn-update2>i").removeClass("fa-spin");
    //         toastr.success("Success: Cron is running to check for updates.");
    //     }, 2000);
    // };
    var limit = {{(int)ini_get("upload_max_filesize")}};
    var msg   = "{{ trans('addons.message.upload_max_filesize') }}";
     $.validator.addMethod('filesize', function (value, element,param) {
        return (Math.round(element.files[0].size/(1024*1024)) < param )
    }, msg);
        
    function toBytes(size, type)
    {
      const types = ["B", "KB", "MB", "GB", "TB"];

      const key = types.indexOf(type.toUpperCase())
      
      if (typeof key !== "boolean") {
          return  size * 1024 ** key;
      }
      return 0;
    }
    $(document).ready(function() {

        $('.gallery').lightGallery();
 
         $("#addons-frm").validate({
            ignore: [],       
            rules: { 
                zip_file: { required: true, filesize: limit  }
            },
            invalidHandler: function(event, validator) {
                Command: toastr["error"] (validator.errorList[0].message); 
                // Command: toastr["error"] ("You have some form errors. Please check below."); 
            },
            submitHandler: function(e) {
               
                var formData = new FormData($("#addons-frm")[0]);
                $.ajax({
                      xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                          if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                              var elem = document.getElementById("progress-simple");
                                  elem.style.width = percentComplete + "%";

                          }
                        }, false);

                        return xhr;
                      },
                       url : '{{ route("upload_addon") }}',
                       type : 'POST',
                       data : formData,
                       processData: false,  // tell jQuery not to process the data
                       contentType: false,  // tell jQuery not to set contentType
                       context: this,  
                       beforeSend : function() {
                         $('#import-result .alert').hide();
                         $('#import').prop('disabled',true);
                         $(".processingBlk").show();
                         $(".progress-block,#ajax-spinner-text").show();
                        var filename = $('input[type=file]').val().split('\\').pop();
                        $('#ajax-spinner-text .filename').html(filename);
                       },
                       success : function(data) {
                        if(data.status==false){
                            $("#resultbar,.progress-block,#ajax-spinner-text").hide();
                            $('#aborted .alert-text').html(data.message);
                            $('#aborted').css('display','inline-flex');
                      }else{
                            $('#aborted').hide();
                            $('#resultbar .alert-text').html(data.message);
                            $('#resultbar').css('display','inline-flex');
                            $(".progress-block,#ajax-spinner-text").hide();
                          setTimeout(function() {
                                window.location.href="{{ route('addons') }}";
                             }, 100);
                      }
                       $('#import').prop('disabled',false);
                    },error:function(){
                        $("#resultbar,.progress-block,#ajax-spinner-text").hide();
                        $('#import').prop('disabled',false); 
                    }
                });
            }
        });
        
     
    });
</script>
@endsection
@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="BQXtLFyu">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="BdmSIqqB">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row page-addon-index" data-name="RLCestbL">
    <div class="col-xl-8 col-lg-8  create-form" data-name="uRkZzGcx">
        <!--begin:: Widgets/Best Sellers-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="EzbOdnWs">
            <div class="kt-portlet__head" data-name="PWMZZEjL">
                <div class="kt-portlet__head-label" data-name="IFuXSeGr">
                    <h3 class="kt-portlet__head-title">
                        @lang('addons.list_of_addons')
                    </h3>
                </div>
                @if(config('app.type') !="demo")
                <div class="kt-portlet__head-toolbar" data-name="KwtFlegS">
                     @if(!empty($availableAddons))
                    <button class="btn btn-secondary btn-update22 popovers" onclick="check_update('',this)">@lang('addons.check_update')</button>
                     @endif
                    <button type="button" class="btn btn-sm btn-info"  data-toggle="modal" data-target="#upload_popup">@lang('addons.modal.upload_addon')</button>
                </div>
                @endif
            </div>
            <div class="kt-portlet__body" data-name="eBPKMYcb">
               
                <div class="tab-content" data-name="ZlOTlzHu">
                    <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true" data-name="HslbqsKq">
                        <div class="kt-widget5" data-name="rbpDyVDR">
                           
                            @foreach($availableAddons as $key => $config)
                                @if(isset($config['addon']))
                                @php
                                $addon = $config['addon'];
                                @endphp
                                @endif
                                @php
                                $install_dir = $key;
                                $license_key=\App\Addon::where('type',$config['type'])->value('license_key');
                                if(!$license_key) 
                                $license_key= isset($config['license_key']) ? $config['license_key']:'';
                                @endphp
                                
                            <div class="kt-widget5__item" data-name="tgciDixr">

                                <div class="kt-widget5__content" data-name="ybZPvocq">
                                    <div class="kt-widget5__pic gallery" data-name="qDvomAry">
                                        <span class="" data-src="{{$config['logo']}}"><i class="fa fa-search"></i><img class="kt-widget7__img" src="{{$config['logo']}}" alt=""></span>
                                       @if(isset($config['slider']))
                                           @foreach($config['slider'] as $item)
                                        <span class="hide" data-src="{{$item}}"><i class="fa fa-search"></i><img class="kt-widget7__img" src="{{$item}}" alt=""></span>
                                            @endforeach
                                                @endif
                                    </div>
                                    <div class="kt-widget5__section" data-name="odfBZGHg">
                                        <div class="kt-widget5__title" data-name="UIQlfNfS">
                                            {{$config['name']}}
                                        </div>
                                        <p class="kt-widget5__desc">
                                            {{$config['description']}}
                                        </p>
                                        <div class="kt-widget5__info" data-name="OGTQPNWa">
                                            <span class="mainBlk">
                                                <a href="{{$config['read_more']}}" target="_blank" class="kt-font-info link1">@lang('addons.read_more')</a>
                                                @if(isset($addon) && $addon->can_update && $addon->status=='active')
                                                   <span class="spacer upd-content">|</span>
                                                <span class="upd-info text-success  upd-content">@lang('addons.update_available')</span>
                                                @endif
                                                 @php($activeModule = activeModule($install_dir))
                                                 @if(isset($addon) && $activeModule)
                                                   <span class="spacer upd-content">|</span>
                                                <a href="{{isset($addon) && $addon->status=='active' && $activeModule? route($config['route']):'#'}}" class="kt-font-info">@lang('addons.settings')</a>
                                                @endif
                                            </span>
                                            <span class="mainBlk">
                                                <span class="link1">
                                                    <span class="kt-font-semibold">@lang('addons.index_blade.version_text_span') </span>
                                                    <span class="">{{isset($addon) ? $addon->installed_version :$config['version']}}</span>
                                                </span>
                                                <span class="spacer">|</span>
                                                <span class="kt-font-semibold">@lang('addons.index_blade.vendor_span')</span>
                                                <span class="">{{isset($addon) ? $addon->vendor : $config['vendor']}} </span>
                                                <span class="spacer">|</span>
                                                <span class="kt-font-semibold">@lang('addons.index_blade.support_expire_on_span')</span>
                                                <span class="">July 15, 2022 </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>                      
                                <div class="kt-widget5__content active inactive installed @if(isset($addon) && $addon->can_update) update @endif" data-name="MaNLhWOa">
                                    @if(isset($addon) && $addon->can_update && $addon->status=='active')
                                    <div id="{{$install_dir}}_update" class="kt-widget5__stats active updateBlk" data-name="nwRQCbVI">
                                        <button class="btn btn-info btn-update" onclick="update_addon('{{$key}}')">@lang('common.label.update')</button>
                                        <span class="vname kt-font-semibold">@lang('addons.version'):</span>
                                        <span class="vnumber">{{$addon->available_version}}</span>
                                    </div>
                                    @endif
                                    <div id="{{$install_dir}}_active" style="display: {{isset($addon) && ($addon->status=='inactive' || $addon->status=='error')?'block':'none;'}}" class="kt-widget5__stats" data-name="ZuTkenjF">
                                        <a href="javascript:;" @if(isset($addon)) onclick="changeStatusAddon('{{$addon->id}}','active','{{$install_dir}}')" @endif class="inactive">
                                            <span class="kt-widget5__number icon">
                                                <div class="tooltip">@lang('addons.index_blade.activate_addon_div')</div>
                                                <i class="fa fa-times-circle"></i>
                                            </span>
                                            <span class="kt-widget5__sales">@lang('addons.deactivated')</span>
                                        </a>
                                    </div>
                                    @if(isset($addon) && $addon->status=='active')
                                    <div class="kt-widget5__stats" data-name="muXJBWmc">
                                        <a href="javascript:;" @if(isset($addon)) onclick="changeStatusAddon('{{$addon->id}}','inactive','{{$install_dir}}')" @endif class="active">
                                            <span class="kt-widget5__number icon" ><div class="tooltip">@lang('addons.index_blade.deactivate_addon_div')</div><i class="fa fa-check-circle"></i></span>
                                            <span class="kt-widget5__sales">@lang('addons.activated')</span>
                                        </a>
                                    </div>
                                    @endif
                                    @if(isset($addon) && $addon->status !='available')
                                    <div class="kt-widget5__stats" data-name="jttrKREX">
                                        <a href="javascript:;" class="installed  @if(isset($addon) && $addon->status=='active') useInstalled @endif" onclick="unInstallAddon('{{$key}}')">
                                            <span class="kt-widget5__number icon" ><div class="tooltip">@lang('addons.index_blade.uninstall_addon_div')</div><i class="fa fa-check-circle"></i></span>
                                            <span class="kt-widget5__sales">@lang('addons.installed')</span>
                                        </a>
                                    </div>
                                    @endif
                                    
                                    @if(!isset($addon)) 
                                    <div id="{{$install_dir}}_install" style="display: {{!isset($addon) || isset($addon) && $addon->status=='available'?'block':'none;'}}" class="kt-widget5__stats btn-install icon" data-name="HNOPTalp">
                                        <div class="tooltip">@lang('addons.index_blade.install_addon_div')</div>
                                        <a href="javascript:;" onclick="installAddon('{{$key}}')" class="installed btn btn-success btn-xs" >
                                           @lang('addons.install')
                                        </a>
                                    </div>
                                    @elseif(isset($addon) && $addon->status=='available')
                                    <div id="{{$install_dir}}_install" style="display: {{!isset($addon) || isset($addon) && $addon->status=='available'?'block':'none;'}}" class="kt-widget5__stats" data-name="xrsSlsFR">
                                        <a href="javascript:;" onclick="installAddon('{{$key}}')" class="installed">
                                            <span class="kt-widget5__number icon" >
                                                <div class="tooltip">@lang('addons.index_blade.install_addon_div')</div>
                                                <i class="fa fa-check-circle"></i>
                                            </span>
                                            <span class="kt-widget5__sales">@lang('addons.install')</span>
                                        </a>
                                    </div>
                                    @endif
                                     @if(isset($config['license_key']))
                                    <div id="{{$install_dir}}insert_license_key"  style="display: {{ (!isset($addon) || (isset($addon) && $addon->status=='available' )) ? 'block':'block;'}}" class="kt-widget5__stats trash" data-name="yuprTfmF">
                                        <a href="javascript:;" data-name="{{$config['name']}}" data-key="{{$license_key}}"  class="installed license_key">
                                            <span class="kt-widget5__number icon" ><div class="tooltip">@lang('addons.insert_license_key')</div><i class="fa fa-address-card text-info" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                    @endif
                                    <div id="{{$install_dir}}_remove"  style="display: {{ (!isset($addon) || (isset($addon) && $addon->status=='available' )) ? 'block':'none;'}}" class="kt-widget5__stats trash" data-name="wDwMhvLC">
                                        <a href="javascript:;"  onclick="removeAddon('{{$key}}')" class="installed">
                                            <span class="kt-widget5__number icon" ><div class="tooltip">@lang('addons.index_blade.remove_addon_div')</div><i class="fa fa-trash"></i></span>
                                        </a>
                                    </div>
                                    @if(isset($addon) && $addon->status=='active')
                                    <button class="btn btn-secondary btn-update2 icon" onclick="check_update('{{$key}}',this)"><div class="tooltip">@lang('addons.check_update')</div><i class="la la-refresh"></i></button>
                                    @endif

                                </div>  
                                
                            </div>
                             <div data-name="zAtLtYcr" class="alert alert-danger danger" role="alert" id="{{$install_dir}}_alert" @if((isset($addon) && $addon->status=="error")) style="display:inline-flex;" @else style="display:none;" @endif  >
                                        <div class="alert-text" data-name="adorHRAz">
                                            {!!  (isset($addon) && $addon->error) ? $addon->error:''   !!}
                                        </div>

                                               @if(isset($addon))
                                               <button onclick="markAsResolved({{$addon->id}})" title="{{trans('addons.resolve.bt_title')}}" class="btn btn-primary btn-sm" style="width: 40px;">
                                                 {{trans('addons.btn_title.retry')}}
                                               </button>
                                               @endif


                                       </div>
                                    @php($addon = null)
                            @endforeach
                            @if(empty($availableAddons))
                            <div class="alert alert-warning" data-name="iUDQRapU">
                                <div class="alert-text" data-name="aKtMEhxO">
                                   @lang('addons.message.no_addon_available')
                                </div>
                            </div>
                            @endif
                            <div data-name="zAtLtYdr" class="alert alert-danger danger" role="alert" id="ae_alert" >
                                <div class="alert-text" id="ae_alert_text" data-name="adorHRzz">
                                   
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div> 
        <!--end:: Widgets/Best Sellers-->
    </div> 
</div>
<div class="modal fade" id="license_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-modal="true" data-name="igLBzOtS">
    <div class="modal-dialog modal-dialog-centered" role="document" data-name="GfdrlZyW">
        <div class="modal-content" data-name="jKviffLN">
            <div class="modal-header" data-name="UByACsxm">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('addons.license_required')</h5>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body" data-name="mUnuHWTS">
                <div class="form-group row" data-name="xjMliOZc">
                    <div class="col-md-12" data-name="Drosasjp">
                        @lang('addons.license_required_desc')
                    </div>
                </div>
                <form action="" method="POST" id="license-frm" class="kt-form kt-form--label-right">
                    <div class="form-group row" data-name="DkkQNzod">
                        <label class="col-form-label col-md-3">@lang('addons.license_key') <span class="required"> * </span></label>
                        <div class="col-md-8" data-name="PgSWpgvO">
                            <div class="input-group" data-name="pgdHNNNB">
                                <input type="text" required="" placeholder="@lang('addons.license_key')" id="key" name="key" class="form-control" >
                                <div class="input-group-append" data-name="nWHRIxnh">
                                    <a href="javascript:;" id="verify_license_key" title="Click to verify license key" class="btn btn-primary">@lang('addons.btn_title.verify')</a>
                                  </div>
                                <input type="hidden" name="name" id="addon_name" >
                                <p style="color: red; margin-bottom: 0; margin-top: 3px; width: 100%;" id="license_error"></p>
                                <p style="color: green; margin-bottom: 0; margin-top: 3px; width: 100%;" id="license_success"></p>
                            </div>
                        </div>
                    </div>
                  
                    <div class="form-actions row" id="action-row" data-name="rRiAqksX">
                        <label class="col-form-label col-md-3"></label>
                        <div class="col-md-8" data-name="ODSlUaYE">
                            <button disabled type="submit" id="license_submit" style="min-width: auto !important;" class="btn btn-success btn-sm pull-right">@lang('common.form.buttons.submit')</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-modal="true" data-name="eDJQrmUy">
    <div class="modal-dialog modal-dialog-centered" role="document" data-name="wAPscSFj">
        <div class="modal-content" data-name="PNQLhZTA">
            <div class="modal-header" data-name="gtPaAwcA">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('addons.modal.upload_addon')</h5>
            </div>
            <div class="modal-body" data-name="bwHdFMmE">
                <div class="form-group row" data-name="dNLhKuHW">
                    <div class="col-md-12" data-name="FNcFRYqF">
                        @lang('addons.modal.upload_addon_desc')
                    </div>
                </div>
                <form action="" method="POST" id="addons-frm" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                    <div class="form-group row" data-name="cwMRaJGx">
                        <label class="col-form-label col-md-3">@lang('addons.modal.select_file') <span class="required"> * </span></label>
                        <div class="col-md-8" data-name="lxrQSpjN">
                            <div class="input-icon right" data-name="tyYzcBnJ">
                                <input type="file" required="" name="zip_file" id="addon" accept=".zip" class="form-control" >
                                <span><b>@lang('addons.max'): {{(int)ini_get("upload_max_filesize")}}MB</b></span>
                            </div>
                        </div>
                    </div>
                  
                    <div class="form-actions row" id="action-row" data-name="bUJCGTdA">
                        <label class="col-form-label col-md-3"></label>
                        <div class="col-md-8" data-name="DCMguZLo">
                            <button type="submit" class="btn btn-success" id="import">@lang('addons.modal.upload_button')</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('common.form.buttons.cancel')}}</button>
                        </div>
                    </div>
                </form>
                <div class="processingBlk" data-name="sLMdRqaL">
                    <div id="ajax-spinner-text" data-name="KIwHbhif">
                        <i class="fa fa-spinner fa-spin" style="display: inline-block;"></i>
                         @lang('addons.modal.uploading') <strong class="filename"></strong>
                    </div>
                    <div id="import-result" data-name="QQxkCgGI">
                        <div class="alert alert-danger alert-light alert-bold" role="alert" id="aborted" data-name="oMdoFlnG">
                            <div class="alert-text" data-name="DRTNJFZB"></div>
                        </div>
                        <div class="alert alert-success alert-light alert-bold" role="alert" id="resultbar" data-name="eMWWTnei">
                            <div class="alert-text" data-name="LJCCOyrm"></div>
                        </div>
                        <div class="progress-block" data-name="vFaXxlKG">
                            <div class="bg-success" id="progress-simple" style="width: 0%;" data-name="roBCnIJa">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
