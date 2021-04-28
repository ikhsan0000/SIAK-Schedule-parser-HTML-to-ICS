<?php
require_once "config_database.php";
require_once "event.php";
$posted = false;
$organisasi = $nama_acara = $tanggal = $hari = $waktu_mulai = $waktu_selesai = $desc = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try 
    {   
        $organisasi = $_POST["org"];
        $nama_acara = $_POST["e_name"];
		$desc = $_POST["e_desc"];
        $tanggal = $_POST["e_date"];
        $hari = $_POST["hari"];
        $waktu_mulai_tmp = $_POST["start_time"];
		$waktu_mulai_tmp_2 = $_POST["start_time_2"];
		//if minute only 1 number ex* 0, convert to 00 (13 : 0 to 13 : 00)
		if(strlen($waktu_mulai_tmp_2) == 1)
		{
			$waktu_mulai_tmp_2 = 0 . $waktu_mulai_tmp_2;
		}
        $waktu_selesai_tmp = $_POST["end_time"];
		$waktu_selesai_tmp_2 = $_POST["end_time_2"];
		if(strlen($waktu_selesai_tmp_2) == 1)
		{
			$waktu_selesai_tmp_2 = 0 . $waktu_selesai_tmp_2;
		}
		$waktu_mulai = $waktu_mulai_tmp . $waktu_mulai_tmp_2;
		$waktu_selesai = $waktu_selesai_tmp . $waktu_selesai_tmp_2;
		
        if($waktu_mulai >= $waktu_selesai)
		{
			echo ("<script>
            alert('Input time invalid');
			window.location.href='#';
            </script>");
		}
		else
		{
			$insert = "INSERT INTO acara (org, nama_acara, deskripsi, tanggal, hari, waktu_mulai, waktu_selesai, sent) VALUES ('$organisasi', '$nama_acara', '$desc', '$tanggal', '$hari', '$waktu_mulai', '$waktu_selesai', 0)";
			mysqli_query($link, $insert);
		
            echo ("<script>
            alert('Acara telah disubmit ^o^');
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


