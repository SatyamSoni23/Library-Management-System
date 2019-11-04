<?php
	$username = filter_input(INPUT_POST, 'username');
	$password = md5(filter_input(INPUT_POST, 'password'));
	$confirmPassword = md5(filter_input(INPUT_POST, 'confirmPassword'));
	$institute = filter_input(INPUT_POST, 'institute');
	$entry = "unsuccess";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!empty($username)){
			if(!empty($password))
			{
				if($password != $confirmPassword){	
					echo '<script language="javascript">';
					echo 'alert("Password and confirm password must be same")';
					echo '</script>';
					die();
				}
				else
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
						$result = $conn->query($sql);
						if($result->num_rows > 0)
						{	
							$row = $result->fetch_assoc();
							$adminname = $row["username"];
							$entry = "success";
							echo "<center><p style='color:#ffffff;'>Registration successfully</p></center>";
						}
						else
						{
							echo "Error: ". $sql ."<br>". $conn->error;
						}	
						$conn->close();
					}
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
				$sql1 = "INSERT INTO studentdetail (username, password) values('$username', '$password');";
				if($conn1->query($sql1)){
					echo "Data Successfully Inserted";
				}
				else
				{
					echo "Error: ". $sql1 ."<br>". $conn1->error;
				}
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
        <link rel="stylesheet" type="text/css" href="CSS/studRegisterStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <br>
            <div id = "bottomLayout">
                <div  id ="bottom-left"><a href = "adminRegister.php" id = "linkAdmin"><img src = "Images/studRegistration.png" height = "200" width = "200" id = "imageL"></a><br><p id ="bottomContentLeft"> Student Registration</p></div>
                <div id ="bottom-right">
                    <form action="studRegistration.php" method = "post">
                        <table id = "formLayout" cellspacing="10">
                            <tr id = "rowLayout"><td id="rowHeading"> Username : </td><td><input type="text" name="username" id = "input" required></td></tr>
                            <tr id = "rowLayout"><td id="rowHeading"> Password : </td><td><input type="password" name="password" id = "input" required></td></tr>
                            <tr id = "rowLayout"><td id="rowHeading"> Confirm Password : </td><td><input type="password" name="confirmPassword" id = "input"></td></tr>
                            <tr id = "rowLayout"><td id="rowHeading"> Institute : </td><td><input type="text" name="institute" id = "input"></td></tr>
                        </table>
                        <br><center><input type="submit" value="Register" id="buttonFont"></center><br>
                    </form>    
                </div>
            </div>
        </center>    
    </body>
</html>
