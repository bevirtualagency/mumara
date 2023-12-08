<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper" data-name="ubbPjSOf">
	<div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500" data-name="mSbiwaSO">

		<div class="kt-menu__loader" data-name="dwivJOXK">
			<div class="main__loader" data-name="UFJzFokw">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="main__loader" data-name="BFyniMkQ">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="main__loader" data-name="fGiPJieP">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="main__loader" data-name="xDzZJkZd">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="main__loader" data-name="klAkLveb">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="main__loader" data-name="oiakzdTQ">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="main__loader" data-name="dMhDFBxu">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="main__loader" data-name="BMfDrWVP">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="loader__title" data-name="NSlFEfck">
				<span class="load_title_text"></span>
			</div>
			<div class="main__loader" data-name="pHxiFMVM">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="main__loader" data-name="TLwFVgUi">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
			<div class="main__loader" data-name="ZmIrrKqj">
				<span class="load_main_circle"></span>
				<span class="load_main_text"></span>
			</div>
		</div>
		
		<ul class="kt-menu__nav">

			<li class="kt-menu__item {{ Request::is('/') || Request::is('dashboard') ? 'kt-menu__item--active kt-menu__item--open' : '' }}" aria-haspopup="true">
				<a href="{{ url('dashboard') }}" class="kt-menu__link">
					<span class="kt-menu__link-icon">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
								<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero"></path>
								<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3"></path>
							</g>
						</svg>
					</span>
					<span class="kt-menu__link-text">{{trans('dashboard.page.title')}}</span>
				</a>
			</li>

			{!! sideMenu(1) !!}
			{!! hook_get_output('PrimaryMenu',$vars); !!}
			@if(auth()->user()->role_id==1)
                            @php
                            $menu= modulesMenu();
                            @endphp
                            @if($menu)
                                <li id="addons_parent" class="parent-class kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                   <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                                      <span class="kt-menu__link-icon">
                                         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                               <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                               <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" id="Combined-Shape" fill="#000000"></path>
                                               <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                            </g>
                                         </svg>
                                      </span>
                                      <span class="kt-menu__link-text">@lang('addons.page.title')</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
                                   </a>
                                   <div class="kt-menu__submenu" data-name="liqsHibl">
                                      <span class="kt-menu__arrow"></span>
                                      <ul class="kt-menu__subnav">
                                        <!-- All addons menu -->
                                        {!!  $menu !!} 
                                      </ul>
                                   </div>
                                </li>
                            @endif
			@endif

		</ul>

		<style type="text/css">

				#addons_parent .kt-svg-icon, #addons_parent i {
				    margin: 0 0 0 0 !important;
				    vertical-align: middle;
				    text-align: left;
				    -webkit-box-flex: 0;
				    -ms-flex: 0 0 20px;
				    flex: 0 0 20px;
				    display: flex;
				    -webkit-box-align: center;
				    -ms-flex-align: center;
				    align-items: center;
				    line-height: 0;
				}
			</style>
			
		@if(!empty($common_data['license_attributes']) && (!empty(Auth::user()->id) && !isClient(Auth::user())))
			<div class="heading" data-name="biDAlXVV">
				<h3 class="uppercase">@lang('common.label.System_Information')</h3>

				@if(isset($common_data['license_attributes']->registeredname) && !empty($common_data['license_attributes']->registeredname))
					<div class="license_attributes" data-name="sxsZRvFp">
						<small>@lang('common.label.Registered_To')</small><br>
						<i class="fa fa-thumbs-up">
						</i> {{$common_data['license_attributes']->registeredname}}
					</div>
				@endif

				@if(isset($common_data['license_attributes']->productname) && !empty($common_data['license_attributes']->productname))
					<div class="license_attributes" data-name="uswZkoDt">
						<small>@lang('common.label.package')</small><br>
						<i class="fa fa-bookmark"></i>
						{{$common_data['license_attributes']->productname}}
					</div>
				@endif

				@if(isset($common_data['license_attributes']->regdate) && !empty($common_data['license_attributes']->regdate))
					<div class="license_attributes" data-name="vQskDLlR">
						<small>@lang('common.label.registered')</small><br>
						<i class="fa fa-calendar-alt"></i> {{ Carbon\Carbon::parse($common_data['license_attributes']->regdate)->format('Y-m-d') }}
					</div>
				@endif

				@if(isset($common_data['license_attributes']->billingcycle) && !empty($common_data['license_attributes']->billingcycle))
					<div class="license_attributes" data-name="ZTuKgDxj">
						<small>@lang('common.label.Billing_Cycle')</small><br>
						<i class="fab fa-wpforms"></i> 
						{{$common_data['license_attributes']->billingcycle}}
					</div>
				@endif

				@if(isset($common_data['license_attributes']->nextduedate) && $common_data['license_attributes']->nextduedate == "0000-00-00")
					@if($common_data['license_attributes']->nextduedate != "0000-00-00")
						<div class="license_attributes" data-name="ApKCiqCz">
							<small>@lang('common.label.Billing_Cycle')</small><br>
							<i class="fa fa-ban"></i> {{ Carbon\Carbon::parse($common_data['license_attributes']->nextduedate)->addDays(15)->format('Y-m-d') }}
						</div>
					@endif
				@else
					@if(isset($common_data['license_attributes']->nextduedate))
						<div class="license_attributes" data-name="FeGnirFV">
							<small>@lang('common.label.expires')</small><br>
							<i class="fa fa-ban"></i> {{ Carbon\Carbon::parse($common_data['license_attributes']->nextduedate)->format('Y-m-d') }}
						</div>
					@endif
				@endif
			</div>
		@else
			<div class="heading" data-name="BaTjBRnh">

				<h3 class="uppercase">@lang('common.label.System_Information')</h3>

				<div class="license_attributes" data-name="pYRhTwZX">
					<small>@lang('common.label.name')</small><br>
					<i class="fa fa-thumbs-up"></i> {{ !empty(Auth::user()->name) ?  Auth::user()->name : '' }}
				</div>
				@if(!empty($package->package_name))
				<div class="license_attributes" data-name="vJJRSoyl">
					<small>@lang('common.label.plan')</small><br>
					<i class="fa fa-bookmark"></i> {{$package->package_name}}
				</div>
				@endif

				<?php
					
					$todays_limit = "&#8734;";
					$sent_today = "&#8734;";
					$monthly_limit = "&#8734;";
					$sent_this_month  = "&#8734;";
					$trans_daily_limit  = "&#8734;";
					$trans_monthly_limit  = "&#8734;";
					$credits = "No Credits";
					$trans_credits = "No Credits";

					
					if(!empty($user_emails_limits)) {  
						if(!empty($package) and ($package->daily_email_limit != NULL or $package->daily_email_limit != null)) $todays_limit = $package->daily_email_limit;
						if($user_emails_limits->daily_limit != NULL or $user_emails_limits->daily_limit != null) $todays_limit = $user_emails_limits->daily_limit;	
						if(!empty($package) and ($package->monthly_email_limit != NULL or $package->monthly_email_limit != null)) $monthly_limit = $package->monthly_email_limit;
						if($user_emails_limits->monthly_limit != NULL or $user_emails_limits->monthly_limit != null) $monthly_limit = $user_emails_limits->monthly_limit;	
						$sent_this_month = $user_emails_limits->sent_this_month;	
						$sent_today = $user_emails_limits->sent_today;	
						if($user_emails_limits->credits != NULL or $user_emails_limits->credits != null) $credits = $user_emails_limits->credits;	
					} else { 
						if(!empty($package) and ($package->daily_email_limit != NULL or $package->daily_email_limit != null)) $todays_limit = $package->daily_email_limit;
						if(!empty($package) and ($package->monthly_email_limit != NULL or $package->monthly_email_limit != null)) $monthly_limit = $package->monthly_email_limit;
						
					}

					if($todays_limit == -1) $todays_limit = "&#8734;";
					if($monthly_limit == -1) $monthly_limit = "&#8734;";

				
					$license_attributes = json_decode(getSetting("license_attributes"), true);
					$license_type = "";
					if(!empty($license_attributes["package"])) { 
						$license_type = $license_attributes["package"];
					}

					try { 
						if($license_type == "Commercial ESP") { 
							if(!empty($user_emails_limits)) {
								if($user_emails_limits->trans_daily_limit > 0) { 
									$trans_daily_limit = $user_emails_limits->trans_daily_limit;	
								} else { 
									if(!empty($package) and ($package->trans_daily_limit != NULL or $package->trans_daily_limit != null)) $trans_daily_limit = $package->trans_daily_limit;
									if($trans_daily_limit == -1) $trans_daily_limit = "&#8734;"; 
								}
								if($user_emails_limits->trans_monthly_limit > 0) { 
									$trans_monthly_limit = $user_emails_limits->trans_monthly_limit;	
								} else { 
									if(!empty($package) and ($package->trans_monthly_limit != NULL or $package->trans_monthly_limit != null)) $trans_monthly_limit = $package->trans_monthly_limit;
									if($trans_monthly_limit == -1) $trans_monthly_limit = "&#8734;";
								}
								$trans_credits = $user_emails_limits->trans_credits;
								$trans_sent_today = $user_emails_limits->trans_sent_today;	
								$trans_sent_this_month = $user_emails_limits->trans_sent_this_month;	
							} else { 
								if(!empty($package) and ($package->trans_daily_limit != NULL or $package->trans_daily_limit != null)) $trans_daily_limit = $package->trans_daily_limit;
								if(!empty($package) and ($package->trans_monthly_limit != NULL or $package->trans_monthly_limit != null)) $trans_monthly_limit = $package->trans_monthly_limit;
							}
							
						}
					} catch(\Exception $e) {
						$trans_sent_today = 0;	
						$trans_sent_this_month = 0;	
					}
					

				?>
			
				<div class="license_attributes" data-name="PQNaPLZT">
					<small>{{trans('sending_nodes.include_side_menu_blade.email_limit_small')}}</small><br>
						<i class="fa fa-bookmark"></i> {!!$sent_today!!} / {!!$todays_limit!!}
				</div>
				@if($license_type == "Commercial ESP")
				<div class="license_attributes" data-name="PQNaPLZT">
					<small>{{trans('sending_nodes.include_side_menu_blade.transactional_limit_small')}}</small><br>
						<i class="fa fa-bookmark"></i> {!!$trans_sent_today!!} / {!!$trans_daily_limit!!}
				</div>
				@endif
				<div class="license_attributes" data-name="Lotzotyh">
					<small>{{trans('sending_nodes.include_side_menu_blade.email_limit__month_small')}}</small><br>
						<i class="fa fa-bookmark"></i> {!!$sent_this_month!!} / {!!$monthly_limit!!}
					
				</div>

				@if($license_type == "Commercial ESP")
				<div class="license_attributes" data-name="PQNaPLZT">
					<small>{{trans('sending_nodes.include_side_menu_blade.transactional_limit_month_small')}}</small><br>
						<i class="fa fa-bookmark"></i> {!!$trans_sent_this_month!!} / {!!$trans_monthly_limit!!}
				</div>
				@endif

				
				@if($license_type == "Commercial ESP")

				

				
				@if(!empty($package) and $package->credits_enabled)

				<div class="license_attributes" data-name="sFiTWOgy">
					<small>{{trans('sending_nodes.include_side_menu_blade.email_credits_small')}}</small><br>
					<i class="fa fa-bookmark"></i> {!!$credits!!}
				</div>

				<div class="license_attributes" data-name="Lotzotyh">
					<small>{{trans('sending_nodes.include_side_menu_blade.email_transactional_small')}}</small><br>
						<i class="fa fa-bookmark"></i> {{$trans_credits}}
				</div>

				
				@endif

				<div class="license_attributes" data-name="tQOnLPzz">
					<small>{{trans('sending_nodes.include_side_menu_blade.renewal_date_small')}}</small><br>
					@if(gmdate("d",strtotime(Auth::user()->created_at)) >= date("d"))
					<i class="fa fa-bookmark"></i> {{gmdate("M")}} {{gmdate("d" , strtotime(Auth::user()->created_at))}}, {{gmdate("Y")}}
					@else 
					<i class="fa fa-bookmark"></i> {{gmdate("M" , strtotime("+1 month"))}} {{gmdate("d" , strtotime(Auth::user()->created_at))}}, {{gmdate("Y")}}
					@endif
				</div>

				@endif
			
				<div class="license_attributes" data-name="YxtSOxzC">
					<small>@lang('common.label.status')</small><br>
					<i class="fa fa-bookmark"></i> @lang('common.label.active')
				</div>

			</div>
		@endif

	</div>
</div>