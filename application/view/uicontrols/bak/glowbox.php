<script>
$('#<?php echo $ElementData['ID'];?>').click(function () {
	$.gritter.add({
	    // (string | mandatory) the heading of the notification
	    title: '<?php echo $ElementData['Title'];?>',
	    // (string | mandatory) the text inside the notification
	    text: '<?php echo $ElementData['Text'];?>',
	    // (string | optional) the image to display on the left
	    image: '<?php echo $ElementData['Image'];?>',
	    // (bool | optional) if you want it to fade out on its own or just sit there
	    sticky: <?php echo $ElementData['Sticky'];?>,
	    // (int | optional) the time you want it to be alive for before fading out
	    time: '<?php echo $ElementData['Title'];?>',
	    class_name: 'gritter-light'
	});
	return false;
});
</script>