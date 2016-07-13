<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="<?php echo $ElementData['title_icon']?>"></i><?php echo $ElementData['title']?></div>
								<div class="actions">
								<?php if($ElementData['toolbar_btns']!=''){
									for($a=0;$a<sizeof($ElementData['toolbar_btns']);$a++){
										
										switch($ElementData['toolbar_btns'][$a]['type']){	
											case 'add':
												echo '<a href="'.$ElementData['toolbar_btns'][$a]['url'].'" class="btn green"><i class="icon-plus"></i> '.$Lang['add'].'</a>';
											break;	
										}
									}
								}?>
								<?php if($ElementData['toolbar_btns2']!=''){?>
								<div class="btn-group">
									<a data-toggle="dropdown" href="#" class="btn green">
									<i class="icon-cogs"></i> Tools
									<i class="icon-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
										<li><a href="#"><i class="icon-trash"></i> Delete</a></li>
										<li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
										<li class="divider"></li>
										<li><a href="#"><i class="i"></i> Make admin</a></li>
									</ul>
								</div>
								<?php }?>
									<div class="btn-group">
										<a class="btn" href="#" data-toggle="dropdown">
										Columns
										<i class="icon-angle-down"></i>
										</a>
										<div id="<?php echo $ElementData['table_id']?>_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<?php for($a=0;$a<sizeof($ElementData['column']);$a++){
										echo '<label><input type="checkbox" checked data-column="'.($a+1).'">'.$ElementData['column'][$a].'</label>';
										}?>
											
										</div>
									</div>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover table-full-width" id="<?php echo $ElementData['table_id']?>">
									<thead>
										<tr>
										<?php if($ElementData['hide_cb']==false){?>
										<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#<?php echo $ElementData['table_id']?> .checkboxes" /></th>
										<?php }?>
										<?php for($a=0;$a<sizeof($ElementData['column']);$a++){
										echo '<th>'.$ElementData['column'][$a].'</th>';
										}?>
											
										</tr>
									</thead>
									<tbody>
										<?php 

										for($a=0;$a<sizeof($ElementData['data']);$a++){
										echo '<tr>';
										if($ElementData['hide_cb']==false){
											echo '<td><input type="checkbox" class="checkboxes" value="'.$ElementData['data'][$a][0].'" /></td>';
										}
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
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->