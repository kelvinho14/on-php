var Task = function () {
	return {
		// main function to initiate the module
		init: function () {
			
			$('#submitbtn').click(function (e) {
				$('#mainform').submit();
			});
			$('#backbtn').click(function (e) {
				window.location=domainurl+'project/panel/?cid='+$('#cid').val();
			});
			
			$('#date').datetimepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				format: $('#date').attr('data-format'),
				minDate:moment()
			});
			
			$('.timepicker').timepicker({
                autoclose: true,
                minuteStep: 5,
                showSeconds: false,
                showMeridian: false
            });
			
			App.init();
		}
	}
}();