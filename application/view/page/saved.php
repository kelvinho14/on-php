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
            <?php if(false){?>
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
					              	<div class="row timeline">
						            </div>
				              	</div>
			              </div>
					</div>
				</div>
            </div>
            <?php }?>
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
	<input type="hidden" name="<?php echo ObjectModel::extvideo?>page_count" id="<?php echo ObjectModel::extvideo?>page_count" value="0">
	<input type="hidden" name="savedpage_count" id="savedpage_count" value="0">
	<input type="hidden" name="page_count" id="page_count" value="1">
	<input type="hidden" name="page_type" id="page_type" value="<?php echo ObjectModel::text?>">
<?php
include_once 'application/view/template/'.$CONFIG['theme'].'/footer.php';
?>
