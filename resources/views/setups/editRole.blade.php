<form id="EditRole"  class="kt-form kt-form--label-right">
            <input type="hidden" id="role_id" name="role_id" value="{{$role->id}}">
            	<div class="modal-body" data-name="vahcgPRz">
	                <div class="form-group row mt2" data-name="nyQLUbWr">
	                    <label class="col-form-label col-md-3">{{trans('settings.api.step2.column.role_name')}}
                            <span class="required"> * </span>
	                    </label>
	                    <div class="col-md-7" data-name="qpUUdCQA">
	                        <input class="form-control" type="text" name="name">
	                        <div id="name-error" class="error invalid-feedback" data-name="XZJXOmig"></div>
	                    </div>
	                </div>
	                <div class="form-group row mb1" data-name="nMnCKbox">
	                    <label class="col-form-label col-md-3">{{trans('settings.api.step1.form.description')}}
	                    </label>
	                    <div class="col-md-7" data-name="CTozYLgG">
	                        <input class="form-control" type="text" name="description">
	                        <div id="description-error" class="error invalid-feedback" data-name="PyHmsITJ"></div>
	                    </div>
	                </div>
	                <div class="form-group row m0" data-name="zRMuZWIo">
	            		<div class="col-md-12 p0" data-name="hIbOUVQc">
	        				<h4 class="apiacthead">{{trans('settings.api.step2.form.allowes_api_actions')}}</h4>
	        			</div>
	            		<div class="col-md-4 apiSidebar scroll scroll-365" data-name="tFLhbgkJ">
	            			<h5>{{trans('settings.api.step2.form.modules')}}</h5>
	            			<ul class="apilist">
	            			<!--  -->
	            			@foreach($api_permissions as $permission)
		    					<li><a href="javascript:;" class="listTab" rel="list_edit_{{$permission->id}}">{{$permission->title}}</a></li>
		    				@endforeach
		    					<!--  -->
		    				</ul>
	            		</div>
		                <div class="col-md-8 apimainblk" data-name="mfMaqCEb">
		                @foreach($api_permissions as $permission) 
		                	<div class="apiFeature" id="list_edit_{{$permission->id}}" style="{{$loop->index == 0?'display: block;':''}}" data-name="OvrTULDR">
		                		<h5>{{$permission->title}}</h5>
		                		<div id="permissions-error" class="error invalid-feedback" data-name="RLgfohFK"></div>
            					<div class="kt-checkbox-list scroll scroll-270" data-name="rLymEPap">	
	            					<ul class="apiFeaturesList">
	            					@foreach($permission->apiChildrenAll as $child)
	            						<li>
	            							<label class="kt-checkbox has-success" >
		                                        <input type="checkbox" {{in_array($child->id,$role_permissions)?'checked':''}} value="{{$child->id}}"  name="permissions[]" class="select_edit_{{$permission->id}}">
		                                        {{$child->title}}
		                                        <span></span>
		                                    </label>
	            						</li>
									@endforeach
	            					</ul>
	            					<div class="addApiFooter" data-name="UkBUCWPJ">
	            					<input type="button" id="select_edit_{{$permission->id}}" class="footerNav btn btn-default btn-xs select_all" value="{{trans('settings.api.step2.form.check_all')}}">
							    </div>
	            				</div>
	            				
            				</div>
       					@endforeach
		                </div>
		            </div>
            	</div>
            	<div class="modal-footer" data-name="YCMMWdsZ">
	                <button  class="btn btn-success save_role">@lang('common.form.buttons.save')</button>
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('common.form.buttons.close')</button>
	            </div>
            </form>