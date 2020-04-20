<?php require('../config.php'); ?>

<?php
//connectie
$sql = "SELECT BonID, Datum, Aantal FROM tblbestelling";
$bestellingen = $dbh->query($sql);
?>
<html>
    <head>
        <title>Gegevens</title>
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
    <body style="background-color:white;">  <div class="midden" > 
        <?php $page='inlog'; require('../Includes/navbar.php');  ?> 
           
                <?php if( $_SESSION['IS_ADMIN'] ) { ?>
                <nav class="header-nav" style="background:black; color:white;" >
                    <a>BEHEER:</a>
                    <ul class="main-menu">
                        <li>
                            <a class="<?php if ($page=='Bestellingen'){echo 'active';}?>" href="<?php echo SITE_URL; ?>/admin/bestellingen/index.php">Bestellingen</a>
                        </li>
                        <li>
                            <a class="<?php if ($page=='gebruikers'){echo 'active';}?>" href="<?php echo SITE_URL; ?>/admin/gebruikers/index.php">Gebruikers</a>
                        </li>
                        <li>
                            <a class="<?php if ($page=='producten'){echo 'active';}?>" href="<?php echo SITE_URL; ?>/admin/producten/index.php">Producten</a>
                        </li>
                        <li>
                            <a class="<?php if ($page=='categorieën'){echo 'active';}?>" href="<?php echo SITE_URL; ?>/admin/categorieen/index.php">Categorieën</a>
                        </li>        
                    </ul>
                </nav>
                <?php } ?>  
                <?php  
                if(!isset($_SESSION['LOGIN_OK'] ) or $_SESSION['LOGIN_OK']==false )
                { ?>
 <main class="container">
                <form method="POST" action="inlogtest.php"> 
                    <br>
                    <div class="row shadow p-3 bg-white rounded">
                        <div class="col-8"><h4>Inloggen</h4></div>
                        <div class="col-4 text-right">
                            <button id="loginknop"  name="verzendknop" style="background-color: red; border-color: red " 
                                    type="submit" class="btn btn-md btn-success">Verzenden
                            </button>

                        </div>
                    </div>
                    
    <main class="container">
        <?php require( SITE_DIR.'../Includes/error.php' ); ?>
        </main>
                 <br>   
                    <div class="form-group col-12 col-md-6 form ">
                        <label for="inputEmail">E-mail</label>
                        <input id="inputEmail" class="form-control" type="text" name="email">
                    </div>
                    <div class="form-group col-12 col-md-6 form ">
                        <label for="inputPaswoord">Wachtwoord</label>
                        <input d="inputPaswoord" class="form-control" type="password" name="wachtwoord">
                        <input type="hidden" name="ACTION" value="AANMELDEN">
                    </div>
                    <section class="form" >
                        <div class="zin">  <a href="#"  data-toggle="modal" data-target=".bd-example-modal-lg">Wachtwoord vergeten?</a>
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" style="margin-top:20%;">
                                        <div class="popop-titel">
                                            <h2>Wachtwoord herstellen</h2>
                                        </div>
                                        <div class="popup-midden">
                                            <p>Weet je het wachtwoord niet meer? Vul hieronder je e-mailadres in. We sturen dan binnen enkele minuten een e-mail waarmee een nieuw wachtwoord kan worden aangemaakt. </p>
                                        </div>

                                        <div class="popup-footer">
                                            <div class="form-group col-12 col-md-6 form " style="padding: 0 0 0 10; margin: 0 0 0 0; " >
                                                <label for="inputPaswoord">Vul hier je e-mail in </label>
                                                <input d="inputPaswoord" class="form-control" type="text" email="wachtwoord" placeholder="dvp@gmail.com "  >
                                            </div>
                                            <button class="zwart" type="button"  data-dismiss="modal">Annuleren</button>
                                            <button type="submit" class="rood">Verzenden</button>

                                        </div>

                                    </div>
                                </div>
                            </div> </div> <div class="zin-2"> Nieuw? Maak <a href="registratieform.php">hier</a>  een account aan.
                        </div>
                    </section>
                </form>
    </main>
           
            <?php }   else { 
            ?>
         <main class="container">
            <form action="gegevens.php" method="POST">
                <br>
                <div class="row shadow p-3 bg-white rounded">
                    <div class="col-8"><h4>Mijn gegevens</h4></div>
                    <div class="col-4 text-right">
                        <button name="wijzigknop1" style="background-color: red; border-color: red " 
                                type="submit" class="btn btn-md btn-success">Wijzigen
                        </button>

                    </div>
                </div>
                <br>
                    <main class="container">
        <?php require( SITE_DIR.'../Includes/error.php' ); ?>
        </main>
                <div class="login-tabel">
 <table >
            <tr>

            <th>Naam</th> <td> <input id="Naam" class="form-control col-md-8 kolomklein" type="text" name="Naam"
            value="<?php echo $_SESSION['Naam']; ?>"></td>
            </tr>
            <tr>

            <th>Gebruikersnaam</th> <td> <input id="Gebruikersnaam" class="form-control col-md-8 kolomklein" type="text" name="Gebruikersnaam"
            value="<?php echo $_SESSION['LOGIN_USERNAME']; ?>"></td>
            </tr>
                
            <tr>
            <th>Adres</th> <td> <input id="Adres" class="form-control col-md-8 kolomklein" type="text" name="Adres"
            value="<?php echo $_SESSION['Adres']; ?>"></td>
            </tr>
                
            <tr>
            <th>Gemeente</th> <td> <input id="Gemeente" class="form-control col-md-8 kolomklein" type="text" name="Gemeente"
            value="<?php echo $_SESSION['Gemeente']; ?>"></td>
            </tr>
                
            <tr>
            <th>Postcode</th> <td> <input id="Postcode" class="form-control col-md-8 kolomklein" type="text" name="Postcode"
            value="<?php echo $_SESSION['Postcode']; ?>"></td>
            </tr>
                
            <tr>
            <th>Telefoonnummer</th> <td> <input id="Telefoonnummer" class="form-control col-md-8 kolomklein" type="text" name="Telefoonnummer"
            value="<?php echo $_SESSION['Telefoonnummer'];?>"></td>
            </tr>
                
            <tr>
            <th>E-mail adres</th> <td> <input id="Email" class="form-control col-md-8 kolomklein" type="text" name="Email"
            value="<?php echo $_SESSION['Email'];?>"></td>
            </tr>
                
            <tr>
            <th>Wachtwoord</th> <td> <input id="Wachtwoord" class="form-control col-md-8 kolomklein" type="password" name="Wachtwoord"
            value="<?php echo $_SESSION['bolletjes'];?>"></td>
            </tr>
            </table>

                </div>
            </form>

                <br>
                <div class="row shadow p-3 bg-white rounded">
                    <div class="col-8"><h4>Mijn bestellingen</h4></div>
                    <div class="col-4 text-right"> </div>
                </div>
             <br>
<main class="container categorielijst">
  <div class="row mt-3">
    <div class="col-12">
      <table id="overzichtTabel" class="table table-striped table-bordered" style="width:100%;">
        <thead>
        <tr>
          <th>BonID</th>
          <th>Datum</th>
          <th>Aantal</th>
          
        </tr>
        </thead>
        <?php

        foreach ($bestellingen as $bestelling) {
          ?>
          <tr>
            <td><?php echo $bestellingen['BonID']; ?></td>
            <td><?php echo $bestellingen['Datum']; ?></td>
            <td><?php echo $bestellingen['Aantal']; ?></td>
          </tr>
          <?php
        }
        ?>

        <!--                        --><?php //
        //                                                          }
        //                        ?>
      </table>
    </div>

    <?php
    function pre_r($array)
    {
      echo '<pre>';
      print_r($array);
      echo '<pre>';
    }

    ?>
  </div>
</main>  
                  
                <br>       
         
 </main>
        <br><br>
            <div class="login">
                <form method="post" action="inlogtest.php">     <button   name="uitlogknop" 
                      style="height: 50px; background-color: red; border-color: red" 
                      type="submit" class="btn btn-md btn-success margin-inlog-knop">Uitloggen
                </button> 
                </form>  

            </div>
            <?php  

                }?>
        </div>
 
    </body>
    <script src="../js/main.js"></script>
</html>