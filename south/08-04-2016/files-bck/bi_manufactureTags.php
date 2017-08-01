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
$thispage="admin.php?page=manufactureTags";

?>
<div style="width:500px; float:left;">
<?php 
/* ------------------- state date select sql ------------------- */
?>
<?php  
$Query = "SELECT DISTINCT(Make) FROM `".$table_prefix."bv_boatdetails` ORDER BY Make ";

$sqly=$Query;
?>

<div style="width:900px">
<h2><?php echo esc_html( $title ); ?></h2>

<form id="posts-filter" action="admin.php?page=car_registration_registered" method="post">
<?php 
$adjacents = 1;
$query = $sqly; 
$total_pages = mysql_num_rows(mysql_query($query));
@extract($_GET);
@extract($_POST);
//echo $pagenav; exit;

/* Setup vars for query. */
$targetpage = $thispage;
//your file name  (the name of this file)
$limit = 50; 								//how many items to show per page
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
<div style="color:green">Total: <b><?php echo @mysql_num_rows(@mysql_query($Query));	 ?></b></div>

<table cellspacing="0" class="widefat fixed">
<thead>
<tr class="thead">
	<th style="" class="manage-column column-cb check-column" id="cb" scope="col">#</th>
	<th style="width:100px" class="manage-column column-title" id="name" scope="col">Manufacture's Name</th>
	<th style="width:200px" class="manage-column column-title" id="name" scope="col">Shorttag (New Used)</th>
	<th style="" class="manage-column column-title" id="name" scope="col">New Inv. Shorttag</th>
	<th style="" class="manage-column column-title" id="name" scope="col">Used Inv. Shorttag</th>
	
	<!-- <th style="" class="manage-column column-title" id="subject" scope="col">Delete</th> -->
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
		<td><?php echo $i;?></td>
		<td class="username column-username">
		<strong><?php echo $data['Make'];?></strong>
		</td>
        <td>[biBoatsByManufactures id="<?php echo $data['Make'];?>"]</td>
		<td>[biBoatsByManufacturesNew id="<?php echo $data['Make'];?>"]</td>
		<td>[biBoatsByManufacturesUsed id="<?php echo $data['Make'];?>"]</td>
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
	<?php echo $pagination; ?>
</div>
</div>
</div>
