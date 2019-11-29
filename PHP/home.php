<html>


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
  
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  ?>
  
  <head>
		<title> SchedUIe </title>
	</head>
	
  <body>
	<h1 align='middle'> SchedUIe </h1>
	<form action="decision.php" method="post" enctype="multipart/form-data">
    File HTML siak:
    <input type="file" name="jadwalsiak" id="fileToUpload"><br>
	Role:
	<input type="radio" name="role" value="mahasiswa">Mahasiswa
	<input type="radio" name="role"value="dosen">Dosen
	<br>
	<input type="submit" value="Submit" name="submit"> 
	</form>

</body>
</html>

