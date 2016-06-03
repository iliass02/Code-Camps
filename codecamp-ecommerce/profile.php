<?php
  session_start();
  if($_GET['user'] == Null) header('Location: index.php'); 
  require("_init.php");
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
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>

    <script src="assets/js/chart-master/Chart.js"></script>

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
            <a href="index.php" class="logo"><b>La Galerie Des Artisants</b></a>
            
            
            <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- inbox dropdown start-->
                <li id="header_inbox_bar" class="dropdown">
                    
                     <?php
                        if (isset($_SESSION['clientId'])) :
                        ?>
                    <a href="panier.php">
                        <i class="fa fa-shopping-cart"></i>
                       <?php 
                            $request = "SELECT * FROM commandes WHERE payer=0 AND idClient=".$_SESSION['clientId'];
                            if (!$query = mysqli_query($link, $request)){
                                header('Location: index.php');
                            }
                            $count = mysqli_num_rows($query);
                            echo '<span class="badge bg-theme">'.$count.'</span>';
                        
                        ?>
                    </a>
		<?php endif; ?>
                </li>
                <!-- inbox dropdown end -->
            </ul>
            <!--  notification end -->
        </div>
            <!--logo end-->
            
            
             <script type="text/javascript">
			function lookup(champRecherche) {
				if(champRecherche.length == 0) {
					// Masquer la boit de suggestion
					$('#suggestions').hide();
				} else {
					$('#suggestions').show();
					
					$.post("ajax.php", {typeAjax:'autocompleteHaut', champRecherche: champRecherche}, function(data){
						if(data.length > 0) {
							$('#listeSuggestions').html(data);
							$("#attenteAjax").html('');
						} else {
							$('#suggestions').hide();
						}
					});
				}
			}
		</script>
        

        	<?php if (isset($_POST["champRechercheHaut"])) $champRechercheInput = stripslashes(traiteTexte($_POST["champRechercheHaut"]));
			else $champRechercheInput = '';
			?>
      
      
      
							
      
      <form class="navbar-form navbar-left" name="form-recherche-haut" id="form-recherche-haut" role="search" method="post" action="recherche.php">
							
							<div style="position:absolute;  margin-top:33px; margin-left: -70px; padding-bottom: 150px; background-color:rgba(255,255,255,0.9); border:1px solid #cbcbcb; display:none" class="col-xs-8 col-sm-5 col-md-3 col-lg-3 col-sm-offset-1 col-md-offset-2 col-md-offset-2" id="suggestions">
				<div style="height:15px" id="attenteAjax">
				</div>
				<div id="listeSuggestions">
					&nbsp;
				</div>
			</div>
				
						
							
							<div class="input-group">
					    		<input autocomplete="off" id="champRechercheHaut" name="champRechercheHaut" type="text" class="form-control" placeholder="Nom produit" value="<?php echo $champRechercheInput?>" onkeyup="lookup(this.value);">
					    		<span class="input-group-btn">
					  				<button type="submit button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
								</span>
							</div>
						</form>
            
            <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <?php
                if (isset($_SESSION["adminId"]) || isset($_SESSION["fournisseurId"])){
                    echo '<li><a class="logout" href="logout.php">Deconnexion</a></li>';
                } else echo '<li><a class="logout" href="logout.php">Espace Admin</a></li>';
                ?>
            </ul>
        </div>
        </header>
      <!--header end-->
      <?php
        require('sidebar.php');
      ?>
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i> Profil utilisateur</h2>

<?php
if (array_key_exists('user', $_GET)) $idUser = $_GET['user'];
$query = "SELECT type, nom, prenom, mail, adresse, telephone, dateNaissance, motDePasse FROM clients WHERE id=" . $idUser;
$resultAll = mysqli_query($link, $query);
$infoUser = mysqli_fetch_assoc($resultAll);

$tabType = array(0 => "Administrateur", 1 => "Fournisseur", 2 => "Client");
$tabCat = array(1 => "Maroquinerie", 2 => "Cosmétique", 3 => "Maison");

// On recupert les infos des produits qu'on va afficher aprés avec la boucle while
$adjustMarginForAdmin = Null;
$adjustLgForUser = 6;

