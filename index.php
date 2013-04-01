<?php
	session_start();
		if(isset($_SESSION['usr']) && isset($_SESSION['pswd'])){
		header('Location: justdesign.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
    <title>Kanban | Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <br><br><br>

    <div id="login">
        Kanban
        <br><br>

        <form method='post' action='login.php'>
            <table>
                <tr>
                    <td>Username: </td>
                    <td><input type='text' name='usr'></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type='password' name='pswd'></td>
                </tr>

                <tr>
                    <td><input type='submit' name='login' value='Login'></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
