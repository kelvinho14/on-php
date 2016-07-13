var project_id = $('#id').val();

var FormEditable = function () {
    var log = function (settings, response) {
        var s = [],
            str;
        s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
        for (var a in settings.data) {
            if (settings.data[a] && typeof settings.data[a] === 'object') {
                str = [];
                for (var j in settings.data[a]) {
                    str.push(j + ': "' + settings.data[a][j] + '"');
                }
                str = '{ ' + str.join(', ') + ' }';
            } else {
                str = '"' + settings.data[a] + '"';
            }
            s.push(a + ' = ' + str);
        }
        s.push('RESPONSE: status = ' + response.status);

        if (response.responseText) {
            if ($.isArray(response.responseText)) {
                s.push('[');
                $.each(response.responseText, function (i, v) {
                    s.push('{value: ' + v.value + ', text: "' + v.text + '"}');
                });
                s.push(']');
            } else {
                s.push($.trim(response.responseText));
            }
        }
        s.push('--------------------------------------\n');
        $('#console').val(s.join('\n') + $('#console').val());
    }

    

    

    return {
        // main function to initiate the module
        init: function () {

            // init editable elements
            initEditables();
            $('.clienticon').click(function (e) {
				var clientid = $('#clientid').attr('data-value');
				window.open('/client/view?id='+clientid);
				return false;
            });
            
            // init editable toggler
            $('#enable').click(function () {
                $('#user .editable').editable('toggleDisabled');
            });

            // init
            $('#inline').on('change', function (e) {
                if ($(this).is(':checked')) {
                    window.location.href = 'form_editable.html?mode=inline';
                } else {
                    window.location.href = 'form_editable.html';
                }
            });

            // handle editable elements on hidden event fired
            $('#user .editable').on('hidden', function (e, reason) {
                if (reason === 'save' || reason === 'nochange') {
                    var $next = $(this).closest('tr').next().find('.editable');
                    if ($('#autoopen').is(':checked')) {
                        setTimeout(function () {
                            $next.editable('show');
                        }, 300);
                    } else {
                        $next.focus();
                    }
                }
            });


        }

    };

}();

