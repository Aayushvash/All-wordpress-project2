<?php
$history=visual_get_course_history();
if(is_array($history))
{
	echo __visual('cursusplanning_history_intro',"<p>Hier onder ziet u uw inschrijvingen. U kunt deze wijzigen tot ".get_option('visual_cursusplanning_edit_until_days',30)." dagen van tevoren.</p>");
	echo "<table class='vs_pretty'>";
	$pastedHistoryLine=false;
	$pastedFutureLine=false;
	foreach($history as $planning)
	{
		$cursusDatum=$planning['STARTDATUM'];
		$wijzigenTot=get_option('visual_cursusplanning_edit_until_days',30);
		$vandaag=time();
		$datediff=$cursusDatum-$vandaag;
		$dagenTotCursus=floor($datediff/(60*60*24))+1;
		$uitersteOpgeefDatum=date('d-m-Y',strtotime(date('d-m-Y',$cursusDatum).' -'.$wijzigenTot.' days'));
		if($uitersteOpgeefDatum==date('d-m-Y'))
		{
			$uitersteOpgeefDatum='vandaag';
		}
		elseif($uitersteOpgeefDatum==date('d-m-Y',strtotime(date('d-m-Y').' +1 day')))
		{
			$uitersteOpgeefDatum='morgen';
		}
		if(($cursusDatum-time())<0 && $pastedHistoryLine==false)
		{
			if($pastedFutureLine==true)
			{
				echo "</table>";
			}
			echo __visual('cursusplanning_history_title',"<h3><center>Historie</center></h3>");
			if($pastedFutureLine==true)
			{
				echo "<table class='vs_pretty'>";
			}
			$pastedHistoryLine=true;
		}
		elseif(($cursusDatum-time())>=0 && $pastedFutureLine==false)
		{
			echo __visual('cursusplanning_future_title',"<h3><center>Toekomende cursussen</center></h3>");
			$pastedFutureLine=true;
		}
		echo "
		 <tr>
		  <td>
		   <span class='small'>
		   Van: ".date('d-m-Y H:i',$planning['STARTDATUM'])."<br />
		   Tot: ".date('d-m-Y H:i',$planning['EINDDATUM'])."
		   </span>
		  </td>
		  <td>
		   <span class='big'>".$planning['ACTIVITEIT']['OMSCHRIJVING']."</span>
		   <div class='hidden vs_info_popover'>
			<div class='vs_info_popover_content'>
			 <p>".$planning['ACTIVITEIT']['WEBNOTITIE']."</p>
			</div>
		   </div>
		  </td>
		  <td class='alignRight buttons'>
		   <button class='openInfo'>".__visual('cursusplanning_button_open_str',"Openen")."</button>
		  </td>
		 </tr>";
		echo "
		 <tr class='hidden'>
		  <td class='topAlign'>";
		echo "<p>&nbsp;</p>";
		echo "
		   <table>";
		foreach($planning['PLANDATES'] as $i=>$planRegel)
		{
			echo "<tr><td>";
			if($planRegel['OMSCHRIJVING']==NULL)
			{
				$planRegel['OMSCHRIJVING']="Dag ".($i+1);
			}
			echo "
			   <span class='small'>
			   <strong>".$planRegel['OMSCHRIJVING']."</strong><br />
			   Van: ".date('d-m-Y H:i',$planRegel['STARTDATUM'])."<br />
			   Tot: ".date('d-m-Y H:i',$planRegel['EINDDATUM'])."
			   </span>";
			echo "</td></tr>";
		}
		echo "
		   </table>
		  </td>
		  <td class='topAlign' colspan='2'>";
		echo '<p>';
		if($wijzigenTot>$dagenTotCursus)
		{
			echo __visual('cursusplanning_no_more_changes','U kan geen wijzigingen meer aanbrengen');
		}
		else
		{
			$dayStr='dagen';
			if($wijzigenTot==1)
			{
				$dayStr=substr($dayStr,0,-2);
			}
			echo __visual('cursusplanning_change_until_str',"U kunt wijzigingen aanbrengen tot ".$wijzigenTot." ".$dayStr." van tevoren (".$uitersteOpgeefDatum.").");
		}
		echo '</p>';
		echo "
		   <table width='100%'>";
		foreach($planning['CURSISTEN'] as $i=>$cursist)
		{
			echo "<tr>
			 <td>";
			echo visual_student_name_string($cursist['RELATIE']);
			//echo $cursist['RELATIE']['NAAM'];
			echo "</td>";
			echo "<td class='buttons alignRight'>";
			if($wijzigenTot<=$dagenTotCursus)
			{
				echo "<a href='delete' class='cursistOption' id='".json_encode(array('PLNKID'=>$planning['PLNKID'],'CURSIST'=>$cursist))."'><img src='".plugin_dir_url(__FILE__)."img/delete.png' /></a>";
			}
			echo "</td></tr>";
		}	   
		echo "
		   </table>";
		echo "
		  </td>
		 </tr>";
	}
	?>
	</table>
<?php
}
else
{
	echo __visual('cursusplanning_history_no_data',"<p>Er is geen cursushistorie van u bekend.</p>");
}
?>