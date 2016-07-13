var Channel = function () {

	return {
		
		initButton:function(){
	    	$('.activatechanneltool').click(function (e) {
	    		if($('.checkboxes:checked').length>0){
		    		if(confirm($(this).attr('data-confirmmsg'))){
		    			var form = $(this).attr('data-form');
		    			$("#"+form).attr("action", domainurl+"/project/activatechanneltool");
		    			$('#'+form).submit();
		    		}
	    		}else{
	    			App.growl($(this).attr('data-checkempty'),'warning');
	    		}
			});
	    	$('.deactivatechanneltool').click(function (e) {
	    		if($('.checkboxes:checked').length>0){
		    		if(confirm($(this).attr('data-confirmmsg'))){
		    			var form = $(this).attr('data-form');
		    			$("#"+form).attr("action", domainurl+"project/deactivatechanneltool");
		    			$("#"+form).submit();
		    		}
				}else{
	    			App.growl($(this).attr('data-checkempty'),'warning');
	    		}
			});
	    	
	    	$('.addchanneltool').click(function (e) {
				var channelname = $(this).attr('data-channelname');
				App.blockUI({boxed: true,message: $('#loadmsg').val()});
		    	$('#channeltoolmodal').modal('show');
		    	$.post(domainurl+"/project/ajax_getchanneltooladdform", {
		    		channelname:channelname
				}, function(data) {
					App.handleTimeout(data);
					App.unblockUI();
					if(data.status=='error'){
						App.growl(data.msg,'danger');
						return false;
					}
					$('#channeltoolmodal').html(data.html);
					Channel.channelToolEditForm()
				},'json');
				
			});
	    	$('.removechanneltool').click(function (e) {
	    		if($('.checkboxes:checked').length>0){
		    		if(confirm($(this).attr('data-confirmmsg'))){
		    			var form = $(this).attr('data-form');
		    			$("#"+form).attr("action", domainurl+"/project/removechanneltool");
		    			$("#"+form).submit();
		    		}
	    		}else{
	    			App.growl($(this).attr('data-checkempty'),'warning');
	    		}
			});
	    	
	    },
	    channelToolEditForm:function(){
        	$('#channeltool_submit').unbind();
        	$('#channeltool_submit').click(function (e) {
        		App.blockUI({boxed: true,message: $('#loadmsg').val()});
        		$.post(domainurl+"/project/ajax_submitchanneltool", {
    				id:$('#id').val(),
    				name:$('#editname').val(),
    				description:$('#editdescription').val(),
    				isadd:$('#isadd').val(),
    				
    			}, function(data) {
    				App.handleTimeout(data);
    				App.unblockUI();
    				$('.modal').modal('hide');
    				if(data.status=='error'){
    					App.growl(data.msg,'warning');
    				}else{
    					App.growl(data.msg,'success');
    					setTimeout(function(){
    						location.reload();
    						}, 1000);
    				}
    				
    			},'json');
        	});
        },
		initTable : function () {
			var table = $('.table');


			table.dataTable({
            "bStateSave": true, // save datatable state(pagination, sort, etc)
								// in cookie.

            /*"columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": false
            }, {
                "orderable": true
            },{
                "orderable": true
            },{
                "orderable": true
            },{
                "orderable": true
            }],*/
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
                [1, "asc"]
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

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify
																											// table
																											// per
																											// page
																											// dropdown
        App.init();
    },
    editTool: function(id){
    	App.blockUI({boxed: true,message: $('#loadmsg').val()});
    	$('#channeltoolmodal').modal('show');
    	$.post(domainurl+"/project/ajax_getchanneltooldetail", {
			toolid:id
		}, function(data) {
			App.handleTimeout(data);
			App.unblockUI();
			if(data.status=='error'){
				App.growl(data.msg,'danger');
				return false;
			}
			$('#channeltoolmodal').html(data.html);
			Channel.channelToolEditForm()
		},'json');
    
    }
    
    
	
	}
}();