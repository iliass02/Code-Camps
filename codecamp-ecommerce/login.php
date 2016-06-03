<?php

include("_init.php");

if (isset($_GET['connexionEchoue'])) $connexionEchoue = $_GET['connexionEchoue'];
else $connexionEchoue = "";

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>La Galerie Des Artisans</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>
  
  </head>

  <body>

  
	  <div id="login-page">
	  	<div class="container">
	  	<a href="index.php"><img src="assets/img/logo.png"></a>
		      <form class="form-login" action="_traitement.php" method="POST">
		        <h2 class="form-login-heading">Connectez-vous</h2>
		        
		        <div class="login-wrap">
		        
		            <input type="text" id="identifiantFournisseur" name="mail" class="form-control" placeholder="Identifiant">
		            <br>
		            <input type="password" class="form-control" name="motDePasse" id="mdpFournisseur" placeholder="Mot de passe">
		            
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.php#myModal"> Mot de passe oublié ?</a>
		
		                </span>
		            </label>
		            
		            <button class="btn btn-theme btn-block" id="connexionId" type="submit"><i class="fa fa-lock"></i> Connexion</button>
		            <hr>
		          	<input type="hidden" name="typeTraitement" value="connexionUtilisateur">
		   
		          
		            <div class="registration">
		                Vous n'avez pas de compte ?<br/>
		                <a class="" href="inscription.php">
		                    Créer un compte
		                </a>
		            </div>
		
		        </div>
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
		                          <input type="hidden" name="typeTraitement" value="motDePasseOubliee">
		                      </div>
		                  </div>
		              </div>
		          </div>
	  	</div>
	  </div>
	     </form>  

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
    $(document).ready(function(){
    	$("#connexionId").click(function() {
			var identifiantFournisseur=$("#identifiantFournisseur").val();
			var mdpFournisseur=$("#mdpFournisseur").val();
        	if (identifiantFournisseur == "" || mdpFournisseur == "") {
				sweetAlert("Oops...", "Veuillez entrer un email et un mdp ", "error");
        		return false
            }
        });

    	$("#envoyerEmail").click(function() {
			var mailOubliee=$("#mailOubliee").val();
        	if (mailOubliee == "") {
				sweetAlert("Oops...", "Veuillez entrer un email", "error");
        		return false
            }
        });
    

    });

	<?php if ($connexionEchoue == 1) : ?>	
		sweetAlert("Oops...", "Mot de passe ou email incorrect !", "error");
	<?php endif; ?>

	<?php if ($connexionEchoue == 2) : ?>	
		sweetAlert("Oops...", "Email inexistant", "error");
	<?php endif; ?>

	<?php if ($connexionEchoue == 3) : ?>	
	sweetAlert("Good !", "Le mail est envoyé", "success");
<?php endif; ?>

	<?php if (isset($_GET["reinitialisation"]) == 1) : ?>
		sweetAlert("Good !", "Reinitialisation réussie", "success");
	<?php endif; ?>
	
           $.backstretch("assets/img/logo-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
