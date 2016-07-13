var Calendar = function() {


    return {
        //main function to initiate the module
        init: function() {
            Calendar.initCalendar();
            Calendar.initUI();
            
        },

        initUI:function(){
        	
        	$('#mytaskfilter').click(function (e) {
        		Calendar.initCalendar();
            });
        	$('#eventfilter').click(function (e) {
        		Calendar.initCalendar();
            });
        	
        	$('#event_form').click(function (e) {
        		App.blockUI({boxed: true,message: $('#loadcalmsg').val()});
        		$.post(domainurl+"calendar/ajax_addeventform", {
    				
    			}, function(data) {
    				App.handleTimeout(data);
    				App.unblockUI();
    				if(data.status=='error'){
    					App.growl(data.msg,'danger');
    					return false;
    				}
    				
    				$('#addeventmodal').html(data.html);
    				if(jQuery.trim($('#clickstart').val())!=''){
    					$('#start').val($('#clickstart').val());
    				}	
    				if(jQuery.trim($('#clickend').val())!=''){
    					$('#end').val($('#clickend').val());
    				}
    				if(jQuery.trim($('#clickstarttime').val())!=''){
    					$('#starttime').val($('#clickstarttime').val());
    				}	
    				if(jQuery.trim($('#clickendtime').val())!=''){
    					$('#endtime').val($('#clickendtime').val());
    				}
    	    		$('#addeventmodal').modal('show');
    	    		Calendar.initDatepicker(0);
    	    		Calendar.initTimepicker(0);
    	    		Calendar.initForm(0);
    	    		$('#tool').select2({
    	                placeholder: "Select",
    	            });
    			},'json');
            });
        	
        	$('#export_event').click(function (e) {
        		Calendar.getSetCurrentViewDate();
        			
        		//window.open('/calendar/export/','newStuff');
        		$("#mainform").submit();
            });
        	/* $("#userid").change(function() {
                 alert($(this).val());
                 
             }).select2({
                 tags: $('#userid').attr('data-options').split(",")
             });*/
        	$("#userid").change(function() {
        		$('#filteruserid').val($(this).val());
                $('#eventid').val('');
                Calendar.initCalendar();
                
            }).select2();
        },
        clearFilter:function(){
        	$('#filteruserid').val('');
            $('#eventid').val('');
            $('#userid').select2('val',null)
            Calendar.initCalendar();
            
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
        /*initDatetimepicker:function(){
        	$('#start').datepicker('remove');
        	$('#end').datepicker('remove');
        	
        	$('#start').datetimepicker({
        		autoclose: true,
		        isRTL: App.isRTL(),
		        format: $('#start').attr('data-datetimeformat'),
		        pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
		            
			}).on("changeDate", function(e){
			    $("#end").datetimepicker("setStartDate", $("#start").val());
			});
			
			$('#end').datetimepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				format: $('#end').attr('data-datetimeformat'),
			}).on("changeDate", function(e){
				$("#start").datetimepicker("setEndDate", $("#end").val());
			});
        },*/
        initTimepicker:function(isupdate){
        	if(isupdate){
        		var start = 'editstarttime';
        		var end = 'editendtime';
        	}else{
        		var start = 'starttime';
        		var end = 'endtime';
        	}
        	

             $('#'+start).timepicker({
                 autoclose: true,
                 minuteStep: 5,
                 showSeconds: false,
                 showMeridian: false
             }).on('changeTime.timepicker', function(e) {    
            	    
				});

             $('#'+end).timepicker({
                 autoclose: true,
                 minuteStep: 5,
                 showSeconds: false,
                 showMeridian: false
             }).on('changeTime.timepicker', function(e) {    
         	    
			});
        },
        validateDatetime:function(isupdate){
        	if(isupdate){
        		var start = 'editstart';
        		var end = 'editend';
        		var starttime = 'editstarttime';
        		var endtime = 'editendtime';
        		var allday = 'editallday';
        	}else{
        		var start = 'start';
        		var end = 'end';
        		var starttime = 'starttime';
        		var endtime = 'endtime';
        		var allday = 'allday';
        	}
        	
        	var ds = jQuery.trim($('#'+start).val());
        	var de = jQuery.trim($('#'+end).val());
        	if(new Date(de) < new Date(ds)){
        		alert('invalid date');
        		return false;
        	}else if(de==ds && $('#'+allday).is(':checked')==false){
        		
        		var start = $('#'+starttime).val().split(':');
            	var h= parseInt(start[0]);
        	    var m= parseInt(start[1]);
        	    m+=h*60;
        	    var end = $('#'+endtime).val().split(':');
    			var h2= parseInt(end[0]);
    			var m2= parseInt(end[1]);
    			m2+=h2*60;
    			if(m>=m2){
    				return false;
    			}
    			return true;
        	}
        },
        initDatepicker:function(isupdate){
        	if(isupdate){
        		var start = 'editstart';
        		var end = 'editend';
        	}else{
        		var start = 'start';
        		var end = 'end';
        	}
        	var tmr = new Date();
            tmr.setDate(tmr.getDate()+1); // tmr
        	$('#'+start).datepicker({
				 autoclose: true,
		         isRTL: App.isRTL(),
		         endDate : (jQuery.trim($("#"+end).val())!='')?$("#"+end).val():'',
		         format: $('#'+start).attr('data-format'),
		         pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
		         //startDate:tmr,  
			}).on("changeDate", function(e){
				if($("#"+end).val()==''){
					$("#"+end).val($("#"+start).val());
				}
			    $("#"+end).datepicker("setStartDate", $("#"+start).val());
			    
			});
			
			$('#'+end).datepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				//startDate : (jQuery.trim($("#"+start).val())!='')?$("#"+start).val():tmr,
				format: $('#'+end).attr('data-format'),
			}).on("changeDate", function(e){
				if($("#"+start).val()==''){
					$("#"+start).val($("#"+end).val());
				}
				$("#"+start).datepicker("setEndDate", $("#"+end).val());
				
			});
        },
        eventDetailForm:function(){
        	$('#editevent').unbind();
        	
        	
        	$('#editevent').click(function (e) {
        		App.blockUI({boxed: true,message: $('#loadcalmsg').val()});
        		$.post(domainurl+"calendar/ajax_editeventform", {
    				eventid:$('#eventid').val()
    			}, function(data) {
    				App.handleTimeout(data);
    				App.unblockUI();
    				$('#editeventmodal').html(data.html);
    				$('#edittool').select2({
    	                placeholder: "Select",
    	            });
    				Calendar.initDatepicker(1);
    	    		Calendar.initTimepicker(1);
    	    		Calendar.initForm(1);
    	    		$('#editeventmodal').modal('show');
    			},'json');
        	});
        },
        initForm:function(isupdate){
        	App.init();
        	if(isupdate){
        		var btnname = 'event_update';
        		var url = domainurl+'calendar/ajax_updateevent';
        		var id = $('#eventid').val();
        		var starttimediv = 'editstarttimediv';
        		var endtimediv = 'editendtimediv';
        		var allday = 'editallday';
        		var isout = 'editisout';
        		
        		var start = 'editstart';
        		var end = 'editend';
        		var starttime = 'editstarttime';
        		var endtime = 'editendtime';
        		var desc = 'editdescription';
        		var tool = 'edittool';
        		
        	}else{
        		var btnname = 'event_add';
        		var url = domainurl+'calendar/ajax_addevent';
        		var id = '';
        		var starttimediv = 'starttimediv';
        		var endtimediv = 'endtimediv';
        		var allday = 'allday';
        		var isout = 'isout';
        		
        		var start = 'start';
        		var end = 'end';
        		var starttime = 'starttime';
        		var endtime = 'endtime';
        		var desc = 'description';
        		var tool = 'tool';
        	}
        	
        	$('#'+allday).click(function (e) {
        		if($(this).is(':checked')){
        			$('#'+starttimediv).hide();
        			$('#'+endtimediv).hide();
        		}else{
        			$('#'+starttimediv).show();
        			$('#'+endtimediv).show();
        		}
        			
        	});
        	
        	$('#event_add').unbind();
        	$('#event_update').unbind();
        	$('#'+btnname).click(function (e) {
        		if($('#name').length>0){
		        	if(jQuery.trim($('#name').val())==''){
		        		alert($('#name').attr('data-emptymsg'));
		        		$('#name').focus();
		        		return false;
		        	}
        		}
        		
        		if(jQuery.trim($('#'+start).val())==''){
        			alert($('#'+start).attr('data-emptymsg'));
        			$('#'+start).focus();
        			return false;
        		}
        		if(jQuery.trim($('#'+starttime).val())==''){
        			alert($('#'+starttime).attr('data-emptymsg'));
        			$('#'+starttime).focus();
        			return false;
        		}
        		if(jQuery.trim($('#'+end).val())==''){
        			alert($('#'+end).attr('data-emptymsg'));
        			$('#'+end).focus();
        			return false;
        		}
        		if(jQuery.trim($('#'+endtime).val())==''){
        			alert($('#'+endtime).attr('data-emptymsg'));
        			$('#'+endtime).focus();
        			return false;
        		}
        		if(Calendar.validateDatetime(isupdate)==false){
        			$('#'+endtime).focus();
        			alert($('#'+endtime).attr('data-startenderrormsg'));
        			return false;
        		}
        		
        		App.blockUI({boxed: true,message: $('#loadcalmsg').val()});
        		$.post(url, {
        			name : $('#name').val(),
    				start : $('#'+start).val(),
    				end : $('#'+end).val(),
    				starttime : $('#'+starttime).val(),
    				endtime : $('#'+endtime).val(),
    				desc :$('#'+desc).val(),
    				id:id,
    				tool:$('#'+tool).length>0?$('#'+tool).val():'',
    				allday : $('#'+allday).is(':checked')?$('#'+allday).val():0,
    				isout : $('#'+isout).is(':checked')?$('#'+isout).val():0
    			}, function(data) {
    				App.handleTimeout(data);
    				App.unblockUI();
    				if(data.status=='error'){
    					App.growl(data.msg,'warning');
    				}else{
    					$('.modal').modal('hide');
    					App.growl(data.msg,'success');
    				}
    				
    				Calendar.initCalendar($('#'+start).val());
    				App.init();
    			},'json');
            });
        },
        
        showLoading: function(){
        	App.blockUI({
    			target: '#calendar',
    			boxed: true,
    			message: $('#loadcalmsg').val()
    		});
        },
        initCalendar: function(gotodate) {

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
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        right: 'title, prev, next',
                        center: '',
                        left: 'agendaDay, agendaWeek, month, today'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        right: 'title',
                        center: '',
                        left: 'agendaDay, agendaWeek, month, today, prev,next'
                    };
                }
            } else {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        left: 'title, prev, next',
                        center: '',
                        right: 'today,month,agendaWeek,agendaDay'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        left: 'title',
                        center: '',
                        right: 'prev,next,today,month,agendaWeek,agendaDay'
                    };
                }
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
                    	//filteruserid: $('#filteruserid').val(),
                        mytaskfilter:$('#mytaskfilter').is(':checked')?1:0,
                        eventfilter:$('#eventfilter').is(':checked')?1:0,
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
                	if(calEvent.class=='mytask'){
                		window.location=domainurl+'task/mytask/?type=mytask&id='+calEvent.id;	
                	}else{
                		$('#eventid').val(calEvent.id);
                		//$('#vieweventdetailmodalbtn').trigger( "click" );
                		Calendar.getEventDetail();
                	}
                	
                }
            });
            
            if($('#gotodate').val()!=''){
            	$('#calendar').fullCalendar( 'gotoDate', $('#gotodate').val());
            	if($('#eventid').val()!=''){
            		Calendar.getEventDetail();
            	}
            }
            if(typeof(gotodate)!='undefined'){
            	console.log(gotodate);
            	$('#calendar').fullCalendar( 'gotoDate', gotodate);
            }
            /*if(gotodate!='undefined' && gotodate!=''){
            	$('#calendar').fullCalendar( 'gotoDate', gotodate);
            } */
            
            
            

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