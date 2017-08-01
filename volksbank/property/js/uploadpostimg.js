jQuery(document).ready(function() { 
 
var uploadEID          = '';
var storeESendToEditor = '';
var newESendToEditor   = '';


storeESendToEditor = window.send_to_editor;
newESendToEditor  = (function(html) {
                                    imgurl = jQuery(html).attr('href');
                                    uploadID.val(imgurl);
                                    tb_remove();
                                    window.send_to_editor = storeESendToEditor;
                                });
      
	  
	  
	    jQuery('.custominfoupload').click(function() {
            window.send_to_editor = newESendToEditor;
            uploadID = jQuery(this).prev('input');
            formfield = jQuery('.custominfoinput').attr('name');
            wp.media.editor.open(this);
            return false;
        });

 jQuery('.customupload').click(function() {
            window.send_to_editor = newESendToEditor;
            uploadID = jQuery(this).prev('input');
            formfield = jQuery('.custominput').attr('name');
            wp.media.editor.open(this);
            return false;
        });


});