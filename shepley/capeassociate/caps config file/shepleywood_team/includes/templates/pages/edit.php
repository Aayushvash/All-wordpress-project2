<script src="http://code.jquery.com/jquery-latest.js"></script><script type="text/javascript">
$(document).ready(function() {
    $('#edit_page').click(function(){
									
		var page =$("#page-name").val();

		if(page=='') { alert('Please enter page title.'); $("#page-name").focus(); return false; }

		var pagedesc =$("#page-description").val();
		var pagecategory =$("#page-category").val();
		var page_id = $('#page_id').val();
		var post_page_id = $('#post_page_id').val();
		
		if(pagecategory  =='') { alert('Please select page category.'); $("#page-category").focus(); return false; }

		var url="<?php echo WP_PLUGIN_URL; ?>/shepleywood_team/includes/ajax_team_pages.php?action=editpage&page="+page+"&pagedesc="+pagedesc+"&pagecategory="+pagecategory+"&page_id="+page_id+"&post_page_id="+post_page_id;
        $('#ajax_call').css('display','block'); //Show Loader

		$.ajax({
             
			 type: "POST",

             url:url, 

             async: false,

             data: {},
             
			 dataType:'json',
			 
             success:function(result){ 
                $('#ajax_call').css('display','none'); //Hide Loader
				
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
 <h2>Edit Pages</h2>
<input type="hidden" name="page_id" id="page_id" value="<?php echo $this->pages[0]->id; ?>"/>
<input type="hidden" name="post_page_id" id="post_page_id" value="<?php echo $this->pages[0]->page_id; ?>"/>
 <table class="form-table">
		<tbody><tr class="form-field form-required">
			<th valign="top" scope="row">
			<label for="name">Page Title</label>
			</th>
			<td>
			<input type="text" aria-required="true" size="40" value="<?php echo $this->pages[0]->title; ?>" id="page-name" name="page-name">
			<p class="description">The page name is how it appears on your site.</p></td>
		</tr>
		
		<tr class="form-field">
			<th valign="top" scope="row"><label for="description">Description</label></th>
			<td>
	<textarea class="large-text" cols="50" rows="5" id="page-description" name="page-description"><?php echo $this->pages[0]->descr; ?></textarea>
			<br>
			<span class="description">The description is not prominent by default, however some themes may show it.</span></td>
		</tr>
        <tr class="form-field">
			<th valign="top" scope="row"> <label for="tag-name">Page Category</label></th>
			<td>
	        <select name="page-category" id="page-category">
            <option value="">--Select Category--</option>
            <?php if(count($this->categories) > 0) : ?>
              <?php foreach($this->categories as $category) : ?>
                 <option value="<?php echo $category->id; ?>"  <?php if($this->pages[0]->category_id == $category->id) {  ?> selected="selected" <?php } ?>><?php echo $category->name;  ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
            </select>
            <p>Select any page ctaegory.</p>

            </td>
		</tr>
			</tbody>
			</table>
	<p class="submit"><input type="submit" value="Update" class="button-primary" id="edit_page" name="edit_page"><span id="ajax_call" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/shepleywood_team/images/wpspin_light.gif"/></span></p>
</div>