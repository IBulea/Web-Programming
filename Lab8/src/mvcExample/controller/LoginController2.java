package mvcExample.controller;

import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import mvcExample.model.User;

public class LoginController2 extends HttpServlet {
 
    public LoginController2() {
        super();
    }
 
    protected void doPost(HttpServletRequest request,
            HttpServletResponse response) throws ServletException, IOException {
 
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        RequestDispatcher rd = null;
 
     
        try {
        
        Class.forName("com.mysql.jdbc.Driver");
		Connection con = DriverManager.getConnection("jdbc:mysql://localhost/lab9","root","");
		PreparedStatement stmt;
		stmt = con.prepareStatement("select * from user where username=? and password=?");	
		stmt.setString(1,username);
		stmt.setString(2,password);
		ResultSet rs = stmt.executeQuery(); 
		
		if(rs !=null)
		{
			 rd = request.getRequestDispatcher("/player2.jsp");
	            User user = new User(username, password);
	            request.setAttribute("user", user);
	    }
			else 
			{
	            rd = request.getRequestDispatcher("/error.jsp");
	        }
	        rd.forward(request, response);
		
        }
        
        catch(Exception ex) {
			System.out.println("login error "+ex.getMessage());
		
		}
    } 
}
