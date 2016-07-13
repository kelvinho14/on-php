<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" id="tasktile">
	<a class="dashboard-stat dashboard-stat-light <?echo $CONFIG['task']['color']?>" href="<?php echo $CONFIG['home_http']?>task/mytask">
		<div class="visual">
			<?php echo ui::fa($CONFIG['task']['fa'])?>
		</div>
		<div class="details">
			<div class="number">
			 <?php echo $Data['totaltask']?>
			</div>
			<div class="desc" id="tasktiletitle">
			 <?php echo $Admin_Lang['task']?>
			</div>
		</div>
	</a>
</div>