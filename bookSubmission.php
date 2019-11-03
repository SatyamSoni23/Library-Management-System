<!DOCTYPE html>
<html>
    <head>
        <title>
            Library Managemenr System
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/bookSubmissionStyle.css">
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
                    <a id="inActive" href="borrower.php">Issue Book</a>
					<a class="active" href="bookSubmission.php">Book Submission</a>
					<a id="inActive" href="bookList.php">Book List</a>
					<a id="inActive" href="studRecord.php">Student Record</a>
                    <a href="Logout.php" id = "logout">Logout</a>
                  </div>
            <div id = "bottomLayout">
                <br><center><h2 id = "formHeading"> Book Submission </h2></center><br>
                <form action="bookSubmission.php" method = "POST">
                    <table id = "formLayout" cellspacing="10">
                        <tr id = "rowLayout"><td id="rowHeading"> Student Username :  </td><td><input type="text" name="studUsername" id = "input"></td></tr>
                        <tr id = "rowLayout"><td id="rowHeading"> BookId :  </td><td><input type="text" name="bookId" id = "input"></td></tr>
                    </table>
                    <br><center><input type="submit" value="Submit"></center><br>
                 </form>
				 <?php
					$studUsername = filter_input(INPUT_POST, 'studUsername');
					$bookId = filter_input(INPUT_POST, 'bookId');
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
									{	$sql1 = "SELECT * FROM borrower WHERE studUsername = '$studUsername' && bookId = '$bookId'";
										$sql2 = "SELECT * FROM bookrecord WHERE bookId = '$bookId'";
										$result = $conn->query($sql1);
										$result1 = $conn->query($sql2);
										if($result->num_rows > 0 && $result1->num_rows > 0)
										{	
											
											$row = mysqli_fetch_array($result);
											$returnDate = $row['returnDate'];
											date_default_timezone_set('Asia/Calcutta');
											if(strtotime($returnDate) <= strtotime(date('Y/m/d'))){
												echo "Late Submission<br>";
											}
											else{
												echo "Successfull Submission<br>";
											}	
											$sql = "DELETE FROM borrower WHERE studUsername = '$studUsername' && bookId = '$bookId'";
											$conn->query($sql);
											$row1 = $result1->fetch_assoc();
											$quantity = $row1["quantity"];
											$quantity = $quantity + 1;
											$sql3 = "UPDATE bookrecord SET quantity = '$quantity' WHERE bookId = '$bookId'";
											$conn->query($sql3);
											
										}
										else
										{
											echo "Book not issue<br>";
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
            </div>
        </center>    
    </body>
</html>