var initEditables = function () {

    // set editable mode based on URL parameter
    if (App.getURLParameter('mode') == 'inline') {
        $.fn.editable.defaults.mode = 'inline';
        $('#inline').attr("checked", true);
        jQuery.uniform.update('#inline');
    } else {
        $('#inline').attr("checked", false);
        jQuery.uniform.update('#inline');
    }

    // global settings
    $.fn.editable.defaults.inputclass = 'form-control';
    $.fn.editable.defaults.url = domainurl+'/project/ajax_updateProject';
    $.fn.editable.defaults.ajaxOptions  = {dataType:'json'};

    $('#name').editable({
		validate : function(value) {
			if ($.trim(value) == '')
				return 'This field is required';
		},
       success: function(data, config) {
    	   if(data.result=='ok'){
        	   App.growl($(this).data('successmsg'),'success');
           }else{
        	   App.growl($(this).data('dangermsg'),'danger');
           }               
       }
	});

	$('#objective').editable({
		showbuttons : (App.isRTL() ? 'left' : 'right')
	});

	$('#objective').click(function(e) {
		e.stopPropagation();
		e.preventDefault();
		$('#objective').editable('toggle');
	});

	$('#start').editable({
		rtl : App.isRTL(),
		emptytext:$(this).data('emptytext'),
		success: function(data, config) {
	    	   if(data.result=='ok'){
	        	   App.growl($(this).data('successmsg'),'success');
	           }else{
	        	   App.growl($(this).data('dangermsg'),'danger');
	           }               
	       }
	});
	
	$('#end').editable({
		rtl : App.isRTL(),
		emptytext:$(this).data('emptytext'),
		success: function(data, config) {
	    	   if(data.result=='ok'){
	        	   App.growl($(this).data('successmsg'),'success');
	           }else{
	        	   App.growl($(this).data('dangermsg'),'danger');
	           }               
	       }
	});
	
	/*$('#start').editable({
        
        validate: function (v) {
            if (v && v.getDate() == 10) return 'Day cant be 10!';
        },
        datetimepicker: {
            rtl : App.isRTL(),
            todayBtn: 'linked',
            weekStart: 1
        }
    });
	
	$('#end').editable({
	    validate: function (v) {
            if (v && v.getDate() == 10) return 'Day cant be 10!';
        },
        datetimepicker: {
            rtl : App.isRTL(),
            todayBtn: 'linked',
            weekStart: 1
        }
    });*/
	$('#clientid').editable({
		inputclass : 'input-medium',
		source : clientlist,
		emptytext:$(this).data('emptytext'),
		placement:'right',
		success: function(data, config) {
	    	   if(data.result=='ok'){
	    		   $('#clientid').attr('data-value',data.clientid);
	        	   App.growl($(this).data('successmsg'),'success');
	           }else{
	        	   App.growl($(this).data('dangermsg'),'danger');
	           }               
	       }
	});

    $('#status').editable();

    $('#group').editable({
        showbuttons: false
    });

    $('#vacation').editable({
        rtl : App.isRTL() 
    });

    $('#dob').editable({
        inputclass: 'form-control',
    });

    $('#event').editable({
        placement: (App.isRTL() ? 'left' : 'right'),
        combodate: {
            firstItem: 'name'
        }
    });

    $('#comments').editable({
        showbuttons: 'bottom'
    });

    $('#note').editable({
        showbuttons : (App.isRTL() ? 'left' : 'right')
    });

    $('#pencil').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#note').editable('toggle');
    });

    $('#state').editable({
        source: ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"]
    });

    $('#fruits').editable({
        pk: 1,
        limit: 3,
        source: [{
                value: 1,
                text: 'banana'
            }, {
                value: 2,
                text: 'peach'
            }, {
                value: 3,
                text: 'apple'
            }, {
                value: 4,
                text: 'watermelon'
            }, {
                value: 5,
                text: 'orange'
            }
        ]
    });

    $('#fruits').on('shown', function(e, reason) {
    	App.initUniform();
    });

    $('#tags').editable({
        inputclass: 'form-control input-medium',
        select2: {
            tags: ['html', 'javascript', 'css', 'ajax'],
            tokenSeparators: [",", " "]
        }
    });

  

    $('#address').editable({
        url: '/post',
        value: {
            city: "San Francisco",
            street: "Valencia",
            building: "#24"
        },
        validate: function (value) {
            if (value.city == '') return 'city is required!';
        },
        display: function (value) {
            if (!value) {
                $(this).empty();
                return;
            }
            var html = '<b>' + $('<div>').text(value.city).html() + '</b>, ' + $('<div>').text(value.street).html() + ' st., bld. ' + $('<div>').text(value.building).html();
            $(this).html(html);
        }
    });
}

var MSWidget = function() {
	return {
		initMSTodo : function() {
			$('input.liChild').change(function() {
				if ($(this).is(':checked')) {
					$(this).parents('li').addClass("task-done");
				} else {
					$(this).parents('li').removeClass("task-done");
				}
			});
			App.init();
		},
		initSwitchTab : function(){
			$("#ms_task").hide();
			$("#ms_activities").hide();
			$("#ms_staff").hide();
			$("#ms_todo").hide();
		}

	};

}();

google.load("visualization", "1");

var urlData = "/project/ajax_msjson?id="+project_id;

var initialized = false;
var query;
var vis;

// Set callback to run when API is loaded
google.setOnLoadCallback(initialize);

function initialize() {
	initialized = true;
}



function zoom(zoomVal) {
    vis.zoom(zoomVal);
    vis.trigger("rangechange");
    vis.trigger("rangechanged");
}

