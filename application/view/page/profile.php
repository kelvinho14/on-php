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
        	<div class="row">
				<div class="col-md-12">
		            <div class="tabbable panel panel-default">
		            	<div class="panel-body ">
		            		<div class="row">
		            			<div class="col-xs-6 col-md-4 col-lg-2">
			                    	<div class="cover-info">
						                <div class="avatar">
						                  <img src="<?php echo UserModel::renderProfilePicSrc($Data['artist']['ProfilePic'],$Data['artist']['UserID'],3);?>" />
						                  <?php list($pcolor,$scolor) = display::artistColor($Data['artist']['Color']);?>
						                  <div style="background-color:<?php echo $scolor?>;" class="center profileartistcolor"> <?php echo $Data['artist']['ArtistType']?> </div>
						                </div>
						              </div>
			                    </div>
			                    <div class="col-xs-6 col-md-8 col-lg-10">
			                    	<div class="profilename">
					                	<a href="javascript:;" class="name"><?php echo $Data['artist']['UserName']?></a><?php echo UserModel::renderBadge($Data['artist']['Level'])?>
					                	
					                	<div class="profilestats">
										 	<i class="fa fa-hand-o-left"></i> 12<?php echo $Data['artist']['FansTotal']?> 
										 	<i class="fa fa-group"></i> 4124<?php echo $Data['artist']['FriendsTotal']?> 
										 </div>
					                </div>
			                    </div>
			                   </div> 
			                   <div class="row">
			            			<div class="col-xs-12 col-md-12 col-lg-12">
			                   		<?php
						                
						                echo '<a data-toggle="modal" class="modalbtn" data-modalclass="modal-sm" data-target="#modal" href="'.$CONFIG['home_http'].'qrcode/'.$Data['artist']['UserName'].'">'.ui::fa('qrcode fa-2x').'</a>';	
						                
						                $Data['sharelink'] = 'page/'.$Data['artist']['UserName'];
						                include(dirname(dirname(__FILE__)).'/object/share.php');
						                
						             if($Data['self'] || isloggedin()==false){
						              }elseif($Data['followed']){
						              		echo ui::unfollowBtn();
						               }else{
						                	echo ui::followBtn();
						               	}?>
						             </div>
			                   </div>
			                   <div class="row">
			            		<div class="col-xs-12 col-md-12 col-lg-12">
			            		    <ul class="list-unstyled profile-about margin-none">
				                      <li class="padding-v-5">
				                        <div class="row">
				                          <div class="col-xs-3 col-md-3 col-lg-3"><span class="text-muted"><?php echo $Lang['debut_year']?></span></div>
				                          <div class="col-xs-9 col-md-9 col-lg-9"><?php echo display::displayDate($Data['artist']['DebutDate'])?></div>
				                        </div>
				                      </li>
				                      <li class="padding-v-5">
				                        <div class="row">
				                          <div class="col-xs-3 col-md-3 col-lg-3"><span class="text-muted"><?php echo $Lang['artisttype']?></span></div>
				                          <div class="col-xs-9 col-md-9 col-lg-9"><?php echo $Data['artist']['Type']?></div>
				                        </div>
				                      </li>
				                      <li class="padding-v-5">
				                        <div class="row">
				                          <div class="col-xs-3 col-md-3 col-lg-3"><span class="text-muted"><?php echo $Lang['placeorigin']?></span></div>
				                          <div class="col-xs-9 col-md-9 col-lg-9"><?php echo $Data['artist']['Place']." ".$Data['artist']['State']?></div>
				                        </div>
				                      </li>
				                      <?php if($Data['artist']['Bio']!=''){?>
				                      <li class="padding-v-5">
				                      	<div class="row">
				                      		<div class="col-xs-12 col-md-12 col-lg-12">
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
			                    </div>
		                    </div>
		                  </div>
				    </div>
            	</div>
            </div>
            <?php if(false){?>
            <div class="row">
				<div class="col-md-12">
            		<div class="tabbable panel panel-default">
		              <ul class="nav nav-tabs">
		              	<li class="active"><a href="#<?php echo ObjectModel::text?>container" data-toggle="tab" id="posttab" data-item="<?php echo ObjectModel::text?>"><?php echo $Lang['post']?></a></li>
		              	<li><a href="#<?php echo ObjectModel::extvideo?>container" data-toggle="tab" id="videotab" data-item="<?php echo ObjectModel::extvideo?>"><?php echo $Lang['video']?></a></li>
		              	<li><a href="#container" data-toggle="tab" id="musictab" data-item=""><?php echo $Lang['music']?></a></li>
		              	
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
           </div><?php }?>
           <?php echo ui::btn($Lang['post'],array('class'=>'mediatype','attr'=>array('data-item'=>ObjectModel::text)));
           		 echo ui::btn($Lang['video'],array('class'=>'mediatype','attr'=>array('data-item'=>ObjectModel::extvideo)));
           		 echo ui::btn($Lang['music'])?>
           
           <div class="tab-pane fade active in" id="mediacontainer">
				<div class="row timeline">
				<?php echo $Data['feed_display'][ObjectModel::text]?>
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
	<!--  <input type="hidden" name="<?php echo ObjectModel::extvideo?>page_count" id="<?php echo ObjectModel::extvideo?>page_count" value="0">
	<input type="hidden" name="savedpage_count" id="savedpage_count" value="0">
	<input type="hidden" name="page_count" id="page_count" value="1">-->
	<input type="hidden" name="page_type" id="page_type" value="<?php echo ObjectModel::text?>">
<?php
include_once 'application/view/template/'.$CONFIG['theme'].'/footer.php';
?>