if ($infoUser['type'] == 0)
{
  $adjustMarginForAdmin = 'style="margin-left: 220px"';
  $adjustLgForUser = 10;
}
else if ($infoUser['type'] == 1)
{
  $query = "SELECT nomProduit, description, stock, categorie, prix, image
            FROM produits
            WHERE active = 1 AND idClient = " . $idUser . " ORDER BY date DESC LIMIT 5";
  $resultFournisseur = mysqli_query($link, $query);
  $lastRowProduit = "Stock";
  $titleTable = "Mes derniers produits";
}
else
{
  $query = "SELECT P.id, P.nomProduit, P.description, P.categorie, P.prix, P.image
            FROM commandes C
            INNER JOIN produits P ON C.idProduit = P.id
            WHERE C.payer = 2 AND C.idClient = " . $idUser;

  $resultClient = mysqli_query($link, $query);
  $lastRowProduit = "Quantité";
  $titleTable = "Mes dernières commandes";
}

echo '<h3>&nbsp&nbsp&nbsp<i class="fa fa-angle-down"></i> Identité de l\'utilisateur</h3><br />
        <div class="row">';

echo '<div class="col-xs-12 col-sm-8 col-md-6 col-lg-' . $adjustLgForUser . ' mb">
        <br />
        <div class="showback" ' . $adjustMarginForAdmin . '>
          <center>
            <p style="font-size:18px"><i>Nom - Prénom : </i>
              <span style="color: black;"><b>' . $infoUser["nom"] . '&nbsp&nbsp' . $infoUser["prenom"] .'</b></span></p>
            <hr />
            <p style="font-size:18px"><i>Type d\'utilisateur : </i>' . $tabType[$infoUser["type"]] . '</p>
            <hr />
            <p style="font-size:18px"><i>Adresse : </i>' . $infoUser["adresse"] .'</p>
            <hr />
            <p style="font-size:18px"><i>Numéro de téléphone : </i>' . $infoUser["telephone"] .'</p>
            <hr />
            <p style="font-size:18px"><i>Adresse mail : </i>' . $infoUser["mail"] .'</p>
            <hr />
            <p style="font-size:18px"><i>Date de naissance : </i>' . $infoUser["dateNaissance"] .'</p>
            <hr />
            <br />
            <div class="row">
              <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 mb">';?>
                <button type="button"
                        data-toggle="modal"
                        data-target="#myModal"
                        class="btn btn-info"
                        style="height:40px; width:95%; font-size:18px"
                        onclick='editUser("<?php echo $idUser; ?>",
                                          "<?php echo $infoUser['nom']; ?>",
                                          "<?php echo $infoUser['prenom']; ?>",
                                          "<?php echo $infoUser['adresse']; ?>",
                                          "<?php echo $infoUser['telephone']; ?>",
                                          "<?php echo $infoUser['mail']; ?>",
                                          "<?php echo $infoUser['dateNaissance']; ?>",
                                          "<?php echo $infoUser['motDePasse']; ?>")'>
                          Modifier cet utilisateur
                </button>
<?php echo    '</div>
              <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 mb">
                <form action="_traitement.php" id="formRemoveUser" method="post">
                  <input type="hidden" name="typeTraitement" value="removeUser">
                  <input type="hidden" id="idUser" name="idUser" value=' . $idUser . '>
                  <button type="button" id="rejet" name="rejet" class="btn btn-danger" style="height:40px; width:95%; font-size:18px">Supprimer cet utilisateur</button>
                </form>
              </div>
            </div>
          </div>
        </center>
      </div>';

if ($infoUser['type'] != 0)
{
  echo '<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 mb" style="margin-top:15px">
          <div class="row">
            <div class="col-md-12">
              <div class="content-panel">
                  <p style="font-size: 18px"><i class="fa fa-angle-right"></i> ' . $titleTable . '</p>
                  <hr>
                <table class="table" style="    table-layout: fixed;">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Produit</th>
                      <th>Catégorie</th>
                      <th>Description</th>
                      <th>Prix</th>
                      <th>' . $lastRowProduit . '</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>';

  if ($infoUser['type'] == 1)
  {
    $notResultProduit = True;
    while ($infoProduitUser = mysqli_fetch_assoc($resultFournisseur))
    {
      echo             '<td style="    word-wrap: break-word;"><center><img src="' . $infoProduitUser["image"] . '" style="width: 45%"></center></td>
                        <td style="    word-wrap: break-word;">' . $infoProduitUser["nomProduit"] . '</td>
                        <td style="    word-wrap: break-word;">' . $tabCat[$infoProduitUser["categorie"]] . '</td>
                        <td style="    word-wrap: break-word;">' . $infoProduitUser["description"] . '</td>
                        <td style="    word-wrap: break-word;"><center>' . $infoProduitUser["prix"] . '</center></td>
                        <td style="    word-wrap: break-word;"><center>' . $infoProduitUser["stock"] . '<center></td>
                        </tr>';
      $notResultProduit = Null;
    }

    if ($notResultProduit) echo '<td>Aucun produit trouvé !</td>
                        <td>***</td>
                        <td>***</td>
                        <td>***</td>
                        <td>***</td>
                        <td>***</td>
                        </tr>'; 
  }
  else
  {
    $notResultCommande = True;
    while ($infoProduitClient = mysqli_fetch_assoc($resultClient))
    {
      echo             '<td style="    word-wrap: break-word;"><center><img src="' . $infoProduitClient["image"] . '" style="width: 45%"></center></td>
                        <td style="    word-wrap: break-word;">' . $infoProduitClient["nomProduit"] . '</td>
                        <td style="    word-wrap: break-word;">' . $tabCat[$infoProduitClient["categorie"]] . '</td>
                        <td style="    word-wrap: break-word;">' . $infoProduitClient["description"] . '</td>
                        <td style="    word-wrap: break-word;"><center>' . $infoProduitClient["prix"] . '</center></td>
                        <td style="    word-wrap: break-word;">1<center></td>
                        </tr>';
    $notResultCommande = Null;
    }

    if ($notResultCommande)
      echo '<td>Aucune commande trouvée !</td>
            <td>***</td>
            <td>***</td>
            <td>***</td>
            <td>***</td>
            <td>***</td>
            </tr>'; 
  }

  echo             '</tbody>
                </table>';
}
echo         '</div><! --/content-panel -->
          </div><!-- /col-md-12 -->
      </div>';