var MS = function() {
	var animateTimeout = undefined;
    var animateFinal = undefined;
	return {
		init : function(){
			MS.drawChart();
			MS.initModal();
			 $(".draggable-modal").draggable({
			      handle: ".modal-header"
			  });
		},
		initModal : function(){
			
			$('#msnewstart').datepicker({
		        rtl: App.isRTL(),
		        orientation: "left",
		        autoclose: true,
		        format: 'yyyy-mm-dd',
		    });	
			$('#msnewend').datepicker({
		        rtl: App.isRTL(),
		        orientation: "left",
		        autoclose: true,
		        format: 'yyyy-mm-dd',
		    });
			MS.handleWysihtml5();
		},
		handleWysihtml5:function(){ 
			if (!jQuery().wysihtml5) {
	            return;
	        }
	        if ($('.wysihtml5').size() > 0) {
	            $('.wysihtml5').wysihtml5({
	                "stylesheets": ["/theme/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
	            });
	        }
		},
		drawChart : function(){
				
		            var options = {
		                'width':  '100%',
		                'height': 'auto',
		                'style': 'box'
		            };

		            vis = new links.Timeline(document.getElementById('mytimeline'), options);
		            /*var changed = function() {
						var sel = vis.getSelection();
						//console.log(sel);
						if (sel.length) {
							if (sel[0].row != undefined) {
								var row = sel[0].row;
								var item = timeline.getItem(row);
								console.log(item.content);

							}
						}
					};*/
					
					function onselect() {
						var sel = vis.getSelection();
						//console.log(sel);

						if (sel.length) {
							if (sel[0].row != undefined) {
								var row = sel[0].row;
								var ms = vis.getItem(row)
								console.log(ms.content);
								MS.focusMS(ms);
							}
						}
					}

					//google.visualization.events.addListener(vis, 'changed', changed);
					google.visualization.events.addListener(vis, 'select', onselect);
					vis.draw(msdata);
					

					setTimeout(function() {
						vis.setSelection([{row: msfocusrow}]);
						onselect();
						initDatepicker();
					}, 1000);
		},
		/*
		// main function to initiate the module
		loadMSChart : function() {

			if (!initialized) {
				alert("One moment please... still busy loading Google Visualization API");
				return;
			}
			// if the entered url is a google spreadsheet url, replace the part
			// "/ccc?" with "/tq?" in order to retrieve a neat data query result
			if (urlData.indexOf("/ccc?")) {
				urlData.replace("/ccc?", "/tq?");
			}

			var handleQueryResponse = function(response) {
				if (response.isError()) {
					alert('Error in query: ' + response.getMessage() + ', '
							+ response.getDetailedMessage());
					return;
				}

				// retrieve the data from the query response
				var data = response.getDataTable();

				// specify options
				var options = {
					width : "100%",
					height : "auto",
					start : new Date(2010, 7, 17),
					end : new Date(2010, 8, 2),
					style : "box",
					zoomable : false
				};

				// Instantiate our timeline object.
				vis = new links.Timeline(document.getElementById('mytimeline'), options);

				var changed = function() {
					var sel = vis.getSelection();
					console.log(sel);
					if (sel.length) {
						if (sel[0].row != undefined) {
							var row = sel[0].row;
							console.log(timeline.getItem(row));

						}
					}
				};

				google.visualization.events.addListener(vis, 'changed', changed);
				google.visualization.events.addListener(vis, 'select', onselect);

				// Draw our timeline with the created data and options
				vis.draw(data);
				
				// setTimeout(function() {
					vis.setSelection([{row: 1}]);
					onselect();
					initDatepicker();
				// }, 1000);
			}
			
			function onselect() {
				var sel = vis.getSelection();
				console.log(sel);

				if (sel.length) {
					if (sel[0].row != undefined) {
						var row = sel[0].row;
						console.log(vis.getItem(row));
						var ms = vis.getItem(row)
						// alert("event " + row + " selected");
						MS.focusMS(ms);
					}
				}
			}
			
			

			query && query.abort();
			query = new google.visualization.Query(urlData);
			query.send(handleQueryResponse);

			
		},*/
		focusMS : function(ms){
				App.blockUI({
			        target: $("#milestone_info"),
			        animate: true,
			        overlayColor: 'none'
			    });
				$.post(domainurl+"project/ajax_milestone", {
					/*name : ms.content,
					start : ms.start,*/
					id : project_id,
					name : ms.content
				}, function(data) {
					$("#milestone_info").hide();
					App.unblockUI($("#milestone_info"));
					$("#milestone_info").html(data).fadeIn();
					App.init();
					// initPickStaff();
					// MSWidget.initMSWidgets();
					MilestoneEditable.init();
					$('#mstaskbtn').click(function(e) {
						MS.focusMSTask()
					});
					$('#msstaffbtn').click(function(e) {
						MS.focusMSStaff()
					});
				});
			
		},
		focusMSTask : function(){
			App.blockUI({
		        target: $("#ms_task"),
		        animate: true,
		        overlayColor: 'none'
		    });
			$.post(domainurl+"project/ajax_mstask", {
				id : project_id,
				msid:$('#mstaskbtn').attr('data-msid')
			}, function(data) {
				MSWidget.initSwitchTab();
				App.unblockUI($("#ms_task"));
				$("#ms_task").html(data).fadeIn();
				App.init();
			});
		
		},
		focusMSActivities : function(){
			App.blockUI({
		        target: $("#ms_activities"),
		        animate: true,
		        overlayColor: 'none'
		    });
			$.post(domainurl+"project/ajax_msactivities", {
				id : project_id,
				msid:$('#msstaffbtn').attr('data-msid')
			}, function(data) {
				MSWidget.initSwitchTab();
				App.unblockUI($("#ms_activities"));
				$("#ms_activities").html(data).fadeIn();
				App.init();
				
			});
		
		},
		focusMSStaff : function(){
			App.blockUI({
		        target: $("#ms_staff"),
		        animate: true,
		        overlayColor: 'none'
		    });
			$.post(domainurl+"project/ajax_msstaff", {
				id : project_id
			}, function(data) {
				MSWidget.initSwitchTab();
				App.unblockUI($("#ms_staff"));
				$("#ms_staff").html(data).fadeIn();
				App.init();
				
			});
		
		},
		focusMSTodo : function(){
			App.blockUI({
		        target: $("#ms_todo"),
		        animate: true,
		        overlayColor: 'none'
		    });
			$.post(domainurl+"project/ajax_mstodo", {
				id : project_id
			}, function(data) {
				MSWidget.initSwitchTab();
				App.unblockUI($("#ms_todo"));
				$("#ms_todo").html(data).fadeIn();
				MSWidget.initMSTodo();
				App.init();
			});
		
		},
		go :function () {
		    // interpret the value as a date formatted as "yyyy-MM-dd"
			
		    var go = $('#ms_goto').val();
		    var v = go.split('-');
		    var date = new Date(v[0], v[1]-1, v[2]);
		    if (date.toString() == "Invalid Date") {
		        alert("Invalid Date");
		    }
		    else {
		        MS.animateTo(date);
		    }
		},
		today :function(){
			var today = new Date();
			var val = today.getFullYear().toString()+'-'+(today.getMonth()+1).toString()+'-'+today.getDate().toString();
			$('#ms_goto').val(val);
			MS.go();
		},
		animateTo:function (date) {
            // get the new final date
            animateFinal = date.valueOf();
            vis.setCustomTime(date);

            // cancel any running animation
            MS.animateCancel();

            // animate towards the final date
            var animate = function () {
                var range = vis.getVisibleChartRange();
                var current = (range.start.getTime() + range.end.getTime())/ 2;
                var width = (range.end.getTime() - range.start.getTime());
                var minDiff = Math.max(width / 1000, 1);
                var diff = (animateFinal - current);
                if (Math.abs(diff) > minDiff) {
                    // move towards the final date
                    var start = new Date(range.start.getTime() + diff / 4);
                    var end = new Date(range.end.getTime() + diff / 4);
                    vis.setVisibleChartRange(start, end);

                    // start next timer
                    animateTimeout = setTimeout(animate, 50);
                }
            };
            animate();
        },
        animateCancel:function () {
            if (animateTimeout) {
                clearTimeout(animateTimeout);
                animateTimeout = undefined;
            }
        }
		

	};

}();

function initDatepicker(){
	$('#ms_goto').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true,
        format: 'yyyy-mm-dd',
    });
}
/*
 * function loadMSChart() { if (!initialized) { alert("One moment please...
 * still busy loading Google Visualization API"); return; }
 * 
 * 
 * 
 *  // if the entered url is a google spreadsheet url, replace the part //
 * "/ccc?" with "/tq?" in order to retrieve a neat data query result if
 * (urlData.indexOf("/ccc?")) { urlData.replace("/ccc?", "/tq?"); }
 * 
 * var handleQueryResponse = function(response) { if (response.isError()) {
 * alert('Error in query: ' + response.getMessage() + ', ' +
 * response.getDetailedMessage()); return; } // retrieve the data from the query
 * response var data = response.getDataTable(); // specify options var options = {
 * width : "100%", height : "auto", start : new Date(2010, 7, 17), end : new
 * Date(2010, 8, 2), style : "box", zoomable : false }; // Instantiate our
 * timeline object. vis = new
 * links.Timeline(document.getElementById('mytimeline'), options);
 * 
 * var changed = function() { var sel = vis.getSelection(); console.log(sel); if
 * (sel.length) { if (sel[0].row != undefined) { var row = sel[0].row;
 * console.log(timeline.getItem(row)); } } };
 * 
 * google.visualization.events.addListener(vis, 'changed', changed);
 * google.visualization.events.addListener(vis, 'select', onselect); // Draw our
 * timeline with the created data and options vis.draw(data);
 * 
 * setTimeout(function() { vis.setSelection([{row: 4}]); onselect(); }, 1000); }
 * 
 * function onselect() { var sel = vis.getSelection(); console.log(sel);
 * 
 * if (sel.length) { if (sel[0].row != undefined) { var row = sel[0].row;
 * console.log(vis.getItem(row)); var ms = vis.getItem(row) // alert("event " +
 * row + " selected"); focusMilestone(ms); } } }
 * 
 * function focusMilestone(ms) {
 * 
 * App.blockUI({ target: $("#milestone_detail"), animate: true, overlayColor:
 * 'none' });
 * 
 * 
 * $.post("/project/ajax_milestone", { name : ms.content, start : ms.start,
 * prjid : 1 }, function(data) { $("#milestone_detail").hide();
 * App.unblockUI($("#milestone_detail"));
 * $("#milestone_detail").html(data).fadeIn(); //App.init(); //initPickStaff();
 * initTask(); MilestoneEditable.init(); }); }
 * 
 * query && query.abort(); query = new google.visualization.Query(urlData);
 * query.send(handleQueryResponse); }
 */


