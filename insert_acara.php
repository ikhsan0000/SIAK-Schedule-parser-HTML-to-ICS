<?php
require_once "config_database.php";
require_once "event.php";
$posted = false;
$organisasi = $nama_acara = $tanggal = $hari = $waktu_mulai = $waktu_selesai = $desc = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try 
    {   
        $posted = true;
        $organisasi = $_POST["org"];
        $nama_acara = $_POST["e_name"];
	$desc = $_POST["e_desc"];
        $tanggal = $_POST["e_date"];
        $hari = $_POST["hari"];
        $waktu_mulai = $_POST["start_time"];
        $waktu_selesai = $_POST["end_time"];
        
        $insert = "INSERT INTO acara VALUES ('$organisasi', '$nama_acara', '$desc', '$tanggal', '$hari', '$waktu_mulai', '$waktu_selesai', 0)";
        pg_query($insert);
		
            echo ("<script>
            alert('Acara telah disubmit ^o^');
			window.location.href='#';
            </script>");
      
    }

    catch(Exception $e)
    {
        echo $e;
    }
}
?>


