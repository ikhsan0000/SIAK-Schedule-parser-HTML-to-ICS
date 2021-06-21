<?php
require_once "config_database.php";
require_once "event.php";
$posted = false;
$organisasi = $nama_acara = $tanggal = $hari = $waktu_mulai = $waktu_selesai = $desc = $target_audience = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try 
    {   
        $organisasi = $_POST["org"];
        $nama_acara = $_POST["e_name"];
		$desc = $_POST["e_desc"];
        $tanggal = $_POST["e_date"];
        $hari = $_POST["hari"];
		$waktu_mulai = $_POST["start_time"];
		$waktu_selesai = $_POST["end_time"];
		$target_audience = $_POST["e_targetAudience"];

		
        if(strtotime($waktu_mulai) >= strtotime($waktu_selesai))
		{
			echo ("<script>
            alert('Input time invalid');
			window.location.href='#';
            </script>");
		}
		else
		{
			$dayConv = date("D", strtotime($tanggal));
			$waktu_mulai = explode(":", $waktu_mulai);
			$waktu_mulai = $waktu_mulai[0].$waktu_mulai[1];
			$waktu_selesai = explode(":", $waktu_selesai);
			$waktu_selesai = $waktu_selesai[0].$waktu_selesai[1];
			switch($dayConv)
			{
				case 'Mon':
					$hari = "Senin";
				break;
				case 'Tue':
					$hari = "Selasa";
				break;
				case 'Wed':
					$hari = "Rabu";
				break;
				case 'Thu':
					$hari = "Kamis";
				break;
				case 'Fri':
					$hari = "Jumat";
				break;
				case 'Sat':
					$hari = "Sabtu";
				break;
				case 'Sun':
					$hari = "Minggu";
				break;
			}

			$insert = "INSERT INTO acara (org, nama_acara, deskripsi, tanggal, hari, waktu_mulai, waktu_selesai, target_audience, sent) VALUES ('$organisasi', '$nama_acara', '$desc', '$tanggal', '$hari', '$waktu_mulai', '$waktu_selesai', '$target_audience', 0)";
			mysqli_query($link, $insert);
		
            echo ("<script>
            alert('Acara telah disubmit !');
			window.location.href='#';
            </script>");
		}
        
      
    }

    catch(Exception $e)
    {
        echo ("<script>
            alert('Ada kesalahan di form mu');
			window.location.href='#';
            </script>");
    }
}
?>