var MilestoneEditable = function() {

	var log = function(settings, response) {
		var s = [], str;
		s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
		for ( var a in settings.data) {
			if (settings.data[a] && typeof settings.data[a] === 'object') {
				str = [];
				for ( var j in settings.data[a]) {
					str.push(j + ': "' + settings.data[a][j] + '"');
				}
				str = '{ ' + str.join(', ') + ' }';
			} else {
				str = '"' + settings.data[a] + '"';
			}
			s.push(a + ' = ' + str);
		}
		s.push('RESPONSE: status = ' + response.status);

		if (response.responseText) {
			if ($.isArray(response.responseText)) {
				s.push('[');
				$.each(response.responseText, function(i, v) {
					s.push('{value: ' + v.value + ', text: "' + v.text + '"}');
				});
				s.push(']');
			} else {
				s.push($.trim(response.responseText));
			}
		}
		s.push('--------------------------------------\n');
		$('#console').val(s.join('\n') + $('#console').val());
	}

	var initEditables = function() {

		// set editable mode based on URL parameter
		if (App.getURLParameter('mode') == 'inline') {
			$.fn.editable.defaults.mode = 'inline';
			$('#inline').attr("checked", true);
			jQuery.uniform.update('#inline');
		} else {
			$('#inline').attr("checked", false);
			jQuery.uniform.update('#inline');
		}

		// global settings
		$.fn.editable.defaults.inputclass = 'm-wrap';
		$.fn.editable.defaults.url = '/project/ajax_milestoneupdate';
		$.fn.editable.defaults.ajaxOptions  = {dataType:'json'};
		
		$('#ms_name').editable({
			validate : function(value) {
				if ($.trim(value) == '')
					return 'This field is required';
			},
			success: function(data, config) {
	    	   if(data.result=='ok'){
	        	   App.growl($(this).data('successmsg'),'success');
	           }else{
	        	   App.growl($(this).data('dangermsg'),'danger');
	           }               
	       }
		});

		$('#ms_objective').editable({
			showbuttons : (App.isRTL() ? 'left' : 'right'),
			success: function(data, config) {
		    	   if(data.result=='ok'){
		        	   App.growl($(this).data('successmsg'),'success');
		           }else{
		        	   App.growl($(this).data('dangermsg'),'danger');
		           }               
		       }
		});
		$('#ms_objective').click(function(e) {
			e.stopPropagation();
			e.preventDefault();
			$('#ms_objective').editable('toggle');
		});

		$('#ms_start').editable({
			rtl : App.isRTL(),
			emptytext:$(this).data('emptytext'),
			success: function(data, config) {
		    	   if(data.result=='ok'){
		        	   App.growl($(this).data('successmsg'),'success');
		           }else{
		        	   App.growl($(this).data('dangermsg'),'danger');
		           }               
		       }
		});
		
		$('#ms_end').editable({
			rtl : App.isRTL(),
			emptytext:$(this).data('emptytext'),
			success: function(data, config) {
		    	   if(data.result=='ok'){
		        	   App.growl($(this).data('successmsg'),'success');
		           }else{
		        	   App.growl($(this).data('dangermsg'),'danger');
		           }               
		       }
		});

		/*
		 * $('#ac').on('change', function(evt, params) { setTimeout(function () {
		 * $('#pickedstaff').append($('#ac').val()); $('#ac').val(''); }, 500);
		 * 
		 * });
		 */

		$('#address').editable(
				{
					url : '/post',
					value : {
						city : "San Francisco",
						street : "Valencia",
						building : "#24"
					},
					validate : function(value) {
						if (value.city == '')
							return 'city is required!';
					},
					display : function(value) {
						if (!value) {
							$(this).empty();
							return;
						}
						var html = '<b>' + $('<div>').text(value.city).html()
								+ '</b>, '
								+ $('<div>').text(value.street).html()
								+ ' st., bld. '
								+ $('<div>').text(value.building).html();
						$(this).html(html);
					}
				});
	}

	return {
		// main function to initiate the module
		init : function() {
			// init editable elements
			initEditables();
		}

	};

}();

function initDiscuss(){
	Discuss.initDiscussWidget();
}
function initDiscussReply(){
	Discuss.initDiscussReplyWidget();
}


var Discuss = function() {
	return {
		// main function to initiate the module
		initDiscussWidget : function() {
			
// $('#discuss_scroller').slimScroll({
// start:'bottom',
// });
			App.init();
			
		},
		initDiscussReplyWidget : function() {
// $('#discussreply_scroller').slimScroll({
// start:'bottom',
// });
			App.init();
		
		}

	};

}();

function focusDiscussReply(id){
	
	App.blockUI({
        target: $("#discuss"),
        animate: true,
        overlayColor: 'none'
    });
	
	$.post(domainurl+"project/ajax_discussreply", {
		id : project_id
	}, function(data) {
		$("#discuss").hide();
		App.unblockUI($("#discuss"));
		$("#discuss").html(data).fadeIn();
		initDiscussReply();
		// $('#discussreply_scroller').slimScroll({
			// scrollTo: $('#discuss_scroller').parent().height(),
			// allowPageScroll:true
			// start:$('.discuss_last'),
        // });
		/*
		 * $('#discuss_scroller').animate({ scrollTop:
		 * $("#discuss_scroller").parent().offset().top }, 1000);
		 */

	});
}
function focusDiscuss(id){
// $('#discussreply_scroller').slimScroll({
// destroy: true
// });
	
	App.blockUI({
        target: $("#discuss"),
        animate: true,
        overlayColor: 'none'
    });
	
	
	$.post(domainurl+"project/ajax_discuss", {
		id : project_id
	}, function(data) {
		
		$("#discuss").hide();
		App.unblockUI($("#discuss"));
		$("#discuss").html(data).fadeIn();
        initDiscuss();
		// App.init();
		// $('#discuss_scroller').slimScroll({
			// scrollTo: $('#discuss_scroller').parent().height(),
			// allowPageScroll:true
			// start:'bottom',
        // });
				
		/*
		 * $('#discuss_scroller').animate({ scrollTop:
		 * $("#discuss_scroller").parent().offset().top }, 1000);
		 */
		
	});
}

