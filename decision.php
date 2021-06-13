<?php	
	$role = '';
	include_once('config_database.php');
	//cek role
	if(isset($_FILES['jadwalsiak']['tmp_name']))
	{
		$uploaded = $_FILES['jadwalsiak']['tmp_name'];
		@$content = file_get_contents($uploaded);
	}
	elseif(isset($_POST['sourcesiak']))
	{
		$content = $_POST['sourcesiak'];
		$uploaded = 1; //override uploaded
	}

	if(isset($uploaded))
	{
		if($uploaded == NULL && $content == NULL)
		{
			echo '<script language="javascript">';
			echo 'alert("Please select your file");';
			echo 'window.location="home.php";';
			echo '</script>';
			echo "<script>window.location.href='home.php';</script>";
		}
		elseif(strpos($content, 'title="Ganti Role">Mahasiswa') !== false)
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
			include_once('download_page.php');
		}
		elseif ($role == 'dosen')
		{
			include_once('output_dosen.php');
			include_once('download_page.php');
		}
		elseif (isset($_POST['sourcesiak']))
		{
			echo '<script language="javascript">';
			echo 'alert("Invalid source");';
			echo 'window.location="home.php";';
			echo '</script>';
			exit();
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Invalid file");';
			echo 'window.location="home.php";';
			echo '</script>';
			exit();
		}
	}
	else
	{
		header("Location:home.php");
	}
?>

<html>
<head>
</head>
<body>

</body>
</html>
