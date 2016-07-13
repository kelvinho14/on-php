var Page = function() {


    return {
        //main function to initiate the module
        init: function() {
        	Page.binding();	
        	Page.bindPostMenu();
        	Page.bindOnce();
        	Page.infScroll();
        	Page.bindFollow();
        	Page.prepareUpload();
        	Page.prepareYoutubeEmbed();
        	Page.fancyBox();
        	Page.searchUserAC();
        	Page.countNotification();
        	
        	$('#posttextcontent').click(function (e) {
        		$('#posttext').show();
        		$('#postuploadimage').hide();
        		$('#postuploadvideo').hide();
        		$('#posttype').val(1);
        	});
        	$('#postimagecontent').click(function (e) {
        		$('#postuploadimage').show();
        		$('#postuploadvideo').hide();
        		$('#posttype').val(2);
        	});
        	$('#postvideocontent').click(function (e) {
        		$('#posttext').hide();
        		$('#postuploadimage').hide();
        		$('#postuploadvideo').show();
        		$('#posttype').val(4);
        	});

        	
        	
        },
        binding:function(){
        	$('#postbtn').unbind();
        	$('.assobtn').unbind();
        	$('.assoinput').unbind();
        	
        	
        	//$('#savedtab').unbind();
        	$('#loadmore').unbind();
        	$('.morecomment').unbind();
        	$('.modalbtn').unbind();
        	
        	$('.modalbtn').click(function (e) {
        		
        		var mc = $(this).attr('data-modalclass');
        		if(mc!='')
        			$('#modelcontent').addClass(mc);
        		
        	});
        	
        	
        	$('#postbtn').click(function (e) {
        		//App.blockUI({boxed: true,message: $('#loadcalmsg').val()});
        		var fileids = [];
        		$("input[type='hidden'][name='fileid[]']").each(function(){
        			fileids.push($(this).val());
        		});
        		
        		$.post("/action/ajax_postobject", {
        		//$.post("/app1/ajax_postobject", {
    				content:$('#postcontent').val(),
    				posttype:$('#posttype').val(),
    				fileid:fileids,
    				videolink:$('#postvideolink').val()
    			}, function(data) {
    				if(data.status=='success'){
    					$newItems = $(data.html);
    					if(data.container!=undefined){
    						$('#'+data.container).find('.timeline').prepend($newItems);
    					}else{
    						$('.timeline').prepend($newItems).isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
    					}
    					Page.binding();	
    					Page.bindPostMenu();
    					$('#postfilediv').html('');
    					$('#postcontent').val('');
    				}else{
    					alert(data.msg);
    				}
    			},'json');
        	});
        	
        	$('.assobtn').click(function (e) {
        		var item = $(this).attr('data-item');
        		var modal = $(this).hasClass('ismodal')?1:0;
        		$.post("/action/ajax_postasso", {
        		//$.post("/app1/ajax_postasso", {
        			modal:modal,
    				item:item,
    				type:$(this).attr('data-type')
    			}, function(data) {
    				
    				//$('#item_'+item).replaceWith(data.html);
    				//$('.timeline').isotope( 'reloadItems' ).isotope({transitionDuration:0});
    				if(modal){
    					$('#modal-row').remove();
    					$('#modal-header').append(data.html)
    					
    				}else{
    					$('#item_'+item).replaceWith(data.html);
    					if(data.fullwidth==0 || data.fullwidth==undefined){
    						$('.timeline').isotope( 'reloadItems' ).isotope({transitionDuration:0});
    					}
    				}

    				Page.binding();
    				Page.bindPostMenu();
    			},'json');
        	});
        	
        	$('.assoinput').keyup(function(e){
        		if(e.keyCode == 13){
	        		var content = jQuery.trim($(this).val());
	        		var item = $(this).attr('data-item');
	        		var modal = $(this).hasClass('ismodal')?1:0;
	        		if(content!=''){
		        		$.post("/action/ajax_postasso", {
		        		//$.post("/app1/ajax_postasso", {
		        			modal:modal,
		    				item:item,
		    				type:$(this).attr('data-type'),
		    				content:content
		    			}, function(data) {
		    				//$('#'+item+'_comment').append(data.html);
		    				if(modal){
		    					$('#modal-row').remove();
		    					$('#modal-header').append(data.html)
		    					
		    				}else{
		    					$('#item_'+item).replaceWith(data.html);
		    					if(data.fullwidth==0 || data.fullwidth==undefined){
		    						$('.timeline').isotope( 'reloadItems' ).isotope({transitionDuration:0});
		    					}
		    				}
		    				Page.binding();
		    				Page.bindPostMenu();
		    			},'json');
        			}
        		}
        	});
        	
        	/*$('#savedtab').click(function (e) {
        		var type = 'saved';
        		var last = $('#'+type+'container').find('.timeline').children().last().attr('id');
        		if(typeof(last)=='undefined')
        			var lastid = '';
        		else
        			var lastid = last.split("_")[1];
        		if(jQuery.trim($('#'+type+'container').find('.timeline').html())==''){
        			Page.getScrollContent(type,lastid);
        		}
        	});*/
        	
        	/*$('#loadmore').click(function (e) {
        		Page.doLoadMore()
        	});*/
        	
        	$('.morecomment').click(function (e) {
        		var last = $(this).parent().children().last().prev().attr('id');
        		var lastid = last.split("_")[1];
        		var modal = $(this).hasClass('ismodal')?1:0;
        		var ele = $(this);
        		$.post("/action/ajax_morecomment", {
	        			modal:modal,
	    				lastid:lastid
	    			}, function(data) {
	    				ele.parent().children().first().after(data.html);
	    				$('.timeline').isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
	    				Page.binding();
	    			},'json');
        	});
        },
        bindPostMenu:function(){
        	$('.postddmbtn').unbind();
        	$('.postddmbtn').click(function(e){
				var id = $(this).attr('data-id');
				var ele = $(this).next();
				if (ele.children().length==0) {		
	        		$.post("/page/ajax_getpostddmlist", {
	    				id:id,
	    			}, function(data) {
	    				if(data.status='success'){
	    					ele.html(data.html);
	    					Page.bindPostMenuBtn();
	    				}
	    			},'json');
				}
				
				
        	});
        },
        bindOnce:function(){
        	//$('.mediatab').unbind();
        	
        	$('.mediatype').click(function (e) {
        		var type = $(this).attr('data-item');
        		$('#page_type').val(type);
        		
        		type = $(this).attr('data-item');
        		$('#page_type').val(type);
        		$('.timeline').empty()
        		Page.getScrollContent(type,'');
        	});
        	
        	$('#notificationddmbtn').unbind();
        	$('#notificationddmbtn').click(function(e){
        		$.post("/page/ajax_getnotificationmenu", {
	    				
	    			}, function(data) {
	    				if(data.status='success'){
	    					$('#notificationmenu').html(data.html);
	    				}
	    			},'json');
				
        	});
        	
        	$('#openpost').unbind();
        	$('#openpost').click(function(e){
        		$('#postrow').slideToggle();
        	});
        	$('#scrolltop').unbind();
        	$('#scrolltop').click(function(e){
        		//$('#scrollcontentinner').scrollTop($('#scrollcontentinner').offset().top);
        		
        		$('#scrollcontentinner').stop().animate({scrollTop:0}, '500', 'swing', function() { 
        		   
        		});
        	});
        	
        	$('.filterartisttype').unbind();
        	$('.filterartisttype').click(function(e){
        		//var cb = $(this).find(':first-child');
        		//var cb = $(this).next();
        		var id = $(this).attr('data-typeid')+'_cb';
        		var cb = $('#'+id);
        		//console.log(id);
        		cb.trigger('click');
        		console.log(cb.attr('id'));
        		console.log(cb.prop("checked"));
        		if(cb.prop("checked")){
        			//cb.prop("checked",false);
        			
        			//alert('uncheck');	
        			//$('.item').hide();
        			//$('.artisttype'+$(this).attr('data-typeid')).show();
        			$(this).css('background-color',$(this).attr('data-color'));
        			$(this).addClass('btn-primary');
        		}else{
        			//cb.prop("checked",true);
        			$(this).removeClass('btn-primary');
        			$(this).css('background-color','');	
        				
        			
        		}
        		//$('.timeline').isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
        	});
        	
        	
        },
        bindPostMenuBtn:function(){
        	$('.bookmarkpost').unbind();
        	$('.bookmarkpost').click(function(e){
        		var id = $(this).attr('data-id');
        		var parentdiv = $(this).parent().parent();
        		$.post("/action/ajax_bookmarkpost", {
        		//$.post("/app1/ajax_postasso", {
    				id:id,
    			}, function(data) {
    				if(data.status='success'){
    					parentdiv.html(data.html);
    					Page.bindPostMenuBtn();
    				}
    				
    			},'json');
        		
        	});
        	
        	$('.postnotify').unbind();
        	$('.postnotify').click(function(e){
        		var id = $(this).attr('data-id');
        		var parentdiv = $(this).parent().parent();
        		$.post("/action/ajax_togglePostNotification", {
        		//$.post("/app1/ajax_postasso", {
    				id:id,
    			}, function(data) {
    				if(data.status='success'){
    					parentdiv.html(data.html);
    					Page.bindPostMenuBtn();
    				}
    				
    			},'json');
        		
        	});
        },
		bindFollow:function(){
			$('#unfollowbtn').unbind();
        	$('#followbtn').unbind();
        	
        	$('#unfollowbtn').click(function (e) {
        		var item = $(this).attr('data-item');
        		$.post("/action/ajax_unfollow", {
        			path:$(location).attr('pathname')
    			}, function(data) {
    				if(data.status='success'){
    					$('#unfollowbtn').replaceWith(data.html);
    				}
    				Page.bindFollow();
    			},'json');
        	});
        	$('#followbtn').click(function (e) {
        		var item = $(this).attr('data-item');
        		$.post("/action/ajax_follow", {
        			path:$(location).attr('pathname')
    			}, function(data) {
    				if(data.status='success'){
    					$('#followbtn').replaceWith(data.html);
    				}
    				Page.bindFollow();
    			},'json');
        	});
		},
        infScroll:function(){
        	$('.infscroll').scroll(function() {
        		if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
        			if($('#loadmore').attr('data-isnorecord')=='norecord'){
        				$('#loadmore').show();
        				setTimeout(function(){
    						$('#loadmore').fadeOut();
    					}, 2000);
        				return false;
        			}
        			Page.doLoadMore();
        		}
        	});
        },
        doLoadMore:function(){
        	if($('#allpostcontainer').length>0){
				var type = 'allpost';
			}else{
				var type = $('#page_type').val();
			}
			var lastid = Page.checkScrollLastID();
			Page.getScrollContent(type,lastid);
        },
        checkScrollLastID:function(){
        	if($('#allpostcontainer').length>0){
				var last = $('#allpostcontainer').find('.timeline').children().last().attr('id');
				var lastid = last.split("_")[1];
			}else{
				var last = $('#mediacontainer').find('.timeline').children().last().attr('id');
				
				if(typeof(last)=='undefined')
        			var lastid = '';
        		else
        			var lastid = last.split("_")[1];
			}
        	console.log(lastid);
        	return lastid;
        },
        getScrollContent:function(type,lastid){
        	$('#loadmore').show();
        	$('#loadmore').html($('#loadmore').attr('data-loading'));
        	$.post("/page/ajax_scrollpagination", {
				lastid:lastid,
				type:type,
				path:$(location).attr('pathname')
			}, function(data) {
				$newItems = $(data.html);
				
				
				var container = type=='allpost'?type:'media';
				container+='container';
				
				var target = $('#'+container+'').find('.timeline');
				var checklastid = Page.checkScrollLastID();
				console.log(checklastid);
				console.log(lastid);
				if(checklastid!=lastid)
					return false;
				if(data.fullwidth){
					console.log(type);
					console.log($('#page_type').val());
					if(type==$('#page_type').val())
						target.append( $newItems);
					else
						target.html($newItems);
				}else{
					target.append( $newItems).isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
				}
				Page.binding();
				Page.bindPostMenu();
				if(data.page==0){
					
					$('#loadmore').html($('#loadmore').attr('data-norecord'));
					$('#loadmore').attr('data-isnorecord','norecord')
					setTimeout(function(){
						$('#loadmore').fadeOut();
					}, 2000);
				}else{
					$('#loadmore').hide();
				}
			},'json');
        },
        prepareUpload:function(){
        	//basic 
        	 $('#postimagecontent').fileupload({
        	        url: '/action/ajax_uploadfile',
        	        dataType: 'json',
        	        done: function (e, data) {
        	        	//$('#progress .progress-bar').hide();
        	        	$('#progress .progress-bar').css('opacity','0'); 
        	        	$('#progress .progress-bar').css('width','0%');
        	        	$('#progress').hide();
        	            $.each(data.result.files, function (index, file) {
        	                //$('<p/>').text(file.name).appendTo('#files');
        	            	$('#postfilediv').append('<img src="'+file.url+'" width="100"><input type="hidden" name="fileid[]" class="postfileid" value="'+file.id+'"/>');
        	            });
        	        	//$('#files').html('aa');
        	        },
        	        progressall: function (e, data) {
        	        	$('#progress').show();
        	        	$('#progress .progress-bar').css('opacity','100');
        	            var progress = parseInt(data.loaded / data.total * 100, 10);
        	            $('#progress .progress-bar').css('width',progress + '%');
        	        }
        	    }).prop('disabled', !$.support.fileInput)
        	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
        	
        	 $('#profileimageupload').fileupload({
     	        url: '/action/ajax_uploadprofileimage',
     	        dataType: 'json',
     	        done: function (e, data) {
     	        	
     	        	if(data.result.status=='success'){
     	        		$('#profilepic').attr('src',data.result.html);
     	        		$('#profileimageupload').hide();
     	        		Page.settingAvatar();
     	        	}
     	        },
     	        progressall: function (e, data) {
     	        	$('#progress .progress-bar').css('opacity','100');
     	            var progress = parseInt(data.loaded / data.total * 100, 10);
     	            $('#progress .progress-bar').css('width',progress + '%');
     	        }
     	    }).prop('disabled', !$.support.fileInput)
     	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
        	 
        		//advance
        	 /* $('#fileupload').fileupload({
        	        // Uncomment the following to send cross-domain cookies:
        	        //xhrFields: {withCredentials: true},
        	        url: '/action/ajax_uploadfile'
        	    });

        	    // Enable iframe cross-domain access via redirect option:
        	    $('#fileupload').fileupload(
        	        'option',
        	        'redirect',
        	        window.location.href.replace(
        	            /\/[^\/]*$/,
        	            '/cors/result.html?%s'
        	        )
        	    );
        	    $('#fileupload').addClass('fileupload-processing');
                $.ajax({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    url: $('#fileupload').fileupload('option', 'url'),
                    dataType: 'json',
                    context: $('#fileupload')[0]
                }).always(function () {
                	
                    $(this).removeClass('fileupload-processing');
                }).done(function (result) {
                	
                    $(this).fileupload('option', 'done').call(this, $.Event('done'), {result: result});
                });*/
            
        },
        settingAvatar:function(){
        	$('#cropbtn').show();
        	$('#profilepic').Jcrop({
        			          aspectRatio: 1,
        			          onSelect: Page.updateCoords,
        			          boxWidth: 500, 
        			          boxHeight: 500,
        			          setSelect: [0, 160, 160, 0]
        			        });
        	$('#cropbtn').click(function (e) {
        		if (parseInt($('#crop_w').val())){
        			$.post("/action/ajax_cropprofilepic", {
                		//$.post("/app1/ajax_postobject", {
            				x:$('#crop_x').val(),
            				y:$('#crop_y').val(),
            				w:$('#crop_w').val(),
            				h:$('#crop_h').val()
            			}, function(data) {
            				if(data.status=='success'){
            					location.reload(); 
            				}else{
            					console.log(data);
            				}
            			},'json');
        		}else{ 
        			alert('Please select a crop region then press submit.');
        		}
        	    return false;
        	});
        },
        updateCoords:function(c){
    		$('#crop_x').val(c.x);
    		$('#crop_y').val(c.y);
    		$('#crop_w').val(c.w);
    	    $('#crop_h').val(c.h);
    	},
        prepareYoutubeEmbed:function(){
        	$("#postvideolink").bind("paste", function(e){
        	    // access the clipboard using the api
        	    var videolink = e.originalEvent.clipboardData.getData('text');
        	    
            	
        	    var vid = '';
        	    var videoid = videolink.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
        	    if(videoid != null) {
        	    	vid = videoid[1];
        	    } else { 
        	        console.log("The youtube url is not valid.");
        	        $('#embedtitle').empty();
                	$('#embedphoto').empty();
        	    }
        	    if(vid!=''){
	            	
	            	$.ajax({
	                    url: "https://www.googleapis.com/youtube/v3/videos?part=snippet&id="+vid+"&key=AIzaSyCJU3lfQ1fwdJFOhNiK82rOa3qfVPB_mmY",
	                    dataType: "jsonp",
	                    success: function (data) { 
	                    	$('#embedtitle').html(data.items[0].snippet.title);
	                    	$('#embedphoto').html('<img src="http://img.youtube.com/vi/'+vid+'/mqdefault.jpg"/>');
	                    	//console.log(data.items[0].snippet.description);
	                    	
	                    }
	            	});
        	    }
        	    
        	} );
        	/*$('.postvideolink').keyup(function(e){

        			alert($('#postvideolink').val());	

        	});*/
        	/*var video_id = $('#postvideolink');
        	var ampersandPosition = video_id.indexOf('&');
        	if(ampersandPosition != -1) {
        	  video_id = video_id.substring(0, ampersandPosition);
        	}
        	
        	$.ajax({
                url: "https://www.googleapis.com/youtube/v3/videos?part=snippet&id="+video_id+"&key=AIzaSyCJU3lfQ1fwdJFOhNiK82rOa3qfVPB_mmY",
                dataType: "jsonp",
                success: function (data) { console.log(data)}
        	});*/
        },
        fancyBox:function(){
        	$(".fancyboxajax").fancybox({
        		openEffect	: 'none',
        		closeEffect	: 'none',
        		type:'ajax'
        	});
        	$(".fancyboximg").fancybox({
        		openEffect	: 'none',
        		closeEffect	: 'none',
        	});
        	
        	$('body').on('hidden.bs.modal', '.modal', function () {
        		  $(this).removeData('bs.modal');
        		});
        },
        searchUserAC:function(){
        	if($( "#searchuser" ).length>0){
	    	    $( "#searchuser" ).autocomplete({
	      	      source: function( request, response ) {
	      	        $.ajax({
	      	          url: "/action/ajax_acuser",
	      	          dataType: "json",
	      	          data: {
	      	            s: request.term
	      	          },
	      	          success: function( data ) {
	      	            response( data );
	      	          }
	      	        });
	      	      },
	      	      minLength: 3,
	      	      select: function( event, ui ) {
	      	    	  window.location="/page/"+ui.item.value;
	      	      },
	      	      open: function() {
	      	        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
	      	      },
	      	      close: function() {
	      	        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
	      	      }
	      	    });
	      	    $( "#searchuser" ).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	      	    	
	      	        var $li = $('<li>'),
	      	            $img = $('<img>');
	      	        $img.attr({
	      	          src: item.profilepic,
	      	          alt: item.label 
	      	        });
	      	        $li.attr('data-value', item.label);
	      	        $li.append('<a href="#">');
	      	        $li.find('a').append($img).append('&nbsp;&nbsp;'+item.label);    
	
	      	        return $li.appendTo(ul);
	      	      };
        	}
        },
        countNotification:function(){
        	$.post("/page/ajax_countnotification", {
        		//$.post("/app1/ajax_postobject", {
    				
    			}, function(data) {
    				if(data.status=='success'){
    					if(data.html>0){
    						$('#notificationbadge').html(data.html);
    						$('#notificationbadge').show();
    					}
    				}
    			},'json');
        },
        showLoading: function(){
        	App.blockUI({
    			target: '#calendar',
    			boxed: true,
    			message: $('#loadcalmsg').val()
    		});
        },
        
        
    };
}();