var Profile = function () {

    return {
        //main function to initiate the module
        init: function () {

        	$( ".tabmenu" ).click(function() {
        		var type = $(this).attr('data-section');
        		var artist = $(this).attr('data-artist');
        		window.history.pushState({"pageTitle":type},"", domainurl+'artist/profile/'+artist+'/'+type);
        		
        		Profile.loadSection(type,artist);
				
			});
        	
        	$( ".triggerclick" ).each(function() {
        		var type = $(this).attr('data-section');
        		var artist = $(this).attr('data-artist');
        		//$(this).trigger( "click" );
        		Profile.loadSection(type,artist);
        	});
        	
        	
        },
        loadSection:function(type,artist){
        	App.preAjax($("#tab_"+type));
			$.post(domainurl+"artist/"+type, {
				artistname:artist
			}, function(data) {
				$("#tab_"+type).hide();
				App.unblockUI($("#tab_"+type));
				$("#tab_"+type).html(data.html).fadeIn();
				$('.mix-grid').mixitup();
				App.init();
			},'json');
        }
    };
}();