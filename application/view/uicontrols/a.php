<a href="<?php echo $ElementData['href']==''?'javascript:;':$ElementData['href'];?>" id="<?php echo $ElementData['id'];?>" 
<?php 
if(isset($ElementData['attr'])){
	foreach($ElementData['attr'] as $key=>$val){
	echo ' '.$key.'="'.$val.'" ';
		
	}
}?>
 <?php echo $ElementData['other']?>><?php echo $ElementData['value']?></a>