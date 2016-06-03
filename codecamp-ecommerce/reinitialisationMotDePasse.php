<?php include("_init.php"); 

if (!isset($_GET['cle']) && $_GET['cle'] != "azertyuiop") exit();
if (isset($_GET['id']) && $_GET['id'] != 0) $id = $_GET['id'];
else $id = "";

if (isset($_GET['erreur'])) $erreur = $_GET['erreur'];
else $erreur = "";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>La Galerie des Artisans</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              
            <!--logo start-->
            <a href="index.php" class="logo"><b>LA GALERIE DES ARTISANS</b></a>
            <!--logo end-->

            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="login.php">Connexion</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="container">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Reinitialisation de votre mot de passe</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" action="_traitement.php" method="POST">
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nouveau mot de passe*</label>
                              <div class="col-sm-10">
                                  <input type="password" name="nouveauMotDePasse" id="nouveauMotDePasse" class="form-control round-form">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Confirmation du nouveau mot de passe*</label>
                              <div class="col-sm-10">
                                  <input type="password" id="mdpConfirm" class="form-control round-form">
                              </div>
                          </div>
                          
                          
                          <center><button type="submit" id="reinitialisationSubmit" class="btn btn-theme">Reinitialiser votre mot de passe</button></center>
                         
                         <input type="hidden" name="typeTraitement" value="reinitialisationMotDePasse">
                         <?php echo "<input type='hidden' name='id' value='$id'>"; ?>
                         
                      </form>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
          	

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer" style="position: absolute; width: 100%; bottom: 0; z-index: -1;">
          <div class="text-center">
              La Galerie des Artisans
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
  


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
	<script src="assets/js/sweetalert.min.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="assets/js/bootstrap-switch.js"></script>
	
	<!--custom tagsinput-->
	<script src="assets/js/jquery.tagsinput.js"></script>
	
	<!--custom checkbox & radio-->
	
	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	
	
	<script src="assets/js/form-component.js"></script>    
    
    
    
  <script>

      $(document).ready(function(){
      	$("#reinitialisationSubmit").click(function() {
		
  			var mdp=$("#nouveauMotDePasse").val();
  			var mdpConfirm=$("#mdpConfirm").val();

  			if (mdp == "" || mdpConfirm == "") {
  				swal("Erreur", "Tous les champs sont requis", "error");
  				return false;
			}
  			
  			else if (mdp != mdpConfirm) {
  				swal("Erreur", "Mot de passe différent", "error");
  				return false;
  			}
  			
          });

        
      });
      <?php if ($erreur == 1) : ?>
  		sweetAlert("Oops...", "Reinitialisation échouée", "error");
  	<?php endif; ?>

  </script>

  </body>
</html>
