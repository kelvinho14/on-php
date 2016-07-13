<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<div class="container-fluid">
	<div class="span12">
		<!-- BEGIN TAB PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-reorder"></i>Files
				</div>
				<div class="tools">
					<a class="collapse" href="javascript:;"></a> <a class="config"
						data-toggle="modal" href="#portlet-config"></a> <a class="reload"
						href="javascript:;"></a> <a class="remove" href="javascript:;"></a>
				</div>
			</div>
			<div class="portlet-body form">
				<div
					class="tab-pane row-fluid <?php echo $Data['upload_tab_active']?>"
					id="tab_upload">
					<p>
						<span class="label label-important">NOTE:</span>&nbsp; This
						plugins works only on Latest Chrome, Firefox, Safari, Opera &amp;
						Internet Explorer 10. <select id="file_type" name="file_type"
							id="file_type">
							<option value="<?php echo PRIVATE_FILE;?>"><?php echo $Lang['upload_2_my_cloud']?></option>
							<option value="<?php echo PUBLIC_FILE;?>"><?php echo $Lang['upload_2_the_cloud']?></option>
						</select>
					</p>
					<div class="row-fluid ">
						<div class="span6">file list</div>
						<div class="span6">
							<form id="dropzone" class="dropzone dz-clickable"
								action="index.php?ctr=cloud_upload_handler">
								<div data-dz-message="" class="dz-default dz-message">
									<span>Drop files here to upload</span>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>