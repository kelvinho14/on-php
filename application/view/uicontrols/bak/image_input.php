<?php 
global $Admin_Lang;?>
		<div data-provides="fileupload" class="fileupload fileupload-new" id="<?php echo $ElementData["div_name"] ?>">
			<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
				<img title="<?php echo $ElementData["ImageTitle"]==''?'':$ElementData["ImageTitle"]?>" src="<?php echo $ElementData["Image"]==''?'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image':$ElementData["Image"];?>">
			</div>
			<div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
			<div>
				<span class="btn btn-file"><span class="fileupload-new"><?php echo $Admin_Lang["select_img"]?></span>
				<span class="fileupload-exists"><? echo $Admin_Lang["change_img"]?></span>
				<input type="file" class="default" name="<? echo $ElementData["Name"]?>" id="<? echo $ElementData["ID"]?>"></span>
				<a data-dismiss="fileupload" class="btn fileupload-exists" href="#"><? echo $Admin_Lang["remove_img"]?></a>
			</div>
		</div>
		<?php if($ElementData["Hint"]!=''){?>
		<span class="label label-important"><? echo $ElementData["Hint"]?></span>
		<?php }?>
		<?php if($ElementData["HintConent"]!=''){?>
		<span>
		<? echo $ElementData["HintConent"]?>
		</span>
		<?php }?>
 