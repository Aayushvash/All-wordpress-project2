<link href="../wp-content/plugins/boats inventory/css/biMainCss.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function goTo(page) {
	var url="admin.php";
	hu=window.location.search.substring(1);
	query=hu.replace(/pageNo=[0-9][0-9]/g,"");
	query=query.replace(/pageNo=[0-9]/g,"");
    url=url+"?pageNo="+page+"&"+query;
    url=url.replace(/&&/g,'&');
	document.location.href = url;
	return false;
}
</script>
<?php 
require("../wp-config.php");
$current_user = wp_get_current_user(); 
$uid=$current_user->ID;
/* ------------------- state csv upload------------------- */
$title='Boats Listing';
$results_per_page=12;
$thispage="admin.php?page=boatInventorySettings";

if($_GET['new'])
{
?>
<div id="emailTemplate">
<form name="frmeditstate" action="<?php echo $thispage;?>" method="post">
	<h2>Add API</h2>
	<p><label>Add API URI:</label>
	<input type="text" name="api" value="" />
	</p>
    <p><label>API Status:</label>
	<select name="status">
    <option value="1">Active</option>
    <option value="0">Inactive</option>
    </select>
	</p>
	<p><label>&nbsp;&nbsp;</label>
	<input class="btn" type="submit" name="btnAddApi" value="Save" />
	<input  style="width:100px" type="button" name="btnAddBack" value="Return Back" onclick="history.go(-1);" /></p>
</form>

</div>
<?php 
} 
else if ($_GET['edit'])
{
	$edit=$_GET["edit"];
	$rs_state11=mysql_query("SELECT *
	FROM ".$table_prefix."bv_pluginsettings where id='$edit'");
	$rs_state12=mysql_fetch_array($rs_state11);
?>
<div id="emailTemplate">
<form name="frmeditstate" action="<?php echo $thispage;?>" method="post">
	<h2>Edit API</h2>
	<p><label>Add API URI:</label>
	<input type="text" name="api" value="<?php echo $rs_state12['api'];?>" />
	</p>
    <p><label>API Status:</label>
	<select name="status">
    <option value="1" <?php if($rs_state12['status']==1){echo "selected=\"selected\"";}?>>Active</option>
    <option value="0" <?php if($rs_state12['status']==0){echo "selected=\"selected\"";}?>>Inactive</option>
    </select>
	</p>
	<p><label>&nbsp;&nbsp;</label>
	<input type="hidden" name="id" value="<?php echo $edit;?>"  />
    <input class="btn" type="submit" name="btnEditApi" value="Save" />
	<input  style="width:100px" type="button" name="btnEditBack" value="Return Back" onclick="history.go(-1);" /></p>
</form>

</div>
<?php }
else{
/* ------------------- state csv download ------------------- */
if(isset($_POST['btnAddApi']))
/* ------------------- state date inser sql ------------------- */
{

	@extract($_POST);
	mysql_query("INSERT INTO `".$table_prefix."bv_pluginsettings` (`api` ,`status`)
	VALUES ('$api', '$status')")
	 or die( "Insertion cantnot be successful");
	  $msg="Added Successfully";
	
}

if(isset($_POST['btnEditApi']))
/* ------------------- state date inser sql ------------------- */
{

	@extract($_POST);
	mysql_query("UPDATE ".$table_prefix."bv_pluginsettings SET
	`api` = '$api',
	`status` = '$status'  
	WHERE `id` ='$id'")
	 or die( "UPDATE cantnot be sucessful");
	 $msg="Updated Successfully";
	
}
/* ------------------- state date select sql ------------------- */
if(isset($_GET['del']))
/* ------------------- state date inser sql ------------------- */
{

	$del=($_GET['del']);
	mysql_query("Delete from ".$table_prefix."bv_pluginsettings where id='$del'") 
	or die("There is an error on deleting a  Event");
	$msg = "Deleted Successfully";
}

?>
<?php 
$sqly="select * from `".$table_prefix."bv_pluginsettings`";
?>

<div style="width:730px">
<h2><?php echo esc_html( $title ); ?></h2>
<form id="posts-filter" action="admin.php?page=car_registration_registered" method="post">
<div class="alignleft actions">
<select name="action">
<option value="" selected="selected"><?php _e('Bulk Actions'); ?></option>
<option value="delete"><?php _e('Delete'); ?></option>
</select>
<input type="submit" value="<?php esc_attr_e('Apply'); ?>" name="btnbulkaction" id="btnbulkaction" class="button-secondary action" />
<?php wp_nonce_field('bulk-users'); ?>
</div>
</form>
<form id="posts-filter" action="admin.php?page=car_registration_registered" method="post">
<div class="alignright actions">
<a href="<?php echo $thispage;?>&new=y"><input type="button" value="Add New" name="btnAddNew" id="btnAddNew" class="button-secondary action" /></a>
</div>

<br /><br />
<br class="clear" />
<?php 
$adjacents = 1;
$query = $sqly; 
$total_pages = mysql_num_rows(mysql_query($query));



@extract($_GET);
//echo $pagenav; exit;

/* Setup vars for query. */
$targetpage = $thispage;
 	//your file name  (the name of this file)
$limit = 10; 								//how many items to show per page
if(isset($_GET['pagenav'])){$pagenavnav = $_GET['pagenav'];}else{$pagenav=1;}

if($pagenav) 
{
		if(is_numeric($pagenav))
		{
			$start = ($pagenav - 1) * $limit; 		
		}
		else{
		$start = 0;	
		}
		}	//first item to display on this page
else
$start = 0;								//if no page var is given, set start to 0
/* Get data. */
$sql = "$sqly LIMIT $start, $limit";
$result = mysql_query($sql) or die(mysql_error());

/* Setup page vars for display. */
	if ($pagenav == 0) $pagenav = 1;					//if no pagenav var is given, default to 1.
	$prev = $pagenav - 1;							//previous pagenav is pagenav - 1
	$next = $pagenav + 1;							//next pagenav is pagenav + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";//ok tested
		//previous button
		if ($pagenav > 1) 
			$pagination.= "<a href=\"$targetpage&pagenav=$prev\">&lt;&lt;&nbsp;previous</a>";
		else
			$pagination.= "<span class=\"disabled\">&lt;&lt;&nbsp;previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $pagenav)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&pagenav=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($pagenav < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $pagenav)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&pagenav=$counter\">$counter</a>";					
				}
				
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&pagenav=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&pagenav=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $pagenav && $pagenav > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage&abc=$search&pagenav=1\">1</a>";
				$pagination.= "...";
				for ($counter = $pagenav - $adjacents; $counter <= $pagenav + $adjacents; $counter++)
				{
					if ($counter == $pagenav)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&pagenav=$counter\">$counter</a>";					
				}		$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&pagenav=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&pagenav=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage&pagenav=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&pagenav=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $pagenav)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&pagenav=$counter\">$counter</a>";					
				}
			}
		}
		if ($pagenav < $counter - 1) 
			$pagination.= "<a href=\"$targetpage&pagenav=$next\">next&nbsp;&gt;&gt;</a>";
		else
			$pagination.= "<span class=\"disabled\">next&nbsp;&gt;&gt;</span>";
		$pagination.= "</div>\n";		
	}?>
