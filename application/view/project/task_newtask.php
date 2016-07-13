<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<div class="scroller" style="max-height: 800px;" data-always-visible="0" data-rail-visible="0" data-handle-color="#dae3e7" >
<form action="#" class="form-horizontal">
	<!-- TASK HEAD -->
	<div class="form">
		<div class="form-group">
			<div class="col-md-8 col-sm-8">
				<div class="todo-taskbody-user">
					<img class="todo-userpic pull-left"
						src="/theme/assets/admin/layout2/img/avatar6.jpg" width="50px"
						height="50px"> <span class="todo-username pull-left">Vanessa Bond</span>
					<button type="button"
						class="todo-username-btn btn btn-circle btn-default btn-xs">&nbsp;edit&nbsp;</button>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="todo-taskbody-date pull-right">
					<button type="button"
						class="todo-username-btn btn btn-circle btn-default btn-xs">&nbsp;
						Complete &nbsp;</button>
				</div>
			</div>
		</div>
		<!-- END TASK HEAD -->
		<!-- TASK TITLE -->
		<div class="form-group">
			<div class="col-md-12">
				<input type="text" class="form-control todo-taskbody-tasktitle"
					placeholder="Task Title...">
			</div>
		</div>
		<!-- TASK DESC -->
		<div class="form-group">
			<div class="col-md-12">
				<textarea class="form-control todo-taskbody-taskdesc" rows="8"
					placeholder="Task Description..."></textarea>
			</div>
		</div>
		<!-- END TASK DESC -->
		<!-- TASK DUE DATE -->
		<div class="form-group">
			<div class="col-md-12">
				<div class="input-icon">
					<i class="fa fa-calendar"></i> <input type="text"
						class="form-control todo-taskbody-due" placeholder="Due Date...">
				</div>
			</div>
		</div>
		<!-- TASK TAGS -->
		<div class="form-group">
			<div class="col-md-12">
				<input type="text" class="form-control todo-taskbody-tags"
					placeholder="Tags..." value="Pending, Requested">
			</div>
		</div>
		<!-- TASK TAGS -->
		<div class="form-actions right todo-form-actions">
			<button class="btn btn-circle btn-sm green-haze">Save Changes</button>
			<button class="btn btn-circle btn-sm btn-default">Cancel</button>
		</div>
	</div>
	<div class="tabbable-line">
		<ul class="nav nav-tabs ">
			<li class="active"><a href="#tab_1" data-toggle="tab"> Comments </a>
			</li>
			<li><a href="#tab_2" data-toggle="tab"> History </a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_1">
				<!-- TASK COMMENTS -->
				<div class="form-group">
					<div class="col-md-12">
						<ul class="media-list">
							<li class="media"><a class="pull-left" href="javascript:;"> <img
									class="todo-userpic"
									src="/theme/assets/admin/layout2/img/avatar8.jpg" width="27px"
									height="27px"> </a>
								<div class="media-body todo-comment">
									<button type="button"
										class="todo-comment-btn btn btn-circle btn-default btn-xs">&nbsp;
										Reply &nbsp;</button>
									<p class="todo-comment-head">
										<span class="todo-comment-username">Christina Aguilera</span>
										&nbsp; <span class="todo-comment-date">17 Sep 2014 at 2:05pm</span>
									</p>
									<p class="todo-text-color">
										Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
										scelerisque ante sollicitudin commodo. Cras purus odio,
										vestibulum in vulputate at, tempus viverra turpis. <br>
									</p>
									<!-- Nested media object -->
									<div class="media">
										<a class="pull-left" href="javascript:;"> <img
											class="todo-userpic"
											src="/theme/assets/admin/layout2/img/avatar4.jpg"
											width="27px" height="27px"> </a>
										<div class="media-body">
											<p class="todo-comment-head">
												<span class="todo-comment-username">Carles Puyol</span>
												&nbsp; <span class="todo-comment-date">17 Sep 2014 at 4:30pm</span>
											</p>
											<p class="todo-text-color">Thanks so much my dear!</p>
										</div>
									</div>
								</div></li>
							<li class="media"><a class="pull-left" href="javascript:;"> <img
									class="todo-userpic"
									src="/theme/assets/admin/layout2/img/avatar5.jpg" width="27px"
									height="27px"> </a>
								<div class="media-body todo-comment">
									<button type="button"
										class="todo-comment-btn btn btn-circle btn-default btn-xs">&nbsp;
										Reply &nbsp;</button>
									<p class="todo-comment-head">
										<span class="todo-comment-username">Andres Iniesta</span>
										&nbsp; <span class="todo-comment-date">18 Sep 2014 at 9:22am</span>
									</p>
									<p class="todo-text-color">
										Cras sit amet nibh libero, in gravida nulla. Scelerisque ante
										sollicitudin commodo Nulla vel metus scelerisque ante
										sollicitudin commodo. Cras purus odio, vestibulum in vulputate
										at, tempus viverra turpis. <br>
									</p>
								</div></li>
							<li class="media"><a class="pull-left" href="javascript:;"> <img
									class="todo-userpic"
									src="/theme/assets/admin/layout2/img/avatar6.jpg" width="27px"
									height="27px"> </a>
								<div class="media-body todo-comment">
									<button type="button"
										class="todo-comment-btn btn btn-circle btn-default btn-xs">&nbsp;
										Reply &nbsp;</button>
									<p class="todo-comment-head">
										<span class="todo-comment-username">Olivia Wilde</span> &nbsp;
										<span class="todo-comment-date">18 Sep 2014 at 11:50am</span>
									</p>
									<p class="todo-text-color">
										Cras sit amet nibh libero, in gravida nulla. Scelerisque ante
										sollicitudin commodo Nulla vel metus scelerisque ante
										sollicitudin commodo. Cras purus odio, vestibulum in vulputate
										at, tempus viverra turpis. <br>
									</p>
								</div></li>
						</ul>
					</div>
				</div>
				<!-- END TASK COMMENTS -->
				<!-- TASK COMMENT FORM -->
				<div class="form-group">
					<div class="col-md-12">
						<ul class="media-list">
							<li class="media"><img class="todo-userpic pull-left"
								src="/theme/assets/admin/layout2/img/avatar4.jpg" width="27px"
								height="27px">
								<div class="media-body">
									<textarea class="form-control todo-taskbody-taskdesc" rows="4"
										placeholder="Type comment..."></textarea>
								</div></li>
						</ul>
						<button type="button"
							class="pull-right btn btn-sm btn-circle green-haze">&nbsp; Submit
							&nbsp;</button>
					</div>
				</div>
				<!-- END TASK COMMENT FORM -->
			</div>
			<div class="tab-pane" id="tab_2">
				<ul class="todo-task-history">
					<li>
						<div class="todo-task-history-date">20 Jun, 2014 at 11:35am</div>
						<div class="todo-task-history-desc">Task created</div></li>
					<li>
						<div class="todo-task-history-date">21 Jun, 2014 at 10:35pm</div>
						<div class="todo-task-history-desc">Task category status changed
							to "Top Priority"</div></li>
					<li>
						<div class="todo-task-history-date">22 Jun, 2014 at 11:35am</div>
						<div class="todo-task-history-desc">Task owner changed to "Nick
							Larson"</div></li>
					<li>
						<div class="todo-task-history-date">30 Jun, 2014 at 8:09am</div>
						<div class="todo-task-history-desc">Task completed by "Nick
							Larson"</div></li>
				</ul>
			</div>
		</div>
	</div>
</form>
</div>