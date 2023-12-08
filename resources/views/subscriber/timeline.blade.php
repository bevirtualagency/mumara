@extends(decide_template())

@section('title', trans('contacts.timeline.page.title'))

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/timeline.css?v={{$local_version}}.01">
@endsection

@section('page_scripts')
<script type="text/javascript">
    
    $(document).ready(function(){

        // var t = $('.timeline').html(),
        // c = 1,
        // scroll_enabled = true;

        // function load_ajax() {
        //     $('.timelidne').append(t);
        //     scroll_enabled = true;
        //     c = ++c
        // }

        // $(window).bind('scroll', function() {
        //     if (scroll_enabled) {
        //         if($(window).scrollTop() >= ($('.timeline').offset().top + $('.timeline').outerHeight()-window.innerHeight)*0.9) {
        //             scroll_enabled = false;  
        //             $(".blockUI").show();
        //             if(c < 3) {
        //                 setTimeout(() => {
        //                     $(".blockUI").hide();
        //                     load_ajax();
        //                 }, 2000);
        //             } else {
        //                 setTimeout(() => {
        //                     $(".blockUI").hide();
        //                     $(".loadmore-container").hide();
        //                     $(".end-timeline").show();
        //                 }, 1000);
        //             }
        //         }
        //     }
        // });

    });
</script>
@endsection

@section(decide_content())



