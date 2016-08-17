<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>GroupBy</title>
</head>
<body>

<?php
/* 
	VIEW.PHP
	Displays all data from 'url' table
*/
	error_reporting(0);
	// connect to the database
	include('connect-db.php');


	// get results from database
	$result = mysql_query("SELECT * FROM URL Group by category") 
		or die(mysql_error());  
		
	// display data in table
	
	echo "<table border='1' cellpadding='10'>";
	echo "<tr> <th>ID</th> <th>Category</th> <th>Description</th> <th>URL</th> <th></th> <th></th></tr>";

	// loop through results of database query, displaying them in the table
	while($row = mysql_fetch_array( $result )) {
		
		// echo out the contents of each row into a table
		echo "<tr>";
		echo '<td>' . $row['id'] . '</td>';
		echo '<td>' . $row['category'] . '</td>';
		echo '<td>' . $row['description'] . '</td>';
		echo '<td>' . $row['url'] . '</td>';
		echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';
		echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
		echo "</tr>"; 
	} 

	// close table>
	echo "</table>";
?>
</body>
</html>	