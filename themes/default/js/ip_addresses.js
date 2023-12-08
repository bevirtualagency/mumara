/***************************** Allowed IPs *********************************/
function gen_random_num(){
	var pre_random = undefined;
	do{
		var ran = Math.floor(Math.random() * (10));
		pre_random=ran;
	}
	while(ran!=pre_random)
	return ran;
}

function load_IPdetails(policies,IP_details)
{
	if(de("allowedIP_exception"))
	{
		$("#allowedIP_exception").remove();
		$("#AllowedIP_box #all_ip_show").removeClass("hide");
	}
	if(IP_details.exception_occured!=undefined	&&	IP_details.exception_occured)
	{
		$( "#AllowedIP_box .box_info" ).after("<div id='allowedIP_exception' class='box_content_div'>"+$("#exception_tab").html()+"</div>" );
		$("#allowedIP_exception #reload_exception").attr("onclick","reload_exception(AllowedIP,'AllowedIP_box')");
		$("#AllowedIP_box #all_ip_show").addClass("hide");
		return;
	}
	
	//var index = from_IP.indexOf("remote_ip");
	var count=0;
//	if(from_IP.length>1)
//	{
	if(!jQuery.isEmptyObject(IP_details.IPs))
	{
		var from_IPs=timeSorting(IP_details.IPs);
		
		$("#no_ip_add_here").hide();
		$("#IP_content").show();
		
		if(IP_details.IPs[IP_details.remote_ip]!=undefined)
		{
			$("#current_ip").hide();
			$("#allowed_ip_entry0").hide();
		}
		else
		{
			
			
			$("#current_ip").show();
			$("#current_ip .ip_blue").html(IP_details.remote_ip);
			$("#cur_ip").val(IP_details.remote_ip);
			
			//warning msg that the current ip is not allowed
			$("#allowed_ip_entry0").show();
			$("#IP_content .alone_current_ip").html(formatMessage("<div class='note_ip'>"+note+" </div><div class='ip_note_desc'>"+current_to_wanrning+"</div>",IP_details.remote_ip));
			$("#allowed_ip_entry0").attr("onclick","show_get_name('"+IP_details.remote_ip+"','"+IP_details.remote_ip+"',"+true+",0);");
			$("#allowed_ip_entry0 #ip_range_forNAME").html(IP_details.remote_ip);
			$("#allowed_ip_info0").attr("onclick","show_get_name('"+IP_details.remote_ip+"','"+IP_details.remote_ip+"',"+true+",0);");
			
		}
//		if (index > -1) 
//		{
//			from_IP.splice(index, 1);
//		}
		$("#IPdisplay_others").html("");
		
		for(iter=0;iter<Object.keys(IP_details.IPs).length;iter++)
		{
			count++;
			var current_from_IP=IP_details.IPs[from_IPs[iter]];
			
			IPdisplay_format = $("#empty_ip_format").html();
			$("#IPdisplay_others").append(IPdisplay_format);
			
			$("#IPdisplay_others #allowed_ip_entry").attr("id","allowed_ip_entry"+count);
			$("#IPdisplay_others #allowed_ip_info").attr("id","allowed_ip_info"+count);
			//$("#IPdisplay_others #allowed_ip_info_rename").attr("id","allowed_ip_info_rename"+count);
			
			$("#allowed_ip_entry"+count).attr("onclick","show_selected_ip_info("+count+");");
		      
			if(count > 2)
			{
				$("#allowed_ip_entry"+count).addClass("allowed_ip_entry_hidden");  
			}

			$("#allowed_ip_entry"+count+" .range_name").html(current_from_IP.display_name);
			$("#allowed_ip_entry"+count+" #range_name").html(current_from_IP.display_name);
			$("#allowed_ip_entry"+count+" .device_time").html(current_from_IP.created_time_elapsed);
			//$("#allowed_ip_entry"+count+" #ip_pencil").attr("onclick","show_get_name('"+current_from_IP.from_ip+"','"+current_from_IP.to_ip+"',true,"+count+");");
			$("#allowed_ip_entry"+count+" .device_pic").addClass(color_classes[gen_random_value()]);
			$("#allowed_ip_entry"+count+" .device_pic").html(current_from_IP.display_name.substr(0,2).toUpperCase());
			
			
			if(current_from_IP.from_ip==current_from_IP.to_ip||current_from_IP.to_ip==undefined)//Static IP check
			{
				$("#allowed_ip_entry"+count+" .IP_tab_info").html(current_from_IP.from_ip);
				$("#allowed_ip_info"+count+" .static").html(current_from_IP.from_ip);
				$("#allowed_ip_info"+count+" .range").hide();
				$("#allowed_ip_info"+count+" .static").show();
			}
			else
			{
				$("#allowed_ip_entry"+count+" .IP_tab_info").html(current_from_IP.from_ip+" - "+current_from_IP.to_ip);
				$("#allowed_ip_info"+count+" .range").html(current_from_IP.from_ip+" - "+current_from_IP.to_ip);
				$("#allowed_ip_info"+count+" .range").show();
				$("#allowed_ip_info"+count+" .static").hide();
			}
			$("#allowed_ip_info"+count+" #pop_up_time").html(current_from_IP.created_date);
			if(current_from_IP.location!=undefined)
			{
				$("#allowed_ip_entry"+count+" .asession_location").removeClass("location_unavail");
				$("#allowed_ip_entry"+count+" .asession_location").text(current_from_IP.location);
				$("#allowed_ip_info"+count+" #pop_up_location").removeClass("unavail");
				$("#allowed_ip_info"+count+" #pop_up_location").text(current_from_IP.location);
			}
			$("#allowed_ip_info"+count+" #current_session_logout").attr("onclick","deleteip('"+current_from_IP.from_ip+"','"+current_from_IP.to_ip+"')");
			
		}	 
		if(count<3)//less THAN 3
		{
			$("#ip_justaddmore").show();
			$("#IP_add_view_more").hide();
		}
		else
		{
			$("#ip_justaddmore").hide();
			$("#IP_add_view_more").show();
		}
	}
	else
	{
		$("#no_ip_add_here").show();
		$("#IP_content").hide();
		
		$("#current_ip").show();
		$("#current_ip .ip_blue").html(IP_details.remote_ip);
		$("#cur_ip").val(IP_details.remote_ip);
		$("#ip_justaddmore").hide();
		$("#IP_add_view_more").hide();
	}
	
	  
	
}


