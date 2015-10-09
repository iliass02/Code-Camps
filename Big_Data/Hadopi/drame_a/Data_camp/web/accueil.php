<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Web Stream</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--Animation-->
<script src="js/wow.min.js"></script>
<link href="css/animate.css" rel='stylesheet' type='text/css' />
<script>
	new WOW().init();
</script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
</head>
<body>
    <!-- header-section-starts -->
	<div class="header">
		<div class="container">
			<div class="top-header">
				<div class="logo">
					<a href="accueil.php"><img src="images/logo.png" class="img-responsive" alt="" /></a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
			<div class="menu-bar">
			<div class="container">
				<div class="top-menu">
					<ul>
						<li><a href="acceuil.php">Accueil</a></li>|
						<li><a href="film.php">Films</a></li>|
						<li><a href="serie.php">Séries</a></li>|
						<li><a href="anime.php">Animés</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="login-section">
					<ul>
						<li><a href="form.php">Suggestions</a>  </li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		</div>

		</div>
		<div class="banner wow fadeInUp" data-wow-delay="0.4s" id="Home">
		    <div class="container">
				<div class="banner-info">
					<div class="banner-info-head text-center wow fadeInLeft" data-wow-delay="0.5s">
						<div class="line">
							<h2>Web Stream</h2>
						</div>
					</div>
					<div class="form-list wow fadeInRight" data-wow-delay="0.5s">
						<form action="recherche.php" method="POST">
				           	<center><input type="text" name="film" class="text" placeholder="Recherche Film Série Animé"/></center>
				        </form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- header-section-ends -->
	<!-- content-section-starts -->
	<div class="content">
		
		<div class="special-offers-section">
			<div class="container">
				<div class="special-offers-section-head text-center dotted-line">
					<h4>Notre Sélection</h4>
				</div>
				<div class="special-offers-section-grids">
				 <div class="m_3"><span class="middle-dotted-line"> </span> </div>
				   <div class="container">
					  <ul id="flexiselDemo3">
						<li>
							<div class="offer">
								<div class="offer-image">	
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid = 4858;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
						            echo "<script>$('img:eq(1)').attr('class', 'img-responsive')</script>";
									?>
								</div>
								<div class="offer-text">
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid= 4858;
									echo "<h4>".$xml->Video[$vid]->Title."</h4>";
									echo "<p>".$xml->Video[$vid]->Format."</p>";
									echo "<p>".$xml->Video[$vid]->PublicationDate."</p>";
									echo "<a href='".$xml->Video[$vid]->URL."'><input type='button' value='".$xml->Video[$vid]->VODPlatform."'></a>";
									?>
								</div>
								
								<div class="clearfix"></div>
								</div>
					    </li>
					    <li>
							<div class="offer">
								<div class="offer-image">	
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid = 4859;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
						            echo "<script>$('img:eq(2)').attr('class', 'img-responsive')</script>";
									?>
								</div>
								<div class="offer-text">
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid= 4859;
									echo "<h4>".$xml->Video[$vid]->Title."</h4>";
									echo "<p>".$xml->Video[$vid]->Format."</p>";
									echo "<p>".$xml->Video[$vid]->PublicationDate."</p>";
									echo "<a href='".$xml->Video[$vid]->URL."'><input type='button' value='".$xml->Video[$vid]->VODPlatform."'></a>";
									?>
								</div>
								
								<div class="clearfix"></div>
								</div>
					    </li>
					    <li>
							<div class="offer">
								<div class="offer-image">	
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid = 4466;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
						            echo "<script>$('img:eq(3)').attr('class', 'img-responsive')</script>";
									?>
								</div>
								<div class="offer-text">
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid= 4466;
									echo "<h4>".$xml->Video[$vid]->Title."</h4>";
									echo "<p>".$xml->Video[$vid]->Format."</p>";
									echo "<p>".$xml->Video[$vid]->PublicationDate."</p>";
									echo "<a href='".$xml->Video[$vid]->URL."'><input type='button' value='".$xml->Video[$vid]->VODPlatform."'></a>";
									?>
								</div>
								
								<div class="clearfix"></div>
								</div>
					    </li>
					    <li>
							<div class="offer">
								<div class="offer-image">	
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid = 7862;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
						            echo "<script>$('img:eq(4)').attr('class', 'img-responsive')</script>";
									?>
								</div>
								<div class="offer-text">
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid= 7862;
									echo "<h4>".$xml->Video[$vid]->Title."</h4>";
									echo "<p>".$xml->Video[$vid]->Format."</p>";
									echo "<p>".$xml->Video[$vid]->PublicationDate."</p>";
									echo "<a href='".$xml->Video[$vid]->URL."'><input type='button' value='".$xml->Video[$vid]->VODPlatform."'></a>";
									?>
								</div>

								
								<div class="clearfix"></div>
								</div>
					    </li>
					    <li>
							<div class="offer">
								<div class="offer-image">	
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid = 7807;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
						            echo "<script>$('img:eq(5)').attr('class', 'img-responsive')</script>";
									?>
								</div>
								<div class="offer-text">
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid= 7807;
									echo "<h4>".$xml->Video[$vid]->Title."</h4>";
									echo "<p>".$xml->Video[$vid]->Format."</p>";
									echo "<p>".$xml->Video[$vid]->PublicationDate."</p>";
									echo "<a href='".$xml->Video[$vid]->URL."'><input type='button' value='".$xml->Video[$vid]->VODPlatform."'></a>";
									?>
								</div>
								
								
								<div class="clearfix"></div>
								</div>
					    </li>
					    <li>
							<div class="offer">
								<div class="offer-image">	
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid = 7161;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
						            echo "<script>$('img:eq(6)').attr('class', 'img-responsive')</script>";
									?>
								</div>
								<div class="offer-text">
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid= 7161;
									echo "<h4>".$xml->Video[$vid]->Title."</h4>";
									echo "<p>".$xml->Video[$vid]->Format."</p>";
									echo "<p>".$xml->Video[$vid]->PublicationDate."</p>";
									echo "<a href='".$xml->Video[$vid]->URL."'><input type='button' value='".$xml->Video[$vid]->VODPlatform."'></a>";
									?>
								</div>
								
								
								<div class="clearfix"></div>
								</div>
					    </li>
					    <li>
							<div class="offer">
								<div class="offer-image">	
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid = 7069;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
						            echo "<script>$('img:eq(7)').attr('class', 'img-responsive')</script>";
									?>
								</div>
								<div class="offer-text">
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid= 7069;
									echo "<h4>".$xml->Video[$vid]->Title."</h4>";
									echo "<p>".$xml->Video[$vid]->Format."</p>";
									echo "<p>".$xml->Video[$vid]->PublicationDate."</p>";
									echo "<a href='".$xml->Video[$vid]->URL."'><input type='button' value='".$xml->Video[$vid]->VODPlatform."'></a>";
									?>
								</div>
								
								
								<div class="clearfix"></div>
								</div>
					    </li>
				    <li>
							<div class="offer">
								<div class="offer-image">	
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid = 7000;
						            echo "<a href = ".$xml->Video[$vid]->URL."><img src='".$xml->Video[$vid]->URLPhoto."'/></a>";
						            echo "<script>$('img:eq(8)').attr('class', 'img-responsive')</script>";
									?>
								</div>
								<div class="offer-text">
									<?php
									$xml = simplexml_load_file('bdd.xml');
									$vid= 7000;
									echo "<h4>".$xml->Video[$vid]->Title."</h4>";
									echo "<p>".$xml->Video[$vid]->Format."</p>";
									echo "<p>".$xml->Video[$vid]->PublicationDate."</p>";
									echo "<a href='".$xml->Video[$vid]->URL."'><input type='button' value='".$xml->Video[$vid]->VODPlatform."'></a>";
									?>
								</div>
								
								
								<div class="clearfix"></div>
								</div>
					    </li>
					 </ul>
				 <script type="text/javascript">
					$(window).load(function() {
						
						$("#flexiselDemo3").flexisel({
							visibleItems: 3,
							animationSpeed: 1000,
							autoPlay: false,
							autoPlaySpeed: 3000,
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: { 
								portrait: { 
									changePoint:480,
									visibleItems: 1
								}, 
								landscape: { 
									changePoint:640,
									visibleItems: 2
								},
								tablet: { 
									changePoint:768,
									visibleItems: 3
								}
							}
						});
						
					});
				    </script>
				    <script type="text/javascript" src="js/jquery.flexisel.js"></script>
				</div>
			</div>
		</div>
		</div>


