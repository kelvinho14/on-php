<div class="portlet box green" id="<?php echo $ElementData['table_id']?>_porlet">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i><?php echo $ElementData['title']?></div>
	</div>
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover table-full-width" id="<?php echo $ElementData['table_id']?>">
			<thead>
				<tr>
				<?php for($a=0;$a<sizeof($ElementData['column']);$a++){
				echo '<th>'.$ElementData['column'][$a].'</th>';
				}?>
				</tr>
			</thead>
			<tbody id="<?php echo $ElementData['tbody_id']?>">
			<?php 
				$filelist_size = sizeof($ElementData["data"]);
				for($a=0;$a<$filelist_size;$a++){?>
				<tr id="<?php echo $ElementData["data"][$a][0]['data']?>">
					<?php 
					for($b=1;$b<sizeof($ElementData['data'][$a]);$b++){
						echo '<td>';
						if($ElementData['data'][$a][$b]['url']!='')
							echo '<a href="'.$ElementData['data'][$a][$b]['url'].'">';
						echo $ElementData['data'][$a][$b]['data'];
						if($ElementData['data'][$a][$b]['url']!='')
							echo '</a>';
						echo '</td>';
					}
					?>
					
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>