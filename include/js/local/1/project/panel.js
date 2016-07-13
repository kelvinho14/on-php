var Panel = function () {
	return {
		// main function to initiate the module
		init: function () {
			
			$('#addtask').click(function (e) {
				window.location=domainurl+'project/addtask/';
			});
			
			$('#removetask').click(function (e) {
				if($('.checkboxes:checked').length>0){
		    		if(confirm($(this).attr('data-confirmmsg'))){
			    		$("#mainform").attr("action", domainurl+"project/removetask");
						$('#mainform').submit();
		    		}
	    		}else{
	    			App.growl($(this).attr('data-checkempty'),'warning');
	    		}
			});
			
			
			App.init();
		},
		initTable:function(){

			var table = $('#tasklist_table');

        // begin first table
			table.dataTable({

         

            "bStateSave": true, // save datatable state(pagination, sort, etc)
								// in cookie.

            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": false
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
                [1, "desc"]
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
        
        $('.edittimebtn').click(function (e) {
			window.location=domainurl+'project/edittask?id='+$(this).attr('data-id');
		});
        
        $('.editoutreachbtn').click(function (e) {
			window.location=domainurl+'project/viewtask?id='+$(this).attr('data-id');
		});
        
        
		},changeTaskStatus:function(status,id){
			var status = status==false?0:1;
			App.preAjax($("#tasklist_table"));
			$.post(domainurl+"project/ajax_updatetaskstatus", {
				taskid : id,
				status:status
			}, function(data) {
				App.unblockUI($("#tasklist_table"));
				App.growl(data.msg,data.result);
			},'json');
		}
	}
}();