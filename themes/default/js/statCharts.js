function todayStats(url) {
    var sizes = ['K', 'M', 'G'];
    var campaign_id = $("#purpose2").val();
    var campaignData = "";
    if(campaign_id>0){
        campaignData="&campaign_id="+campaign_id;
    }
    route = url+"/today-stats?i=" + Math.random() * 100+campaignData;
    
    type = 'Hour';
    var fields_array = [];
    var createGraph = AmCharts.makeChart("chartdiv01", {
        "type": "serial",
        "theme": "light",
        "marginTop": 0,
        "marginRight": 20,
        "dataLoader": {
            "url": route,
            "format": "json",
            "complete": function (createGraph) {
                var chartData = createGraph.dataProvider;
                var delivered = 0;
                var sent = 0;
                var failed = 0;
                var spammed = 0;
                var opened = 0;
                var clicked = 0;
                $.each(chartData, function (key, value) {
                    sent += Number(value.sent);
                    spammed += Number(value.spammed);
                    failed += Number(value.failed);
                    opened += Number(value.opened);
                    clicked += Number(value.clicked);
					delivered += Number(value.delivered);
                });
        
                if(sent > 999 && sent < 999999) {
                    sentk = (sent/1000).toFixed(1) + 'K';
                }
                else if(sent > 999999 && sent < 999999999) {
                    sentk = (sent/1000000).toFixed(1) + 'M';
                }
                else if(sent > 999999999) {
                    sentk = (sent/1000000000).toFixed(2) + "B";
                }
                else{
                    sentk = sent;
                }
				
				if(delivered > 999 && delivered < 999999) {
                    deliverk = (delivered/1000).toFixed(1) + 'K';
                }
                else if(delivered > 999999 && delivered < 999999999) {
                    deliverk = (delivered/1000000).toFixed(1) + 'M';
                }
                else if(delivered > 999999999) {
                    deliverk = (delivered/1000000000).toFixed(2) + "B";
                }
                else{
                    deliverk = delivered;
                }

                if (sent > 0) {
                    spammedPercentAge = Math.round(spammed / (sent) * 100);
                    failedPercentAge = Math.round(failed / (sent) * 100);
                    openedPercentAge = Math.round(opened / (sent) * 100);
                    clickedPercentAge = Math.round(clicked / (sent) * 100);
                } else {
                    spammedPercentAge = 0;
                    failedPercentAge = 0;
                    openedPercentAge = 0;
                    clickedPercentAge = 0;
                }

                $('.visits').data('easyPieChart').update(sent);
                $('.opened').data('easyPieChart').update(openedPercentAge);
                $('.clicked').data('easyPieChart').update(clickedPercentAge);
                $('.spammed').data('easyPieChart').update(spammedPercentAge);
                $('.bounce').data('easyPieChart').update(failedPercentAge);
           
                
                $('#sentP').html(sent);
                $('#sentPP').html(sentk);
                $('#spammedSP').html(nFormatter(spammed, 1));
                $('#failedSP').html(nFormatter(failed, 1));
                $('#openedSP').html(nFormatter(opened, 1));
                $('#clickedSP').html(nFormatter(clicked, 1));

                $(document).ready(function () {
                    $("#sent").find("canvas").attr("title", sent);
                    $("#spammed").find("canvas").attr("title", spammed);
                    $("#failed").find("canvas").attr("title", failed);
                    $("#opened").find("canvas").attr("title", opened);
                    $("#clicked").find("canvas").attr("title", clicked);
                });
				
		var sent_f = {
			"id": "g1",
			"balloonText": ""+type+": [[category]]<br>Sent <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "blue",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "sent"
		};
		var spam_f = {
			"id": "g2",
			"balloonText": ""+type+": [[category]]<br>Spammed <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "grey",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "spammed"
		};
		var failed_f = {
			"id": "g3",
			"balloonText": ""+type+": [[category]]<br>Failed <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "red",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "failed"
		};
		var opened_f = {
			"id": "g4",
			"balloonText": ""+type+": [[category]]<br>Opened <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "green",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "opened"
		};
		var clicked_f = {
			"id": "g5",
			"balloonText": ""+type+": [[category]]<br>Clicked <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "purple",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "clicked"
		};
		
		var delivered_f = {
			"id": "g6",
			"balloonText": ""+type+": [[category]]<br>Delivered <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "#1bbc9b",
			"lineThickness": 2,
			"negativeLineColor": "#1bbc9b",
			"valueField": "delivered"
		};
		
		
		    var key=0;
			if ($("#select_types option[value=sent]:selected").length > 0){
				fields_array[0]= sent_f;
			}
			if ($("#select_types option[value=spammed]:selected").length > 0){
				fields_array[1]= spam_f;
			}
			if ($("#select_types option[value=failed]:selected").length > 0){
				fields_array[2]= failed_f;
			}
			if ($("#select_types option[value=opened]:selected").length > 0){
				fields_array[3]= opened_f;
			}
			if ($("#select_types option[value=clicked]:selected").length > 0){
				fields_array[4]= clicked_f;
			}
			if ($("#select_types option[value=delivered]:selected").length > 0){
				fields_array[5]= delivered_f;
			}
			
			
            }
        },
        "balloon": {
            "cornerRadius": 6
        },
        "valueAxes": [{
                "axisAlpha": 0
            }],
        "graphs": fields_array,
        "chartScrollbar": {
            "graph": "g1",
            "gridAlpha": 0,
            "color": "#888888",
            "scrollbarHeight": 55,
            "backgroundAlpha": 0,
            "selectedBackgroundAlpha": 0.1,
            "selectedBackgroundColor": "#888888",
            "graphFillAlpha": 0,
            "autoGridCount": true,
            "selectedGraphFillAlpha": 0,
            "graphLineAlpha": 0.2,
            "graphLineColor": "#c2c2c2",
            "selectedGraphLineColor": "#888888",
            "selectedGraphLineAlpha": 1
        },
        "chartCursor": {
            "categoryBalloonDateFormat": "YYYY",
            "cursorAlpha": 0,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "valueLineAlpha": 0.5,
            "fullWidth": true
        },
        "dataDateFormat": "YYYY",
        "categoryField": "time",
        "categoryAxis": {
            "minPeriod": "YYYY",
            "parseDates": false,
            "minorGridAlpha": 0.1,
            "minorGridEnabled": true
        },
        "responsive": {
            "enabled": true
        }
    });
}
function nFormatter(num, digits) {
  const lookup = [
    { value: 1, symbol: "" },
    { value: 1e3, symbol: "K" },
    { value: 1e6, symbol: "M" },
    { value: 1e9, symbol: "G" },
    { value: 1e12, symbol: "T" },
    { value: 1e15, symbol: "P" },
    { value: 1e18, symbol: "E" }
  ];
  const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
  var item = lookup.slice().reverse().find(function(item) {
    return num >= item.value;
  });
  return item ? (num / item.value).toFixed(digits).replace(rx, "$1") + item.symbol : "0";
}
function getStats(id, url) {
    var campaign_id = $("#purpose2").val();
    var campaignData = "";
    if(campaign_id>0){
        campaignData="?campaign_id="+campaign_id;
    }
    
    if(id == 7 || id == 5 || id == 6 || id == 8 || id == 11){
        type = 'Day'
    }else if(id == 4){
        type = 'Hour';
    }else if(id == 9 || id == 10){
        type = 'Month';
    }/* else if(id == 3){
        todayStats();
        exit();
    } */

    var sizes = ['K', 'M', 'B'];

    //route = url + "/stats/" + id;  
    
    route = url + "/stats/" + id+campaignData;   

	var fields_array = [];

    var createGraph = AmCharts.makeChart("chartdiv01", {
        "type": "serial",
        "theme": "light",
        "marginTop": 0,
        "marginRight": 20,
        "dataLoader": {
            "url": route,
            "format": "json",
            "complete": function (createGraph) {
                var chartData = createGraph.dataProvider;
                var spammed = 0;
                var sent = 0;
                var failed = 0;
                var opened = 0;
                var clicked = 0;
                $.each(chartData, function (key, value) {
                    sent += Number(value.sent);
                    spammed += Number(value.spammed);
                    failed += Number(value.failed);
                    opened += Number(value.opened);
                    clicked += Number(value.clicked);
                });

                if(sent > 999 && sent < 999999) {
                    sentk = (sent/1000).toFixed(1) + 'K';
                }
                else if(sent > 999999 && sent < 999999999) {
                    sentk = (sent/1000000).toFixed(1) + 'M';
                }
                else if(sent > 999999999) {
                    sentk = (sent/1000000000).toFixed(2) + "B";
                }
                else{
                    sentk = sent;
                }

              
                if (sent > 0) {
                    spammedPercentAge = Math.round(spammed / (sent) * 100);
                    failedPercentAge = Math.round(failed / (sent) * 100);
                    openedPercentAge = Math.round(opened / (sent) * 100);
                    clickedPercentAge = Math.round(clicked / (sent) * 100);
                } else {
                    spammedPercentAge = 0;
                    failedPercentAge = 0;
                    openedPercentAge = 0;
                    clickedPercentAge = 0;
                }

                $('.visits').data('easyPieChart').update(sent);
                $('.opened').data('easyPieChart').update(openedPercentAge);
                $('.clicked').data('easyPieChart').update(clickedPercentAge);
                $('.spammed').data('easyPieChart').update(spammedPercentAge);
                $('.bounce').data('easyPieChart').update(failedPercentAge);

                $('#sentP').html(sent);
                $('#sentPP').html(sentk);
                $('#spammedSP').html(nFormatter(spammed, 1));
                $('#failedSP').html(nFormatter(failed, 1));
                $('#openedSP').html(nFormatter(opened, 1));
                $('#clickedSP').html(nFormatter(clicked, 1));

                // $('#sent').data('easyPieChart').update(sent/sent*100);
                // $('#opened').data('easyPieChart').update(opened/sent*100);
                // $('#clicked').data('easyPieChart').update(clicked/sent*100);
                // $('#spammed').data('easyPieChart').update(spammed/sent*100);
                // $('#failed').data('easyPieChart').update(failed/sent*100);

                // $('#sent').data('easyPieChart').update(sent);
                // $('#opened').data('easyPieChart').update(opened);
                // $('#clicked').data('easyPieChart').update(clicked);
                // $('#spammed').data('easyPieChart').update(spammed);
                // $('#failed').data('easyPieChart').update(failed);

                $(document).ready(function () {
                    $("#sent").find("canvas").attr("title", sent);
                    $("#spammed").find("canvas").attr("title", spammed);
                    $("#failed").find("canvas").attr("title", failed);
                    $("#opened").find("canvas").attr("title", opened);
                    $("#clicked").find("canvas").attr("title", clicked);
                });

				
				var sent_f = {
			"id": "g1",
			"balloonText": ""+type+": [[category]]<br>Sent <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "blue",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "sent"
		};
		var spam_f = {
			"id": "g2",
			"balloonText": ""+type+": [[category]]<br>Spammed <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "grey",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "spammed"
		};
		var failed_f = {
			"id": "g3",
			"balloonText": ""+type+": [[category]]<br>Failed <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "red",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "failed"
		};
		var opened_f = {
			"id": "g4",
			"balloonText": ""+type+": [[category]]<br>Opened <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "green",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "opened"
		};
		var clicked_f = {
			"id": "g5",
			"balloonText": ""+type+": [[category]]<br>Clicked <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "purple",
			"lineThickness": 2,
			"negativeLineColor": "#637bb6",
			"valueField": "clicked"
		};
        
        var delivered_f = {
			"id": "g6",
			"balloonText": ""+type+": [[category]]<br>Delivered <b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "#1bbc9b",
			"lineThickness": 2,
			"negativeLineColor": "#1bbc9b",
			"valueField": "delivered"
		};
        
        
		    var key=0;
			if ($("#select_types option[value=sent]:selected").length > 0){
				fields_array[0]= sent_f;
			}
			if ($("#select_types option[value=spammed]:selected").length > 0){
				fields_array[1]= spam_f;
			}
			if ($("#select_types option[value=failed]:selected").length > 0){
				fields_array[2]= failed_f;
			}
			if ($("#select_types option[value=opened]:selected").length > 0){
				fields_array[3]= opened_f;
			}
			if ($("#select_types option[value=clicked]:selected").length > 0){
				fields_array[4]= clicked_f;
            }
            if ($("#select_types option[value=delivered]:selected").length > 0){
				fields_array[5]= delivered_f;
            }
            
			
            }
        },

     
        "balloon": {
            "cornerRadius": 6
        },
        "valueAxes": [{
                "axisAlpha": 0
            }],
        "graphs": fields_array,
        "chartScrollbar": {
            "graph": "g1",
            "gridAlpha": 0,
            "color": "#888888",
            "scrollbarHeight": 55,
            "backgroundAlpha": 0,
            "selectedBackgroundAlpha": 0.1,
            "selectedBackgroundColor": "#888888",
            "graphFillAlpha": 0,
            "autoGridCount": true,
            "selectedGraphFillAlpha": 0,
            "graphLineAlpha": 0.2,
            "graphLineColor": "#c2c2c2",
            "selectedGraphLineColor": "#888888",
            "selectedGraphLineAlpha": 1

        },
        "chartCursor": {
            "categoryBalloonDateFormat": "YYYY",
            "cursorAlpha": 0,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "valueLineAlpha": 0.5,
            "fullWidth": true
        },
        "dataDateFormat": "YYYY",
        "categoryField": "time",
        "categoryAxis": {
            "minPeriod": "YYYY",
            "parseDates": false,
            "minorGridAlpha": 0.1,
            "minorGridEnabled": true
        },
        "responsive": {
            "enabled": true
        }
    });
}

