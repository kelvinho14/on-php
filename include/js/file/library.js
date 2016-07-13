var Library = function () {
	return {
		init:function(){
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
									//this.removeAllFiles();
									Library.loadFilelist();
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
				        	//formData.append("file_type", $('#file_type').val()); // Will send the filesize along with the file as POST data.
				        	formData.append("uploadstatus", $('#uploadstatus').is(":checked")?1:0); // Will send the filesize along with the file as POST data.
						}));
				}
			}
			Library.loadFilelist();
			
		},initDownload:function(){
			$('.downloadbtn').click(function (e) {
	    		window.location=domainurl+'file/download?id='+$(this).attr('data-id');
	        });
		},initView:function(){
			$('.viewbtn').click(function (e) {
	    		
	        });
		},initViewlink:function(){
			$('.linkbtn').click(function (e) {
				//$('.linkinput').hide();
				$('#'+$(this).attr('data-id')+'_link').toggle();
				$('#'+$(this).attr('data-id')+'_link').select();
	        });
		},initRemovefile:function(){
			$('#removefile').click(function (e) {
	    		if($('.checkboxes:checked').length>0){
		    		if(confirm($(this).attr('data-confirmmsg'))){
			    		$("#mainform").attr("action", domainurl+"/file/remove");
						$('#mainform').submit();
		    		}
	    		}else{
	    			App.growl($(this).attr('data-checkempty'),'warning');
	    		}
			});
		},changeStatus:function(ispublic,id){
			
			$.post(domainurl+"file/ajax_updatefilestatus", {
				ispublic:ispublic?1:0,
				id:id
			}, function(data) {
				App.handleTimeout(data);
				App.unblockUI();
				if(data.status=='error'){
					App.growl(data.msg,'warning');
				}else{
					App.growl(data.msg,'success');
				}
			},'json');
			
			
		},loadFilelist:function(){
			App.blockUI({boxed: true,message: $('#loadcalmsg').val()});
        	$('#filelistdiv').html('');
    		$.post(domainurl+"file/ajax_getfilelist", {
				
			}, function(data) {
				App.handleTimeout(data);
				App.unblockUI();
				if(data.status=='error'){
					App.growl(data.msg,'warning');
				}else{
					$('#filelistdiv').html(data.html);
					Library.initTable();
					Library.initDownload();
					Library.initView();
					Library.initViewlink();
					Library.initRemovefile();
					App.init();
				}
			},'json');
		},initTable:function(){

			var table = $('#filelist_table');
				table.dataTable({
					
				"columns": [{
	                "orderable": false
	            },{
	                "orderable": true
	            }, {
	                "orderable": false
	            }, {
	                "orderable": true
	            }, {
	                "orderable": true
	            }, {
	                "orderable": true
	            }],
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
	                [4, "desc"]
	            ] // set first column as a default sort by asc
	        });

	        var tableWrapper = jQuery('#filelist_table_wrapper');

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
}();