<div class="service-section-bottom-row">
				<div class="container">
					<div class="col-md-4 service-section-bottom-grid wow bounceIn "data-wow-delay="0.2s">
						<div class="icon">
							<img src="images/icon1.jpg" class="img-responsive" alt="" />
						</div>
						<div class="icon-data">
							<h4>Etna</h4>
							<p>École des Technologies Numériques Appliquées</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-4 service-section-bottom-grid wow bounceIn "data-wow-delay="0.2s">
						<div class="icon">
							<img src="images/icon2.jpg" class="img-responsive" alt="" />
						</div>
						<div class="icon-data">
							<h4>Hadopi</h4>
							<p>La Haute Autorité pour la Diffusion des Oeuvres et la Protection des droits sur Internet </p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-4 service-section-bottom-grid wow bounceIn "data-wow-delay="0.2s">
						<div class="icon">
							<img src="images/icon3.jpg" class="img-responsive" alt="" />
						</div>
						<div class="icon-data">
							<h4>Code Camp</h4>
							<p>Les Code Camps représentent un système d'apprentissage unique et innovant</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>


		<div class="contact-section" id="contact">
			<div class="container">
				<div class="contact-section-grids">
					<div class="col-md-3 contact-section-grid wow fadeInLeft" data-wow-delay="0.4s">
						<h4>Catégories</h4>
						<ul>
							<li><i class="point"></i></li>
							<li class="data"><a href="index.php">Accueil</a></li>
						</ul>
						<ul>
							<li><i class="point"></i></li>
							<li class="data"><a href="film.php">Films</a></li>
						</ul>
						<ul>
							<li><i class="point"></i></li>
							<li class="data"><a href="#">Séries</a></li>
						</ul>
						<ul>
							<li><i class="point"></i></li>
							<li class="data"><a href="animé.php">Animés</a></li>
						</ul>
					</div>
					<div class="col-md-3 contact-section-grid wow fadeInRight" data-wow-delay="0.4s">
						<h4>Contactez-nous</h4>
						<ul>
							<li><i class="in"></i></li>
							<li class="data"><a href="https://www.linkedin.com/in/iliassmarchoud" target="blank"> Linkedin Iliass</a></li>
						</ul>
						<ul>
							<li><i class="in"></i></li>
							<li class="data"><a href="https://www.linkedin.com/in/ahamadoudrame" target="blank"> Linkedin Ahamadou</a></li>
						</ul>
						<ul>
							<li><i class="in"></i></li>
							<li class="data"><a href="https://www.linkedin.com/in/faouzikridagh" target="blank"> Linkedin Faouzi</a></li>
						</ul>
						<ul>
							<li><i class="in"></i></li>
							<li class="data"><a href="https://www.linkedin.com/in/anthonycadet" target="blank"> Linkedin Anthony</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-section-ends -->
	<!-- footer-section-starts -->
	<!-- footer-section-ends -->
	  <script type="text/javascript">
						$(document).ready(function() {
							/*
							var defaults = {
					  			containerID: 'toTop', // fading element id
								containerHoverID: 'toTopHover', // fading element hover id
								scrollSpeed: 1200,
								easingType: 'linear' 
					 		};
							*/
							
							$().UItoTop({ easingType: 'easeOutQuart' });
							
						});
					</script>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

</body>
</html>