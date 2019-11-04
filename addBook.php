<?php
	$bookId = filter_input(INPUT_POST, 'bookId');
	$title = filter_input(INPUT_POST, 'title');
	$authorName = filter_input(INPUT_POST, 'authorName');
	$cost = filter_input(INPUT_POST, 'cost');
	$quantity = filter_input(INPUT_POST, 'quantity');
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
					$sql = "INSERT INTO bookrecord VALUES('$bookId', '$title', '$authorName', '$cost', '$quantity')";
					if($conn->query($sql))
					{
						echo "<center><p style='color:#ffffff;'>New record is inserted successfully.</p><center>";
					}
					else
					{
						echo "<center><p style='color:#ffffff;'>This book is previously added.</p><center>";
					}	
					$conn->close();
				}	
			}
			else{
				echo "Empty record";
			}	
		}
		if (isset($_POST['logout'])){
			session_destroy();
			$_SESSION = array();
			header("location: home.php");
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
        <link rel="stylesheet" type="text/css" href="CSS/addBookStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <div class="topnav">
                <a class="active" href="addBook.php">Add Books</a>
                <a id="inActive" href="searchBook.php">Books Search</a>
                <a id="inActive" href="updateBook.php">Book Update</a>
                <a id="inActive" href="borrower.php">Issue Book</a>
				<a id="inActive" href="bookSubmission.php">Book Submission</a>
				<a id="inActive" href="bookList.php">Book List</a>
				<a id="inActive" href="studRecord.php">Student Record</a>
                <a id="logout" href="Logout.php" name = "logout">Logout</a>
            </div>
            <div id = "bottomLayout">
                <br><center><h2>Add Books</h2></center>
                <form action="addBook.php" method = "POST">
                    <table id = "formLayout" cellspacing="10">
                        <tr id = "rowLayout"><td id="rowHeading"> Book Id :  </td><td><input type="text" name="bookId" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> Title :  </td><td><input type="text" name="title" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> Author Name :  </td><td><input type="text" name="authorName" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> Cost :  </td><td><input type="text" name="cost" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> Quantity :  </td><td><input type="text" name="quantity" id = "input"></td></tr>
                    </table>
                    <br><center><input type="submit" value="Add"></center><br>
                  </form><br>
            </div>
        </center>    
    </body>
</html>