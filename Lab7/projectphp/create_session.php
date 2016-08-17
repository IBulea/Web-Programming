<?php
	error_reporting(0);
	// connect to the database
	include('connect-db.php');
	
	echo "<form action='#' method='get'>";
	echo "User Name: <input type='text' name='fname' />";
		echo "Password: <input type='text' name='age'/>";
	echo "<input type='submit' value='Login'/>";
	echo "</form>";
	$fname=$_GET["fname"];
	$fpass=$_GET["age"];
	$login = mysql_query("SELECT * FROM User");
	$passed =0;
	while($ll =mysql_fetch_array($login))
	{
		if($ll['username']==$fname)
			if($ll['password']==$fpass)
				$passed=1;
	}
	if($passed){
	header("Location: view.php");
	}
	else
	{
		echo "Unauthorized login";
	}
?>
