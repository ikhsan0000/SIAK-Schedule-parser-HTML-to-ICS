<?php
/* Attempt to connect to database */
require_once "config_database.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// require 'vendor/autoload.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
//Functoin PHPMailer
//source: https://github.com/PHPMailer/PHPMailer
function sendMail($recipient, $user_name, $event_name, $day, $description, $date, $start, $end)
{


	$content = "Halo pengguna SchedUIe<br>
				Kami dari SchedUIe mengajak anda untuk hadir dalam <br><br>
				Acara : $event_name<br>
				Deskripsi acara: $description<br>
				Hari : $day<br>
				Tanggal : $date<br>
				Pukul : $start - $end<br>
				Tiada kesan tanpa kehadiranmu kawan!<br><br>
				Salam --IGS";
	
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPDebug = 3;		//change value to 3 to debug, default 0
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Host = 'smtp.gmail.com';
	$mail->Mailer   = "smtp";
	$mail->Port = '587';
	// 1 = High, 2 = Medium, 3 = Low
	$mail->Priority = 1;
	// May set to "Urgent" or "Highest" rather than "High"
	$mail->AddCustomHeader("X-MSMail-Priority: Highest");
	// Not sure if Priority will also set the Importance header:
	$mail->AddCustomHeader("Importance: Highest");
	$mail->isHTML();
	$mail->Username = 'scheduiebyigs@gmail.com';
	$mail->Password = 'tekkom2017';			//change to password email
	$mail->SetFrom('scheduiebyigs-no_reply@gmail.com');
	$mail->Subject = 'Notice Acara dari SchedUIe!';
	$mail->Body = $content;
	// $mail->AddAddress($recipient);
	$mail->AddBCC('ikhsan.firdauz@ui.ac.id');
	$mail->addBCC('galih.damar71@ui.ac.id');
	$mail->addBCC('Achmad.faiz71@ui.ac.id');
	$mail->addBCC('hizkia.william@ui.ac.id');
	$mail->addBCC('Darrell.yonathan@ui.ac.id');
	$mail->addBCC('Ananda.rizky71@ui.ac.id');
	$mail->addBCC('geraldy.christanto@ui.ac.id');
	$mail->addBCC('mohammad.khairi@ui.ac.id');
	$mail->addBCC('alvin.genta@ui.ac.id');
	$mail->addBCC('Bayu.satria71@ui.ac.id');
	$mail->addBCC('gita.ayu73@ui.ac.id');
	$mail->addBCC('anandwi.ghurran@ui.ac.id');
	$mail->Send();
	echo "mail sent!";

}

	$e_id =  $_POST['id'];

	$kueri_row = "SELECT * FROM user_list";
	$execute = mysqli_query($link, $kueri_row);
	
	//Loop trough all events in table acara (SELECT * FROM acara)
	$kueri_e = "SELECT * FROM acara WHERE id = $e_id AND sent = 0";
	$execute_e = mysqli_query($link, $kueri_e);
	while($row_e = mysqli_fetch_assoc($execute_e))
	{
		$hari_event = $row_e['Hari'];
		//day of current event
		$nama_event = $row_e['Nama_acara'];
		//name of current event
		$e_deskripsi = $row_e['Deskripsi'];
		//description of current event
		$e_mulai = $row_e['Waktu_mulai'];
		//start time of current event
		$e_selesai = $row_e['Waktu_selesai'];
		//end time of current event
		$tanggal_event = $row_e['Tanggal'];
		
		$e_mulai_fixed = "";
		$e_selesai_fixed = "";
		//block to fix time format (ex: from 1800 to 18:00)
		//fix start event time
		if(strlen($e_mulai) == 3)
		{
			$e_mulai_fixed = "0" . $e_mulai;
		}
		else
		{
			$e_mulai_fixed = $e_mulai;
		}
		$e_mulai_fixed = str_split($e_mulai_fixed);
		$e_mulai_final = $e_mulai_fixed[0].$e_mulai_fixed[1].":".$e_mulai_fixed[2].$e_mulai_fixed[3];
		
		
		//fix end event time
		if(strlen($e_selesai) == 3)
		{
			$e_selesai_fixed = "0" . $e_selesai;
		}
		else
		{
			$e_selesai_fixed = $e_selesai;
		}
		$e_selesai_fixed = str_split($e_selesai_fixed);
		$e_selesai_final = $e_selesai_fixed[0].$e_selesai_fixed[1].":".$e_selesai_fixed[2].$e_selesai_fixed[3];
		
		
		//test block
		echo "<br>";
		echo $nama_event;
		echo "<br>";
		echo $hari_event;
		echo "<br>";
		echo $e_mulai;
		echo "<br>";
		echo $e_selesai;
		echo "<br>";
		echo "<br>";
		//test block
		
		//Loop trough all users in table user_list (SELECT * FROM user_list) for all Events

		while($row2 = mysqli_fetch_assoc($execute))
		{
			//get current user NPM
			$current_user = $row2['ID'];
			//get current user name
			$current_name = $row2['Nama'];
			//get current user's email
			$current_email = $row2['Email'];
			$kueri_row2 = "SELECT a.id, b.nama, b.email, a.hari, a.waktu_mulai, a.waktu_selesai FROM jadwal a RIGHT JOIN user_list b ON a.id = b.id WHERE a.id = '$current_user' AND hari = '$hari_event'";
			$execute2 = mysqli_query($link, $kueri_row2);
			
			//test block
			echo "nama: ";
			echo $current_name;
			echo "<br>";
			echo "email: ";
			echo $row2['Email'];
			echo "<br>";
			//test block
			
			//Loop trough all subject for current user to get time information for every subject, get from JOINED table user_list & jadwal ($kueri_row2)
			//if true_flag turned 0, then intersect is detected
			$true_flag = 1;
			
			echo "<br>";
			echo "current true_flag = " . $true_flag;
			echo "<br>";
			
			while($row3 = mysqli_fetch_row($execute2))
			{
				$hari_matkul = $row3[3];
				//get current subject's day
				$k_mulai = $row3[4];
				//get current subject's start time
				$k_selesai= $row3[5];
				//get current subject's end time
				
				echo "hari: ";
				echo $hari_matkul;
				echo "<br>";
				echo "jam mulai: ";
				echo $row3[4];
				echo "<br>";
				echo "jam selesai: ";
				echo $row3[5];
				echo "<br>";
				
				//flag to determine if any of the user's subject is intersect with the event's time
				$flag_passed = 0;

				
				//the intersect detection logic
				if($e_mulai < $k_mulai && $e_selesai < $k_mulai)
				{
					if($e_mulai < $k_selesai && $e_selesai < $k_selesai)
					{
						$flag_passed = 1;
					}
					else
					{
						$true_flag = 0;
					}
						
				}
				elseif($e_mulai > $k_mulai && $e_selesai > $k_mulai)
				{
					if($e_mulai > $k_selesai && $e_selesai > $k_selesai)
					{
						$flag_passed = 1;
					}
					else
					{
						$true_flag = 0;
					}
				}
				else
				{
					$true_flag = 0;
				}
			}
	
			echo "after check true_flag = " . $true_flag;
			echo "<br>";
			
			//if every checked subject on current user is passing the condition, then send email
			if($true_flag == 1)
			{
				
				//block test
				echo "<br>";
				echo $current_name;
				echo " IS VALID TO SEND";
				echo "<br>";
				sendMail($current_email, $current_name, $nama_event, $hari_event, $e_deskripsi,
				$tanggal_event, $e_mulai_final, $e_selesai_final);
				echo "<br>";
				echo "<br>";
				//block test
			}
			else
			{
				//block test
				echo $current_name;
				echo " IS NOT VALID TO SEND";
				echo "<br>";
				echo "<br>";
				//block test
			}
			
		}
		$kueri_update_sent = "UPDATE acara SET sent = 1 WHERE id = '$e_id'";
		mysqli_query($link, $kueri_update_sent);
		//reset the pointer for pg_fetch user & user's subject
		// pg_result_seek($execute,0);
		// pg_result_seek($execute2,0);
	}
	echo "<br>";



?>

