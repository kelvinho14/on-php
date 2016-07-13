<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}


$_PLUGIN['editable'] = 1;
$_PLUGIN['task'] = 1;
$_PLUGIN['timeline'] = 1;
$_PLUGIN['datepicker'] = 1;
$_PAGE['jsfile'] = 'project/panel.js';
$_PAGE['cssfile'] = $CONFIG['home_http'].'include/css/project/panel.css';
$_FOOTER['ready_js'] = 'FormEditable.init();';
$_FOOTER['ready_js'] .= 'focusDiscuss(1);';
$_FOOTER['ready_js'] .= 'initStaff();';
$_PAGE['jsvariable'] = $Data['jsvariable'];

$_FOOTER['ready_js'] .= 'setTimeout(function() {
	MS.init();
}, 2000);';

 


include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	$_PAGE['sidebar_project']= 1;
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Modal title</h4>
							</div>
							<div class="modal-body">
								 Widget settings form goes here
							</div>
							<div class="modal-footer">
								<button type="button" class="btn blue">Save changes</button>
								<button type="button" class="btn default" data-dismiss="modal">Close</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
						<?php include_once 'application/view/template/admin/admin_style.php';?>
							<h3 class="page-title">
				<?php echo $Data['project']['Name']?> <small><?php echo display::date($Data['project']['Start']).' - '.display::date($Data['project']['End'])?></small>
				</h3>
				<div class="page-bar">

							<?php
							$breadcrumb_arr = array (
									array (
											'name' => 'Project',
											'link' => '/project/list'
									),
									array (
											'name' => $Data['project']['Name'] 
									) 
							);
							UIElementController::render ( "breadcrumb", $breadcrumb_arr );
							?>


						<div class="page-toolbar">
						<div class="btn-group pull-right">
							<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
							Actions <i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li>
									<a href="#">Action</a>
								</li>
								<li>
									<a href="#">Another action</a>
								</li>
								<li>
									<a href="#">Something else here</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#">Separated link</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<div class="row ">
						<div class="col-md-12 ">
						<?php include_once('panel_milestone.php')?>
						</div>
					</div>
					
					<div class="row ">
						<div class="col-md-12 ">
						<?php
						$input ['title'] = 'Discussion';
						$input ['bodyid'] = 'discuss';
						$input ['btn'] = UIElementController::In_To_String ( "portlet_btn", array (
								'fa' => 'pencil' 
						) );
						$input ['btn'] .= UIElementController::In_To_String ( "portlet_btn", array (
								'fa' => 'repeat',
								'class' => 'reload',
								'attr' => array (
										'onClick' => 'focusDiscuss(1)' 
								) 
						) );
						$input['action']['fullscreen'] = true;
						UIElementController::render ( "portlet_start", $input );
						unset ( $input );
						
						
						UIElementController::render ( "portlet_end" );
						unset ( $input );
						?>
						</div>
					</div>
					<div class="row ">
						<div class="col-md-6">
							<?php 
							include_once ('panel_project.php');
							?>
						</div>
						<div class="col-md-6" id="staffdiv">
							<?php
							include_once ('panel_staff.php');
							?>
						</div>
					</div>
					
					
					<?php //include_once('panel_file.php')?>


					<!-- END PAGE CONTENT-->
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	
	<!-- END CONTAINER -->
	<input type="hidden" id="id" name="id" value="<?php echo $Data['project_id']?>"/>
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>