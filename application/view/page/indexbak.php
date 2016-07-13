<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

//$_PLUGIN['datepicker'] = 1;
//$_PLUGIN['calendar'] = 1;
//$_PLUGIN['fancy'] = 1;
//$_PLUGIN['mixup'] = 1;
$size = sizeof($Data['widget']);

$_PAGE['jsfile'] = array();
$_PAGE['jsfile'][] = 'artist/profile.js';
$_PAGE['cssfile'] = array('assets/admin/pages/css/profile.css','assets/admin/pages/css/portfolio.css');

//$_FOOTER['ready_js'] = "$('.mix-grid').mixitup();";

$_FOOTER['ready_js'] = "	
	//blocksit define
	$(window).load( function() {
		resize();
	});
		
//window resize
	var currentWidth = 1100;	
	$(window).resize(function() {
		resize();
	});	
		
	function resize(){
		var winWidth = $(window).width();
		var conWidth;
		
		if(winWidth < 660) {
			conWidth = 350;
			col = 1
		} else if(winWidth < 1100) {
			conWidth = 660;
			col = 2;
		} else {
			conWidth = 1100;
			col = 3;
		}
		
		if(conWidth != currentWidth) {
			currentWidth = conWidth;
			$('#container').width(conWidth);
			$('#container').BlocksIt({
				numOfCol: col,
				offsetX: 2,
				offsetY: 4
			});
		}
	} 
		
	/*var currentWidth = 1100;
	$(window).resize(function() {
		var winWidth = $(window).width();
		var conWidth;
		if(winWidth < 660) {
			conWidth = 440;
			col = 2
		} else if(winWidth < 880) {
			conWidth = 660;
			col = 3
		} else if(winWidth < 1100) {
			conWidth = 880;
			col = 4;
		} else {
			conWidth = 1100;
			col = 5;
		}
		
		if(conWidth != currentWidth) {
			currentWidth = conWidth;
			$('#container').width(conWidth);
			$('#container').BlocksIt({
				numOfCol: col,
				offsetX: 2,
				offsetY: 4
			});
		}
	});*/";
// for($a=0;$a<$size;$a++){
// 	$_PAGE['jsfile'][] = $Data['widget'][$a].'/widget.js';
// 	$_FOOTER['ready_js'] .= ucfirst($Data['widget'][$a]).'.init();';
// 	$_PAGE['cssfile'][] = 'assets/admin/pages/css/'.$Data['widget'][$a].'.css';
// }




$_FOOTER['ready_js'] .= 'App.init();';

$app = new Application();
$_PAGE['sidebar_dashboard'] = 1;
include_once 'application/view/template/'.$CONFIG['theme'].'/header.php';
?>

<br/>
 	<div class="suggest row">
    
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
        <div class="span5"><img class="img-circle" width="100px" src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" ></div>
    </div>

<style>
div.suggest {
    overflow-x: auto;
    white-space: nowrap;
    text-align:center;
}
div.suggest [class*="col"], /* TWBS v3 */
div.suggest [class*="span"] {  /* TWBS v2 */
    display: inline-block;
    float: none; /* Very important */
}
</style>	

<!-- BEGIN CONTAINER -->
<?php ui::div_s(array('class'=>'container'))?>
	<!-- BEGIN CONTAINER -->

	<?php ui::div_s(array('class'=>'page-container'))?>
	
		<?php ui::div_s(array('class'=>'page-content-wrapper'))?>
			<!-- BEGIN PAGE -->
			<div>
				<!-- BEGIN PAGE CONTAINER-->
						
							<h3 class="page-title">
				<?php echo $Data['artist']['Name']?>
				</h3>
				<?php ui::div_s(array('class'=>'page-bar'))?>
				<?php ui::div_e()?>
				
				<!-- END DASHBOARD STATS -->
				
				
				
				<div class="row">
					<div class="col-md-12">
					<div id="container">
						<div class="grid">
							<div class="imgholder">
								<img src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e35/12383406_1722338644704512_298776215_n.jpg?ig_cache_key=MTIyODgzNjA1MDM3MjE1NzI1OA%3D%3D.2" />
							</div>
							<strong>Sunset Lake</strong>
							<p>A peaceful sunset view...</p>
							<div class="meta">by j osborn</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/12501870_251293395218061_118530457_n.jpg?ig_cache_key=MTIyMzA5MDYwNjUwOTY3ODA3NA%3D%3D.2" />
							</div>
							<strong>Light</strong>
							<p>The only shinning light...</p>
							<div class="meta">by Lars van de Goor</div>
						</div>
						
						<div class="grid">
							<div class="imgholder">
								<img src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/12918392_1047142398692932_2020822996_n.jpg?ig_cache_key=MTIxOTY3Njc5NTYxMDA5NTQxOA%3D%3D.2" />
							</div>
							<strong>Autumn</strong>
							<p>The fall of the tree...</p>
							<div class="meta">by Lars van de Goor</div>
						</div>
						
						
						<div class="grid">
							<div class="imgholder">
								<img src="https://pbs.twimg.com/media/CiscqhXUUAEM6TC.jpg" />
							</div>
							<strong>Rooster's Ranch</strong>
							<p>Rooster's ranch landscape...</p>
							<div class="meta">by Andrea Andrade</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img16.jpg" />
							</div>
							<strong>Autumn Light</strong>
							<p>Sun shinning into forest...</p>
							<div class="meta">by Lars van de Goor</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img21.jpg" />
							</div>
							<strong>Yellow cloudy</strong>
							<p>It is yellow cloudy...</p>
							<div class="meta">by Zsolt Zsigmond</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img28.jpg" />
							</div>
							<strong>Herringfleet Mill</strong>
							<p>Just a herringfleet mill...</p>
							<div class="meta">by Ian Flindt</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/12965271_769835899784966_594857130_n.jpg?ig_cache_key=MTIzMTA3Mjk5MTMxMDI3Mzg0Mg%3D%3D.2" />
							</div>
							<strong>Bridge to Heaven</strong>
							<p>Where is the bridge lead to?</p>
							<div class="meta">by SigitEko</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img2.jpg" />
							</div>
							<strong>Battle Field</strong>
							<p>Battle Field for you...</p>
							<div class="meta">by Andrea Andrade</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img24.jpg" />
							</div>
							<strong>Sundays Sunset</strong>
							<p>Beach view sunset...</p>
							<div class="meta">by Robert Strachan</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img19.jpg" />
							</div>
							<strong>Sun Flower</strong>
							<p>Good Morning Sun flower...</p>
							<div class="meta">by Zsolt Zsigmond</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img5.jpg" />
							</div>
							<strong>Beach</strong>
							<p>Something on beach...</p>
							<div class="meta">by unknown</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img25.jpg" />
							</div>
							<strong>Flowers</strong>
							<p>Hello flowers...</p>
							<div class="meta">by R A Stanley</div>
						</div>
						<div class="grid">
							<div class="imgholder">
								<img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img20.jpg" />
							</div>
							<strong>Alone</strong>
							<p>Lonely plant...</p>
							<div class="meta">by Zsolt Zsigmond</div>
						</div> <!---->
					</div>
					</div>
				</div>
			
			
		</div>
	</div>
</div>

	<?php
	include_once 'application/view/template/'.$CONFIG['theme'].'/footer.php';
	?>