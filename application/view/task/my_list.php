<?php 
if(function_exists('preventDA')){
	preventDA();
}else{
	die;
}

	include_once 'application/view/template/'.$_SESSION['theme'].'/admin_header.php';
?>
<link href="assets/css/pages/inbox.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/bootstrap-tag/css/bootstrap-tag.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
	<!-- BEGIN:File Upload Plugin CSS files-->
	<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" >
	<!-- BEGIN CONTAINER -->   
	<div class="page-container row-fluid">
<?php
	$sidebar_task_active = 1;
	$sidebar_task_mylist_active = 1;
	
	include_once 'application/view/template/'.$_SESSION['theme'].'/admin_sidebar.php';
?>
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					Widget Settings form goes here
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<?php include_once 'application/view/template/'.$_SESSION['theme'].'/admin_style.php';?>
						<h3 class="page-title">
							<?php echo $Lang['task_module']?>
							<small> <?php echo $Lang['task_module_desc']?></small>
						</h3>
						<?php 
						$breadcrumb_arr = array(array('name'=>$Lang['task_module']));
						UIElementController::render("breadcrumb",$breadcrumb_arr);
						?>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<div class="row-fluid inbox">
					<div class="span2">
						<ul class="inbox-nav margin-bottom-10">
							<li class="compose-btn">
								<a href="javascript:;" data-title="Compose" class="btn green"> 
								<i class="icon-edit"></i> <?php echo $Lang['task_new_task']?>
								</a>
							</li>
							<li class="inbox active">
								<a href="javascript:;" class="btn" data-title="Inbox">Inbox(3)</a>
								<b></b>
							</li>
							<li class="sent"><a class="btn" href="javascript:;"  data-title="Sent">Sent</a><b></b></li>
							<li class="draft"><a class="btn" href="javascript:;" data-title="Draft">Draft</a><b></b></li>
							<li class="trash"><a class="btn" href="javascript:;" data-title="Trash">Trash</a><b></b></li>
						</ul>
					</div>
					<div class="span10">
						<div class="inbox-header">
							<h1 class="pull-left">Inbox</h1>
							<form action="#" class="form-search pull-right">
								<div class="input-append">
									<input class="m-wrap" type="text" placeholder="Search Mail">
									<button class="btn green" type="button">Search</button>
								</div>
							</form>
						</div>
						<div class="inbox-loading">Loading...</div>
						<div class="inbox-content"></div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->

    
	<?php $ready_js = "Inbox.init()";

