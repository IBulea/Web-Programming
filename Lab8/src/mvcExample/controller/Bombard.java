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

import com.mysql.jdbc.ResultSetMetaData;

import mvcExample.model.User;

public class Bombard extends HttpServlet{

	public Bombard()
	{
		super();
	}
		@Override
	    public void doGet(HttpServletRequest req, HttpServletResponse resp)
	            throws ServletException, IOException {

	        req.getRequestDispatcher("/WebContent/WEB-INF/player2.jsp").forward(req,resp);

	    }
	
		
		@Override
		protected void doPost(HttpServletRequest request,
	            HttpServletResponse response) throws ServletException, IOException {
			 
			RequestDispatcher rd = null;
			String x = request.getParameter("XAxis");
		    String y = request.getParameter("YAxis");
		
		try {
	        
	        Class.forName("com.mysql.jdbc.Driver");
			Connection con = DriverManager.getConnection("jdbc:mysql://localhost/lab9","root","");
			PreparedStatement stmt;
			stmt = con.prepareStatement("select * from game  where id = ?");
			stmt.setString(1,x);
			//stmt.setString(2,x);
			ResultSet rs = stmt.executeQuery();

			ResultSetMetaData rsmd = (ResultSetMetaData) rs.getMetaData();
			int columnsNumber = rsmd.getColumnCount();
			while (rs.next()) {
			    for (int i = 1; i <= columnsNumber; i++) {
			        if (i > 1) 
			        	System.out.print(",  ");
			        String columnValue = rs.getString(i);
			        System.out.print(columnValue + " " + rsmd.getColumnName(i));
			        if(rsmd.getColumnName(i).equals(y)){
				        if(columnValue.equals("1"))
						{
							//System.out.println("GOT HERE !!!!!!!!!!");
							PreparedStatement stmt2;
							String s = "X";
							String qq = "UPDATE `game` SET `"+y +"` = \""+s + "\" WHERE `id` = \""+x+"\"";
							//System.out.print(qq+"\n");
							stmt2 = con.prepareStatement(qq);
							/*stmt2.setString(1,y);
							stmt2.setString(2,s);
							stmt2.setString(3,x);*/
							stmt2.execute();
						}
						if(columnValue.equals("0"))
						{
							PreparedStatement stmt2;
							String s = "*";
							String qq = "UPDATE `game` SET `"+y +"` = \""+s + "\" WHERE `id` = \""+x+"\"";
							stmt2 = con.prepareStatement(qq);
							stmt2.execute();
						}
			        }
			    }
			    System.out.println();
			}
			
			
			//if(rs!=null)
			//{
				
				 rd = request.getRequestDispatcher("/LoginController2");
				// response.sendRedirect("/WebContent/success.jsp");
				 
		    /*}
				else 
				{
		            rd = request.getRequestDispatcher("/error.jsp");
		        }*/
		        rd.forward(request, response);
			
	        
		}
		 catch(Exception ex) {
				System.out.println("bombard by player1 error "+ex.getMessage());
			
			}
	}
}
