  <!-- jQuery(document).ready(function($) {
   //uploading files variable
   var custom_file_frame;
   jQuery(document).on('click', '.ls_test_media', function(event) {
      event.preventDefault();
      //If the frame already exists, reopen it
      if (typeof(custom_file_frame)!=="undefined") {
         custom_file_frame.close();
      }

      //Create WP media frame.
      custom_file_frame = wp.media.frames.customHeader = wp.media({
         //Title of media manager frame
         title: "Profile Media Uploader",
         library: {
            type: 'image'
         },
         button: {
            //Button text
            text: "Select"
         },
         //Do not allow multiple files, if you want multiple, set true
         multiple: false
      });

      //callback for selected image
      custom_file_frame.on('select', function() {
         var attachment = custom_file_frame.state().get('selection').first().toJSON();
		 //alert(attachment.toSource());
		 var selectedimage = '<p><img src="'+attachment.url+'" height="100" width="100"/></p>';
		 jQuery('#profile_image_url').val(attachment.url);
		 jQuery('#profile_image_id').val(attachment.id);
		 jQuery('#profile-img').html(selectedimage);
		 //do something with attachment variable, for example attachment.filename
         //Object:
         //attachment.alt - image alt
         //attachment.author - author id
         //attachment.caption
         //attachment.dateFormatted - date of image uploaded
         //attachment.description
         //attachment.editLink - edit link of media
         //attachment.filename
         //attachment.height
         //attachment.icon - don't know WTF?))
         //attachment.id - id of attachment
         //attachment.link - public link of attachment, for example ""http://site.com/?attachment_id=115""
         //attachment.menuOrder
         //attachment.mime - mime type, for example image/jpeg"
         //attachment.name - name of attachment file, for example "my-image"
         //attachment.status - usual is "inherit"
         //attachment.subtype - "jpeg" if is "jpg"
         //attachment.title
         //attachment.type - "image"
         //attachment.uploadedTo
         //attachment.url - http url of image, for example "http://site.com/wp-content/uploads/2012/12/my-image.jpg"
         //attachment.width
      });

      //Open modal
      custom_file_frame.open();
   });
});jQuery(document).ready(function($) {
   //uploading files variable
   var custom_file_frame;
   jQuery(document).on('click', '.ls_test_media', function(event) {
      event.preventDefault();
      //If the frame already exists, reopen it
      if (typeof(custom_file_frame)!=="undefined") {
         custom_file_frame.close();
      }

      //Create WP media frame.
      custom_file_frame = wp.media.frames.customHeader = wp.media({
         //Title of media manager frame
         title: "Profile Media Uploader",
         library: {
            type: 'image'
         },
         button: {
            //Button text
            text: "Select"
         },
         //Do not allow multiple files, if you want multiple, set true
         multiple: false
      });

      //callback for selected image
      custom_file_frame.on('select', function() {
         var attachment = custom_file_frame.state().get('selection').first().toJSON();
		 //alert(attachment.toSource());
		 var selectedimage = '<p><img src="'+attachment.url+'" height="100" width="100"/></p>';
		 jQuery('#profile_image_url').val(attachment.url);
		 jQuery('#profile_image_id').val(attachment.id);
		 jQuery('#profile-img').html(selectedimage);
		 //do something with attachment variable, for example attachment.filename
         //Object:
         //attachment.alt - image alt
         //attachment.author - author id
         //attachment.caption
         //attachment.dateFormatted - date of image uploaded
         //attachment.description
         //attachment.editLink - edit link of media
         //attachment.filename
         //attachment.height
         //attachment.icon - don't know WTF?))
         //attachment.id - id of attachment
         //attachment.link - public link of attachment, for example ""http://site.com/?attachment_id=115""
         //attachment.menuOrder
         //attachment.mime - mime type, for example image/jpeg"
         //attachment.name - name of attachment file, for example "my-image"
         //attachment.status - usual is "inherit"
         //attachment.subtype - "jpeg" if is "jpg"
         //attachment.title
         //attachment.type - "image"
         //attachment.uploadedTo
         //attachment.url - http url of image, for example "http://site.com/wp-content/uploads/2012/12/my-image.jpg"
         //attachment.width
      });

      //Open modal
      custom_file_frame.open();
   });
}); -->
<link rel="stylesheet" href="<?php echo WP_PLUGIN_URL; ?>/employee-manager/css/prettify.css" type="text/css"/>
<style>
td.dragHandle {
cursor: move !important;
}

