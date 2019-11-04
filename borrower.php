<?php
	$studUsername = filter_input(INPUT_POST, 'studUsername');
	$bookId = filter_input(INPUT_POST, 'bookId');
	$issueDate = filter_input(INPUT_POST, 'issueDate');
	$returnDate = filter_input(INPUT_POST, 'returnDate');
	session_start();
	$adminname = $_SESSION['username'];
	if(!empty($adminname)){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(!empty($studUsername)){
				
					$host = "localhost";
					$dbusername = "root";
					$dbpassword = "";
					$dbname = $adminname;
					$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
					if(mysqli_connect_error())
					{
						die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
					}	
					else
					{	
							
						$sql = "SELECT * FROM studentdetail WHERE username = '$studUsername'";
						$sql2 = "SELECT * FROM bookrecord WHERE bookId = '$bookId'";
						if($conn->query($sql) && $conn->query($sql2))
						{	
							$result = $conn->query($sql2);
							$row = $result->fetch_assoc();
							$quantity = $row["quantity"];
							if($quantity != 0){
								$quantity = $quantity - 1;
								$sql3 = "UPDATE bookrecord SET quantity = '$quantity' WHERE bookId = '$bookId'";
								$sql1 = "INSERT INTO borrower (studUsername, bookId, issueDate, returnDate) values('$studUsername', '$bookId', '$issueDate', '$returnDate');";
								if($conn->query($sql1) && $conn->query($sql3)){
									
									echo "<center><p style='color:#ffffff;'>Data Successfully Inserted</p></center>";
								}
								else
								{
									echo "Error: ". $sql1 ."<br>". $conn->error;
								}
							}	
							else{
								echo "<center><p style='color:#ffffff;'>Book not available</p></center>";
							}
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
				echo 'alert("Username is empty")';
				echo '</script>';
				die();
			}
		}
	}
	else{
		session_destroy();
		$_SESSION = array();
		header("location: main.php");
	}	
	
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Library Managemenr System
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/borrowerStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <div class="topnav">
                    <a id="inActive" href="addBook.php">Add Books</a>
                    <a id="inActive" href="searchBook.php">Books Search</a>
                    <a id="inActive" href="updateBook.php">Book Update</a>
                    <a class="active" href="borrower.php">Issue Book</a>
					<a id="inActive" href="bookSubmission.php">Book Submission</a>
					<a id="inActive" href="bookList.php">Book List</a>
					<a id="inActive" href="studRecord.php">Student Record</a>
                    <a href="Logout.php" id = "logout">Logout</a>
                  </div>
            <div id = "bottomLayout">
                <br><center><h2 id = "formHeading"> Issue Book </h2></center><br>
                <form action="borrower.php" method = "POST">
                    <table id = "formLayout" cellspacing="10">
                        <tr id = "rowLayout"><td id="rowHeading"> Student Username :  </td><td><input type="text" name="studUsername" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> BookId :  </td><td><input type="text" name="bookId" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> Issue Date :  </td><td><input type="text" name="issueDate" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> Return Date :  </td><td><input type="text" name="returnDate" id = "input"></td></tr>
                    </table>
                    <br><center><input type="submit" value="Submit"></center><br>
                  </form><br>
            </div>
        </center>    
    </body>
</html>