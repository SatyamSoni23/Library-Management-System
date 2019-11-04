<?php
	$bookId = filter_input(INPUT_POST, 'bookId');
	session_start();
	$username = $_SESSION['username'];
	if(!empty($username)){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if(!empty($bookId)){
				$host = "localhost";
				$dbusername = "root";
				$dbpassword = "";
				$dbname = $username;
				$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
				if(mysqli_connect_error())
				{
					die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
				}
				else
				{	
					$sql = "SELECT * FROM bookrecord WHERE bookId = '$bookId'";
					if($conn->query($sql))
					{
						$_SESSION['bookId'] = $bookId;
						header('Location: updateBookResult.php');
					}
					else
					{
						echo "Error: ". $sql ."<br>". $conn->error;
					}	
					$conn->close();
				}
			}
			else{
				echo "Enter bookId";
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
        <link rel="stylesheet" type="text/css" href="CSS/searchBookStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <div class="topnav">
                    <a id="inActive" href="addBook.php">Add Books</a>
                    <a id="inActive" href="searchBook.php">Books Search</a>
                    <a class="active" href="updateBook.php">Book Update</a>
                    <a id="inActive" href="borrower.php">Issue Book</a>
					<a id="inActive" href="bookSubmission.php">Book Submission</a>
					<a id="inActive" href="bookList.php">Book List</a>
					<a id="inActive" href="studRecord.php">Student Record</a>
                    <a href="Logout.php" id = "logout">Logout</a>
                  </div>
            <div id = "bottomLayout">
                <br><center><h2 id = "formHeading">Book Update</h2></center>
                <form action="updateBook.php" id = "searchForm" method = "POST">
                    <table id = "formLayout" cellspacing="10">
                        <tr id = "rowLayout"><td id="rowHeading"> Book Id:</td><td><input type="text" name="bookId" id = "input"></td></tr>
                    </table>
                    <br><center><input type="submit" value="Search" id = "update"></center><br>
                 </form>
				  
            </div>
        </center>    
    </body>
</html>