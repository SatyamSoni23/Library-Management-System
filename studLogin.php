<?php
	$username = filter_input(INPUT_POST, 'username');
	$password = md5(filter_input(INPUT_POST, 'password'));
	$institute = filter_input(INPUT_POST, 'institute');
	$entry = "unsuccess";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!empty($username)){
			if(!empty($password))
			{
				$host = "localhost";
				$dbusername = "root";
				$dbpassword = "";
				$dbname = "lms";
				$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
				if(mysqli_connect_error())
				{
					die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
				}	
				else
				{	
					
					$sql = "SELECT * FROM adminregistration WHERE institute = '$institute'";
					if($conn->query($sql))
					{	
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$adminname = $row["username"];
						session_start();
						$_SESSION['adminname'] = $adminname;
						$_SESSION['studUsername'] = $username;
						$entry = "success";
						echo "New record is inserted successfully abc";
					}
					else
					{
						echo "Error: ". $sql ."<br>". $conn->error;
					}	
					$conn->close();
				}
			}	
			else
			{
				echo '<script language="javascript">';
				echo 'alert("Password is empty")';
				echo '</script>';
			}	
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Username is empty")';
			echo '</script>';
			die();
		}
		if($entry == "success")
		{
			$host = "localhost";
			$dbusername = "root";
			$dbpassword = "";
			$dbname = $adminname;
			$conn1 = new mysqli($host, $dbusername, $dbpassword, $dbname);
			if(mysqli_connect_error())
			{
				die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
			}
			else
			{	
				$sql = "SELECT * FROM studentdetail WHERE username = '$username' AND password = '$password'";
				$result = $conn1->query($sql);

				if ($result->num_rows > 0) {
					header('Location: studBookSearch.php');
				} 
				else 
				{
					header('Location: studWrong.php');
				}
				$conn1->close();
			}			
		}
	}
	
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Library Managemenr System
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/studLoginStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <br>
            <div id = "bottomLayout">
                <div  id ="bottom-left"><a href = "adminLogin.php" id = "linkAdmin"><img src = "Images/students.png" height = "200" width = "200" id = "imageL"></a><br><p id ="bottomContentLeft"> Student Login</p></div>
                <div  id ="bottom-right">
                    <form action="studLogin.php" method  = "POST">
                        <table id = "formLayout" cellspacing="10">
                            <tr id = "rowLayout"><td id="rowHeading"> Username: </td><td><input type="text" name="username" id = "input"></td></tr>
                            <tr id = "rowLayout"><td id="rowHeading"> Password: </td><td><input type="password" name="password" id = "input"></td></tr>
							<tr id = "rowLayout"><td id="rowHeading"> Institute: </td><td><input type="text" name="institute" id = "input"></td></tr>
                        </table>
                        <br><center><input type="submit" value="Login" id="buttonFont"></center><br>
                    </form>    
                </div>
            </div>
        </center>    
    </body>
</html>