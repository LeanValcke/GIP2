<?php require('../config.php'); 
$matenid = $_GET['ProductID'];
$sql = "SELECT ProductID, ProductPrijs, ProductAantal, Gamenaam, Merchnaam, GameID, foto, Beschrijving FROM tblproduct WHERE ProductID = $matenid ";	
$teller=0;
$merchproducten =$dbh->query($sql);
$matentabel = "SELECT ProductID, Maat  FROM tblmaat WHERE ProductID = $matenid order by Maat DESC";
$maten =$dbh->query($matentabel);
 foreach($maten as $maat){ 
$teller +=1; 
 }
$maten =$dbh->query($matentabel);
$gproducten ="";
$hidden = "hidden";
if ($teller >0 )
{$hidden = "visible";}
?>

<html>
   <head>
         <title>Merchproduct</title>
            <link rel = "icon" href ="../img/Icon/DVP.png"> 
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <link href="img/favicon.ico" rel="shortcut icon"/>

            <!-- Google font -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

            <!-- Stylesheets -->
            <link rel="stylesheet" href="../css/bootstrap.min.css"/>
            <link rel="stylesheet" href="../css/font-awesome.min.css"/>
            <link rel="stylesheet" href="../css/owl.carousel.min.css"/>
            <link rel="stylesheet" href="../css/flaticon.css"/>
            <link rel="stylesheet" href="../css/slicknav.min.css"/>
            <link rel="stylesheet" href="../css/style.css"/>

            <script src="../js/jquery-3.2.1.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/jquery.slicknav.min.js"></script>
            <script src="../js/owl.carousel.min.js"></script>
            <script src="../js/jquery-ui.min.js"></script>
            <script src="../js/main.js"></script>

    </head>
    <body style="background-color:white;">
        
      <?php $page=''; require('../Includes/navbar.php'); ?>
        
        <div class="midden">
            <br>
            <main class="container">
        <?php require( SITE_DIR.'../Includes/error.php' ); ?>
        </main>
        <?php foreach($merchproducten as $merchproduct) 
            {
           
                $gproducten = $merchproduct['GameID'];
              
            ?>
            <div class="product-grid">
       
            <img src="<?php echo(SITE_URL); ?>/img/<?php echo $merchproduct['foto']; ?>">
        
                <div class="Merch-TextBox ">
            <form method="post" action="<?php echo SITE_URL; ?>/Winkelkar/toevoegen.php?ProductID=<?php echo $merchproduct["ProductID"] ?>">
                    <div class="Merch-Textbox-titel" >
                    <h2><?php echo $merchproduct['Merchnaam']; ?></h2>
                    <h3> €<?php echo $merchproduct['ProductPrijs']; ?></h3>
                    <hr>
                    </div>
                <div class="Merch-Textbox-midden" >
                    <h5> <?php echo $merchproduct['Beschrijving']; ?></h5>
              
                <h3 style="visibility: <?php echo $hidden ?>">Selecteer uw maat</h3>
                 <?php if ($teller >0 )
            { ?>
                   <select name="GekozenMaat" required>
                  <option value="">Maat kiezen</option>
                     <?php foreach($maten as $maat) 
             
            { ?>
                  
                <option value="<?php echo $maat['Maat']; ?>"><?php echo $maat['Maat']; ?></option>
                    
                    <?php }  ?>
                  
                       </select>
                      <?php }  ?>
                <hr >
                    
                </div>
           
             <?php $checkoutid = $merchproduct['Beschrijving']; ?>
                
                <div class="Merch-Textbox-einde" >
           
            <button type="submit" class="btn btn-warning btn-sm"  style="background-color:red; border:none;" 
                >Winkelmand</button>
              <button type="submit" name="Sub" class="btn btn-warning btn-sm" role="button" style="background-color:black; border:none;" href="<?php echo SITE_URL; ?>/Winkelkar/checkouttoevoegen.php?ProductID=<?php echo $merchproduct["ProductID"] ?>" >Checkout</button>
                     
                </div>  
                </form>
            </div>
        </div>
         
        <?php 
}
    $sql = "SELECT ProductID, ProductPrijs, ProductAantal, Gamenaam, Merchnaam, GameID, foto, Beschrijving FROM tblproduct WHERE GameID = $gproducten && ProductID != $matenid order by GameID desc limit 2";        
            ?>  
          
           <div class="gproducten" > <h2>Gerelateerde producten</h2>
             <?php  $merchproducten =$dbh->query($sql); foreach($merchproducten as $merchproduct)  { ?>
            
    
        
            <div class="gproducten-box">
            <img src="<?php echo(SITE_URL); ?>/img/<?php echo $merchproduct['foto']; ?>">
              <a href="<?php echo(SITE_URL); ?>/merch/merchpagina.php?ProductID=<?php echo $merchproduct['ProductID']?>">  <h4><?php echo $merchproduct['Merchnaam']; ?></h4> </a>
            </div>
          
        <?php } ?>
            </div>
        </div>
 </body>

<script src="../js/main.js"></script>
</html>