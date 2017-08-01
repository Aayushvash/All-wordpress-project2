jQuery(document).ready(function() {
	var uploadID = ''; 
	jQuery('.uploadbutton').click(function() {
    uploadID = jQuery(this).prev('input');     
    wp.media.editor.open(this);
    return false;
});

window.send_to_editor = function(html) {
    imgurl = jQuery('img',html).attr('src');
	uploadID.val(imgurl);
    tb_remove();
};

	});

