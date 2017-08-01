<?php
$students=visual_get_students(false,false,false,array('NAAM','ASC'));
if(is_array($students))
{
	//DETAILS
	if(isset($_GET['id']))
	{
		$student=visual_find_rel_in($students,$_GET['id']);
		if($student!=false)
		{
			
			//RELATIE-VELDEN
			$fields=visual_load_student_input_fields(true,$student);
			echo "<div class='student_details'>";
			echo "<fieldset>";
			echo "<legend>".__visual('cursusplanning_edit_student_title',"Cursistgegevens")."</legend>";
			echo "<form method='post'>";
			echo "<table class='form-table'>";
			foreach($fields as $field_data)
			{
				echo "<tr>";
				echo "<th>".$field_data['label']."</th>";
				echo "<td>".$field_data['input']."</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<input type='hidden' name='id' value='".$student->ID."' />";
			echo "<input type='hidden' name='rid' value='".$student->data->visual_WEBUSER['RELATIE']['ID']."' />";
			echo visual_get_submit_button( __visual('cursusplanning_save_student_info_button_str',"Opslaan"), 'submit', 'save_student_info');
			echo "</form>";
			echo "</fieldset>";
			echo "</div>";
			
			//INGESCHREVEN-CURSUSSEN (toekomst)
			$future=visual_load_student_courses('future',$student);
			if(count($future)>0)
			{
				echo "<fieldset>";
				echo "<legend>".__visual('cursusplanning_student_future_title',"Toekomende cursussen")."</legend>";
				//visual_print($future);
				echo "<table class='vs_pretty'>";
				foreach($future as $row)
				{
					$dates=$row['PLANDATES'];
					echo "<tr>";
					echo "<td class='topAlign'>";
					echo "<h4>".$row['ACTIVITEIT']['OMSCHRIJVING']."</h4>";
					echo visual_edit_until_string($row['STARTDATUM']);
					echo "<br />";
					echo visual_un_apply_button($row,$student->data->visual_RID);
					echo "</td>";
					echo "<td>";
					foreach($dates as $date)
					{
						echo "<table>";
						echo "<tr>";
						echo "<th colspan='2'>".date('d-m-Y',$date['STARTDATUM'])."</th>";
						echo "</tr>";
						echo "<tr>
							   <td>Van: </td>
							   <td>".date('H:i',$date['STARTDATUM'])."</td>
							  </tr>
							  <tr>
							   <td>Tot: </td>
							   <td>".date('H:i',$date['EINDDATUM'])."</td>
							  </tr>";
						echo "</table>";
					}
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</fieldset>";
			}
			
			//CURSUSHISTORIE
			$history=visual_load_student_courses('history',$student);
			if(count($history)>0)
			{
				echo "<fieldset>";
				echo "<legend>".__visual('cursusplanning_student_history_title',"Cursushistorie")."</legend>";
				//visual_print($history);
				echo "<table class='vs_pretty'>";
				foreach($history as $row)
				{
					$dates=$row['PLANDATES'];
					echo "<tr>";
					echo "<td class='topAlign'>";
					echo "<h4>".$row['ACTIVITEIT']['OMSCHRIJVING']."</h4>";
					echo "</td>";
					echo "<td>";
					foreach($dates as $date)
					{
						echo "<table>";
						echo "<tr>";
						echo "<th colspan='2'>".date('d-m-Y',$date['STARTDATUM'])."</th>";
						echo "</tr>";
						echo "<tr>
							   <td>Van: </td>
							   <td>".date('H:i',$date['STARTDATUM'])."</td>
							  </tr>
							  <tr>
							   <td>Tot: </td>
							   <td>".date('H:i',$date['EINDDATUM'])."</td>
							  </tr>";
						echo "</table>";
					}
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</fieldset>";
			}
			
			//CONTRACTEN
			$contracts=visual_load_student_contracts($student);
			if((isset($contracts['GEPLAND']) && count($contracts['GEPLAND'])>0) || (isset($contracts['ONGEPLAND']) && count($contracts['ONGEPLAND'])>0))
			{
				echo "<fieldset>";
				echo "<legend>".__visual('cursusplanning_student_contracts_title',"Herhalingscontracten")."</legend>";
				foreach($contracts as $type=>$data)
				{			
					//visual_print($data);
					if(count($data)==0)
					{
						continue;
					}
					if($type=='ONGEPLAND')
					{
						echo __visual('cursusplanning_single_replan_title',"<h3>Contracten waarvoor geen actie vereist is</h3>");
					}
					else
					{
						echo __visual('cursusplanning_single_planned_title',"<h3>Contracten die verlopen</h3>");
					}
					echo "<table class='vs_pretty'>
					<tr>
					 <th>Cursus</th>
					 <th>Vervaldatum</th>
					</tr>";
					foreach($data as $contract)
					{
						echo "<tr>";
						echo "<td>".$contract['OMSCHRIJVING']."</td>";
						echo "<td>".date('d-m-Y',$contract['VERVALDATUM'])."</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				echo "</fieldset>";
			}
		}
		echo "<a href='".get_permalink()."'>".visual_get_submit_button( __visual('cursusplanning_close_student_info_button_str',"Terug naar overzicht"), 'button', 'close')."</a>";
	}
	else
	{
		//OVERZICHT
		echo "<fieldset>";
		echo "<legend>".__visual('cursusplanning_student_overview_title',"Overzicht")."</legend>";
		echo "<table class='vs_pretty'>";
		foreach($students as $user)
		{
			$student=$user->data->visual_WEBUSER['RELATIE'];
			echo "<tr>";
			echo " <td>".visual_student_name_string($student)." <sup>(<a href='mailto:".$student['EMAIL']."' target=_blank>".$student['EMAIL']."</a>)</sup></td>";
			echo " <td class='alignRight'><a href='".get_permalink()."?id=".$student['ID']."'>Openen</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</fieldset>";
	}
}
else
{
	echo __visual('cursusplanning_no_students',"<p>Er zijn geen cursisten van u bekend</p>");
}