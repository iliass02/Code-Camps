<?php
require("_init.php");
session_start();

if(!isset($_SESSION['clientId'])) header('Location: index.php');

if (isset($_GET['erreur'])) $erreur = $_GET['erreur'];
else $erreur = 0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans - Connexion</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
        
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
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>La Galerie des Artisans</b></a>
            <!--logo end-->

          <div class="nav notify-row" id="top_menu">
              <!--  notification start -->
              <ul class="nav top-menu">
                  <!-- inbox dropdown start-->
                  <li id="header_inbox_bar" class="dropdown">
                      <a href="panier.php">
                          <i class="fa fa-shopping-cart"></i>
                          <?php
                          if (isset($_SESSION['clientId'])) {
                              $request = "SELECT * FROM commandes WHERE payer=0 AND idClient=".$_SESSION['clientId'];
                              if (!$query = mysqli_query($link, $request)){
                                  header('Location: index.php');
                              }
                              $count = mysqli_num_rows($query);
                              if ($count == 0) {
                                  header('Location: index.php');
                              }

                              echo '<span class="badge bg-theme">'.$count.'</span>';
                          }
                          ?>
                      </a>

                  </li>
                  <!-- inbox dropdown end -->
              </ul>
              <!--  notification end -->
          </div>


            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Espace Admin</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
        <?php require('sidebar.php'); ?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
      		<div class="row mt">
      			<div style="margin-top: 150px" class="col-lg-6 col-md-6 col-sm-12">
		  	<div class="showback">
			      <form action="_traitement.php" method="POST">
			       <h3><i class="fa fa-angle-right"></i> Connexion</h3><br>
			        
			        
			        
			            <input type="text" id="identifiantFournisseur" name="mail" class="form-control" placeholder="Identifiant">
			            <br>
			            <input type="password" class="form-control" name="motDePasse" id="mdpFournisseur" placeholder="Mot de passe">
			            
			            <label class="checkbox">
			                <span class="pull-right">
			                    <a data-toggle="modal" href="loginClient.php#myModal"> Mot de passe oublié ?</a>
			
			                </span>
			            </label>
			            
			            <button class="btn btn-theme btn-block" id="connexionId" type="submit"><i class="fa fa-lock"></i> Connexion</button>
			          	<input type="hidden" name="typeTraitement" value="connexionClient">
			
			     
					</form>
		  
		  	<form class="form-login" action="_traitement.php" method="POST">
	  	 	 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Mot de passe oublié ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Entrer votre adresse email pour pouvoir réinitialiser votre mot de passe.</p>
		                          <input type="text" name="mailOubliee" id="mailOubliee" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Fermer</button>
		                          <button class="btn btn-theme" type="submit" id="envoyerEmail">Envoyer</button>
		                          <input type="hidden" name="typeTraitement" value="motDePasseOublieeClient">
		                      </div>
		                  </div>
		             
		          </div>
	  			</div>
	     </form> 
      				</div>
      			</div>
      				
      			
      			<div style="margin-top: -10px;" class="col-lg-6 col-md-6 col-sm-12">
      				<! -- ALERTS EXAMPLES -->
   
      					
          	
          	<!-- BASIC FORM ELELEMNTS -->
          
          		
                  <div class="form-panel">
                  <h3><i class="fa fa-angle-right"></i> Inscription</h3><br>
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
                          
                          
                          <center><button type="submit" id="inscriptionClientSubmit" class="btn btn-theme">Inscription</button></center>
                          <input type="hidden" name="inscriptionAfterPanier" value="1">
                         <input type="hidden" name="typeTraitement" value="inscriptionClient">
                         
                      </form>
                  </div>
          	
          	</div>
      		
          	 				
      		
      				
      				
      		</div><!--/ row -->
          </section><! --/wrapper -->
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
    <script src="assets/js/jjquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/js/sweetalert.min.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
    
  <script>
      //custom select box

      $(document).ready(function(){
      	$("#inscriptionClientSubmit").click(function() {
			
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

      <?php if ($erreur == 1) :?>
      swal("Erreur", "vous n'êtes pas client, veuillez vous inscrire", "error");
		<?php endif;?>

		<?php if (isset($_GET["reinitialisation"]) == 1) : ?>
		sweetAlert("Good !", "Reinitialisation réussie", "success");
	<?php endif; ?>

		
		 <?php if ($erreur == 2) :?>
		 sweetAlert("Good !", "Le mail est envoyé", "success");
		<?php endif;?>

		<?php if ($erreur == 3) : ?>	
		sweetAlert("Oops...", "Email inexistant", "error");
	<?php endif; ?>
     

  </script>

  </body>
</html>