$js_function = "var Inbox = function () {

    var content = $('.inbox-content');
    var loading = $('.inbox-loading');

    var loadInbox = function (el, name) {
        var url = 'index.php?ctr=task_get_mylist&IsAjax=1';
        var title = $('.inbox-nav > li.' + name + ' a').attr('data-title');

        loading.show();
        content.html('');
        toggleButton(el);

        $.ajax({
            type: \"GET\",
            cache: false,
            url: url,
            dataType: \"html\",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-nav > li.' + name).addClass('active');
                $('.inbox-header > h1').text(title);

                loading.hide();
                content.html(res);
                App.fixContentHeight();
                App.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var loadMessage = function (el, name, resetMenu) {
        var url = 'inbox_view.html';

        loading.show();
        content.html('');
        toggleButton(el);
        
        $.ajax({
            type: \"GET\",
            cache: false,
            url: url,
            dataType: \"html\",
            success: function(res) 
            {
                toggleButton(el);

                if (resetMenu) {
                    $('.inbox-nav > li.active').removeClass('active');
                }
                $('.inbox-header > h1').text('View Message');

                loading.hide();
                content.html(res);
                App.fixContentHeight();
                App.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var initTags = function (input) {
        input.tag({
            autosizedInput: true,
            containerClasses: 'span12',
            inputClasses: 'm-wrap',
            source: function (query, process) {
                /*return [
                    'Bob Nilson <bob.nilson@metronic.com>',
                    'Lisa Miller <lisa.miller@metronic.com>',
                    'Test <test@domain.com>',
                    'Dino <dino@demo.com>',
                    'Support <support@demo.com>']*/
				
            }
        });
    }

    var initWysihtml5 = function () {
        $('.inbox-wysihtml5').wysihtml5({
            \"stylesheets\": [\"assets/plugins/bootstrap-wysihtml5/wysiwyg-color.css\"]
        });
    }

    var initFileupload = function () {

        $('#fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: 'assets/plugins/jquery-file-upload/server/php/',
            autoUpload: true
        });

        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: 'assets/plugins/jquery-file-upload/server/php/',
                type: 'HEAD'
            }).fail(function () {
                $('<span class=\"alert alert-error\"/>')
                    .text('Upload server currently unavailable - ' +
                    new Date())
                    .appendTo('#fileupload');
            });
        }
    }

    var loadCompose = function (el) {
        var url = 'index.php?ctr=task_new_task&IsAjax=1';

        loading.show();
        content.html('');
        toggleButton(el);

        // load the form via ajax
        $.ajax({
            type: \"GET\",
            cache: false,
            url: url,
            dataType: \"html\",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Compose');

                loading.hide();
                content.html(res);

                initTags($('[name=\"to\"]'));
                initFileupload();
                initWysihtml5();

                $('.inbox-wysihtml5').focus();
                App.fixContentHeight();
                App.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var loadReply = function (el) {
        var url = 'inbox_reply.html';

        loading.show();
        content.html('');
        toggleButton(el);

        // load the form via ajax
        $.ajax({
            type: \"GET\",
            cache: false,
            url: url,
            dataType: \"html\",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Reply');

                loading.hide();
                content.html(res);
                $('[name=\"message\"]').val($('#reply_email_content_body').html());

                initTags($('[name=\"to\"]')); // init \"TO\" input field
                handleCCInput(); // init \"CC\" input field

                initFileupload();
                initWysihtml5();
                App.fixContentHeight();
                App.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var loadSearchResults = function (el) {
        var url = 'inbox_search_result.html';

        loading.show();
        content.html('');
        toggleButton(el);

        $.ajax({
            type: \"GET\",
            cache: false,
            url: url,
            dataType: \"html\",
            success: function(res) 
            {
                toggleButton(el);

                $('.inbox-nav > li.active').removeClass('active');
                $('.inbox-header > h1').text('Search');

                loading.hide();
                content.html(res);
                App.fixContentHeight();
                App.initUniform();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var handleCCInput = function () {
        var the = $('.inbox-compose .mail-to .inbox-cc');
        var input = $('.inbox-compose .input-cc');
        the.hide();
        input.show();
        initTags($('[name=\"cc\"]'), -10);
        $('.close', input).click(function () {
            input.hide();
            the.show();
        });
    }

    var handleBCCInput = function () {

        var the = $('.inbox-compose .mail-to .inbox-bcc');
        var input = $('.inbox-compose .input-bcc');
        the.hide();
        input.show();
        initTags($('[name=\"bcc\"]'), -10);
        $('.close', input).click(function () {
            input.hide();
            the.show();
        });
    }

    var toggleButton = function(el) {
        if (typeof el != 'undefined') {
            return;
        }
        if (el.attr(\"disabled\")) {
            el.attr(\"disabled\", false);
        } else {
            el.attr(\"disabled\", true);
        }
    }

    return {
        //main function to initiate the module
        init: function () {

            // handle compose btn click
            $('.inbox .compose-btn a').live('click', function () {
                loadCompose($(this));
            });

            // handle reply and forward button click
            $('.inbox .reply-btn').live('click', function () {
                loadReply($(this));
            });

            // handle view message
            $('.inbox-content .view-message').live('click', function () {
                loadMessage($(this));
            });

            // handle inbox listing
            $('.inbox-nav > li.inbox > a').click(function () {
                loadInbox($(this), 'inbox');
            });

            // handle sent listing
            $('.inbox-nav > li.sent > a').click(function () {
                loadInbox($(this), 'sent');
            });

            // handle draft listing
            $('.inbox-nav > li.draft > a').click(function () {
                loadInbox($(this), 'draft');
            });

            // handle trash listing
            $('.inbox-nav > li.trash > a').click(function () {
                loadInbox($(this), 'trash');
            });

            //handle compose/reply cc input toggle
            $('.inbox-compose .mail-to .inbox-cc').live('click', function () {
                handleCCInput();
            });

            //handle compose/reply bcc input toggle
            $('.inbox-compose .mail-to .inbox-bcc').live('click', function () {
                handleBCCInput();
            });

            //handle loading content based on URL parameter
            if (App.getURLParameter(\"a\") === \"view\") {
                loadMessage();
            } else if (App.getURLParameter(\"a\") === \"compose\") {
                loadCompose();
            } else {
               $('.inbox-nav > li.inbox > a').click();
            }

        }

    };

}();";
						
include_once 'application/view/template/'.$_SESSION['theme'].'/admin_footer.php';
?>
