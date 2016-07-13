var Client = function () {
	return {
		// main function to initiate the module
		init: function () {
			$('#birthday').datepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				format: $('#birthday').attr('data-format'),
				minDate:moment()
			});
			$('#backbtn').click(function (e) {
				window.location=domainurl+'user/viewlist/';
			});
			$('#submitbtn').click(function (e) {
				if(Client.validation()==true){
					$('#mainform').submit();	
				}
			});
			App.init();
		},
		validation:function(){
//&& App.validateInput('tb',$('#uniquestring'))
			if(App.validateInput('tb',$('#firstname')))
				return true;
			return false;
		},
	}
}();