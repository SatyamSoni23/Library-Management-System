<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Library Managemenr System
        </title>
        <link rel="stylesheet" type="text/css" href="CSS/searchResultStyle.css">
    </head>
    <body background="Images/home.jpg">
        <center>
             <div>
                <img src="Images/home1.jpg" class = "topImage">  
            </div>
            <div class="topnav">
                    <a id="inActive" href="addBook.php">Add Books</a>
                    <a class="active" href="searchBook.php">Books Search</a>
                    <a id="inActive" href="updateBook.php">Book Update</a>
                    <a id="inActive" href="borrower.php">Issue Book</a>
					<a id="inActive" href="bookSubmission.php">Book Submission</a>
					<a id="inActive" href="bookList.php">Book List</a>
					<a id="inActive" href="studRecord.php">Student Record</a>
                    <a href="main.php" id = "logout">Logout</a>
                  </div>
            <div id = "bottomLayout">
                <br><center><h2 id = "formHeading">Search Books</h2></center>

                <br>
            </div>
        </center>    
    </body>
</html>