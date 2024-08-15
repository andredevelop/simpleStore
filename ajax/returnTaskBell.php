<?php 
	include('../config.php');

	$user = $_SESSION['email'];

	$month = mb_substr($_POST['dataClick'],3,2);
	$year = mb_substr($_POST['dataClick'],6,10);

	if($month > 12){
		$month = 1;
	}
	if($month < 1){
		$month = 12;
	}

	$daysNum = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$dayIniMonth = date('N',strtotime("$year/$month/01"));
	
	$toDay = date('d',time());

	$toDay = "$toDay/$month/$year";
?>
<tr class="titleTab bgGray textWhite">
	<td>D</td>
	<td>S</td>
	<td>T</td>
	<td>Q</td>
	<td>Q</td>
	<td>S</td>
	<td>S</td>
</tr>

<?php 
	$n = 1;
	$z = 0;
	$daysNum+=$dayIniMonth;
	while ($n <= $daysNum){
		if($dayIniMonth == 7 && $z != $dayIniMonth){
			$z = 7;
			$n = 8;
		}

		if($n % 7 == 1){
			echo '<tr>'	;
		}

		if($z >= $dayIniMonth){
			$day = $n - $dayIniMonth;
			if($day < 10){
				$day = str_pad($day, strlen($day)+1, "0", STR_PAD_LEFT);
			}
			$current = "$day/$month/$year";
			$dataClick = $_POST['dataClick'];
			if($current == $dataClick){
				$binds = array($user,$current);
				$activeBell = Crud::simpleSelectAll('*','tb_task','WHERE user_name = ? AND date = ?',$binds);
				if(!empty($activeBell)){
					echo '<td day='.$current.' class="active-day"><i class="fa-solid fa-bell"><p>'.count($activeBell).'</p></i>'.$day.'</td>';
				}else{
					echo '<td day='.$current.' class="active-day">'.$day.'</td>';
				}
			}else{
				$binds = array($user,$current);
				$bell = Crud::simpleSelectAll('*','tb_task','WHERE user_name = ? AND date = ?',$binds);
				if(!empty($bell)){
					echo "<td day=\"$current\"><i class='fa-solid fa-bell'><p>".count($bell)."</p></i>$day</td>";
				}else{
					echo "<td day=\"$current\">$day</td>";
				}
			}
		}else{
			echo "<td></td>";
			$z++;
		}
		if($n % 7 == 0){
			echo '</tr>';
		}
		$n++;
	}
?>
