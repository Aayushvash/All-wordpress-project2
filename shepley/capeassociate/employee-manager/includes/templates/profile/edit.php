<!--<script src="http://code.jquery.com/jquery-latest.js"></script> -->
<script src="<?php echo WP_PLUGIN_URL; ?>/employee-manager/js/media-custom-upload.js"></script>
<!--<script src="<?php echo WP_PLUGIN_URL; ?>/shepleywood_team/js/jquery-1.11.3.min.js"></script> -->
<script type="text/javascript">
jQuery(document).ready(function() {

    jQuery('#profile-Form').submit(function(e){
        e.preventDefault(); 
		var formData = jQuery(this).serializeArray();
		
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
		
		var url="<?php echo WP_PLUGIN_URL; ?>/employee-manager/includes/ajax_emp_profiles.php?action=editprofile";
		 jQuery('#ajax_call').css('display','block');

		jQuery.ajax({

             type: "POST",

             url:url, 

             async: false,

             data: formData,
             
			 dataType:'json',
			 
             success:function(result){  
                jQuery('#ajax_call').css('display','none'); //Hide Loader
				if(result.status == "success")
				  window.location.href = result.redirect;
				else
				  window.location.href = result.redirect; //Error Redirect
			}}); 

			      

    }); 
});    	

</script>
<div class="wrap">
<div class="icon32 icon32-posts-post" id="icon-edit"><br></div> 
 <h2>Edit Profile</h2>
 <form method="post" action="" name="profile-Form" id="profile-Form">
<input type="hidden" name="profile_id" id="profile_id" value="<?php echo $this->profiles[0]->id; ?>"/>
<table class="form-table">
		<tbody>
        <tr class="form-field form-required">
			<th valign="top" scope="row">
			<label for="name">Name</label>
			</th>
			<td>
			<input type="text" aria-required="true" size="40" value="<?php echo $this->profiles[0]->name; ?>" id="profile-name" name="profile-name">
            </td>
		</tr>
         
         <tr class="form-field form-required">
			<th valign="top" scope="row">
			<label for="name">Phone No.</label>
			</th>
			<td>
			<input type="text" aria-required="true" size="40" value="<?php echo $this->profiles[0]->phone; ?>" id="profile-phone" name="profile-phone">
            </td>
		</tr>
        
         <tr class="form-field form-required">
			<th valign="top" scope="row">
			<label for="name">Fax No.</label>
			</th>
			<td>
			<input type="text" aria-required="true" size="40" value="<?php echo $this->profiles[0]->fax; ?>" id="profile-fax" name="profile-fax">
            </td>
		</tr>
       <tr class="form-field form-required">
			<th valign="top" scope="row">
			<label for="name">Email</label>
			</th>
			<td>
			<input type="text" aria-required="true" size="40" value="<?php echo $this->profiles[0]->email; ?>" id="profile-email" name="profile-email">
            </td>
		</tr>
		
        <tr class="form-field form-required">
			<th valign="top" scope="row">
			<label for="name">Biography</label>
			</th>
			<td>
			<textarea id="profile-biography" name="profile-biography"> <?php echo $this->profiles[0]->biography; ?> </textarea>
            </td>
		</tr>
        
       
       
        <tr class="form-field form-required">
			<th valign="top" scope="row">
			<label for="name">Profile Image</label>
			</th>
			<td>
            <input type="hidden" name="profile_image_url" id="profile_image_url" value="<?php echo $this->profiles[0]->profile_img_url; ?>" class="image-id blazersix-media-control-target">
            <input type="hidden" name="profile_image_id" id="profile_image_id" value="<?php echo $this->profiles[0]->profile_img_id; ?>"/>
            <a href="#" class="button ls_test_media">Update Profile Image</a>
            <span id="profile-img">
              <p><img src="<?php  echo $this->profiles[0]->profile_img_url; ?>" alt="<?php echo $profile->name; ?>" height="100" width="100"/></p>
            </span>
            
           </td>
		</tr>
        
        <tr class="form-field form-required">
			<th valign="top" scope="row">
			<label for="name">Certification Logo</label>
			</th>
			<td>
            <span id="logo_fields"></span>
            <span id="old_logo_fields">
             <?php $urls = json_decode ($this->profiles[0]->certification_logo_url); ?>
            <?php   if($urls){ ?>
              <?php  foreach ($urls as $value) { ?>
              <input type="hidden" name="certification_logo[url][]"  value="<?php echo $value; ?>">
              <?php } } ?>
             <?php $imgids = json_decode ($this->profiles[0]->certification_logo_id); ?>
               <?php   if($imgids){ ?>
               <?php  foreach ($imgids as $value) { ?>
               <input type="hidden" name="certification_logo[id][]" value="<?php echo $value; ?>"/>
               <?php }} ?>
             </span>
            
            <a href="#" class="button ls_certification_media">Update Certification Image</a>
            <div style="clear:both"></div>  
             <span id="certification-img"> 
			 <?php  $certificationurl = json_decode ($this->profiles[0]->certification_logo_url); ?>
             <?php   if($certificationurl){ ?>
            <?php  foreach ($certificationurl as $value) { ?>
         
            	<p style="width:120px;float:left"><img src="<?php echo $value ?>" alt="<?php echo $profile->name; ?>" height="100" width="100"/></p>
            
            <?php } } ?>
             </span>
          	            
           </td>
		</tr>
         
        <tr class="form-field">
			<th valign="top" scope="row"> <label for="tag-name">Profile Category</label></th>
			<td>
	        <select name="profile-category" id="profile-category">
            <option value="">--Select Category--</option>
            <?php if(count($this->categories) > 0) : ?>
              <?php foreach($this->categories as $category) : ?>
                 <option value="<?php echo $category->id; ?>"  <?php if($this->profiles[0]->category_id == $category->id) {  ?> selected="selected" <?php } ?>><?php echo $category->name;  ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
            </select>
            </td>
		</tr>
			</tbody>
			</table>
	  <p class="submit">
    <input type="submit" value="Update" class="button-primary" id="edit_profile" name="edit_profile">
    <span id="ajax_call" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/employee-manager/images/wpspin_light.gif"/></span>
    </p>
 </form>   
</div>