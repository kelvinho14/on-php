<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
include_once 'application/view/template/'.$CONFIG['theme'].'/header.php';
?>
<link href="<?echo $CONFIG['home_http']?>theme/assets/admin/pages/css/error.css" rel="stylesheet" type="text/css"/>
<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				<div class="row">
					<div class="col-md-12 page-404">
						<div class="number">
							 Oops..
						</div>
						<div class="details">
							<p>
								 <?php echo $Lang['page_not_exists']?><br/>
								Click <a href="<?php echo $CONFIG['home_http']?>">
								here</a> to return home  
							</p>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	</div>
	<!-- END CONTAINER -->
<?php
$_PAGE['hideloadmore'] = true;
include_once 'application/view/template/'.$CONFIG['theme'].'/footer.php';
?>