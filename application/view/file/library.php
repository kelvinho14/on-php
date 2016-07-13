<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

//$_PLUGIN['datepicker'] = 1;
$_PLUGIN['datatable'] = 1;
$_PLUGIN['dropzone'] = 1;

$_PAGE['jsfile'][] = 'file/library.js';
$_FOOTER['ready_js'] .= 'Library.init();';

$app = new Application();

include_once 'application/view/template/admin/admin_header.php';
?>

<!-- BEGIN CONTAINER -->
<?php ui::div_s(array('class'=>'container'))?>
	<!-- BEGIN CONTAINER -->
	
	<?php ui::div_s(array('class'=>'page-container'))?>
	<?php
	$_PAGE['sidebar_file'] = 1;
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
	<?php ui::div_s(array('class'=>'page-content-wrapper'))?>
		<!-- BEGIN PAGE -->
		<?php ui::div_s(array('class'=>'page-content'))?>
		<!-- BEGIN PAGE CONTAINER-->
			<?php include_once 'application/view/template/admin/admin_style.php';?>
			<h3 class="page-title"><?php echo $Admin_Lang['file']?></h3>
			<?php ui::div_s(array('class'=>'page-bar'));
				$breadcrumb_arr = array (
									array (
											'name' => $Admin_Lang['file'],
									)
				);
				UIElementController::render ( "breadcrumb", $breadcrumb_arr );
			?>
			<?php ui::div_e()?>
			<div class="row">
				<div class="col-md-12">
				
				<?php if($Data['canupload']){?>
					<label><?php echo $Admin_Lang['uploadfilestatus']?>: </label>
					<?php echo ui::checkbox('uploadstatus',1,false,'make-switch',array('data-on-text'=>$Admin_Lang['publiced'],'data-off-text'=>$Admin_Lang['privated'],'data-on-color'=>'success','data-off-color'=>'warning'));?>
					<form action="<?php echo $CONFIG['home_http']?>file/upload" class="dropzone" id="my-dropzone" data-defaultmsg="<?php echo $Admin_Lang['dropzonedefaultmsg']?>"></form>
					<?php }else{
						echo $Admin_Lang['no_space_left'];
					}?>
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<form id="mainform" name="mainform" method="post"/>
				<div class="col-md-12" id="filelistdiv">
				
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>