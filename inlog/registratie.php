<?php 
require('../config.php');

$sql = "SELECT Naam, Telefoonnummer, Adres, Gemeente, Postcode, Gebruikersnaam, Email, Wachtwoord FROM tblklant";	
$klanten =$dbh->query($sql);

$registratie="";
$Naam = $_POST['Voornaam'] . ' ' . $_POST['Achternaam'];
$Telefoonnummer = $_POST['Telefoonnummer'];
$Adres = $_POST['Adres'];
$Gemeente = $_POST['Gemeente'];
$Postcode = $_POST['Postcode'];
$Gebruikersnaam = $_POST['Gebruikersnaam'];
$Email = $_POST['Email'];

foreach($klanten as $klant)
{
if(strtoupper($_POST['Email']) == strtoupper($klant['Email']) )
{
        $_SESSION['ALERT_CODE'] = 'ERROR';
        $_SESSION['ALERT_HEAD'] = 'Registreren mislukt!';
        $_SESSION['ALERT_BODY'] = 'E-mail al in gebruik!';
     header('location:'.'registratieform.php'); 
    die(); 
}
    }
// hashen

if($_POST['Wachtwoord'] == $_POST['Bwachtwoord'])
{
$Wachtwoord = password_hash( strtoupper($_POST['Email']).$_POST['Wachtwoord'],PASSWORD_DEFAULT );
}
else {
        $registratie=false; 
        $_SESSION['ALERT_CODE'] = 'ERROR';
        $_SESSION['ALERT_HEAD'] = 'Registreren mislukt!';
        $_SESSION['ALERT_BODY'] = 'Wachtwoorden zijn niet gelijk!';
     header('location:'.'registratieform.php'); 
    die();
}
if(isset($_POST['registratieknop'])) 
{     
        //connectie
        $dbh = new PDO (DB_CONNECTION, DB_USERNAME, DB_PASSWORD);
        
            $sql =" INSERT INTO tblklant (Naam, Telefoonnummer, Adres, Gemeente, Postcode, Admin, Gebruikersnaam, Email, Wachtwoord)
            VALUES ('$Naam','$Telefoonnummer','$Adres','$Gemeente','$Postcode','0','$Gebruikersnaam','$Email','$Wachtwoord')";
    
            if($dbh->query($sql)){}       
             header('location:'.'aanmelden.php');  
        }
    


    ?>