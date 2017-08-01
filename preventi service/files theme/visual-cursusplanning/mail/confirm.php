<?php
$db_data=$data['db'];
$aanmelding=$data['aanmelding'];
$vandaag=date('d-m-Y H:i');
$html=__visual('cursusplanning_user_confirmation_begin',"<p>Beste ".$user->user_nicename.",<br />Op ".$vandaag." heeft u de volgende inschrijvingen geplaatst:</p>",$user);
$html.=__visual('cursusplanning_user_confirmation_course_data',"
<table>
 <tr>
  <td>
   <strong>Cursus</strong>
  </td>
  <td>
   ".$aanmelding['ACTIVITEIT']['OMSCHRIJVING']."
  </td>
 </tr>
 <tr>
  <td>
   <strong>Aantal deelnemers</strong>
  </td>
  <td>
   ".$aanmelding['AANTALDEELNEMERS']."
  </td>
 </tr>
</table>",$data);
$html.="<hr />";
if(isset($aanmelding['PLANKOP']['PLANDATES']))
{
	$html.= "
	<p>De cursus zal bestaan uit de volgende onderdelen,</p>
	<table>
	<tr>
	<th>Onderdeel</th>
	<th>Datum</th>
	<th>Tijd</th>
	</tr>";
	foreach($aanmelding['PLANKOP']['PLANDATES'] as $i=>$day)
	{
		if(strlen($day['OMSCHRIJVING'])==0)
		{
			$day['OMSCHRIJVING']='Dag '.$i+1;
		}
		$html.= "<tr>";
		$html.= "<td>".$day['OMSCHRIJVING']."</td>";
		$html.= "<td>".date('d-m-Y',$day['STARTDATUM'])."</td>";
		$html.= "<td>".date('H:i',$day['STARTDATUM'])." - ".date('H:i',$day['EINDDATUM'])."</td>";
		$html.= "</tr>";
	}
	$html.= "</table>";
}
else
{
	$html.= "<p>De cursus zal worden gehouden op ".$aanmelding['PLANKOP']['STARTDATUM']." van ".$aanmelding['PLANKOP']['STARTDATUM_TIJD']." tot ".$aanmelding['PLANKOP']['EINDDATUM_TIJD'].".</p>";
}
if(isset($aanmelding['PLANKOP']['NAAM']) && strlen($aanmelding['PLANKOP']['NAAM'])>0)
{
	$html.="<p><strong>Locatiegegevens:</strong></p>";
	$html.="<table>
	 <tr>
	  <td>
	   ".$aanmelding['PLANKOP']['NAAM']."
	  </td>
	 </tr>
	 <tr>
	  <td>
	   ".$aanmelding['PLANKOP']['ADRES']."
	  </td>
	 </tr>
	 <tr>
	  <td>
	   ".$aanmelding['PLANKOP']['POSTCODE']."
	  </td>
	 </tr>
	 <tr>
	  <td>
	   ".$aanmelding['PLANKOP']['PLAATS']."
	  </td>
	 </tr>
	</table>
	<hr />";
}
if(isset($db_data['INSCHRIJVINGEN']) && isset($aanmelding['CURSISTEN']) && count($aanmelding['CURSISTEN'])>0)
{
	$nieuw=$aanmelding['CURSISTEN'];
	$bestaand_data=$db_data['INSCHRIJVINGEN'];
	//$html.=json_encode(array('nieuw'=>$aanmelding['CURSISTEN'],'bestaand'=>$db_data['INSCHRIJVINGEN']));
	$bestaand=array();
	foreach($bestaand_data as $key=>$inschrijving)
	{
		$bestaand[]=$inschrijving['RELATIE'];
	}
	foreach($bestaand as $key=>$inschrijving)
	{
		foreach($nieuw as $no=>$rel)
		{
			if(!isset($rel['EMAIL']))
			{
				continue;
			}
			if($rel['EMAIL']==$inschrijving['EMAIL'])
			{
				$nieuw[$no]=array_merge($rel,$inschrijving);
				unset($bestaand[$key]);
				break;
			}
		}
	}
	if(count($nieuw)>0)
	{
		$arr=array($nieuw,$bestaand);
		foreach($arr as $no=>$cursisten)
		{
			if($no==0)
			{
				$html.="<p><strong>Nieuwe cursisten:</strong></p>";
			}
			else
			{
				if(count($cursisten)==0)
				{
					break;
				}
				$html.="<p><strong>Deze cursisten waren al ingeschreven:</strong></p>";
			}
			$field_data=visual_get_student_fields();
			
			$fields=$field_data['default'];
			if(isset($field_data[$aanmelding['ACTIVITEIT']['ACTCODE']]))
			{
				$fields=$field_data[$aanmelding['ACTIVITEIT']['ACTCODE']];
			}
			$html.="<table><tr><td>";
			foreach($cursisten as $cursist)
			{
				$html.= "<table>";
				foreach($fields as $key=>$value)
				{
					if(!isset($cursist[$value['field']]))
					{
						$cursist[$value['field']]="-";
					}
					$v=$cursist[$value['field']];
					if($value['type']=='date' && is_numeric($v))
					{
						$v=date('d-m-Y',$v);
					}
					elseif(isset($value['options']) && count($value['options'])>0 && isset($value['options'][$v]))
					{
						$v=$value['options'][$v];
					}
					$html.= "<tr>";
					$html.= "<td>".$value['caption']."</td>";
					$html.= "<td>".$v."</td>";
					$html.= "</tr>";
				}
				$html.= "</table>";
			}
			$html.="</td></tr></table>";
		}
		
	}
}
$html.=__visual('cursusplanning_user_confirmation_footer','<hr />
<p>
Wij danken u voor uw vertrouwen in ons,<br /><br />
'.get_option( 'blogname' ).'
</p>');

echo $html;
?>