td.showDragHandle {
	background-image: url(images/updown2.gif);
	background-repeat: no-repeat;
	background-position: center center;
	cursor: move !important;
}

</style>
<script src="<?php echo WP_PLUGIN_URL; ?>/employee-manager/js/media-custom-upload.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() { 

    jQuery('#profile-Form').submit(function(e){
        e.preventDefault(); 
		var formData = jQuery(this).serializeArray();
		//alert(formData.toSource());
		var profile =jQuery("#profile-name").val();
        if(profile=='') { alert('Please enter profile name.'); jQuery("#profile-name").focus(); return false; }
		
		var profileemail =jQuery("#profile-email").val();
        if(profileemail=='') 
		 { alert('Please enter profile email.'); jQuery("#profile-email").focus(); return false; }
        if(profileemail.length > 0) {
			var x=profileemail;
			var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
			{
			alert('Please enter valid profile email.'); jQuery("#profile-email").focus(); return false;
			}
		}
		
		var profilecategory =jQuery("#profile-category").val();
        if(profilecategory=='') { alert('Please select profile category.'); jQuery("#profile-category").focus(); return false; }
		
		var url="<?php echo WP_PLUGIN_URL; ?>/employee-manager/includes/ajax_emp_profiles.php?action=addnew";
		 jQuery('#ajax_call').css('display','block');

		jQuery.ajax({

             type: "POST",

             url:url, 

             async: false,

             data: formData,
             
			 dataType:'json',
			 
             success:function(result){  //alert(result);
                jQuery('#ajax_call').css('display','none'); //Hide Loader
				if(result.status == "success")
				  window.location.href = result.redirect;
				else
				  window.location.href = result.redirect; //Error Redirect
			}}); 

			      

    }); 

    jQuery('#delete_profiles').click(function(){

		var action=jQuery('#bulkaction').val();	

		if(action=='-1')
        {

		alert('Please select action.'); exit;						

		}

		var ids = [];

		jQuery(':checkbox:checked').each(function(i){

		  ids[i] = jQuery(this).val();

		}); 
        if(ids == "") { alert('Please select profiles.'); return false; } 
		var url="<?php echo WP_PLUGIN_URL; ?>/employee-manager/includes/ajax_emp_profiles.php?action="+action+"&ids="+ids;
         jQuery('#ajax_call_bulk').css('display','block'); //Show Loader

		jQuery.ajax({

             type: "POST",

             url:url, 

             async: false,

             data: {},
			 
			  dataType:'json',

             success:function(result){ 

                jQuery('#ajax_call_bulk').css('display','none'); //Hide Loader
				if(result.status == "success")
				  window.location.href = result.redirect;
				else
				  window.location.href = result.redirect; //Error Redirect

			}}); 

			      

    });
	
	jQuery('#filter_profiles').click(function(e) {
        e.preventDefault();
		var cat = jQuery('#profile-categories').val();
		if(cat=='') { alert('Please select profile category to filter profile.'); return false; }
		jQuery('#ajax_call_filter').css('display','block'); //Show Loader
		if(cat) window.location.href = "admin.php?page=employee_profiles&action=filter&category_id="+cat;
    }); 

});    	
function check_confirm()

 {

   if(confirm("Are you sure you want to delete!"))

   {

	 return true;   

   }

   else

   {

	 return false;   

   }

 }

</script>
<div class="wrap">
 <div class="icon32 icon32-posts-post" id="icon-edit"><br></div> 
 <h2>Manage Team Profiles</h2>
    <form action="admin.php?page=employee_profiles&action=search" method="post">
	<p class="search-box">
	<label for="tag-search-input" class="screen-reader-text">Search Profiles:</label>
	<input type="search" name="search_profile_input" value="<?php echo $_REQUEST['search_profile_input']; ?>" id="search_profile_input">
	<input type="submit" value="Search Profiles" class="button" id="search-page" name="search-page">
	</p>
	</form>
	<br class="clear">
