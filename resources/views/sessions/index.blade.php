@extends('layouts.master2')

@section('title', trans('sessions.sessions_index_blade.session_management_title'))

@section('page_styles')
    <link href="/public/assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/resources/assets/css/api-management.css?v={{$local_version}}.03">
    <style>
        .pe-none {
            pointer-events: none;
            opacity: 0.4;
        }
    </style>
@endsection



@section('content')

    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <!--<div class="alert alert-success">
    {{ Session::get('msg') }}
                </div>-->
    @endif
    @if (Session::has('error-msg'))
        <div class="alert alert-danger" data-name="NQqyejco">
            {{ Session::get('error-msg') }}
        </div>
    @endif

    <div class="kt-portlet kt-portlet--height-fluid" data-name="lbwftamY">
        <div class="kt-portlet__body" data-name="KebINYtx">
                <div class="tab-content" data-name="cmvTBqeC">
                    <div class="tab-pane active" id="tab1" data-name="utcRYWat">

                        <div class="table-scrollable" data-name="BnpOzxLk">
                            <table class="table table-striped table-hover table-checkable responsive" id="api-token">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('sessions.index.th.device')}}</th>
                                    <th>{{trans('sessions.index.th.ip')}}</th>
                                    <th>{{trans('sessions.index.th.browser')}}</th>
                                    <th>{{trans('sessions.index.th.location')}}</th>
                                    <th>{{trans('sessions.index.th.logged_in')}}</th>
                                    <th>{{trans('sessions.index.th.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @if(isset($sessions[$current_sid]))
                                @php($currentSession = $sessions[$current_sid])
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$currentSession['os']}} {{trans('sessions.index.csid')}}</td>
                                    <td>{{$currentSession['ip']}}</td>
                                    <td>{{$currentSession['browser']}}</td>
                                    <td>{{isset($currentSession['geoInfo']) ? $currentSession['geoInfo'] : 'N/A'}}</td>
                                    <td>{{!isset($currentSession['first_login'])?'N/A':showFormattedTime($authUser->id,'M d, Y h:i:s A',$currentSession['first_login'])}}</td>
                                    <td>
                                        <a class="text-danger delete pe-none"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endif
                                @foreach($sessions as $key => $session)
                                    @if(!file_exists($sessionPath.$key.'.json'))
                                        @continue
                                    @endif
                                    @php($en_key= \Illuminate\Support\Facades\Crypt::encrypt($key))
                                    @if($current_sid==$key)
                                        @continue
                                        @endif
                                    @php($i++)
                                    <tr id="{{$i}}">
                                        <td>{{$i}}</td>
                                        <td>{{$currentSession['os']}}</td>
                                        <td>{{$session['ip']}}</td>
                                        <td>{{$session['browser']}}</td>
                                        <td>{{isset($session['geoInfo']) ? $session['geoInfo'] : 'N/A'}}</td>
                                        <td>{{!isset($session['first_login'])?'N/A':showFormattedTime($authUser->id,'M d, Y h:i:s A',$session['first_login'])}}</td>

                                        <td>
                                            <a href="javascript:;" onclick="showModal('{{$en_key}}','{{$i}}')"  class="text-danger delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

        </div>
    </div>



    <!--begin::Modal-->
    <div id="session_modal" class="modal" tabindex="-1" role="dialog" aria-modal="true" style="padding-right: 17px;" data-name="UHEKvBqu">
        <div class="modal-dialog" role="document" data-name="nEmziMsG">
            <div class="modal-content" data-name="uPzbWjEN">
                <div class="modal-header" data-name="LfhGZWuD">
                    <h5 class="modal-title">{{trans('sessions.sessions_index_blade.confirmation_heading')}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" data-name="uPKeqmhd">
                    <p>{{trans('sessions.sessions_index_blade.delete_device_para')}} </p>

                </div>
                <div class="modal-footer" data-name="FxVUeEGU">

                    <button id="action" type="button" onclick="" class="btn btn-danger">{{trans('sessions.sessions_index_blade.delete_txt_button')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sessions.sessions_index_blade.cancel_txt_button')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/sweetalert2.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
    <script src="/js/validate-form.js" type="text/javascript"></script>
    <script>
        function deleteSession(id,id_) {
            $.ajax({
                url: "{{route('unsetSession')}}",
                type: "POST",
                data:{'sid':id},
                dataType:'json',
                beforeSend: function() {
                    $('.blockUI').show();
                },
                success: function(result) {
                    $('.blockUI').hide();
                    if(result.status) {
                        toastr.success(result.message);
                        $('#session_modal').modal('hide');
                        $('#'+id_).slideUp('slow');
                    }
                    else
                        toastr.error(result.message);
                }
            });
        }
        function showModal(id,id_) {
        $('#session_modal').modal('show');
        var action = 'deleteSession("'+id+'"'+',"'+id_+'")';
        $('#action').attr('onclick',action);
        }
    </script>
@endsection