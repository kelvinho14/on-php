<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

	$input ['title'] = 'Milestone';
	$input ['attr'] = array (
			'class' => 'control-label' 
	);
	$input ['action'] ['fullscreen'] = true;
	
	UIElementController::render ( "portlet_start", $input );
	unset ( $input );
	?>
<div class="form-body">
	<!--  <div class="form-group form-md-line-input">-->
	<div class="form-group">
		<div class="row">
			<div class="col-md-4">
						<?php
						$input ['attr'] ['class'] = 'btn btn-sm default blue ';
						$input ['value'] = UIElementController::In_To_String ( "fa", array (
								'fa' => 'plus' 
						) );
						$input ['attr'] ['data-toggle'] = "modal";
						$input ['href'] = '#msnewmodal';
						// href="#static"
						UIElementController::render ( "a", $input );
						unset ( $input );
						?>
					</div>
			<div class="col-md-4">
				<div class="form-group">
						<?php
						
						$input ['attr'] ['class'] = 'btn btn-sm default purple';
						$input ['attr'] ['onClick'] = 'zoom(-0.5)';
						$input ['value'] = UIElementController::In_To_String ( "fa", array (
								'fa' => 'search-minus' 
						) );
						UIElementController::render ( "a", $input );
						unset ( $input );
						
						$input ['attr'] ['class'] = 'btn btn-sm default yellow';
						$input ['attr'] ['onClick'] = 'zoom(0.5)';
						$input ['value'] = UIElementController::In_To_String ( "fa", array (
								'fa' => 'search-plus' 
						) );
						UIElementController::render ( "a", $input );
						unset ( $input );
						
						?>
						<?php
						$input ['attr'] ['class'] = 'btn btn-sm default green';
						
						$input ['attr'] ['onClick'] = 'MS.today()';
						$input ['value'] = UIElementController::In_To_String ( "fa", array (
								'fa' => 'space-shuttle' 
						) );
						UIElementController::render ( "a", $input );
						unset ( $input );
						?>
						</div>
			</div>

			<div class="col-md-4">
						
						<?php
						$input ['for'] = 'm';
						$input ['value'] = 'Jump to';
						$input ['attr'] = array (
								'class' => 'control-label col-md-4' 
						);
						UIElementController::render ( "label", $input );
						unset ( $input );
						?>
						<div data-date-start-date="+0d" data-date-format="dd-mm-yyyy"
					class="input-group input-small date date-picker">
					<input type="text" class="form-control" readonly id="ms_goto"
						onChange="MS.go()"> <span class="input-group-btn">
						<button class="btn default" type="button">
							<i class="fa fa-calendar"></i>
						</button>
					</span>
				</div>
			</div>
		</div>



		<!--  <div class="input-group input-medium date date-picker">

					<input type="text" class="form-control" readonly id="ms_goto"
						onChange="MS.go()"> <span class="input-group-btn">
						<button class="btn default" type="button">
							<i class="fa fa-calendar"></i>
						</button> </span>
				</div>-->
		<div class="form-group">

				<?php
				$input ['id'] = 'mytimeline';
				// $input['attr'] = array('style'=>'height:400px');
				UIElementController::render ( "div", $input );
				unset ( $input );
				?>
					<!-- <input type="hidden" id="txtContent" name="txtContent" />-->
		</div>
		<div id="milestone_info"></div>

	</div>


			<?php
			
			UIElementController::render ( "portlet_end" );
			unset ( $input );
			?>
		</div>

		

<div id="msnewmodal" class="modal fade draggable-modal container " data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true"></button>
				<h4 class="modal-title">Add milestone</h4>
			</div>
			<div class="modal-body">
				<div class="scroller" style="height: 300px" data-always-visible="1"
					data-rail-visible1="1">
					<div class="row">
						<div class="col-md-6 ">
							<?php
							$input ['for'] = 'msnewstart';
							$input ['value'] = '<b>Milestone Name</b>';
							$input ['attr']['class'] ='control-label'; 
							
							UIElementController::render ( "label", $input );
							unset ( $input );
							
							$input ['id'] = 'msnewname';
							$input ['attr']['class'] = 'form-control';
							UIElementController::render ( "input", $input );
							unset ( $input );
								
							
							$input ['for'] = 'msnewstart';
							$input ['value'] = '<b>Milestone Start</b>';
							$input ['attr'] = array (
									'class' => 'control-label' 
							);
							UIElementController::render ( "label", $input );
							unset ( $input );
							
							?>
							<div class="input-group input-medium date date-picker">
									<input type="text" id="msnewstart" class="form-control" readonly>
									<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
							</div>
							<?php 
							$input ['for'] = 'msnewend';
							$input ['value'] = '<b>Milestone End</b>';
							$input ['attr'] = array (
									'class' => 'control-label'
							);
							UIElementController::render ( "label", $input );
							unset ( $input );
							?>
							<div class="input-group input-medium date date-picker">
									<input type="text" id="msnewend" class="form-control" readonly>
									<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
							</div>
								
						</div>
						<div class="col-md-6">
							<?php 
							$input ['for'] = 'msnewobjective';
							$input ['value'] = '<b>Objective</b>';
							$input ['attr'] = array (
									'class' => 'control-label'
							);
								
							UIElementController::render ( "label", $input );
							unset ( $input );
							?>
							<textarea class="wysihtml5 form-control" rows="6"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" class="btn green">Save changes</button>
			</div>
		</div>
	</div>
</div>