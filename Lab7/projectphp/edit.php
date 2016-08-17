<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/
 error_reporting(E_ERROR);

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $category, $description, $url, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
 </head>
 <body>
 
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solcategory red; color:red;">'.$error.'</div>';
 }
 ?> 
 
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <div>
 <p><strong>ID:</strong> <?php echo $id; ?></p>
 <strong>Category:</strong> <input type="text" name="category" value="<?php echo $category; ?>"/><br/>
 <strong>Description:</strong> <input type="text" name="description" value="<?php echo $description; ?>"/><br/>
 <strong>URL:</strong> <input type="text" name="url" value="<?php echo $url; ?>"/><br/>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html> 
 <?php
 }



 // connect to the database
 include('connect-db.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
	 if (is_numeric($_POST['id']))
	 {
	 // get form data, making sure it is valid
	 $id = $_POST['id'];
	 $category = mysql_real_escape_string(htmlspecialchars($_POST['category']));
	 $description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
	 $url = mysql_real_escape_string(htmlspecialchars($_POST['url']));
	 
	 // check that  fields are filled in
		 if ($id == '' || $category == '' || $description == '' || $url == '')
		 {
		 // generate error message
		 $error = 'ERROR: Please fill in all fields!';
		 
		 //error, display form
		 renderForm($id, $category, $description, $url, $error);
		 }
		 else
		 {
		 // save the data to the database
		 mysql_query("UPDATE url SET category='$category', description='$description', url='$url' WHERE id='$id'")
		 or die(mysql_error()); 
		 
		 // once saved, redirect back to the view page
		 header("Location: view.php"); 
		 }
	 }
	 else
	 {
	 // if the 'id' isn't valid, display an error
	 echo 'Error! the id isnt valid';
	 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
	 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
	 if (isset($_GET['id']) && is_numeric($_GET['id']) /* && $_GET['id'] > 0*/)
	 {
		 // query db
		 $id = $_GET['id'];
		 $result = mysql_query("SELECT * FROM url WHERE id=$id")
		 or die(mysql_error()); 
		 $row = mysql_fetch_array($result);
		 
		 // check that the 'id' matches up with a row in the databse
		 if($row)
		 {
		 
		 // get data from db
		 $category = $row['category'];
		 $description = $row['description'];
		 $url = $row['url'];
		 
		 // show form
		 renderForm($id, $category, $description, $url, '');
		 }
		 else
		 // if no match, display result
		 {
		 echo "No results!";
		 }
	 }
	 else
	 // if the 'category' in the URL isn't valcategory, or if there is no 'category' value, display an error
	 {
	 echo 'Error!';
	 }
 }
?>