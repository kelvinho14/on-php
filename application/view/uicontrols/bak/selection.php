
		<select id="<?php echo $ElementData["ID"]?>" name="<?php echo $ElementData["Name"]?>" <?php echo $input['Extra']?> class="<?php echo $ElementData["Class"]==''?'span6':$ElementData["Class"]?>" <?php if($ElementData['OnChange']!=''){?>onChange="<?php echo $ElementData['OnChange'];?>"<?php }?>>
			<?php for($a=0;$a<sizeof($ElementData["Option"]);$a++){
				echo '<option value="'.$ElementData["Option"][$a][0].'" '.($ElementData["Option"][$a][0]==$ElementData["Value"]?'selected':'').'>'.$ElementData["Option"][$a][1].'</option>';
			}?>
		</select>
