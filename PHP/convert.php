<html>
<body>

<?php
	//list file extenion here
	$extension = array('html');

	
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
	$uploaded = $_FILES['jadwalsiak']['tmp_name'];
	$file_extension = pathinfo($uploaded, PATHINFO_EXTENSION);
	$content = file_get_contents($uploaded);
	
	
	if(!in_array($file_extension, $extension))
	{
		echo '<script language="javascript">';
		echo 'alert("Invalid File Format")';
		echo '</script>';
		include_once ('test.php');
	
	}
	else		//invalid format 
	{
	
		
		
	//HTML explode here
	$first = explode('<p class="hour" style="text-align:center;height:30px;color:#888;">18.30</p>', $content);
	$second = explode('<td style="width: 0;"></td>', $first[1]);
	
	//initiate DOM documents here
	$dom = new DOMDocument();
	
	@$dom->loadHTML($second[0]);
	
	$dom->preserveWhiteSpace = false;

						
	//Parsing here
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
				echo '<strong>Senin</strong>'.'<br/>';
				$string = $matkul->item($inc)->nodeValue;
				$final_string = explode ('Ruang:', $string);
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
								'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
								'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n".
								'RRULE:FREQ=WEEKLY;BYDAY=MO'."\n".
								'DESCRIPTION:'."\n".
								'LOCATION:'.$final_string[1]."\n".
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
				echo '<strong>Selasa</strong>'.'<br/>';
				$string = $matkul->item($inc)->nodeValue;
				$final_string = explode ('Ruang:', $string);
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
								'DTSTART;TZID=Indian/Christmas:20191029T'.$mulai.'00'."\n".
								'DTEND;TZID=Indian/Christmas:20191029T'.$selesai.'00'."\n".
								'RRULE:FREQ=WEEKLY;BYDAY=TU'."\n".
								'DESCRIPTION:'."\n".
								'LOCATION:'.$final_string[1]."\n".
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
				echo '<strong>Rabu</strong>'.'<br/>';
				$string = $matkul->item($inc)->nodeValue;
				$final_string = explode ('Ruang:', $string);
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
								'DTSTART;TZID=Indian/Christmas:20191030T'.$mulai.'00'."\n".
								'DTEND;TZID=Indian/Christmas:20191030T'.$selesai.'00'."\n".
								'RRULE:FREQ=WEEKLY;BYDAY=WE'."\n".
								'DESCRIPTION:'."\n".
								'LOCATION:'.$final_string[1]."\n".
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
				echo '<strong>Kamis</strong>'.'<br/>';
				$string = $matkul->item($inc)->nodeValue;
				$final_string = explode ('Ruang:', $string);
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
								'DTSTART;TZID=Indian/Christmas:20191031T'.$mulai.'00'."\n".
								'DTEND;TZID=Indian/Christmas:20191031T'.$selesai.'00'."\n".
								'RRULE:FREQ=WEEKLY;BYDAY=TH'."\n".
								'DESCRIPTION:'."\n".
								'LOCATION:'.$final_string[1]."\n".
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
				echo '<strong>Jumat</strong>'.'<br/>';
				$string = $matkul->item($inc)->nodeValue;
				$final_string = explode ('Ruang:', $string);
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
								'DTSTART;TZID=Indian/Christmas:20191101T'.$mulai.'00'."\n".
								'DTEND;TZID=Indian/Christmas:20191101T'.$selesai.'00'."\n".
								'RRULE:FREQ=WEEKLY;BYDAY=FR'."\n".
								'DESCRIPTION:'."\n".
								'LOCATION:'.$final_string[1]."\n".
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
				echo '<strong>Sabtu</strong>'.'<br/>';
				$string = $matkul->item($inc)->nodeValue;
				$final_string = explode ('Ruang:', $string);
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
								'DESCRIPTION:'."\n".
								'LOCATION:'.$final_string[1]."\n".
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
		}
		$inc_hari = $inc_hari + 1;
	}
	fwrite($handle,	'END:VCALENDAR');	
	}
	
	
?>

</body>
</html> 
