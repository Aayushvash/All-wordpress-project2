<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function() { 

    $('#add_page').click(function(){

		var page =$("#page-name").val();

		if(page=='') { alert('Please enter page title.'); $("#page-name").focus(); return false; }

		var pagedesc =$("#page-description").val();
		var pagecategory =$("#page-category").val();
		
		if(pagecategory  =='') { alert('Please select page category.'); $("#page-category").focus(); return false; }

		var url="<?php echo WP_PLUGIN_URL; ?>/shepleywood_team/includes/ajax_team_pages.php?action=addnew&page="+page+"&pagedesc="+pagedesc+"&pagecategory="+pagecategory;
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

    $('#delete_pages').click(function(){

		var action=$('#bulkaction').val();	

		if(action=='-1')
        {

		alert('Please select action.'); exit;						

		}

		var ids = [];

		$(':checkbox:checked').each(function(i){

		  ids[i] = $(this).val();

		}); 
        if(ids == "") { alert('Please select categories.'); return false; } 
		var url="<?php echo WP_PLUGIN_URL; ?>/shepleywood_team/includes/ajax_team_pages.php?action="+action+"&ids="+ids;
         $('#ajax_call_bulk').css('display','block'); //Show Loader

		$.ajax({

             type: "POST",

             url:url, 

             async: false,

             data: {},
			 
			  dataType:'json',

             success:function(result){ 

                $('#ajax_call_bulk').css('display','none'); //Hide Loader
				if(result.status == "success")
				  window.location.href = result.redirect;
				else
				  window.location.href = result.redirect; //Error Redirect

			}}); 

			      

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
 <h2>Manage Team Pages</h2>
    <form action="admin.php?page=shepley_team_pages&action=search" method="post">
	<p class="search-box">
	<label for="tag-search-input" class="screen-reader-text">Search Page:</label>
	<input type="search" name="search_page_input" value="<?php echo $_REQUEST['search_page_input']; ?>" id="search_page_input">
	<input type="submit" value="Search Pages" class="button" id="search-page" name="search-page">
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
		<input type="submit" value="Apply" class="button-secondary action" id="delete_pages" name="delete_pages">
        <span id="ajax_call_bulk" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/shepleywood_team/images/wpspin_light.gif"/></span>
		</div>
		
		<!--count Regions-->
		<div class="tablenav-pages one-page"><span class="displaying-num"><?php echo count($this->pages); ?> <?php echo count($this->pages) > 1 ? 'items' : 'item';  ?></span>
		</div>
		<br class="clear">
	</div>
<table cellspacing="0" class="wp-list-table widefat fixed tags">
	<thead>
	<tr>
		<th style="width:5%;" class="manage-column column-cb check-column" id="cb" scope="col">
		<input type="checkbox" value=" "></th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Page Title</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Description</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col" align="center">
		<span>Page Category</span>
		<span class="sorting-indicator"></span>
		</th>
    </tr>
	</thead>

	<tfoot>
	<tr>
		<th style="width:5%;" class="manage-column column-cb check-column" id="cb" scope="col">
		<input type="checkbox" value=" "></th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Page Title</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Description</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col" align="center">
		<span>Page Category</span>
		<span class="sorting-indicator"></span>
		</th>
    </tr>
	</tfoot>

	<tbody class="list:tag" id="the-list">
		<?php if(count($this->pages)){
		foreach($this->pages as $page) { ?>
		<tr class="alternate" id="tag-1">
		<th class="check-column" scope="row">
	    <input type="checkbox" value="<?php echo $page->id; ?>" name="page_id;" id="page_id">     
		</th>
		<td class="name column-name">
		<strong>
		<a title="<?php echo $page->title; ?>" href="admin.php?page=shepley_team_pages&action=edit&pageid=<?php echo $page->id; ?>" class="row-title">
		<?php echo $page->title; ?>
		</a>
		</strong>
		<div class="row-actions">

			<span class="edit">

			<a title="Edit this item" href="admin.php?page=shepley_team_pages&action=edit&pageid=<?php echo $page->id; ?>">Edit</a> | </span>

			<span class="trash">

			<a href="admin.php?page=shepley_team_pages&action=delete&pageid=<?php echo $page->id; ?>" onclick="return check_confirm();" title="Move this item to the Trash" class="submitdelete">

			Trash</a>
              | 
			</span>
            <span class="edit">
                <a title="View this page" target="_blank" href="<?php echo get_permalink($page->page_id); ?>">View</a>
            </span>

			</div>
		</td>
		<td class="slug column-slug">
		<?php echo $page->descr; ?>
		</td>
		<td class="description column-description" align="center">
		  <?php  echo $page->category_name; ?>
		</td>
		</tr>		
		<?php } 
		} else { 
		 ?>
		 <tr>
		<td colspan="4" align="center" style="" class="manage-column column-title" id="title" scope="col" >
			<p style="height:20px;">No Page Found.</p>
			
		</td>
		</tr>
		 <?php }?>
		</tbody>
</table>
	<div class="tablenav bottom">

		
	</div>

<br class="clear">



</div>
</div><!-- /col-right -->

<div id="col-left">
<div class="col-wrap">


<div class="form-wrap">
<h3>Add New Page</h3>
<div class="form-field form-required">
	<label for="tag-name">Page Title</label>
	<input type="text" aria-required="true" size="40" value="" id="page-name" name="page-name">

	<p>Enter the page title.</p>
</div>

<div class="form-field">
	<label for="tag-description">Description</label>
	<textarea cols="40" rows="5" id="page-description" name="page-description"></textarea>
	<p>Enter the page description.(optional)</p>
</div>
<div class="form-field form-required">
	<label for="tag-name">Page Category</label>
    <select name="page-category" id="page-category">
    <option value="">--Select Category--</option>
    <?php if(count($this->categories) > 0) : ?>
      <?php foreach($this->categories as $category) : ?>
         <option value="<?php echo $category->id; ?>"><?php echo $category->name;  ?></option>
      <?php endforeach; ?>
    <?php endif; ?>
    </select>
    <p>Select any page ctaegory.</p>
</div>
<p class="submit">
  <input type="submit" value="Add New Page" class="button" id="add_page" name="add_page">
  <span id="ajax_call" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/shepleywood_team/images/wpspin_light.gif"/></span>
</p>
</div>

</div>
</div><!-- /col-left -->

</div>
</div>