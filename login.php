<?php
session_start();

$adun = $_REQUEST['usr'];
$ldaprdn  = "sea\\" .$_REQUEST['usr'];
$ldappass = $_REQUEST['pswd'];

//Check to see if sea\ is in front of username. If so strip it.
//Need to figure this one out. Put it here when you do.
$ldapdomain = '';
$ldapconn = ldap_connect($ldapdomain)
    or die("Could not connect to LDAP server.");

if ($ldapconn) {

      $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

    if ($ldapbind) {
	//echo "successful";
	$_SESSION['adun'] = $adun;
	$_SESSION['usr'] = $ldaprdn;
	$_SESSION['pswd'] = $ldappass;
	header('Location: board.php');

    } else {
        //echo "LDAP bind failed...";
	header('Location: index.php');
    }

}

?>
