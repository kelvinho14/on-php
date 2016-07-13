<?php if(UserModel::isArtist()){?>
		<div class="row" id="postrow" >
        	<div class="col-xs-12 col-md-12 col-lg-12">
            	<div class="timeline-block">
                	<div class="panel panel-default  clearfix-xs">
                    	<div class="panel-body">
                    		<div id="posttext">
                      			<textarea name="postcontent" class="form-control share-text" rows="3" placeholder="<?php echo $Lang['statusbox_placehoder']?>" id="postcontent" name="postcontent"></textarea>
						    </div>              		
                    	</div>
                    	<?php if($advanceupload){?>
                    	<form id="fileupload"  method="POST" enctype="multipart/form-data">
                    	<div id="photoupload" style="display:none">
	                      		<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
	                      		<div class="row fileupload-buttonbar">
						            <!-- The global progress state -->
						            <div class="col-lg-7" >
						                <!-- The fileinput-button span is used to style the file input field as button -->
						                <button type="submit" class="btn btn-primary start">
						                    <i class="glyphicon glyphicon-upload"></i>
						                    <span>Start upload</span>
						                </button>
						                <!-- The global file processing state -->
						                <span class="fileupload-process"></span>
						            </div>
						            <div class="col-lg-5 fileupload-progress fade">
						                <!-- The global progress bar -->
						                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
						                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
						                </div>
						                <!-- The extended global progress state -->
						                <div class="progress-extended">&nbsp;</div>
						            </div>
						        </div>
        					</div>
                    	
                    	</form>
                    	<?php }else{?>
                    	<div id="postuploadimage" style="display:none">
	                    	 <div id="progress" class="progress">
							 	<div class="progress-bar progress-bar-striped progress-bar-success active"></div>
							 </div>
							    <!-- The container for the uploaded files -->
							<div id="postfilediv" class="files"></div>
						</div>
                    	<?php }?>
                    	<div id="postuploadvideo" style="display:none">
                    		<input type="textbox" id="postvideolink" name="postvideolink" class="form-control" placeholder="<?php echo $Lang['embedvideo_placehoder']?>"/>
                    		<div id="embedtitle"></div>
                    		<div id="embedphoto"></div>
                    	</div>
                    	<div class="panel-footer share-buttons">
                    		<div class="btn fileinput-button">
						        <?php echo ui::fa('pencil',array('attr'=>array('id'=>"posttextcontent")))?>
						    </div>
                    		<div class="btn fileinput-button">
						        <?php echo ui::fa('photo')?>
						         <input id="postimagecontent" type="file" name="postimage" multiple>
						    </div>
						    <div class="btn">
                      			<?php echo ui::fa('video-camera',array('attr'=>array('id'=>"postvideocontent")))?>
                      		</div>
                      		<input type="hidden" id="posttype" name="posttype" value="1"/>
                      		<button type="button" class="btn btn-primary btn-xs pull-right " href="#" id="postbtn">Post</button>
                      		
                    	</div>
					</div>
				</div>

				
			</div>
		</div>
<?php }?>