<div class="modal-header" id="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" class="pull-right">&times;</button>
	<div class="panel-heading timeline-block">
    	<div class="media panel-heading media-body ">
        	<div class="media-left">
            	<a href="<?php echo $CONFIG['home_http'].'page/'.$Data['object']['OAName']?>"><img src="<?php echo UserModel::renderProfilePicSrc($Data['object']['OAPic'],$Data['object']['OUserID'],1)?>" class="media-object" height="65"></a>
            </div>
			<div class="media-body">
			<!--  <a href="#" class="pull-right text-muted"><i class="icon-reply-all-fill fa fa-2x "></i></a>-->
		    <div class="btn-group pull-right text-muted">
	        	<button type="button" class="btn btn-default dropdown-toggle postddmbtn" data-toggle="dropdown" style="border:0px;background-color:#ffffff" data-id="<?php echo $Data['object']['OID']?>">
	            	<span class="caret"></span>
	            </button>
	            <ul class="dropdown-menu">
	            	
	            </ul>
			</div>
			<span class="pull-right posttime"><?php echo display::dayAgo($Data['object']['OTime'])?></span>
	                      
			<a href="<?php echo $CONFIG['home_http'].'page/'.$Data['object']['OAName']?>"><?php echo $Data['object']['OAName']?> <?php echo UserModel::renderBadge($Data['object']['OALevel'])?></a>
				<span class="profilestats">
					<i class="fa fa-hand-o-left"></i> <?php echo $Data['object']['OAFansTotal']?> 
					<i class="fa fa-group"></i> <?php echo $Data['object']['OAFriendsTotal']?> 
				</span>
			</div>
		</div>
	</div>
</div>
<?php echo $Data['posthtml']?>
<div class="modal-footer">
</div>

<script>
$( document ).ready(function() {
	  Page.binding();
	  Page.bindPostMenu();
	  Page.bindPostMenuBtn();
});
</script>