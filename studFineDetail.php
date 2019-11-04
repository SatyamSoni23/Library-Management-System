
<!DOCTYPE html>
<html>
    <head>
        <title>
            Library Managemenr System
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/studFineDetailStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <div class="topnav">
					<a id="inActive" href="studBookSearch.php">Books Search</a>
                    <a id="inActive" href="studBookList.php">Book List</a>
                    <a id="inActive" href="studIssued.php">Issued</a>
                    <a class="active" href="studFineDetail.php">Fine Details</a>
                    <a href="Logout.php" id = "logout">Logout</a>
                  </div>
            <div id = "bottomLayout">
                <br><center><h2 id = "formHeading">Fine Details</h2></center>
				 <?php
					session_start();
					$adminname = $_SESSION['adminname'];
					$studUsername = $_SESSION['studUsername'];
							$host = "localhost";
							$dbusername = "root";
							$dbpassword = "";
							$dbname = $adminname;
							$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
							if(empty($adminname)){
								session_destroy();
								$_SESSION = array();
								header("location: main.php");
							}
							if(mysqli_connect_error())
							{
								die('Connect Error ('.mysqli_connect_error().')'.mysqli_connect_error());
							}
							else
							{	
								date_default_timezone_set('Asia/Calcutta');
								$currentDate = date('Y/m/d');
								$sql1 = "SELECT * FROM borrower WHERE studUsername = '$studUsername' && returnDate <= '$currentDate'";
								$result = $conn->query($sql1);
								if($result->num_rows > 0)
								{	
									echo "<table border='1'>
									<tr>
									<th>Book Id</th>
									<th>Extra Days</th>
									</tr>";
									while($row = mysqli_fetch_array($result))
									{
										echo "<tr>";
										echo "<td>" . $row['bookId'] . "</td>";
										$datetime1 = strtotime($row['returnDate']);
										$datetime2 = strtotime($currentDate);
										$secs = $datetime2 - $datetime1;
										$days = $secs / 86400;
										echo "<td>" . $days . "</td>";
										echo "</tr>";
									}
									echo "</table><br><br>";	
								}
								else
								{
									echo "No Fine";
								}	
								$conn->close();
							}
						
				?> 
            </div>
        </center>    
    </body>
</html>