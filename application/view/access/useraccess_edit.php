<?php
	include_once 'application/view/template/'.$_SESSION['theme'].'/admin_header.php';
?>
<link href="assets/css/pages/profile.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet"/>
<link href="assets/css/pages/image-crop.css" rel="stylesheet"/>
<style>
#preview-pane .thumbpreview-container {
    height: 170px;
    overflow: hidden;
    width: 170px;
}
</style>
	<!-- BEGIN CONTAINER -->   
	<div class="page-container row-fluid">
<?php 
	$sidebar_system_active = 1;
	$sidebar_system_useraccessedit_active = 1;
	
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
							<?php echo $Lang['system_setting'];?>
							<small><?php echo $Lang['system_setting_desc'];?></small>
						</h3>
						<?php 
						$breadcrumb_arr = array(array('name'=>$Lang['access_management']));
						UIElementController::render("breadcrumb",$breadcrumb_arr);
						?>
						
						
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid profile">
					<div class="span12">
						<!--BEGIN TABS-->
						<div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
								<li class="<?php echo $Data['action']=='staff'?'active':'';?>"><a data-toggle="tab" href="#tab_staff">Staff</a></li>
								<li class="<?php echo $Data['action']=='invoice'?'active':'';?>"><a data-toggle="tab" href="#tab_invoice">Invoice</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab_staff" class="tab-pane row-fluid <?php echo $Data['action']=='staff'?'active':'';?>">
									<div class="row-fluid add-portfolio">
										<div class="pull-left">
											<span>502 Items sold this week</span>
										</div>
										<div class="pull-left">
											<a class="btn icn-only green" href="#">Add a new Project <i class="m-icon-swapright m-icon-white"></i></a>                          
										</div>
									</div>
									<!--end add-portfolio-->
									<div class="row-fluid portfolio-block">
										<div class="span5 portfolio-text">
											<img alt="" src="assets/img/profile/portfolio/logo_metronic.jpg">
											<div class="portfolio-text-info">
												<h4>Metronic - Responsive Template</h4>
												<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>
											</div>
										</div>
										<div style="overflow:hidden;" class="span5">
											<div class="portfolio-info">
												Today Sold
												<span>187</span>
											</div>
											<div class="portfolio-info">
												Total Sold
												<span>1789</span>
											</div>
											<div class="portfolio-info">
												Earns
												<span>$37.240</span>
											</div>
										</div>
										<div class="span2 portfolio-btn">
											<a class="btn bigicn-only" href="#"><span>Manage</span></a>                      
										</div>
									</div>
									<!--end row-fluid-->
									<div class="row-fluid portfolio-block">
										<div class="span5 portfolio-text">
											<img alt="" src="assets/img/profile/portfolio/logo_azteca.jpg">
											<div class="portfolio-text-info">
												<h4>Metronic - Responsive Template</h4>
												<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>
											</div>
										</div>
										<div class="span5">
											<div class="portfolio-info">
												Today Sold
												<span>24</span>
											</div>
											<div class="portfolio-info">
												Total Sold
												<span>660</span>
											</div>
											<div class="portfolio-info">
												Earns
												<span>$7.060</span>
											</div>
										</div>
										<div class="span2 portfolio-btn">
											<a class="btn bigicn-only" href="#"><span>Manage</span></a>                      
										</div>
									</div>
									<!--end row-fluid-->
									<div class="row-fluid portfolio-block">
										<div class="span5 portfolio-text">
											<img alt="" src="assets/img/profile/portfolio/logo_conquer.jpg">
											<div class="portfolio-text-info">
												<h4>Metronic - Responsive Template</h4>
												<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>
											</div>
										</div>
										<div style="overflow:hidden;" class="span5">
											<div class="portfolio-info">
												Today Sold
												<span>24</span>
											</div>
											<div class="portfolio-info">
												Total Sold
												<span>975</span>
											</div>
											<div class="portfolio-info">
												Earns
												<span>$21.700</span>
											</div>
										</div>
										<div class="span2 portfolio-btn">
											<a class="btn bigicn-only" href="#"><span>Manage</span></a>                      
										</div>
									</div>
									<!--end row-fluid-->	
								</div>
								<!--end tab-pane-->
								<div id="tab_invoice" class="tab-pane row-fluid <?php echo $Data['action']=='invoice'?'active':'';?>">
									<div class="row-fluid add-portfolio">
										<div class="pull-left">
											<span>502 Items sold this week</span>
										</div>
										<div class="pull-left">
											<a class="btn icn-only green" href="#">Add a new Project <i class="m-icon-swapright m-icon-white"></i></a>                          
										</div>
									</div>
									<!--end add-portfolio-->
									<div class="row-fluid portfolio-block">
										<div class="span5 portfolio-text">
											<img alt="" src="assets/img/profile/portfolio/logo_metronic.jpg">
											<div class="portfolio-text-info">
												<h4>Metronic - Responsive Template</h4>
												<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>
											</div>
										</div>
										<div style="overflow:hidden;" class="span5">
											<div class="portfolio-info">
												Today Sold
												<span>187</span>
											</div>
											<div class="portfolio-info">
												Total Sold
												<span>1789</span>
											</div>
											<div class="portfolio-info">
												Earns
												<span>$37.240</span>
											</div>
										</div>
										<div class="span2 portfolio-btn">
											<a class="btn bigicn-only" href="#"><span>Manage</span></a>                      
										</div>
									</div>
									<!--end row-fluid-->
									<div class="row-fluid portfolio-block">
										<div class="span5 portfolio-text">
											<img alt="" src="assets/img/profile/portfolio/logo_azteca.jpg">
											<div class="portfolio-text-info">
												<h4>Metronic - Responsive Template</h4>
												<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>
											</div>
										</div>
										<div class="span5">
											<div class="portfolio-info">
												Today Sold
												<span>24</span>
											</div>
											<div class="portfolio-info">
												Total Sold
												<span>660</span>
											</div>
											<div class="portfolio-info">
												Earns
												<span>$7.060</span>
											</div>
										</div>
										<div class="span2 portfolio-btn">
											<a class="btn bigicn-only" href="#"><span>Manage</span></a>                      
										</div>
									</div>
									<!--end row-fluid-->
									<div class="row-fluid portfolio-block">
										<div class="span5 portfolio-text">
											<img alt="" src="assets/img/profile/portfolio/logo_conquer.jpg">
											<div class="portfolio-text-info">
												<h4>Metronic - Responsive Template</h4>
												<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>
											</div>
										</div>
										<div style="overflow:hidden;" class="span5">
											<div class="portfolio-info">
												Today Sold
												<span>24</span>
											</div>
											<div class="portfolio-info">
												Total Sold
												<span>975</span>
											</div>
											<div class="portfolio-info">
												Earns
												<span>$21.700</span>
											</div>
										</div>
										<div class="span2 portfolio-btn">
											<a class="btn bigicn-only" href="#"><span>Manage</span></a>                      
										</div>
									</div>
									<!--end row-fluid-->	
								</div>
								
								
								
								
								<!--end tab-pane-->
							</div>
						</div>
						<!--END TABS-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->         
			</div>
			<!-- BEGIN PAGE CONTAINER-->     
		</div>
		<!-- END PAGE --> 
	</div>
	<script>
	function toggleContractEndDate(val){
		
		if(val!=<?php echo EMPLOYEE_CONTRACT;?>){
			
			if($('#ContractEndDate_div').is(":visible")==true){
				$('#ContractEndDate_div').hide('slow');
				var title = '<?php echo $Lang['gritter_title']?>';
				var text = '<b><?php echo $Lang['contract_end_date']?></b> is not appliable and is hidden in the form now';
				$.gritter.add({
				    title: title,
				    text: text,
				    sticky: false,
				    class_name: 'my-sticky-class'
				});
			}
		}
		else{
			$('#ContractEndDate_div').show('slow');
			var title = '<?php echo $Lang['gritter_title']?>';
			var text = '<b><?php echo $Lang['contract_end_date']?></b> is appliable and added to the form now';
			$.gritter.add({
			    title: title,
			    text: text,
			    sticky: false,
			    class_name: 'gritter-light'
			});
		}
		
	}

	</script>
	<!-- END CONTAINER -->
	<?php 
		$ready_js = "var handlePasswordStrengthChecker = function (field) {
        var initialized = false;
        var input = $(\"#\"+field);

        input.keydown(function(){
            if (initialized === false) {
                // set base options
                input.pwstrength({
                    raisePower: 1.4,
                    minChar: 8,
                    verdicts: [\"Weak\", \"Normal\", \"Medium\", \"Strong\", \"Very Strong\"],
                    scores: [17, 26, 40, 50, 60]
                });

                // add your own rule to calculate the password strength
                input.pwstrength(\"addRule\", \"demoRule\", function (options, word, score) {
                    return word.match(/[a-z].[0-9]/) && score;
                }, 10, true);

                // set progress bar's width according to the input width
                $('.progress').css('width', input.outerWidth() - 2); 

                // set as initialized 
                initialized = true;
            }
        });        
    }\n";
		
		
	$ready_js .= "var handleUsernameAvailabilityChecker2 = function (field) {
			$(\"#\"+field).change(function(){
				var input = $(this);
		
				if (input.val() === \"\") {
					return;
				}
		
				input.attr(\"readonly\", true).
				attr(\"disabled\", true).
				addClass(\"spinner\");
		
				$.post('index.php?ctr=user_username_checker&IsAjax=1', {UserName: input.val()}, function(res) {
					input.attr(\"readonly\", false).
					attr(\"disabled\", false).
					removeClass(\"spinner\");
		
					input.popover('destroy');
					input.popover({
						'html': true,
						'placement' : App.isRTL() ? 'left' : 'right',
						'title': 'Username Availability',
						'content': res.message,
					});
		
						// change popover font color based on the result
						if (res.status == 'OK') {
							input.data('popover').tip().addClass('success');
						} else {
							input.data('popover').tip().addClass('error');
						}
		
						// set last poped popover to be closed on click(see App.js => handlePopovers function)
						App.setLastPopedPopover(input);
		
						input.popover('show');
		
				}, 'json');
		
			});
		}\n";	
		
		$ready_js .= "var handleDatePickers = function () {
		
			if (jQuery().datepicker) {
				$('.date-picker').datepicker({
					rtl : App.isRTL(),
					format: 'yyyy-mm-dd',
				});
			}
		}\n";
		
		
		
		
		$ready_js .= "var demo3 = function() {

			var jcrop_api,
			boundx,
			boundy,
			// Grab some information about the preview pane
			  
			
			
		
			xsize = $('#preview-pane .thumbpreview-container').width(),
			ysize = $('#preview-pane .thumbpreview-container').height();
		
			console.log('init',[xsize,ysize]);
		
			$('#demo3').Jcrop({
				onChange: updateCord,
				onSelect: updateCord,
				boxWidth: 500,
        		boxHeight: 500,
         		aspectRatio:1,
                setSelect: [0,0,100,100]
				
			},function(){
				// Use the API to get the real image size
				var bounds = this.getBounds();
				boundx = bounds[0];
				boundy = bounds[1];
				// Store the API in the jcrop_api variable
				jcrop_api = this;
				// Move the preview into the jcrop container for css positioning
				$('#preview-pane').appendTo(jcrop_api.ui.holder);
			});
						
				function updateCord(c)
				{
					if (parseInt(c.w) > 0)
					{
						var rx = xsize / c.w;
						var ry = ysize / c.h;
		
						$('#preview-pane .thumbpreview-container img').css({
							width: Math.round(rx * boundx) + 'px',
							height: Math.round(ry * boundy) + 'px',
							marginLeft: '-' + Math.round(rx * c.x) + 'px',
							marginTop: '-' + Math.round(ry * c.y) + 'px'
						});
										
						$('#crop_x').val(c.x);
				        $('#crop_y').val(c.y);
				        $('#crop_w').val(c.w);
				        $('#crop_h').val(c.h);	
					}
				};
										
					
		}\n";
		$ready_js .= " handlePasswordStrengthChecker('Password1');\n handleUsernameAvailabilityChecker2('UserName');\n handleDatePickers();\n demo3()\n";
		$ready_js.= "$('#Avatar').change(function() {
						$('#crop_image_btn').hide();
			}); 
															";
		$ready_js .= Display_Action_Msg();
		 
include_once 'application/view/template/'.$_SESSION['theme'].'/admin_footer.php';
?>