?>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Modifier un utilisateur</h4>
                        </div>
                        <div class="modal-body">

                            <form role="form" method="post" action="_traitement.php" id="formModifUser">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input id="nom" type="text" class="form-control" name="nom">
                                </div>
                                <div class="form-group">
                                    <label>Prenom</label>
                                    <input id="prenom" type="text" class="form-control" name="prenom">
                                </div>
                                <div class="form-group">
                                    <label>Date de naissance</label>
                                    <input id="dateNaissance" type="text" class="form-control" name="prenom">
                                </div>
                                <div class="form-group">
                                    <label>Adresse</label>
                                    <input id="adresse" type="text" class="form-control" name="adresse">
                                </div>
                                <div class="form-group">
                                    <label>Nouveau mot de passe *</label>
                                    <input id="newMdp" type="password" class="form-control" name="newMdp">
                                </div>
                                <div class="form-group">
                                    <label>Confirmer le nouveau de passe *</label>
                                    <input id="confMdp" type="password" class="form-control" name="confMdp">
                                </div>
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input id="tel" type="number" class="form-control" name="tel">
                                </div>
                                <div class="form-group">
                                    <label>Adresse mail</label>
                                    <input id="mail" type="mail" class="form-control" name="mail">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                    <input type="hidden" name="typeTraitement" value="modifUser">
                                    <input type="hidden" name="idUser" id="idUser">
                                    <button type="submit" id="submitModifUser" class="btn btn-theme">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin Modal -->
          </div>

        </section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
            La Galerie Des Artisants
              <a href="panels.php#" class="go-top">
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
    <script src="assets/js/jquery.sparkline.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>

    <div id="divValidationRejet">
    </div>
    
    <script>


    function editUser(id, nom, prenom, adresse, tel, mail, dateNaissance, motDePasse){
      $('#idUser').val(id);
      $('#nom').val(nom);
      $('#prenom').val(prenom);
      $('#adresse').val(adresse);
      $('#tel').val(tel);
      $('#mail').val(mail);
      $('#dateNaissance').val(dateNaissance);
      $('#newMdp').val(motDePasse);
      $('#confMdp').val(motDePasse);
    }

  $(document).ready(function() {

      $("#rejet").click(function() {

        swal({
            title: "Attention",
            text: "Voulez-vous vraiment supprimer cet utilisateur ?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Fermer",
            confirmButtonColor: "#00cc00",
            confirmButtonText: "Oui",
            closeOnConfirm: false },
          function(){
              $('#formRemoveUser').submit();
            }
          );
          return false;
        });


      $("#submitModifUser").click(function() {

        var newMdp=$("#newMdp").val();
        var confMdp=$("#confMdp").val();

        if (newMdp != confMdp)
        {
            swal("Modification du mot de passe", "Les deux mots de passe sont différents", "error");
            return false;
        }
        else
        {
          swal({
              title: "Attention",
              text: "Voulez-vous vraiment modifier cet utilisateur ?",
              type: "warning",
              showCancelButton: true,
              cancelButtonText: "Fermer",
              confirmButtonColor: "#00cc00",
              confirmButtonText: "Oui",
              closeOnConfirm: false },
            function(){
                $('#formModifUser').submit();
              }
          );
          return false;
        }
      });
    });
  </script>
    
    
    
  </body>
</html>
