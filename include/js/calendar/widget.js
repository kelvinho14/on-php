var Calendar = function() {


    return {
        //main function to initiate the module
        init: function() {
            Calendar.initCalendar();
        },
        
        showLoading: function(){
        	App.blockUI({
    			target: '#calendar',
    			boxed: true,
    			message: $('#loadcalmsg').val()
    		});
        },
        initCalendar: function() {

            if (!jQuery().fullCalendar) {
                return;
            }
            Calendar.showLoading();
            
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var h = {};

            if (App.isRTL()) {
                h = {
                    right: 'title',
                    center: '',
                    left: 'prev,next,today,month,agendaWeek,agendaDay'
                };
            } else {
                h = {
                    left: 'title',
                    center: '',
                    right: 'prev,next,today,month,agendaWeek,agendaDay'
                };
            }

            $('#calendar').fullCalendar('destroy'); // destroy the calendar
            $('#calendar').fullCalendar({ //re-initialize the calendar
                header: h,
                defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/ 
                slotMinutes: 15,
                lang: $('#calendar').attr('data-lang'),
                timeFormat: 'H:mm' ,
                /*displayEventEnd : true,*/
                /*allDayDefault:true,*/
                allDaySlot:true,
                dayClick: function(date, jsEvent, view) {
                    var now = new Date();
                    
                	if(new Date(date.format()) < new Date()){
                		return false
                	}
                	
                	$('#clickstart').val('');
                	$('#clickend').val('');
                	$('#clickstarttime').val('');
                	$('#clickendtime').val('');
                	if(date.format().indexOf('T')>0){
                		var clickdate = date.format().split('T');
                		var d = clickdate[0];
                    	var t = clickdate[1];
                    	$('#clickstarttime').val(t);
                    	
                    	var theTimeArr = t.split(":");
                    	var hr = parseInt(theTimeArr[0]);
                    	var sec = parseInt(theTimeArr[1]);
                    	if (hr < 23) {
                    	      t = (hr+1)+':'+sec;
                    	} 
                    	
                    	$('#clickendtime').val(t);
                	}else{
                		var d = date.format();
                		
                	}
                	
                	$('#clickstart').val(d);
                	$('#clickend').val(d);
                	$('#event_form').trigger( "click" );
                    
                },
                events: {
                    url: domainurl+'calendar/ajax_getdata/',
                    type: 'POST',
                    data: {
                    	filteruserid: $('#filteruserid').val(),
                        //mytask:$('#mytaskcheckbox').is(':checked')?1:0,
                        //event:$('#eventcheckbox').is(':checked')?1:0
                    },
                    success: function(doc) {
                    	App.unblockUI('#calendar');
                    	//$('.alert-info').find('.close').trigger( "click" );
                    	//$('.alert-info').trigger( "click" );
                    },
                    error: function() {
                    	//$('.alert-info').find('.close').trigger( "click" );
        				App.growl($('#getdataerror').val(),'danger');
        				
                    },
                },
                eventRender: function(event, element) {
                	
                	/*element.attr('data-content','a');
                    element.attr('data-placement','b');
                    element.attr('data-trigger','hover'); 
                    element.attr('data-container','body');*/
                	 var tooltip = event.Description;
                	 $(element).attr("data-original-title", tooltip)
                     $(element).tooltip({ container: "body"})
                    
                },
                loading:function(){
                	//alert('a');
                	//Calendar.showLoading();
                },
//                eventAfterAllRender:function(){
//                	//App.unblockUI('#calendar');
//                	//eventAfterRender
//                	alert('b');
//                },
                eventAfterRender:function(){
                	$('.fc-title').css("padding-left","5px");
                },
                eventClick: function(calEvent, jsEvent, view) {
                	//$('#vieweventdetailmodalbtn').attr("href","/calendar/ajax_timesheetdetail/?id="+calEvent.id);
                	if(calEvent.class=='outreach'){
                		window.location=domainurl+'project/viewtask/?id='+calEvent.id;	
                	}else{
                		$('#eventid').val(calEvent.id);
                		//$('#vieweventdetailmodalbtn').trigger( "click" );
                		Calendar.getEventDetail();
                	}
                	
                }
            });
            
        },
        getEventDetail:function(){
        	App.blockUI({boxed: true,message: $('#loadcalmsg').val()});
        	$('#vieweventmodal').html('');
    		$.post(domainurl+"calendar/ajax_geteventdetail", {
				eventid:$('#eventid').val()
			}, function(data) {
				App.handleTimeout(data);
				App.unblockUI();
				if(data.status=='error'){
					App.growl(data.msg,'danger');
					return false;
				}
				
				$('#vieweventmodal').html(data.html);
				Calendar.eventDetailForm();
				$('#vieweventmodal').modal('show');
			},'json');
        },
        getSetCurrentViewDate:function(){
        	
        	var type = $('#calendar').fullCalendar('getView').name;
        	
        	if(type=='month'){
        		var start = $('#calendar').fullCalendar('getDate').format();
           	}else{
        		var start = $('#calendar').fullCalendar('getView').start.format();
            }
        	if(start.indexOf('T')>0){
         		var curr = start.split('T');
         		var start = curr[0];
         	}
         	 
        	 $('#currentviewtype').val(type);
         	 $('#currentviewstart').val(start);
        }
    };
}();