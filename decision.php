<?php	
	$role = '';
	include_once('config_database.php');
	//cek role
	$uploaded = $_FILES['jadwalsiak']['tmp_name'];
	$content = file_get_contents($uploaded);
	if(strpos($content, 'title="Ganti Role">Mahasiswa') !== false)
	{
		$role = 'mahasiswa';
	}
	elseif(strpos($content, 'title="Ganti Role">Dosen') !== false)
	{
		$role = 'dosen';
	}

	//Get the user name
	if ($role == 'mahasiswa')
	{
		include_once('output_mahasiswa.php');
	}
	elseif ($role == 'dosen')
	{
		include_once('output_dosen.php');
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Please select your role");';
		echo 'window.location="home.php";';
		echo '</script>';
		exit();
	}
?>

<html>
<head>
</head>
<body>

</body>
</html>