function show_selected_ip_info(id)
{	
	if(!$(popup_ip_new).is(":visible")){
		$("#allowed_ip_pop .device_pic").addClass($("#allowed_ip_entry"+id+" .device_pic")[0].className);
		$("#allowed_ip_pop .device_pic").html($("#allowed_ip_entry"+id+" .device_pic").html());
		$("#allowed_ip_pop .device_name").html($("#allowed_ip_entry"+id+" .device_name").html()); //load into popuop
		$("#allowed_ip_pop #edit_ip_name").attr("onclick",$("#allowed_ip_entry"+id+" #ip_pencil").attr("onclick"));
		$("#allowed_ip_pop .device_time").html($("#allowed_ip_entry"+id+" .device_time").html()); //load into popuop
		
		$("#allowed_ip_pop #ip_current_info").html($("#allowed_ip_info"+id).html()); //load into popuop
		
		
		//popup_blurHandler('6','.5');
		$("#allowed_ip_pop").show(0,function(){
			$("#allowed_ip_pop").addClass("pop_anim");
		});
		//control_Enter("a"); ///No I18N
		$("#current_session_logout").focus();
		//closePopup(closeview_selected_ip_view,"allowed_ip_pop"); //No I18N
	}
		
}
function closeview_selected_ip_view()
{
	popupBlurHide("#allowed_ip_pop"); //No I18N
	$("#allowed_ip_pop #edit_ip_name").attr("onclick","");
	$("#allowed_ip_pop a").unbind();
}

function closeview_all_ip_view(callback)
{
	popupBlurHide('#allow_ip_web_more',function(){ //No I18N
		$("#view_all_allow_ip").html("");
		if(callback)
		{
			callback();
		}
		
	});
	$(".aw_info a").unbind();
}

function show_all_ip()
{

	$("#view_all_allow_ip").html($("#all_ip_show").html()); //load into popuop
	popup_blurHandler('6','.5');
	
	$("#view_all_allow_ip .allowed_ip_entry_hidden").show();
	$("#view_all_allow_ip .authweb_entry").after( "<br />" );
	$("#view_all_allow_ip .authweb_entry").addClass("viewall_authwebentry");
	$("#view_all_allow_ip .allowed_ip_entry").removeAttr("onclick");
	if($("#view_all_allow_ip #allowed_ip_info0").length==1) 
	{ 
		$("#view_all_allow_ip #allowed_ip_info0").removeAttr("onclick"); 
		$("#view_all_allow_ip #allowed_ip_info0 #add_current_ip").attr("onclick","add_current_ip()"); 
		
	}
	
	$("#view_all_allow_ip .info_tab").show();

	//$("#view_all_allow_ip .asession_action").hide();

	//$("#view_all_allow_ip .asession_action").hide();

	//$("#view_all_allow_ip .ip_pencil").hide();
	
	$("#allow_ip_web_more").show(0,function(){
		$("#allow_ip_web_more").addClass("pop_anim");
	});
	
	
	
	
}





