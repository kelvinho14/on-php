<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}
?>
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		<?php echo $CONFIG['backend_footer']?>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
</div>
<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/respond.min.js"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jquery-migrate.min.js"
	type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jquery-ui/jquery-ui.min.js"
	type="text/javascript"></script>
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap/js/bootstrap.min.js"
	type="text/javascript"></script>
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
	type="text/javascript"></script>
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
	type="text/javascript"></script>
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jquery.blockui.min.js"
	type="text/javascript"></script>
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jquery.cokie.min.js"
	type="text/javascript"></script>
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/uniform/jquery.uniform.min.js"
	type="text/javascript"></script>
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
	type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
<script
	type="text/javascript"
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/select2/select2.min.js"></script>
<script
	type="text/javascript"
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script
	type="text/javascript"
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>


<?php if($_PLUGIN['datepicker']){?>	
<script type="text/javascript" src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js"></script>
<?php }?>
<?php if($_PLUGIN['datetimepicker']){?>
<script type="text/javascript" src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<?php }?>

<?php if($_PLUGIN['timepicker']){?>
<script type="text/javascript" src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<?php }?>

<script
	type="text/javascript" src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/moment.min.js"></script>
<script
	type="text/javascript"
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jquery.mockjax.js"></script>
<script
	type="text/javascript"
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
<script
	type="text/javascript"
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
<script
	type="text/javascript"
	src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>
<!-- END X-EDITABLE PLUGIN -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script
	src="<?echo $CONFIG['home_http']?>theme/assets/global/scripts/app.js" type="text/javascript"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/admin/<?php echo $CONFIG['theme']?>/scripts/layout.js" type="text/javascript"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/admin/<?php echo $CONFIG['theme']?>/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/admin/<?php echo $CONFIG['theme']?>/scripts/theme.js" type="text/javascript"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js"></script>

<?php if($_PLUGIN['timeline']){?>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="<?echo $CONFIG['home_http']?>include/tools/timeline/timeline.js"></script>
<link 	href="<?echo $CONFIG['home_http']?>include/tools/timeline/timeline.css" rel="stylesheet" />
<?php }?>
<?php if($_PLUGIN['datatable']){?>
<script type="text/javascript" src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<?php }?>
<?php if($_PLUGIN['calendar']){?>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/fullcalendar/lang-all.js"></script>
<?php }?>
<?php if($_PLUGIN['fileupload']){?>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<?php }?>

<?php if($_PLUGIN['modal']){?>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<?php }?>

<?php if($_PLUGIN['notification']){?>
<link href="<?echo $CONFIG['home_http']?>theme/assets/admin/pages/css/timeline.css" rel="stylesheet" type="text/css"/>
<?php }?>
<?php if($_PLUGIN['fileinput']){?>
<script type="text/javascript" src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<?php }?>
<?php if($_PLUGIN['crop']){?>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jcrop/js/jquery.color.js"></script>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/jcrop/js/jquery.Jcrop.min.js"></script>
<?php }?>
<?php if($_PLUGIN['dropzone']){?>
<script src="<?echo $CONFIG['home_http']?>theme/assets/global/plugins/dropzone/dropzone.js"></script>
<?php }?>
<?php if($_PLUGIN['draggable']){?>
<script src="<?echo $CONFIG['home_http']?>theme/assets/admin/pages/scripts/portlet-draggable.js"></script>
<?php }?>



<?php  echo includeCustJS($_PAGE['jsfile']);?>
<?php  echo includeCustCss($_PAGE['cssfile']);?>

<script>
var domainurl = '<?php echo $CONFIG['home_http']?>';
<?php echo $_PAGE['jsvariable'];?>
jQuery(document).ready(function() {   
   // initiate layout and plugins
   //App.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Theme.init(); // init theme features

<?php echo $_FOOTER['ready_js'];?>
<?php echo ui::displayGrowl();?>

});


var formSubmitting = true;
$(":input").keydown(function(){
	formSubmitting = false;
});
$(":text").keydown(function(){
	formSubmitting = false;
});
$(".dropzone").click(function(){
	formSubmitting = false;
});
var setFormSubmitting = function() { formSubmitting = true; };
<?php if($_PLUGIN['checksave']){?>
	window.onload = function() {
    window.addEventListener("beforeunload", function (e) {
        if (formSubmitting) {
            return undefined;
        }

        var confirmationMessage = '<?php echo $Admin_Lang['leavepage_warn']?>';
alert(confirmationMessage);
        (e || window.event).returnValue = confirmationMessage; //Gecko + IE
        return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
    });
};
<?php }?>
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
