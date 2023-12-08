@extends('layouts.master2')
@section('title', trans('addons.page.title'))

@section('page_styles')
<link href="/themes/default/css/lightgallery.css?v={{$local_version}}.01" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/resources/assets/css/addons.css?v={{$local_version}}.01">
@endsection

@section('page_scripts')
<script src="/themes/default/js/picturefill.min.js"></script>
<script src="/themes/default/js/lightgallery-all.min.js"></script>
<script src="/themes/default/js/jquery.mousewheel.min.js"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script type="text/javascript">
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
                        location.reload();
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
                        location.reload();
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
                        location.reload();
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
                    location.reload();
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
                    return false;
                }
                toastr.success(data.message);
                location.reload();

            }
        });
        };
    $(document).ready(function() {

        $('.gallery').lightGallery();
 
         $("#addons-frm").validate({
            ignore: [],       
            rules: {
                addon: {
                    required: !0
                }
            },
            invalidHandler: function(event, validator) {
                Command: toastr["error"] ("{{trans('addons.index_backup_blade.form_errors_command')}}"); 
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
                                location.reload();
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
@section('content')

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="QBaHHsMM">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="HgzMZePP">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="VaPHMQGZ">
    <div class="col-xl-8 col-lg-8  create-form" data-name="dlKRafKU">
        <!--begin:: Widgets/Best Sellers-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="JobwsQtW">
            <div class="kt-portlet__head" data-name="eJQbpvDo">
                <div class="kt-portlet__head-label" data-name="MVlojmGg">
                    <h3 class="kt-portlet__head-title">
                        @lang('addons.list_of_addons')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar" data-name="noelpqKe">
                    <button type="button" class="btn btn-sm btn-info"  data-toggle="modal" data-target="#upload_popup">@lang('addons.modal.upload_addon')</button>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="fumOslLe">
               
                <div class="tab-content" data-name="JQioKiUU">
                    <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true" data-name="HdbITBVf">
                        <div class="kt-widget5" data-name="UUOyztGa">
                           
                            @foreach($availableAddons as $key => $config)
                                @if(isset($config['addon']))
                                @php($addon = $config['addon'])
                                @endif
                                @php($install_dir = $key)

                                   <div class="alert alert-danger danger" role="alert" id="{{$install_dir}}_alert" @if((isset($addon) && $addon- data-name="UBEEuosJ">status=="error")) style="display:inline-flex;" @else style="display:none;" @endif  >
                                        <div class="alert-text" data-name="RVRMiVxF">
                                            {!!  (isset($addon) && $addon->error) ? $addon->error:''   !!}
                                        </div>                            
                                    </div>
                                
                            <div class="kt-widget5__item" data-name="mIyJDeYP">

                                <div class="kt-widget5__content" data-name="FuoWLaDR">
                                    <div class="kt-widget5__pic gallery" data-name="qOXYOttI">
                                        <span class="" data-src="{{$config['logo']}}"><i class="fa fa-search"></i><img class="kt-widget7__img" src="{{$config['logo']}}" alt=""></span>
                                       @if(isset($config['slider']))
                                           @foreach($config['slider'] as $item)
                                        <span class="hide" data-src="{{$item}}"><i class="fa fa-search"></i><img class="kt-widget7__img" src="{{$item}}" alt=""></span>
                                            @endforeach
                                                @endif
                                    </div>
                                    <div class="kt-widget5__section" data-name="XZruMYqV">
                                        <div class="kt-widget5__title" data-name="wioEvQiA">
                                            {{$config['name']}}
                                        </div>
                                        <p class="kt-widget5__desc">
                                            {{$config['description']}}
                                        </p>
                                        <div class="kt-widget5__info" data-name="wqTfsYqx">
                                            <span>Your Version:</span>
                                            <span class="kt-font-info">{{isset($addon) ? $addon->installed_version :$config['version']}}</span>
                                            <span class="spacer"> | </span>
                                            <a href="{{$config['read_more']}}" target="_blank" class="kt-font-info">@lang('addons.read_more')</a>
                                            @if(isset($addon) && $addon->can_update && $addon->status=='active')
                                               <span class="spacer upd-content"> | </span>
                                            <span class="upd-info text-success  upd-content">@lang('addons.update_available')</span>
                                            @endif
                                             @php($activeModule = activeModule($install_dir))
                                             @if(isset($addon) && $activeModule)
                                               <span class="spacer upd-content"> | </span>
                                            <a href="{{isset($addon) && $addon->status=='active' && $activeModule? route($config['route']):'#'}}" class="kt-font-info">@lang('addons.launch')</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>                      
                                <div class="kt-widget5__content active inactive installed @if(isset($addon) && $addon->can_update) update @endif" data-name="zTiJHraU">
                                    @if(isset($addon) && $addon->can_update && $addon->status=='active')
                                    <div id="{{$install_dir}}_update" class="kt-widget5__stats active updateBlk" data-name="SIrKcSCQ">
                                        <button class="btn btn-info btn-update" onclick="update_addon('{{$key}}')">@lang('common.label.update')</button>
                                        <span class="vname">@lang('addons.version'):</span>
                                        <span class="vnumber">{{$addon->available_version}}</span>
                                    </div>
                                    @endif
                                    @if(isset($addon) && $addon->status=='active')
                                    <div class="kt-widget5__stats" data-name="XmACwNCp">
                                        <a href="javascript:;" class="active" style="pointer-events: none;">
                                            <span class="kt-widget5__number" ><i class="fa fa-check-circle"></i></span>
                                            <span class="kt-widget5__sales">@lang('addons.activated')</span>
                                        </a>
                                    </div>
                                    @endif
                                        @if(isset($addon))
                                    <div class="kt-widget5__stats" data-name="cvgocort">
                                        <a href="javascript:;" class="installed" style="pointer-events: none;">
                                            <span class="kt-widget5__number" ><i class="fa fa-check-circle"></i></span>
                                            <span class="kt-widget5__sales">@lang('addons.installed')</span>
                                        </a>
                                    </div>
                                        @endif
                                    <div id="{{$install_dir}}_active" style="display: {{isset($addon) && ($addon->status=='inactive' || $addon->status=='error')?'block':'none;'}}" class="kt-widget5__stats" data-name="bJfKuMWT">
                                        <a href="javascript:;" @if(isset($addon)) onclick="changeStatusAddon('{{$addon->id}}','active','{{$install_dir}}')" @endif class="inactive" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Click to Activate Addon">
                                            <span class="kt-widget5__number">
                                                <i class="fa fa-times-circle"></i>
                                            </span>
                                            <span class="kt-widget5__sales">@lang('addons.deactivated')</span>
                                        </a>
                                    </div>
                                    <div id="{{$install_dir}}_install" style="display: {{!isset($addon) || isset($addon) && $addon->status=='available'?'block':'none;'}}" class="kt-widget5__stats" data-name="mQtWLxMn">
                                        <a href="javascript:;" onclick="installAddon('{{$key}}')" class="installed" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Click to Install Addon">
                                            <span class="kt-widget5__number" >
                                                @if(!isset($addon))   
                                                <i class="fa fa-times-circle"></i>
                                                @elseif(isset($addon) && $addon->status=='available')
                                                <i class="fa fa-check-circle"></i>
                                                @endif
                                            </span>
                                            <span class="kt-widget5__sales">@lang('addons.install')</span>
                                        </a>
                                    </div>
                                    <div id="{{$install_dir}}_inactive" style="display: {{isset($addon) && $addon->status=='active'?'block':'none;'}}" class="kt-widget5__stats" data-name="PkQQanAI">
                                        <a href="javascript:;" @if(isset($addon)) onclick="changeStatusAddon('{{$addon->id}}','inactive','{{$install_dir}}')" @endif class="installed" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Click to Deactivate Addon">
                                            <span class="kt-widget5__number" ><i class="fa fa-times-circle"></i></span>
                                            <span class="kt-widget5__sales">@lang('addons.deactivate')</span>
                                        </a>
                                    </div>
                                    <div id="{{$install_dir}}_uninstall" style="display: {{isset($addon) && in_array($addon->status,['inactive'])? 'block':'none;'}}" class="kt-widget5__stats" data-name="XvVDysSN">
                                        <a href="javascript:;"  onclick="unInstallAddon('{{$key}}')" class="installed" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Click to Uninstall Addon">
                                            <span class="kt-widget5__number" ><i class="fa fa-times-circle"></i></span>
                                            <span class="kt-widget5__sales">@lang('addons.uninstall')</span>
                                        </a>
                                    </div>
                                    <div id="{{$install_dir}}_remove"  style="display: {{!isset($addon) ? 'block':'none;'}}" class="kt-widget5__stats" data-name="hunBhgKO">
                                        <a href="javascript:;"  onclick="removeAddon('{{$key}}')" class="installed" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Click to Remove Addon">
                                            <span class="kt-widget5__number" ><i class="fa fa-times-circle"></i></span>
                                            <span class="kt-widget5__sales">@lang('addons.remove')</span>
                                        </a>
                                    </div>
                                </div>  
                                
                            </div>
                                    @php($addon = null)
                            @endforeach
                            @if(empty($availableAddons))
                            <div class="alert alert-warning" data-name="YTWZZGlC">
                                <div class="alert-text" data-name="OwCQxLKp">
                                   @lang('addons.message.no_addon_available')
                                </div>
                            </div>
                            @endif
                      

                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div> 
        <!--end:: Widgets/Best Sellers-->
    </div> 
</div>

<div class="modal fade" id="upload_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-modal="true" data-name="XSQjdJIk">
    <div class="modal-dialog modal-dialog-centered" role="document" data-name="RUDUyift">
        <div class="modal-content" data-name="FkkJSpKJ">
            <div class="modal-header" data-name="HVWqKCeR">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('addons.modal.upload_addon')</h5>
            </div>
            <div class="modal-body" data-name="DOMbYIur">
                <div class="form-group row" data-name="EbVlXglr">
                    <div class="col-md-12" data-name="CWTeTozo">
                        @lang('addons.modal.upload_addon_desc')
                    </div>
                </div>
                <form action="" method="POST" id="addons-frm" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                    <div class="form-group row" data-name="YkWnZamK">
                        <label class="col-form-label col-md-3">@lang('addons.modal.select_file') <span class="required"> * </span></label>
                        <div class="col-md-8" data-name="iruYlhCn">
                            <div class="input-icon right" data-name="gRMbUaNu">
                                <input type="file" required="" name="zip_file" id="addon" accept=".zip" class="form-control" >
                            </div>
                        </div>
                    </div>
                  
                    <div class="form-actions row" id="action-row" data-name="wcFLJMtc">
                        <label class="col-form-label col-md-3"></label>
                        <div class="col-md-8" data-name="NIhdKMxe">
                            <button type="submit" class="btn btn-success" id="import">@lang('addons.modal.upload_button')</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('common.form.buttons.cancel')}}</button>
                        </div>
                    </div>
                </form>
                <div class="processingBlk" data-name="AOqrKdGS">
                    <div id="ajax-spinner-text" data-name="riHDVoen">
                        <i class="fa fa-spinner fa-spin" style="display: inline-block;"></i>
                         @lang('addons.modal.uploading') <strong class="filename"></strong>
                    </div>
                    <div id="import-result" data-name="YndqTJMa">
                        <div class="alert alert-danger alert-light alert-bold" role="alert" id="aborted" data-name="FQLXumzB">
                            <div class="alert-text" data-name="pJhpvMDJ"></div>
                        </div>
                        <div class="alert alert-success alert-light alert-bold" role="alert" id="resultbar" data-name="dFPvUAhi">
                            <div class="alert-text" data-name="TxRnxYCm"></div>
                        </div>
                        <div class="progress-block" data-name="YmKLMyUI">
                            <div class="bg-success" id="progress-simple" style="width: 0%;" data-name="TDMxAovY">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection