var Dashboard = function () {
	return {
		// main function to initiate the module
		init: function () {
			
			$('#startdate').datepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				format: $('#startdate').attr('data-format'),
				endDate:$("#enddate").val()
			})
		    .on("changeDate", function(e){
			    $("#enddate").datepicker("setStartDate", $("#startdate").val());
			});
			
			$('#enddate').datepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				format: $('#enddate').attr('data-format'),
				startDate:$("#startdate").val()
			})
		    .on("changeDate", function(e){
				$("#startdate").datepicker("setEndDate", $("#enddate").val());
			});
			
			$("#userid").change(function() {
        		$('#filteruserid').val($(this).val());
                
            }).select2();
			
			//$("#channelid").select2();
			
			$("#channeltoolid").change(function() {
        		$('#filterchanneltoolid').val($(this).val());
                
            }).select2();
			$("#clientid").change(function() {
        		$('#filterclientid').val($(this).val());
            }).select2();
			
			
			$('#exportbtn').click(function (e) {
				$('#mainform').submit();
			});
			$('#clearfilterbtn').click(function (e) {
				$('input').val('');
				$("#clientid").select2("val", "");
				$("#userid").select2("val", "");
				$("#channeltoolid").select2("val", "");
				
				$('#filteruserid').val('');
				$('#filterchanneltoolid').val('');
				$('#filterclientid').val('');
			});
			$('#filterbtn').click(function (e) {
				var start = $('#startdate').val();
				var end = $('#enddate').val();
			
				App.blockUI({
	    			target: '#outreachlist',
	    			boxed: true,
	    			message: $('#loadmsg').val()
	    		});
				
				$.post(domainurl+"user/ajax_dashboardoutreachlist", {
					start:start,
					end:end,
					userid:$('#filteruserid').val(),
					channeltoolid:$('#filterchanneltoolid').val(),
					clientid:$('#filterclientid').val()
				}, function(data) {
					App.handleTimeout(data);
    				App.unblockUI($('#filterbtn'));
					$('#outreachlist').html(data.html)
					$('#expandBtn').trigger('click');
					App.init();
				},'json');
				
			});
			
			App.init();
		}
	}
}();