<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="sqfQHjBg">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="yzpDLipT">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="owqPWayW">
    <div class="col-md-6" data-name="hdTqyxMl">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="UTGVcAnu">
            <div class="kt-portlet__head" data-name="zwLRMbfE">
                <div class="kt-portlet__head-label" data-name="spavDNJF">
                    <h3 class="kt-portlet__head-title">
                        {{trans('contacts.timeline.page.title')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="VGAHvzFi">
                <div class="timeline" id="timeline_1">

                   

                    <?php 
                        $eventupdateflag = false;
                        $eventString = "";
                        $events = explode("||", $subscriber->events);

                        $subscriber_id = $subscriber->id;
                       
                        foreach($events as $key => $event) { 
                            $event = json_decode($event);
                            if(empty($event->event)) continue;
                            $datetime = date("Y-m-d H:i:s");
                            if(!empty($event->datetime)) { 
                                $datetime = $event->datetime;
                            }
                           
                            if(!empty($event->datetime)) { 
                                $event->datetime = showDateTime(getAuthUser(), $datetime);
                                $datetime = date("M d Y h:ia" , strtotime($datetime));
                            } else { 
                                $datetime = showDateTime(getAuthUser(), gmdate("Y-m-d H:i:s"));
                                // $datetime = date("M d Y h:ia" );
                            }
                           
                           
                           
                    ?>


                    @if($event->event == "add")
                        <?php 
                        if(empty($event->flag)) {
                            $eventupdateflag = true;
                            $list_id = $event->list_id;
                            $list_name = DB::table("lists")->where("id" , $list_id)->value("name");
                            $event->list_name = isset($list_name) ? $list_name : "Not Found";
                        }
                        $events[$key] = $event;
                        ?>
                        <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                            <div class="symbol-label bg-light-success">
                                <span class="svg-icon svg-icon-2 svg-icon-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="currentColor" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Mask-Copy" fill="currentColor" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-4 fw-semibold pt-2">Added to the contact list.</div>
                                <div class="timeline-desc fs-6">
                                    <div class="me-2 fs-7 fw-semibold">Contact List: <a href="javascript:;">{{$event->list_name}}</a></div>
                                    <div class="text-muted me-2 fs-7">Added at {{$datetime}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif


                    @if($event->event == "sent")
                        <?php 
                         if(empty($event->flag)) { 
                            $eventupdateflag = true;
                            $schedule_campaign_id = $event->schedule_campaign_id;
                            $campaign_id = DB::table("campaign_schedule_logs")->where("subscriber_id" , $subscriber_id)->where("campaign_schedule_id" , $schedule_campaign_id)->value("campaign_id");
                            $brodcast_name = DB::table("campaigns")->where("id" , $campaign_id)->value("name");
                            $event->brodcast_name = $brodcast_name;
                         }

                         $events[$key] = $event;
                            
                        ?>
                        <div class="timeline-item">
                            <div class="timeline-line w-40px"></div>
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light-info">
                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M3,13.5 L19,12 L3,10.5 L3,3.7732928 C3,3.70255344 3.01501031,3.63261921 3.04403925,3.56811047 C3.15735832,3.3162903 3.45336217,3.20401298 3.70518234,3.31733205 L21.9867539,11.5440392 C22.098181,11.5941815 22.1873901,11.6833905 22.2375323,11.7948177 C22.3508514,12.0466378 22.2385741,12.3426417 21.9867539,12.4559608 L3.70518234,20.6826679 C3.64067359,20.7116969 3.57073936,20.7267072 3.5,20.7267072 C3.22385763,20.7267072 3,20.5028496 3,20.2267072 L3,13.5 Z" id="Combined-Shape" fill="currentColor"/>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="timeline-content mb-10 mt-n2">
                                <div class="overflow-auto pe-3">
                                    <div class="fs-4 fw-semibold pt-2"> A broadcast was sent.</div>
                                    <div class="timeline-desc fs-6">
                                        <div class="me-2 fs-7 fw-semibold">Broadcast: <a href="javascript:;">{{ $event->brodcast_name}}</a></div>
                                        <div class="text-muted me-2 fs-7">Added at {{$datetime}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    @if($event->event == "merge")
                    <?php 
                        if(empty($event->flag)) { 
                            $eventupdateflag = true;
                            $list_id = $event->list_id;
                            $list_name = DB::table("lists")->where("id" , $list_id)->value("name");
                            $event->list_name = $list_name;
                        }
                            
                        $events[$key] = $event;
                        ?>
                        <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                            <div class="symbol-label bg-light-success">
                                <span class="svg-icon svg-icon-2 svg-icon-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="currentColor" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Mask-Copy" fill="currentColor" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-4 fw-semibold pt-2">Merge to the contact list.</div>
                                <div class="timeline-desc fs-6">
                                    <div class="me-2 fs-7 fw-semibold">Contact List: <a href="javascript:;">{{$event->list_name}}</a></div>
                                    <div class="text-muted me-2 fs-7">Added at {{$datetime}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                    @if($event->event == "open")

                    <?php 
                     if(empty($event->flag)) { 
                        $eventupdateflag = true;
                        $record_id = $event->record_id; 
                        $broadcast_id = $event->broadcast_id; 
                        $schedule_name = DB::table("campaign_schedules")->where("id" , $record_id)->first();
                        if(empty($broadcast_id) or empty($schedule_name)) continue;
                        if(empty($broadcast_id)) { 
                            $campaign_ids = explode("," , $schedule_name->campaign_ids)[0];
                        } else { 
                            $campaign_ids = $broadcast_id;
                        }

                        
                        
                        $campaign = DB::table("campaigns")->where("id" , $campaign_ids)->first();
                        $event->brodcast_name = isset($campaign->name) ? $campaign->name : "Not Found";
                        $event->brodcast_subject = isset($campaign->subject) ? $campaign->subject : "Not Found";
                        $event->campaign_name = isset($schedule_name->name) ?$schedule_name->name : "Not Found";

                       
                    }
                   
                        $events[$key] = $event;
                    ?>

                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-primary">
                                <span class="svg-icon svg-icon-2 svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" id="Combined-Shape" fill="currentColor" opacity="0.3"/>
                                            <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" id="Combined-Shape" fill="currentColor"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="mb-5 pe-3">
                                <div class="fs-4 fw-semibold pt-2">Has opened an Email.</div>
                                <div class="timeline-desc fs-6">
                                    <!-- <div class="me-2 fs-7 fw-semibold">Email Preview: <a href="javascript:;">Click here</a> to preview the email content</div> -->
                                    <div class="me-2 fs-7 fw-semibold">Subject: <a href="javascript:;">{{  $event->brodcast_subject }}</a></div>
                                    <div class="me-2 fs-7 fw-semibold">Broadcast: <a href="javascript:;">{{  $event->brodcast_name }}</a></div>
                                    <div class="me-2 fs-7 fw-semibold">Campaign: <a href="javascript:;">{{  $event->campaign_name}}</a></div>
                                    <div class="text-muted me-2 fs-7">Open at {{$datetime}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif


                    @if($event->event == "click")
                        <?php 
                           
                            if(empty($event->flag)) { 
                                $record_id = $event->record_id;
                                $broadcast_id = $event->broadcast_id;
                                $eventupdateflag = true;
                                $schedule_name = DB::table("campaign_schedules")->where("id" , $record_id)->first(); 
                                // if(empty($schedule_name )) continue;
                                if(empty($broadcast_id)) { 
                                    $campaign_ids = explode("," , $schedule_name->campaign_ids)[0];
                                } else { 
                                    $campaign_ids = $broadcast_id;
                                }
                                $campaign = DB::table("campaigns")->where("id" , $campaign_ids)->first();
                                $event->brodcast_name = $campaign->name;
                                $event->schedule_name = $schedule_name->name;
                            }
                           
                            // $events[$key] = $event;
                        ?>
                        <div class="timeline-item">
                            <div class="timeline-line w-40px"></div>
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light-primary">
                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" id="check" fill="currentColor" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.98630124,11 4.48466491,11.0516454 4,11.1500272 L4,7 C4,5.8954305 4.8954305,5 6,5 L20,5 C21.1045695,5 22,5.8954305 22,7 L22,16 C22,17.1045695 21.1045695,18 20,18 L12.9835977,18 Z M19.1444251,6.83964668 L13,10.1481833 L6.85557487,6.83964668 C6.4908718,6.6432681 6.03602525,6.77972206 5.83964668,7.14442513 C5.6432681,7.5091282 5.77972206,7.96397475 6.14442513,8.16035332 L12.6444251,11.6603533 C12.8664074,11.7798822 13.1335926,11.7798822 13.3555749,11.6603533 L19.8555749,8.16035332 C20.2202779,7.96397475 20.3567319,7.5091282 20.1603533,7.14442513 C19.9639747,6.77972206 19.5091282,6.6432681 19.1444251,6.83964668 Z" id="Combined-Shape" fill="currentColor" />
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="timeline-content mb-10 mt-n1">
                                <div class="pe-3 mb-5">
                                    <div class="fs-4 fw-semibold pt-2">Has clicked on a link.</div>
                                    <div class="timeline-desc fs-6">
                                        <div class="me-2 fs-7 fw-semibold">Link: <a target="_blank" href="{{ $event->url}}">{{ $event->url}}</a></div>
                                        <div class="me-2 fs-7 fw-semibold">Broadcast: <a href="javascript:;">{{$event->brodcast_name}}</a></div>
                                        <div class="me-2 fs-7 fw-semibold">Campaign: <a href="javascript:;">{{$event->schedule_name}}</a></div>
                                        <div class="text-muted me-2 fs-7">Clicked at {{$datetime}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    @if($event->event == "send_mail")

                    <?php 
                     if(empty($event->flag)) { 
                        $eventupdateflag = true;
                        $trigger_id = $event->trigger_id;
                        $trigger = DB::table("triggers")->where("id" , $trigger_id)->get();
                        $triggerData = json_decode($trigger->meta_attributes, true);
                        $broadcast_id = $data['attributes']['trigger_campaign'];
                        $campaign = DB::table("campaigns")->where("id" , $broadcast_id)->first();
                        $event->trigger_name = $trigger->name;
                        $event->brodcast_name = $campaign->name;
                     } 
                     $events[$key] = $event;

                    ?>

                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-info">
                                <span class="svg-icon svg-icon-2 svg-icon-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M3,13.5 L19,12 L3,10.5 L3,3.7732928 C3,3.70255344 3.01501031,3.63261921 3.04403925,3.56811047 C3.15735832,3.3162903 3.45336217,3.20401298 3.70518234,3.31733205 L21.9867539,11.5440392 C22.098181,11.5941815 22.1873901,11.6833905 22.2375323,11.7948177 C22.3508514,12.0466378 22.2385741,12.3426417 21.9867539,12.4559608 L3.70518234,20.6826679 C3.64067359,20.7116969 3.57073936,20.7267072 3.5,20.7267072 C3.22385763,20.7267072 3,20.5028496 3,20.2267072 L3,13.5 Z" id="Combined-Shape" fill="currentColor"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n2">
                            <div class="overflow-auto pe-3">
                                <div class="fs-4 fw-semibold pt-2">A triggered broadcast was sent.</div>
                                <div class="timeline-desc fs-6">
                                    <div class="me-2 fs-7 fw-semibold">Trigger Name: <a href="javascript:;">{{$event->trigger_name}}</a></div>
                                    <div class="me-2 fs-7 fw-semibold">Broadcast: <a href="javascript:;">{{$event->brodcast_name}}</a></div>
                                    <div class="text-muted me-2 fs-7">Added at {{$datetime}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif


                    @if($event->event == "move_contacts")

                    <?php 
                       if(empty($event->flag)) { 
                        $eventupdateflag = true;
                        $trigger_id = $event->trigger_id;
                        $trigger = DB::table("triggers")->where("id" , $trigger_id)->get();
                        $triggerData = json_decode($trigger->meta_attributes, true);
                        $destinationListId = $data['attributes']['trigger_campaign'];
                        $list_name = DB::table("campaigns")->where("id" , $destinationListId)->value("name");
                        $event->list_name = $list_name;
                        $event->trigger_name = $trigger->name;
                     } 
                     $events[$key] = $event;
                    ?>

                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-info">
                                <span class="svg-icon svg-icon-2 svg-icon-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M3,13.5 L19,12 L3,10.5 L3,3.7732928 C3,3.70255344 3.01501031,3.63261921 3.04403925,3.56811047 C3.15735832,3.3162903 3.45336217,3.20401298 3.70518234,3.31733205 L21.9867539,11.5440392 C22.098181,11.5941815 22.1873901,11.6833905 22.2375323,11.7948177 C22.3508514,12.0466378 22.2385741,12.3426417 21.9867539,12.4559608 L3.70518234,20.6826679 C3.64067359,20.7116969 3.57073936,20.7267072 3.5,20.7267072 C3.22385763,20.7267072 3,20.5028496 3,20.2267072 L3,13.5 Z" id="Combined-Shape" fill="currentColor"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n2">
                            <div class="overflow-auto pe-3">
                                <div class="fs-4 fw-semibold pt-2">Contact moved by trigger.</div>
                                <div class="timeline-desc fs-6">
                                    <div class="me-2 fs-7 fw-semibold">Trigger Name: <a href="javascript:;">{{$event->trigger_name}}</a></div>
                                    <div class="me-2 fs-7 fw-semibold">List Name: <a href="javascript:;">{{$event->list_name}}</a></div>
                                    <div class="text-muted me-2 fs-7">Added at {{$datetime}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif


                    @if($event->event == "copy_contacts")

                    <?php 
                       if(empty($event->flag)) { 
                            $eventupdateflag = true;
                            $trigger_id = $event->trigger_id;
                            $trigger = DB::table("triggers")->where("id" , $trigger_id)->get();
                            $event->trigger_name = $trigger->name;
                        } 
                     $events[$key] = $event;
                    ?>

                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-info">
                                <span class="svg-icon svg-icon-2 svg-icon-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M3,13.5 L19,12 L3,10.5 L3,3.7732928 C3,3.70255344 3.01501031,3.63261921 3.04403925,3.56811047 C3.15735832,3.3162903 3.45336217,3.20401298 3.70518234,3.31733205 L21.9867539,11.5440392 C22.098181,11.5941815 22.1873901,11.6833905 22.2375323,11.7948177 C22.3508514,12.0466378 22.2385741,12.3426417 21.9867539,12.4559608 L3.70518234,20.6826679 C3.64067359,20.7116969 3.57073936,20.7267072 3.5,20.7267072 C3.22385763,20.7267072 3,20.5028496 3,20.2267072 L3,13.5 Z" id="Combined-Shape" fill="currentColor"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n2">
                            <div class="overflow-auto pe-3">
                                <div class="fs-4 fw-semibold pt-2">Contact copied by trigger.</div>
                                <div class="timeline-desc fs-6">
                                    <div class="me-2 fs-7 fw-semibold">Trigger Name: <a href="javascript:;">{{$event->trigger_name}}</a></div>
                                    <div class="text-muted me-2 fs-7">Added at {{$datetime}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif



                    @if($event->event == "remove_contacts")

                    <?php 
                       if(empty($event->flag)) { 
                            $eventupdateflag = true;
                            $drip_id = $event->drip_id;
                            $trigger = DB::table("triggers")->where("id" , $drip_id)->get();
                            $event->trigger_name = $trigger->name;
                        } 
                     $events[$key] = $event;
                    ?>

                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-info">
                                <span class="svg-icon svg-icon-2 svg-icon-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M3,13.5 L19,12 L3,10.5 L3,3.7732928 C3,3.70255344 3.01501031,3.63261921 3.04403925,3.56811047 C3.15735832,3.3162903 3.45336217,3.20401298 3.70518234,3.31733205 L21.9867539,11.5440392 C22.098181,11.5941815 22.1873901,11.6833905 22.2375323,11.7948177 C22.3508514,12.0466378 22.2385741,12.3426417 21.9867539,12.4559608 L3.70518234,20.6826679 C3.64067359,20.7116969 3.57073936,20.7267072 3.5,20.7267072 C3.22385763,20.7267072 3,20.5028496 3,20.2267072 L3,13.5 Z" id="Combined-Shape" fill="currentColor"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n2">
                            <div class="overflow-auto pe-3">
                                <div class="fs-4 fw-semibold pt-2">Contact removed by trigger.</div>
                                <div class="timeline-desc fs-6">
                                    <div class="me-2 fs-7 fw-semibold">Trigger Name: <a href="javascript:;">{{$event->trigger_name}}</a></div>
                                    <div class="text-muted me-2 fs-7">Added at {{$datetime}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif


                    @if($event->event == "suppression")

                    <?php 
                       if(empty($event->flag)) { 
                            $eventupdateflag = true;
                            $trigger_id = $event->trigger_id;
                            $trigger = DB::table("triggers")->where("id" , $trigger_id)->get();
                            $event->trigger_name = $trigger->name;
                        } 
                        $events[$key] = $event;
                    ?>

                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-info">
                                <span class="svg-icon svg-icon-2 svg-icon-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M3,13.5 L19,12 L3,10.5 L3,3.7732928 C3,3.70255344 3.01501031,3.63261921 3.04403925,3.56811047 C3.15735832,3.3162903 3.45336217,3.20401298 3.70518234,3.31733205 L21.9867539,11.5440392 C22.098181,11.5941815 22.1873901,11.6833905 22.2375323,11.7948177 C22.3508514,12.0466378 22.2385741,12.3426417 21.9867539,12.4559608 L3.70518234,20.6826679 C3.64067359,20.7116969 3.57073936,20.7267072 3.5,20.7267072 C3.22385763,20.7267072 3,20.5028496 3,20.2267072 L3,13.5 Z" id="Combined-Shape" fill="currentColor"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n2">
                            <div class="overflow-auto pe-3">
                                <div class="fs-4 fw-semibold pt-2">Contact suppressed by trigger.</div>
                                <div class="timeline-desc fs-6">
                                    <div class="me-2 fs-7 fw-semibold">Trigger Name: <a href="javascript:;">{{$event->trigger_name}}</a></div>
                                    <div class="text-muted me-2 fs-7">Added at {{$datetime}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif


                    @if($event->event == "start_autoresponder")

                    <?php 
                       if(empty($event->flag)) { 
                            $eventupdateflag = true;
                            $drip_id = $event->drip_id;
                            $drip = DB::table("autoresponders")->where("id" , $drip_id)->get();
                            $autoresponderGroupID = $drip->autoresponder_group_id;
                            $autoresponder_groups = DB::table("autoresponder_groups")->where("id" , $autoresponderGroupID)->get();
                            $event->drip_name = $drip->name;
                            $event->group_name = $$autoresponder_groups->name;
                        } 
                        $events[$key] = $event;
                    ?>

                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-info">
                                <span class="svg-icon svg-icon-2 svg-icon-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M3,13.5 L19,12 L3,10.5 L3,3.7732928 C3,3.70255344 3.01501031,3.63261921 3.04403925,3.56811047 C3.15735832,3.3162903 3.45336217,3.20401298 3.70518234,3.31733205 L21.9867539,11.5440392 C22.098181,11.5941815 22.1873901,11.6833905 22.2375323,11.7948177 C22.3508514,12.0466378 22.2385741,12.3426417 21.9867539,12.4559608 L3.70518234,20.6826679 C3.64067359,20.7116969 3.57073936,20.7267072 3.5,20.7267072 C3.22385763,20.7267072 3,20.5028496 3,20.2267072 L3,13.5 Z" id="Combined-Shape" fill="currentColor"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n2">
                            <div class="overflow-auto pe-3">
                                <div class="fs-4 fw-semibold pt-2">A drip was sent.</div>
                                <div class="timeline-desc fs-6">
                                    <div class="me-2 fs-7 fw-semibold">Drip: <a href="javascript:;">{{$event->drip_name}}</a></div>
                                    <div class="me-2 fs-7 fw-semibold">Drip Group: <a href="javascript:;">{{$event->group_name}}</a></div>
                                    <div class="text-muted me-2 fs-7">Added at {{$datetime}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                  

                <?php
                    $event->flag = 1;
                    if(empty($eventString)) { 
                        $eventString .= json_encode($event);
                    } else { 
                        $eventString .= "||" . json_encode($event);
                    }
                    
                } 
               
                 DB::table("subscribers")->where("id" , $subscriber->id)->update(["events" => $eventString]);
                ?>

                    
                   
                   

                    <!-- <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-warning">
                                <span class="svg-icon svg-icon-2 svg-icon-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.98630124,11 4.48466491,11.0516454 4,11.1500272 L4,7 C4,5.8954305 4.8954305,5 6,5 L20,5 C21.1045695,5 22,5.8954305 22,7 L22,16 C22,17.1045695 21.1045695,18 20,18 L12.9835977,18 Z M19.1444251,6.83964668 L13,10.1481833 L6.85557487,6.83964668 C6.4908718,6.6432681 6.03602525,6.77972206 5.83964668,7.14442513 C5.6432681,7.5091282 5.77972206,7.96397475 6.14442513,8.16035332 L12.6444251,11.6603533 C12.8664074,11.7798822 13.1335926,11.7798822 13.3555749,11.6603533 L19.8555749,8.16035332 C20.2202779,7.96397475 20.3567319,7.5091282 20.1603533,7.14442513 C19.9639747,6.77972206 19.5091282,6.6432681 19.1444251,6.83964668 Z" id="Combined-Shape" fill="currentColor"/>
                                            <path d="M8,17 C8.55228475,17 9,17.4477153 9,18 L9,21 C9,21.5522847 8.55228475,22 8,22 L3,22 C2.44771525,22 2,21.5522847 2,21 L2,18 C2,17.4477153 2.44771525,17 3,17 L3,16.5 C3,15.1192881 4.11928813,14 5.5,14 C6.88071187,14 8,15.1192881 8,16.5 L8,17 Z M5.5,15 C4.67157288,15 4,15.6715729 4,16.5 L4,17 L7,17 L7,16.5 C7,15.6715729 6.32842712,15 5.5,15 Z" id="Mask" fill="currentColor" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-4 fw-semibold pt-2">The email has been bounced.</div>
                                <div class="timeline-desc fs-6">
                                    <div class="me-2 fs-7 fw-semibold">Broadcast: <a href="javascript:;">%%broadcast_name%%</a></div>
                                    <div class="me-2 fs-7 fw-semibold">Campaign: <a href="javascript:;">%%schedule_label%%</a></div>
                                    <div class="text-muted me-2 fs-7">Bounced at August 23, 2022 05:15 PM</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-danger">
                                <span class="svg-icon svg-icon-2 svg-icon-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                                            <path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z M10.5857864,14 L9.17157288,15.4142136 C8.78104858,15.8047379 8.78104858,16.4379028 9.17157288,16.8284271 C9.56209717,17.2189514 10.1952621,17.2189514 10.5857864,16.8284271 L12,15.4142136 L13.4142136,16.8284271 C13.8047379,17.2189514 14.4379028,17.2189514 14.8284271,16.8284271 C15.2189514,16.4379028 15.2189514,15.8047379 14.8284271,15.4142136 L13.4142136,14 L14.8284271,12.5857864 C15.2189514,12.1952621 15.2189514,11.5620972 14.8284271,11.1715729 C14.4379028,10.7810486 13.8047379,10.7810486 13.4142136,11.1715729 L12,12.5857864 L10.5857864,11.1715729 C10.1952621,10.7810486 9.56209717,10.7810486 9.17157288,11.1715729 C8.78104858,11.5620972 8.78104858,12.1952621 9.17157288,12.5857864 L10.5857864,14 Z" id="Combined-Shape" fill="currentColor"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-4 fw-semibold pt-2">The email has been marked spammed</div>
                                <div class="overflow-auto pb-5">
                                    <div class="timeline-desc fs-6">
                                        <div class="me-2 fs-7 fw-semibold">Broadcast: <a href="javascript:;">%%broadcast_name%%</a></div>
                                        <div class="me-2 fs-7 fw-semibold">Campaign: <a href="javascript:;">%%schedule_label%%</a></div>
                                        <div class="me-2 fs-7 fw-semibold">Spammed by: <a href="javascript:;">%%complainer_email%%</a></div>
                                        <div class="text-muted me-2 fs-7">Spammed at August 22, 2022 09:45 AM</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-light-danger">
                                <span class="svg-icon svg-icon-2 svg-icon-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                            <path d="M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z M21,8 L17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L21,6 C21.5522847,6 22,6.44771525 22,7 C22,7.55228475 21.5522847,8 21,8 Z" id="Combined-Shape" fill="currentColor" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Mask-Copy" fill="currentColor" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="fs-4 fw-semibold pt-2">Has been unsubscribed to receive any further email.</div>
                                <div class="overflow-auto pb-5">
                                    <div class="timeline-desc fs-6">
                                        <div class="me-2 fs-7 fw-semibold">Broadcast: <a href="javascript:;">%%broadcast_name%%</a></div>
                                        <div class="me-2 fs-7 fw-semibold">Campaign: <a href="javascript:;">%%schedule_label%%</a></div>
                                        <div class="text-muted me-2 fs-7">Unsubscribed at August 20, 2022 11:20 PM</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
                <!-- <div class="timeline-item height-50 loadmore-container" id="load_1">
                    <div class="loadmore"><span></span> Scroll</div>
                </div> -->
                <div class="end-timeline fs-4 fw-semibold pt-2 text-center">End of Timeline</div>
            </div>
        </div>
    </div>
</div>


@endsection