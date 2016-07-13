var Task = function() {
	return {
		init : function(){
			Task.initPrjItemClick();
			Task.initMyItemClick();
			Task.initNewTask();
			Task.initNewTasklistClick();
			App.init();
		},
		loadTaskList : function(){
			App.preAjax($("#loadTaskList"));
			$.post(domainurl+"task/ajax_tasklist", {
				prjid : 1
			}, function(data) {
				$("#tasklist").hide();
				App.unblockUI($("#tasklist"));
				$("#tasklist").html(data).fadeIn();
				
				$('#project_id').select2({
	                placeholder: "Select",
	            });
				// App.init();
			});
		},
		focusProject : function(project_id){
			App.preAjax($("#taskitem"));
			$.post(domainurl+"task/ajax_prjtaskitem", {
				project_id : project_id
			}, function(data) {
				App.postAjax($("#taskitem"),data);
				Task.initProjectTaskClick();
				//Task.initProjectTaskRemoveClick();
				
				App.init();
			});
		},
		focusMylist: function(listid,listname){
			if(listid==undefined||listname==undefined){
				listid = $('#mytasklistdiv').data('id');
				listname = $('#mytasklistdiv').attr('data-name');
			}
			App.preAjax($("#taskitem"));
			$.post(domainurl+"task/ajax_mytaskitem", {
				listid: listid,
				listname:listname
			}, function(data) {
				App.postAjax($("#taskitem"),data);
				Task.initNewTaskClick();
				Task.initMyTaskClick();
				Task.initMyTaskRemoveClick();
				Task.initMyTaskListEditable();
				Task.initMyTaskArchiveClick();
				Task.initMyTaskUnArchiveClick();
				App.init();
			});
		},
		initNewTask : function(){
			$('#newtask').unbind( "click" );
			$('#newtask').on('click',function() {
				App.preAjax($("#taskdetail"));
				$.post(domainurl+"task/ajax_tasknew", {
					prjid : 1
				}, function(data) {
					App.postAjax($("#taskdetail"),data);
					// App.init();
				});
			});
		},
		initPrjItemClick : function(){
			$('.focusProject').unbind( "click" );
			$('.focusProject').on('click',function() {
				$('.focusProject').parent().removeClass('active');
				$('.focusMylist').parent().removeClass('active');
				$('.badge').removeClass('badge-active');
				$(this).parent().addClass('active');
				$(this).find('.badge').addClass('badge-active');
				Task.focusProject($(this).data('id'));
			});
		},
		initMyItemClick : function(){
			$('.focusMylist').unbind( "click" );
			$('.focusMylist').on('click',function() {
				$('.focusProject').parent().removeClass('active');
				$('.focusMylist').parent().removeClass('active');
				$('.badge').removeClass('badge-active');
				$(this).parent().addClass('active');
				$(this).find('.badge').addClass('badge-active');
				Task.focusMylist($(this).data('id'),$(this).attr('data-listname'));
			});
			
			$('#removetasklist').unbind( "click" );
			$('#removetasklist').on('click',function() {
				
				$( ".focusMylist" ).each(function() {
					  if($( this ).find( ".badge-active" ).length){
						  if(confirm($(this).attr('data-confirmmsg'))){
							App.preAjax($("#mytasklist"));
							$.post(domainurl+"task/ajax_removemytasklist", {
								listid: $(this).data('id')
							}, function(data) {
								Task.loadMyTaskList();
								
							});
						  }
					  }
					
					});
				
			});
		},
		
		focusMyListTaskDetail : function(id){
			App.preAjax($("#taskdetail"));
			$('.todo-tasklist-item').removeClass('active');
			$('#mytaskitem'+id).parent().addClass('active');
			$.post(domainurl+"task/ajax_mytaskitemdetail", {
				taskid: id
			}, function(data) {
				App.postAjax($("#taskdetail"),data);
				Task.initTaskDetail();
				App.init();
			});
		},
		focusProjectTaskDetail : function(id){
			App.preAjax($("#taskdetail"));
			$.post(domainurl+"task/ajax_projecttaskitemdetail", {
				taskid: id
			}, function(data) {
				App.postAjax($("#taskdetail"),data);
				Task.initTaskDetail();
				App.init();
			});
		},
		initMyTaskClick : function(){
			$('.mytaskitem').unbind( "click" );
			$('.mytaskitem').on('click',function() {
				Task.focusMyListTaskDetail($(this).data('id'));
			});
		},
		initProjectTaskClick : function(){
			$('.projecttaskitem').unbind( "click" );
			$('.projecttaskitem').on('click',function() {
				Task.focusProjectTaskDetail($(this).data('id'));
			});
		},
		
		initMyTaskRemoveClick : function(){
			$('.mytaskremove').unbind( "click" );
			$('.mytaskremove').on('click',function() {
				if(confirm($(this).attr('data-confirmmsg'))){
					App.preAjax($("#taskitem"));
					$.post(domainurl+"task/ajax_removemytask", {
						taskid: $(this).data('id')
					}, function(data) {
						App.growl(data.msg,data.type);
						Task.loadMyTaskList();
						Task.focusMylist();
					},'json');
				}
			});
		},
		initMyTaskArchiveClick : function(){
			$('.mytaskarchive').unbind( "click" );
			$('.mytaskarchive').on('click',function() {
				App.preAjax($("#taskitem"));
				$.post(domainurl+"task/ajax_archivemytask", {
					taskid: $(this).data('id')
				}, function(data) {
					App.growl(data.msg,data.type);
					Task.loadMyTaskList();
					Task.focusMylist();
				},'json');
			});
		},
		initMyTaskUnArchiveClick : function(){
			$('.mytaskunarchive').unbind( "click" );
			$('.mytaskunarchive').on('click',function() {
				App.preAjax($("#taskitem"));
				$.post(domainurl+"task/ajax_unarchivemytask", {
					taskid: $(this).data('id')
				}, function(data) {
					App.growl(data.msg,data.type);
					Task.loadMyTaskList();
					Task.focusMylist();
				},'json');
			});
		},
		
		initMyTaskSaveClick:function(){
			$('#savemytaskdetail').unbind( "click" );
			$('#savemytaskdetail').on('click',function() {
				
					App.preAjax($("#taskdetail"));
					$.post(domainurl+"task/ajax_savemytaskdetail", {
						taskid:$(this).data('id'),
						date:$('#date').val(),
						name:$('#name').val(),
						objective:$('#objective').val(),
						start:$('#start').val(),
						deadline:$('#deadline').val(),
						deadlinetime:$('#deadlinetime').val(),
						realstart:$('#realstart').val(),
						realdeadline:$('#realdeadline').val(),
					}, function(data) {
						App.growl(data.msg,data.type);
						App.unblockUI($("#taskdetail"));
						//Task.focusMylist();
					},'json');
				
			});
		
		},
		initMyTaskSubmitPostClick:function(){
			$('#submitMyTaskPost').unbind( "click" );
			$('#submitMyTaskPost').on('click',function() {
				var postid = $('#submitMyTaskPost').attr('data-id');
				App.preAjax($("#taskpost"));
				$.post(domainurl+"task/ajax_submitTaskPost", {
					taskid:$(this).data('id'),
					text:$('#taskposttext').val()
				}, function(data) {
					App.growl(data.msg,data.type);
					Task.focusMyListTaskDetail(postid);
				},'json');
			});
		},
		initTaskDetail:function(){
//			$('.taskdate').datepicker({
//				rtl: App.isRTL(),
//				orientation: "left",
//				autoclose: true,
//				format: 'yyyy-mm-dd',
//			});
			
            $('#deadlinetime').timepicker({
                autoclose: true,
                minuteStep: 5,
                showSeconds: false,
                showMeridian: false
            });
            $("#deadline").datepicker({
				rtl: App.isRTL(),
				orientation: "left",
				autoclose: true,
				format: $('#deadline').attr('data-format'),
				startDate:$("#start").val()
			})
		    .on("changeDate", function(e){
				$("#start").datepicker("setEndDate", $("#deadline").val());
			});
			Task.initMyTaskSaveClick();
			Task.initMyTaskSubmitPostClick();
		},
		initNewTasklistClick:function(){
			$('#addTaskList').unbind( "click" );
			$('#addTaskList').on('click',function() {
				var list = '<li class="newtasklistli"><input type="textbox" name="newtasklist" id="newtasklist" onBlur="Task.addNewTasklist(this.value)"></li>';
				$('#mytasklist').find('ul').append(list);
				$('#newtasklist').focus();
			});
		},
		initNewTaskClick:function(){
			$('#addTask').unbind( "click" );
			$('#addTask').on('click',function() {
			//$('#taskitem').delegate( '#addTask', 'click', function() {
				var list = '<div class="todo-tasklist-item" id="newtaskdiv"><div class="todo-tasklist-item-title"><input type="textbox" id="newtask" name="newtask" onBlur="Task.addNewTask(this.value)"></div></div>';
				//$('#mytasklistdiv').append(list);
				//$('#taskitem').find('.slimScrollDiv').append(list);
				$('#addTask').parent().prepend(list);
				$('#newtask').focus();
			});
		},
		addNewTask:function(taskname){
			if(jQuery.trim(taskname)!=''){
				App.preAjax($("#taskitem"));
				$.post(domainurl+"task/ajax_addmytask", {
					taskname:taskname,
					listid:$('#mytasklistdiv').data('id')
				}, function(data) {
					App.growl(data.msg,data.type);
					Task.loadMyTaskList();
					Task.focusMylist();
				},'json');
			}else{
				$('#newtaskdiv').remove();
			}
		},
		addNewTasklist:function(listname){
			if(jQuery.trim(listname)!=''){
				App.preAjax($("#mytasklist"));
				$.post(domainurl+"task/ajax_addmytasklist", {
					listname:listname
				}, function(data) {
					$('.newtasklistli').remove();
					App.postAjax($("#mytasklist"),data);
					Task.loadMyTaskList();
					
				});
			}else{
				$('.newtasklistli').remove();
			}
		},
		loadMyTaskList:function(){
			App.preAjax($("#mytasklist"));
			var listid = $('#mytasklistdiv').data('id');
			$.post(domainurl+"task/ajax_loadmytasklist", {
				listid:listid
			}, function(data) {
				$('.newtasklistli').remove();
				
				App.postAjax($("#mytasklist"),data);
				Task.initMyItemClick();
				
			});
		},
		initMyTaskListEditable:function(){
			
			if (App.getURLParameter('mode') == 'inline') {
				$.fn.editable.defaults.mode = 'inline';
				$('#inline').attr("checked", true);
				jQuery.uniform.update('#inline');
			} else {
				$('#inline').attr("checked", false);
				jQuery.uniform.update('#inline');
			}

			// global settings
			$.fn.editable.defaults.inputclass = 'm-wrap';
			$.fn.editable.defaults.url = domainurl+'task/ajax_renamemytasklist';
			$.fn.editable.defaults.ajaxOptions  = {dataType:'json'};
			
			$('#listname').editable({
				rtl : App.isRTL(),
				success: function(data, config) {
			    	App.growl(data.msg,data.type);
			    	Task.loadMyTaskList();
			       }
			});
		}
	};

}();