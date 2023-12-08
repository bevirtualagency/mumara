@extends(decide_template())

@section('title',  $pageTitle)

@section('page_styles')
<style>
#package tr th:first-child, #package tr td:first-child {
    padding: 10px 12px;
    text-align: center;
    max-width: 40px;
    width: 5%;
} 
#package tr th:last-child, #package tr td:last-child {
    padding: 10px 12px;
    text-align: center;
    max-width: 200px;
    width: 10%;
} 
.table>thead>tr>th:first-child, .table>tbody>tr>td:first-child {
    max-width: 40px;
    text-align: center;
    width: 4% !important;
}
#package tr th, #package tr td {
    text-align: center !important;
    padding: 12px 6px !important;
}
#package tr th:nth-child(2), #package tr td:nth-child(2) {
    text-align: left !important;
}

</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/User-Management/Packages");

         // function in master2 layout
        var page_limit=show_per_page('','packages_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#package').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [0,2,3] }
            ],
            "aaSorting": [[1, "asc"]],
            "pageLength" : page_limit,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
         page_limit=show_per_page(table,'packages_pageLength');
    });

    function packageDelete(id)
    {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/client/package/delete/'+id,
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
</script>
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="aXllqoHx">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="vVmeccnR">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>

@if(!$roles)
<div class="col-md-12" data-name="upleLjiu">
    <div class="note prDomain" data-name="jjEvNAVx">
        <p>
            {{trans('users.message.role_not_found')}}
            <a href="{{ route('package.role.create') }}" type="button" class="btn btn-warning btn-sm">{{trans('users.packages.create_role')}} </a>
        </p>
    </div>
</div>
@else
<div class="row" data-name="uhFYxSPT">
    <div class="col-md-12" data-name="BIxOVdSV">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="FMsEvEwu">
            <div class="kt-portlet__body" data-name="uJEXGYQl">
                <div class="table-toolbar" data-name="TzHVNfNG">
                    <div class="form-group row" data-name="mCSYtBtb">
                        <div class="col-md-6" data-name="MhKSQPeG">
                           @if(routeAccess('create.package.page'))
                            <div class="btn-group" data-name="GYSSAOoz">
                            <a href="{{ route('client.package.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    {{trans('common.form.buttons.add_new')}} <i class="la la-plus"></i>
                                </button></a>
                            </div>
                           @endif
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="package" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>{{trans('users.packages.table_headings.id')}}</th>
                                <th>{{trans('users.packages.table_headings.package_name')}}</th>
                                <th>{{trans('users.packages.table_headings.added_on')}}</th>
                                <th>{{trans('users.packages.table_headings.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($packages as $index => $package)
                            <tr class="gradeX odd" role="row" id="row_{{ $package->id }}">
                                <td>{{($package->id)}}</td>
                                <td>{{ ($package->package_name)}} </td>
                                <td>{{ showDateTime(Auth::user()->id, $package->created_at , 1)}} </td>
                                <td>
                                    <div class="dropdown" data-name="MecCYHSC">
                                        <a class="btn btn-label-success btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-expanded="false"><i class="flaticon-more-1"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        @if(routeAccess('client.package.edit'))
                                            <li>
                                                <a href="{{ route('client.package.edit', $package->id) }}"> <i class="fa fa-edit icon-size"></i>{{trans('common.form.buttons.edit')}}</a>
                                            </li>
                                        @endif
                                        @if(routeAccess(246))
                                            <li>
                                                <a href="javascript:;" onclick="packageDelete( {{ $package->id }} )" id='role-delete'> <i class="fa fa-remove icon-size"></i>{{trans('common.form.buttons.delete')}} </a>
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
@endif
@endsection