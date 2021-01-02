

<?php
	require_once "decision.php";
	// require_once "config_database.php";
	//list file extenion here
	$extension = array('html','mhtml','htm');

	
	
	//create file handling here
	$file = 'Calender_SIAK.ics';
	$handle = fopen($file,'w') or die('Cannot open file: '.$file);
	fwrite ($handle,	'BEGIN:VCALENDAR'."\n".
						'VERSION:2.0'."\n".
						'METHOD:PUBLISH'."\n".
						'X-WR-CALNAME:SIAK'."\n".
						'X-WR-TIMEZONE:Asia/Jakarta'."\n".
						'BEGIN:VTIMEZONE'."\n".
						'TZID:Indian/Christmas'."\n".
						'X-LIC-LOCATION:Indian/Christmas'."\n".
						'BEGIN:STANDARD'."\n".
						'TZOFFSETFROM:+0700'."\n".
						'TZOFFSETTO:+0700'."\n".
						'TZNAME:+07'."\n".
						'DTSTART:19700101T000000'."\n".
						'END:STANDARD'."\n".
						'END:VTIMEZONE'."\n"
			);
	
		
	//upload form here
	
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES['jadwalsiak']['name']);
	$uploaded = $_FILES['jadwalsiak']['tmp_name'];

	//error handling
	if (@file_get_contents($uploaded) == NULL)
	{
		echo '<script language="javascript">';
		echo 'alert("Please insert your file");';
		echo 'window.location="home.html";';
		echo '</script>';
		exit();
	
	}
	
	
	$file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
	$content = file_get_contents($uploaded);

	
	
	if(!in_array($file_extension, $extension))		//invalid format
	{
		echo '<script language="javascript">';
		echo 'alert("Invalid File Format")';
		echo '</script>';
		include_once ('home.html');
		exit();
	
	}
	else		//valid format 
	{
		if(strpos($content, '<div id="logo"><img alt="makara"') !== false)		//check if the HTML content is SIAK or not
		{
			if(strpos($content, 'title="Ganti Role">Mahasiswa') !== false)
			{
				//HTML explode here
				$first = explode('<p class="hour" style="text-align:center;height:30px;color:#888;">17.30</p>', $content);
				$second = explode('<td style="width: 0;"></td>', $first[1]);
				
				//initiate DOM documents here
				$dom = new DOMDocument();
				
				@$dom->loadHTML($second[0]);
				
				$dom->preserveWhiteSpace = false;
				
				//get user name
				$user_name = $_POST['e_name'];
				
				
				//extract NPM here
				//explode HTML get the important part
				$get_npm_step_1 = explode('<div id="ti_m1">', $content);
				$get_npm_step_2 = explode('<div class="tab">', $get_npm_step_1[1]);
				
				//initiate DOM documents here
				$dom_npm = new DOMDocument();
				
				@$dom_npm->loadHTML($get_npm_step_2[0]);
				
				$dom_npm->preserveWhiteSpace = false;
				
				//parse for NPM here
				$get_npm_step_3 = $dom_npm->getElementsByTagName('h3');
				$npm_string = $get_npm_step_3->item(0)->nodeValue;
				$stop_nama = strpos($npm_string, ",");
				$i_npm;	//variable iterasi untuk mengambil NPM & Nama
				$npm_final = "";	//inisiasi variable NPM
				$nama_mahasiswa = ""; //inisiasi variable nama
				for ($i_npm = 1; $i_npm < 11; $i_npm++)
				{
					$npm_final = $npm_final.$npm_string[$i_npm];
				}
				for ($i_npm = 13; $i_npm < $stop_nama; $i_npm++)
				{
					$nama_mahasiswa = $nama_mahasiswa.$npm_string[$i_npm];
				}
				
				/*
				//check already existing user
				$already_exist = 0;
				$query_check_already_exist = "SELECT COUNT(1) FROM user_list WHERE id = '$npm_final'";
				$query_check_execute = pg_query($query_check_already_exist);
				$row_check = pg_fetch_row($query_check_execute);
				if($row_check[0] >= 1)
				{
					$already_exist = 1;
				}
				
				//QUERY KE TABLE USER_LIST
				if($already_exist == 0)
				{
					$query_user_list = "INSERT INTO user_list VALUES ('$nama_mahasiswa', '$npm_final', '$user_name@ui.ac.id')";
					pg_query($query_user_list);
				}
				*/
				
				//Parsing everything here
				$hari = $dom->getElementsByTagName('td');
				$inc_hari = 0;
				foreach ($hari as $h)
				{
					
					$matkul = $h->getElementsByTagName('p');
					$jam = $h->getElementsByTagName('h3');
				//	$temp = $matkul->item(0)->nodeValue;
					$inc = 0;
					foreach ($matkul as $m)
					{
						if ($inc_hari == 0)
						{
							$query_hari = "Senin";
							echo '<strong>Senin</strong>'.'<br/>';
							$string = $matkul->item($inc)->nodeValue;
							$final_string = explode ('Ruang:', $string);
							$ruang = str_replace(' ', '', $final_string[1]);
							//echo 'Mata Kuliah: '.$final_string[0].'<br/>';
							//echo 'Ruang: '.$final_string[1].'<br/>';
							$jam_temp = $jam->item($inc)->nodeValue;
							$f_jam = explode(' - ', $jam_temp);
							$mulai = explode('.', $f_jam[0]);
							$selesai = explode('.', $f_jam[1]);
							$mulai = $mulai[0].$mulai[1];
							$selesai = $selesai[0].$selesai[1];
							echo 'Mulai: '.$mulai.'<br/>';
							echo 'Selesai: '.$selesai.'<br/><br/>';
							
							fwrite($handle,	'BEGIN:VEVENT'."\n".
											'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
											'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n".
											'RRULE:FREQ=WEEKLY;BYDAY=MO'."\n".
											'CREATED:19000101T120000Z'."\n".
											'DESCRIPTION:'."\n".
											'LOCATION:'.$ruang."\n".
											'SEQUENCE:0'."\n".
											'STATUS:CONFIRMED'."\n".
											'SUMMARY:'.$final_string[0]."\n".
											'BEGIN:VALARM'."\n".
											'ACTION:DISPLAY'."\n".
											'DESCRIPTION:This is an event reminder'."\n".
											'TRIGGER:-P0DT0H30M0S'."\n".
											'END:VALARM'."\n".
											'END:VEVENT'."\n"
									);		
							$inc = $inc + 1;
						}
						elseif ($inc_hari == 1)
						{
							$query_hari = "Selasa";
							echo '<strong>Selasa</strong>'.'<br/>';
							$string = $matkul->item($inc)->nodeValue;
							$final_string = explode ('Ruang:', $string);
							$ruang = str_replace(' ', '', $final_string[1]);
							//echo 'Mata Kuliah: '.$final_string[0].'<br/>';
							//echo 'Ruang: '.$final_string[1].'<br/>';
							$jam_temp = $jam->item($inc)->nodeValue;
							$f_jam = explode(' - ', $jam_temp);
							$mulai = explode('.', $f_jam[0]);
							$selesai = explode('.', $f_jam[1]);
							$mulai = $mulai[0].$mulai[1];
							$selesai = $selesai[0].$selesai[1];
							//echo 'Mulai: '.$mulai.'<br/>';
							//echo 'Selesai: '.$selesai.'<br/><br/>';
							
							fwrite($handle,	'BEGIN:VEVENT'."\n".
											'DTSTART;TZID=Indian/Christmas:20191029T'.$mulai.'00'."\n".
											'DTEND;TZID=Indian/Christmas:20191029T'.$selesai.'00'."\n".
											'RRULE:FREQ=WEEKLY;BYDAY=TU'."\n".
											'CREATED:19000101T120000Z'."\n".
											'DESCRIPTION:'."\n".
											'LOCATION:'.$ruang."\n".
											'SEQUENCE:0'."\n".
											'STATUS:CONFIRMED'."\n".
											'SUMMARY:'.$final_string[0]."\n".
											'BEGIN:VALARM'."\n".
											'ACTION:DISPLAY'."\n".
											'DESCRIPTION:This is an event reminder'."\n".
											'TRIGGER:-P0DT0H30M0S'."\n".
											'END:VALARM'."\n".
											'END:VEVENT'."\n"
									);		
									
							$inc = $inc + 1;
						}
						elseif ($inc_hari == 2)
						{
							$query_hari = "Rabu";
							echo '<strong>Rabu</strong>'.'<br/>';
							$string = $matkul->item($inc)->nodeValue;
							$final_string = explode ('Ruang:', $string);
							$ruang = str_replace(' ', '', $final_string[1]);
							//echo 'Mata Kuliah: '.$final_string[0].'<br/>';
							//echo 'Ruang: '.$final_string[1].'<br/>';
							$jam_temp = $jam->item($inc)->nodeValue;
							$f_jam = explode(' - ', $jam_temp);
							$mulai = explode('.', $f_jam[0]);
							$selesai = explode('.', $f_jam[1]);
							$mulai = $mulai[0].$mulai[1];
							$selesai = $selesai[0].$selesai[1];
							//echo 'Mulai: '.$mulai.'<br/>';
							//echo 'Selesai: '.$selesai.'<br/><br/>';
							
							fwrite($handle,	'BEGIN:VEVENT'."\n".
											'DTSTART;TZID=Indian/Christmas:20191030T'.$mulai.'00'."\n".
											'DTEND;TZID=Indian/Christmas:20191030T'.$selesai.'00'."\n".
											'RRULE:FREQ=WEEKLY;BYDAY=WE'."\n".
											'CREATED:19000101T120000Z'."\n".
											'DESCRIPTION:'."\n".
											'LOCATION:'.$ruang."\n".
											'SEQUENCE:0'."\n".
											'STATUS:CONFIRMED'."\n".
											'SUMMARY:'.$final_string[0]."\n".
											'BEGIN:VALARM'."\n".
											'ACTION:DISPLAY'."\n".
											'DESCRIPTION:This is an event reminder'."\n".
											'TRIGGER:-P0DT0H30M0S'."\n".
											'END:VALARM'."\n".
											'END:VEVENT'."\n"
									);		
							
							$inc = $inc + 1;
						}
						elseif ($inc_hari == 3)
						{
							$query_hari = "Kamis";
							echo '<strong>Kamis</strong>'.'<br/>';
							$string = $matkul->item($inc)->nodeValue;
							$final_string = explode ('Ruang:', $string);
							$ruang = str_replace(' ', '', $final_string[1]);
							//echo 'Mata Kuliah: '.$final_string[0].'<br/>';
							//echo 'Ruang: '.$final_string[1].'<br/>';
							$jam_temp = $jam->item($inc)->nodeValue;
							$f_jam = explode(' - ', $jam_temp);
							$mulai = explode('.', $f_jam[0]);
							$selesai = explode('.', $f_jam[1]);
							$mulai = $mulai[0].$mulai[1];
							$selesai = $selesai[0].$selesai[1];
							//echo 'Mulai: '.$mulai.'<br/>';
							//echo 'Selesai: '.$selesai.'<br/><br/>';
							
							fwrite($handle,	'BEGIN:VEVENT'."\n".
											'DTSTART;TZID=Indian/Christmas:20191031T'.$mulai.'00'."\n".
											'DTEND;TZID=Indian/Christmas:20191031T'.$selesai.'00'."\n".
											'RRULE:FREQ=WEEKLY;BYDAY=TH'."\n".
											'CREATED:19000101T120000Z'."\n".
											'DESCRIPTION:'."\n".
											'LOCATION:'.$ruang."\n".
											'SEQUENCE:0'."\n".
											'STATUS:CONFIRMED'."\n".
											'SUMMARY:'.$final_string[0]."\n".
											'BEGIN:VALARM'."\n".
											'ACTION:DISPLAY'."\n".
											'DESCRIPTION:This is an event reminder'."\n".
											'TRIGGER:-P0DT0H30M0S'."\n".
											'END:VALARM'."\n".
											'END:VEVENT'."\n"
									);		
							
							$inc = $inc + 1;
						}
						elseif ($inc_hari == 4)
						{
							$query_hari = "Jumat";
							echo '<strong>Jumat</strong>'.'<br/>';
							$string = $matkul->item($inc)->nodeValue;
							$final_string = explode ('Ruang:', $string);
							$ruang = str_replace(' ', '', $final_string[1]);
							//echo 'Mata Kuliah: '.$final_string[0].'<br/>';
							//echo 'Ruang: '.$final_string[1].'<br/>';
							$jam_temp = $jam->item($inc)->nodeValue;
							$f_jam = explode(' - ', $jam_temp);
							$mulai = explode('.', $f_jam[0]);
							$selesai = explode('.', $f_jam[1]);
							$mulai = $mulai[0].$mulai[1];
							$selesai = $selesai[0].$selesai[1];
							//echo 'Mulai: '.$mulai.'<br/>';
							//echo 'Selesai: '.$selesai.'<br/><br/>';
							
							fwrite($handle,	'BEGIN:VEVENT'."\n".
											'DTSTART;TZID=Indian/Christmas:20191101T'.$mulai.'00'."\n".
											'DTEND;TZID=Indian/Christmas:20191101T'.$selesai.'00'."\n".
											'RRULE:FREQ=WEEKLY;BYDAY=FR'."\n".
											'CREATED:19000101T120000Z'."\n".
											'DESCRIPTION:'."\n".
											'LOCATION:'.$ruang."\n".
											'SEQUENCE:0'."\n".
											'STATUS:CONFIRMED'."\n".
											'SUMMARY:'.$final_string[0]."\n".
											'BEGIN:VALARM'."\n".
											'ACTION:DISPLAY'."\n".
											'DESCRIPTION:This is an event reminder'."\n".
											'TRIGGER:-P0DT0H30M0S'."\n".
											'END:VALARM'."\n".
											'END:VEVENT'."\n"
									);		
							
							$inc = $inc + 1;
						}
						elseif ($inc_hari == 5)
						{
							$query_hari = "Sabtu";
							echo '<strong>Sabtu</strong>'.'<br/>';
							$string = $matkul->item($inc)->nodeValue;
							$final_string = explode ('Ruang:', $string);
							$ruang = str_replace(' ', '', $final_string[1]);
							echo 'Mata Kuliah: '.$final_string[0].'<br/>';
							echo 'Ruang: '.$final_string[1].'<br/>';
							$jam_temp = $jam->item($inc)->nodeValue;
							$f_jam = explode(' - ', $jam_temp);
							$mulai = explode('.', $f_jam[0]);
							$selesai = explode('.', $f_jam[1]);
							$mulai = $mulai[0].$mulai[1];
							$selesai = $selesai[0].$selesai[1];
							echo 'Mulai: '.$mulai.'<br/>';
							echo 'Selesai: '.$selesai.'<br/><br/>';
							
							fwrite($handle,	'BEGIN:VEVENT'."\n".
											'DTSTART;TZID=Indian/Christmas:20191102T'.$mulai.'00'."\n".
											'DTEND;TZID=Indian/Christmas:20191102T'.$selesai.'00'."\n".
											'RRULE:FREQ=WEEKLY;BYDAY=SA'."\n".
											'CREATED:19000101T120000Z'."\n".
											'DESCRIPTION:'."\n".
											'LOCATION:'.$ruang."\n".
											'SEQUENCE:0'."\n".
											'STATUS:CONFIRMED'."\n".
											'SUMMARY:'.$final_string[0]."\n".
											'BEGIN:VALARM'."\n".
											'ACTION:DISPLAY'."\n".
											'DESCRIPTION:This is an event reminder'."\n".
											'TRIGGER:-P0DT0H30M0S'."\n".
											'END:VALARM'."\n".
											'END:VEVENT'."\n"
									);		
								
							$inc = $inc + 1;
						}
						echo 'Mata Kuliah: '.$final_string[0].'</br>';
						echo 'Ruang: '.$ruang.'</br>';
						echo 'Waktu: '.$jam_temp.'</br></br>';
						
						//QUERY KE TABLE JADWAL
						// if($already_exist == 0)
						// {
						// 	$query_jadwal = "INSERT INTO jadwal VALUES ('$npm_final', '$query_hari', $mulai, $selesai, '$final_string[0]')";
						// 	pg_query($query_jadwal);
						// }
					}
					
						
					$inc_hari = $inc_hari + 1;
				}
				fwrite($handle,	'END:VCALENDAR');
				
				
			}
			else
			{	
				echo '<script language="javascript">';
				echo 'alert("Wrong SIAK page")';
				echo '</script>';
				include_once ('home.html');
				exit();
			}
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Wrong html content")';
			echo '</script>';
			include_once ('home.html');
			exit();
		}
	}

	if (file_exists($file)) 
		{
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}
	
	
?>

<html>
<body>
<a href="Calender_SIAK.ics">Download ICS here</a>
</body>
</html> 
