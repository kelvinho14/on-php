<?php

/*
 * $_PAGE['jsfile'] = '/include/js/user/add.js';
 * $_FOOTER['ready_js'] .= 'User.init();';
 * $_PLUGIN['datepicker'] = 1;
 */

$_FOOTER['ready_js'] .= 'App.init();';
include_once 'application/view/template/admin/admin_header.php';

?>

<!-- BEGIN CONTAINER -->
<div class="container">
	<!-- BEGIN CONTAINER -->
	<div class="page-container">

	<?php
	$_PAGE ['sidebar_setting'] ['access'] = 1;
	//include_once 'application/view/template/admin/admin_sidebar.php';
	$app = new Application(array());
	$app->Load_View('template/admin/admin_sidebar',$_PAGE);
	?>
		<div class="page-content-wrapper">
			<!-- BEGIN PAGE -->
			<div class="page-content">
				<!-- BEGIN PAGE CONTAINER-->
				
						<?php include_once 'application/view/template/admin/admin_style.php';?>
							<h3 class="page-title">
				<?php echo $Admin_Lang['access_setting']?>
				</h3>

				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<form id="mainform" name="mainform" method="post">
					<div class="row">
						<div class="col-md-8">
							<div class="booking-search">

								<div class="row form-group">
									<div class="col-md-12">
										
										<?php
										$input ['for'] = 'roleid';
										$input ['value'] = '<b>Role</b>';
										$input ['attr'] = array (
												'class' => 'control-label' 
										);
										
										UIElementController::render ( "label", $input );
										unset ( $input );
										?>
										
											
											<div class="input-icon">
												<?php
												$input ['attr'] ['class'] = 'form-control';
												$input ['id'] = 'roleid';
												$input ['name'] = 'roleid';
												$input ['option'] = $Data ['userrole'];
												$input ['value'] = $Data ['selecteduserrole'];
												$input ['attr'] ['onChange'] = '$(\'#mainform\').submit()';
												UIElementController::render ( "select", $input );
												unset ( $input );
												?>
											</div>
									</div>
								</div>




							</div>
						</div>
						<!--end booking-search-->
						<div class="col-md-4">
							<div class="booking-app">
								<a href="javascript:;"> <i class="fa fa-mobile-phone pull-left"></i>
									<span> Get our mobile app! </span>
								</a>
							</div>
							<div class="booking-offer">
								<img src="../../assets/admin/pages/media/search/1.jpg"
									class="img-responsive" alt="">
								<div class="booking-offer-in">
									<span> London, UK </span> <em>Sign Up Today and Get 30%
										Discount!</em>
								</div>
							</div>
						</div>
						<!--end col-md-4-->
					</div>
					<div class="form-control height-auto">
						
						<div class="scroller" style="height: 470px;"
							data-always-visible="1">
							<ul class="list-unstyled">
								<?php foreach($Data['permission'] as $module=>$val){?>
								<li><label><input type="checkbox" name="product[categories][]"
										value="1"><?php echo $Admin_Lang['module'][$module]?>	</label>
									<ul class="list-unstyled">
									<?php 
										$ct=0;
										foreach($val as $method=>$val2){?>
											<li><label><input type="checkbox" name="<?php echo $module.'_'.$method?>" id="<?php echo $module.'_'.$method?>" value="1" <?php echo in_array($Data['selecteduserrole'],$val2)?'checked':''?>><?php echo $Admin_Lang['method'][$module][$method]?></label></li>
										<?php 
											$ct++;
										}?>
									</ul></li>
									<?php }?>
								
								
							</ul>
						</div>
					
					</div>
					<br/>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-4 col-md-8"><?php echo ui::submitBtn('',array('type'=>'submit','attr'=>array('name'=>'issubmit','value'=>'1')))?></div>
						</div>
					</div>
				</form>
				<!-- END PAGE CONTAINER-->
			</div>
			<!-- END PAGE -->
		</div>
	</div>
	
	<?php
	
	include_once 'application/view/template/admin/admin_footer.php';
	?>