function initStaff(){
	
	Staff.initStaffWidget();
}
var Staff = function() {
	return {
		// main function to initiate the module
		initStaffWidget : function() {
			// var data = ["何健驄", "green", "blue", "yellow", "pink"];
	
			$('#staff').select2({
                placeholder: "Select",
                
            });
			$eventSelect = $('#staff');
			$eventSelect.on("change", function (e) { 
				Staff.append(e); 
			});
			App.init();
		},
		append:function(evt){
			Staff.addStaff(evt.val);
			// $('#s2id_pic').find('.select2-chosen').html('');
		},
		addStaff:function(userid){
			$.post(domainurl+"project/ajax_projectAddStaff", {
				id : project_id,
				userid:userid,
			}, function(data) {
				if(data.result){
					//Staff.load();
					$('#staffrow').append(data.html);
				} 
		    },'json');
		},
		load:function(){
			App.blockUI({
		        target: $("#staffdiv"),
		        animate: true,
		        overlayColor: 'none'
		    });
			$.post(domainurl+"project/ajax_staff", {
				id : project_id

			}, function(data) {
				$("#staffdiv").hide();
				App.unblockUI($("#staffdiv"));
				$("#staffdiv").html(data).fadeIn();
				Staff.initStaffWidget();
			});
		}

	};

}();
