<?php

return false;
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<div class="theme-panel">
	<div class="toggler tooltips" data-container="body"
		data-placement="left" data-html="true"
		data-original-title="Click to open advance theme customizer panel">
		<i class="icon-settings"></i>
	</div>
	<div class="toggler-close">
		<i class="icon-close"></i>
	</div>
	<div class="theme-options" style="display:none">
		<div class="theme-option theme-colors clearfix">
			<span> THEME COLOR </span>
			<ul>
				<li class="color-default current tooltips" data-style="default"
					data-container="body" data-original-title="Default"></li>
				<li class="color-grey tooltips" data-style="grey"
					data-container="body" data-original-title="Grey"></li>
				<li class="color-blue tooltips" data-style="blue"
					data-container="body" data-original-title="Blue"></li>
				<li class="color-dark tooltips" data-style="dark"
					data-container="body" data-original-title="Dark"></li>
				<li class="color-light tooltips" data-style="light"
					data-container="body" data-original-title="Light"></li>
			</ul>
		</div>
		
		<div class="theme-option">
			<span> Sidebar Style</span> <select
				class="sidebar-style-option form-control input-small">
				<option value="default" selected="selected">Default</option>
				<option value="compact">Compact</option>
			</select>
		</div>
		<div class="theme-option">
			<span> Sidebar Menu </span> <select
				class="sidebar-menu-option form-control input-small">
				<option value="accordion" selected="selected">Accordion</option>
				<option value="hover">Hover</option>
			</select>
		</div>
		<div class="theme-option">
			<span> Sidebar Position </span> <select
				class="sidebar-pos-option form-control input-small">
				<option value="left" selected="selected">Left</option>
				<option value="right">Right</option>
			</select>
		</div>
		<div class="theme-option">
			<span> Footer </span> <select
				class="page-footer-option form-control input-small">
				<option value="fixed">Fixed</option>
				<option value="default" selected="selected">Default</option>
			</select>
		</div>
	</div>
</div>
