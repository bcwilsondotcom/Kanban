                $ticketstatus=$_SESSION['soapclient']->GetItem(array(
                        'auth' => array(
                                'userId' => $_SESSION['usr'],
                                'password' => $_SESSION['pswd']
                        ),
                'itemID' => $result->return[$i]->genericItem->itemID,
                'responseOptions' => "SECTION: NOTES"
        ));

