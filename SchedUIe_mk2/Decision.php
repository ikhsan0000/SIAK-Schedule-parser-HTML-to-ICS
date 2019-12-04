

<?php
require_once 'home.php';
	
	if (isset($role) && $role == "mahasiswa")
	{
		include_once('output_mahasiswa.php');
	}
	elseif (isset($role) && $role == "dosen")
	{
		include_once('output_dosen.php');
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Please select your role")';
		echo '</script>';
		include_once ('home.php');
		exit();
	}
?>