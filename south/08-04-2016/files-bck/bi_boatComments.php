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
<?php error_reporting(0);
require("../wp-config.php");
$current_user = wp_get_current_user(); 
$uid=$current_user->ID;
/* ------------------- state csv upload------------------- */
$title='Inventory Comment';
$thispage="admin.php?page=boatInventoryComment";
?>

<div style="width:90%">
<h2><?php echo esc_html( $title ); ?></h2>
<form id="posts-filter" action="admin.php?page=boatInventoryComment" method="post">
<?php
@extract($_GET);
@extract($_POST);
if(isset($_POST)){
$chka=$comments;
	$temp="";
	if(is_array($chka))
	{
	foreach($chka as $val)
	{
	$temp.="'".$val."',";
	}
	$temp=substr($temp,0,strlen($temp)-1);
	}
}	
if(isset($_POST['btnActive']))
{
mysql_query("update ".$table_prefix."bv_comment set status = 'A' where id in ($temp)") or die("There is an error on Updating Comments");	
$msg = "Update Sucessfully";
}
if(isset($_POST['btnDisapprove']))
{mysql_query("Delete from ".$table_prefix."bv_comment where id in ($temp)") or die("There is an error on deleting Comments");	
$msg = "Comments Deleted Sucessfully";} 
$Query = "SELECT * FROM `".$table_prefix."bv_comment` WHERE BoatID > 0";
$sqly=$Query;
$adjacents = 1;
$query = $sqly; 
$total_pages = mysql_num_rows(mysql_query($query));


$targetpage = $thispage;

//your file name  (the name of this file)
$limit = 25; 								//how many items to show per page
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
<div><input type="submit" name="btnActive" value="Selected Active" /> <input type="submit" name="btnDisapprove" value="Selected Disapprove"/></div>
<div class="clear"></div>
<table cellspacing="0" class="widefat fixed" border="1">
<thead>
<tr class="thead">
	<th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"></th>
	<th style="width:24%; padding-right:2px;" class="manage-column column-title"  scope="col">Make-Mode-Year</th>
	<th style="width:7%; padding-right:2px;" class="manage-column column-title"  scope="col">User Name</th>
	<th style="width:15%; padding-right:2px;" class="manage-column column-title"  scope="col">User Email</th>
	<th style="width:45%; padding-right:2px;" class="manage-column column-discription"  scope="col">Comment</th>
	<th style="width:6%; padding-right:2px;" class="manage-column column-title"  scope="col">Satus</th>
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
		name="comments['<?php echo $i;?>']">
		</th>
		<td><?php if($data['BoatID']!=''){ 
		$rs1=mysql_query("SELECT * FROM `".$table_prefix."bv_boatdetails` WHERE BoatID ='".$data['BoatID']."'");
		$rs2=mysql_fetch_array($rs1);
		echo $rs2['Make'].'-'.$rs2['Model'].'-'.$rs2['Year']; 
		}
		?></td>
		<td class="username column-username"><?php echo $data['name']; ?></td>
		<td class="username column-username"><?php echo $data['email']; ?></td>
		<td class="name"><?php echo $data['comment']; ?></td>
		<td class="name"><?php if($data['status']=='A'){echo '<b style="color:Green">Active</b>';}
		elseif($data['status']=='P'){echo '<b style="color:red">Pending</b>';}else{echo 'Undefine';} ?></td>
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
<div class="clear"></div>

</form>
<div style="text-align:center">
	<?php echo $pagination; ?>
</div>
</div>

