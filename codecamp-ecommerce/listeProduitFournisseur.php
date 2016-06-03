<?php
session_start();
require('_init.php');

if(!$_SESSION['fournisseurId']) header('Location: login.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans - Liste produit fournisseur</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css"/>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

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
                <li><a class="logout" href="logout.php">Deconnexion</a></li>
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
            <h3><i class="fa fa-angle-right"></i> Mes produits</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i>Liste de mes produits</h4>
                            <hr>
                            <thead>
                            <tr>
                                <th>Nom produit</th>
                                <th class="hidden-phone">Description</th>
                                <th>Prix</th>
                                <th>Status</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php

                                    /*
                                     * CHANGER ID
                                     */
                                    $request = "SELECT
                                                p.id,
                                                p.nomProduit,
                                                p.description,
                                                p.prix,
                                                p.active,
                                                p.stock,
                                                p.categorie
                                            FROM
                                                produits as p,
                                                clients as c
                                            WHERE
                                                p.idClient = c.id
                                            AND
                                                c.id = ".$_SESSION['fournisseurId'];


                                    $query = mysqli_query($link, $request);
                                    while($row = mysqli_fetch_assoc($query)) {
                                        echo '<tr>';
                                        echo '<td>'.$row['nomProduit'].'</td>';
                                        echo '<td>'.$row['description'].'</td>';
                                        echo '<td>'.$row['prix'].'</td>';
                                        if ($row['active'] == 2) {
                                            echo '<td><span class="label label-warning">En cours de validation</span></td>';
                                        } elseif ($row['active'] == 1) {
                                            echo '<td><span class="label label-success">En ligne</span></td>';
                                        } else {
                                            echo '<td><span class="label label-danger">Refuser</span></td>';
                                        }
                                        echo '<td>'.$row['stock'].'</td>';
                                        echo '<form action="_traitement.php" id="formRemoveProduit" method="post">';
                                        echo '<input type="hidden" name="typeTraitement" value="removeProduit">';
                                        $id = $row['id'];
                                        echo '<input type="hidden" name="idProduit" value='."$id".'>';
                                        echo '<td><button class="btn btn-danger btn-xs" type="submit" ><i class="fa fa-trash-o" id="removeProduit"></i></button></td>';
                                        echo '</form>';?>
                                        <td>
                                            <button class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModal' onclick='editProduit("<?php echo $row['id']; ?>", "<?php echo $row['nomProduit']; ?>", "<?php echo preg_replace( "/\r|\n/", "", $row['description'] ); ?>", "<?php echo $row['prix']; ?>", <?php echo $row['stock']; ?>, <?php echo $row['categorie']; ?>)'><i class='fa fa-pencil'></i></button>
                                        </td>
                                         <?php   echo '</tr>';
                                    }
                                ?>
                            </tr>
                            </tbody>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Modifier un Produit</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form role="form" method="post" action="_traitement.php" id="formModifProduit">
                                            <div class="form-group">
                                                <label>Nom du produit *</label>
                                                <input id="nomProduit" type="text" class="form-control" name="nomProduit">
                                            </div>
                                            <div class="form-group">
                                                <label>Description *</label>
                                                <textarea id="description" class="form-control" rows="4" cols="50" name="description"> </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Prix *</label>
                                                <input id="prix" type="number" class="form-control" name="prix">
                                            </div>
                                            <div class="form-group">
                                                <label>Categorie *</label>
                                                <select id="categorie" class="form-control" name="categorie">
                                                    <option value="1">Maroquinerie</option>
                                                    <option value="2">Cosmétique</option>
                                                    <option value="3">Maison</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Stock *</label>
                                                <input id="stock" type="number" class="form-control" name="stock">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                <input type="hidden" name="typeTraitement" value="modifProduit">
                                                <input type="hidden" name="idProduit" id="idProduit">
                                                <button type="submit" id="submitModifProduit" class="btn btn-theme">Modifier</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
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
    <!--main content end-->
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

<script>
    //custom select box

    <?php
    if(isset($_GET['success'])) {
    if($_GET['success'] == '1') { ?>
    swal("Modification Produit", "La modification du produit a bien été prise en compte", "success");
    <?php }
    } if (isset($_GET['error'])) {
    if($_GET['error'] == '1') { ?>
    swal("Erreur", "Impossible de modifier le produit, réessayer plus tard", "error");
    <?php }
    }?>

    $(document).ready(function() {


        $(function(){
            $('select.styled').customSelect();
        });
    });

    function editProduit(id, nomProduit, description, prix, stock, categorie){
        $('#nomProduit').val(nomProduit);
        $('#description').val(description);
        $('#prix').val(prix);
        $('#stock').val(stock);
        $('#categorie').val(categorie)
        $('#idProduit').val(id);
    }

    $('#submitModifProduit').click(function(){
        swal({
                title: "Fournisseur",
                text: "Modifier ce produit ?!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Fermer",
                confirmButtonColor: "#00cc00",
                confirmButtonText: "Oui",
                closeOnConfirm: false },
            function(){
                $('#formModifProduit').submit();
            }
        );
        return false;
    });




</script>

</body>
</html>
