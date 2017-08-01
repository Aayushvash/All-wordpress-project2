

<div class="commentdetails"><ul>
<?php $sql="SELECT * FROM `".$table_prefix."bv_comment` WHERE BoatID=$id and status='A'";
	  $result=mysql_query($sql);
	  while($row=mysql_fetch_array($result))
	  {
	  echo '<li>';
	  echo 'Name:&nbsp;&nbsp;&nbsp;'.$row['name'].'<br>';
	  echo 'Comment:&nbsp;&nbsp;&nbsp;'.$row['comment'].'<br>';
	  echo '</li>';
	  }	
?></ul>
</div>

<div id="commentBox">
<?php 
$msg='';
if($_POST['btnSubmit']){
if(isset($_POST['cname']) && $_POST['cname']!='')
{$cName=$_POST['cname'];}
else
{$msg="Please fill all fields";}

if(isset($_POST['cemail']) && $_POST['cemail']!='')
{$cEmail=$_POST['cemail'];}
else
{$msg="Please fill all fields";}

if(isset($_POST['ccomment']) && $_POST['ccomment']!='')
{$cComment=$_POST['ccomment'];}
else
{$msg="Please fill all fields";}

if(isset($_POST['cboatid']) && $_POST['cboatid']!='')
{$cBoatID=$_POST['cboatid'];}
else
{$msg="Please fill all fields";}

if($cName!='' && $cEmail!='' && $cComment!='' && $cBoatID!='')
{
$cquery="INSERT INTO `".$table_prefix."bv_comment`(`name`,`email`,`comment`, `BoatID`, `status`) VALUES ('$cName','$cEmail','$cComment',$cBoatID,'P')";
@mysql_query($cquery); 
$msgSuccess='Thanks for your comment.';
}
if($msg!='')
{?>
<div><?php echo $msg;?></div>
<?php 
}
if(isset($msgSuccess) && $msgSuccess!='')
{?>
<div><?php echo $msgSuccess;?></div>
<?php 
}
}
?>
<form name="inventoryComment" method="post" action="">
<ul>
<li><label>Name:</label><input type="text" name="cname" value="" /></li>
<li><label>Email:</label><input type="text" name="cemail" value=""  /></li>
<li><label>Comment:</label><textarea name="ccomment"></textarea></li>
<li style="display:none;"><label>Captcha:</label><input type="text" name="cecap" value="" /><img src="images/cap.jpg" class="cap" alt="" style="background: #069; height: 25px; width: 80px;" /></li>
<input type="hidden" name="cboatid" value="<?php echo $id;?>" />
<li><label>&nbsp;&nbsp;</label><input type="submit" name="btnSubmit" value="Submit" class="submit" /></li>
</ul>
</form>
</div>
