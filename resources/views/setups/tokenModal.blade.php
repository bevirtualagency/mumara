<div class="modal-header" data-name="OOjnPRYJ">
                <h5 class="modal-title" id="exampleModalLabel1">{{trans('settings.api.step1.form.generate_new')}}</h5>
            </div>
            <div class="modal-body" data-name="vIMqwjsO">
                <form action="" id="createtoken" method="post" class="kt-form kt-form--label-right">
	              <input type="hidden" name="token_id" value="{{isset($token)?$token->id:0}}">
	              <input type="hidden" id="status" name="status" value="{{isset($token) ? $token->status:1}}">
	               <div class="form-group row mt2" data-name="pjXcuPwI">
	                    <label class="col-form-label col-md-3">{{trans('settings.api.step1.form.description')}}
                            <span class="required"> * </span>
	                    </label>
	                    <div class="col-md-7" data-name="dxeOYyTF">
	                        <input class="form-control" type="text" name="description" value="{{isset($token)?$token->name:''}}">
	                        <div id="description-error" class="error invalid-feedback" data-name="VkBMfLJC"></div>
	                    </div>
	                </div>
					<div class="form-group row mt2" data-name="FusrDpvd">
						<label class="col-form-label col-md-3">{{trans('settings.api.step1.form.rate_limit')}}
						</label>
						<div class="col-md-7" data-name="hLDjhooi">
							<input class="form-control" type="number" name="rate_limit" value="{{isset($token)?$token->rate_limit:60}}">
							<small>{{trans('settings.api.step1.form.rl.help')}}</small>
							<div id="rate_limit-error" class="error invalid-feedback" data-name="YWRPyHZn"></div>
						</div>
					</div>
	                <div class="form-group row" data-name="mAILCmxU">
	                    <label class="col-form-label col-md-3">{{trans('settings.api.step1.form.api_role')}}
                            <span class="required"> * </span>
	                    </label>
	                    <div class="col-md-7" data-name="EviEicOn">
	                        <select class="form-control m-select2" name="role_id" data-placeholder="Select API Role">
	                            <option value="">{{trans('settings.api.step1.form.select_api_role')}}</option>
	                            @foreach($roles as $role)
	                            <option {{isset($token) && $token->role_id == $role->id?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
	                            @endforeach
	                        </select>
	                        <div id="role_id-error" class="error invalid-feedback" data-name="gtmwoTaZ"></div>
	                    </div>
	                </div>
			        
		           <div class="form-group row" data-name="HorrRprW">
	                    <label class="col-form-label col-md-3 switch-label">{{trans('settings.api.step1.form.allowed_ip_ddress')}}
	                    	 {!! popover('settings.api.step1.form.allowed_ip_ddress_help','common.description') !!}
	                    </label>
	                    <div class="col-md-7" data-name="rUGUdaRp">
							<span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
								<label>
									<input id="api_access_switch" type="checkbox" {{ (isset( $token->auth_ips) && !empty( $token->auth_ips)) ? 'checked':''}} name="api_access_switch">
									<span></span>
								</label>
							</span>
	                    </div>
	                </div>
	                <div class="form-group row" id="allowed_ip_addresses" style="{{ (isset( $token->auth_ips) && !empty( $token->auth_ips)) ? 'display: flex;':'display: none;'}}" data-name="yrJKdWnJ">
	                    <label class="col-form-label col-md-3"></label>
	                    <div class="col-md-7" data-name="RbtucDPg">
	                        <textarea class="form-control" id="api_access_ips" name="api_access_ips">{{isset($token->auth_ips)?str_replace(',',"\r\n", $token->auth_ips):''}}</textarea>
	                    	  <div id="api_access_ips-error" class="error invalid-feedback" data-name="ntTHgsdU"></div>
	                    </div>
	                </div>
	                <div class="form-actions" data-name="KdxTtOEu">
	                    <div class="row" data-name="ODUYGOxA">
	                        <div class="offset-md-3 col-md-7" data-name="IhQJPpVb">
	                            <button  class="btn btn-success save_token">{{isset($token) ? trans('common.form.buttons.update'):trans('settings.api.step1.form.generate')}}</button>
	                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">{{trans('common.form.buttons.cancel')}}</button>
	                        </div>
	                    </div>
	                </div>
	            </form>
            </div>

            <script type="text/javascript">
            	$('.popovers').popover();
            </script>