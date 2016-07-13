<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

$_PLUGIN['crop'] = true;

include_once 'application/view/template/'.$CONFIG['theme'].'/header.php';
?>
	<div class="container">
		<?php if(UserModel::isArtist()){
			include(dirname(dirname(__FILE__)).'/page/poststatus.php');
		}?>
			<h2><?php echo $Lang['setting']?></h2>
        	<div class="row">
				<div class="col-md-12">
				
				<div class="tabbable panel panel-default">
		              <ul class="nav nav-tabs">
		              	<li class="active"><a href="#avatar" data-toggle="tab" ><?php echo $Lang['setting_avatar']?></a></li>
		              	<li><a href="#about" data-toggle="tab" ><?php echo $Lang['setting_general']?></a></li>
		              	<li><a href="#security" data-toggle="tab"><?php echo $Lang['setting_security']?></a></li>
		              </ul>
		              <div class="tab-content">
			          	<div class="tab-pane fade active in" id="avatar">
					        	<img src="<?php echo UserModel::renderProfilePicSrc($_SESION['profilepic'],$_SESION['user_id'],4);?>" id="profilepic"/>
					        		<br/>
			                        <div class="btn fileinput-button" style="z-index:5">
										<button id="" type="button" class="btn "><i class="fa fa-photo"></i><?php echo $Lang['changeprofilepic']?></button>						        
										<input type="file" name="profileimageupload" id="profileimageupload" >
									</div>
									<input type="hidden" id="crop_x" name="x"/>
									<input type="hidden" id="crop_y" name="y"/>
									<input type="hidden" id="crop_w" name="w"/>
									<input type="hidden" id="crop_h" name="h"/>
									<?php echo ui::btn($Lang['crop'],array('id'=>'cropbtn','attr'=>array('style'=>'display:none')))?>
				           </div>
				           <div class="tab-pane fade " id="about">
								<form class="form-horizontal" role="form">
								
									<div class="form-group">
			                          <label for="debutyear" class="col-sm-3 control-label"><?php echo $Lang['email']?></label>
			                          <div class="col-sm-9">
			                            <?php 
											
											$input['attr']['style'] = 'width:100%';
											$input['id'] = 'useremail';
											$input['name'] = 'useremail';
											
											echo  UIElementController::render ( "input", $input );
											unset($input);
										?>
			                          </div>
			                        </div>
					        		<div class="form-group">
			                          <label for="debutyear" class="col-sm-3 control-label"><?php echo $Lang['debut_year']?></label>
			                          <div class="col-sm-9">
			                            <?php 
											$input['attr']['data-toggle'] ="select2";
											$input['attr']['style'] = 'width:100%';
											$input['attr']['data-placeholder'] = $Lang['please_select'];
											$input['attr']['data-allow-clear'] = 'true';
											$input['id'] = 'debutyear';
											$input['name'] = 'debutyear';
											$input['option'] = display::addSelectOption($Data['debutyear_option']);
											
											echo  UIElementController::render ( "select", $input );
											unset($input);
										?>
			                          </div>
			                        </div>

			                        <div class="form-group">
			                          <label for="typeid" class="col-sm-3 control-label"><?php echo $Lang['artisttype']?></label>
			                          <div class="col-sm-9">
			                            <?php 
											$input['attr']['data-toggle'] ="select2";
											$input['attr']['style'] = 'width:100%';
											$input['attr']['data-placeholder'] = $Lang['please_select'];
											$input['attr']['data-allow-clear'] = 'true';
											$input['id'] = 'typeid';
											$input['name'] = 'typeid';
											$input['value'] = $_SESSION['artisttype_id'];
											$input['option'] = display::addSelectOption($Data['artist_type']);
											
											echo  UIElementController::render ( "select", $input );
											unset($input);
										?>
			                          </div>
			                        </div>
			                        <div class="form-group">
			                          <label for="state" class="col-sm-3 control-label"><?php echo $Lang['placeorigin']?></label>
			                          <div class="col-sm-9">
			                            <?php 
											$input['attr']['data-toggle'] ="select2";
											$input['attr']['style'] = 'width:100%';
											$input['attr']['data-placeholder'] = $Lang['please_select'];
											$input['attr']['data-allow-clear'] = 'true';
											$input['id'] = 'state';
											$input['name'] = 'state';
											//$input['value'] = $_SESSION['artisttype_id'];
											$input['option'] = display::addSelectOption($Data['places']);
											
											echo  UIElementController::render ( "select", $input );
											unset($input);
										?>
			                          </div>
			                        </div>
			                        
			                        <div class="form-group margin-none">
			                          <div class="col-sm-offset-3 col-sm-9">
			                            <button type="submit" class="btn btn-primary"><?php echo $Lang['save']?></button>
			                          </div>
			                        </div>
			                      </form>
				           </div>
				           <div class="tab-pane fade " id="security">
								<form class="form-horizontal" role="form">
					        		

			                        <div class="form-group">
			                          <label for="typeid" class="col-sm-3 control-label"><?php echo $Lang['password']?></label>
			                          <div class="col-sm-9">
			                            <?php 
											$input['attr']['style'] = 'width:100%';
											//$input['attr']['placeholder'] = $Lang['please_select'];
											$input['id'] = 'password1';
											$input['name'] = 'password1';
											echo  UIElementController::render ( "password", $input );
											unset($input);
										?>
			                          </div>
			                        </div>
			                        <div class="form-group">
			                          <label for="state" class="col-sm-3 control-label"><?php echo $Lang['password_retype']?></label>
			                          <div class="col-sm-9">
			                            <?php 
											$input['attr']['style'] = 'width:100%';
											//$input['attr']['placeholder'] = $Lang['please_select'];
											$input['id'] = 'password2';
											$input['name'] = 'password2';
											echo  UIElementController::render ( "password", $input );
											unset($input);
										?>
			                          </div>
			                        </div>
			                        
			                        <div class="form-group margin-none">
			                          <div class="col-sm-offset-3 col-sm-9">
			                            <button type="submit" class="btn btn-primary"><?php echo $Lang['save']?></button>
			                          </div>
			                        </div>
			                      </form>
				           </div>
		              </div>
		             </div>
            	</div>
            </div>
        </div>
	</div>
	</div>
    </div>
    

    
<?php
include_once 'application/view/template/'.$CONFIG['theme'].'/footer.php';
?>
