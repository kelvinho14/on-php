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
				window.location=domainurl+'/user/viewclientlist/';
			});
			$('#submitbtn').click(function (e) {
				if(Client.validation()==true){
					$('#mainform').submit();	
				}
			});
			App.init();
		},
		validateFirstname:function(){
			var firstname = jQuery.trim($('#firstname').val());
			if(firstname==''){
				Client.warnMsg($('#firstname'),'emptymsg');
				return false;
			}else
				Client.removeWarning($('#firstname'));
			return true;
		},
		validateLastname:function(){
			var lastname = jQuery.trim($('#lastname').val());
			if(lastname==''){
				Client.warnMsg($('#lastname'),'emptymsg');
				return false;
			}else
				Client.removeWarning($('#lastname'));
			return true;
		},
		validateEmail:function(){
			var email = jQuery.trim($('#email').val());
			if(email==''){
				return true;
			}else if(App.isValidEmail(email)==false){
				User.warnMsg($('#email'),'invalidmsg');
				return false;
			}
			else
				User.removeWarning($('#email'));
			return true;
		},
		validation:function(){
			if(Client.validateFirstname() && Client.validateEmail())
				return true;
			return false;
		},
		putWarning:function(ele){
			ele.parent().parent().removeClass('has-success').addClass('has-warning');
			setTimeout(function() { ele.focus(); }, 1);
			
			 
		},
		removeWarning:function(ele){
			ele.parent().parent().removeClass('has-warning').addClass('has-success');
		},
		warnMsg:function(ele,type){
			App.growl(ele.attr('data-'+type),'danger');
			Client.putWarning(ele);
		}
	}
}();