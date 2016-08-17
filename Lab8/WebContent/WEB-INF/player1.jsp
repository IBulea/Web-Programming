<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Forum</title>

<style type="text/css">
.table {
	background-color:#D0D0D0;
	width:90%;
	margin:10px;
	padding-left:6px;
	height:350px;
	text-decoration: none;
}
a{
	text-decoration: none;
}

</style>
</head>
<body>
	<%
		mvcExample.model.User user = (mvcExample.model.User) request.getAttribute("user"); 
		out.println("Welcome Player 1 !");
	%>
	 <%@ page import = "java.sql.*" %>
	<%
    try {
    	Class.forName("com.mysql.jdbc.Driver");	
		Connection conn = DriverManager.getConnection("jdbc:mysql://localhost/lab9","root","");
		ResultSet rsa = conn.createStatement().executeQuery("select * from game"); 
		ResultSet rr = conn.createStatement().executeQuery("select * from game"); 
		int count =0;
		while(rr.next())
		{
			if(rr.getString("1").equals("1"))
				count++;
			if(rr.getString("2").equals("1"))
				count++;
			if(rr.getString("3").equals("1"))
				count++;
			if(rr.getString("4").equals("1"))
				count++;
			if(rr.getString("5").equals("1"))
				count++;
		}
		if(count==0)%>
			<h2>GAME OVER! PLAYER 1 WINS!</h2>
		<div class="topic">
		<table>
		<%;
		while(rsa.next())
		{
		%>
			<tr>
				<td> <% if(rsa.getString("1").equals("0") || rsa.getString("1").equals("1"))
					out.println("~");
				else if(rsa.getString("1").equals("X"))
					out.println("X");
				else if(rsa.getString("1").equals("*"))
					out.println("*");
				%></td>
				<td> <% if(rsa.getString("2").equals("0") || rsa.getString("2").equals("1"))
					out.println("~");
				else if(rsa.getString("2").equals("X"))
					out.println("X");
				else if(rsa.getString("2").equals("*"))
					out.println("*");
				%></td>
				<td> <% if(rsa.getString("3").equals("0") || rsa.getString("3").equals("1"))
					out.println("~");
				else if(rsa.getString("3").equals("X"))
					out.println("X");
				else if(rsa.getString("3").equals("*"))
					out.println("*");
				%></td>
				<td> <% if(rsa.getString("4").equals("0") || rsa.getString("4").equals("1"))
					out.println("~");
				else if(rsa.getString("4").equals("X"))
					out.println("X");
				else if(rsa.getString("4").equals("*"))
					out.println("*");
				%></td>
				<td> <% if(rsa.getString("5").equals("0")|| rsa.getString("5").equals("1"))
					out.println("~");
				else if(rsa.getString("5").equals("X"))
					out.println("X");
				else if(rsa.getString("5").equals("*"))
					out.println("*");
				%></td>
			</tr>
		<% 
		} %>
		</table>
	</div>
	<%
    }
    catch(Exception ex) {
		System.out.println("eroare la showData:"+ex.getMessage());
	}
    %>
	<form action="Bombard" method="post">
	<h2>Where do you want to Shoot?</h2>
        X Axis: <input type="text" name="XAxis"> 
        Y Axis : <input type="text" name="YAxis"> <BR>
        <input type="hidden" name="jspName" value="player2" >
        <input type="submit" value="Submit"/>
    </form>
    
    
</body>
</html>