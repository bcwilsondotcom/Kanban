<?php
session_start();
$_SESSION['wsdl'] = '';
$_SESSION['namespace'] = '';

function NewSoapClient() {
	$_SESSION['soapclient'] = new SoapClient($_SESSION['wsdl']);
}

function GetUser() {
	use_soap_error_handler(true);

	$GetUserResult = $_SESSION['soapclient']->GetUser(array(
                        'auth' => array(
                                'userId'        => $_SESSION['usr'],
                                'password'      => $_SESSION['pswd']
                        ),
                        'userId'     => $_SESSION['adun']
		));
	//print_r($GetUserResult);	
	$_SESSION['uid'] = $GetUserResult->return->id;
	$_SESSION['username'] = $GetUserResult->return->userName;

}





function GetMyActiveTickets() {

	$result = $_SESSION['soapclient']->GetItemsByQuery(array(
		'auth' => array(
		        'userId'   => $_SESSION['usr'],
		        'password' => $_SESSION['pswd']
		    ),
		'tableID' => "1",
		'queryWhereClause' => 'TS_OWNER =' . $_SESSION['uid'] . 'AND TS_CASES.TS_ACTIVEINACTIVE = 0'
	));

	//print_r($result);

	$total = count($result->return);
	for ($i = 0; $i < $total; $i++) {

                $ticketnotes = $_SESSION['soapclient']->GetItem(array(
                        'auth' => array(
                                'userId' => $_SESSION['usr'],
                                'password' => $_SESSION['pswd']
                        ),
                'itemID' => $result->return[$i]->genericItem->itemID,
                'responseOptions' => 'SECTION:NOTES'
                ));

		$totalnotes = count($ticketnotes->return->noteList);
		if ($totalnotes == 0) { $ticketstatus = 'todo'; }
		elseif ($totalnotes == 1) {
			if (strstr($ticketnotes->return->noteList->title, 'KanBan')) {
				$ticketstatus = $ticketnotes->return->noteList->note;
				$_SESSION[$result->return[$i]->genericItem->itemName . "_statusNoteID"] = $ticketnotes->return->noteList->id;
			}
			else {  $ticketstatus = 'todo'; }
		}
		else {
	                for ($ii = 0; $ii < $totalnotes; $ii++) {
				if(strstr($ticketnotes->return->noteList[$ii]->title, 'KanBan')) {
                                	$ticketstatus = $ticketnotes->return->noteList[$ii]->note;
					$_SESSION[$result->return[$i]->genericItem->itemName . "_statusNoteID"] = $ticketnotes->return->noteList[$ii]->id;
                                	$ii++;
                        	}
                        	else {
                                	$ii++;
					if (empty($ticketstatus)) { $ticketstatus = 'todo'; }
                        	}
                	}
		}

		echo "<script type=\"text/javascript\">$($ticketstatus).append('<div class=\"task\" id=\"";
		print_r($result->return[$i]->genericItem->itemName);
		echo "\">";
		print_r($result->return[$i]->genericItem->itemName);echo "<br />";
		//print_r($result->return[$i]->genericItem->itemID);echo "<br />";
		print_r($result->return[$i]->owner);echo "<br />";
      		print_r($result->return[$i]->itemType);echo "<br />";
		print_r($result->return[$i]->title);echo "<br />";
		//print_r($_SESSION[$result->return[$i]->genericItem->itemName . "_statusNoteId"]);
		echo "</div>')</script>";

		$_SESSION[$result->return[$i]->genericItem->itemName . "_itemID"] = $result->return[$i]->genericItem->itemID;

		unset($ticketstatus);


	}


}




?>
