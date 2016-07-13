<span id="<?php echo $ElementData['id']?>" <?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo $key.'="'.$val.'" ';
		
	}
}?> >
<?php echo $ElementData['value']?> 
</span>									