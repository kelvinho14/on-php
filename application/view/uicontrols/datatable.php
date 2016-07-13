<div class="table-toolbar">
	<div class="row">
		<div class="col-md-6">
			<div class="btn-group">
				<?php echo $ElementData['btn']?>
			</div>
		</div>
		<?php if($ElementData['print']||$ElementData['pdf']||$ElementData['csv']||$ElementData['actionbtn']){?>
		<div class="col-md-6">
			<div class="btn-group pull-right">
				<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu pull-right">
					<?php if($ElementData['print']){?>
					<li>
						<a href="javascript:;">
						Print </a>
					</li>
					<?php }?>
					<?php if($ElementData['pdf']){?>
					<li>
						<a href="javascript:;">
						Save as PDF </a>
					</li>
					<?php }?>
					<?php if($ElementData['csv']){?>
					<li>
						<a href="javascript:;">
						Export to Excel </a>
					</li>
					<?php }?>
					<?php if($ElementData['actionbtn']){
						echo $ElementData['actionbtn'];
						
					}?>
				</ul>
			</div>
		</div>
		<?php }?>
	</div>
</div>
<table class="table table-striped table-bordered table-hover" id="<?php echo $ElementData['table_id']?>" data-sortAscending="activate to sort column ascending" data-search="<?php echo $Admin_Lang['search']?>:" data-all="<?php echo $Admin_Lang['all']?>" data-lengthmenu="_MENU_ <?php echo $Admin_Lang['record']?>" data-sortDescending="" data-emptyTable="" data-info="顯示 _START_ 至 _END_ 共 _TOTAL_ 項" data-filtered="<?php echo $Admin_Lang['datatableinfofiltered']?>" data-prev="<?php echo $Admin_Lang['datatableprev']?>" data-next="<?php echo $Admin_Lang['datatablenext']?>" data-first="<?php echo $Admin_Lang['datatablefirst']?>" data-last="<?php echo $Admin_Lang['datatablelast']?>" data-zeroRecords="<?php echo $Admin_Lang['datatablezerorecords']?>">
<thead>
<tr>
	
	<?php if($ElementData['hide_cb']==false){?>
		<th class="table-checkbox">
		<input type="checkbox" class="group-checkable" data-set="#<?php echo $ElementData['table_id']?> .checkboxes"/>
	</th>
		<?php }?>
		<?php for($a=0;$a<sizeof($ElementData['column']);$a++){
		echo '<th>'.$ElementData['column'][$a].'</th>';
		}?>
</tr>
</thead>
<tbody>
<?php for($a=0;$a<sizeof($ElementData['data']);$a++){
		echo '<tr>';
		echo '<td>';
		if($ElementData['data'][$a][0]['data'])
			echo '<input type="checkbox" name="'.$ElementData['data'][$a][0]['name'].'" class="checkboxes" value="'.$ElementData['data'][$a][0]['data'].'"/>';
		else 
			echo '&nbsp;';
		echo '</td>';
		
		for($b=1;$b<sizeof($ElementData['data'][$a]);$b++){
				echo '<td>';
				if($ElementData['data'][$a][$b]['url']!='')
					echo '<a href="'.$ElementData['data'][$a][$b]['url'].'">';
				echo $ElementData['data'][$a][$b]['data'];
				if($ElementData['data'][$a][$b]['url']!='')
					echo '</a>';
				echo '</td>';			
			}
		
		echo '</tr>';
	}?>
</tbody>
</table>