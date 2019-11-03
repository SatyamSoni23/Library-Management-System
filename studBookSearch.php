
<!DOCTYPE html>
<html>
    <head>
        <title>
            Library Managemenr System
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/studSearchBookStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <div class="topnav">
					<a class="active" href="studBookSearch.php">Books Search</a>
                    <a id="inActive" href="studBookList.php">Book List</a>
                    <a id="inActive" href="studIssued.php">Issued</a>
                    <a id="inActive" href="studFineDetail.php">Fine Details</a>
                    <a href="Logout.php" id = "logout">Logout</a>
                  </div>
            <div id = "bottomLayout">
                <br><center><h2 id = "formHeading">Search Books</h2></center>
                <form action="studBookSearch.php" id = "searchForm" method = "POST">
                    <table id = "formLayout" cellspacing="10">
                        <tr id = "rowLayout"><td id="rowHeading"> Book Name:</td><td><input type="text" name="title" id = "input"></td></tr>
						<tr id = "rowLayout"><td id="rowHeading"> Author Name:</td><td><input type="text" name="authorName" id = "input"></td></tr>
                    </table>
                    <br><center><input type="submit" value="Search"></center><br>
                 </form>
				 <?php
					$title = filter_input(INPUT_POST, 'title');
					$authorName = filter_input(INPUT_POST, 'authorName');
					session_start();
					$adminname = $_SESSION['adminname'];
					if(empty($adminname)){
						session_destroy();
						$_SESSION = array();
						header("location: main.php");
					}
					if($_SERVER["REQUEST_METHOD"] == "POST"){
						if(!empty($title) || !empty($authorName)){
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
								$result = mysqli_query($conn,"SELECT * FROM bookrecord WHERE title = '$title' OR authorName = '$authorName'");
								echo "<table border='1'>
									<tr>
									<th>Book Id</th>
									<th>Title</th>
									<th>Author Name</th>
									<th>Cost</th>
									<th>Quantity</th>
									</tr>";
								while($row = mysqli_fetch_array($result))
								{
									echo "<tr>";
									echo "<td>" . $row['bookId'] . "</td>";
									echo "<td>" . $row['title'] . "</td>";
									echo "<td>" . $row['authorName'] . "</td>";
									echo "<td>" . $row['cost'] . "</td>";
									echo "<td>" . $row['quantity'] . "</td>";
									echo "</tr>";
								}
								echo "</table><br><br>";
							}
						}
						else{
							echo "Enter Book Name or Author Name";
						}
					}	
				?> 
            </div>
        </center>    
    </body>
</html>