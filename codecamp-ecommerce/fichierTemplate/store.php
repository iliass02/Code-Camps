<?php
session_start();
include("../_init.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Galerie des Artisans - Store</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/jquery.js"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" >
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="#" class="logo"><b>La Galerie des Artisans</b></a>
        <!--logo end-->

        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <?php
                if(isset($_SESSION["adminId"]) || isset($_SESSION["fournisseurId"])){
                    echo '<li><a class="logout" href="logout.php">Deconnexion</a></li>';
                }
                ?>
            </ul>
        </div>
    </header>
    <!--header end-->

    <?php require('../sidebar.php'); ?>

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <?php if(isset($_GET['categorie'])) { ?>
            <?php if($_GET['categorie'] == 1) { ?>
            <h3><i class="fa fa-angle-right"></i> Maroquinerie</h3>
            <hr>
            <div class="row mt">

                <?php
                $request = "SELECT p.*, c.nom, c.prenom FROM produits as p, clients as c WHERE active = 1 AND c.id = p.idClient AND categorie =".$_GET['categorie'];
                $query = mysqli_query($link, $request);

                if(mysqli_num_rows($query) == 0){
                    echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">';
                    echo '<h4> Aucun produit trouvé</h4>';
                    echo '</div>';
                }

                while($row = mysqli_fetch_assoc($query)) {
                    $nomProduit = $row['nomProduit'];
                    $id = $row['id'];
                    $prix = $row['prix'];
                    $image = $row['image'];
                    $nom = $row['nom'];
                    $prenom = $row['prenom'];
                    $categorie = $row['categorie'];


                    ?>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
                        <div class="project-wrapper">
                            <div class="project" style="    margin: 30px;">
                                <div class="photo-wrapper">
                                    <div class="photo">
                                        <form action="ficheProduit.php" method="POST">
                                            <?php
                                            echo '<input type="hidden" name="categorie" value="'.$categorie.'">';
                                            echo '<input type="hidden" name="idProduit" value="'.$id.'">';
                                            echo '<input type="image" class="img-responsive" src="'.$image.'" alt="submit">';
                                            ?>
                                        </form>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                                <h4><?php echo $nomProduit; ?></h4>
                                <h5>Par : <?php echo $nom.' '.$prenom; ?></h5>
                                <hr>
                                <h4>Prix : <span style="color: #68dff0"><?php echo $prix; ?> €</span></h4>
                                <a style="color: #ffd777"><i class="fa fa-shopping-cart fa-2x pull-left"></i></a>
                            </div>
                        </div>
                    </div><!-- col-lg-4 -->
                <?php } ?>

            </div><!-- /row -->

            <?php } elseif ($_GET['categorie'] == 2) { ?>
            <h3><i class="fa fa-angle-right"></i> Cosmétique</h3>
            <hr>
            <div class="row mt">

                <?php
                $request = "SELECT p.*, c.nom, c.prenom FROM produits as p, clients as c WHERE active = 1 AND c.id = p.idClient AND categorie =".$_GET['categorie'];
                $query = mysqli_query($link, $request);

                if(mysqli_num_rows($query) == 0){
                    echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">';
                    echo '<h4> Aucun produit trouvé</h4>';
                    echo '</div>';
                }

                while($row = mysqli_fetch_assoc($query)) {
                    $nomProduit = $row['nomProduit'];
                    $id = $row['id'];
                    $prix = $row['prix'];
                    $image = $row['image'];
                    $nom = $row['nom'];
                    $prenom = $row['prenom'];
                    $categorie = $row['categorie'];


                    ?>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
                        <div class="project-wrapper">
                            <div class="project" style="    margin: 30px;">
                                <div class="photo-wrapper">
                                    <div class="photo">
                                        <form action="ficheProduit.php" method="POST">
                                            <?php
                                            echo '<input type="hidden" name="categorie" value="'.$categorie.'">';
                                            echo '<input type="hidden" name="idProduit" value="'.$id.'">';
                                            echo '<input type="image" class="img-responsive" src="'.$image.'" alt="submit">';
                                            ?>
                                        </form>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                                <h4><?php echo $nomProduit; ?></h4>
                                <h5>Par : <?php echo $nom.' '.$prenom; ?></h5>
                                <hr>
                                <h4>Prix : <span style="color: #68dff0"><?php echo $prix; ?> €</span></h4>
                                <a style="color: #ffd777"><i class="fa fa-shopping-cart fa-2x pull-left"></i></a>
                            </div>
                        </div>
                    </div><!-- col-lg-4 -->
                <?php } ?>

            </div><!-- /row -->

            <?php } elseif ($_GET['categorie'] == 3) { ?>
            <h3><i class="fa fa-angle-right"></i> Maison</h3>
            <hr>
            <div class="row mt">


                <?php
                $request = "SELECT p.*, c.nom, c.prenom FROM produits as p, clients as c WHERE active = 1 AND c.id = p.idClient AND categorie =".$_GET['categorie'];
                $query = mysqli_query($link, $request);

                if(mysqli_num_rows($query) == 0){
                    echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">';
                    echo '<h4> Aucun produit trouvé</h4>';
                    echo '</div>';
                }

                while($row = mysqli_fetch_assoc($query)) {
                    $nomProduit = $row['nomProduit'];
                    $id = $row['id'];
                    $prix = $row['prix'];
                    $image = $row['image'];
                    $nom = $row['nom'];
                    $prenom = $row['prenom'];
                    $categorie = $row['categorie'];


                    ?>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
                        <div class="project-wrapper">
                            <div class="project" style="    margin: 30px;">
                                <div class="photo-wrapper">
                                    <div class="photo">
                                        <form action="ficheProduit.php" method="POST">
                                            <?php
                                            echo '<input type="hidden" name="categorie" value="'.$categorie.'">';
                                            echo '<input type="hidden" name="idProduit" value="'.$id.'">';
                                            echo '<input type="image" class="img-responsive" src="'.$image.'" alt="submit">';
                                            ?>
                                        </form>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                                <h4><?php echo $nomProduit; ?></h4>
                                <h5>Par : <?php echo $nom.' '.$prenom; ?></h5>
                                <hr>
                                <h4>Prix : <span style="color: #68dff0"><?php echo $prix; ?> €</span></h4>
                                <a style="color: #ffd777"><i class="fa fa-shopping-cart fa-2x pull-left"></i></a>
                            </div>
                        </div>
                    </div><!-- col-lg-4 -->
                <?php } ?>

            </div><!-- /row -->
            <?php } } else { ?>
            <h3><i class="fa fa-angle-right"></i> Auncun produit trouvé</h3>
            <?php } ?>

        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2016 - La Galerie des Artisans
        </div>
    </footer>
    <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/fancybox/jquery.fancybox.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<!--script for this page-->

<script type="text/javascript">
    $(function() {
        //    fancybox
        jQuery(".fancybox").fancybox();
    });

</script>

<script>
    //custom select box

    $(function(){
        $("select.styled").customSelect();
    });

</script>

</body>
</html>
