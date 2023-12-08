@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/staff-roll-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Staff-Management#Admin-Roles");

        // function in master2 layout
        var page_limit=show_per_page('','subUserRole_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#subUserRole').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [0,3] }
            ],
            "aaSorting": [[2, "desc"]],
            "pageLength" : page_limit,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
        page_limit=show_per_page(table,'subUserRole_pageLength');
    });

    function roleDelete(id)
    {
        if(confirm('{{trans('common.message.alert_delete')}}')) 
            {
            
                $.ajax({
                    url: "{{ url('/') }}"+'/staff/role/'+id,
                    type: "DELETE",
                    success: function(result) {
                        if(result == 'delete') {
                        	$("#row_"+id).attr("style", "display:none");
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.delete')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-success');
                        }
                        else{
                      	  $('#msg').css("display", "flex");
                          $('#msg-text').html('{{trans('response.staff_role.delete.error')}}');
                          $('#msg').removeClass('display-hide').addClass('alert alert-danger ');
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
<div class="alert alert-success" data-name="wzvubGAG">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="guZnhdjk">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="UtVUYdyP">
    <div class="col-md-12" data-name="jrimvSWJ">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="qaFkgfpR">
            <div class="kt-portlet__body" data-name="ZgzTrOyn">
                <div class="table-toolbar" data-name="tNrTwpOY">
                    <div class="form-group row" data-name="wAcvRuoP">
                        <div class="col-md-6" data-name="eNgYqDHo">
                           @if(routeAccess('staff.roles.create'))
                            <div class="btn-group" data-name="mapeIsmH">
                                <a href="{{ route('staff.roles.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="subUserRole" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>{{trans('staff.role.table_headings.id')}}</th>
                                <th>{{trans('staff.role.table_headings.name')}}</th>
                                <th>{{trans('staff.role.table_headings.added_on')}}</th>
                                <th>{{trans('staff.role.table_headings.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $index => $role)
                            <tr class="gradeX odd" role="row" id="row_{{ $role->id }}">
                                <td>{{$index + 1}}</td>
                                <td>{{ ($role->name)}} </td>
                                <td>{{ showDateTime(Auth::user()->id, $role->created_at , 1)}} </td>
                                <td>
                                @if($role->id != 1)
                                <div class="dropdown" data-name="PuqKIRYU">
                                    <a class="btn btn-label-success btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                        <i class="flaticon-more-1"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        @if(routeAccess('staff.roles.edit'))
                                        <li>  
                                            <a href="{{ route('staff.roles.edit',  $role->id) }}"> <i class="fa fa-edit  icon-size"></i>{{trans('common.form.buttons.edit')}}</a>
                                        </li>
                                        @endif
                                        @if(routeAccess('staff.roles.destroy'))
                                        <li>
                                            <a href="javascript:;" onclick="roleDelete( {{ $role->id }} )" id='role-delete'> <i class="fa fa-remove icon-size"></i>{{trans('common.form.buttons.delete')}} </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                                @else
                                    ---
                                @endif
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
@endsection