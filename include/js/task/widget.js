var Task = function() {


    return {
        
        init: function() {
        	Task.focusMylist(0);
        },
        focusMylist: function(listid){
        	App.preAjax($("#taskwidget"));
			$.post(domainurl+"task/ajax_dashboard", {
				listid: listid,
			}, function(data) {
				App.postAjax($("#taskwidget"),data.widget);
				if($('#tasktile').length==0)
					$("#tilediv").append(data.tile);
				Task.initMyTaskArchiveClick();
	        	Task.initMyTaskUnArchiveClick();
	        	Task.initMyItemClick();
	        	Task.initEditItemClick();
				Task.initCheckboxcss();
				App.init();
			},'json');
		},initCheckboxcss:function(){
			$('.task-list input[type="checkbox"]').change(function() {
				if ($(this).is(':checked')) { 
					$(this).parents('li').addClass("task-done"); 
				} else { 
					$(this).parents('li').removeClass("task-done"); 
				}
			});
		},
        initMyTaskArchiveClick : function(){
			$('.mytaskarchive').unbind( "click" );
			$('.mytaskarchive').on('click',function() {
				$(this).removeClass('mytaskarchive');
				$(this).addClass('mytaskunarchive');
				App.preAjax($("#taskitem"));
				$.post(domainurl+"task/ajax_archivemytask", {
					taskid: $(this).data('id')
				}, function(data) {
					App.growl(data.msg,data.type);
					Task.focusMylist(0);
				},'json');
			});
		},
		initMyTaskUnArchiveClick : function(){
			$('.mytaskunarchive').unbind( "click" );
			$('.mytaskunarchive').on('click',function() {
				$(this).removeClass('mytaskunarchive');
				$(this).addClass('mytaskarchive');
				App.preAjax($("#taskitem"));
				$.post(domainurl+"task/ajax_unarchivemytask", {
					taskid: $(this).data('id')
				}, function(data) {
					App.growl(data.msg,data.type);
					Task.focusMylist(0);
				},'json');
			});
		},
		initMyItemClick : function(){
			$('.focusMylist').unbind( "click" );
			$('.focusMylist').on('click',function() {
				
				$(this).parent().addClass('active');
				$(this).find('.badge').addClass('badge-active');
				Task.focusMylist($(this).data('id'));
			});
			
		},initEditItemClick: function(){
			$('.taskedit').unbind( "click" );
			$('.taskedit').on('click',function() {
				window.location = domainurl+'task/mytask/?type=mytask&id='+$(this).attr('data-id');
			});
			
		},
		
        
    };
}();
