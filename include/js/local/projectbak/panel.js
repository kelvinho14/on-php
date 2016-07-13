var Panel = function () {
	return {
		// main function to initiate the module
		init: function () {
			$('#date').datepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				format: $('#birthday').attr('data-format'),
				minDate:moment()
			});
			$('#backbtn').click(function (e) {
				window.location='/user/viewlist/';
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
			var username = jQuery.trim($('#username').val());
			if(username==''){
				User.warnMsg($('#username'),'emptymsg');
				return false;
			}else
				User.removeWarning($('#username'));
			return true;
		},
		validateEmail:function(){
			var email = jQuery.trim($('#email').val());
			if(email==''){
				User.warnMsg($('#email'),'emptymsg');
				return false;
			}else if(App.isValidEmail(email)==false){
				User.warnMsg($('#email'),'invalidmsg');
				return false;
			}
			else
				User.removeWarning($('#email'));
			return true;
		},
		validatePassword:function(){
			var password = jQuery.trim($('#password').val());
			var password2 = jQuery.trim($('#password2').val());
			
			if(password!=password2){
				User.warnMsg($('#password'),'notmatchmsg');
				return false;
			}else
				User.removeWarning($('#password'));
			return true;
		},
		validateRole:function(){
			var role = jQuery.trim($('#roleid').val());
			var clientid = jQuery.trim($('#clientid').val());
			if(role==''){
				User.warnMsg($('#roleid'),'emptymsg');
				return false;
			}else if(role==$('#roleid').attr('data-clientrole') && clientid==''){
				User.warnMsg($('#clientid'),'emptymsg');
				return false;
			}else
				User.removeWarning($('#roleid'));
			return true;
		},
		validateFirstname:function(){
			var firstname = jQuery.trim($('#firstname').val());
			if(firstname==''){
				User.warnMsg($('#firstname'),'emptymsg');
				return false;
			}else
				User.removeWarning($('#firstname'));
			return true;
		},
		validateLastname:function(){
			var lastname = jQuery.trim($('#lastname').val());
			if(lastname==''){
				User.warnMsg($('#lastname'),'emptymsg');
				return false;
			}else
				User.removeWarning($('#lastname'));
			return true;
		},
		
		validation:function(){

			if(User.validateUserName() && User.validateEmail() && User.validatePassword() && User.validateRole() && User.validateFirstname() && User.validateLastname())
				return true;
			
			/*var password = jQuery.trim($('#password').val());
			var roleid = jQuery.trim($('#roleid').val());
			
			var firstname = jQuery.trim($('#firstname').val());
			var lastname = jQuery.trim($('#firstname').val());
			var gender = jQuery.trim($('#gender').val());*/
			
			
			
			
			
				
				
			
			return false;
		},
		putWarning:function(ele){
			ele.parent().parent().removeClass('has-success').addClass('has-warning');
			setTimeout(function() { ele.focus(); }, 1);
			
			 
		},
		removeWarning:function(ele){
			ele.parent().parent().removeClass('has-warning').addClass('has-success');
		}
		,
		warnMsg:function(ele,type){
			App.growl(ele.attr('data-'+type),'danger');
			User.putWarning(ele);
		}
	}
}();