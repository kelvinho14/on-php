<!-- <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
        </div>
    </div>
</div>-->

<div class="modal slide-down fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="true">
	<div class="modal-dialog">
		<div class="v-cell ">
			<div class="modal-content h-center" id="modelcontent">
				
			</div>
		</div>
	</div>
</div>
 
<div class="scroll-to-top">
<?php echo ui::fa('arrow-circle-o-up fa-2x',array('attr'=>array('id'=>'scrolltop')));
?> 
</div>	


		<?php 
		if($_PAGE['hideloadmore']==false){
			echo ui::btn($Lang['loadmore'],array('id'=>'loadmore','attr'=>array('data-norecord'=>$Lang['nomoretoload'],'data-loadmore'=>$Lang['loadmore'],'data-loading'=>$Lang['loading'])));
		}?>
			 
 <?php /*?><footer class="footer">
      <?php echo $CONFIG['site_footer']?>
    </footer>
    */?>
    

  </div>
  <!-- /st-container -->

  <!-- Inline Script for colors and config objects; used by various external scripts; -->
  <script>
    var colors = {
      "danger-color": "#e74c3c",
      "success-color": "#81b53e",
      "warning-color": "#f0ad4e",
      "inverse-color": "#2c3e50",
      "info-color": "#2d7cb5",
      "default-color": "#6e7882",
      "default-light-color": "#cfd9db",
      "purple-color": "#9D8AC7",
      "mustard-color": "#d4d171",
      "lightred-color": "#e15258",
      "body-bg": "#f6f6f6"
    };
    var config = {
      theme: "social-3",
      skins: {
        "default": {
          "primary-color": "#16ae9f"
        },
        "orange": {
          "primary-color": "#e74c3c"
        },
        "blue": {
          "primary-color": "#4687ce"
        },
        "purple": {
          "primary-color": "#af86b9"
        },
        "brown": {
          "primary-color": "#c3a961"
        },
        "default-nav-inverse": {
          "color-block": "#242424"
        }
      }
    };
  </script>

  <!-- Vendor Scripts Bundle
    Includes all of the 3rd party JavaScript libraries above.
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation.
    Do not use it simultaneously with the separate bundles above. -->
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/all.js"></script>

  <!-- Vendor Scripts Standalone Libraries 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/jquery.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/bootstrap.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/breakpoints.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/jquery.nicescroll.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/isotope.pkgd.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/packery-mode.pkgd.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/jquery.grid-a-licious.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/jquery.cookie.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/jquery-ui.custom.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/jquery.hotkeys.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/handlebars.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/jquery.hotkeys.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/load_image.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/core/jquery.debouncedresize.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/tables/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/forms/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/media/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/player/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/charts/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/charts/flot/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/charts/easy-pie/jquery.easypiechart.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/charts/morris/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/charts/sparkline/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/maps/vector/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/tree/jquery.fancytree-all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/nestable/jquery.nestable.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/vendor/angular/all.js"></script> -->

  <!-- App Scripts Bundle
    Includes Custom Application JavaScript used for the current theme/module;
    Do not use it simultaneously with the standalone modules below. -->
  <!--  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/app.js"></script>-->

  <!-- App Scripts Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL the modules are 100% compatible -->

  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/essentials.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/layout.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/sidebar.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/media.js"></script> 
  <!--  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/player.js"></script>--> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/timeline.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/chat.js"></script> 
  <!--  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/maps.js"></script>--> 
<!--    <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/charts/all.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/charts/flot.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/charts/easy-pie.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/charts/morris.js"></script> 
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/charts/sparkline.js"></script>-->
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/custom.js"></script>
  
  
  
  
  
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!-- blueimp Gallery script -->
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->

<?php if($advance){?>
<script src="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<?php }?>
<script type="text/javascript" src="<?echo $CONFIG['home_http']?>/include/tools/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>


<!--  <link rel="stylesheet" href="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/css/style.css">-->
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?echo $CONFIG['home_http']?>/include/tools/jQuery-File-Upload/css/jquery.fileupload.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<?php if($_PLUGIN['crop']){?>
<link href="http://officable.com/aidsconcerndev/theme/assets/global/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet"/>
<link href="http://officable.com/aidsconcerndev/theme/assets/admin/pages/css/image-crop.css" rel="stylesheet"/>
<script src="http://officable.com/aidsconcerndev/theme/assets/global/plugins/jcrop/js/jquery.color.js"></script>
<script src="http://officable.com/aidsconcerndev/theme/assets/global/plugins/jcrop/js/jquery.Jcrop.min.js"></script>
<?php }


	
?>
<script src="//cdn.jsdelivr.net/sockjs/1/sockjs.min.js"></script>  
  <script>

  $( document ).ready(function() {
	  Page.init();
	<?php if(isLoggedIn()){
	  $sockettoken = genSocketToken();
		$authcode = genAuthCode();
	?>
	   /*var sock = new SockJS('http://dev.maruon.net/socket?t=<?php echo $sockettoken?>&k=<?php echo $authcode?>');
	   sock.onopen = function() {
	       console.log('ws connected');
	       socketLogin();
	   };
	   sock.onmessage = function(e) {
		   console.log(e);
	       //console.log(JSON.stringify(e.data));
	   };
	   sock.onclose = function() {
	       console.log('close');
	   };*/
		<?php }?>    

	   
	   //setTimeout(function(){
		   //sock.send('message from client');
		 //}, 2000);
	   //sock.close();

	  
	});

	function socketLogin(){
		//sock.send(JSON.stringify({"a":"login","mid":mid,"t":token,"circle_auth":$.cookie('circle_auth')});
	}
  </script>


  <!-- App Scripts CORE [social-3]:
        Includes the custom JavaScript for this theme/module;
        The file has to be loaded in addition to the UI modules above;
        app.js already includes main.js so this should be loaded
        ONLY when using the standalone modules; -->
  <script src="<?echo $CONFIG['home_http']?>theme/assets/<?php echo $CONFIG['asset']?>/js/app/main.js"></script>

</body>

</html>