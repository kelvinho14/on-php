<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

include_once 'application/view/template/'.$CONFIG['theme'].'/header.php';

?>
<nav class="navbar navbar-subnav navbar-static-top" role="navigation">
	<form id="filterform" name="filterform" method="get" onSubmit="$('#filter_state').val($('#state').val());">
	<br/>
	<div class="container" > <!-- style="padding:0px" -->
		<div class="row">
			<div class="col-md-3 ">
			</div>
			<div class="col-md-6 ">
				<div class="input-group">
					<input id="searchuser" name="searchuser" class="form-control" placeholder="<?php echo $Lang['searchuserplaceholder']?>">
				 	<span class="input-group-btn">
                    	<?php 
							$input['value'] = ui::fa('search');
							$input['type'] = 'submit';
							echo UIElementController::render ( "button", $input );
							unset($input);
							?>
							<?php
							echo '&nbsp;';
							$input['value'] = ui::fa('angle-down');
							$input['attr']['onClick'] = "$('#advancefilter').slideToggle( 'slow', function() {})";
							echo UIElementController::render ( "button", $input );
							unset($input);
							//echo ui::fa('arrow-down fa-2x',array('attr'=>array('onClick'=>"$('#advancefilter').slideToggle( 'slow', function() {})")));
						?>
                    </span>
               </div>
        	</div>
			
		</div>
		
		<div class="row" id="advancefilter" style="<?php echo $Data['filterapplied']?'':'display:none'?>">
			<br/>
			<div class="col-md-3 ">
				
				<div class="checkbox checkbox-info checkbox-circle" style="display:inline-block">
	        		
	        		<?php
	        		$input['id'] = 'filter_gendermale';
	        		$input['name'] = 'filter_gender[]';
	        		$input['value'] = 1;
	        		echo  UIElementController::render ( "checkbox", $input );
	        		unset($input);
	        		?>
	            	<label for="filter_gendermale"><?php echo $Lang['male']?></label>
				</div>
				<div class="checkbox checkbox-info checkbox-circle" style="display:inline-block">
	        		<?php
	        		$input['id'] = 'filter_genderfemale';
	        		$input['name'] = 'filter_gender[]';
	        		$input['value'] = 2;
	        		echo  UIElementController::render ( "checkbox", $input );
	        		unset($input);
	        		?>
	            	<label for="filter_genderfemale"><?php echo $Lang['female']?></label>
				</div>
			</div>
			<div class="col-md-3 ">
				<?php echo $Lang['debut_year']?>: 
				<?php 
					$input['attr']['data-toggle'] ="select2";
					$input['attr']['style'] = 'width:100%';
					$input['attr']['data-placeholder'] = $Lang['please_select'];
					$input['attr']['data-allow-clear'] = 'true';
					$input['id'] = 'filter_debutyear';
					$input['name'] = 'filter_debutyear';
					$input['option'] = display::addSelectOption($Data['debutyear_option']);
					
					echo  UIElementController::render ( "select", $input );
					unset($input);
				?>
			</div>
			<div class="col-md-3 "><?php echo $Lang['city']?>: 
			<?php
				$field = 'state';
				$input['attr']['data-toggle'] ="select2";
				$input['attr']['style'] = 'width:100%';
				$input['attr']['data-placeholder'] = $Lang['please_select'];
				$input['attr']['data-allow-clear'] = 'true';
				$input['attr']['multiple']="multiple";
				$input['id'] = $field;
				$input['name'] = $field;
				$input['option'] = $Data['places'];
				$input['value'] = explode(",",$Data['filter'][$field]);
				
				echo  UIElementController::render ( "select", $input );
				unset($input);
				
				$input['id'] = 'filter_'.$field;
				$input['name'] = $input['id'];
				echo  UIElementController::render ( "hidden", $input );
				unset($input);
			?>
			</div>
		</div>
		<br/>
		<div class="row center">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="btn-group btn-group-justified" style="text-align:center">
					<?php foreach($Data['artist_type'] as $artisttype){
						$color = display::artistColor($artisttype['Color']);
						?>
					<a href="javascript:;" style="background-color:<?php echo $color[1]?>;padding:0px !important;" class="filterartisttype btn <?php echo $_MENU['myfeed']?'btn-primary':'btn-default'?>" data-color="<?php echo $color[1]?>" data-typeid="<?php echo $artisttype['ID']?>">
						
			            <?php echo $artisttype['Name']?>
					</a>
					<input id="<?php echo $artisttype['ID']?>_cb" type="checkbox" style="display:none" >
					<?php }?>
					
				</div>
			</div>
		</div>
	</div>
	</form>
</nav>
	<div class="container nopadding" id="allpostcontainer">
		<?php if(UserModel::isArtist()){include_once('poststatus.php');}?>
		<div class="timeline row" data-toggle="isotope">
			<?php echo $Data['feed_display'];?>
        </div>
				        
	</div>
	</div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->
    <input type="hidden" name="page_count" id="page_count" value="1">
    <script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress"></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
			<?php 
			$input['class'] = 'start btn-primary';
			echo ui::btn('Start',$input);
			unset($input);
			?>
            {% } %}
            {% if (!i) { %}
                <?php 
				$input['class'] = 'cancel btn-default';
				echo ui::btn('Cancel',$input);
				unset($input);
				?>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
<!--{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            </p>
            {% if (file.error) { %}
                <div><span class="error">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <button class="delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>Delete</button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}-->
</script>
<?php
include_once 'application/view/template/'.$CONFIG['theme'].'/footer.php';
?>
