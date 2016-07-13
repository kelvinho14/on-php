var User = function () {
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
				if(User.validation()==true){
					$('#mainform').submit();	
				}
			});
			$('#roleid').change(function (e) {
				if($(this).val()==$(this).attr('data-clientrole'))
					$('#clientoption').show();
				else{
					$('#clientoption').hide();
					$('#clientid').val('');
				}
			});
			$('#passwordbtn').click(function (e) {
				var password = User.genPassword();
				$('#password').val(password);
				$('#password2').val(password);
			});
			App.init();
		},
		genPassword:function(){
			var length = 8
			var special = true;
			var iteration = 0;
		    var password = "";
		    var randomNumber;
		    
		    while(iteration < length){
		        randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
		        if(!special){
		            if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
		            if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
		            if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
		            if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
		        }
		        iteration++;
		        password += String.fromCharCode(randomNumber);
		    }
		    return password;
		},
		validateUserName:function(){
			var rule = new RegExp('[^A-Za-z0-9_]');
			if (rule.test($('#username').val())) {
				App.warnFormMsg($('#username'),'invalidmsg');
				return false;
			}
			
			return App.validateInput('tb',$('#username'));
		},
		validateEmail:function(){
			return App.validateInput('emailnotempty',$('#email'));
		},
		validatePassword:function(){
			return App.validateInput('password',$('#password'),$('#password2'));
		},
		validateRole:function(){
			var role = jQuery.trim($('#roleid').val());
			var clientid = jQuery.trim($('#clientid').val());
			if(role==''){
				App.warnFormMsg($('#roleid'),'emptymsg');
				return false;
			}else if(role==$('#roleid').attr('data-clientrole') && clientid==''){
				App.warnFormMsg($('#clientid'),'emptymsg');
				return false;
			}else
				App.removeFormWarning($('#roleid'));
			return true;
		},
		validateFirstname:function(){
			return App.validateInput('tb',$('#firstname'));
		},
		validateLastname:function(){
			return App.validateInput('tb',$('#lastname'));
		},
		
		validation:function(){

			if(User.validateUserName() && User.validateEmail() && User.validatePassword() && User.validateRole() && User.validateFirstname() && User.validateLastname())
				return true;
			
			
			return false;
		}
		
	}
}();