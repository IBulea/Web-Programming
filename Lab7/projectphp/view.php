<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>View Records</title>
	<script  type="text/javascript">
			var xmlhttp;
			function getCategories() {
				xmlhttp=GetXmlHttpObject(); 
				if (xmlhttp==null)  {
					alert ("Your browser does not support XMLHTTP!");
					return;
				}
				var url="groupby.php";

				xmlhttp.open("GET",url,true);			
				xmlhttp.onreadystatechange=stateChanged;
				xmlhttp.send();
			}
			function stateChanged() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					alert("Everything is ok.");
				    document.getElementById("maindiv").innerHTML=xmlhttp.responseText;
				}
			}
			function GetXmlHttpObject() {
				if (window.XMLHttpRequest) {        // code for IE7+, Firefox, Chrome, Opera, Safari
					return new XMLHttpRequest();
				}
			        if (window.ActiveXObject) {         // code for IE6, IE5
					return new ActiveXObject("Microsoft.XMLHTTP");
				}
				return null;
			} 
		</script>
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
	$result = mysql_query("SELECT * FROM URL") 
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
<p><a href="new.php">Add a new record</a></p>
<br/>
<br/>
<input style="position:absolute;left:45%" id="button" type="button" value="Get Grouped by Categories" onclick="getCategories()" />
<br/>
<br/>
<div style="position:absolute;left:30%;" id="maindiv"></div>
</body>
</html>	