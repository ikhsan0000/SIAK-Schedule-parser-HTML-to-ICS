<?php

if(empty($file))
{
    header("Location:home.php");
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
<button class="trigger hidden">Click here to trigger the modal!</button>

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
                </ul>
            </div>
        </div>
    </nav> 
    <!-- NAVBAR END -->


    <section id="intro">
        <div id="intro-filter">
    <div class="container">
            <h1 class="header-text">Convert Berhasil !</h1>
        </div>
            <div class="main-program mt-4" id="main-program">
              <p class="subheader-text" style="margin-bottom: 0;">
              <?php
               if(isset($nama_mahasiswa))
               {
                   echo "Hai ".$nama_mahasiswa."<br>";
                }
                elseif(isset($name))
                {
                    echo "Hai".$name."<br>";
                }
               ?>
               Silahkan download melalui button di bawah</p>
              <div class="mb-2">
                <a href="ics/<?=$file;?>" class="btn-lg btn-block btn-dark center convert-btn nostyle" id="download" style="padding-top: 10px; margin-top: 0;">Download Here</a>
              </div>
            </div>

            
            
            <div class="section-end-pad"></div>
    </section> <!-- SECTION INTRO END-->

    <!-- MODAL BOX -->
    <div class="mymodal">
      <div class="mymodal-content">
          <span class="close-button">×</span>
          <br>
          Nyalakan Push Notification untuk menerima berita event yang terdaftar pada SchedUIe berdasarkan jadwal kosong mu
          <div class="d-flex justify-content-around">
            <button class="btn btn-success mt-3 mb-1" name="push" id="push" style="align-items: center; display: flex;">Enable Push Notification</button>
          </div>
      </div>
    </div>
    <!-- MODAL BOX END -->
    <section class="tutorial-video" id="tutorial">
        <h2 class="tutorial-header">Tutorial menggunakan SchedUIe</h2>
        <iframe class="video mb-3" width="560" height="315" src="https://www.youtube.com/embed/VufqcjG2g3Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </section>
          
    <!-- <section class="about" id="about">
        <h2 class="about-header">Developer's Profile</h2>
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <img src="img/dummies/Ican.jpg" class="profile img-thumbnail img-responsive" alt="" />
                <div class="profile-details">
                    Ikhsan Firdauz
                </div>
            </div>
            <div class="col-md-auto">
                <img src="img/dummies/Galih.jpg" class="profile img-thumbnail img-responsive" alt="" />
                <div class="profile-details">
                    Galih Damar Jati
                </div>
            </div>
            <div class="col-md-auto">
                <img src="img/dummies/Siraj.jpg" class="profile img-thumbnail img-responsive" alt="" />
                <div class="profile-details">
                    Achmad Faiz Siraj
                </div>
            </div>
        </div>
    </section> -->


    </div> <!-- CONTAINER DIV END --> 
    
    <!-- MAIN JS -->
    <script src="app.js"></script>

    <!-- JS IMPORT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <!-- BOOTSTRAP TOOLTIP JS -->
    <script>
    //Cookie handling

    function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    }

    var modalShown = getCookie('modal');
    var visitorAlready = getCookie('visitor');

    // Modalbox
    var modal = document.querySelector(".mymodal");
    var trigger = document.querySelector(".trigger");
    var closeButton = document.querySelector(".close-button");
    var downloadButton = document.querySelector("#download");

    function toggleModal() {
        modal.classList.toggle("show-modal");
    }

    function windowOnClick(event) {
        if (event.target === modal) {
            toggleModal();
        }
    }

    trigger.addEventListener("click", toggleModal);
    closeButton.addEventListener("click", toggleModal);
    window.addEventListener("click", windowOnClick);

    $(downloadButton).css("opacity", 0.5);
    $(downloadButton).css("pointer-events", "none");
    downloadButton.textContent = "please wait.."

    window.onload = function() 
    { 
        // $(downloadButton).prop("disabled", false);
        downloadButton.textContent = "Download Here"
        $(downloadButton).css("pointer-events", "");
        $(downloadButton).css("opacity", 1);

        downloadButton.addEventListener("click", function(event) {
            navigator.serviceWorker.ready.then(function()
            {
                if(modalShown === undefined)
                {
                    modal.classList.toggle("show-modal");
                    document.cookie = "modal=shown;expires=Fri, 31 Dec 9999 23:59:59 GMT;secure";
                }
            });
        });
    };
        
    </script>
</body>
</html>