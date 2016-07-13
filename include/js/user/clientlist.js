var Client = function () {

	return {
		initButton:function(){
	    	$('#removeclient').click(function (e) {
	    		if($('.checkboxes:checked').length>0){
		    		if(confirm($(this).attr('data-confirmmsg'))){
			    		$("#mainform").attr("action", domainurl+"user/removeclient");
						$('#mainform').submit();
		    		}
	    		}else{
	    			App.growl($(this).attr('data-checkempty'),'warning');
	    		}
			});
	    },
		initTable : function () {
			$('#addclient').click(function (e) {
				window.location=domainurl+"user/addclient";
			});
			var table = $('#clientlist_table');
	
	        // begin first table
	        table.dataTable({
	
	            // Internationalisation. For more info refer to
				// http://datatables.net/manual/i18n
	            "language": {
	                "aria": {
	                    "sortAscending": ": activate to sort column ascending",
	                    "sortDescending": ": activate to sort column descending"
	                },
	                "emptyTable": "No data available in table",
	                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
	                "infoEmpty": "No entries found",
	                "infoFiltered": "(filtered1 from _MAX_ total entries)",
	                "lengthMenu": "Show _MENU_ entries",
	                "search": "Search:",
	                "zeroRecords": "No matching records found"
	            },

	            // Or you can use remote translation file
	            // "language": {
	            // url:
				// '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
	            // },
	
	            // Uncomment below line("dom" parameter) to fix the dropdown
				// overflow issue in the datatable cells. The default datatable
				// layout
	            // setup uses scrollable div(table-scrollable) with overflow:auto to
				// enable vertical scroll(see:
				// assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
	            // So when dropdowns used the scrollable div should be removed.
	            // "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6
				// col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7
				// col-sm-12'p>>",
	
	            "bStateSave": false, // save datatable state(pagination, sort, etc)
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
	                    "previous":"Prev",
	                    "next": "Next",
	                    "last": "Last",
	                    "first": "First"
	                }
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

	        var tableWrapper = jQuery('#clientlist_table_wrapper');
	
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
	        App.init();
		}
    
    
	
	}
}();