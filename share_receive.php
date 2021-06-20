<?php

    if(isset($_FILES['jadwalsiak']['tmp_name']))
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['jadwalsiak']['name']);
        $uploaded = $_FILES['jadwalsiak']['tmp_name'];
        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
        $content = file_get_contents($uploaded);
        $check_mahasiswa = strpos($content, 'title="Ganti Role">Mahasiswa');
        $check_dosen = strpos($content, 'title="Ganti Role">Dosen');
    }
    elseif(isset($_POST['sourcesiak']))
    {
        $content = $_POST['sourcesiak'];
        $check_mahasiswa = strpos($content, 'title="Ganti Role">Mahasiswa');
        $check_dosen = strpos($content, 'title="Ganti Role">Dosen');
    }


    if($content == NULL)
    {
        echo '<script language="javascript">';
        echo 'window.location="home.php";';
        echo '</script>';
    }
    elseif($check_mahasiswa == NULL && $check_dosen == NULL)
    {
        echo '<script language="javascript">';
        echo 'alert("Shared source/file is invalid");';
        echo 'window.location="home.php";';
        echo '</script>';
        echo "<script>window.location.href='home.php';</script>";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your page description here" />
    <meta name="IGS" content="" />
    <title>SchedUIe by IGS</title>

    <!-- CSS&BOOTSTRAP5 IMPORT -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mystyle.css">

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- JS MANIFEST FOR PWA -->
    <link rel="manifest" href="manifest.json"> 

</head>
<body>
    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-expand-md">
        <div class="container-fluid">
            <a href="home.php" class="navbar-brand">
            <img src="images/logo192.png" alt="Home" width="40" height="40" style="margin-bottom:5px">
            <span class="logo-text">SchedUIe</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#intro">Introduction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tutorial">Tutorial</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Features
                        </a>
                        <ul class="dropdown-menu dropdown-menu-recolor" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="home.php">SIAK Calendar Converter</a></li>
                            <li><a class="dropdown-item" href="event.php">Event Advertiser</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item disabled" href="#">Thanks for checking out!</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" id="a2hs-download" style="display: none;">
                        <a class="nav-link" href="#">Download App</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> 
    <!-- NAVBAR END -->

    
    <section id="intro">
        <div id="intro-filter">
    <div class="container">
            <p class="subheader-text pt-5">Share berhasil diterima, silahkan convert melalui button di bawah</p>
            </div>
            
            <div class="main-program" id="main-program">
                <form id="mainForm" action="decision.php" method="POST" enctype="multipart/form-data">
                    <span>
                        <label for="username" class="form-label">Username UI</label>
                        <i class="bi bi-patch-question" data-bs-toggle="tooltip" data-bs-placement="right" title="Kosongkan jika tidak ingin menerima email notifikasi"></i>
                    </span>
                    <input type="text" id="username" name="e_name" class="form-control mb-3 mt-2" placeholder="username.ui-mu99">
                    <input type="text" name="sourcesiak" value="<?=htmlentities($content)?>" hidden="hidden">
                    <button type="submit" id="convert" class="btn-lg btn-block btn-dark center convert-btn" value="submit" name="submit">
                        Convert
                    </button>
                </form>

            </div>  
            
            <div class="section-end-pad"></div>
    </section> <!-- SECTION INTRO END-->
  
        <section class="tutorial-video" id="tutorial">
            <h2 class="tutorial-header">Tutorial menggunakan SchedUIe</h2>
            <iframe class="video mb-3" width="560" height="315" src="https://www.youtube.com/embed/VufqcjG2g3Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </section>

    </div> <!-- CONTAINER DIV END --> 
    
    <!-- MAIN JS -->
    <script src="app.js"></script>

    <!-- JS IMPORT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>