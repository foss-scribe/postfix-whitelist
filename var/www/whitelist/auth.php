<?php

require_once('db.php');
session_start();



if (!isset($_SESSION["name"]))
{
	
	$form_token = md5( uniqid('auth', true) );

	if(!isset( $_POST['email'], $_POST['password'], $_POST['form_token']))
	{
    	//no post so display form
    	
    	echo "<form class='form' role='form' method='post' action='auth.php'>\n";
		echo "<div class='form-group'>\n";
		echo "<label for='username'>Email address</label>\n";
		echo "<input type='email' class='form-control' name='email' id='email'>\n";
		echo "<label for='password'>Password</label>\n";
		echo "<input type='password' class='form-control' name='password' id='password'>\n";
		echo "<button type='submit' class='btn btn-default'>Submit</button>\n";
		echo "<input type='hidden' name='form_token' value= '". $form_token . "' />\n";
		echo "</div>\n";
		echo "</form>\n";

    } else {
		//form posted so lets process it
		$email = $_POST['email'];
		$password = $_POST['password'];

		$query_auth = "SELECT username, password, name FROM mailbox WHERE whitelist_admin = 'TRUE' AND username = '$email' AND ENCRYPT('$password', password) = password";
		$result = $db->query($query_auth);

		if ($result->num_rows > 0)
		{
			//we've got a result so add it to session
			$row = $result->fetch_assoc();
			$_SESSION["name"] = $row['name'];

			//then redirect to index
			header('location: index.php');

		}	else
		{
			//no result
			$_SESSION["name"] = '';
			session_destroy();

			die("sorry your details are incorrect");
		}

		}
} else
{
	header('location index.php');
}


?>