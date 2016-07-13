				
			<div class="row ">
				<div class="col-md-6">
					<?php
					$input['action']['fullscreen'] = true;
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
								
								
							</div>
							<?php UIElementController::render ( "portlet_end" );
							unset ( $input );
							?>
						</div>
					</div>
					<!-- END PAGE CONTENT-->
				<form id="mainform" name="mainform" method="post" enctype="multipart/form-data" onsubmit="setFormSubmitting()">
					<div class="col-md-6">
						<?php
							$input['action']['fullscreen'] = true;
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
										
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'channeltoolid';
											$input['name'] = 'channeltoolid';
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_channel_empty'];
											$input['option'] = $Data['channeltooloption'];
											$input['value'] = $Data['field']['channeltoolid'];
											UIElementController::render ( "select", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['channeltool']?></label>
										
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'clientid';
											$input['value'] = $Data['field']['clientid'];
											$input['name'] = 'clientid';
											$input['option'] = $Data['userfilteroption'];
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_client_empty'];
											UIElementController::render ( "select", $input );
											unset($input);
											echo ui::btn($Admin_Lang['cannotfindaddnewclient'],array('id'=>'addclientbtn','attr'=>array('class'=>'bg-blue-madison')));
											?>
											<div id="newclientdiv" style="display:none">
												<?php 
												$input['attr']['class'] = 'form-control';
												$input['attr']['placeholder'] = $Admin_Lang['firstname'];
												$input['id'] = 'newclientfirstname';
												$input['name'] = 'newclientfirstname';
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_client_empty'];
												UIElementController::render ( "input", $input );
												unset($input);
												
												/*$input['attr']['class'] = 'form-control';
												$input['attr']['placeholder'] = $Admin_Lang['lastname'];
												$input['id'] = 'newclientlastname';
												$input['name'] = 'newclientlastname';
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_client_empty'];
												UIElementController::render ( "input", $input );
												unset($input);
												
												$input['attr']['class'] = 'form-control';
												$input['attr']['placeholder'] = $Admin_Lang['uniquestring'];
												$input['id'] = 'newclientuniquestring';
												$input['name'] = 'newclientuniquestring';
												$input['attr']['data-emptymsg'] = $Admin_Lang['warning_client_empty'];
												UIElementController::render ( "input", $input );
												unset($input);*/
												
												echo ui::addBtn('',array('id'=>'addnewclientbtn'));
												?>
											</div>
											<label for="form_control_1"><?php echo $Admin_Lang['project_clientname']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'board';
											$input['name'] = 'board';
											$input['value'] = $Data['field']['board'];
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_board_empty'];
											UIElementController::render ( "input", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['board']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'clientactivity';
											$input['name'] = 'clientactivity';
											$input['option'] = $Data['clientactivityoption'];
											$input['value'] = $Data['field']['clientactivity'];
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_clientactivity_empty'];
											UIElementController::render ( "select", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['clientactivity']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											
											$input['id'] = 'message';
											$input['name'] = 'message';
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_clientmessage_empty'];
											$input['value'] = $Data['field']['message'];
											UIElementController::render ( "textarea", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['clientmessage']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'link';
											$input['name'] = 'link';
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_link_empty'];
											$input['value'] = $Data['field']['link'];
											UIElementController::render ( "input", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['link']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'outreachmethod';
											$input['name'] = 'outreachmethod';
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_outreachmethod_empty'];
											$input['option'] = $Data['outreachmethodoption'];
											$input['value'] = $Data['field']['outreachmethod'];
											UIElementController::render ( "select", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['outreachmethod']?></label>
									</div>
									<?php for($a=1;$a<5;$a++){?>
									<div class="form-group form-md-line-input has-success">
										<?php 
										$input['attr']['class'] = 'form-control codeinput';
										$input['id'] = 'code'.$a;
										$input['name'] = 'code'.$a;
										$input['value'] = $Data['field']['code'.$a];
										$input['attr']['data-emptymsg'] = $Admin_Lang['warning_project_coding_empty'];
										$input['option'] = $Data['objectivecategoryoption'];
										$input['attr']['data-duplicatevalue'] = $Admin_Lang['duplicatedobjectcategorychosen'];
										UIElementController::render ( "select", $input );
										unset($input);
										?>
									<label for="form_control_1"><?php echo $Admin_Lang['objectivecategory'.$a]?></label>
									</div><?php }?>
									<div class="form-group form-md-line-input has-success">
											<?php 
											
											$input['id'] = 'staffmessage';
											$input['name'] = 'staffmessage';
											$input['value'] = $Data['field']['staffmessage'];
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_staffmessage_empty'];
											UIElementController::render ( "textarea", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['staffmessage']?></label>
									</div>
									<div class="form-group form-md-line-input has-success">
											<?php 
											$input['attr']['class'] = 'form-control';
											$input['id'] = 'discussion';
											$input['name'] = 'discussion';
											$input['value'] = '1';
											$input['checked'] = $Data['field']['discussion']==true?true:false;
											$input['attr']['data-emptymsg'] = $Admin_Lang['warning_discussion_empty'];
											UIElementController::render ( "checkbox", $input );
											unset($input);
											?>
											<label for="form_control_1"><?php echo $Admin_Lang['sexual_discussion']?></label>
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
					