<div class="blockUI blockMsg blockPage" style="display: none;" data-name="ZVuOHIdX">
            <div class="blockui" style="margin-left:-83.5px;" data-name="OdiaroYw">
                <span>{{trans('common.label.processing')}}...</span>
                <span>
                    <div class="kt-spinner kt-spinner--v2 kt-spinner--primary" data-name="WDPpFIHO"></div>
                </span>
            </div>
            <div class="blockUI blockOverlay" data-name="ipcZoxaP"></div>
        </div>
         <!-- end:: Page -->

        <div id="modal-bug-report" class="modal" role="dialog" aria-hidden="true" data-name="WUcKXCfP">
            <div class="modal-dialog modal-lg" data-name="ianOoxZG">
                <div class="modal-content" data-name="CAdRMRwI">
                    <div class="modal-header" data-name="NLukADOR">
                        <div id="msg" class="display-hide" data-name="YEFWsdPf">
                            <span id='msg-text' class="alert-text"><span>
                        </div>
                        <h5 class="modal-title sbold">{{trans('tools.bug_report.page.title')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body" data-name="JQHSoyfY">
                        <br/>
                        <form action="" id="frm-bug-report" method="post" class="kt-form kt-form--label-right">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row" data-name="uFJNriYm">
                            <label class="col-form-label col-md-3">{{trans('tools.bug_report.table.column.section')}}
                                <span class="required"> * </span>
                            </label>
                             <div class="col-md-8" data-name="QyGSDiMW">
                                <select class="form-control m-select2" data-placeholder="Select a Section" name="section" id="section" required="">
                                    @foreach(\App\user_settings::appModules(); as $key => $module)
                                        <option value="{{ $key }}">{{ $module }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" data-name="hlSaUvWH">
                            <label class="col-form-label col-md-3">{{trans('tools.bug_report.table.column.priority')}}
                                <span class="required"> * </span>
                            </label>
                             <div class="col-md-8" data-name="mQoIRlHF">
                                <select class="form-control m-select2" data-placeholder="Select Priority" name="priority" required="">
                                    <option>{{trans('sending_nodes.include_common_script_blade.select_priority_option')}} </option>
                                    <option value="medium" selected>{{trans('tools.bug_report.medium')}}</option>
                                    <option value="hard">{{trans('tools.bug_report.high')}}</option>
                                    <option value="low">{{trans('tools.bug_report.low')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" data-name="XhMjiMRT">
                            <label class="col-form-label col-md-3">{{trans('tools.bug_report.table.column.subject')}}
                                <span class="required"> * </span>
                            </label>
                             <div class="col-md-8" data-name="BGtfkSYB">
                                <input type="text" name="title" required class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row" data-name="kWNQsEBA">
                            <label class="col-form-label col-md-3">{{trans('tools.bug_report.table.column.description')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-8" data-name="QlWPNhOI">
                                <div class="input-icon right" data-name="fVGEdpxy">
                                    <textarea required="required" name="description" class="form-control" placeholder="" rows="8"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions" data-name="mTWhaWDD">
                            <div class="row" data-name="YqTmvzsl">
                                <div class="col-md-12" data-name="KNIevQTo">
                                    <label class="col-form-label col-md-3"></label>
                                    <button type="submit" id="btn-submit" class="btn btn-success">{{trans('common.form.buttons.submit')}}</button>
                                    <span id='merge-processing' style='display:none;'>
                                        <i class='la la-gear fa-spin'></i> {{trans('common.label.processing')}}
                                        <div class="text-danger" data-name="lRLIGHjj">{{trans('common.label.processing_alert')}}</div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br/>
                    </div>
                </div>
            </div>
        </div>

        
<script src="/themes/default/js/loadingoverlay.min.js"></script>
<script type="text/javascript">
//added by azeem dated 29-10-2021 
    $(document).ready(function(){
       
      
        /*
        $("body").on('mouseover', '.popovers', function() {
            $(".popovers").popover();
        });
        */
        
        $(".tnmar").on("click", function() {
            $(this).hide();
            $("#system_notifications .kt-notification__item").removeClass("unread");
            $("#noti_count").text("0");
        })

        $("body").on("click", ".notif-read", function() { 
            $(this).parent().parent().removeClass("unread");
            $("#system_notifications .tnmar").show();
            var count = $("#noti_count").text();
            $("#noti_count").text(count-1);
            var li_id = $(this).attr('id');
            readDbNotification(li_id);
        });

        $("body").on("click", ".notif-unread", function() { 
            $(this).parent().parent().addClass("unread");
            $("#system_notifications .tnmar").show();
            var count = $("#noti_count").text();
            $("#noti_count").text(++count);
            var li_id = $(this).attr('id');
            unReadNotificationDB(li_id);
            $("#notifcationRead").show()
        });
    });
// Script for menu activation of addons 
$(function(){
    var activeurl = window.location;
    $('#addons_parent a[href="'+activeurl+'"]').parents('li').addClass('kt-menu__item--open kt-menu__item--active');
    $('#addons_parent a[href="'+activeurl+'"]').parents('ul.kt-menu__subnav li.kt-menu__item--active.kt-menu__item--open').find('.kt-menu__submenu').css('display','block');
 });
    // Active first tab in right sidebar
     $(document).find('#kt_quick_panel .nav-tabs li > a:eq(0)').tab('show');
      // Store and appy Datatable per page record length to localstorage
            function show_per_page(table,page,default_limit=10){
                var page_limit = default_limit;
                if(localStorage.getItem(page) > 0 ) { 
                    page_limit = localStorage.getItem(page);
                }
                if(table)
                table.on( 'length.dt', function ( e, settings, len ) {
                    localStorage.setItem(page , len);
                });
                return page_limit;
            }
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                $(document).on('click',"#logsAllBtn",function() {
                     $.ajax({
                        url: '{{ route("fetchVersion") }}',
                        beforeSend: function() {
                            $(".changelogDiv").html('');
                            // $("#changelogbody").LoadingOverlay("show", {
                            //     background  : "rgba(255, 255, 255, 1)",
                            //     size        : 50,    // Float/String/Boolean
                            //     minSize     : 20,    // Integer/String
                            //     maxSize     : 50   // Integer/String
                            // });
                            $("#loading-changelogbody").show();
                            $("#logsAll").modal("show");
                        },
                        success: function (data) {
                            if(data.success){
                                $(".changelogDiv").html(data.html);
                                // $("#changelogbody").LoadingOverlay("hide", true);
                                $("#loading-changelogbody").hide();
                                
                                // $("#notifies").slideToggle("slow");
                            }
                           
                        }
                    });
                }); 

            var skip = 0;
            var records = 5;
            var more = 1;
            function getUserNotifications(skip,records,flag=0){ 
                $(".data-processing").hide();  
                if(more==1){
                    $.ajax({
                        url: "{{ route('get.all.notifications') }}",
                        type: "POST",
                        data: {'skip':skip,'records':records,'flag':flag},
                        cache: false,
                        dataType: 'json',
                        beforeSend: function () {
                            /*$("#system_notifications").LoadingOverlay("show", {
                                background  : "rgba(255, 255, 255, 1)",
                                size        : 50,    // Float/String/Boolean
                                minSize     : 20,    // Integer/String
                                maxSize     : 50   // Integer/String
                            });
                            */
                           ///$("#system_notifications").html('<i class="fa fa-spin fa-spinner fa-lg notif-loader"></i>');
                        },
                        success : function(result) {
                            if(result){
                                more = result.more_record;
                                if(more!=0)
                                  scroll=1;
                                
                                // $("#system_notifications").LoadingOverlay("hide", true);
                                setTimeout(function() {
                                    $("#system_notifications").html(result.notifications_data);
                                    $(".popovers").popover();
                                    if(more == 0) { 
                                        $(".pdb1").remove();
                                    }
                                }, 1*1000);
                                

                                if(more == 1) { 
                                    $(".data-processing").show();  
                                } else { 
                                    $(".data-processing").html("{{trans('sending_nodes.include_common_script_blade.end_of_notification')}}");  
                                }

                                $("#unreadNotification").hide();
                                if(Number(result.unread) > 0) { 
                                    $("#unreadNotification").show();
                                    $("#unreadNotification").html(result.unread);
                                    $(".newnotiFy").addClass("new-notif");
                                    $("#notifcationRead").show();
                                }else{
                                    $("#notifcationRead").hide();
                                }
                               
                                $(".feeds li .label i").each(function(index) {
                                  var colorR = Math.floor((Math.random() * 256));
                                  var colorG = Math.floor((Math.random() * 256));
                                  var colorB = Math.floor((Math.random() * 256));
                                  $(this).css("color", "rgb(" + colorR + "," + colorG + "," + colorB + ")");
                                });
                                
                            }else{
                                scroll=0;
                                 $(".pdb1").remove();
                            }

                        }
                    });
                }else{
                    $(".pdb1").remove();
                } 
            }
            function getUserNotificationsCount(){
                $.ajax({
                    url: "{{ route('get.all.notifications.count') }}",
                    type: "POST",
                    data: {},
                    cache: false,
                    dataType: 'json',
                    beforeSend: function () {
                            scroll=0;
                            // $("#system_notifications").LoadingOverlay("show", {
                            //     background  : "rgba(255, 255, 255, 1)",
                            //     size        : 50,    // Float/String/Boolean
                            //     minSize     : 20,    // Integer/String
                            //     maxSize     : 50   // Integer/String
                            // });
                            $("#loading-system_notifications").show();
                        },
                    success : function(result) {
                           // $("#system_notifications").LoadingOverlay("hide", true);
                           $("#loading-system_notifications").hide();
                            if(result){
                                if( result.unread > 0 ){
                                    $('.showDotNotification').show(); 
                                    $("#notifCount").html(result.unread).show();
                                    getUserNotifications(skip,records,1);
                                    ///alert(result.unread);
                                }else{
                                    $("#notifCount").html(0).hide();
                                    getUserNotifications(skip,records,0);
                                    $('.showDotNotification').hide(); 
                                    $(".pdb1").remove();
                                }
                                skip += records;
                            }
                    }
                });
            }
             $('.system_notifications').bind('scroll', function() {
                    if(($(this).height() + $(this).scrollTop()) == $('#system_notifications').outerHeight() && scroll==1) {
                       getUserNotificationsCount()
                    }
                });
             // $("#my_notifications").click(function(){
             //        getUserNotifications(skip,records,1);
             //    });
            
         function isGearRunning(){
                $.ajax({
                    url: "{{ route('isGearRunning') }}",
                    type: "GET",
                    success : function(result) {
                          $(result).insertAfter('#timeblock');
                          //$('#notifications_div').html(result);
                    }
                });
                }

                
                  function setupTab(){
                    $.ajax({
                        url: "{{ route('setupTab') }}",
                        type: "GET",
                        beforeSend: function () {
                           
                        },
                        success : function(result) {
                            
                            setTimeout(function(){
                                $('#i_setup').html(result);
                            },3000)   
                           
                               ///getUserNotificationsCount();
                        },
                        error : function(err) {
                            //    $("#i_setup").LoadingOverlay("hide", true);
                               
                        }
                    });
                }
                
             
             
            jQuery(document).ready(function() {  
                setTimeout(function() {
                     getUserNotificationsCount();
                }, 1*6000);
                
              setTimeout(function() {
                
                  ///getUserNotificationsCount();
                  isGearRunning();
                  setTimeout(function() {
                     setupTab();
                     ////getUserNotificationsCount();
                }, 1*1000);
                }, 1*1000);

                

               });
          function cancelImport(file_no_import=0,reload=0,stop=0)
            {
                if(confirm('{{trans('common.message.confirmation_alert')}}')){
                    $.ajax({
                    url: app_url+'/list/cancelImport',
                    type: 'POST',
                    data: {'file_no_import':file_no_import,stop:stop},
                    success: function (result) {
                        if(reload)
                        location.reload();
                    }
                });
                }
           }
           function restartDeletingList(id) {
                $.ajax({
                    url: '{{route("restartDeletingList")}}',
                    data: {'id':id},
                    beforeSend: function() {
                        $(".blockUI").show();
                    },
                    success: function (data) {
                        $(".blockUI").hide();
                    }
                });
            }

            function restartOptimizaing(id) {
                $.ajax({
                    url: '{{route("restartOptimizaing")}}',
                    data: {'id':id},
                    beforeSend: function() {
                        $(".blockUI").show();
                    },
                    success: function (data) {
                        $(".blockUI").hide();
                    }
                });
            }
            function notficationReadDB(id){
                //console.log("id = "+id);
                $("#read_id_"+id).trigger("click");
                //if(isRead==0 || isRead=='0')
                    ///readDbNotification("read_id_"+id);
                //else
                    ///readDbNotification("read_id_"+id);
            }
            function readDbNotification(li_id){
                $.ajax({
                        url: "{{ route('read.notification') }}",
                        type: "POST",
                        data: {'id':li_id},
                        cache: false,
                        dataType: 'json',                        
                        success : function(result) {
                            if(result.status = 'success' ){   
                                $("#unreadNotification").show();
                                $("#unreadNotification").html(result.is_read);

                                $("#"+li_id).removeClass("unread");   
                                if(Number(result.is_read) <=0){
                                    $("#unreadNotification").hide();
                                    $("#m-read").hide();
                                    $("#notifcationRead").hide();
                                    $("#dotIcon").removeClass("new-notif");
                                    
                                }else{
                                    $("#notifcationRead").show();
                                    $("#dotIcon").removeClass("new-notif");
                                    $("#dotIcon").addClass("new-notif");
                                }
                            }
                        }
                    });
            }
            function unReadNotificationDB(li_id){ 
                $.ajax({
                        url: "{{ route('un.read.notification') }}",
                        type: "POST",
                        data: {'id':li_id},
                        cache: false,
                        dataType: 'json',                        
                        success : function(result) {
                            if(result.status=='success'){   
                                $("#unreadNotification").show();
                                $("#unreadNotification").html(result.is_read);
                                $(".newnotiFy").removeClass("new-notif");
                                $(".newnotiFy").addClass("new-notif");
                                $("#"+li_id).removeClass("unread");   
                                if(Number(result.is_read) <=0){
                                    $("#unreadNotification").hide();
                                    $("#m-read").hide();
                                }
                            }else{
                                alert("false");
                            }
                        }
                    });
            }
            $(document).ready(function () {
                $("a.cancel_link").tooltip(); 
                $("#switch-production").click(function() {
                       $.ajax({
                        url: '{{ route("switchToProduction") }}',
                        type:"POST",
                        beforeSend: function() {
                           $(".blockUI").show();
                        },
                        success: function (data) {
                            if(data.success){
                             $("body").removeClass("mode-option");    
                             $(".blockUI").hide();  
                             location.reload(); 
                            }else{
                               Command: toastr["error"] (data.error);  
                            }
                            
                        }
                    });
                });

                scroll = 0;
            $("#frm-bug-report").submit(function(){

                $(".blockUI").show();
                setTimeout(function(){
                    $(".blockUI").hide();
                }, 1500);
                
                var form_data =  $("#frm-bug-report").serialize();
                $.ajax({
                    url: "<?php echo url('/bug/report');  ?>",
                    type: "POST",
                    data: form_data,
                    beforeSend: function () {
                        //$('#btn-submit').attr("disabled","disabled");
                        //$('.modal-dialog').css('opacity', '0');
                    },
                    success: function(result) {
                        if(result == 'success'){
                            $(".blockUI").hide();
                            Command: toastr["success"] ("@lang('tools.message.bug_reported')");
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('@lang('tools.message.bug_reported')');
                            $('#msg').removeClass('display-hide').addClass('alert alert-success ');
                            $('#msg').delay(1500).hide('slow');
                            $("#modal-bug-report").modal("hide");
                          
                        }else{
                            alert("{{trans('sending_nodes.include_common_script_blade.alert_oops_wrong')}}");
                        }
                        
                    }
                });
                return false;
            });
                $('body').on('click', '.kt-header__topbar-item .dropdown-menu', function(e){
                    e.stopPropagation();
                });
                $("body").on('click', '.kt-header__topbar a.icon-close', function(e){
                    e.preventDefault();
                    var html = $(this).parent().parent().parent().html();
                    $(this).parent().parent(".dropdown-menu").removeClass("show");
                    $(this).parent().parent().parent(".dropdown-menu").removeClass("show");
                    e.preventDefault();
                });

                $("#tab-issue").click(function(){
                    $("#kt_quick_panel .tab-content>.tab-pane").removeClass("active show");
                    $("#kt_quick_panel .tab-content>.issues_notifications").addClass("active show");
                });

                $(document).on("click", ".unread2", function() {
                    var li_id = $(this).attr('id');
                    var all_read = $("#issues_notifications>.unread2").length;
                    $("#"+li_id).removeClass("unread2");   
                    if(all_read==1){
                        $("#m-read2").hide();
                    }
                });
                $(document).on("click", "#m-read2", function() { 
                    $('.unread2').removeClass("unread2");   
                    $("#m-read2").hide();
                });

                $(".resolve-btn").click(function() {
                    var btnsr = $(this);
                    // console.log(btnsr);
                    btnsr.next(".kt-notification__item-alert").children(".notify-retry").show();
                    btnsr.next(".kt-notification__item-alert").children(".notify-success").hide();
                    btnsr.next(".kt-notification__item-alert").children(".notify-danger").hide();
                    setTimeout(function(){
                        btnsr.next(".kt-notification__item-alert").children(".notify-success").show();
                        btnsr.next(".kt-notification__item-alert").children(".notify-retry").hide();
                    }, 2000);
                    setTimeout(function(){
                        btnsr.next(".kt-notification__item-alert").children(".notify-success").hide();
                        btnsr.parent().parent("").css('background-color','#ececec').fadeIn(500);
                        btnsr.parent().parent().fadeOut(1000, function () {
                            $(this).remove();
                        });
                    }, 4000);
                });

                $(".retry-btn").click(function() {
                    var btns = $(this);
                    btns.next(".resolve-btn").next(".kt-notification__item-alert").children(".notify-retry").show();
                    btns.next(".resolve-btn").next(".kt-notification__item-alert").children(".notify-success").hide();
                    btns.next(".resolve-btn").next(".kt-notification__item-alert").children(".notify-danger").hide();
                    setTimeout(function(){
                        btns.next(".resolve-btn").next(".kt-notification__item-alert").children(".notify-danger").show();
                        btns.next(".resolve-btn").next(".kt-notification__item-alert").children(".notify-retry").hide();
                    }, 2000);
                    setTimeout(function(){
                        btns.next(".resolve-btn").next(".kt-notification__item-alert").children(".notify-danger").hide();
                    }, 4000);
                });
                 $("#chLog").click(function() {
                    $(".curChnges").slideToggle();
                    $("a#chLog>i.la.la-angle-down").toggleClass("inline-block");
                    $("a#chLog>i.la.la-angle-up").toggleClass("inline-block")
                });

               
                
                $(document).on("click", ".notif-read", function() { alert("ffff");
                    var li_id = $(this).attr('id');
                    readDbNotification(li_id);
                    /*$.ajax({
                        url: "{{ route('read.notification') }}",
                        type: "POST",
                        data: {'id':li_id},
                        cache: false,
                        dataType: 'json',                        
                        success : function(result) {
                            if(result.status = 'success' ){   
                                $("#unreadNotification").show();
                                $("#unreadNotification").html(result.is_read);

                                $("#"+li_id).removeClass("unread");   
                                if(Number(result.is_read) <=0){
                                    $("#unreadNotification").hide();
                                    $("#m-read").hide();
                                }
                            }
                        }
                    });*/
                    
                });
                $(document).on("click", ".notif-unread", function() { 
                    var li_id = $(this).attr('id');
                    unReadNotificationDB(li_id);
                    /*$.ajax({
                        url: "{{ route('un.read.notification') }}",
                        type: "POST",
                        data: {'id':li_id},
                        cache: false,
                        dataType: 'json',                        
                        success : function(result) {
                            if(result.status = 'success' ){   
                                $("#unreadNotification").show();
                                $("#unreadNotification").html(result.is_read);

                                $("#"+li_id).removeClass("unread");   
                                if(Number(result.is_read) <=0){
                                    $("#unreadNotification").hide();
                                    $("#m-read").hide();
                                }
                            }
                        }
                    });
                    */
                });
                
                //link_384
                $(document).on("click", "#m-read", function() {                    
                    $.ajax({
                        url: "{{ route('mark.all.notifications.read') }}",
                        type: "POST",
                        data: {},
                        cache: false,
                        dataType: 'json',                        
                        success : function(result) {
                            if(result.status = 'success' ){                                
                                $('.unread').removeClass("unread");  
                                $("#notifCount").html(0).hide(); 
                                $("#m-read").hide();
                            }
                        }
                    });
                });
                
                //m-read
                // $("#bellIcon").click(function(){
                //     $.ajax({
                //         url: "{{ route('hide.bell.icon.counter') }}",
                //         type: "POST",
                //         data: {},
                //         cache: false,
                //         dataType: 'json',                        
                //         success : function(result) {
                //             if(result.status = 'success' ){                                
                //                 $("#notifCount").html(0).hide();
                //             }
                //         }
                //     });
                    
                // });

                $("body").on('click', '.downside', function(){
                    $(this).hide().prev().show();
                    $(this).closest(".setepOptions").find(".paraSetup").slideDown();
                });
                $("body").on('click', '.upside', function(){
                    $(this).hide().next().show();
                    $(this).closest(".setepOptions").find(".paraSetup").slideUp(500);
                });

                //.setepOptions>h3
                $("body").on('click', '.setepOptions>h3', function(){
                    $(this).closest(".setepOptions").find(".paraSetup").slideToggle();
                    $(this).parent().toggleClass("open");
                });

                $(".feeds li .label i").each(function(index) {
                  var colorR = Math.floor((Math.random() * 256));
                  var colorG = Math.floor((Math.random() * 256));
                  var colorB = Math.floor((Math.random() * 256));
                  $(this).css("color", "rgb(" + colorR + "," + colorG + "," + colorB + ")");
                });

                $("#m-read").click(function() {
                    $("ul.feeds>li").removeClass("unread");
                    $("#notifCount").hide();
                    $(this).hide();
                });
                $(".blockOpen").click(function() {
                    KTApp.blockPage({
                        overlayColor: '#000000',
                        type: 'v2',
                        state: 'primary',
                        message: 'Processing...'
                    });

                    setTimeout(function() {
                        KTApp.unblockPage();
                    }, 2000);
                });

                $("#hnotfy").click(function() {
                    $("#headerMain").fadeOut(1000);
                });

            });
        toastr.options = {
            "positionClass" : "toast-top-right",
            "closeButton" : false,
            "debug" : false,
            "newestOnTop" : false,
            "progressBar" : true,
            "preventDuplicates" : false,
            "onclick" : null,
            "showDuration" : "300",
            "hideDuration" : "1000",
            "timeOut" : "5000",
            "extendedTimeOut" : "1000",
            "showEasing" : "swing",
            "hideEasing" : "linear",
            "showMethod" : "fadeIn",
            "hideMethod" : "fadeOut"
          }
          function clearAllImports() {
                $.ajax({
                    url: "{{ url('/') }}"+'/list/import/clear/all',
                    type: 'GET',
                    success: function (data) {
                        if(data == 'success') {
                            location.reload();
                        } else {
                            alert("{{trans('common.label.note_no_list_found')}}");
                        }
                    }
                });
            }

            function clearAllExports() {
                $.ajax({
                    url: "{{ url('/') }}"+'/list/export/clear/all',
                    type: 'GET',
                    success: function (data) {
                        if(data == 'success') {
                            location.reload();
                        } else {
                            alert("{{trans('common.label.note_no_list_found')}}");
                        }
                    }
                });
            }
            function clearAllExportsFiles() {
                $.ajax({
                    url: "{{ route('clear.all.exports.suppression.files') }}",
                    type: 'GET',
                    success: function (data) {
                        if(data == 'success') {
                            location.reload();
                        } else {
                            alert("{{trans('common.label.note_no_list_found')}}");
                        }
                    }
                });
            }
             $("body").on("click" , "#download_dependencies" , function() {

                $("#download_dependencies").html('<i class="la la-refresh fa-spin"></i>');
                $.ajax({
                    url: "{{url('download_dependencies')}}",
                    complete:function(data){
                        if(data == "Unauthorized") { 
                            Command: toastr["error"] ("@lang('common.message.license_verification_failed')");
                            $("#geoipDownloadFailed").show();
                            return false;
                        }

                        $("#download_dependencies_msg").html("Finished..");
                        $("#download_dependencies").html('@lang('common.label.geoip_dependencies')');
                    },
                    success: function(data) {
                         if (typeof data.success !== 'undefined' && data.success==0) {
                             Command: toastr["error"] (data.message);  
                             return false; 
                            }
                        Command: toastr["success"] ("@lang('common.message.GeoIP_updated')");
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    },
                    error: function(data) { 
                        if(data == "Unauthorized") { 
                            Command: toastr["error"] ("@lang('common.message.license_verification_failed')");
                            $("#geoipDownloadFailed").show();
                            return false;
                        }
                        
                        $("#download_dependencies").hide();
                        
                    }
                });
            });
</script>
  <!--begin::Session Timeout -->
@php($auth_user = getAuthUser())
@php($session_idle_time = \Illuminate\Support\Facades\Config::get('session.lifetime')*60*1000-20000)
<?php
$sessionFile = '';
$cookie = $_COOKIE;
if(isset($cookie))
{
    if(isset($cookie['sid']))
        $sessionFile = $cookie['sid'];
    $remember = substr(substr($sessionFile,0,-5), -1);
}
?>
@if(!is_null($auth_user) && !$remember && !in_array($currenRoute,['redirectAdmin','dashboard']))
<script type="text/javascript">
    ! function(a) {
        "use strict";
        a.sessionTimeout = function(b) {
            function c() {
                n || (a.ajax({
                    type: i.ajaxType,
                    url: i.keepAliveUrl,
                    data: i.ajaxData
                }), n = !0, setTimeout(function() {
                    n = !1
                }, i.keepAliveInterval))
            }
            function d() {
                clearTimeout(g), (i.countdownMessage || i.countdownBar) && f("session", !0), "function" == typeof i.onStart && i.onStart(i), i.keepAlive && c(), g = setTimeout(function() {
                    "function" != typeof i.onWarn ? a("#session-timeout-dialog").modal("show") : i.onWarn(i), e()
                }, i.warnAfter)
            }
            function e() {
                clearTimeout(g), a("#session-timeout-dialog").hasClass("in") || !i.countdownMessage && !i.countdownBar || f("dialog", !0), g = setTimeout(function() {
                    "function" != typeof i.onRedir ? window.location = i.redirUrl : i.onRedir(i)
                }, i.redirAfter - i.warnAfter)
            }
            function f(b, c) {
                clearTimeout(j.timer), "dialog" === b && c ? j.timeLeft = Math.floor((i.redirAfter - i.warnAfter) / 1e3) : "session" === b && c && (j.timeLeft = Math.floor(i.redirAfter / 1e3)), i.countdownBar && "dialog" === b ? j.percentLeft = Math.floor(j.timeLeft / ((i.redirAfter - i.warnAfter) / 1e3) * 100) : i.countdownBar && "session" === b && (j.percentLeft = Math.floor(j.timeLeft / (i.redirAfter / 1e3) * 100));
                var d = a(".countdown-holder"),
                    e = j.timeLeft >= 0 ? j.timeLeft : 0;
                if (i.countdownSmart) {
                    var g = Math.floor(e / 60),
                        h = e % 60,
                        k = g > 0 ? g + "m" : "";
                    k.length > 0 && (k += " "), k += h + "s", d.text(k)
                } else d.text(e + "s");
                i.countdownBar && a(".countdown-bar").css("width", j.percentLeft + "%"), j.timeLeft = j.timeLeft - 1, j.timer = setTimeout(function() {
                    f(b)
                }, 1e3)
            }
            var g, h = {
                    title: "@lang('common.session.expire_alert')",
                    message: "@lang('common.session.expire_alert')",
                    logoutButton: "@lang('common.session.logout')",
                    keepAliveButton: "@lang('common.session.stay_connected')",
                    keepAliveUrl: "/keep-alive",
                    ajaxType: "POST",
                    ajaxData: "",
                    redirUrl: "{{route('redirect')}}",
                    logoutUrl: "{{route('sessionDestroy')}}",
                    warnAfter: 9e5,
                    redirAfter: 12e5,
                    keepAliveInterval: 5e3,
                    keepAlive: !0,
                    ignoreUserActivity: !1,
                    onStart: !1,
                    onWarn: !1,
                    onRedir: !1,
                    countdownMessage: !1,
                    countdownBar: !1,
                    countdownSmart: !1
                },
                i = h,
                j = {};
            if (b && (i = a.extend(h, b)), i.warnAfter >= i.redirAfter) return console.error("{{trans('sending_nodes.include_common_script_blade.return_bootstrap_session')}}"), !1;
            if ("function" != typeof i.onWarn) {
                var k = i.countdownMessage ? "<p>" + i.countdownMessage.replace(/{timer}/g, '<span class="countdown-holder"></span>') + "</p>" : "",
                    l = i.countdownBar ? '<div class="progress"><div class="progress-bar bg-success progress-bar-striped countdown-bar active" role="progressbar" style="min-width: 15px; width: 100%;"><span class="countdown-holder"></span></div></div>' : "";
                a("body").append('<div class="modal fade" id="session-timeout-dialog" tabindex="-1" role="dialog" aria-labelledby="integration" data-backdrop="static" data-keyboard="false" aria-modal="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">' + i.title + '</h4></div><div class="modal-body"><p>' + i.message + "</p> " + k + "  " + l + ' </div><div class="modal-footer"><button id="session-timeout-dialog-logout" type="button" class="btn btn-default btn-sm">' + i.logoutButton + '</button><button id="session-timeout-dialog-keepalive" type="button" class="btn btn-success btn-sm" data-dismiss="modal">' + i.keepAliveButton + '</button></div></div></div></div><form id="logout-frm" action="{{route('sessionDestroy')}}" method="POST" style="display: none;"><input type="hidden" name="_token" value="{{Session::token()}}"><input type="hidden" name="user_id" value="{{Auth::id()}}"></form>'), a("#session-timeout-dialog-logout").on("click", function() {
            $('#logout-frm').submit();
                }), a("#session-timeout-dialog").on("hide.bs.modal", function() {
                    d()
                })
            }
            if (!i.ignoreUserActivity) {
                var m = [-1, -1];
                a(document).on("keyup mouseup mousemove touchend touchmove", function(b) {
                    if ("mousemove" === b.type) {
                        if (b.clientX === m[0] && b.clientY === m[1]) return;
                        m[0] = b.clientX, m[1] = b.clientY
                    }
                    d(), a("#session-timeout-dialog").length > 0 && a("#session-timeout-dialog").data("bs.modal") && a("#session-timeout-dialog").data("bs.modal").isShown && (a("#session-timeout-dialog").modal("hide"), a("body").removeClass("modal-open"), a("div.modal-backdrop").remove())
                })
            }
            var n = !1;
            d()
        }
    }(jQuery);
    "use strict";
    var KTSessionTimeoutDemo = function () {
        var initDemo = function () {
            $.sessionTimeout({
                title: '{{trans('settings.app_setting.pop_up_label.idle_timeout')}}',
                message: '{{trans('settings.app_setting.alert.before_logout')}}',
                keepAliveUrl: '{{route('sessionAlive')}}',
                redirUrl: '{{route('redirect')}}',
                logoutUrl: '{{route('sessionDestroy')}}',
                warnAfter: {{$session_idle_time}}, //warn after 5 seconds
                redirAfter: {{$session_idle_time}}+21000, //redirect after 10 secons,
                ignoreUserActivity: true,
                countdownMessage: 'Logout in {timer} seconds.',
                countdownBar: true
            });
        }
        return {
            //main function to initiate the module
            init: function () {
                initDemo();
            }
        };
    }();
    jQuery(document).ready(function() {  
        setTimeout(function(){ KTSessionTimeoutDemo.init(); }, 16000);  
        
    });
    
    
</script>
<?php 
$license_attributes = json_decode(getSetting("license_attributes"), true);
$package = "";
if(!empty($license_attributes["package"])) { 
    $package = $license_attributes["package"];
}

if($package == "Personal" || $package == "Professional") {
?>
    <script> 
            $(function() {
                $(".bulltOpt ").hide();
                
            });
    </script>
<?php } ?>

@endif
<!--end::Session Timeout -->