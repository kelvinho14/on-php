<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<table class="table table-striped table-advance table-hover">
	<thead>
		<tr>
			<th colspan="3">
				<input type="checkbox" class="mail-checkbox mail-group-checkbox">
				<div class="btn-group">
					<a class="btn mini blue" href="#" data-toggle="dropdown">
					More
					<i class="icon-angle-down "></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="icon-pencil"></i> Mark as Read</a></li>
						<li><a href="#"><i class="icon-ban-circle"></i> Spam</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-trash"></i> Delete</a></li>
					</ul>
				</div>
			</th>
			<th class="text-right" colspan="3">
				<ul class="unstyled inline inbox-nav">
					<li><span>1-30 of 789</span></li>
					<li><i class="icon-angle-left  pagination-left"  onclick="window.location.href='page1.php'"></i></li>
					<li><i class="icon-angle-right pagination-right" onclick="window.location.href='page2.php'"></i></li>
				</ul>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php for($a=0;$a<sizeof($Data['task_list']);$a++){?>
		<tr class="unread">
		
			<td class="inbox-small-cells">
				<input type="checkbox" class="mail-checkbox">
			</td>
			<td class="inbox-small-cells"><i class="icon-star <?php echo $Data['task_list'][$a]['IsStar']?'inbox-started':''?>"></i></td>
			<td class="view-message  hidden-phone"><?php echo $Data['task_list'][$a]['Name']?></td>
			<td class="view-message "><?php echo $Data['task_list'][$a]['Content']==''?'--':$Data['task_list'][$a]['Content']?></td>
			<td class="view-message  inbox-small-cells"><i class="icon-paper-clip"></i></td>
			<td class="view-message  text-right">16:30 PM</td>
		</tr>
		<?php }?>
		
	</tbody>
</table>