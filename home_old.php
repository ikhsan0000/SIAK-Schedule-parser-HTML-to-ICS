<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SchedUIe by IGS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Your page description here" />
  <meta name="IGS" content="" />

  <!-- JQ
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  
  <!-- css -->
  <link href="css/bootstrap.css" rel="stylesheet" />
  <link href="css/bootstrap-responsive.css" rel="stylesheet" />
  <link href="css/prettyPhoto.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet"> 
  <link href="css/style.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" type="img/png" href="img/favicon2.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- Theme skin -->
  <link id="t-colors" href="color/scheduie.css" rel="stylesheet" />
  <!-- Fav and touch icons -->

  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
  <link rel="stylesheet" href="css/mystyle.css">
  <link rel="manifest" href="manifest.json"> 

  <!-- =======================================================
    Theme Name: Remember
    Theme URL: https://bootstrapmade.com/remember-free-multipurpose-bootstrap-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
  <button class="trigger hidden">Click here to trigger the modal!</button>

  <div id="wrapper">
    <!-- start header -->
    <header>
      <div class="top">
        <div class="container">
          <div class="row">
            <div class="span6">
              <ul class="topmenu">
                <li><a href="home.php">Home</a>&nbsp;&nbsp;</li>
				<li><a href=#intro>Introduction</a>&nbsp;&nbsp;</li>
				<li><a href=#content>Manual</a>&nbsp;&nbsp;</li>
				<li><a href=#mainprog>Main Program</a>&nbsp;&nbsp;</li>
        <li><a href=#profile>About</a>&nbsp;&nbsp;</li>
        <li><a href="push.php">Push Notification</a>&nbsp;&nbsp;</li>
              </ul>
            </div>
            <div class="span6">

            </div>
          </div>
        </div>
      </div>
      <div class="container">
            <!-- Modal box -->
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
        <div class="row nomargin">
          <div class="span4">
            <div class="logo">
              <h1>
                <a href="home.php">Sched<span style="color:yellow">UI</span>e</a> + 
                <a href="event.php" target="_blank">Event</a>
              </h1>
            </div>
          </div>
          <div class="span8">
            <div class="navbar navbar-static-top">
              <div class="navigation">
              </div>
              <!-- end navigation -->
            </div>
          </div>
        </div>
      </div> <!-- end container -->
    </header>
    <!-- end header -->

    <!-- section intro -->
    <section id="intro">
      <div class="intro-content">

        <h2>Welcome to Sched<span style="color:yellow">UI</span>e</h2>
        <h3>SchedUIe adalah layanan web yang dibuat untuk civitas academica Universitas Indonesia. Website ini akan mengubah HTML jadwal <a href="https://academic.ui.ac.id/main/Authentication/" target="_blank"> SIAK </a>anda menjadi format yang dapat diupload ke <a href="https://calendar.google.com/calendar/" target="_blank">Google Calendar</a></h3>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/4g2m41EbLgU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



     <div class="container mt-3 col-3" id="mainprog">
			<form action="Decision.php" method="POST" enctype="multipart/form-data">
			<p style="color:white;">Username UI:</p>
			<div class="form-group input-group-lg">
				<input type="text" id="username" name="e_name" class="form-control" placeholder="Kosongkan jika tidak ingin menerima E-mail">
			</div>
			<p style="color:white;">Upload disini:</p>
			<div class="custom-file mb-3">
				<input type="file" class="custom-file-input" id="customFile" name="jadwalsiak">
				<label class="custom-file-label" for="customFile">Choose file</label>
			</div>
			<br>

			<div class="mt-3">
				<button type="submit" id="convert" class="btn-lg btn-block btn-dark" value="submit" name="submit">Convert</button>
			</div>
			</form>

	   </div>




	  </section>
	<!-- /section intro -->
    <section id="content">
      <div class="container">
        <div class="aligncenter">
		  <h4>Tutorial Menggunakan SchedUIe<br></h4>
		  <iframe width="560" height="315" src="https://www.youtube.com/embed/VufqcjG2g3Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <br><br><br>
		  </div>
        </div>
	  </section>


	          <!-- divider -->
        <div class="row">
          <div class="span12">
            <div class="solidline"></div>
          </div>
        </div>
        <!-- end divider -->
	  <section id="profile">
		<div class="container">
        <div class="row team">
          <div class="span12">
			  <div class="aligncenter">
            <h4>Developer's Profile</h4>
          </div>
		</div>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <div class="span3">
            <div class="team-box">
              <a href="#profile" class="thumbnail" ><img src="img/dummies/Ican.jpg" alt="" /></a>
              <div class="roles aligncenter">
                <p class="lead"><strong>Ikhsan Firdauz</strong></p><br>
                <p>
                  <a href="https://id.linkedin.com/in/ikhsan-firdauz-562a50147" target="_blank"><i class="icon-linkedin icon-circled icon-bglight active"></i></a>
                </p>

              </div>
            </div>
          </div>
          <div class="span3">
            <div class="team-box">
              <a href="#profile" class="thumbnail"><img src="img/dummies/Galih.jpg" alt="" /></a>
              <div class="roles aligncenter">
                <p class="lead"><strong>Galih Damar Jati</strong></p><br>
                <p>
                  <a href="https://id.linkedin.com/in/galih-damar-jati-254499148" target="_blank"><i class="icon-linkedin icon-circled icon-bglight active"></i></a>
                </p>
              </div>
            </div>
          </div>
          <div class="span3">
            <div class="team-box">
              <a href="#profile" class="thumbnail"><img src="img/dummies/Siraj.jpg" alt="" /></a>
              <div class="roles aligncenter">
                <p class="lead"><strong>Achmad Faiz Siraj</strong></p><br>
                <p>
                  <a href="https://id.linkedin.com/in/achmad-faiz-siraj-474497148" target="_blank"><i class="icon-linkedin icon-circled icon-bglight active"></i></a>
                </p>
              </div>
            </div>
          </div>
		</div>
	   </div>
    </section>



    <footer>
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="widget">
              <div class="footer_logo">
                <h3><a href="home.php">Sched<span style="color:yellow">UI</span>e</a></h3>
              </div>
              <address>
							  <strong>IGS</strong><br>
  							Teknik Komputer Universitas Indonesia 2017<br>
			  </address>
              <p>For more information and support please contact:<br>
                <i class="icon-envelope-alt"></i> scheduiebyigs@gmail.com
              </p>
            </div>
          </div>


            </div>
          </div>

      <div id="sub-footer">
        <div class="container">
          <div class="row">
            <div class="span12">
              <div class="copyright">
                <p><span>&copy; Remember Inc. All right reserved</span></p>
                <p><span>Report Card icon by <a href="https://icons8.com/icon/13184/report-card">Icons8</a></span></p>



            <div class="span6">
              <div class="credits">
                <!--
                  All the links in the footer should remain intact.
                  You can delete the links only if you purchased the pro version.
                  Licensing information: https://bootstrapmade.com/license/
                  Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Remember
                -->
                Created by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              		</div>
					</div>
            	 </div>
       		  </div>
       		 </div>
      		</div>
		  </div>
		</div>

    </footer>
  </div>
  <a href="#" class="scrollup"><i class="icon-angle-up icon-rounded icon-bglight icon-2x"></i></a>

  <!-- javascript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <!-- <script src="js/jquery.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/modernizr.custom.js"></script>
  <script src="js/toucheffects.js"></script>
  <script src="js/google-code-prettify/prettify.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/portfolio/jquery.quicksand.js"></script>
  <script src="js/portfolio/setting.js"></script>
  <script src="js/animate.js"></script>
  <script src="js/custom.js"></script> -->
  <script src="app.js"></script>
  
  <script>
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
	var fileName = $(this).val().split("\\").pop();
	$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

	</script>

</body>

</html>
