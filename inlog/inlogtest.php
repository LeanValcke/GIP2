<?php 
require('../config.php');
$sql = "SELECT KlantID, Gebruikersnaam, Wachtwoord, Naam, Adres, Gemeente, Postcode, Admin, Telefoonnummer,Email FROM tblklant";
$inloggen =$dbh->query($sql);
$gebruikersnaam="";


if(isset($_POST['verzendknop'])) 
{
  
    $gevonden = false;
    foreach($inloggen as $inlog)
    {
      // controle uitvoeren
          if(password_verify(strtoupper($_POST['email']).$_POST['wachtwoord'], $inlog['Wachtwoord'])==true ) 
       {
           $_SESSION['LOGIN_OK'] =true;
           $_SESSION['LOGIN_USERNAME'] = $inlog['Gebruikersnaam'];  
           $_SESSION['Naam'] = $inlog['Naam'];
           $_SESSION['Adres'] = $inlog['Adres'];
           $_SESSION['Telefoonnummer'] = $inlog['Telefoonnummer'];
           $_SESSION['Email'] = $inlog['Email'];
           $_SESSION['Gemeente'] = $inlog['Gemeente'];
           $_SESSION['Postcode'] = $inlog['Postcode'];
           $_SESSION['IS_ADMIN'] = $inlog['Admin'];
           $_SESSION['Wachtwoord'] = $_POST['wachtwoord'];
           $_SESSION['KlantID'] = $inlog['KlantID'];
           $gevonden = true;
       }
    }
    
    if( $gevonden == true )
    {
          header('location:'.'../index.php');
    }
    else if ($gevonden == false)
    {
        $_SESSION['ALERT_CODE'] = 'ERROR';
        $_SESSION['ALERT_HEAD'] = 'Inloggen mislukt!';
        $_SESSION['ALERT_BODY'] = 'Gebruikersnaam en/of wachtwoord is onjuist!';
     header('location:'.'aanmelden.php'); 
    die(); 
          header('location:'.'aanmelden.php');  
            
    }
    else {
        $sql = "
        SELECT 
            KlantID AS USER_ID, gebruikersnaam as USERNAME, wachtwoord AS PASWOORD, 
            Naam AS VOORNAAM, Admin AS ADMIN
        FROM gebruiker WHERE UPPER(gebruikersnaam)=UPPER(:gebruikersnaam)";
        try
        {
            $statement = $dbh->prepare($sql);
            $statement->bindValue( ':gebruikersnaam', $_POST['USERNAME'] );
            $statement->execute();
            $gebruiker = $statement->fetch();

            if( !$gebruiker )
            {
                if( DEBUG_MODE >= DEBUG_INFO ) 
                {
                    error_log( __FILE__.' !!!! WARNING' );
                    error_log( __FILE__.' !!!! Iemand probeert aan te melden met een ongeldig userid: '.$_POST['USERNAME'] ); 
                }
                $fout = 'De opgegeven gebruikersnaam bestaat niet.';
            }
        }
        catch( PDOException $e )
        {
            $fout = 'Fout bij controle username: <code>'.$e->getMessage().'</code>';
        }

        if( $fout!='' )
        {
            $_SESSION['ALERT_CODE'] = 'ERROR';
            $_SESSION['ALERT_HEAD'] = 'Aanmelden';
            $_SESSION['ALERT_BODY'] = $fout;

            $location = SITE_URL.'/inlog/aanmelden.php';
        }
        elseif( !password_verify( $_POST['USERNAME'].$_POST['PASWOORD'], $gebruiker['PASWOORD'] ) )
        {
            $_SESSION['ALERT_CODE'] = 'ERROR';
            $_SESSION['ALERT_HEAD'] = 'Aanmelden';
            $_SESSION['ALERT_BODY'] = 'U heeft een foutief paswoord ingegeven. Probeer opnieuw.';

            $location = SITE_URL.'/inlog/aanmelden.php';
        }
        else
        {
            $_SESSION['LOGIN_OK'] = true;
            $_SESSION['USER_ID']  = $gebruiker['USER_ID'];
            $_SESSION['USERNAME'] = $gebruiker['USERNAME'];
            $_SESSION['VOORNAAM'] = $gebruiker['VOORNAAM'];
            $_SESSION['IS_ADMIN'] = ( $gebruiker['ADMIN']);

            $_SESSION['ALERT_CODE'] = 'SUCCESS';
            $_SESSION['ALERT_HEAD'] = 'Aanmelden';
            $_SESSION['ALERT_BODY'] = 'U bent succesvol aangemeld!';

            $location = SITE_URL.'/index.php';
            //header('location:'.'../index.php');
            }
         
    }
}
    else if(isset($_POST['uitlogknop'])) 
    {
        session_destroy();
        header('location:'.'../index.php');
    }
    else
    {
        /* toon foutboodschap */
        header('location:'.'../index.php');
    }
?>