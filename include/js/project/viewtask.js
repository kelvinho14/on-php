/*var Task = function () {
	return {
		// main function to initiate the module
		init: function () {
			
			$('#addtask').click(function (e) {
				window.location=domainurl+'project/addtask/';
			});
			App.init();
		},
		initTable:function(){
			var table = $('#records_table');

			table.dataTable({
            "bStateSave": true, 
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, table.attr('data-all')] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,            
            "pagingType": "bootstrap_full_number",
            "language": {
                "search": table.attr('data-search'),
                "lengthMenu": table.attr('data-lengthmenu'),
                "info": table.attr('data-info'),
                "paginate": {
                    "previous":table.attr('data-prev'),
                    "next": table.attr('data-next'),
                    "last": table.attr('data-last'),
                    "first": table.attr('data-first')
                },
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": table.attr('data-zeroRecords'),
                
                "infoEmpty": '' ,
                "infoFiltered": table.attr('data-filtered'),
                
                "zeroRecords": table.attr('data-zeroRecords')
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [2, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#userlist_table_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline");
		}
	}
}();*/

var Task = function () {
	return {
		// main function to initiate the module
		init: function () {
			
			$('.addrecordbtn').click(function (e) {
				//Task.getNewRecordform();
				//$('#recordform').modal('show');
				window.location=domainurl+'project/addtaskrecord/?tid='+$('#jobtaskid').val()+'&cid='+$(this).attr('data-cid');
			});
			$('.edittaskrecord').click(function (e) {
				//Task.editRecordform($(this).attr('data-id'));
				window.location=domainurl+'project/edittaskrecord/?tid='+$('#jobtaskid').val()+'&id='+$(this).attr('data-id');
			});
			$('.deletetaskrecord').click(function (e) {
				if(confirm($(this).attr('data-confirmmsg'))){
					window.location=domainurl+'project/removetaskrecord/?id='+$(this).attr('data-id')+'&tid='+$('#jobtaskid').val()+'&cid='+$('#channelid').val();
				}
			});
			$('#edittasktime').click(function (e) {
				window.location=domainurl+'project/edittask/?id='+$('#jobtaskid').val();
			});
			App.init();
			//Task.initForm();
		},
		/*getNewRecordform:function(){
			App.blockUI({boxed: true,message: $('#loadcalmsg').val()});
        	$('#recordform').html('');
    		$.post(domainurl+"/project/ajax_getnewrecordform", {
				channelid:$('#channelid').val()
			}, function(data) {
				App.handleTimeout(data);
				App.unblockUI();
				if(data.status=='error'){
					App.growl(data.msg,'danger');
					return false;
				}
				
				$('#recordform').html(data.html);
				Task.initForm();
				
			},'json');
			
		},*/
		/*editRecordform:function(rid){
			App.blockUI({boxed: true,message: $('#loadmsg').val()});
        	$.post(domainurl+"/project/ajax_geteditrecordform", {
				id:rid,
				channelid:$('#channelid').val()
			}, function(data) {
				App.handleTimeout(data);
				App.unblockUI();
				if(data.status=='error'){
					App.growl(data.msg,'danger');
					return false;
				}
				console.log(data);
				//Task.initForm();
				
			},'json');
		},*/
		initForm:function(){

			$('#date').datepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				format: $('#date').attr('data-format'),
				minDate:moment()
			});
			$('#submitbtn').click(function (e) {
				if(Panel.validation()==true){
					$('#mainform').submit();	
				}
			});
			$('#duration').timepicker({
                autoclose: true,
                minuteStep: 5,
                showSeconds: false,
                showMeridian: false
            });
			Dropzone.options.myDropzone = {
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
			
									
									/*if($('#file_type').val()==".PUBLIC_FILE."){
										$('#tab_thecloud_li').pulsate({
						                     color: "#399bc3",
						                    reach: 50,
						                    repeat: 3,
						                    speed: 100,
						                    glow: true});
									
										reloadTheCloudTable();
									}
									else if($('#file_type').val()==".PRIVATE_FILE."){
										$('#tab_mycloud_li').pulsate({
				                     		color: "#399bc3",
				                    		reach: 50,
				                    		repeat: 3,
				                    		speed: 100,
				                    		glow: true});
									
										reloadMyCloudTable();
									}	*/
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
		}
	}
}();

