<?php
require_once('db.php');

//lets start a session
session_start();

if (!isset($_SESSION["name"]))
{
	header('location: auth.php');
	//echo "you are not logged in. Go to <a href='auth.php'>the login in page</a>\n";
}

if(isset($_POST['allowedEmail']))
{
	$allowedEmail = $_POST['allowedEmail'];

	$query_insert = "INSERT INTO whitelist (sender, action) VALUES ('$allowedEmail', 'OK')";

	if ($db->query($query_insert) === TRUE)
	{
    	$message = "<p class='green'>Email successfully added!</p>";
	} else
	{
    	$message = "Error: " . $query_insert . "<br>" . $db->error;
	}
}

?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Whitelist editor</title>
  <meta name="description" content="Management panel for the whitelist editor">
  <meta name="author" content="Chris Gardiner-Bill">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

<style>

.green{
	color: green;
}

.red{
	color: red;
}

</style>

</head>

<body>
	<div class="container">

	

<div class="row">
	<p class="text-right">Logged in as: <?php echo $_SESSION['name'] ?>. <a href="logout.php"><em>Logout</em></a></p>
	<h1>Whitelist editor</h1>

	<h3>Protected users</h3>
	<p>The following is a list of users who are protected from receiving email from unapproved email addresses:</p>
	<?php
		$pro_usrs_sql = "SELECT recipient from protected_users";
		$result_protected_usrs = $db->query($pro_usrs_sql);

		if ($result_protected_usrs->num_rows > 0) {
			echo "<ul>\n";
			while($row = $result_protected_usrs->fetch_assoc())
			{
				echo "<li>" . $row["recipient"] . "</li>\n";
			}
			echo "</ul>\n";
		} else
		{
			echo "<p>No users in protected list</p>\n";
		}

	?>
	<div class="col-md-8">

	<h3>Whitelist</h3>
	<p>The following table shows email address in the white list. Those marked as <span class="green">OK</span> are able to send emails to the all protected users</p>

<?php


$sql = "SELECT sender, action FROM whitelist";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<table class='table'>\n";
    echo "<thead>\n";
    echo "<tr>\n";
    echo "<th>Sender</th>";
    echo "<th>Approved</th>";
    echo "</tr>\n";
    echo "</thead>\n";

    while($row = $result->fetch_assoc()) {
        echo "<tr>" . "<td>" . $row["sender"]. "</td>";
        if ( $row["action"] == "OK")
        {
        	echo "<td><span class='green'>" . $row["action"] . "</span></td></tr>\n";	
        } else
        {
        	echo "<td><span class='red'>" . $row["action"] . "</span></td></tr>";		
        }

        
    }
     echo "</table>\n";
} else {
    echo "0 results";
}
$db->close();
?>
</div><!-- close col 1 -->

<div class="col-md-4">
	<h3>Add sender to whitelist</h3>
	<form class="form" role="form" method="post" action="index.php">
		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" id="allowedEmail" name="allowedEmail" placeholder="Enter email">
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
	<?php
		if (isset($message))
		{
			echo $message;
		}
	?>
</div><!-- close col 2 -->

</div> <!-- close row -->


</div> <!-- close container div -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>