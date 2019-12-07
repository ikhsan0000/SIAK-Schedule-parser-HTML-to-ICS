<?php	
$role = '';
  
  if (empty($_POST["role"]))
  {
	  $role_error = "Role is required";
  }
  else
  {
	  $role = test_input($_POST["role"]);
  }
  
  function test_input($data) 
  {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

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
		echo 'window.location.replace("home.php")';
		echo '</script>';
		exit();
	}
?>
