var Profile = function () {
	return {
		// main function to initiate the module
		init: function () {
			$('#submitBtn').click(function (e) {
				if(Profile.validation()){
					$('#mainform').submit();
				}
			});
			App.init();
		},
		validatePassword:function(){
			
			if(App.validateInput('password',$('#password1'),$('#password2'))){
				return true;
			}
			
		},
		validation:function(){
			if(Profile.validatePassword())
				return true;
		}
		
	}
}();