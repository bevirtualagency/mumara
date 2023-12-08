@extends('layouts.master')

@section('title', trans('app.email_templates.view_template.title'))

@section('page_styles')

@endsection

@section('page_scripts')
<script>
    function templateDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/email-template/'+id,
                type: "DELETE",
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{ url('/') }}"+"/email-template/view";
                    }
                }
            });
        }
    }
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="ZsmuPANx">
    <ul class="page-breadcrumb">
        <li>
            <span>
                {{trans('app.email_templates.title')}}
            </span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>
                {{trans('app.email_templates.view_template.title')}}
            </span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.email_templates.view_template.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="qMlHvofL">
    {{ Session::get('msg') }}
</div>
@endif
<div class="row" data-name="SwSDWDHr">
    <div class="col-md-12" data-name="xVGTWnlN">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="kmjJnuuE">
            <div class="portlet-body" data-name="XqwTyqNn">
                <div class="table-toolbar" data-name="NYGxGWgK">
                    <div class="row" data-name="hLcteqGC">
                        <div class="col-md-6" data-name="bMgBAsil">
                        </div>
                        <div class="col-md-6" data-name="beFNpPTx">
                           @if(rolePermission(150))
                            <div class="btn-group pull-right" data-name="MPWsrdKH">
                                <a href="/email-template/create/?view=thumb">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    {{trans('app.email_templates.view_all.buttons.add_template')}} <i class="fa fa-plus"></i>
                                </button></a>
                            </div>
                           @endif
                        </div>
                    </div>
                </div>
                <div class="mt-element-card mt-element-overlay" data-name="pkrxQlTx">
                    <div class="row" data-name="mFJXeNTr">
                    @foreach ($email_template as $email_templates)
                        <div class="col-md-3" data-name="AmKkBRWU">
                            <div class="mt-card-item" data-name="qryUyCck">
                                <div class="mt-card-content" data-name="dQlJcIIq">
                                    <h3 class="mt-card-name">
                                    @if(rolePermission(157))
                                    <a href="{{ route('email-template.show',  $email_templates->id) }}" target="_blank" style="text-decoration:none">
                                    @endif
                                    {{$email_templates->name}}</a></h3>
                                </div>
                                @if(is_dir(config('mumara.attachment_path.templates')  . Auth::user()->id . "/templates/" . $email_templates->id . '/'))
                                <div class="" data-name="smkFFjXv">
                                @if(rolePermission(157))
                                <a href="{{ route('email-template.show',  $email_templates->id ) }}" target="_blank">
                                @endif
                                <center>
                                    <img src="{{URL::to('/assets/templates/' . $email_templates->id . '/original.png')}}" width="220px" height="220px">
                                </center>
                                </a>
                                </div>
                                @else
                                <div class="mt-card-avatar" data-name="qTbVdsQH">
                                @if(rolePermission(157))
                                <a href="{{ route('email-template.show',  $email_templates->id) }}" target="_blank">
                                @endif
                                <center>
                                    <img src="{{URL::to('/assets/templates/default/no-image.png')}}" width="220px" height="220px">
                                </center>
                                </a>
                                </div>
                                @endif
                                <div class="mt-card-content" data-name="DYEtUMlL">
                                    <div class="mt-card-social" data-name="gUUsnZvz">
                                <div class="btn-group" data-name="xJTFQAXG">
                                    <button class="btn btn-md green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        {{trans('app.email_templates.view_template.buttons.actions')}} <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                       @if(rolePermission(152))
                                        <li>
                                            <a href="/email-template/{{$email_templates->id}}/edit?view=thumb"> <i class="glyphicon glyphicon-edit"></i> {{trans('app.email_templates.view_template.buttons.edit')}}</a>
                                        </li>
                                       @endif
                                       @if(rolePermission(86))
                                        <li>
                                            <a href="{{url('/campaign/create')}}/{{$email_templates->id}}" id='campaign-create'> <i class="glyphicon glyphicon-export"></i>{{trans('app.email_templates.view_template.buttons.export')}}</a>
                                        </li>
                                       @endif
                                       @if(rolePermission(157))
                                        <li>
                                            <a href="{{ route('email-template.show',  $email_templates->id ) }}" target="_blank" id='view-html'> <i class="fa fa-eye"></i>{{trans('app.email_templates.view_template.buttons.view')}}</a>
                                        </li>
                                       @endif
                                       @if(rolePermission(154))
                                        <li>
                                            <a href="javascript:;" onclick="templateDelete( {{ $email_templates->id }} )" id='template-delete'> <i class="glyphicon glyphicon-remove"></i>{{trans('app.email_templates.view_template.buttons.delete')}} </a>
                                        </li>
                                       @endif
                                    </ul>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="pull-right" data-name="kwfeYuNl">{{ $email_template->links() }}</div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection