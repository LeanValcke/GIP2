<?php require('config.php');
$catprod1="";
$catprod2="";
$catprod3="";
$prod1="";
$prod2="";
$prod3="";
$sqllll ="SELECT GameID, ProductID,  Gamenaam, Productprijs, foto, Merchnaam FROM tblproduct  ORDER BY ProductID DESC LIMIT 1";
$eerstemerch =$dbh->query($sqllll);
foreach($eerstemerch as $p1)
{
$catprod1 = $p1['GameID'];
$prod1 =$p1['ProductID'];
}
$sqlll ="SELECT GameID, ProductID,  Gamenaam, Productprijs, foto, Merchnaam FROM tblproduct where GameID != $catprod1  ORDER BY ProductID DESC LIMIT 1";
$tweedemerch =$dbh->query($sqlll);
foreach($tweedemerch as $p2)
{
$catprod2 = $p2['GameID'];
$prod2 = $p2['ProductID'];
}
$sqll ="SELECT GameID, ProductID,  Gamenaam, Productprijs, foto, Merchnaam FROM tblproduct where GameID != $catprod1 && GameID != $catprod2  ORDER BY ProductID DESC LIMIT 1";
$derdemerch =$dbh->query($sqll);
foreach($derdemerch as $p3)
{
$catprod3 = $p3['GameID'];
$prod3 = $p3['ProductID'];
}
$sql ="SELECT GameID, ProductID,  Gamenaam, Productprijs, foto, Merchnaam FROM tblproduct where ProductID = $prod1 || ProductID = $prod2 || ProductID =$prod3  ORDER BY ProductID DESC ";
$nieuweproducten =$dbh->query($sql);
?>



<html>
    <head>
        <title>DVP</title>
        <link rel = "icon" href ="img/Icon/DVP.png"  > 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="img/favicon.ico" rel="shortcut icon"/>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <link rel="stylesheet" href="css/owl.carousel.min.css"/>
        <link rel="stylesheet" href="css/flaticon.css"/>
        <link rel="stylesheet" href="css/slicknav.min.css"/>
        <link rel="stylesheet" href="css/style.css"/>

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.slicknav.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/main.js"></script>
       
    </head>
    <body>
         
    <?php $page='index'; require ('Includes/navbar.php'); ?>
    

	<!-- Header Section end -->

	<!-- Hero Section end -->
    
	<section class="hero-section">
		<!--<div class="container">
			
		</div>-->
		<div class="hero-slider owl-carousel">
            <?php foreach($nieuweproducten as $nieuwproduct)
{ ?>
			<div class="hs-item set-bg" ><img src="img/<?php echo $nieuwproduct['foto']; ?>"></div>
			<?php } 
            $nieuweproducten =$dbh->query($sql);
            ?>
		</div>
            <section class="promotie-tekst"> 
              <strong><h4>Goed nieuws! <br> Er zijn nieuwe producten!</h4></strong>
        <ul>
            <?php foreach($nieuweproducten as $nieuwproduct )
{ ?>
              <img src="img/Icon/icon.png"><li><?php echo $nieuwproduct['Merchnaam']; ?> </li>
                
            <div class="lettergroote">
               Deze <?php echo $nieuwproduct['Merchnaam']; ?> uit de categorie <?php echo $nieuwproduct['Gamenaam']; ?> <br> is nieuw
 en kost  maar <?php echo "€".$nieuwproduct['Productprijs']; ?>
            </div>
                <?php } ?>
               
        </ul> 
              <p>
            </p>
        </section>
	</section>
    
	<!-- Hero Section end -->
   

	<!-- Why Section -->

        <div class="onder-index"  >
			     <div class="text-center mb-5 pb-4">
				    <h2>Waarom ons kiezen?</h2>
			     </div>
            
	   <div class="onder-index-grid">
        
				<div class="keuze-box" >
					<div class="icon-box-item" style="margin-bottom:15%;" >
						<div class="ib-text">
                            <div class="ib-icon"  >
							<i class="flaticon-012-24-hours"></i>
						    </div>
                           
							<h5>Levering</h5>
                           <div class="onder-index-midden-text">
							Als u voor 19u heeft besteld, heeft u uw pakketje de volgende dag al in huis!
                            </div>
						</div>
					</div>
				</div>
            
        <div class="keuze-box">
            <div class="icon-box-item">
						
				    <div class="ib-text" >
                        <div class="ib-icon">
							<i class="flaticon-036-customer-service"></i>
				        </div>
							<h5>Klantenservice</h5>
                        <div class="onder-index-midden-text">
							Heeft u een probleem of een vraag?
                            <br>Wij zijn hier om u te helpen!
                            <br>24/24 en 7/7 beschikbaar
                            <br> <a href="faq/contact.php">Contacteer ons </a>
                        </div>
				    </div>
            </div>
        </div>
    </div>
</div>

	<?php require('Includes/footer.php');?>

    </body>
    <script src="js/main.js"></script>
    </html>


	