function getCustomStats(from, to, url) {

    var sizes = ['K', 'M', 'G']; 
    var campaign_id = $("#purpose2").val();
    var campaignData = "";
    if(campaign_id>0){
        campaignData="?campaign_id="+campaign_id;
    }
    route = url + "/customstats/" + from + '/' + to+campaignData;  
    //route = url + "/customstats/" + from + '/' + to;   

    var createGraph = AmCharts.makeChart("chartdiv01", {
        "type": "serial",
        "theme": "light",
        "marginTop": 0,
        "marginRight": 20,
        "dataLoader": {
            "url": route,
            "format": "json",
            "complete": function (createGraph) {
                var chartData = createGraph.dataProvider;
                var spammed = 0;
                var sent = 0;
                var failed = 0;
                var opened = 0;
                var clicked = 0;
                $.each(chartData, function (key, value) {
                    sent += Number(value.sent);
                    spammed += Number(value.spammed);
                    failed += Number(value.failed);
                    opened += Number(value.opened);
                    clicked += Number(value.clicked);
                });
        
                if(sent > 999 && sent < 999999) {
                    sentk = (sent/1000).toFixed(1) + 'K';
                }
                else if(sent > 999999 && sent < 999999999) {
                    sentk = (sent/1000000).toFixed(1) + 'M';
                }
                else if(sent > 999999999) {
                    sentk = (sent/1000000000).toFixed(2) + "B";
                }
                else{
                    sentk = sent;
                }

                if (sent > 0) {
                    spammedPercentAge = Math.round(spammed / (sent) * 100);
                    failedPercentAge = Math.round(failed / (sent) * 100);
                    openedPercentAge = Math.round(opened / (sent) * 100);
                    clickedPercentAge = Math.round(clicked / (sent) * 100);
                } else {
                    spammedPercentAge = 0;
                    failedPercentAge = 0;
                    openedPercentAge = 0;
                    clickedPercentAge = 0;
                }

                $('.visits').data('easyPieChart').update(sent);
                $('.opened').data('easyPieChart').update(openedPercentAge);
                $('.clicked').data('easyPieChart').update(clickedPercentAge);
                $('.spammed').data('easyPieChart').update(spammedPercentAge);
                $('.bounce').data('easyPieChart').update(failedPercentAge);
                
                $('#sentP').html(sent);
                $('#sentPP').html(sentk);
                $('#spammedSP').html(spammed);
                $('#failedSP').html(failed);
                $('#openedSP').html(opened);
                $('#clickedSP').html(clicked);

                // $('#spammed').data('easyPieChart').update(spammed);
                // $('#sent').data('easyPieChart').update(sent);
                // $('#failed').data('easyPieChart').update(failed);
                // $('#opened').data('easyPieChart').update(opened);
                // $('#clicked').data('easyPieChart').update(clicked);
               
                $(document).ready(function () {
                    $("#sent").find("canvas").attr("title", sent);
                    $("#spammed").find("canvas").attr("title", spammed);
                    $("#failed").find("canvas").attr("title", failed);
                    $("#opened").find("canvas").attr("title", opened);
                    $("#clicked").find("canvas").attr("title", clicked);
                });


                
                // $(document).ready(function () {
                //     $("#sent").find("canvas").attr("title", sent);
                //     $("#spammed").find("canvas").attr("title", spammed);
                //     $("#failed").find("canvas").attr("title", failed);
                //     $("#opened").find("canvas").attr("title", opened);
                //     $("#clicked").find("canvas").attr("title", clicked);
                // });
            }
        },
        "balloon": {
            "cornerRadius": 6
        },
        "valueAxes": [{
                "axisAlpha": 0
            }],
        "graphs": [{
        "id": "g1",
        "balloonText": ""+type+": [[category]]<br>Sent <b><span style='font-size:14px;'>[[value]]</span></b>",
        "bullet": "round",
        "bulletSize": 8,
        "lineColor": "blue",
        "lineThickness": 2,
        "negativeLineColor": "#637bb6",
        "valueField": "sent"
    }, {
        "id": "g2",
        "balloonText": ""+type+": [[category]]<br>Spammed <b><span style='font-size:14px;'>[[value]]</span></b>",
        "bullet": "round",
        "bulletSize": 8,
        "lineColor": "grey",
        "lineThickness": 2,
        "negativeLineColor": "#637bb6",
        "valueField": "spammed"
    }, {
        "id": "g3",
        "balloonText": ""+type+": [[category]]<br>Failed <b><span style='font-size:14px;'>[[value]]</span></b>",
        "bullet": "round",
        "bulletSize": 8,
        "lineColor": "red",
        "lineThickness": 2,
        "negativeLineColor": "#637bb6",
        "valueField": "failed"
    }, {
        "id": "g4",
        "balloonText": ""+type+": [[category]]<br>Opened <b><span style='font-size:14px;'>[[value]]</span></b>",
        "bullet": "round",
        "bulletSize": 8,
        "lineColor": "green",
        "lineThickness": 2,
        "negativeLineColor": "#637bb6",
        "valueField": "opened"
    }, {
        "id": "g5",
        "balloonText": ""+type+": [[category]]<br>Clicked <b><span style='font-size:14px;'>[[value]]</span></b>",
        "bullet": "round",
        "bulletSize": 8,
        "lineColor": "purple",
        "lineThickness": 2,
        "negativeLineColor": "#637bb6",
        "valueField": "clicked"
    },{
        "id": "g6",
        "balloonText": ""+type+": [[category]]<br>Delivered <b><span style='font-size:14px;'>[[value]]</span></b>",
        "bullet": "round",
        "bulletSize": 8,
        "lineColor": "purple",
        "lineThickness": 2,
        "negativeLineColor": "#637bb6",
        "valueField": "clicked"
    }],
        "chartScrollbar": {
            "graph": "g1",
            "gridAlpha": 0,
            "color": "#888888",
            "scrollbarHeight": 55,
            "backgroundAlpha": 0,
            "selectedBackgroundAlpha": 0.1,
            "selectedBackgroundColor": "#888888",
            "graphFillAlpha": 0,
            "autoGridCount": true,
            "selectedGraphFillAlpha": 0,
            "graphLineAlpha": 0.2,
            "graphLineColor": "#c2c2c2",
            "selectedGraphLineColor": "#888888",
            "selectedGraphLineAlpha": 1

        },
        "chartCursor": {
            "categoryBalloonDateFormat": "YYYY",
            "cursorAlpha": 0,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "valueLineAlpha": 0.5,
            "fullWidth": true
        },
        "dataDateFormat": "YYYY",
        "categoryField": "time",
        "categoryAxis": {
            "minPeriod": "YYYY",
            "parseDates": false,
            "minorGridAlpha": 0.1,
            "minorGridEnabled": true
        },
        "responsive": {
            "enabled": true
        }
    });
}