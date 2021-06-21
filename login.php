<?php
session_start();
if(isset($_SESSION['login']))
{
    if($_SESSION['login'] == "loggedin")
    {
        header("Location:admin_page.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS&BOOTSTRAP5 IMPORT -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css\mystyle.css" type="text/css">

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body style="background-color:rgb(226, 226, 226);">
    <div class="login-card">
        <p class="login-title">Admin Login</p>
        <div class="login-card-content">
    
            <form action="admin_page.php" method="POST">
                <input type="text" name="loginUsername" class="form-control login-my-form mb-5" placeholder="Username">
                <input type="password" name="loginPassword" class="form-control login-my-form mb-3" placeholder="Password">
                <button type="submit" class="btn login-button">Login</button>
            </form>
        </div>
    </div>

</body>
<script type="text/javascript" src="js/jquery.min.js"></script>

<script>
$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});

</script>
</html>