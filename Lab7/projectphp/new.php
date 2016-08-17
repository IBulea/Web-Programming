<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 error_reporting(E_ERROR );
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $category, $description, $url, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>New Record</title>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 
 <form action="" method="post">
 <div>
 <strong>ID:</strong> <input type="text" name="id" value="<?php echo $id; ?>"/><br/>
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
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
	$id = mysql_real_escape_string(htmlspecialchars($_POST['id']));
	$category = mysql_real_escape_string(htmlspecialchars($_POST['category']));
	$description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
	$url = mysql_real_escape_string(htmlspecialchars($_POST['url']));
 
 // check to make sure both fields are entered
	 if ($id == '' || $category == '' || $description == '' || $url == '')
	 {
	 // generate error message
	 $error = 'ERROR: Please fill in all fields!';
	 
	 // if either field is blank, display the form again
	 renderForm($id,$category, $description, $url, $error);
	 }
	 else
	 {
	 // save the data to the database
	 mysql_query("INSERT url SET id='$id', category='$category', description='$description', url='$url'")
	 or die(mysql_error()); 
	 
	 // once saved, redirect back to the view page
	 header("Location: view.php"); 
	 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','','','');
 }
?>