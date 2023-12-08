@extends(decide_template())

@section('title', $title)

@section('page_styles')
<link href="/resources/assets/css/spintags-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/themes/default/js/includes/spin_tags.js" type="text/javascript"></script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="WKugIwZU">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="rzRBrJQl">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="iYYJLRYF">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="col-md-6 create-form" data-name="qDwPVqxQ">
    <!-- BEGIN FORM-->
@if($action == 'add')
        <form action="" method="POST" id="spintags-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else 
        <form action="{{ route('spintag.update', $custom_field->id) }}" method="POST" id="spintags-frm" class="kt-form kt-form--label-right">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="spintag-id" value="{{$custom_field->id}}">
        <input type="hidden" name="_method" value="PUT">
    @endif
            <div class="row" data-name="CsVHvaMg">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="htrXTgbB">
                <div class="kt-portlet__head" data-name="oxzDIHtQ">
                    <div class="kt-portlet__head-label" data-name="HtSmybcH">
                        <h3 class="kt-portlet__head-title">{{trans('spintags.add_new.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="lEEPdWuL">
                    <div class="form-body" data-name="iJyAYkhn">
                        <!-- Name / Placeholder -->
                        <div class="form-group row" data-name="oRssRNWB">
                            <div class="col-md-12" data-name="zPiJOnvC">
                                <label class="col-form-label">{{trans('spintags.add_new.form.name')}}
                                    <span class="required"> * </span>
                                     {!! popover( 'spintags.add_new.form.name_help','common.description' ) !!}
                                </label>
                                <div class="input-icon right" data-name="VwyBNeSC">
                                    <input type="text" name="place_holder" class="form-control" {{isset($custom_field->place_holder) ? "readonly" : '' }} value="{{isset($custom_field->place_holder) ? $custom_field->place_holder : '' }}" /> 
                                </div>
                            </div>
                        </div>
                        <!-- Name / Placeholder -->

                        <!-- List of Words -->
                        <div class="form-group row" data-name="nodWCubL">
                            <div class="col-md-12" data-name="FzsYCeQb">
                                <label class="col-form-label">{{trans('spintags.add_new.form.list_of_words')}} <span class="required"> * </span>
                                    {!! popover( 'spintags.add_new.form.list_of_words_help','common.description' ) !!}
                                </label>
                                <div class="input-icon right" data-name="CnEEMVhY">
                                    <textarea name="word_list" class="form-control" rows="12">{{@$custom_field->word_list}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- List of Words -->                        
                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="OxaAdMjo">
                    <div class="form-actions" data-name="YPOFBFiA">
                        <div class="row" data-name="lHKALCdk">
                            <div class="col-md-12" data-name="jGvUwMJD">
                                <!-- save & add new -->
                                <button type="submit" name="save_add" class="btn btn-success" value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                                @if($action == 'add')
                                <!-- save & exit -->
                                <button type="submit" name="save_exit" class="btn btn-success" value="save_exit">{{trans('common.form.buttons.save_exit')}}</button>
                                @else
                                <!-- save -->
                                <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save')}}</button>
                                @endif
                                <!-- cancel -->
                                <a href="{{ route('spintag.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
</div>
@endsection