<?php 
while($rs_state2=mysql_fetch_array($result))
{
$rs_state3[]=$rs_state2;
}
?>
<div style="color:red"><b><?php echo $msg; ?></b></div>

<table cellspacing="0" class="widefat fixed">
<thead>
<tr class="thead">
	<th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"></th>
	<th style="" class="manage-column column-title" id="name" scope="col">Api No.</th>
	<th style="" class="manage-column column-title" id="name" scope="col">API Key</th>
	<th style="" class="manage-column column-title" id="subject" scope="col">Status</th>
    <th style="" class="manage-column column-title" id="subject" scope="col">Delete</th>
</tr>
</thead>

<tfoot>
</tfoot>

<tbody class="list:user">
<?php 
if(!empty($rs_state3)){
$i=1;
foreach($rs_state3 as $data){?>
	<tr class="alternate" id="user-1">
		<th class="check-column" scope="row">
		<input type="checkbox" value="<?php echo $data['id']; ?>" class="administrator" id="state" 
		name="car_registration['<?php echo $i;?>']">
		</th>
        <td class="username column-username">
        <?php echo $i;?>
        </td>
		<td class="username column-username">
			<strong><a href="<?php echo $thispage;?>&edit=<?php echo $data['id']; ?>">
			<?php echo $data['api']; ?></a></strong><br>
			<div class="row-actions">
			<span class="edit"><a href="<?php echo $thispage;?>&edit=<?php echo $data['id']; ?>">
			Edit</a>&nbsp;&nbsp;|</span>
			<span class="edit"><a href="<?php echo $thispage;?>&del=<?php echo $data['id']; ?>">
			Delete</a>&nbsp;&nbsp;</span>
			</div>
		</td>
		<td class="name"><?php if($data['status']==1){echo "<b>Active</b>";}else{echo "<b>Inactive</b>";} ?></td>
		<td class="name" style="cursor:pointer">
		<a href="<?php echo $thispage;?>&del=<?php echo $data['id']; ?>">
		<img src="images/no.png" alt="Delete" title="Delete"/></a>
		</td>
	</tr>
	
<?php $i++;}
}
else{
?>
<tr>
<td colspan="4" style="color:#FF0000">
No record found
</td>
</tr>
<?php } ?>
</tbody>
</table>
</form>
<div style="text-align:center">
	<?php echo $pagination?>
</div>
</div>
<?php }?>