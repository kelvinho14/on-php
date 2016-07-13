<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<!-- BEGIN FORM-->
<form class="horizontal-form" action="#">
	<div class="row-fluid">
		<div class="span12 ">
			<div class="control-group">
				<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1" data-start="bottom">
					<div class="project-discussion">
						<div class="project-discussion-block">
							<a href="">David Chan</a>
							<p>The prototype is ready</p>
							<span>5 hours ago |
								<a href="javascript:void(0)" onClick="focusDiscussReply(1)">No
									reply</a> </span> <i
								class="icon-comments project-discussion-icon"></i>
						</div>
						<div class="project-discussion-block">
							<a href="">John Legend</a>
							<p>At vero eos et accusamus et iusto odio.</p>
							<span>5 hours ago |
								3 replies (2 days ago)</span> <i
								class="icon-comments project-discussion-icon"></i>
						</div>
						<div class="project-discussion-block">
							<a href="">@keenthemes</a>
							<p>At vero eos et accusamus et iusto odio.</p>
							<span>5 hours ago</span>
							<i class="icon-comments project-discussion-icon"></i>
						</div>
						<div class="project-discussion-block">
							<a href="">@keenthemes</a>
							<p>At vero eos et accusamus et iusto odio.</p>
							<span>7 hours ago</span>
							<i class="icon-comments project-discussion-icon"></i>
						</div>
						<div class="project-discussion-block">
							<a href="">@keenthemes</a>
							<p>At vero eos et accusamus et iusto odio.</p>
							<span>8 hours ago</span>
							<i class="icon-comments project-discussion-icon"></i>
						</div>
					</div>
				</div>
				<div class="chat-form">
					<div class="input-cont">
						<input type="text" placeholder="Start a discussion..." class="form-control">
							
					</div>
					<div class="btn-cont">
						<span class="arrow"></span> 
						<a href="" class="btn blue icn-only"><i class="fa fa-check icon-white"></i></a>
					</div>
					<div class="control-group">
						<label class="control-label">Permission</label>
						<div class="controls">
							<label class="radio"> <input type="radio" name="optionsRadios1"
								value="option1" /> Internal only </label> <label class="radio">
								<input type="radio" name="optionsRadios1" value="option2"
								checked /> Open to client </label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
