<?php
// ******************
// PROJECT CONSTANTEN
// ******************


// Locatie vd bestanden
// --------------------
// zie ook: https://www.php.net/manual/en/function.pathinfo.php

define( 'SITE_DIR', str_replace( "\\", '/', pathinfo(__FILE__,PATHINFO_DIRNAME) ) );
// = de volledige directorynaam vd plaats waar het config.php script staat

define( 'SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/'.str_replace( $_SERVER['DOCUMENT_ROOT'], '', SITE_DIR ) );
// = de url die we moeten ingeven in de browser om op deze website uit te komen

define( 'ACTIVE_PAGE', pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_FILENAME) );
// = de naam vh uit te voeren script

echo '<!--'.PHP_EOL;
echo ' SITE_DIR='.SITE_DIR.PHP_EOL;
echo ' SITE_URL='.SITE_URL.PHP_EOL;
echo ' ACTIVE_PAGE='.ACTIVE_PAGE.PHP_EOL;
echo '-->'.PHP_EOL;

session_start();
if( !isset($_SESSION['LOGIN_OK']) ) { $_SESSION['LOGIN_OK'] = false; }
if( !isset($_SESSION['IS_ADMIN']) ) { $_SESSION['IS_ADMIN'] = false; }
if( $_SESSION['LOGIN_OK'] == false) { $_SESSION['LOGIN_USERNAME'] = ''; 
$_SESSION['Naam'] = ''; $_SESSION['Adres']=''; $_SESSION['Telefoonnummer'] =''; $_SESSION['error'] =false; $_SESSION['Email']='';$_SESSION['Aantal'] =0; $_SESSION['Gemeente'] =''; $_SESSION['Postcode'] =''; $_SESSION['Wachtwoord'] ='';
$_SESSION['bolletjes'] ='........';
$_SESSION['BonID']='';                                  
$_SESSION['Datum']='';
$_SESSION['Maat']='';  
}
if( !isset($_SESSION['WINKELKAR']) ) { $_SESSION['WINKELKAR'] = array(); }



require('databank.php');

try
{
$dbh = new PDO( DB_CONNECTION, DB_USERNAME, DB_PASSWORD );
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
echo '<p>Kan geen connectie maken met databank.</p><code>'.$e->getMessage().'</code>';
die();
}
?>