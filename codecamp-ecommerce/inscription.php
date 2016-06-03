<?php include("_init.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                  <li><a class="logout" href="logout.php">Espace Admin</a></li>
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
          	<h3><i class="fa fa-angle-right"></i> Inscription</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal style-form" action="_traitement.php" method="POST">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nom*</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nom" id="nom" class="form-control round-form">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Prénom*</label>
                              <div class="col-sm-10">
                                  <input type="text" name="prenom" id="prenom" class="form-control round-form">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email*</label>
                              <div class="col-sm-10">
                                  <input type="text" name="mail" id="mail" class="form-control round-form">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Mot de passe*</label>
                              <div class="col-sm-10">
                                  <input type="password" name="motDePasse" id="mdp" class="form-control round-form">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Confirmation du mot de passe*</label>
                              <div class="col-sm-10">
                                  <input type="password" id="mdpConfirm" class="form-control round-form">
                              </div>
                          </div>
                          
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Adresse*</label>
                              <div class="col-sm-10">
                                  <input type="text" name="adresse" id="adresse" class="form-control round-form">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Téléphone*</label>
                              <div class="col-sm-10">
                                  <input type="number" name="telephone" id="telephone" class="form-control round-form">
                              </div>
                          </div>
                          
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Date de naissance*</label>
                              <div class="col-sm-10">
                                  <input type="text" name="dateNaissance" id="dateNaissance" class="form-control round-form">
                              </div>
                          </div>
                          
                          
                          <center><button type="submit" id="inscriptionSubmit" class="btn btn-theme">Inscription</button></center>
                         
                         <input type="hidden" name="typeTraitement" value="inscriptionUtilisateur">
                         
                      </form>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->

		</section>
      </section><!-- /MAIN CONTENT -->

     <footer class="site-footer">
        <div class="text-center">
            La Galerie des Artisans
            <a href="#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
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
      	$("#inscriptionSubmit").click(function() {
			
      		var nom=$("#nom").val();
      		var prenom=$("#prenom").val();
      		var mail=$("#mail").val();
      		var adresse=$("#adresse").val();
      		var telephone=$("#telephone").val();
      		var dateNaissance=$("#dateNaissance").val();
  			var mdp=$("#mdp").val();
  			var mdpConfirm=$("#mdpConfirm").val();

  			if (nom == "" || prenom == "" || mail == "" || adresse == "" || telephone == "" || dateNaissance == "" || mdp == "" || mdpConfirm == "") {
  				swal("Erreur", "Tous les champs sont requis", "error");
  				return false;
			}
  			
  			else if (mdp != mdpConfirm) {
  				swal("Erreur", "Mot de passe différent", "error");
  				return false;
  			}

  			
  			
          });
      	
      });

  </script>

  </body>
</html>