<div id="message">
   <?php if($this->alert_status) : ?>
      <?php if($this->alert) : ?> 
         <div id="message" class="updated fade"><p><?php echo $this->alert; ?></p></div>
      <?php endif; ?>   
   <?php else: ?>
      <?php if($this->alert) : ?> 
         <div id="message" class="error"><p><?php echo $this->alert; ?></p></div>
      <?php endif; ?>
   <?php endif; ?>
   
</div> 
<div id="col-container">

<div id="col-right">
<div class="col-wrap">
<div class="tablenav top">
        
		<!--Bulk Actions Regions-->
		<div class="alignleft actions">
		<select name="bulkaction" id="bulkaction">
		<option selected="selected" value="-1">Bulk Actions</option>
		<option value="bulkdelete">Delete</option>
		</select>
		<input type="submit" value="Apply" class="button-secondary action" id="delete_profiles" name="delete_profiles">
        <span id="ajax_call_bulk" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/employee-manager/images/wpspin_light.gif"/></span>
        
		</div>
		<div class="alignleft actions">
		<select name="profile-categories" id="profile-categories">
        <option value="">--Select Category--</option>
        <?php if(count($this->categories) > 0) : ?>
          <?php foreach($this->categories as $category) : ?>
             <option value="<?php echo $category->id; ?>" <?php if($_GET['category_id'] == $category->id) {  ?> selected="selected" <?php } ?>><?php echo $category->name;  ?></option>
          <?php endforeach; ?>
        <?php endif; ?>
        </select>
		<input type="submit" value="Filter" class="button-secondary action" id="filter_profiles" name="filter_profiles">
        <span id="ajax_call_filter" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/employee-manager/images/wpspin_light.gif"/></span>
		</div>
		<!--count Regions-->
		<div class="tablenav-pages one-page"><span class="displaying-num"><?php echo count($this->profiles); ?> <?php echo count($this->profiles) > 1 ? 'items' : 'item';  ?></span>
		</div>
		<br class="clear">
	</div>
<table id="table-5" cellspacing="0" class="wp-list-table widefat fixed tags">
	<thead>
	<tr>
		<th style="width:5%;" class="manage-column column-cb check-column" id="cb" scope="col">
		<input type="checkbox" value=" "></th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Name</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Email</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col" align="center">
		<span>Featured Image</span>
		<span class="sorting-indicator"></span>
		</th>
    </tr>
	</thead>

	<tfoot>
	<tr>
		<th style="width:5%;" class="manage-column column-cb check-column" id="cb" scope="col">
		<input type="checkbox" value=" "></th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Name</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Email</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col" align="center">
		<span>Featured Image</span>
		<span class="sorting-indicator"></span>
		</th>
    </tr>
	</tfoot>

	<tbody class="list:tag" id="the-list">
		<?php if(count($this->profiles)){  $i=0;
		foreach($this->profiles as $profile) { $i++;  ?>
		<tr class="alternate" id="table5-row-<?php echo $profile->id; ?>">
		<th class="check-column" scope="row">
	    <input type="checkbox" value="<?php echo $profile->id; ?>" name="profile_id;" id="profile_id"> 
        <input type="hidden" class="postorder" id="row-<?php echo $profile->id; ?>" name="row-<?php echo $profile->id; ?>" value="<?php echo $i;?>" />        
		</th>
		<td class="name column-name">
		<strong>
		<a title="<?php echo $profile->name; ?>" href="admin.php?page=employee_profiles&action=edit&profileid=<?php echo $profile->id; ?>" class="row-title">
		<?php echo $profile->name; ?>
		</a>
		</strong>
		<div class="row-actions">

			<span class="edit">

			<a title="Edit this item" href="admin.php?page=employee_profiles&action=edit&profileid=<?php echo $profile->id; ?>">Edit</a> | </span>

			<span class="trash">

			<a href="admin.php?page=employee_profiles&action=delete&profileid=<?php echo $profile->id; ?>" onclick="return check_confirm();" title="Move this item to the Trash" class="submitdelete">

			Trash</a>

			</span>

			</div>
		</td>
		<td class="slug column-slug dragHandle">
		<a href="mailto:<?php echo $profile->email; ?>" title="Send Email"><?php echo $profile->email; ?></a>
		</td>
		<td class="description column-description dragHandle" align="center">
		  <img src="<?php  echo $profile->profile_img_url; ?>" alt="<?php echo $profile->name; ?>" height="120" width="100"/>
		</td>
		</tr>		
		<?php } 
		} else { 
		 ?>
		 <tr>
		<td colspan="4" align="center" style="" class="manage-column column-title" id="title" scope="col" >
			<p style="height:20px;">No Profile Found.</p>
			
		</td>
		</tr>
		 <?php }?>
		</tbody>
