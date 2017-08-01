<script src="http://code.jquery.com/jquery-latest.js"></script>
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
<script type="text/javascript">
$(document).ready(function() { 

    $('#add_categoy').click(function(){

		var category =$("#category-name").val();

		if(category=='') { 
			alert('Please enter category name.'); 
			document.getElementById('category-name').focus();
			 exit;  }

		var categorydesc =$("#category-description").val();
		var categoryorder =$("#category-order").val();

		var url="<?php echo WP_PLUGIN_URL; ?>/employee-manager/includes/ajax_emp_categories.php?action=addnew&category="+category+"&categorydesc="+categorydesc+"&categoryorder="+categoryorder;
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

    $('#delete_category').click(function(){

		var action=$('#bulkaction').val();	

		if(action=='-1')
        {

		alert('Please select action.');
		 exit;						

		}

		var ids = [];

		$(':checkbox:checked').each(function(i){

		  ids[i] = $(this).val();

		}); 
        if(ids == "") { alert('Please select categories.'); return false; } 
		var url="<?php echo WP_PLUGIN_URL; ?>/employee-manager/includes/ajax_emp_categories.php?action="+action+"&ids="+ids;
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
 <h2>Manage Categories</h2>
    <form action="admin.php?page=employee_categories&action=search" method="post">
	<p class="search-box">
	<label for="tag-search-input" class="screen-reader-text">Search Regions:</label>
	<input type="search" name="search_category_input" value="<?php echo $_REQUEST['search_category_input']; ?>" id="search_category_input">
	<input type="submit" value="Search Category" class="button" id="search-category" name="search-category">
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
		<input type="submit" value="Apply" class="button-secondary action" id="delete_category" name="delete_category">
        <span id="ajax_call_bulk" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/employee-manager/images/wpspin_light.gif"/></span>
		</div>
		
		<!--count Regions-->
		<div class="tablenav-pages one-page"><span class="displaying-num"><?php echo count($this->categories); ?> <?php echo count($this->categories) > 1 ? 'items' : 'item';  ?></span>
		</div>
		<br class="clear">
	</div>
<table id="table-5" cellspacing="0" class="wp-list-table widefat fixed tags">
	<thead>
    
	<tr>
		<th style="width:5%;" class="manage-column column-cb check-column" id="cb" scope="col">
		<input type="checkbox" value=" "></th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Category Name</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Description</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col" align="center">
		<span>Order</span>
		<span class="sorting-indicator"></span>
		</th>
    </tr>
	</thead>

	<tfoot>
	<tr>
		<th style="width:5%;" class="manage-column column-cb check-column" id="cb" scope="col">
		<input type="checkbox" value=" "></th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Category Name</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col">
		<span>Description</span>
		<span class="sorting-indicator"></span>
		</th>
		<th style="width:30%;" class="manage-column column-name" id="name" scope="col" align="center">
		<span>Order</span>
		<span class="sorting-indicator"></span>
		</th>
    </tr>
	</tfoot>
     
	<tbody class="list:tag" id="the-list">
		<?php if(count($this->categories)){ $i=0;
		foreach($this->categories as $category) { $i++; ?>
		<tr class="alternate" id="table5-row-<?php echo $category->id; ?>">
		<th class="check-column" scope="row">
	    <input type="checkbox" value="<?php echo $category->id; ?>" name="category_id;" id="category_id"> 
        <input type="hidden" class="postorder" id="row-<?php echo $category->id; ?>" name="row-<?php echo $category->id; ?>" value="<?php echo $i;?>" />    
		</th>
		<td class="name column-name">
		<strong>
		<a title="<?php echo $region->name; ?>" href="admin.php?page=employee_categories&action=edit&catid=<?php echo $category->id; ?>" class="row-title">
		<?php echo $category->name; ?>
       </a>
		</strong>
		<div class="row-actions">

			<span class="edit">

			<a title="Edit this item" href="admin.php?page=employee_categories&action=edit&catid=<?php echo $category->id; ?>">Edit</a> | </span>

			<span class="trash">

			<a href="admin.php?page=employee_categories&action=delete&catid=<?php echo $category->id; ?>" onclick="return check_confirm();" title="Move this item to the Trash" class="submitdelete">

			Trash</a>

			</span>

			</div>
		</td>
		<td class="slug column-slug dragHandle">
		<?php echo $category->description; ?>
		</td>
		<td class="description column-description dragHandle" align="center">
		  <?php  echo $category->cat_order; ?>
		</td>
		</tr>		
		<?php } 
		} else { 
		 ?>
		 <tr>
		<td colspan="4" align="center" style="" class="manage-column column-title" id="title" scope="col" >
			<p style="height:20px;">No Category Found.</p>
			
		</td>
		</tr>
		 <?php }?>
		</tbody>
</table>
	<div class="tablenav bottom">

		
	</div>
    
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/employee-manager/js/prettify.js"></script>
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL;?>/employee-manager/js/jquery.tablednd.js"></script>
<script type="text/javascript">
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
					 
					var url="<?php echo WP_PLUGIN_URL; ?>/employee-manager/includes/ajax_emp_categories.php?action=updateorder&orderData="+orderData+"&postId="+postId;
					   
						$.ajax({
						type: "POST",
						url:url, 
						async: false,
						data: {},
						dataType:'json',
						success:function(result){  
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
</script>
    

<br class="clear">



</div>
</div><!-- /col-right -->

<div id="col-left">
<div class="col-wrap">


<div class="form-wrap">
<h3>Add New Categoy</h3>
<div class="form-field form-required">
	<label for="tag-name">Name</label>
	<input type="text" aria-required="true" size="40" value="" id="category-name" name="categoy-name">

	<p>Enter the Categoy name.</p>
</div>

<div class="form-field">
	<label for="tag-description">Description</label>
	<textarea cols="40" rows="5" id="category-description" name="category-description"></textarea>
	<p>Enter the Categoy description.(optional)</p>
</div>
<div class="form-field form-required">
	<label for="tag-name">Display Order</label>
	<input type="text" aria-required="true" size="20" value="10" id="category-order" name="categoy-order">
    <p>Enter the Categoy order.</p>
</div>
<p class="submit">
  <input type="submit" value="Add New Categoy" class="button" id="add_categoy" name="add_categoy">
  <span id="ajax_call" style="padding:5px;display:none;float:left;"><img src="<?php echo WP_PLUGIN_URL;?>/employee-manager/images/wpspin_light.gif"/></span>
</p>
</div>

</div>
</div><!-- /col-left -->

</div>
</div>

