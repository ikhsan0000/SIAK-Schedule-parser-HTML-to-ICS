<?php	
$role = '';
  

	if (isset($_POST['role']) && $_POST['role'] == "mahasiswa")
	{
		include_once('output_mahasiswa.php');
	}
	elseif (isset($_POST['role']) && $_POST['role'] == "dosen")
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
