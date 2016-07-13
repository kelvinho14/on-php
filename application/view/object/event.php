<?php 
$json = json_decode($Data['object']['OData']);

if($Data['myfeed']){
	$class = 'col-xs-12 col-md-12 col-lg-12 ';
	//$imagewidth = '';
}else{
	$class = 'col-xs-12 col-md-6 col-lg-4 ';
	
}
$imagewidth = 'width="380px"';
?>

<div class="<?php echo $class?> item">
	<div class="timeline-block">
    	<div class="panel panel-default">
			<div class="panel-heading">
            	<div class="media">
                	<div class="media-left">
                    	<a href=""><img src="<?php echo $Data['object']['OAPic']?>" class="media-object" height="65"></a>
                     </div>
	                 <div class="media-body">
		                 <a href="#" class="pull-right text-muted"><i class="icon-reply-all-fill fa fa-2x "></i></a>
				         <span><div class="panel-heading title"><?php echo $json->Name?></div></span>
					</div>
				</div>
			</div>
			
			<ul class="icon-list icon-list-block">
                      <li><i class="fa fa-globe"></i> <?php echo $json->Place?></li>
                      <li><i class="fa fa-calendar-o"></i> <?php echo display::displayDate($json->Date)?></li>
                      <li><i class="fa fa-clock-o"></i> <?php echo display::displayTime($json->Date)?></li>
                      <li><i class="fa fa-users"></i> 9 Attendees <a href="#" class="btn btn-primary btn-stroke btn-xs pull-right">Attend</a></li>
                    </ul>
                    <div class="panel-body">
                    <ul class="img-grid">
                      <li>
                        <a href="#">
                          <img src="<?php echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/people/110/guy-6.jpg" alt="people" class="img-responsive" />
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <img src="<?php echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/people/110/woman-3.jpg" alt="people" class="img-responsive" />
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <img src="<?php echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/people/110/guy-2.jpg" alt="people" class="img-responsive" />
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <img src="<?php echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/people/110/guy-9.jpg" alt="people" class="img-responsive" />
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <img src="<?php echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/people/110/woman-9.jpg" alt="people" class="img-responsive" />
                        </a>
                      </li>
                      <li class="clearfix">
                        <a href="#">
                          <img src="<?php echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/people/110/guy-4.jpg" alt="people" class="img-responsive" />
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <img src="<?php echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/people/110/guy-1.jpg" alt="people" class="img-responsive" />
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <img src="<?php echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/people/110/woman-4.jpg" alt="people" class="img-responsive" />
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <img src="<?php echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/images/people/110/guy-6.jpg" alt="people" class="img-responsive" />
                        </a>
                      </li>
                    </ul>
                    </div>
<?php include('footer.php');?>                   