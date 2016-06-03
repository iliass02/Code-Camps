
<!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href=""><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
            <?php
                if (isset($_SESSION['adminId'])) {
                   $query = 'SELECT nom, prenom FROM clients WHERE id='.$_SESSION['adminId'];
                } elseif (isset($_SESSION['fournisseurId'])) {
                    $query = 'SELECT nom, prenom FROM clients WHERE id='.$_SESSION['fournisseurId'];
                } elseif (isset($_SESSION['clientId']) || $_SESSION['clientId'] < 500) {
                    $query = 'SELECT nom, prenom FROM clients WHERE id='.$_SESSION['clientId'];
                }

                if (isset($query)) {
                    if(!$request = mysqli_query($link, $query)){
                        header('Location: login.php');
                    }
                    $row = mysqli_fetch_row($request);
                    echo '<h5 class="centered">'.$row[0].' '.$row[1].'</h5>';
                } else {
                    echo '<h5 class="centered">'.$nom.'<h5>';
                }
            ?>


            <?php if (isset($_SESSION['clientId'])) { ?>

                <?php  if ($_SESSION['clientId'] > 500) { ?>

                    <li class="mt">
                        <a href="loginClient.php">
                            <i class="fa fa-dashboard"></i>
                            <span>Connexion</span>
                        </a>
                    </li>
                    <?php
                }
            } ?>

            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-shopping-cart"></i>
                    <span>Store</span>
                </a>
                <ul class="sub">
                    <li><a  href="index.php?categorie=1">Maroquinerie</a></li>
                    <li><a  href="index.php?categorie=2">Cosmétique</a></li>
                    <li><a  href="index.php?categorie=3">Maison</a></li>
                </ul>
            </li>

            <?php if (isset($_SESSION['fournisseurId'])) { $idUser = $_SESSION['fournisseurId'];?>
                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-desktop"></i>
                        <span>Espace Fournisseur</span>
                    </a>
                    <ul class="sub">
                        <?php echo '<li><a href="profile.php?user=' . $idUser . '">Mon profil</a></li>';?>
                        <li><a  href="ajoutProduit.php">Ajouter un Produit</a></li>
                        <li><a  href="listeProduitFournisseur.php">Mes Produits</a></li>
                        <li><a  href="mesFactures.php">Mes factures</a></li>
                        <li><a  href="commandes.php">Mes Commandes</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (isset($_SESSION['adminId'])) { $idUser = $_SESSION['adminId'];?>
                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-desktop"></i>
                        <span>Espace Validation</span>
                    </a>
                    <ul class="sub">
                        <?php echo '<li><a href="profile.php?user=' . $idUser . '">Mon profil</a></li>';?>
                        <li><a href="produitAValider.php">Produit à Valider</a></li>
                        <li><a  href="mesFactures.php">Mes factures</a></li>
                        <li><a  href="statistique.php">Statistique</a></li>
                    </ul>
                </li>
            <?php } ?>


            <?php if (isset($_SESSION['clientId'])) { ?>

                <?php  if ($_SESSION['clientId'] < 500) { ?>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-desktop"></i>
                            <span>Espace Client</span>
                        </a>
                        <ul class="sub">
                            <?php echo '<li><a href="profile.php?user=' . $_SESSION['clientId'] . '">Mon profil</a></li>';?>
                            <li><a href="commandes.php">Mes commandes</a></li>
                            <li><a href="logoutClient.php">Deconnexion</a></li>
                        </ul>
                    </li>
               <?php
                }
            } ?>




        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->