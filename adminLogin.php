<?php
	$username = filter_input(INPUT_POST, 'username');
	$password = md5(filter_input(INPUT_POST, 'password'));
	session_start();
	$_SESSION['username'] = $username;
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!empty($username) && !empty($password)){
			$host = "localhost";
			$user = "root";
			$pwd = "";
			$dbname = "lms";
			// Create connection
			$conn = new mysqli($host, $user, $pwd, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$sql = "SELECT * FROM adminregistration WHERE username = '$username' AND password = '$password'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				header('Location: addBook.php');
			} 
			else 
			{
				header('Location: wrongId.php');
			}
			$conn->close();
		}	
	}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>
            Library Managemenr System
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/adminLoginStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <br>
            <div id = "bottomLayout">
                <div  id ="bottom-left"><a href = "adminLogin.php" id = "linkAdmin"><img src = "Images/admin.png" height = "200" width = "200" id = "imageL"></a><br><p id ="bottomContentLeft"> Admin Login</p></div>
                <div  id ="bottom-right">
                    <form action="adminLogin.php" method  = "POST">
                        <table id = "formLayout" cellspacing="10">
                            <tr id = "rowLayout"><td id="rowHeading"> Username:</td><td><input type="text" name="username" id = "input"></td></tr>
                            <tr id = "rowLayout"><td id="rowHeading"> Password:</td><td><input type="password" name="password" id = "input"></td></tr>
                        </table>
                        <br><center><input type="submit" value="Login" id="buttonFont"></center><br>
                    </form>    
                </div>
            </div>
        </center>    
    </body>
</html>