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

    <!-- CDN CSS BOOTSTRAP DATEPICKER -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- TIMEPICKER -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css">
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
                            <li><a class="dropdown-item" href="#main-program">Event Advertiser</a></li>
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
            <h1 class="header-text">Event UI</h1>
            <h3 class="subheader-text">Mau event-mu lebih ramai? SchedUIe bisa mengirimkan email pemberitahuan event untuk mengundang beberapa potential visitor ke event-mu yang telah menggunakan SchedUIe</h3>

            </div>
            <iframe class="video" width="560" height="315" src="https://www.youtube.com/embed/4g2m41EbLgU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            
            <div class="main-program mt-4" id="main-program">
                <form id="eventForm" class="was-validated" action="insert_acara.php" method="POST" enctype="multipart/form-data">
                    <label for="org" class="form-label">Nama Organisasi</label>
                    <input type="text" id="org" name="org" class="form-control mb-3 mt-2" required>
                    
                    <label for="e_name" class="form-label">Nama Acara</label>
                    <input type="text" id="e_name" name="e_name" class="form-control mb-3 mt-2" required>
                    
                    <label for="e_desc" class="form-label">Deskripsi Acara</label>
                    <textarea class="form-control mb-3 mt-2" id="e_desc" name="e_desc" placeholder="Deskripsikan acaranya.." style="height:200px" required></textarea>

                    <label for="e_date" class="form-label">Tanggal Acara</label>
                    <div class="input-group mb-3 mt-2">
                        <div class="input-group-text"><i class="bi bi-calendar3"></i></div>
                        <input type="text" class="form-control cursor-hand datepicker readonly" id="e_date" name="e_date" placeholder="Pilih Tanggal . . ." required>
                    </div>

                    <div class="row mb-3 mt-2" >
                        <div class="col">
                            <label for="start_time" class="form-label">Waktu Mulai</label>
                            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                <div class="input-group-text"><i class="bi bi-clock"></i></div>
                                <input type="text" class="form-control cursor-hand readonly" name="start_time" id="start_time" placeholder="..." required >
                            </div>
                        </div>
                        <div class="col-md-auto hyphen-clock">
                        -
                        </div>
                        <div class="col">
                            <label for="end_time" class="form-label">Waktu Selesai</label>
                            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                <div class="input-group-text"><i class="bi bi-clock"></i></div>
                                <input type="text" class="form-control cursor-hand readonly" name="end_time" id="end_time" placeholder="..." required >
                            </div>
                        </div>
                    </div>
                    
                                    
                    <button type="submit" id="submit" class="btn-lg btn-block btn-dark center convert-btn" value="submit" name="submit">Submit</button>
                </form>

            </div>
            
            <div class="section-end-pad"></div>
    </section> <!-- SECTION INTRO END-->

    <section class="tutorial-video" id="tutorial">
        <h2 class="tutorial-header">Tutorial menggunakan Event UI</h2>
        <iframe class="video mb-3" width="560" height="315" src="https://www.youtube.com/embed/6ttCHrSzTK0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
    

    <!-- JS IMPORT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- JS&JQ BOOTSTRAP DATEPICKER -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>

    <script>

    $( document ).ready(function() {
        // INITIALIZE DATEPICKER
        $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd-mm-yyyy"
        });

        // INITIALIZE CLOCKPICKER
        $('.clockpicker').clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done'
        });

        // CUSTOM READONLY
        $(".readonly").on('keydown paste', function(e){
            if(e.keyCode != 9) // ignore tab
                e.preventDefault();
        });

        // LOADING
        var loadingBtn = '<span class="spinner-border spinner-border-sm" style="width: 20px; height: 20px;" role="status" aria-hidden="true"></span>&nbsp;&nbsp;Submitting...'
        $("#eventForm").submit(function(e)
        {
            $("#submit").attr('disabled', 'disabled');
            $("#submit").html(loadingBtn);
        });
    });
    
    
    </script>

</body>
</html>