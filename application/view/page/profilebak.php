<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

if($Data['self']){
	$_PLUGIN['crop'] = true;
}

include_once 'application/view/template/'.$CONFIG['theme'].'/header.php';
?>
	<div class="container">
	<?php if(UserModel::isArtist()){include_once('poststatus.php');}?>
            <!-- <div class="cover profile">
              <div class="wrapper">
                <div class="image">
                  <img src="http://dev.maruon.net/theme/assets/socialhtml/images/profile-cover.jpg" alt="people" />
                </div>
              </div>
              <div class="cover-info">
                <div class="avatar">
                  <img src="<?php 
                  
                  echo UserModel::renderProfilePicSrc($Data['artist']['ProfilePic'],$Data['artist']['UserID'],3);?>" alt="people" id="profileimage"/>
                  <?php //<?php echo UserModel::renderProfilePicSrc($Data['artist']['ProfilePic'],'',1);?>
                  
                </div>
                <div class="name">
                	<a href="#"><?php echo $Data['artist']['UserName']?></a>
                	<?php if($Data['self'] || isloggedin()==false){
                		
                	}elseif($Data['followed']){
                		echo ui::unfollowBtn();
                	}else{
                		echo ui::followBtn();
                		
                	}?>
                	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border:0px;background-color:#ffffff" data-id="<?php echo $Data['object']['OID']?>">
	        	<?php echo ui::fa('share')?>
	        </button>
			<ul class="dropdown-menu" >
				<?php foreach($CONFIG['post_share'] as $social){
					$func = 'share2'.$social[1];
					$shareobj = $func('page/post/'.$Data['object']['OID']);
					 
				?>
				<li><a href="<?php echo $shareobj['link']?>" target="_blank"><?php echo ui::fa($social[0]).' '.$social[1]?></a></li>
				<?php }?>
	        </ul>
                </div>
                <?php if($Data['self']){?>
                  <br/><div class="btn fileinput-button" style="z-index:5">
						        <button id="" type="button" class="btn "><i class="fa fa-photo"></i><?php echo $Lang['changeprofilepic']?></button>						        
						        <input type="file" name="profileimageupload" id="profileimageupload" >
						    </div>
						    <?php }?>
              </div>
            </div>-->
			<div class="row">
				<div class="col-md-12">
		            <div class="tabbable panel panel-default">
		            	<div class="panel-body ">
		            		<div class="row">
			            		<div class="col-md-8">
				            		<div class="profilename">
					                	<a href="#"><?php echo $Data['artist']['UserName']?></a>
				                	</div>
				                    <ul class="list-unstyled profile-about margin-none">
				                      <li class="padding-v-5">
				                        <div class="row">
				                          <div class="col-sm-4"><span class="text-muted"><?php echo $Lang['debut_year']?></span></div>
				                          <div class="col-sm-8"><?php echo display::displayDate($Data['artist']['DebutDate'])?></div>
				                        </div>
				                      </li>
				                      <li class="padding-v-5">
				                        <div class="row">
				                          <div class="col-sm-4"><span class="text-muted">Type</span></div>
				                          <div class="col-sm-8"><?php echo $Data['artist']['Type']?></div>
				                        </div>
				                      </li>
				                      <li class="padding-v-5">
				                        <div class="row">
				                          <div class="col-sm-4"><span class="text-muted">From</span></div>
				                          <div class="col-sm-8"><?php echo $Data['artist']['Place']." ".$Data['artist']['State']?></div>
				                        </div>
				                      </li>
				                      <li class="padding-v-5">
				                        <div class="row">
				                          <div class="col-sm-4"><span class="text-muted">Level</span></div>
				                          <div class="col-sm-8"><?php echo UserModel::renderBadge($Data['artist']['Level'])?></div>
				                        </div>
				                      </li>
				                      <?php if($Data['artist']['Bio']!=''){?>
				                      <li class="padding-v-5">
				                      	<div class="row">
				                      		<div class="col-sm-12">
				                      		 <div class="expandable expandable-trigger">
							                    <div class="expandable-content">
							                      <p><?php echo nl2br($Data['artist']['Bio'])?></p>
							                    </div>
							                  </div>
				                      		</div>
				                      	</div>
				                      </li>
				                      <?php }?>
				                    </ul>
				                    <?php if($Data['self'] || isloggedin()==false){
				                		
				                	}elseif($Data['followed']){
				                		echo ui::unfollowBtn();
				                	}else{
				                		echo ui::followBtn();
				                		
				                	}?>
				                	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border:0px;background-color:#ffffff" data-id="<?php echo $Data['object']['OID']?>">
							        	<?php echo ui::fa('share')?>
							        </button>
									<ul class="dropdown-menu" >
										<?php foreach($CONFIG['post_share'] as $social){
											$func = 'share2'.$social[1];
											$shareobj = $func('page/post/'.$Data['object']['OID']);
											 
										?>
										<li><a href="<?php echo $shareobj['link']?>" target="_blank"><?php echo ui::fa($social[0]).' '.$social[1]?></a></li>
										<?php }?>
							        </ul>
			                    </div>
			                    <div class="col-md-4">
			                    	<div class="cover-info">
						                <div class="avatar">
						                  <img src="<?php echo UserModel::renderProfilePicSrc($Data['artist']['ProfilePic'],$Data['artist']['UserID'],4);?>" />
						                  <?php list($pcolor,$scolor) = display::artistColor($Data['artist']['Color']);?>
						                  <div style="background-color:<?php echo $scolor?>;" class="center profileartistcolor"> <?php echo $Data['artist']['ArtistType']?> </div>
						                </div>
						                <?php if($Data['self']){?>
						                  <br/>
						                  <div class="btn fileinput-button" style="z-index:5">
										  	<button id="" type="button" class="btn "><i class="fa fa-photo"></i><?php echo $Lang['changeprofilepic']?></button>						        
											<input type="file" name="profileimageupload" id="profileimageupload" >
										  </div>
										<?php }?>
						              </div>
			                    </div>
		                    </div>
		                  </div>
				    </div>
            	</div>
            </div>
            <div class="row">
				<div class="col-md-12">
            		<div class="tabbable panel panel-default">
		              <ul class="nav nav-tabs">
		              	<li class="active"><a href="#<?php echo ObjectModel::text?>container" data-toggle="tab" id="posttab" data-item="<?php echo ObjectModel::text?>"><?php echo $Lang['post']?></a></li>
		              	<li><a href="#<?php echo ObjectModel::extvideo?>container" data-toggle="tab" id="videotab" data-item="<?php echo ObjectModel::extvideo?>"><?php echo $Lang['video']?></a></li>
		              </ul>
		              <div class="tab-content">
			          		<div class="tab-pane fade active in" id="<?php echo ObjectModel::text?>container">
					        	<div class="row timeline">
						        <?php echo $Data['feed_display'][ObjectModel::text]?>
						        </div>
				           </div>
				           <div class="tab-pane fade " id="<?php echo ObjectModel::extvideo?>container">
								<div class="row timeline"></div>
				           </div>
		              </div>
		             </div>
				</div>
           </div>
        </div>
	</div>
        <!-- /st-content-inner -->

	</div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->
    <a data-toggle="modal" href="<?php echo $CONFIG['home_http'].'user/cropprofilepic'?>" id="croppiclink" data-target="#modal" style="dispaly:none"></a>
	<input type="hidden" name="<?php echo ObjectModel::extvideo?>page_count" id="<?php echo ObjectModel::extvideo?>page_count" value="0">
	<input type="hidden" name="savedpage_count" id="savedpage_count" value="0">
	<input type="hidden" name="page_count" id="page_count" value="1">
	<input type="hidden" name="page_type" id="page_type" value="<?php echo ObjectModel::text?>">
<?php
include_once 'application/view/template/'.$CONFIG['theme'].'/footer.php';
?>
