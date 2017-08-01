<script src="http://code.jquery.com/jquery-latest.js"></script><script type="text/javascript">
$(document).ready(function() {
    $('#edit_category').click(function(){
									
		var category =$("#category-name").val();

		if(category=='') { alert('Please enter category name.'); exit; }

		var categorydesc =$("#category-description").val();
		var categoryorder =$("#category-order").val();
		var category_id =$("#category_id").val();

		var url="<?php echo WP_PLUGIN_URL; ?>/shepleywood_team/includes/ajax_team_categories.php?action=editcat&category="+category+"&categorydesc="+categorydesc+"&categoryorder="+categoryorder+"&category_id="+category_id;
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
 <h2>Edit Category</h2>
<input type="hidden" name="category_id" id="category_id" value="<?php echo $this->categories[0]->id; ?>"/>
 <table class="form-table">
		<tbody><tr class="form-field form-required">
			<th valign="top" scope="row">
			<label for="name">Name</label>
			</th>
			<td>
			<input type="text" aria-required="true" size="40" value="<?php echo $this->categories[0]->name; ?>" id="category-name" name="category-name">
			<p class="description">The category name is how it appears on your site.</p></td>
		</tr>
		
		<tr class="form-field">
			<th valign="top" scope="row"><label for="description">Description</label></th>
			<td>
	<textarea class="large-text" cols="50" rows="5" id="category-description" name="category-description"><?php echo $this->categories[0]->descr; ?></textarea>
			<br>
			<span class="description">The description is not prominent by default, however some themes may show it.</span></td>
		</tr>
        <tr class="form-field">
			<th valign="top" scope="row"><label for="description">Display Order</label></th>
			<td>
	        <input type="text" aria-required="true" size="20" value="<?php echo $this->categories[0]->catorder; ?>" id="category-order" name="categoy-order">
			<br>
			<span class="description">This order set the font view.</span></td>
		</tr>
			</tbody>
			</table>
	<p class="submit"><input type="submit" value="Update" class="button-primary" id="edit_category" name="edit_category"><span id="ajax_call" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/shepleywood_team/images/wpspin_light.gif"/></span></p>
</div>