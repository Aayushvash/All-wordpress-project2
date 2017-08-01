<?php
$contracts=visual_get_contracts();
if($contracts==NULL)
{
	echo "<br />";
	echo __visual('cursusplanning_no_contracts','Er zijn geen contracten bekend voor deze gebruiker');
	return;
}
//echo "<pre>".json_encode($contracts,128)."</pre>";
echo "
 <strong>Legenda:</strong>
 <ul style='list-style:none;'>
  <li><div class='colorCircle' style='background-color:#b4f000'></div><span>U hoeft nog geen actie te ondernemen.</span></li>
  <li><div class='colorCircle' style='background-color:#ff8c00'></div><span>U heeft nog maximaal ".get_option('visual_cursusplanning_contract_days',30)." dagen om een cursus te plannen.</span></li>
  <li><div class='colorCircle' style='background-color:#FF0000'></div><span>Het contract is reeds verlopen.</span></li>
 </ul>
<div class='json'></div>
 ";

foreach($contracts as $key=>$data)
{
	if($key=='ONGEPLAND')
	{
		echo __visual('cursusplanning_replan_title',"<p>Deze cursisten moeten opnieuw gepland gaan worden voor een cursus.</p>");
	}
	else
	{
		echo __visual('cursusplanning_planned_title',"<p>Deze cursisten zijn succesvol gepland voor een cursus.</p>");
	}
	if(count($data)==0)
	{
		echo "<hr />";
		continue;
	}
	echo "<table class='vs_pretty'>";
	
	foreach($data as $row)
	{
		$vD=$row['VERVALDATUM'];
		$risc=strtotime(date('d-m-Y',strtotime(date('d-m-Y',$vD).' - '.get_option('visual_cursusplanning_contract_days',30).' days')));
		$color='b4f000';
		if(time()>$vD)
		{
			$color="FF0000";
		}
		elseif(time()>$risc)
		{
			$color="ff8c00";
		}
		echo "<tr>
			   <td>
				<div class='colorCircle' style='background-color:#".$color."'></div><span class='small'>".date('d-m-Y',$row['VERVALDATUM'])."</span>
			   </td>
			   <td>
				<span class='big'>".$row['ACTIVITEIT']['OMSCHRIJVING']."</span>
				<div class='hidden vs_info_popover'>
				 <div class='vs_info_popover_content'>
				  <p>".$row['ACTIVITEIT']['WEBNOTITIE']."</p>
				 </div>
				</div>
			   </td>
			   <td class='alignRight buttons'>
				<button class='openInfo'>".__visual('cursusplanning_button_open_str',"Openen")."</button>
			   </td>
			  </tr>";
		echo "<tr class='hidden'>
			   <td>";
		if($key=='ONGEPLAND')
		{
			if(is_array($row['ACTIVITEIT']['OPTIES']) && count($row['ACTIVITEIT']['OPTIES'])>0)
			{
				$select = "<select name='plnkid'>";
				$act=$row['ACTIVITEIT'];
				unset($act['OPTIES']);
				$count=0;
				foreach($row['ACTIVITEIT']['OPTIES'] as $planning)
				{
					$plaatsen_str="plaatsen";
					if($planning['VRIJ']==1)
					{
						$plaatsen_str="plaats";
					}
					$vrij_str="";
					if($planning['RID']>0)
					{
						$vrij_str="vrij:";
						$plaatsen_str.=" / vrijgepland";
					}
					$select.= "<option value='".$vrij_str."".$planning['PLNKID']."'>".date('d-m-Y',$planning['STARTDATUM'])." (".$planning['VRIJ']." vrije ".$plaatsen_str.")</option>";
					$count++;
				}
				$select.="</select>";
				if($count>0)
				{
					echo "<form class='to_wizard'>";
					echo __visual("cursusplanning_plan_on_following_date","<p>U kunt de cursisten opnieuw plannen op de volgende data:</p>");
					echo $select;
					$cursist_row=array();
					foreach($row['CONTRACTEN'] as $cursist)
					{
						$cursist_row[]=$cursist['RID'];
					}
					echo "<input type='hidden' name='cursisten' value='".implode(',',$cursist_row)."' />";
					echo "<input type='hidden' name='actcode' value='".$act['ACTCODE']."' />";
					echo "<br /><input type='submit' name='inplannen' value='Inplannen' />";
					echo "</form>";
				}
			}
			else
			{
				echo __visual('cursusplanning_no_followup_options',"<p>Er zijn geen nieuwe datums gepland voor deze cursus. Neem contact met ons op voor de mogelijkheden.</p>");
			}
		}
		else
		{
			echo __visual('cursusplanning_already_planned',"<p>Deze cursisten staan ingepland voor een cursus.</p>");
		}
		echo "</td>
			  <td class='topAlign' colspan='2'>";
			  echo "
			   <table width='100%'>";
		foreach($row['CONTRACTEN'] as $cursist)
		{
			echo "<tr>
			 <td>";
			echo visual_student_name_string($cursist['RELATIE']);
			/*
			echo $cursist['RELATIE']['NAAM'];
			if($cursist['RELATIE']['GEBOORTEDATUM']<>0)
			{
				echo " (".date('d-m-Y',$cursist['RELATIE']['GEBOORTEDATUM']).")";
			}*/
			echo "</td>";
			echo "<td class='buttons alignRight'>";
			/*
			if($wijzigenTot<=$dagenTotCursus)
			{
				echo "<a href='delete' class='cursistOption' id='".json_encode(array('PLNKID'=>$planning['PLNKID'],'CURSIST'=>$cursist))."'><img src='".$relLocation."templates/img/delete.png' /></a>";
			}*/
			echo "</td></tr>";
		}	   
		echo " </table>
			  </td>
			 </tr>";
	}
	echo "</table>";
}
?>