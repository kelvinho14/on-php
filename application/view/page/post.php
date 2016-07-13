<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

include_once 'application/view/template/'.$CONFIG['theme'].'/header.php';
?>
	<div class="container"> 
		<?php include_once('poststatus.php')?>
        
              
                        
		<?php echo $Data['post'];?>
        </div>
		</div>
	</div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->
	<input type="hidden" name="page_count" id="page_count" value="1">
<?php
include_once 'application/view/template/'.$CONFIG['theme'].'/footer.php';
?>