function add_new_ip_popup()
{

	$("#popup_ip_new").modal("show");

	if($("#current_ip").css("display")=="none"){
		$('#static_ip_sel').prop("checked", true);
		$("#range_ip").hide();
		$("#static_ip").show();	
        $("#static_ip .one_cell").focus();
        /*var ip_name = $("#ip_name").val();
        var ip_name2 = ip_name.substring(0, 2);
        var ip_address = $(".base-ip-name").html();
        $("#add_new_ip").click(function() {
        	alert(ip_name + ip_address + "second Time");
        });*/
	}
	else{
		$('#current_ip_sel').prop("checked", true);
		$("#range_ip").hide();
		$("#static_ip").hide();	
	}
	/*$("#popup_ip_new").show(0,function(){
		$("#popup_ip_new").addClass("pop_anim");
	});*/
	$("#ip_name_bak").show();
	$("#get_ip").show();
	$("#get_name").hide();
	//popup_blurHandler('6','.5');
	$("#ip_name_bak").show();
	$("#add_new_ip").show();
	$("#add_name_old_ip").hide();
	$("#back_name_old_ip").hide();
	$("#allowedipform").attr("onsubmit","return addipaddress(this)");
	$('input[name=ip_select]').change(function () {
        var val=$(this).val();
        if(val=="1")
        {
        	$("#static_ip").slideUp(300);
        	$("#range_ip").slideUp(300);
        }
        else if(val=="2")
        {
        	$("#static_ip").slideDown(300);
        	$("#range_ip").slideUp(300);
        	$(".sip .ip_field_cell:first").focus();
        }
        else
        {
        	$("#static_ip").slideUp(300);
        	$("#range_ip").slideDown(300);////for inline block
        	$(".fip .ip_field_cell:first").focus();
        }
    });

	$(".ip_field_cell").click(function()
	{
		var parent=$(this).parent();
		var ips_cell=parent.children('.ip_field_cell');//No I18N
		if($(this).val().length==0)
		{
			$(this).focus();
		}
		else
		{
			for(var i=0;i<4;i++)
			{
				if(ips_cell[i].value.length==0)
				{
					ips_cell[i].focus();
					break;
				}
			}
		}
	});
	$(".ip_field_cell").focus(function()
	{
		$(this).parent().css("border","2px solid #10bc83");
		$(this).select();
	});
	$(".ip_field_cell").blur(function()
	{
		$(this).parent().css("border","2px solid #ccc");
	});

	$(".ip_field_cell").keyup(function(ele)
			{
			var e=ele.keyCode;
			
			if(e=="190")//for '.'
			{
				this.value=this.value.substring(0, this.value.length - 1);
				if(this.value!="")
				{
					var $next = $(this).next().next();
					  if ($next.hasClass("ip_field_cell"))
					  {
						  $next.focus();
					  }
				}
				
			}
			if(e==8 || e==46)
			{
				if(this.value.length==0)
				{
					var $before = $(this).prev().prev();
					  if ($before.hasClass("ip_field_cell"))
					  {
						  $before.focus();
					  }
				}
			}
			if (this.value.length == this.maxLength) 
				{
					  var $next = $(this).next().next();
					  if ($next.hasClass("ip_field_cell"))
						  {
						  	$next.focus();
						  }
					   return;
				}
			});
	//closePopup(close_new_ip_popup,"popup_ip_new");//No I18N
	$("#popup_ip_new .real_radiobtn:first").focus();
}

function isNumberKey(evt)
{
	remove_error();
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    {
    	return false;
    }
    return true;
}


function close_new_ip_popup()
{
	popupBlurHide('#popup_ip_new',function(){ //No I18N
		closeview_selected_ip_view();
	});
	
	$( ".ip_field_cell").unbind( "keyup" );

	$("#ip_name_bak").show();
	$("#add_new_ip").show();
	
	$("#add_name_old_ip").hide();
	$("#back_name_old_ip").hide();
	
	$("#get_ip").show();
	$("#get_name").hide();
	
	$(".ip_impt_note").hide();
}



