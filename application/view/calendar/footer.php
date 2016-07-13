<h4> <?php echo $Admin_Lang['staffworkinghourstats']?> <small>(<?php echo $Data['startdate'].' - '.$Data['enddate']?>)</small></h4>
<table class="table table-striped table-bordered table-advance table-hover">
	<thead>
	<tr>
		<th><i class="fa fa-user"></i> <?php echo $Admin_Lang['user']?></th>
		<th><i class="fa fa-clock-o"></i> <?php echo $Admin_Lang['duration']?></th>
		<th>
			<i class="fa fa-file-text-o"></i> <?php echo $Admin_Lang['taskrecord']?>
		</th>
	</tr>
	</thead>
	<tbody>
		<?php 
		$size = sizeof($Data['staffstats']);
		
		if($size==0){
			echo '<tr><td colspan="3">'.$Admin_Lang['datatablezerorecords'].'</td></tr>';
		}else{
			for($a=0;$a<$size;$a++){
				
				echo '<tr>
			<td>
				<a href="javascript:;">
				'.$Data['staffstats'][$a]['Staffname'].'</a>
			</td>
			<td>
				 '.display::minutesToHr($Data['staffstats'][$a]['Duration']).'
			</td>
			<td>
				 '.$Data['staffstats'][$a]['Taskrecordcount'].'</a>
			</td>
		</tr>
		';
				
			}
			
		}
		?>
	</tbody>
</table>
<?php echo '<p><i class="fa fa-lightbulb-o"></i> '.$Admin_Lang['tips'].': '.$Admin_Lang['calendarfooter_guide'].'</p>';?>