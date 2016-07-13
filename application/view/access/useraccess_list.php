<?php
	include_once 'application/view/template/'.$_SESSION['theme'].'/admin_header.php';
?>
	<!-- BEGIN CONTAINER -->   
	<div class="page-container row-fluid">
<?php
	$sidebar_system_active 				= 1;
	$sidebar_system_access_active		= 1;
	$sidebar_system_useraccess_active 	= 1;
	
	include_once 'application/view/template/'.$_SESSION['theme'].'/admin_sidebar.php';
?>
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN PAGE CONTAINER-->        
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<?php include_once 'application/view/template/'.$_SESSION['theme'].'/admin_style.php';?>
						<h3 class="page-title">
							<?php echo $Lang['user_access_management'];?>
							<small><?php echo $Lang['user_access_management_desc'];?></small>
						</h3>
						
						<?php 
						$breadcrumb_arr = array(array('name'=>$Lang['user_access_management']));
						UIElementController::render("breadcrumb",$breadcrumb_arr);
						?>
						
						
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
					<form name="form1" id="form1" method="get"/>
					<label><?php echo $Lang['role']?></label>
														
						<?php
							
							$input['ID'] 		= 'RoleID';
							$input['Name'] 		= 'RoleID';
							$input['Option'] 	= $Data['all_role'];
							$input['Class'] 	= ' ';
							$input['Value'] 	= $Data['RoleID'];
							UIElementController::render("selection",$input);
							unset($input);?>
													
						<?php 
						
						$dt_arr['table_id'] = 'userlist_table';
						$dt_arr['column'] = $Data['Column'];
						
						for($a=0;$a<sizeof($Data['UserList']);$a++){
							$dt_arr['data'][] = array(	array('data'=>$Data['UserList'][$a]['UserID']),
														array('data'=>$Data['UserList'][$a]['UserName'],'url'=>$Data['function']['access']['user_accessview']?'?ctr=access_user_accessview&ID='.$Data['UserList'][$a]['UserID']:''),
														array('data'=>$Data['UserList'][$a]['UserEmail']),
														array('data'=>($Data['UserList'][$a]['Status']==USER_ACTIVE?'<span class="label label-success">'.$Lang['active'].'</span>':'<span class="label label-warning">'.$Lang['inactive'].'</span>')),
														array('data'=>$Data['UserList'][$a]['Timeinput']),
														array('data'=>$Data['UserList'][$a]['LastLogin']==''?'--':$Data['UserList'][$a]['LastLogin']));
						}

						if($Data['function']['add'])
							$dt_arr['toolbar_btns'][] = array('type'=>'add','url'=>'?ctr=user_user_add');
						
						UIElementController::render("advancetable",$dt_arr);
						
						?>
						
						</form>
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	</div>
	
	<!-- END CONTAINER -->
	<?php 
	
	$ready_js = "	var initTable = function() {
        var oTable = $('#".$dt_arr['table_id']."').dataTable( {    
         	
            \"aaSorting\": [[1, 'asc']],
             \"aLengthMenu\": [
                [5, 15, 20, -1],
                [5, 15, 20, \"All\"] // change per page values here
            ],
            // set the initial value
            \"iDisplayLength\": 10,
             \"oLanguage\": {
                    \"sLengthMenu\": \"_MENU_ ".$Lang['record_per_page']."\",
                    \"sInfo\": \"".$Lang['pagination_of_record']."\",
                    \"oPaginate\": {
                        \"sPrevious\": \"".$Lang['pignation_prev']."\",
                        \"sNext\": \"".$Lang['pignation_next']."\"
                    }
                },
                \"aoColumnDefs\": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
        });

        jQuery('#".$dt_arr['table_id']."_wrapper .dataTables_filter input').addClass(\"m-wrap small\"); // modify table search input
        jQuery('#".$dt_arr['table_id']."_wrapper .dataTables_length select').addClass(\"m-wrap small\"); // modify table per page dropdown
        jQuery('#".$dt_arr['table_id']."_wrapper .dataTables_length select').select2(); // initialize select2 dropdown

        $('#".$dt_arr['table_id']."_column_toggler input[type=\"checkbox\"]').change(function(){
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr(\"data-column\"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    }
    
    jQuery('#".$dt_arr['table_id']." .group-checkable').change(function () {
                var set = jQuery(this).attr(\"data-set\");
                var checked = jQuery(this).is(\":checked\");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr(\"checked\", true);
                    } else {
                        $(this).attr(\"checked\", false);
                    }
                });
                jQuery.uniform.update(set);
            });
    
	 jQuery('#RoleID').change(function () {
                window.location='?ctr=access_user_accesslist&RoleID='+$('#RoleID').val();
            });									
								
									";
	
	
	?>
    
	<?php $ready_js .= "initTable();";
	$ready_js .= Display_Action_Msg();
	?>
<?php 
include_once 'application/view/template/'.$_SESSION['theme'].'/admin_footer.php';
?>
