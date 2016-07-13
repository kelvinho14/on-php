<?php 

//if($Data['myfeed']||$Data['ajaxview'])
	
if($Data['postfullwidth']){
	$class = 'col-xs-12 col-md-12 col-lg-12 ';
	//$imagewidth = '';
}else{
	$class = 'col-xs-12 col-md-6 col-lg-4 ';
	
}
$imagewidth = 'width="380px"';
list($pcolor,$scolor) = display::artistColor($Data['object']['OArtistColor']);

?>
<div class="<?php echo $class?>  item artisttype<?php echo $Data['object']['OArtistTypeID']?>" id="item_<?php echo $Data['object']['OID']?>">
	<div class="timeline-block" >
    	<div class="panel panel-default">
			<div class="panel-heading">
            	<div class="media">
                	<div class="media-left">
                    	<a href="<?php echo $CONFIG['home_http'].'page/'.$Data['object']['OAName']?>"><img src="<?php echo UserModel::renderProfilePicSrc($Data['object']['OAPic'],$Data['object']['OUserID'],2)?>" class="media-object mediaavatar" ></a>
                    	<div style="background-color:<?php echo $scolor?>;" class="center postartistcolor"> <?php echo $Data['object']['OArtistType']?> </div>
                    	
                     </div>
	                 <div class="media-body">
		                 <?php if(isLoggedIn()){?>
		                 <div class="btn-group pull-right text-muted">
	                        <button type="button" class="btn btn-default dropdown-toggle postddmbtn" data-toggle="dropdown" style="border:0px;background-color:#ffffff" data-id="<?php echo $Data['object']['OID']?>">
	                          <span class="caret"></span>
	                        </button>
	                        <ul class="dropdown-menu">
	                        	
	                        </ul>
	                     </div>
	                      <?php }?>
	                      <span class="pull-right posttime"><?php echo display::dayAgo($Data['object']['OTime'])?></span>
	                      
				         <a href="<?php echo $CONFIG['home_http'].'page/'.$Data['object']['OAName']?>"><?php echo $Data['object']['OAName']?> <?php echo UserModel::renderBadge($Data['object']['OALevel'])?></a>
						 <span class="profilestats">
						 	<i class="fa fa-hand-o-left"></i> <?php echo $Data['object']['OAFansTotal']?> 
						 	<i class="fa fa-group"></i> <?php echo $Data['object']['OAFriendsTotal']?> 
						 </span>
					</div>
				</div>
			</div>