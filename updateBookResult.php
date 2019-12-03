<!DOCTYPE html>
<html>
    <head>
        <title>
            Library Managemenr System
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/updateResultStyle.css">
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
                <br><center><h2 id = "formHeading">Update Book</h2></center>
				<?php
					session_start();
					if(!empty($username)){
						$bookId = $_SESSION['bookId'];
						echo "<h3>"."Book Id : ".$bookId."</h3>";
					}				
				?>
				<form action="updateBookResult.php" method = "POST">
                    <table id = "formLayout" cellspacing="10">
                        <tr id = "rowLayout"><td id="rowHeading"> Title:</td><td><input type="text" name="title" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> Author Name:</td><td><input type="text" name="authorName" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> Cost:</td><td><input type="text" name="cost" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> Quantity:</td><td><input type="text" name="quantity" id = "input"></td></tr>
                    </table>
                    <br><center><input type="submit" value="Add"></center><br>
                 </form>
				<?php
					$title = filter_input(INPUT_POST, 'title');
					$authorName = filter_input(INPUT_POST, 'authorName');
					$cost = filter_input(INPUT_POST, 'cost');
					$quantity = filter_input(INPUT_POST, 'quantity');
					$bookId = $_SESSION['bookId'];
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
									$sql = "UPDATE bookrecord SET title = '$title', authorName = '$authorName', cost = '$cost', quantity = '$quantity' WHERE bookId = '$bookId'";
									
									if($conn->query($sql))
									{
										echo "Update Successfull. <br>";
									}
									else
									{
										echo "Error: ". $sql ."<br>". $conn->error;
									}	
									$conn->close();
								}	
							}
							else{
								echo "Empty record";
							}	
						}
					}	
					else{
						session_destroy();
						$_SESSION = array();
						header("location: main.php");
					}	
				?>
                <br>
            </div>
        </center>    
    </body>
</html>