var Record = function () {
	return {
		
		init:function(){
			
			
			$('#submitbtn').click(function (e) {
				
				if(Record.validation()==true){
					$('#mainform').submit();	
				}
			});
			$('.removeImage').click(function (e) {
				if(confirm($(this).attr('data-confirmmsg'))){
					var id = $(this).attr('data-id');
					$.post(domainurl+"/project/ajax_removeattachment", {
						id : id
					}, function(data) {
						App.handleTimeout(data);
						$('#attachment_'+id).remove();
					});
				}
			});
			
			$("#clientid").select2();
			
			$('#addclientbtn').click(function (e) {
				$('#newclientdiv').fadeIn();
			});
			
			$('#addnewclientbtn').click(function (e) {
				App.unblockUI($('#newclientdiv'));
        		$.post(domainurl+'user/ajax_addclient', {
        			firstname:$('#newclientfirstname').val(),
        			//lastname:$('#newclientlastname').val(),
        			//uniquestring:$('#newclientuniquestring').val(),
    			}, function(data) {
    				App.handleTimeout(data);
    				App.unblockUI();
    				if(data.status=='error'){
    					App.growl(data.msg,'warning');
    				}else{
    					$('#newclientfirstname').val('');
    					//$('#newclientlastname').val('');
    					//$('#newclientuniquestring').val('');
    					$('#newclientdiv').fadeOut();
    					
    					$("#clientid").append($('<option>', {value:data.newoptionid, text: data.newoption}));
    					$("#clientid").select2('data', {value: data.newoptionid, text: data.newoption});
    					$("#clientid").val(data.newoptionid);
    					
    					//$("#clientid").select2('data', {id: data.newoptionid, text: data.newoption});      
    					App.growl(data.msg,'success');
    				}
    				
    			},'json');
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
		validateObjectCategory:function(){
			var usedCat = {};
			var result = true;
			$('.codeinput').each(function() {
				if(usedCat[$(this).val()]) {
					alert($(this).attr('data-duplicatevalue'));
					$(this).focus();
				    result = false;
			    }else {
			    	usedCat[$(this).val()] = $(this).val();
			    }
			});
			return result;
		},
		validation:function(){
			//&& App.validateInput('tb',$('#duration'))
			if(Record.validateObjectCategory()==true  && App.validateInput('tb',$('#channeltoolid')) &&  App.validateInput('tb',$('#clientid'))  &&App.validateInput('tb',$('#board')) &&App.validateInput('tb',$('#clientactivity')) 
					&&App.validateInput('tb',$('#message'))&&App.validateInput('tb',$('#link'))&&App.validateInput('dd',$('#outreachmethod'))&& App.validateInput('each',$('.codeinput'))&&App.validateInput('tb',$('#staffmessage'))){
					return true;
			}
			return false;
		}
	}
}();

