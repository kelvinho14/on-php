var User = function () {
	return {
		// main function to initiate the module
		init: function () {
			$('#profilepic').Jcrop({
		          aspectRatio: 1,
		          onSelect: updateCoords,
		          boxWidth: 500, 
		          boxHeight: 500,
		          setSelect: [0, 160, 160, 0]
		        });

		        function updateCoords(c)
		          {
		            $('#crop_x').val(c.x);
		            $('#crop_y').val(c.y);
		            $('#crop_w').val(c.w);
		            $('#crop_h').val(c.h);
		          };

		          $('#mainform').submit(function(){
		            if (parseInt($('#crop_w').val())) return true;
		            alert('Please select a crop region then press submit.');
		            return false;
		            });
			App.init();
		},
		
	}
}();