function addipaddress(f) 
{
	remove_error();
	var val= f.ip_select.value.trim();
	var fip;
    var tip;
	if(val==1)
	{
		fip=tip=f.cur_ip.value.trim();
	}
	else if(val==2)
	{
		fip=tip=$("#static_ip .1_cell").val()+"."+$("#static_ip .2_cell").val()+"."+$("#static_ip .3_cell").val()+"."+$("#static_ip .4_cell").val();
		tip=tip.trim();
		fip=fip.trim();
	}
	else if(val==3)
	{
		fip=$("#range_ip .fip .1_cell").val()+"."+$("#range_ip .fip .2_cell").val()+"."+$("#range_ip .fip .3_cell").val()+"."+$("#range_ip .fip .4_cell").val();
		tip=$("#range_ip .tip .1_cell").val()+"."+$("#range_ip .tip .2_cell").val()+"."+$("#range_ip .tip .3_cell").val()+"."+$("#range_ip .tip .4_cell").val();
		tip=tip.trim();
		fip=fip.trim();
	}
    if(isEmpty(fip)) 
    {
    	if($('input[name=ip_select]:checked').val()=="2")
    	{
    		$('#static_ip').append( '<div class="field_error">Please enter a valid IP address</div>' );
    	}
    	else
    	{
    		$('#range_ip').append( '<div class="field_error">Please enter a valid IP address</div>' );    	
    	}
    }
    else if(!isIP(fip)) 
    {
    	if($('input[name=ip_select]:checked').val()=="2")
    	{
    		$('#static_ip').append( '<div class="field_error">Please enter a valid IP address</div>' );
    	}
    	else
    	{
    		$('#range_ip').append( '<div class="field_error">Please enter a valid IP address<br /></div>' );    	
    	}
    }
    else if(!isEmpty(tip) && !isIP(tip)) 
    {
		$('#range_ip').append( '<div class="field_error">Please enter a valid IP address</div>' );    	

    }
    else 
    {
    	show_get_name(fip,tip,false);
    	
    }
    closePopup(close_new_ip_popup,"popup_ip_new",true);//No I18N

    $("#ip_name").focus();
    return false;
}

function show_get_name(fip,tip,is_directly,id)
{

		closeview_selected_ip_view();
		$("#popup_ip_new").show(0,function(){
			$("#popup_ip_new").addClass("pop_anim");
		});

		if(is_directly)
		{
			$("#ip_name_bak").hide();
		}
		$("#get_ip").hide();
		$("#get_name").show();

			$(".ip_impt_note").show();

		if($("#allowed_ip_pop").is(":visible"))
		{
			$("#back_name_old_ip").show();
		}
		
		if(fip && tip)
		{
			$("#fip").val(fip);
			$("#tip").val(tip);
			if(fip==tip)
			{
				$("#ip_range_forNAME").html(fip);
			}
			else
			{
				$("#ip_range_forNAME").html(fip+" - "+tip);
			}
		}
		$("#get_name #ip_name").val($("#allowed_ip_entry"+id+" #range_name").html());
		
		popup_blurHandler('6','.5');
		$("#allowedipform").attr("onsubmit","return add_ip_with_name(this)");
		control_Enter("a");//No i18N
		closePopup(close_new_ip_popup,"popup_ip_new"); //No I18N
		$("#ip_name").focus();
		return false;

}

function add_ip_with_name(form)
{
	
	if(validateForm(form))
    {
		disabledButton(form);
		var from = $("#fip").val();
		var to = $("#tip").val();
		var name=$("#get_name #ip_name").val();
		
    		var parms=
    		{
    				"f_ip":from,//No I18N
    				"t_ip":to,//No I18N
    				"ip_name":name//No I18N
    		};


    		var payload = AllowedIPObj.create(parms);
    		payload.POST("self","self").then(function(resp)	//No I18N
    		{
    			SuccessMsg(getErrorMessage(resp));

    			if(security_data.AllowedIPs.IPs==undefined)
    			{
    				security_data.AllowedIPs.IPs=[];
    			}
    			
    			security_data.AllowedIPs.IPs[resp.allowedip.from_ip]=resp.allowedip;
    			
    			load_IPdetails(security_data.Policies,security_data.AllowedIPs);
    			
    			$('#allowedipform')[0].reset();
    			close_new_ip_popup();
    			removeButtonDisable(form);
    		},
    		function(resp)
    		{
    			if(resp.cause && resp.cause.trim() === "invalid_password_token") 
    			{
    				relogin_warning(resp.message);
    				var service_url = euc(window.location.href);
    				$("#new_notification").attr("onclick","window.open('"+contextpath + resp.redirect_url +"?serviceurl="+service_url+"&post="+true+"', '_blank');");//No I18N 
    			}
    			else
    			{
    				showErrorMessage(getErrorMessage(resp));
    			}
    			removeButtonDisable(form); 
    		});	
    }
	return false;
}


