

<?php
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
		echo 'window.location="home.php";';
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
		include_once ('home.php');
		exit();
	}
	
	else											//valid format 
	{
		if(strpos($content, '<div id="logo"><img alt="makara"') !== false)		//check if the HTML content is SIAK or not
		{
			if(strpos($content, 'title="Ganti Role">Dosen') !== false)			//check if the page is right (dosen page)
			{
				//initiate DOM documents here
				$dom = new DOMDocument();
				
				@$dom->loadHTML($content);
				
				$dom->preserveWhiteSpace = false;
				
				
				$reminder = 0;						//number of lines 
				//Parsing here
				$tag_tr = $dom->getElementsByTagName('form');
				$important_content = $tag_tr->item(1)->getElementsByTagName('td');		//all <td> content (raw material)
				$inc = 0;
				
				foreach ($important_content as $i)
				{
				//	echo $important_content->item($inc)->nodeValue.'</br>';
					$inc++;
					$reminder = $reminder + 1;		//count number of lines (<td> tags)
				}
				
				$jumlah_matkul = $reminder / 9;		//each subject have 8 lines + 1 whitespace, divide by 9 to count number of subjects
				
				$i = 0;								//for loop variable
				$pointer = 0;						//points to subjects lines  
				
				//block search for important content
				for ($i = 0; $i < $jumlah_matkul; $i++)										//for loop to iterate each subjects
				{
					$judul = $important_content->item($pointer+2)->nodeValue;				//line 1 is the title (+2 because line 1 is white space)
					
					$ruang = $important_content->item($pointer+6)->nodeValue;				//line 5 contains location and time 
					
					$temp_ruang = str_word_count($ruang);									//if word > 3 then that subject have more than 1 day
					
					if ($temp_ruang > 3)		// 1 subject, on multiple day
					{
						$ruang_new = explode ('@', $ruang);
						$hari_count = count($ruang_new);
						$hari_count = $hari_count - 1;										//last index of @ explode is an uneeded information to seach for day name
						$hari_point = 0;													//pointer of day to the exploded variable
						for ($hari_point = 0; $hari_point < $hari_count; $hari_point++)		//iterate for how much days that subject allocated weekly
						{
							if($hari_point < 1)												//first day just use strstr before the ',' coma, it is already the name of the day
							{
								//block day name 
								$hari = strstr($ruang_new[$hari_point], ',', true);
								//echo $hari.'</br>';
								
								//block time
								$jam_flag = strpos($ruang_new[$hari_point], ',');
								$jam_flag = $jam_flag + 1;
								$x = 0;							//increment the string time
								$jam_final_b = '';
								while ($x < 12)
								{
									$jam_final_b .= $ruang[$jam_flag];
									$jam_flag++;
									$x++;
								}
								//echo $jam_final_b.'</br>';
								$jam_final_c = explode('-', $jam_final_b);
								$mulai = str_replace('.', '', $jam_final_c[0]);
								$mulai = str_replace(' ', '', $mulai);
								$selesai = str_replace('.', '', $jam_final_c[1]);
								
								
								//block location
								$x = 0;							//reset x for location scanning
								if(strpos($ruang_new[$hari_point+1], 'Senin') !== false)		
								{
									$stop = strpos($ruang_new[$hari_point+1], 'Senin');
									$ruang_temp_b = $ruang_new[$hari_point+1];
									$ruang_b = '';
									while ($x < $stop)
									{
										$ruang_b .= $ruang_temp_b[$x];
										$x++;
									}
									
								}
								elseif(strpos($ruang_new[$hari_point+1], 'Selasa') !== false)
								{
									$stop = strpos($ruang_new[$hari_point+1], 'Selasa');
									$ruang_temp_b = $ruang_new[$hari_point+1];
									$ruang_b = '';
									while ($x < $stop)
									{
										$ruang_b .= $ruang_temp_b[$x];
										$x++;
									}
								}
								elseif(strpos($ruang_new[$hari_point+1], 'Rabu') !== false)
								{
									$stop = strpos($ruang_new[$hari_point+1], 'Rabu');
									$ruang_temp_b = $ruang_new[$hari_point+1];
									$ruang_b = '';
									while ($x < $stop)
									{
										$ruang_b .= $ruang_temp_b[$x];
										$x++;
									}
									
									
								}
								elseif(strpos($ruang_new[$hari_point+1], 'Kamis') !== false)
								{
									$stop = strpos($ruang_new[$hari_point+1], 'Kamis');
									$ruang_temp_b = $ruang_new[$hari_point+1];
									$ruang_b = '';
									while ($x < $stop)
									{
										$ruang_b .= $ruang_temp_b[$x];
										$x++;
									}
								}
								elseif(strpos($ruang_new[$hari_point+1], 'Jumat') !== false)
								{
									$stop = strpos($ruang_new[$hari_point+1], 'Jumat');
									$ruang_temp_b = $ruang_new[$hari_point+1];
									$ruang_b = '';
									while ($x < $stop)
									{
										$ruang_b .= $ruang_temp_b[$x];
										$x++;
									}
								}
								elseif(strpos($ruang_new[$hari_point+1], 'Sabtu') !== false)
								{
									$stop = strpos($ruang_new[$hari_point+1], 'Sabtu');
									$ruang_temp_b = $ruang_new[$hari_point+1];
									$ruang_b = '';
									while ($x < $stop)
									{
										$ruang_b .= $ruang_temp_b[$x];
										$x++;
									}
								}
								else
								{
									$stop = strlen($ruang_new[$hari_point+1]);
									$ruang_temp_b = $ruang_new[$hari_point+1];
									$ruang_b = '';
									while ($x <= $stop)
									{
										$ruang_b .= $ruang_temp_b[$x];
										$x++;
									}
									
								}
								$ruang_b_final = str_replace(' ','', $ruang_b);
								echo '<strong>'.$hari.'</strong>'.'</br>';
								echo 'Mata Kuliah: '.$judul.'</br>';
								echo 'Ruang: '.$ruang_b_final.'</br>';
								echo 'Waktu: '.$jam_final_b.'</br></br></br>';
								
								//block write file
								fwrite($handle,	'BEGIN:VEVENT'."\n".
												'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
												'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n".
												'RRULE:FREQ=WEEKLY;BYDAY=MO'."\n".
												'CREATED:19000101T120000Z'."\n".
												'DESCRIPTION:'."\n".
												'LOCATION:'.$ruang_b_final."\n".
												'SEQUENCE:0'."\n".
												'STATUS:CONFIRMED'."\n".
												'SUMMARY:'.$judul."\n".
												'BEGIN:VALARM'."\n".
												'ACTION:DISPLAY'."\n".
												'DESCRIPTION:This is an event reminder'."\n".
												'TRIGGER:-P0DT0H30M0S'."\n".
												'END:VALARM'."\n".
												'END:VEVENT'."\n"
										);		
							}
							
							else															//the other day, check whether the keyword is present or not, if yes then that is the day name
							{
								if(strpos($ruang_new[$hari_point], 'Senin') !== false)		
								{
									//block day
									$hari = 'Senin';
									//echo $hari.'</br>';
									
									//block time
									$temp_jam = $ruang_new[$hari_point];
									$jam_flag = strpos($temp_jam, ',');
									$jam_flag = $jam_flag + 1;
									$x = 0;							//increment the string of time
									$jam_final_b = '';
									while ($x < 12)
									{
										$jam_final_b .= $temp_jam[$jam_flag];
										$jam_flag++;
										$x++;
									}
									//echo $jam_final_b.'</br>';
									$jam_final_c = explode('-', $jam_final_b);
									$mulai = str_replace('.', '', $jam_final_c[0]);
									$mulai = str_replace(' ', '', $mulai);
									$selesai = str_replace('.', '', $jam_final_c[1]);
									
									
									//block location
									$x = 0;							//reset x for location scanning
									if(strpos($ruang_new[$hari_point+1], 'Senin') !== false)		
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Senin');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
										
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Selasa') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Selasa');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Rabu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Rabu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
										
										
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Kamis') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Kamis');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Jumat') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Jumat');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Sabtu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Sabtu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									else
									{
										$stop = strlen($ruang_new[$hari_point+1]);
										$ruang_b = str_replace(' ','',$ruang_new[$hari_point+1]);
										
									}
									
									echo '<strong>'.$hari.'</strong>'.'</br>';
									echo 'Mata Kuliah: '.$judul.'</br>';
									echo 'Ruang:'.$ruang_b.'</br>';
									echo 'Waktu: '.$jam_final_b.'</br>';
								
									
									//block write file
									fwrite($handle,	'BEGIN:VEVENT'."\n".
													'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
													'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n".
													'RRULE:FREQ=WEEKLY;BYDAY=MO'."\n".
													'CREATED:19000101T120000Z'."\n".
													'DESCRIPTION:'."\n".
													'LOCATION:'.$ruang_b."\n".
													'SEQUENCE:0'."\n".
													'STATUS:CONFIRMED'."\n".
													'SUMMARY:'.$judul."\n".
													'BEGIN:VALARM'."\n".
													'ACTION:DISPLAY'."\n".
													'DESCRIPTION:This is an event reminder'."\n".
													'TRIGGER:-P0DT0H30M0S'."\n".
													'END:VALARM'."\n".
													'END:VEVENT'."\n"
											);	
									
								}
								elseif(strpos($ruang_new[$hari_point], 'Selasa') !== false)
								{
									//block day
									$hari = 'Selasa';
									//echo $hari.'</br>';
									
									//block time
									$temp_jam = $ruang_new[$hari_point];
									$jam_flag = strpos($temp_jam, ',');
									$jam_flag = $jam_flag + 1;
									$x = 0;							//increment the string of time
									$jam_final_b = '';
									while ($x < 12)
									{
										$jam_final_b .= $temp_jam[$jam_flag];
										$jam_flag++;
										$x++;
									}
									//echo $jam_final_b.'</br>';
									$jam_final_c = explode('-', $jam_final_b);
									$mulai = str_replace('.', '', $jam_final_c[0]);
									$mulai = str_replace(' ', '', $mulai);
									$selesai = str_replace('.', '', $jam_final_c[1]);
									
									//block location
									$x = 0;							//reset x for location scanning
									if(strpos($ruang_new[$hari_point+1], 'Senin') !== false)		
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Senin');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Selasa') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Selasa');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Rabu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Rabu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
										
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Kamis') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Kamis');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Jumat') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Jumat');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Sabtu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Sabtu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									else
									{
										$stop = strlen($ruang_new[$hari_point+1]);
										$ruang_b = str_replace(' ','',$ruang_new[$hari_point+1]);
									}
									
									echo '<strong>'.$hari.'</strong>'.'</br>';
									echo 'Mata Kuliah: '.$judul.'</br>';
									echo 'Ruang:'.$ruang_b.'</br>';
									echo 'Waktu: '.$jam_final_b.'</br>';
									
									//block write file
									fwrite($handle,	'BEGIN:VEVENT'."\n".
													'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
													'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n".
													'RRULE:FREQ=WEEKLY;BYDAY=TU'."\n".
													'CREATED:19000101T120000Z'."\n".
													'DESCRIPTION:'."\n".
													'LOCATION:'.$ruang_b."\n".
													'SEQUENCE:0'."\n".
													'STATUS:CONFIRMED'."\n".
													'SUMMARY:'.$judul."\n".
													'BEGIN:VALARM'."\n".
													'ACTION:DISPLAY'."\n".
													'DESCRIPTION:This is an event reminder'."\n".
													'TRIGGER:-P0DT0H30M0S'."\n".
													'END:VALARM'."\n".
													'END:VEVENT'."\n"
											);	
								}
								elseif(strpos($ruang_new[$hari_point], 'Rabu') !== false)
								{
									//block day
									$hari = 'Rabu';
									//echo $hari.'</br>';
									
									//block time
									$temp_jam = $ruang_new[$hari_point];
									$jam_flag = strpos($temp_jam, ',');
									$jam_flag = $jam_flag + 1;
									$x = 0;							//increment the string of time
									$jam_final_b = '';
									while ($x < 12)
									{
										$jam_final_b .= $temp_jam[$jam_flag];
										$jam_flag++;
										$x++;
									}
									//echo $jam_final_b.'</br>';
									$jam_final_c = explode('-', $jam_final_b);
									$mulai = str_replace('.', '', $jam_final_c[0]);
									$mulai = str_replace(' ', '', $mulai);
									$selesai = str_replace('.', '', $jam_final_c[1]);
					
									
									//block location
									$x = 0;							//reset x for location scanning
									if(strpos($ruang_new[$hari_point+1], 'Senin') !== false)		
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Senin');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Selasa') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Selasa');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Rabu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Rabu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
										
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Kamis') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Kamis');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Jumat') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Jumat');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Sabtu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Sabtu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									else
									{
										$stop = strlen($ruang_new[$hari_point+1]);
										$ruang_b = str_replace(' ','',$ruang_new[$hari_point+1]);
									}
									
									echo '<strong>'.$hari.'</strong>'.'</br>';
									echo 'Mata Kuliah: '.$judul.'</br>';
									echo 'Ruang:'.$ruang_b.'</br>';
									echo 'Waktu: '.$jam_final_b.'</br>';
									
									//block write file
									fwrite($handle,	'BEGIN:VEVENT'."\n".
													'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
													'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n".
													'RRULE:FREQ=WEEKLY;BYDAY=WE'."\n".
													'CREATED:19000101T120000Z'."\n".
													'DESCRIPTION:'."\n".
													'LOCATION:'.$ruang_b."\n".
													'SEQUENCE:0'."\n".
													'STATUS:CONFIRMED'."\n".
													'SUMMARY:'.$judul."\n".
													'BEGIN:VALARM'."\n".
													'ACTION:DISPLAY'."\n".
													'DESCRIPTION:This is an event reminder'."\n".
													'TRIGGER:-P0DT0H30M0S'."\n".
													'END:VALARM'."\n".
													'END:VEVENT'."\n"
											);	
									
								}
								elseif(strpos($ruang_new[$hari_point], 'Kamis') !== false)
								{
									//block day
									$hari = 'Kamis';
									//echo $hari.'</br>';
									
									//block time
									$temp_jam = $ruang_new[$hari_point];
									$jam_flag = strpos($temp_jam, ',');
									$jam_flag = $jam_flag + 1;
									$x = 0;							//increment the string of time
									$jam_final_b = '';
									while ($x < 12)
									{
										$jam_final_b .= $temp_jam[$jam_flag];
										$jam_flag++;
										$x++;
									}
									//echo $jam_final_b.'</br>';
									$jam_final_c = explode('-', $jam_final_b);
									$mulai = str_replace('.', '', $jam_final_c[0]);
									$mulai = str_replace(' ', '', $mulai);
									$selesai = str_replace('.', '', $jam_final_c[1]);
									
									//block location
									$x = 0;							//reset x for location scanning
									if(strpos($ruang_new[$hari_point+1], 'Senin') !== false)		
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Senin');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Selasa') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Selasa');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Rabu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Rabu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
										
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Kamis') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Kamis');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Jumat') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Jumat');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Sabtu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Sabtu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									else
									{
										$stop = strlen($ruang_new[$hari_point+1]);
										$ruang_b = str_replace(' ','',$ruang_new[$hari_point+1]);
									}
									
									echo '<strong>'.$hari.'</strong>'.'</br>';
									echo 'Mata Kuliah: '.$judul.'</br>';
									echo 'Ruang:'.$ruang_b.'</br>';
									echo 'Waktu: '.$jam_final_b.'</br>';
									
									//block write file
									fwrite($handle,	'BEGIN:VEVENT'."\n".
													'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
													'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n".
													'RRULE:FREQ=WEEKLY;BYDAY=TH'."\n".
													'CREATED:19000101T120000Z'."\n".
													'DESCRIPTION:'."\n".
													'LOCATION:'.$ruang_b."\n".
													'SEQUENCE:0'."\n".
													'STATUS:CONFIRMED'."\n".
													'SUMMARY:'.$judul."\n".
													'BEGIN:VALARM'."\n".
													'ACTION:DISPLAY'."\n".
													'DESCRIPTION:This is an event reminder'."\n".
													'TRIGGER:-P0DT0H30M0S'."\n".
													'END:VALARM'."\n".
													'END:VEVENT'."\n"
											);	
								}
								elseif(strpos($ruang_new[$hari_point], 'Jumat') !== false)
								{
									//block day
									$hari = 'Jumat';
									//echo $hari.'</br>';
									
									//block time
									$temp_jam = $ruang_new[$hari_point];
									$jam_flag = strpos($temp_jam, ',');
									$jam_flag = $jam_flag + 1;
									$x = 0;							//increment the string of time
									$jam_final_b = '';
									while ($x < 12)
									{
										$jam_final_b .= $temp_jam[$jam_flag];
										$jam_flag++;
										$x++;
									}
									//echo $jam_final_b.'</br>';
									$jam_final_c = explode('-', $jam_final_b);
									$mulai = str_replace('.', '', $jam_final_c[0]);
									$mulai = str_replace(' ', '', $mulai);
									$selesai = str_replace('.', '', $jam_final_c[1]);
									
									//block location
									$x = 0;							//reset x for location scanning
									if(strpos($ruang_new[$hari_point+1], 'Senin') !== false)		
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Senin');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Selasa') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Selasa');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Rabu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Rabu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
										
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Kamis') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Kamis');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Jumat') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Jumat');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Sabtu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Sabtu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									else
									{
										$stop = strlen($ruang_new[$hari_point+1]);
										$ruang_b = str_replace(' ','',$ruang_new[$hari_point+1]);
									}
									
									echo '<strong>'.$hari.'</strong>'.'</br>';
									echo 'Mata Kuliah: '.$judul.'</br>';
									echo 'Ruang:'.$ruang_b.'</br>';
									echo 'Waktu: '.$jam_final_b.'</br>';
									
									//block write file
									fwrite($handle,	'BEGIN:VEVENT'."\n".
													'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
													'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n".
													'RRULE:FREQ=WEEKLY;BYDAY=FR'."\n".
													'CREATED:19000101T120000Z'."\n".
													'DESCRIPTION:'."\n".
													'LOCATION:'.$ruang_b."\n".
													'SEQUENCE:0'."\n".
													'STATUS:CONFIRMED'."\n".
													'SUMMARY:'.$judul."\n".
													'BEGIN:VALARM'."\n".
													'ACTION:DISPLAY'."\n".
													'DESCRIPTION:This is an event reminder'."\n".
													'TRIGGER:-P0DT0H30M0S'."\n".
													'END:VALARM'."\n".
													'END:VEVENT'."\n"
											);	
								}
								elseif(strpos($ruang_new[$hari_point], 'Sabtu') !== false)
								{
									//block day
									$hari = 'Sabtu';
									//echo $hari.'</br>';
									
									//block time
									$temp_jam = $ruang_new[$hari_point];
									$jam_flag = strpos($temp_jam, ',');
									$jam_flag = $jam_flag + 1;
									$x = 0;							//increment the string of time
									$jam_final_b = '';
									while ($x < 12)
									{
										$jam_final_b .= $temp_jam[$jam_flag];
										$jam_flag++;
										$x++;
									}
									//echo $jam_final_b.'</br>';
									$jam_final_c = explode('-', $jam_final_b);
									$mulai = str_replace('.', '', $jam_final_c[0]);
									$mulai = str_replace(' ', '', $mulai);
									$selesai = str_replace('.', '', $jam_final_c[1]);
									
									//block location
									$x = 0;							//reset x for location scanning
									if(strpos($ruang_new[$hari_point+1], 'Senin') !== false)		
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Senin');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Selasa') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Selasa');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Rabu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Rabu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
										
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Kamis') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Kamis');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Jumat') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Jumat');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									elseif(strpos($ruang_new[$hari_point+1], 'Sabtu') !== false)
									{
										$stop = strpos($ruang_new[$hari_point+1], 'Sabtu');
										$ruang_temp_b = $ruang_new[$hari_point+1];
										$ruang_b = '';
										while ($x < $stop)
										{
											$ruang_b .= $ruang_temp_b[$x];
											$x++;
										}
									}
									else
									{
										$stop = strlen($ruang_new[$hari_point+1]);
										$ruang_b = str_replace(' ','',$ruang_new[$hari_point+1]);
									}
									
									echo '<strong>'.$hari.'</strong>'.'</br>';
									echo 'Mata Kuliah: '.$judul.'</br>';
									echo 'Ruang:'.$ruang_b.'</br>';
									echo 'Waktu: '.$jam_final_b.'</br>';
									
									//block write file
									fwrite($handle,	'BEGIN:VEVENT'."\n".
													'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
													'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n".
													'RRULE:FREQ=WEEKLY;BYDAY=SA'."\n".
													'CREATED:19000101T120000Z'."\n".
													'DESCRIPTION:'."\n".
													'LOCATION:'.$ruang_b."\n".
													'SEQUENCE:0'."\n".
													'STATUS:CONFIRMED'."\n".
													'SUMMARY:'.$judul."\n".
													'BEGIN:VALARM'."\n".
													'ACTION:DISPLAY'."\n".
													'DESCRIPTION:This is an event reminder'."\n".
													'TRIGGER:-P0DT0H30M0S'."\n".
													'END:VALARM'."\n".
													'END:VEVENT'."\n"
											);	
								}
								
							}	
							
						}
						
						
						echo '</br>';	//break for each subject iteration (multiple days)
					}
					
					else				// 1 subject only 1 day
					{
						//block string manipulation
						$hari = strstr($ruang, ',', true);
						
						$ruang_temp = explode ('@', $ruang);
						$ruang_temp2 = str_replace (' ','', $ruang_temp[1]);
						$ruang_final = $ruang_temp2;
						
						$jam_temp = explode ('@', $ruang);
						$jam_temp2 = explode (',', $jam_temp[0]);
						$jam_temp3 = str_replace (' ','', $jam_temp2[1]);
						$jam_temp4 = explode ('-', $jam_temp3);
						$mulai_temp = $jam_temp4[0];
						$mulai_temp2 = explode ('.', $mulai_temp);
						$mulai = $mulai_temp2[0].$mulai_temp2[1];
						$selesai_temp = $jam_temp4[1];
						$selesai_temp2 = explode ('.', $selesai_temp);
						$selesai = $selesai_temp2[0].$selesai_temp2[1];
						
						//block write file
						fwrite($handle,	'BEGIN:VEVENT'."\n".
										'DTSTART;TZID=Indian/Christmas:20191028T'.$mulai.'00'."\n".
										'DTEND;TZID=Indian/Christmas:20191028T'.$selesai.'00'."\n"
							   );
							   
						switch($hari)
						{
							case 'Senin':
								fwrite($handle, 'RRULE:FREQ=WEEKLY;BYDAY=MO'."\n".
												'CREATED:19000101T120000Z'."\n".
												'DESCRIPTION:'."\n"
									   );
							break;
							
							case 'Selasa':
								fwrite($handle, 'RRULE:FREQ=WEEKLY;BYDAY=TU'."\n".
												'CREATED:19000101T120000Z'."\n".
												'DESCRIPTION:'."\n"
									   );
							break;
							
							case 'Rabu':
								fwrite($handle, 'RRULE:FREQ=WEEKLY;BYDAY=WE'."\n".
												'CREATED:19000101T120000Z'."\n".
												'DESCRIPTION:'."\n"
									   );
							break;
							
							case 'Kamis':
								fwrite($handle, 'RRULE:FREQ=WEEKLY;BYDAY=TH'."\n".
												'CREATED:19000101T120000Z'."\n".
												'DESCRIPTION:'."\n"
									   );
							break;
							
							case 'Jumat':
								fwrite($handle, 'RRULE:FREQ=WEEKLY;BYDAY=FR'."\n".
												'CREATED:19000101T120000Z'."\n".
												'DESCRIPTION:'."\n"
									   );
							break;
							
							case 'Sabtu':
								fwrite($handle, 'RRULE:FREQ=WEEKLY;BYDAY=SA'."\n".
												'CREATED:19000101T120000Z'."\n".
												'DESCRIPTION:'."\n"
									   );
							break;
						}
						
						fwrite($handle,		'LOCATION:'.$ruang_final."\n".
											'SEQUENCE:0'."\n".
											'STATUS:CONFIRMED'."\n".
											'SUMMARY:'.$judul."\n".
											'BEGIN:VALARM'."\n".
											'ACTION:DISPLAY'."\n".
											'DESCRIPTION:This is an event reminder'."\n".
											'TRIGGER:-P0DT0H30M0S'."\n".
											'END:VALARM'."\n".
											'END:VEVENT'."\n"
							   );
						
						echo '<strong>'.$hari.'</strong>'.'</br>';
						echo 'Mata Kuliah: '.$judul.'</br>';
						echo 'Ruang: '.$ruang_final.'</br>';
						echo 'Waktu: '.$jam_temp4[0].'-'.$jam_temp4[1].'</br></br>';
						
					}
					echo '</br>';		//break for each subject iteration (one day)
					$pointer = $pointer + 9; 	//next matkul, each have 9 lines including the whitespace
					
					
				}
				
			fwrite($handle,	'END:VCALENDAR');
			}
			
			else										//SIAK html but wrong page
			{
				echo '<script language="javascript">';
				echo 'alert("Wrong SIAK page")';
				echo '</script>';
				include_once ('home.php');
				exit();
			}
		}
			
		else											//html not SIAK
		{
			echo '<script language="javascript">';
			echo 'alert("Wrong html content")';
			echo '</script>';
			include_once ('home.php');
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
