<?php

session_start();

//$usr = $_POST["usr"];
//$pswd = $_POST["pswd"];
$ticket = $_POST["ticket"];
$newStatus = $_POST["newStatus"];
$itemID = $_SESSION[$ticket . "_itemID"];
$statusNoteID = $_SESSION[$ticket . "_statusNoteID"];



$statusUpdateClient = new SoapClient($_SESSION['wsdl']);

$GetUpdateResult = $statusUpdateClient->UpdateItem(array(
                'auth' => array(
                        'userId'   => $_SESSION['usr'],
                        'password' => $_SESSION['pswd']
                    ),
                'item' => array(
                        'genericItem' => array(
                                'itemName' => $ticket,
                                'itemID' => $itemID
                        ),
                        'noteList' => array(
                                'id' => $statusNoteID,
                                'title' => 'KanBan',
                                'note' => $newStatus,
                                'accessType' => 'ATTACHACCESS-DEFAULT'
                        ),
                )
        ));

echo "$ticket has been updated to status: $newStatus";

?>
