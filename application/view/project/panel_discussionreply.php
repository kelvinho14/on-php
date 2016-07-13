<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<div class="portlet-title">
	<div class="caption">
		<i class="icon-reorder"></i>
	</div>
	<div class="tools">
		<a class="collapse" href="javascript:;"></a> <a class="config"
			data-toggle="modal" href="#portlet-config"></a> <a class="reload"
			href="javascript:;"></a> <a class="remove" href="javascript:;"></a>
	</div>
</div>
<div class="portlet-body form">
	<!-- BEGIN FORM-->
	<form class="horizontal-form" action="#">
		<div class="row-fluid">
			<div class="span12 ">
				<div class="control-group">
					<div class="discuss_nav">
					<?php echo backBtn(array('attr'=>array('onClick'=>'focusDiscuss(1)')))?>
					The prototype is ready - by Dave Chan 2013-12-21
					</div>
					<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1" data-start="bottom">
						<ul class="chats">
							<li class="in"><img class="avatar" alt=""
								src="/assets/img/avatar1.jpg">
								<div class="message">
									<span class="arrow"></span> <a href="#" class="name">Bob Nilson</a>
									<span class="datetime">at Jul 25, 2012 11:09</span> <span
										class="body"> Lorem ipsum dolor sit amet, consectetuer
										adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
										laoreet dolore magna aliquam erat volutpat. </span>
								</div></li>
							<li class="out"><img class="avatar" alt=""
								src="assets/img/avatar2.jpg">
								<div class="message">
									<span class="arrow"></span> <a href="#" class="name">Lisa Wong</a>
									<span class="datetime">at Jul 25, 2012 11:09</span> <span
										class="body"> Lorem ipsum dolor sit amet, consectetuer
										adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
										laoreet dolore magna aliquam erat volutpat. </span>
								</div></li>
							<li class="in"><img class="avatar" alt=""
								src="/assets/img/avatar1.jpg">
								<div class="message">
									<span class="arrow"></span> <a href="#" class="name">Bob Nilson</a>
									<span class="datetime">at Jul 25, 2012 11:09</span> <span
										class="body"> Lorem ipsum dolor sit amet, consectetuer
										adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
										laoreet dolore magna aliquam erat volutpat. </span>
								</div></li>
							<li class="out"><img class="avatar" alt=""
								src="/assets/img/avatar3.jpg">
								<div class="message">
									<span class="arrow"></span> <a href="#" class="name">Richard
										Doe</a> <span class="datetime">at Jul 25, 2012 11:09</span> <span
										class="body"> Lorem ipsum dolor sit amet, consectetuer
										adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
										laoreet dolore magna aliquam erat volutpat. </span>
								</div></li>
							<li class="in"><img class="avatar" alt=""
								src="/assets/img/avatar3.jpg">
								<div class="message">
									<span class="arrow"></span> <a href="#" class="name">Richard
										Doe</a> <span class="datetime">at Jul 25, 2012 11:09</span> <span
										class="body"> Lorem ipsum dolor sit amet, consectetuer
										adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
										laoreet dolore magna aliquam erat volutpat. </span>
								</div></li>
							<li class="out"><img class="avatar" alt=""
								src="/assets/img/avatar1.jpg">
								<div class="message">
									<span class="arrow"></span> <a href="#" class="name">Bob Nilson</a>
									<span class="datetime">at Jul 25, 2012 11:09</span> <span
										class="body"> Lorem ipsum dolor sit amet, consectetuer
										adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
										laoreet dolore magna aliquam erat volutpat. </span>
								</div></li>
							<li class="in"><img class="avatar" alt=""
								src="/assets/img/avatar3.jpg">
								<div class="message">
									<span class="arrow"></span> <a href="#" class="name">Richard
										Doe</a> <span class="datetime">at Jul 25, 2012 11:09</span> <span
										class="body"> Lorem ipsum dolor sit amet, consectetuer
										adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
										laoreet dolore magna aliquam erat volutpat. </span>
								</div></li>
							<li class="out"><img class="avatar" alt=""
								src="/assets/img/avatar1.jpg">
								<div class="message">
									<span class="arrow"></span> <a href="#" class="name">Bob Nilson</a>
									<span class="datetime">at Jul 25, 2012 11:09</span> <span
										class="body"> Lorem ipsum dolor sit amet, consectetuer
										adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
										laoreet dolore magna aliquam erat volutpat. sed diam nonummy
										nibh euismod tincidunt ut laoreet. </span>
								</div></li>
						</ul>
					</div>
					<div class="chat-form">
						<div class="input-cont">
							<input type="text" placeholder="Type a message here..."	class="form-control">
						</div>
						<div class="btn-cont">
							<span class="arrow"></span>
							<a href="" class="btn blue icn-only"><i class="fa fa-check icon-white"></i></a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</form>
</div>
