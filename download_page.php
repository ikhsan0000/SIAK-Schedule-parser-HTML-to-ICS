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
            <i class="bi bi-calendar-week nav-icon"></i>
            <div class="logo-text">SchedUIe</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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
                            <li><a class="dropdown-item" href="#main-program">SIAK Calendar Converter</a></li>
                            <li><a class="dropdown-item" href="event.php">Event Advertiser</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item disabled" href="#">Thanks for checking out!</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> 
    <!-- NAVBAR END -->
    
    <!-- MODAL BOX -->
    <div class="mymodal">
      <div class="mymodal-content">
          <span class="close-button">×</span>
          <br>
          Nyalakan Push Notification untuk menerima berita, notifikasi dapat dimatikan lewat halaman Scheduie "Push Notification" di atas
          <div class="d-flex justify-content-around">
            <button class="btn btn-success mt-3 mb-1" name="push" id="push" style="align-items: center; display: flex;">Enable Push Notification</button>
          </div>
      </div>
    </div>
    <!-- MODAL BOX END -->

    <section id="intro">
        <div id="intro-filter">
    <div class="container">
            <h1 class="header-text">Convert Berhasil !</h1>
        </div>
            <div class="main-program mt-4" id="main-program">
              <p class="subheader-text" style="margin-bottom: 0;"><?php if(isset($nama_mahasiswa)){echo "Hai ".$nama_mahasiswa."<br>";}?>Silahkan download melalui button di bawah</p>
              <div class="mb-2">
                <a href="ics/<?=$file;?>" class="btn-lg btn-block btn-dark center convert-btn nostyle" id="download" style="padding-top: 10px; margin-top: 0;">Download Here</a>
              </div>
            </div>

            
            
            <div class="section-end-pad"></div>
    </section> <!-- SECTION INTRO END-->

    <section class="tutorial-video" id="tutorial">
        <h2 class="tutorial-header">Tutorial menggunakan SchedUIe</h2>
        <iframe class="video mb-3" width="560" height="315" src="https://www.youtube.com/embed/VufqcjG2g3Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </section>
          
    <section class="about" id="about">
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
    </section>


    </div> <!-- CONTAINER DIV END --> 
    
    <!-- MAIN JS -->
    <script src="app.js"></script>

    <!-- JS IMPORT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <!-- BOOTSTRAP TOOLTIP JS -->
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        var loadingBtn = '<span class="spinner-border spinner-border-sm" style="width: 20px; height: 20px;" role="status" aria-hidden="true"></span>&nbsp;&nbsp;Converting...'
        $("#convert").click(function(e)
        {
            $("#convert").attr('disabled', 'disabled');
            $("#convert").html(loadingBtn);
        });

    </script>
</body>
</html>