function add_current_ip()
{
	var parms=
	{
			"f_ip":security_data.AllowedIPs.remote_ip,//No I18N
			"t_ip":security_data.AllowedIPs.remote_ip,//No I18N
			"ip_name":$("#view_all_allow_ip #allowed_ip_info0 #new_ip_name").val()//No I18N
	};


	var payload = AllowedIPObj.create(parms);
	payload.POST("self","self").then(function(resp)	//No I18N
	{
		SuccessMsg(getErrorMessage(resp));

		security_data.AllowedIPs.IPs[resp.allowedip.from_ip]=resp.allowedip;
		
		load_IPdetails(security_data.Policies,security_data.AllowedIPs);
		
		$('#allowedipform')[0].reset();
		if($("#allow_ip_web_more").is(":visible")==true)
		{
			var lenn=Object.keys(security_data.AllowedIPs.IPs).length;
			if(lenn > 1){
				closeview_all_ip_view(show_all_ip);
			}
			else{
				closeview_all_ip_view();
			}
		}
		else{
			closeview_all_ip_view();
		}
	},
	function(resp)
	{
		if(resp.cause && resp.cause.trim() === "invalid_password_token") 
		{
			relogin_warning(resp.message);
			var service_url = euc(window.location.href);
			$("#new_notification").attr("onclick","window.open('"+contextpath + resp.redirect_url +"?serviceurl="+service_url+"&post="+true+"', '_blank');");//No I18N 
		}
		else
		{
			showErrorMessage(getErrorMessage(resp));
		}
	});	
}

function deleteip(fip,tip)
{		    
			new URI(AllowedIPObj,"self","self",fip).DELETE().then(function(resp)	//No I18N
			{
				SuccessMsg(getErrorMessage(resp));
				delete security_data.AllowedIPs.IPs[fip];
				load_IPdetails(security_data.Policies,security_data.AllowedIPs);
				closeview_selected_ip_view();
				if($("#allow_ip_web_more").is(":visible")==true){
					lenn=Object.keys(security_data.AllowedIPs.IPs).length;
					if(lenn > 1)
					{
						closeview_all_ip_view(show_all_ip);
					}
					else
					{
						closeview_all_ip_view();
					}
				}

			},
			function(resp)
			{
				if(resp.cause && resp.cause.trim() === "invalid_password_token") 
				{
					relogin_warning(resp.message);
					var service_url = euc(window.location.href);
					$("#new_notification").attr("onclick","window.open('"+contextpath + resp.redirect_url +"?serviceurl="+service_url+"&post="+true+"', '_blank');");//No I18N 
				}
				else
				{
					showErrorMessage(getErrorMessage(resp));
				}
			});
}

function change_ip_only_name()
{
	var from = $("#fip").val();
	var to = $("#tip").val();
	var name=$("#get_name #ip_name").val();
	
	var parms=
	{
			"t_ip":to,//No I18N
			"ip_name":name//No I18N
	};
	var payload = AllowedIPObj.create(parms);
	payload.PUT("self","self",from).then(function(resp)	//No I18N
	{
		SuccessMsg(getErrorMessage(resp));
		
		security_data.AllowedIPs.IPs.from_ip.display_name=name;
		
		load_IPdetails(security_data.Policies,security_data.AllowedIPs);
		$('#allowedipform')[0].reset();
		close_new_ip_popup();
	},
	function(resp)
	{
		if(resp.cause && resp.cause.trim() === "invalid_password_token") 
		{
			relogin_warning(resp.message);
			var service_url = euc(window.location.href);
			$("#new_notification").attr("onclick","window.open('"+contextpath + resp.redirect_url +"?serviceurl="+service_url+"&post="+true+"', '_blank');");//No I18N 
		}
		else
		{
			showErrorMessage(getErrorMessage(resp));
		}
		if($("#allow_ip_web_more").is(":visible")){
			closeview_all_ip_view(show_all_ip);
		}
		else{
			close_new_ip_popup();
		}
	});	
    return false;
}




function back_to_info()
{
	$("#popup_ip_new").hide();
	
}
function back_to_addip()
{
	$("#get_ip").show();
	$("#get_name").hide();
	$(".ip_impt_note").hide();
    $(".popuphead_define .ip_note").hide();
	$("#allowedipform").attr("onsubmit","return addipaddress(this)");
	return false;
}

/*function add_new_ip_popup() {

}*/