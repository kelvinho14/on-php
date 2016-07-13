<div class="portlet light tasks-widget">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-share font-<?php echo $CONFIG['task']['color']?> hide"></i>
									<span class="caption-subject font-<?php echo $CONFIG['task']['color']?> bold uppercase"><?php echo $Data['itemlistname']?></span>
									<span class="badge-danger badge"><?php echo $Data['itemlisttotal']?></span>
								</div>
								<div class="actions">
									<div class="btn-group">
										<a class="btn <?php echo $CONFIG['task']['color']?> btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><?php echo $Admin_Lang['tasklist']?> <i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu pull-right">
											<?php 
											$size = sizeof($Data['mytasklist']);
											for($a=0;$a<$size;$a++){?>
											<li>
												<a href="javascript:;" class="focusMylist" data-id="<?php echo $Data['mytasklist'][$a]['ListID']?>" data-listname="<?php echo $Data['mytasklist'][$a]['Name']?>"><?php echo $Data['mytasklist'][$a]['Name']?> <span class="badge badge-danger"><?php echo $Data['mytasklist'][$a]['TaskNo']?> </span></a>
											</li>
											<?php }?>
											
										</ul>
									</div>
									<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="task-content">
									<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1">
										<!-- START TASK LIST -->
										<ul class="task-list">
											<?php $size = sizeof($Data['itemlist']);
											for($a=0;$a<$size;$a++){
											?>
												<li class="<?php echo $Data['itemlist'][$a]['ShowArchiveBtn']?'':'task-done'?>">
												<div class="task-checkbox">
													
													<?php 
													$input['attr']['class'] = 'liChild '.($Data['itemlist'][$a]['ShowArchiveBtn']?'mytaskarchive':'mytaskunarchive');
													$input['checked'] = $Data['itemlist'][$a]['ShowArchiveBtn']?false:true;
													$input['attr']['data-id'] = $Data['itemlist'][$a]['TaskID'];
													$input['other'] = ui::tt('top',$Admin_Lang['markasdone']);
													UIElementController::render("checkbox", $input );
													
													?>
													
												</div>
												<div class="task-title">
													<span class="task-title-sp"><?php echo $Data['itemlist'][$a]['Name']?></span>
													<?php if($Data['itemlist'][$a]['DisplayDeadline']!=''){?>
													<span class="task-bell">
													<?php UIElementController::render ( "fa", array('fa'=>'calendar') )?>
													</span><span><?php echo $Data['itemlist'][$a]['DisplayDeadline']?></span>
													<?php }?>
													
												</div>
												<div class="task-config">
													<div class="task-config-btn btn-group">
														<?php echo ui::editbtn(' ',array('attr'=>array('class'=>'taskedit','data-id'=>$Data['itemlist'][$a]['TaskID'])))?>
													</div>
												</div>
											</li>
											<?php }?>
										</ul>
										<!-- END START TASK LIST -->
									</div>
								</div>
								<div class="task-footer">
									<div class="btn-arrow-link pull-right">
										<a href="<?php echo $CONFIG['home_http'].'task/mytask'?>"><?php echo $Admin_Lang['gototask']?></a>
										<i class="icon-arrow-right"></i>
									</div>
								</div>
							</div>
						</div>