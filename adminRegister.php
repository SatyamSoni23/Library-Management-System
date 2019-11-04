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
					$dbname = "LMS";
					$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
					if(mysqli_connect_error())
					{
						die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
					}	
					else
					{	
						$sql1 = "SELECT * FROM adminregistration WHERE institute = '$institute'";
						$result = $conn->query($sql1);
						if($result->num_rows > 0){	
							echo "<center><h3>Institute ". $institute. " already registered</h3></center>";
							$conn->close();
						}
						else{
							$sql = "INSERT INTO adminregistration (username, password, institute)
							values('$username', '$password', '$institute');";
							if($conn->query($sql))
							{
								$entry = "success";
								echo "<center><p style='color:#ffffff;'>Registered successfully</p></center>";
							}
							else
							{
								echo "Error: ". $sql ."<br>". $conn->error;
							}	
							$conn->close();
						}	
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
			$conn1 = new mysqli($host, $dbusername, $dbpassword);
			if(mysqli_connect_error())
			{
				die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
			}
			else
			{
				$sql = "CREATE Database $username";	
				if($conn1->query($sql))
				{
					//echo "New Database Created Successfully";
					$sql1 = "USE $username";
					$sql2 = "CREATE TABLE bookRecord (bookId varchar(10) PRIMARY KEY, title varchar(50), authorName varchar(40), cost int(8), quantity int(5))";
					$sql3 = "CREATE TABLE studentDetail (username varchar(30) PRIMARY KEY, password varchar(40))";
					$sql4 = "CREATE TABLE borrower (studUsername varchar(30), bookId varchar(10), issueDate DATE, returnDate DATE)";
					if($conn1->query($sql1) && $conn1->query($sql2) && $conn1->query($sql3) && $conn1->query($sql4)){
						echo "<center><p style='color:#ffffff;'>Table Successfully Created</p></center>";
					}
					else
					{
						echo $conn1->error;
					}
				}
				else
				{
					echo $conn1->error;
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
        <link rel="stylesheet" type="text/css" href="CSS/adminRegisterStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <br>
            <div id = "bottomLayout">
                <div  id ="bottom-left"><a href = "adminRegister.php" id = "linkAdmin"><img src = "Images/admin.png" height = "200" width = "200" id = "imageL"></a><br><p id ="bottomContentLeft"> Admin Registration</p></div>
                <div id ="bottom-right">
                    <form action="adminRegister.php" method = "post">
                        <table id = "formLayout" cellspacing="10">
                            <tr id = "rowLayout"><td id="rowHeading"> Username:</td><td><input type="text" name="username" id = "input" required></td></tr>
                            <tr id = "rowLayout"><td id="rowHeading"> Password:</td><td><input type="password" name="password" id = "input" required></td></tr>
                            <tr id = "rowLayout"><td id="rowHeading"> Confirm Password:</td><td><input type="password" name="confirmPassword" id = "input"></td></tr>
                            <tr id = "rowLayout"><td id="rowHeading"> Institute:</td><td><input type="text" name="institute" id = "input"></td></tr>
                        </table>
                        <br><center><input type="submit" value="Register" id="buttonFont"></center><br>
                    </form>    
                </div>
            </div>
        </center>    
    </body>
</html>