</table>
	<div class="tablenav bottom">

		
	</div>
<!--<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/employee-manager/js/prettify.js"></script>
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/employee-manager/js/jquery.tablednd.js"></script>-->
<!--<script type="text/javascript">
    $(document).ready(function() {
	
        prettyPrint();
        $('#table-5').tableDnD({
            onDragStart: function(table, row) {
                $(table).parent().find('.result').text('');
            },
            onDrop: function(table, row) {
                 
				 //Custom Function start
				  var orderData = [];
				  var postId = [];
				      $(".postorder").each(function(index){
						  var pid = $(this).attr('id');
						  var poid = pid.split('row-');
						  orderData.push([(index+1)]);
						  postId.push([poid[1]]);
						 
					 });
					 
					var url="<?php echo WP_PLUGIN_URL; ?>/employee-manager/includes/ajax_emp_profiles.php?action=updateorder&orderData="+orderData+"&postId="+postId;
					
						$.ajax({
						type: "POST",
						url:url, 
						async: false,
						data: {},
				       dataType:'json',
						success:function(result){ //alert(result); 
						if(result.status == "success")
						window.location.href = result.redirect;
						else
						window.location.href = result.redirect; //Error Redirect
						}}); 
				
				 
				 //custom function end
            },
            dragHandle: ".dragHandle"
        });

        

           });
</script> -->
    
<br class="clear">



</div>
</div><!-- /col-right -->

<div id="col-left">
<div class="col-wrap">


<div class="form-wrap">
<h3>Add New Profile</h3>
<form method="post" action="" name="profile-Form" id="profile-Form">
<!--<input type="hidden" name="action" id="action" value="addnew"/>-->
<div class="form-field form-required">
	<label for="tag-name">Name</label>
	<input type="text" aria-required="true" size="40" value="" id="profile-name" name="profile-name">
</div>

<div class="form-field">
	<label for="tag-description">Phone No.</label>
	<input type="text" aria-required="true" size="40" value="" id="profile-phone" name="profile-phone">
</div>
<div class="form-field">
	<label for="tag-description">Fax No.</label>
	<input type="text" aria-required="true" size="40" value="" id="profile-fax" name="profile-fax">
</div>
<div class="form-field">
	<label for="tag-description">Email</label>
	<input type="text" aria-required="true" size="40" value="" id="profile-email" name="profile-email">
</div>


<div class="form-field">
	<label for="tag-description">Biography</label>
	<textarea id="profile-biography" name="profile-biography" aria-required="true" ></textarea>
    
</div>

<p>
<input type="hidden" name="profile_image_url" id="profile_image_url" value="" class="image-id blazersix-media-control-target">
<input type="hidden" name="profile_image_id" id="profile_image_id" value=""/>
<a href="#" class="button ls_test_media">Choose Featured Image</a>
<span id="profile-img"></span>
</p>

<p>
<!--<input type="hidden" name="certification_logo[url]" id="certification_logo_url" value="">
<input type="hidden" name="certification_logo[id]" id="certification_logo_id" value=""/>-->
<span id="logo_fields"></span>
<a href="#" class="button ls_certification_media">Choose Certification Logo </a>
<br /><br />
<span id="certification-img"></span>

</p>
<div style="clear:both"></div>

<div class="form-field form-required">
	<label for="tag-name">Profile Category</label>
    <select name="profile-category" id="profile-category">
    <option value="">--Select Category--</option>
    <?php if(count($this->categories) > 0) : ?>
      <?php foreach($this->categories as $category) : ?>
         <option value="<?php echo $category->id; ?>"><?php echo $category->name;  ?></option>
      <?php endforeach; ?>
    <?php endif; ?>
    </select>
</div>
<p class="submit">
  <input type="submit" value="Add New Profile" class="button" id="add_profile" name="add_profile">
  <span id="ajax_call" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/employee-manager/images/wpspin_light.gif"/></span>
</p>
</div>

</div>
</div><!-- /col-left -->

</div>
</div>