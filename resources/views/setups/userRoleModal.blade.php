<div class="modal-header" data-name="zPnvvbZO">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('settings.api.step2.form.create_save')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="createRole"  class="kt-form kt-form--label-right">
            <input type="hidden" id="role_id" name="role_id" value="{{isset($role)?$role->id:0}}">
            <input type="hidden" id="token_id" name="token_id" value="{{isset($token)?$token->id:0}}">
            <input type="hidden" id="status" name="status" value="{{isset($token) ? $token->status:1}}">
            	<div class="modal-body" data-name="Qrgeqwbj">
	                <div class="form-group row mt2" data-name="SQjejjsN">
	                    <label class="col-form-label col-md-3">{{trans('settings.api.step2.form.token_name')}}
                            <span class="required"> * </span>
	                    </label>
	                    <div class="col-md-7" data-name="ivchqoMc">
	                        <input class="form-control" type="text" name="name" value="{{isset($role)?$role->name:''}}">
	                        <div id="name-error" class="error invalid-feedback" data-name="dAPluLIn"></div>
	                    </div>
	                </div>
	                <div class="form-group row mb1" data-name="cegXJIVA">
	                    <label class="col-form-label col-md-3">{{trans('settings.api.step1.form.description')}}
	                    </label>
	                    <div class="col-md-7" data-name="dyfPlczM">
	                        <input class="form-control" type="text" name="description" value="{{isset($role)?$role->description:''}}">
	                        <div id="description-error" class="error invalid-feedback" data-name="QRNbsjRe"></div>
	                    </div>
	                </div>
					<div class="form-group row mb1" data-name="JWLlcHFV">
						<label class="col-form-label col-md-3">{{trans('settings.api.step1.form.rate_limit')}}
						</label>
						<div class="col-md-7" data-name="IQZwosaq">
							<input class="form-control" type="number" name="rate_limit" value="{{isset($token)?$token->rate_limit:60}}">
							<small>{{trans('settings.api.step1.form.rl.help')}}</small>
							<div id="rate_limit-error" class="error invalid-feedback" data-name="kaheKjYa"></div>
						</div>
					</div>
	                
	                <div class="form-group row mb1" data-name="euThLnaV">
	                    <label class="col-form-label col-md-3">{{trans('settings.api.step1.form.allowed_ip_ddress')}}
                            <span class="required"></span>
	                    	 {!! popover('settings.api.step1.form.allowed_ip_ddress_help','common.description') !!}
	                    </label>
	                    <div class="col-md-7" data-name="kbuqzxFw">
	                        <textarea class="form-control" name="api_access_ips">{{isset($token)?str_replace(',',"\r\n",$token->auth_ips):''}}</textarea>
	                    	  @php($ip = getIp())
	                    	  @if(!is_null($ip))
	                    	  <small>{{trans('settings.api.step2.form.current_ip_address')}}: {{$ip}}</small>
	                    	  @endif
	                    	  <div id="api_access_ips-error" class="error invalid-feedback" data-name="CzRPwsTZ"></div>
	                    </div>
	                </div>
	                <div class="form-group row m0" data-name="TLpGwfrS">
	            		<div class="col-md-12 p0" data-name="mZRPtkee">
	        				<h4 class="apiacthead">{{trans('settings.api.step2.form.allowes_api_actions')}}</h4>
	        			</div>
	            		<div class="col-md-4 apiSidebar scroll scroll-365" data-name="cgeAUdBZ">
	            			<h5>{{trans('settings.api.step2.form.modules')}}</h5>
	            			<ul class="apilist">
	            			<!--  -->
	            			@foreach($api_permissions as $permission)
		    					<li><a href="javascript:;" class="listTab" rel="list_{{$permission->id}}">{{$permission->title}}</a></li>
		    				@endforeach
		    					<!--  -->
		    				</ul>
	            		</div>
		                <div class="col-md-8 apimainblk" data-name="DDmNuXDR">
		                @foreach($api_permissions as $permission) 
		                	<div class="apiFeature" id="list_{{$permission->id}}" style="{{$loop->index == 0?'display: block;':''}}" data-name="JbRxuSMa">
		                		<h5>{{$permission->title}}</h5>
		                		<div id="permissions-error" class="error invalid-feedback" data-name="xfapacUN"></div>
            					<div class="kt-checkbox-list scroll scroll-250" data-name="XVITNODa">	
	            					<ul class="apiFeaturesList">
	            					@foreach($permission->apiChildrenAll as $child)
	            						<li>
	            							<label class="kt-checkbox has-success" >
		                                        <input type="checkbox" {{isset($role_permissions) && in_array($child->id,$role_permissions)?'checked':''}} value="{{$child->id}}"  name="permissions[]" class="select_{{$permission->id}}">
		                                        {{$child->title}}
		                                        <span></span>
		                                    </label>
	            						</li>
									@endforeach
	            					</ul>
	            					<div class="addApiFooter" data-name="CULXDiIt">
	            					<input type="button" id="select_{{$permission->id}}" class="footerNav btn btn-default btn-xs select_all" value="{{trans('settings.api.step2.form.check_all')}}">
							    </div>
	            				</div>
	            				
            				</div>
       					@endforeach
		                </div>
		            </div>
            	</div>
            	<div class="modal-footer" data-name="UoZWOuPN">
	                @if(isset($role))
            		<button  class="btn btn-success save_role">@lang('common.label.update')</button>
            		@else
	                <button  class="btn btn-success save_role">@lang('settings.api.step1.form.generate')</button>
	                @endif
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('common.form.buttons.close')</button>
	            </div>
            </form>
            <script type="text/javascript">
            	$('.popovers').popover();
            </script>