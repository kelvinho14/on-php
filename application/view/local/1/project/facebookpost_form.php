			<div class="row ">
				<div class="col-md-6">
					<?php
					
					UIElementController::render ( "portlet_start", $input );
					unset ( $input );?>
					<div class="portlet-body form">
						<div class="form-body">
							<div class="form-group form-md-line-input has-success">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="row">
										<div class="col-md-12">
											<p>
												<span class="label label-danger">NOTE: </span>&nbsp; This plugins works only on Latest Chrome, Firefox, Safari, Opera & Internet Explorer 10.
											</p>
											<form action="<?php echo $CONFIG['home_http']?>project/ajax_projectuploadfile/?cid=<?php echo $Data['channelid']?>" class="dropzone" id="my-dropzone" data-defaultmsg="<?php echo $Admin_Lang['dropzonedefaultmsg']?>"></form>
										</div>
									</div>
								</div>
							</div>
							
								
							<div class="row">
								<div class="col-md-12">
									<?php 
									if(sizeof($Data['records']['file'])>0){
										$filesize = sizeof($Data['records']['file']);
										for($f=0;$f<$filesize;$f++){
											echo '<p id="attachment_'.$Data['records']['file'][$f]['ID'].'"><img src="'.$Data['records']['file'][$f]['fileurl'].'" width="300px"/><br/><br/>';
											echo ui::removeBtn('',array('attr'=>array('class'=>'removeImage','data-id'=>$Data['records']['file'][$f]['ID'],'data-confirmmsg'=>$Admin_Lang['confirm_remove_image'])));
											echo '</p>';
										}
									}
									?>
								</div>
							</div>
								
							
							<form id="mainform" name="mainform" method="post" enctype="multipart/form-data" onsubmit="setFormSubmitting()">	
								
							</div>
							<?php UIElementController::render ( "portlet_end" );
							unset ( $input );
							?>
						</div>
					</div>
					<!-- END PAGE CONTENT-->
				
					<div class="col-md-6">
						<?php
							UIElementController::render ( "portlet_start", $input );
							unset ( $input );?>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon" >
											<i class="fa fa-calendar-o"></i>
											<?php 
											$input['attr']['class'] = 'form-control';
											$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_date_empty'];
											$input['value'] = $Data['Date'];
											$input['attr']['disabled']='';
											UIElementController::render("input", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['date']?></label>
										</div>
									</div>
									
									<div class="form-group form-md-line-input has-success">
										<div class="input-icon" >
											<i class="fa fa-calendar-o"></i>
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_date_empty'];
											$input['attr']['data-invalidmsg'] = $Admin_Lang['warning_date_invalid'];
											$input['attr']['data-format'] = setting::getDateFormat();
											$input['value'] = $Data['field']['postdate'];
											$input['id'] = 'postdate';
											$input['name'] = 'postdate';
											UIElementController::render("input", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['postdate']?></label>
										</div>
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											
											$input['id'] = 'staffmessage';
											$input['name'] = 'staffmessage';
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_postcontent_empty'];
											$input['value'] = $Data['field']['staffmessage'];
											UIElementController::render ( "textarea", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['postcontent']?></label>
									</div>
									
									
									<div class="form-group form-md-line-input has-success">
										<?php 
											$input['attr']['class'] = 'form-control';
											$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_postlink_empty'];
											$input['value'] = $Data['field']['postlink'];
											$input['id'] = 'postlink';
											$input['name'] = 'postlink';
											UIElementController::render("input", $input );
											unset($input);
											?>
									<label for="form_control_1"><?php echo $Admin_Lang['postlink']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
										<?php 
											$input['attr']['class'] = 'form-control';
											$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_likecount_empty'];
											$input['value'] = $Data['field']['likecount'];
											$input['id'] = 'likecount';
											$input['name'] = 'likecount';
											UIElementController::render("input", $input );
											unset($input);
											?>
									<label for="form_control_1"><?php echo $Admin_Lang['likecount']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
										<?php 
											$input['attr']['class'] = 'form-control';
											$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_sharecount_empty'];
											$input['value'] = $Data['field']['sharecount'];
											$input['id'] = 'sharecount';
											$input['name'] = 'sharecount';
											UIElementController::render("input", $input );
											unset($input);
											?>
									<label for="form_control_1"><?php echo $Admin_Lang['sharecount']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
										<?php 
											$input['attr']['class'] = 'form-control';
											$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_commentcount_empty'];
											$input['value'] = $Data['field']['commentcount'];
											$input['id'] = 'commentcount';
											$input['name'] = 'commentcount';
											UIElementController::render("input", $input );
											unset($input);
											?>
									<label for="form_control_1"><?php echo $Admin_Lang['commentcount']?></label>
									</div>
									<?php /*<div class="form-group form-md-line-input has-success">
										<?php 
											$input['attr']['class'] = 'form-control';
											$input['value'] = $Data['field']['contactcount'];
											$input ['attr'] ['data-emptymsg'] = $Admin_Lang ['warning_contactcount_empty'];
											$input['id'] = 'contactcount';
											$input['name'] = 'contactcount';
											UIElementController::render("input", $input );
											unset($input);
											?>
									<label for="form_control_1"><?php echo $Admin_Lang['contactcount']?></label>
									</div>*/
											?>
									<div class="form-group form-md-line-input has-success">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'discussion';
											$input['name'] = 'discussion';
											$input['value'] = '1';
											$input['checked'] = $Data['field']['discussion']==true?true:false;
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_discussion_empty'];
											UIElementController::render ( "input", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['sexual_discussion_count']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'volunteer';
											$input['name'] = 'volunteer';
											$input['value'] = '1';
											$input['checked'] = $Data['field']['volunteer']==true?true:false;
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_volunteer_empty'];
											UIElementController::render ( "checkbox", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['volunteer']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											$input['id'] = 'remark';
											$input['name'] = 'remark';
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_remark_empty'];
											$input['value'] = $Data['field']['remark'];
											UIElementController::render ( "textarea", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['remark']?></label>
									</div>
									
								</div>
						<?php UIElementController::render ( "portlet_end" );
							unset ( $input );
							?>								
						</div>
					</div>
				</div>
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-4 col-md-8">
						<?php echo ui::submitBtn('',array('id'=>'submitbtn'));?>
						<?php echo ui::backBtn('',array('id'=>'backbtn'));?>
					</div>
				</div>
			</div>
				<input type="hidden" id="maxfilesize" name="maxfilesize" value="<?php echo $Data['maxfilesize']?>"/>
				<input type="hidden" id="uploadfileid" name="uploadfileid" />
				<input type="hidden" id="jobtaskid" name="jobtaskid" value="<?php echo $Data['jobtaskid']?>"/>
				<input type="hidden" id="taskrecordid" name="taskrecordid" value="<?php echo $Data['taskrecordid']?>"/>
				<input type="hidden" id="channelid" name="channelid" value="<?php echo $Data['channelid']?>"/>
			</form>
					