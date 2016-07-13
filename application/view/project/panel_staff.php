<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
//tags: ["何健驄", "green", "blue", "yellow", "pink"]

/*$_FOOTER['ready_js'].='
 var data = [{ id: 0, text: \'enhancement\' }, { id: 1, text: \'bug\' }, { id: 2, text: \'duplicate\' }, { id: 3, text: \'invalid\' }, { id: 4, text: \'wontfix\' }];
 //var data = ["何健驄", "green", "blue", "yellow", "pink"];
 $("#select2_tags").select2({
 tags:data
 });
 var $eventSelect =$("#select2_tags");
 $eventSelect.on("select2:unselect", function (e) { log("select2:unselect", e); });
 function log (name, evt) {
 if (!evt) {
 var args = "{}";
 } else {
 var args = JSON.stringify(evt.params, function (key, value) {
 if (value && value.nodeName) return "[DOM node]";
 if (value instanceof $.Event) return "[$.Event]";
 return value;
 });
 }
 var $e = $("<li>" + name + " -> " + args + "</li>");
 $eventLog.append($e);
 $e.animate({ opacity: 1 }, 10000, 'linear', function () {
 $e.animate({ opacity: 0 }, 2000, 'linear', function () {
 $e.remove();
 });
 });
 }
 ';*/

?>

<?php
$input['title'] = 'People in Charge';
$input['titleicon'] = 'icon-speech';
$input['action']['fullscreen'] = true;
UIElementController::render ( "portlet_start", $input );
unset ( $input );
?>
<h4><?php echo $ElementData['heading']?></h4>
<form action="#" class="horizontal-form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
				<?php
				$input['id']         = 'staff';
				$input['attr'] = array('class'=>'form-control');

				$input['option'] = $Data['staffoption'];//array(array(21,'Dallas Cowboys'),array(22,'何健驄'));
				/*$input['option2'] = array('NFC EAST'=>
				array(
				array(21,'Dallas Cowboys'),
				array(22,'何健驄')
				),
												'NFC NORTH'=>
				array(
				array(23,'Chicago Bears'),
				array(24,'Detroit Lions'),
				)
				);*/
				/*<optgroup label="NFC EAST">
				 <option value="21"></option>
				 <option value="22"></option>
				 <option>Philadelphia Eagles</option>
				 <option>Washington Redskins</option>
				 </optgroup>*/

				UIElementController::render("select",$input);
				unset($input);?>

				</div>
			</div>
			<!--/span-->

			<!--/span-->
		</div>
		<!--/row-->
		<?php
		$staffsize = sizeof($Data['staff']);
		if($staffsize>0){
			$ppr = 4;
			$row = (int)($staffsize/4);
			if($row==0) $row = 1;
			if($staffsize%4>1)
			$row++;
			echo '<div class="row thumbnails" id="staffrow">';
			for($a=0;$a<$staffsize;$a++){
				if($a!=0 && $a%$ppr==0){
					echo '</div><div class="row thumbnails">';
				}
				$Data['staffname'] = $Data['staff'][$a]['name'];
				?>
				<?php require('panel_staffdiv.php');?>
		<?php
			}?>

			<?php echo '</div>';
		}?>
		<!--  <div class="row thumbnails">
			<div class="col-md-3">
				<div class="meet-our-team">
					<h3>
						Bob Nilson
					</h3>
					<img class="img-responsive" alt=""
						src="/theme/assets/admin/pages/media/pages/2.jpg">
					<div class="team-info"><br/>
						<ul class="social-icons pull-right">
							<li><a class="twitter" data-original-title="twitter"
								href="javascript:;"> </a></li>
							<li><a class="facebook" data-original-title="facebook"
								href="javascript:;"> </a></li>
							<li><a class="linkedin" data-original-title="linkedin"
								href="javascript:;"> </a></li>
							<li><a class="googleplus" data-original-title="Goole Plus"
								href="javascript:;"> </a></li>
							<li><a class="skype" data-original-title="skype"
								href="javascript:;"> </a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="meet-our-team">
					<h3>
						Marta Doe
					</h3>
					<img class="img-responsive" alt=""
						src="/theme/assets/admin/pages/media/pages/3.jpg">
					<div class="team-info"><br/>
						<ul class="social-icons pull-right">
							<li><a class="twitter" data-original-title="twitter"
								href="javascript:;"> </a></li>
							<li><a class="facebook" data-original-title="facebook"
								href="javascript:;"> </a></li>
							<li><a class="linkedin" data-original-title="linkedin"
								href="javascript:;"> </a></li>
							<li><a class="googleplus" data-original-title="Goole Plus"
								href="javascript:;"> </a></li>
							<li><a class="skype" data-original-title="skype"
								href="javascript:;"> </a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="meet-our-team">
					<h3>
						Bob Nilson
					</h3>
					<img class="img-responsive" alt=""
						src="/theme/assets/admin/pages/media/pages/2.jpg">
					<div class="team-info"><br/>
						<ul class="social-icons pull-right">
							<li><a class="twitter" data-original-title="twitter"
								href="javascript:;"> </a></li>
							<li><a class="facebook" data-original-title="facebook"
								href="javascript:;"> </a></li>
							<li><a class="linkedin" data-original-title="linkedin"
								href="javascript:;"> </a></li>
							<li><a class="googleplus" data-original-title="Goole Plus"
								href="javascript:;"> </a></li>
							<li><a class="skype" data-original-title="skype"
								href="javascript:;"> </a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="meet-our-team">
					<h3>
						Marta Doe
					</h3>
					<img class="img-responsive" alt=""
						src="/theme/assets/admin/pages/media/pages/3.jpg">
					<div class="team-info"><br/>
						<ul class="social-icons pull-right">
							<li><a class="twitter" data-original-title="twitter"
								href="javascript:;"> </a></li>
							<li><a class="facebook" data-original-title="facebook"
								href="javascript:;"> </a></li>
							<li><a class="linkedin" data-original-title="linkedin"
								href="javascript:;"> </a></li>
							<li><a class="googleplus" data-original-title="Goole Plus"
								href="javascript:;"> </a></li>
							<li><a class="skype" data-original-title="skype"
								href="javascript:;"> </a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>-->



	</div>
</form>
<?php 
UIElementController::render ( "portlet_end");
?>
