var Record = function () {
	return {
		
		init:function(){
			$('#submitbtn').click(function (e) {
				if(Record.validation()==true){
					$('#mainform').submit();	
				}
			});
			$('#postdate').datepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				format: $('#postdate').attr('data-format')
			});
			$('#backbtn').click(function (e) {
				window.location=domainurl+'project/viewtask/?id='+$('#jobtaskid').val()+'&cid='+$('#channelid').val();
			});
			$('#duration').timepicker({
                autoclose: true,
                minuteStep: 5,
                showSeconds: false,
                showMeridian: false
            });
			Dropzone.options.myDropzone = {
					dictDefaultMessage:$('#my-dropzone').attr('data-defaultmsg'),
					 paramName: "file", // The name that will be used to transfer the file
					  maxFilesize: $('#maxfilesize').val(),
					  acceptedFiles:'',
					  accept: function(file, done) {
									
					     done(); 
					  },
					init: function () {
			        	this.on("success", function (file,json) {
			        		
			        		try {
			        		    jsonResult = JSON.parse(json);
			        		    if(jsonResult.result=='ok'){
									App.growl(jsonResult.msg,'success');
									if(jsonResult.fileid!=''){
										$('#uploadfileid').val($('#uploadfileid').val()+','+jsonResult.fileid);
									}
									this.removeAllFiles();
								}else{
									file.previewElement.classList.add("dz-error");
				                    file.previewElement.querySelector("[data-dz-errormessage]").textContent = jsonResult.msg;
				                    App.growl(jsonResult.msg,'danger');
								}
			        		  }
			        		  catch (e) {
			        		    console.log("error: "+e);
			        		  };
				        },this.on("sending", function(file, xhr, formData) {
						  formData.append("file_type", $('#file_type').val()); // Will send the filesize along with the file as POST data.
						}));
				}
			}
			App.init();
		},
		validation:function(){
			//App.validateInput('tb',$('#duration')) && 
			if(App.validateInput('date',$('#postdate')) && App.validateInput('date',$('#staffmessage')) && App.validateInput('date',$('#postlink'))
					&& App.validateInput('date',$('#likecount'))&& App.validateInput('date',$('#sharecount'))&& App.validateInput('date',$('#commentcount'))		
			)
				return true;
			return false;
		}
		

	}
}();

