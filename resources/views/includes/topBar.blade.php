@if(config('app.type') == 'demo')
<div class="banner-root" data-name="SHMNqnFo">
    <style>
        .headerstrip {
          height: 50px;
          position: relative;
          font-family: -apple-system, BlinkMacSystemFont, “Segoe UI”, Roboto, Oxygen-Sans, Ubuntu, Cantarell, “Helvetica Neue”,sans-serif;
          font-size: 14px;
        }
        .headerstrip .headerstrip-content-background {
            background-color: #fff;
            opacity: 1;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #f9a650;
            background: -webkit-linear-gradient(left, #f9a650, #d47819);
            background: linear-gradient(to right, #f9a650, #d47819);
            background-repeat: repeat-x;
        }
        .headerstrip .headerstrip-canvas {
          height: 50px;
          margin: auto auto;
        }
        .headerstrip .headerstrip-content {
          display: flex;
          align-items: center;
          justify-content: center;
          background-size: contain;
          background-repeat: no-repeat;
          background-size: 1000px 50px;
          width: 100%;
          height: 50px;
          max-width: 1408px;
          padding-left: 16px;
          padding-right: 16px;
          margin: 0 auto;
        }
        .headerstrip .headerstrip-text {
          color: white;
          text-decoration: none;
          padding-right: 24px;
          font-weight: 200;
          letter-spacing: 0.8px;
          position: relative;
          font-size: 16px;
          font-weight: 400;
        }
        .headerstrip .headerstrip-text strong {
          font-weight: 600;
        }
        .headerstrip .headerstrip-cta:hover {
            color: #000;
        }
        .headerstrip .headerstrip-cta-container {
          display: flex;
        }
        .headerstrip .headerstrip-cta {
          position: relative;
          background-color: #FFFFFF;
          padding: 5px 30px;
          color: #f9a650;
          font-weight: 600;
          border-radius: 4px;
          text-decoration: none;
          display: block;
          text-align: center;
          min-width: 100px;
        }
        .headerstrip .headerstrip-cta-mobile {
          color: #FFFFFF;
          text-decoration: underline;
          padding-left: 5px;
        }
        .headerstrip .headerstrip-cta-mobile:hover {
          color: #FFFFFF;
        }
        .headerstrip .headerstrip__banner-dismiss {
          width: 12px;
          background: none;
          border: none;
          padding: 0;
          font: inherit;
          cursor: pointer;
          outline: inherit;
          margin-left: 24px;
          opacity: 0.4;
          color: white;
          text-decoration: none;
          -webkit-transition: all 100ms ease;
          -moz-transition: all 100ms ease;
          -o-transition: all 100ms ease;
          transition: all 100ms ease;
        }
        .headerstrip .headerstrip__banner-dismiss:hover {
          -webkit-transform: scale(1.3);
          transform: scale(1.3);
        }
        .headerstrip .is-hidden-desktop .headerstrip-content {
          text-align: center;
        }
        .headerstrip .is-hidden-desktop .headerstrip-text {
          position: relative;
          padding-right: 24px;
        }
        .headerstrip .is-hidden-desktop .headerstrip__banner-dismiss {
          margin-left: 0;
        }
        .headerstrip .headerstrip__dismiss-icon {
          width: 12px;
          height: 12px;
          fill: #FFFFFF;
          display: inline-block;
        }
        .page-header.navbar .top-menu .navbar-nav>li.dropdown.dropdown-notification ul.dropdown-menu.dropdown-menu-default {
            /*max-height: 250px !important;
            overflow-y: auto !important;*/
        }
        @media (max-width: 1024px) {
          .headerstrip .is-hidden-tablet-and-below {
            display: none !important;
          }
        }
        @media (min-width: 1025px) {
          .headerstrip .is-hidden-desktop {
            display: none !important
          }
        }
    </style>


    <div class="banner-container" data-name="LolFesBY">
        <div class="headerstrip" data-name="OOKITVbe">
            <div class="headerstrip-content-background" data-name="KWvbEvau"></div>
            <div class="headerstrip-canvas is-hidden-desktop" data-name="kctqwyrM">
                <div class="headerstrip-content" data-name="CSueVhPs">
                  <div class="headerstrip-text" data-name="kNSdCQEh">
                    {{trans('common.label.demo_version')}}
                    <a class="js-banner__link headerstrip-cta-mobile" href="https://www.mumara.com/campaigns/pricing/" target="_blank">
                        {{trans('common.label.buy_now')}}
                    </a>
                  </div>
                </div>
            </div>
            <div class="headerstrip-canvas is-hidden-tablet-and-below" data-name="KlvfuBhQ">
                <div class="headerstrip-content" data-name="oGRYyiaG">
                  <div class="headerstrip-text" data-name="cVNFbweO">{{trans('common.label.demo_version')}}</div>
                  <a class="js-banner__link headerstrip-cta" href="https://www.mumara.com/campaigns/pricing/" target="_blank">
                      {{trans('common.label.buy_now')}}
                  </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div id="kt_header" class="kt-header kt-grid__item" data-name="TMgIPyCt">

						<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>

						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper" data-name="CeKgSlpI">
							
						</div>

						<div class="kt-header__topbar" data-name="jKsFzzNh">

							<!--begin: Timezone -->
							<div class="kt-header__topbar-item kt-header__topbar-item--time" id="timeblock" data-name="FhOuhCOV">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" data-name="HkKZqHQK">
									<span class="kt-header__topbar-icon kt-pulse kt-pulse--time">
										@if(isset($timezone))

							<?php 
								$time_zone_user_data = DB::table('users')->where('id', Auth::user()->id)->value('timezone');
								if(empty($time_zone_user_data)) $time_zone_user_data = "UTC";
								$local_tz = new DateTimeZone($time_zone_user_data);
								$local = new DateTime('now', $local_tz);
							
								//NY is 3 hours ahead, so it is 2am, 02:00
								$user_tz = new DateTimeZone('UTC');
								$user = new DateTime('now', $user_tz);
								
								$local_offset = $local->getOffset();
								$user_offset = $user->getOffset();
							
								$diff = $local_offset - $user_offset  ;
								$hours = floor($diff / 3600);
								$minutes = floor(($diff / 60) % 60);
							?>

								<div style="display: none;" data-name="gMEMXKXI">
									<span id="server-time-hour">{{isset($hours) ? $hours : ''}}</span>
									<span id="server-time-minutes">{{isset($minutes) ? $minutes : ''}}</span>
								</div>
						        @endif
						        <div class="ctime" data-name="RtWLukhf">
					                <div class="clock" data-name="rncvzhrh">
					                <div id="header_time" data-name="MArhHohV"></div>
					                </div>
					            </div>
									</span>
								</div>
							</div>
							<!--end: Timezone -->
							<!-- <div class="kt-header__topbar-item" id="notifications_div"></div> HTML placed in resources\views\includes\topBarNotifications.blade.php -->
					        <!--end: Notifications -->
							 
							<!--begin: Notifications -->
							{{--
							@php
			                    $count_imports = \App\Lists::where('import_status', 1)->where('user_id',Auth::id())->count();
			                    $lists_import = \App\Lists::where('import_status', 1)->where('user_id',Auth::id())->get();
			                @endphp
			                @if($count_imports >= 1)
								<div class="kt-header__topbar-item kt-header__topbar-item--links kt-hidden" data-name="zsVtOkNj">
									<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" data-name="UjIkmdor">
										<span class="kt-header__topbar-icon">
											@if($count_imports >= 1)
												<span class="kt-badge">{{ $count_imports }}</span>
											@endif
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
											        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
											        <path d="M8.95128003,13.8153448 L10.9077535,13.8153448 L10.9077535,15.8230161 C10.9077535,16.0991584 11.1316112,16.3230161 11.4077535,16.3230161 L12.4310522,16.3230161 C12.7071946,16.3230161 12.9310522,16.0991584 12.9310522,15.8230161 L12.9310522,13.8153448 L14.8875257,13.8153448 C15.1636681,13.8153448 15.3875257,13.5914871 15.3875257,13.3153448 C15.3875257,13.1970331 15.345572,13.0825545 15.2691225,12.9922598 L12.3009997,9.48659872 C12.1225648,9.27584861 11.8070681,9.24965194 11.596318,9.42808682 C11.5752308,9.44594059 11.5556598,9.46551156 11.5378061,9.48659872 L8.56968321,12.9922598 C8.39124833,13.2030099 8.417445,13.5185067 8.62819511,13.6969416 C8.71848979,13.773391 8.8329684,13.8153448 8.95128003,13.8153448 Z" id="Shape" fill="#000000"/>
											    </g>
											</svg>
										</span>
									</div>
									<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround" data-name="tIelaBku">
										<ul class="kt-nav kt-margin-t-10 kt-margin-b-10 scroll scroll-250">
											@foreach($lists_import as $list)
											<li class="kt-nav__item">
												<a href="javascript:;" onClick="changeImportStatus({{ $list->id }})" class="kt-nav__link">
													<span class="kt-nav__link-text"> {{ $list->name }} </span>
													@if($list->import_status == 1)
					                                   <span class="kt-nav__link-icon">
					                                   		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
															    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
															        <path d="M5.74714567,13.0425758 C4.09410362,11.9740356 3,10.1147886 3,8 C3,4.6862915 5.6862915,2 9,2 C11.7957591,2 14.1449096,3.91215918 14.8109738,6.5 L17.25,6.5 C19.3210678,6.5 21,8.17893219 21,10.25 C21,12.3210678 19.3210678,14 17.25,14 L8.25,14 C7.28817895,14 6.41093178,13.6378962 5.74714567,13.0425758 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
															        <path d="M11.1288761,15.7336977 L11.1288761,17.6901712 L9.12120481,17.6901712 C8.84506244,17.6901712 8.62120481,17.9140288 8.62120481,18.1901712 L8.62120481,19.2134699 C8.62120481,19.4896123 8.84506244,19.7134699 9.12120481,19.7134699 L11.1288761,19.7134699 L11.1288761,21.6699434 C11.1288761,21.9460858 11.3527337,22.1699434 11.6288761,22.1699434 C11.7471877,22.1699434 11.8616664,22.1279896 11.951961,22.0515402 L15.4576222,19.0834174 C15.6683723,18.9049825 15.6945689,18.5894857 15.5161341,18.3787356 C15.4982803,18.3576485 15.4787093,18.3380775 15.4576222,18.3202237 L11.951961,15.3521009 C11.7412109,15.173666 11.4257142,15.1998627 11.2472793,15.4106128 C11.1708299,15.5009075 11.1288761,15.6153861 11.1288761,15.7336977 Z" id="Shape" fill="#000000" fill-rule="nonzero" transform="translate(11.959697, 18.661508) rotate(-90.000000) translate(-11.959697, -18.661508) "/>
															    </g>
															</svg>
					                                   </span>
					                                @endif												
												</a>
											</li>
											@endforeach
										</ul>
										<a href="javascript:;" onclick="clearAllImports();" class="kt-nav__link trash-records"><span class="kt-nav__link-text"> @lang('dashboard.topbar.trash_all_records') </span></a>
									</div>
								</div>
							@endif
							--}}
							<!--end: Notifications -->

							<!--begin: Notifications -->
							@php
								$authUser = getAuthUser();
								$client = isClient($authUser);
								if(!$client)
								     $lists_ = \App\Lists::join('users as usr','usr.id','lists.user_id')->where('usr.is_client',0)->where('lists.export_status', 1);
								    else
							    $lists_ = \App\Lists::where('lists.export_status', 1)->where('lists.user_id',$authUser->id);
								    $count_lists = $lists_->count();
			                    $lists = $lists_->orderBy("lists.updated_at" , "DESC")->select('lists.*')->get();

			                    $count_download = $lists_
			                    ->where('lists.download_status', 0)
			                    ->count();
								
							
			                @endphp
			                @if($count_lists >= 1)

<!--							<div class="kt-header__topbar-item dropdown top-all-issues new-notifications" id="download-portion" data-name="bugJXXXa">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="HDAxglXB"> 
									<span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
										<span class="new-notif"></span>
										@if($count_download >= 1)
											<span class="kt-badge kt-hide">{{ $count_download }}</span>
											<span class="new-notif"></span>
										@endif
										<i class="la la-cloud-download font-25"></i>
									</span> 
								</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg" data-name="hWpeJMkq" >
								<form>
								<div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="WRHCPgXG">
									<h3 class="kt-head__title">
										@lang('dashboard.topbar.download_exported_files')
										<span class="kt-badge">{{ $count_download }}</span>
									</h3>
								</div>

										<div class="tab-content" data-name="AbCMkArY">
											<div class="tab-pane active show" id="list-tab" role="tabpanel" data-name="goeXeqsZ">
										        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-250" data-name="GGlVByDW">
										        	@foreach($lists as $list)
										            <a href="{{ route('list.export.download.csv', ['id' => $list->id]) }}"  class="kt-notification__item">
										                <div class="kt-notification__item-icon" data-name="PvmfEHFg">
										                    <i class="la la-cloud-download"></i>
										                </div>
										                <div class="kt-notification__item-details" data-name="pslYJquJ">
										                    <div class="kt-notification__item-title" data-name="uLigYXbq">
										                        {{ $list->name }}
										                    </div>
										                    <div class="kt-notification__item-time" data-name="PCfMuCsO">
										                       <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($list->updated_at))->diffForHumans(); ?>
										                    </div>
										                </div>
										            </a>
										            @endforeach
										        </div>
										    </div>
										    
										</div>
										<div class="bottom-bar" data-name="xAplLRMx">
						                    <a href="javascript:;" onclick="clearAllExports();" class="text-danger icon-close pull-left">@lang('dashboard.topbar.trash_all_records')</a>
						                    <a href="javascript:;" class="btn btn-label-info icon-close pull-right">@lang('common.form.buttons.close')</a>
						                </div>
							</form>
									</div>
								</div>-->
							@endif
							<!--end: Notifications -->
							@if(getSetting("help_icon_switch") == "on")
							<!--begin: Notifications -->
							<div class="kt-header__topbar-item kt-header__topbar-item--links" id="help_icon_header" data-name="dSGPqsvx">
							
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" data-name="YoehrifR">
									<span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
										<i class="la la-question-circle"></i>
									</span>
								</div>
							
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround" data-name="viOIxAzL">
									<ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
										<li class="kt-nav__item">
											<a href="https://docs.mumara.com" class="kt-nav__link" target="_blank">
												<span class="kt-nav__link-icon">
													<i class="la la-book"></i></span>
												<span class="kt-nav__link-text"> {{trans('dashboard.topbar.knowledgebase')}} </span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="https://community.mumara.com/" target="_blank" class="kt-nav__link">
												<span class="kt-nav__link-icon">
													<i class="la la-comments"></i>
												</span>
												<span class="kt-nav__link-text">{{trans('dashboard.topbar.community_support')}}</span>
											</a>
										</li>
										<!-- <li class="kt-nav__item">
											<a href="https://billing.mumara.com/submitticket.php" target="_blank" class="kt-nav__link">
												<span class="kt-nav__link-icon">
													<i class="la la-envelope"></i>
												</span>
												<span class="kt-nav__link-text">{{trans('dashboard.topbar.headings.ticket')}}</span>
											</a>
										</li> -->
										<li class="kt-nav__item">
											<a href="https://community.mumara.com/forums/feature-request.14/" class="kt-nav__link">
												<span class="kt-nav__link-icon">
													<i class="la la-edit"></i>
												</span>
												<span class="kt-nav__link-text">{{trans('dashboard.topbar.feature_request')}}</span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="https://community.mumara.com/forums/bug-reporting.15/" class="kt-nav__link">
												<span class="kt-nav__link-icon">
													<i class="la la-pencil"></i>
												</span>
												<span class="kt-nav__link-text">{{trans('dashboard.topbar.bug_report')}}</span>
											</a>
										</li>
									</ul>
								</div>
								
							</div>
							@endif
							<!--end: Notifications -->
                                                        <?php
                                                        
                                                        $resultExportedFiles = \App\ExportedFiles::where('status',1);
                                                        $client = isClient($authUser);
                                                       /// if($client){
                                                          $resultExportedFiles->where('user_id',$authUser->id); 
                                                       // }
                                                       
                                                        $countFiles =$resultExportedFiles->count();
                                                        $exportedFilesArray = array();
                                                        if($countFiles > 0){
                                                            $exportedFilesArray = $resultExportedFiles->orderBy('created_at',"DESC")->get()->toArray();                                                       
                                                            
                                                        ?>
                                                        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" id="download-portion" data-name="bugJXXXa">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="HDAxglXB"> 
									<span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
										<span class="kt-badge">{{ $countFiles }}</span>
										@if($countFiles >= 1)
											<span class="kt-badge kt-hide">{{ $countFiles }}</span>
											
										@endif
										<i class="la la-cloud-download font-25"></i>
									</span> 
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg download-export" data-name="hWpeJMkq" >
								<form>
								<div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="WRHCPgXG">
									<h3 class="kt-head__title">
										@lang('dashboard.topbar.download_exported_files')
										&nbsp&nbsp<span class="kt-badge">{{ $countFiles }}</span>
									</h3>
                                                                    </div>

										<div class="tab-content" data-name="AbCMkArY">
											<div class="tab-pane active show" id="list-tab" role="tabpanel" data-name="goeXeqsZ">
										        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll scroll-200" data-name="GGlVByDW">
										        	@foreach($exportedFilesArray as $exportedFilesRow)
													@php
													////$date = showDateTime(getAuthUser(), $exportedFilesRow['updated_at'] , 1);
													@endphp
														<?php
														$file_path = config('mumara.export_path.lists') . $exportedFilesRow['user_id'] . "/files/exports/" . $exportedFilesRow['file_path'];
														if(file_exists($file_path)){
															//
															$download_name = str_replace("_", " ",$exportedFilesRow['download_name'] );
															// $download_name = preg_replace('/[0-9]+/', '', $download_name);
															//$download_name = str_replace('-', '', $download_name);
															$download_name = $exportedFilesRow['download_name'];
															$download_name = str_replace("_", " ",$exportedFilesRow['download_name'] );
														?>        
										                 <div  class="kt-notification__item">
										                <div class="kt-notification__item-icon" data-name="PvmfEHFg">
										                    
																@if($exportedFilesRow['type']==2)
																<a class="popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="@if($exportedFilesRow['type']==2) {{ trans('tools.exported_files.download_list') }} @elseif($exportedFilesRow['type']==3) {{ trans('tools.exported_files.download_segment') }} @elseif($exportedFilesRow['type']==0) @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp {{ trans('tools.exported_files.download_suprresed_email') }} @elseif($exportedFilesRow['type']==4) {{ trans('tools.exported_files.download_logs') }} @else {{ trans('tools.exported_files.download_suprresed_domain') }} @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp @endif "  href="{{ route('list.export.download.csv', ['id' => $exportedFilesRow['module_id']]) }}">
																<i class="la la-cloud-download font-25" aria-hidden="true"></i>
																@elseif($exportedFilesRow['type']==3)
																<a class="popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="@if($exportedFilesRow['type']==2) {{ trans('tools.exported_files.download_list') }} @elseif($exportedFilesRow['type']==3) {{ trans('tools.exported_files.download_segment') }} @elseif($exportedFilesRow['type']==0) @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp {{ trans('tools.exported_files.download_suprresed_email') }} @elseif($exportedFilesRow['type']==4) {{ trans('tools.exported_files.download_logs') }} @else {{ trans('tools.exported_files.download_suprresed_domain') }} @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp @endif "  href="{{ route('export.segment.csv.download', ['id' => $exportedFilesRow['module_id']]) }}">
																<i class="la la-cloud-download font-25" aria-hidden="true"></i>
																@elseif($exportedFilesRow['type']==0)
																<a class="popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="@if($exportedFilesRow['type']==2) {{ trans('tools.exported_files.download_list') }} @elseif($exportedFilesRow['type']==3) {{ trans('tools.exported_files.download_segment') }} @elseif($exportedFilesRow['type']==0) @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp {{ trans('tools.exported_files.download_suprresed_email') }} @elseif($exportedFilesRow['type']==4) {{ trans('tools.exported_files.download_logs') }} @else {{ trans('tools.exported_files.download_suprresed_domain') }} @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp @endif "  href="{{ route('suppression.export.download.csv', ['id' => $exportedFilesRow['id']]) }}">
																<i class="la la-cloud-download font-25" aria-hidden="true"></i>
																@elseif($exportedFilesRow['type']==1)
																<a class="popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="@if($exportedFilesRow['type']==2) {{ trans('tools.exported_files.download_list') }} @elseif($exportedFilesRow['type']==3) {{ trans('tools.exported_files.download_segment') }} @elseif($exportedFilesRow['type']==0) @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp {{ trans('tools.exported_files.download_suprresed_email') }} @elseif($exportedFilesRow['type']==4) {{ trans('tools.exported_files.download_logs') }} @else {{ trans('tools.exported_files.download_suprresed_domain') }} @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp @endif "  href="{{ route('suppression.export.download.csv', ['id' => $exportedFilesRow['id']]) }}">
																<i class="la la-cloud-download font-25" aria-hidden="true"></i>
																@else
																<a class="popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="@if($exportedFilesRow['type']==2) {{ trans('tools.exported_files.download_list') }} @elseif($exportedFilesRow['type']==3) {{ trans('tools.exported_files.download_segment') }} @elseif($exportedFilesRow['type']==0) @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp {{ trans('tools.exported_files.download_suprresed_email') }} @elseif($exportedFilesRow['type']==4) {{ trans('tools.exported_files.download_logs') }} @else {{ trans('tools.exported_files.download_suprresed_domain') }} @php $exportedFilesRow['download_name'] = str_replace('_',' ',$exportedFilesRow['download_name']); @endphp @endif "  href="{{ route('suppression.export.download.csv', ['id' => $exportedFilesRow['id']]) }}">
																<i class="la la-cloud-download font-25"></i>
																@endif
                                                            </a>
										                </div>
										                <div class="kt-notification__item-details" data-name="pslYJquJ">
										                    <div class="kt-notification__item-title" data-name="uLigYXbq">
                                                                                                        
										                        {{ substr(str_replace(".csv", "", $download_name),0, 36) }}@if(strlen($download_name)>36) ...  @endif
										                    </div>
										                    <div class="kt-notification__item-time" data-name="PCfMuCsO">
										                       <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($exportedFilesRow['updated_at']))->diffForHumans(); ?>
										                    </div>
															
															@if($exportedFilesRow['type']==2)
															<a id="download_" class="kt-links" href="{{ route('list.export.download.csv', ['id' => $exportedFilesRow['module_id']]) }}">{{trans('sending_nodes.include_topbar_blade.action_download_file')}} </a>
															@elseif($exportedFilesRow['type']==3)
															<a id="download_" class="kt-links" href="{{ route('export.segment.csv.download', ['id' => $exportedFilesRow['module_id']]) }}">{{trans('sending_nodes.include_topbar_blade.action_download_file')}}</a>
															@elseif($exportedFilesRow['type']==0)
															<a id="download_" class="kt-links" href="{{ route('suppression.export.download.csv', ['id' => $exportedFilesRow['id']]) }}">{{trans('sending_nodes.include_topbar_blade.action_download_file')}}</a>
															@elseif($exportedFilesRow['type']==1)
															<a id="download_" class="kt-links" href="{{ route('suppression.export.download.csv', ['id' => $exportedFilesRow['id']]) }}">{{trans('sending_nodes.include_topbar_blade.action_download_file')}}</a>
															@else
															<a id="download_" class="kt-links" href="{{ route('suppression.export.download.csv', ['id' => $exportedFilesRow['id']]) }}">{{trans('sending_nodes.include_topbar_blade.action_download_file')}}</a>
															@endif

										                </div>
										            </div>
													<?php
													}
													?>        
										            @endforeach
										        </div>
										    </div>
										    <!-- <div class="tab-pane" id="segment-tab" role="tabpanel">
										        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll ps" data-scroll="true" data-height="250" data-mobile-height="200">
										            @foreach($lists as $list)
										            <a href="{{ route('list.export.download.csv', ['id' => $list->id]) }}" onClick="changeImportStatus({{ $list->id }})" class="kt-notification__item">
										                <div class="kt-notification__item-icon">
										                    <i class="la la-cloud-download"></i>
										                </div>
										                <div class="kt-notification__item-details">
										                    <div class="kt-notification__item-title">
										                        {{ $list->name }}
										                    </div>
										                    <div class="kt-notification__item-time">
										                        23 hrs ago
										                    </div>
										                </div>
										            </a>
										            @endforeach
										        </div>
										    </div> -->
										</div>
										<div class="bottom-bar" data-name="xAplLRMx">
											<div style="float: left; text-align: left; display: inline-block;">
												@if(routeAccess('exported.files')) 
											<a href="{{ route('exported.files') }}" class="text-success">@lang('dashboard.topbar.view_all')</a> 
											|
											@endif
												
											@if($countFiles > 0 && routeAccess('clear.all.exports.suppression.files'))     
											
											@if (routeAccess('delete.exported.all.file'))
											<a href="javascript:;" onclick="clearAllExportsFiles();" class="text-danger icon-close">@lang('dashboard.topbar.trash_all_records')</a>
											@endif
											@endif
											</div>  
                                                                                    
						                    <a href="javascript:;" class="btn btn-label-info icon-close pull-right">@lang('common.form.buttons.close')</a>
						                </div>
                                                                    </form>
									</div>
								</div>
                                                        
							<?php
                                                        }
                                                        ?>

						

							<!--begin: User Bar -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user" data-name="fqbOICcf">
								<?php 
								$user = Auth::user();
								
								// or however you get your user object
									$profile = url("/public/img/user.png");
									if(isset($app_settings['profile']) && !empty($app_settings["profile"])) { 
										$profile = url("storage/branding/" . $app_settings["profile"]);
									}

									//if profile image not exists then check gravator 
									$gravatarSetting=DB::table('application_settings')->where('setting_name','gravatar')->select('setting_value')->first();
									if (empty($gravatarSetting)) {
										$gravatar_update_value = 'off';
										saveSettings('gravatar', $gravatar_update_value);
									}
									else {
										$gravatar_update_value = $gravatarSetting->setting_value;
									}
									if($gravatar_update_value=='on'){
											$hashemail = md5(strtolower(trim($user->email)));
											$url = 'https://www.gravatar.com/avatar/' . $hashemail . '?d=404';

											$headers = @get_headers($url);
											if ($headers === false || !preg_match("|200|", $headers[0])) {
												// Internet is not working or Gravatar image doesn't exist
												$has_valid = FALSE;
											} else {
												// Gravatar image exists
												$has_valid = TRUE;
											}
									}


								?>
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px" data-name="qkJAkTVu">

									@if ($user->profile_img_store)
									   <img src="{{ asset('/storage/' . $user->profile_img_store) }}" id="avatar" alt="{{ isset(Auth::user()->name) ? Auth::user()->name : ''  }}" />	
									   
									 @else
										@if($gravatar_update_value=='on' && $user->profile_img_store=='' && $has_valid==1)
									   		<img  src="{{ $url }}" >
										@else
											<img src="/public/img/user.png">
										@endif
									@endif

									{{--<div class="kt-header__topbar-user" data-name="ZiqAOyju">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">{{trans('sending_nodes.include_topbar_blade.hi_txt_span')}} </span>
										<span class="kt-header__topbar-username kt-hidden-mobile">{{ isset(Auth::user()->name) ? Auth::user()->name : ''  }}</span>

										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold  text-uppercase">{{ isset(Auth::user()->name) ? substr(Auth::user()->name, 0, 1) : ''  }}</span>

									</div>--}}
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl" style="width:280px" data-name="HBvSnLVt">
									<!--begin: Head -->
									<div class="menu-content d-flex align-items-center menu-item" data-name="IeGtneIr">
										{{--<div class="kt-user-card__avatar symbol symbol-50px me-5" data-name="PAJCSeYA">
											  @if ($user->profile_img_store)
												<img src="{{ asset('/storage/' . $user->profile_img_store) }}" id="profile-image" alt="{{ isset(Auth::user()->name) ? Auth::user()->name : ''  }}" />
												@else
											<img src="/public/img/user.png"> 
										@endif
										</div>--}}
										<div class="d-flex flex-column">
											<div class="d-flex align-items-center user-name">{{ isset(Auth::user()->name) ? Auth::user()->name : ''  }}</div>
											<a href="#" class="text-muted text-hover-primary user-email">{{ isset(Auth::user()->email) ? Auth::user()->email : ''  }}</a> 
										</div>
									</div>
									<div class="separator my-2"></div>
									<!--end: Head -->
									<div class="header-menu" data-name="SQYOyVCY">
										<div class="menu-item px-5 px-2"> 
											<a href="{{ route('user.profile', ['id' => isset(Auth::user()->id) ? Auth::user()->id : '' ]) }}" class="menu-link px-5"> <i class="fa fa-user-circle" style=""></i> {{trans('dashboard.topbar.profile')}}</a>
										</div>
										<div class="menu-item px-5 px-2"> 
											<a href="{{ route('accountSecurity') }}" class="menu-link px-5"> <i class="fa fa-shield-alt" style=""></i> {{trans('dashboard.topbar.security')}}</a>
										</div>
										@if(is_admin_panel_addon_active())

										<div class="menu-item px-5">
											<a href="{{ url('subscription') }}" class="menu-link px-5"> <i class="fa fa-dollar-sign"></i> {{trans('Subscription')}}</a>
										</div>
										<div class="menu-item px-5">
											<a href="https://billing.mumara.com/clientarea.php?action=invoices" class="menu-link px-5"> <i class="fa fa-file-invoice"></i> {{trans('Billing')}}</a>
										</div>

										@endif
									</div>
									<div class="separator my-2"></div>
									<div class="menu-item22 px-5"> 
										<a href="{{ url('/logout') }}" class="btn btn-brand btn-sm btn-bold btn-signout">
											@if(request()->session()->get('ghostlogin') == "yes")
												{{trans('dashboard.topbar.switch_back')}} 
											@else 
												{{trans('dashboard.topbar.logout')}}
											@endif
										</a> 
									</div>
								</div>
							</div>
							<!--end: User Bar -->
						</div>
					</div>

          <!-- Getting $vars from layout -->
{!! hook_get_output('TopNav',$vars) !!}