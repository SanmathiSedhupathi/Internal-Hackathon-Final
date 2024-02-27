<html>
    <head>
        <title>Dash Board</title>
        <link rel="stylesheet" href="./Dash_Board_Stud_Style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!--  The Tailwind CSS CDN link in your HTML file -->
        <link href="https://cdn.tailwindcss.com" rel="stylesheet">

    </head>
    <body>
        <div class="nav" style="margin: 0px 75px;">
            <div style="display: flex;">
                <div>
                    <img src="logo.jpg" height="75px" width="75px">
                </div>
                <div style="padding-top: 5px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                    <p style="font-size: 28px;"><b>Kec</b>Hostel</p>
                </div>
            </div>
            <div style="padding-top: 23px; font-family:Arial, Helvetica, sans-serif; font-size: 20px;font-weight: 400;" class="nac_link">
                <a href="#">Notices</a>
                <a href="C:\HackWave\Pass_Stud\pass_stud.html">Apply Pass</a>
                <a href="#">Complaints</a>
                <a href="C:\HackWave\review_stud\review.html">Reviews</a>
                <button class="button">
                    <span>Sign Out</span>
                  </button>  
            </div>
        </div><br>
      <div class="slider" style="width: 100%;">
        <div class="myslides" style="display: inline-block;position: relative;">
            <img  src="guest.jpg" width="100%" height="60%">
            <div class="overlay-text" style="width: 25%;">
                
                <h1 style="font-family: 'Times New Roman', Times, serif; font-size:60px;">Get Day to Day Updates</h1>
                <p style="font-size: 32px; font-family: Arial, Helvetica, sans-serif;">"Thoughts shared, connections made."</p>
                <a href="#"><button class="more_btn">More</button></a>
            </div>
        </div>
        <div class="myslides" style="display: inline-block;position: relative;">
            <img  src="bhavani.jpg" width="100%" height="60%">
            <div class="overlay-text" style="width: 25%;">
                
                <h1 style="font-family: 'Times New Roman', Times, serif; font-size:40px;">Announcements: where information meets attention</h1>
                <p style="font-size: 20px; font-family: Arial, Helvetica, sans-serif;">" Messages regarding hostel rules, regulations, and updates from the hostel administration."</p>
                <a href="#"><button class="more_btn">More</button></a>
            </div>
        </div>
        <div class="myslides" style="display: inline-block;position: relative;">
            <img  src="hostel.png" width="100%" height="60%">
            <div class="overlay-text" style="width: 25%;">
                
                <h1 style="font-family: 'Times New Roman', Times, serif; font-size:60px;">Lost and Found</h1>
                <p style="font-size: 20px; font-family: Arial, Helvetica, sans-serif;">"Items reported missing or found within the hostel premises."</p>
                <a href="#"><button class="more_btn">More</button></a>
            </div>
        </div>
      </div>
      <br><br>
      <!---Main Content-->

    </div>
      <div>
        <h1 style="font-family: Verdana, Geneva, Tahoma, sans-serif;text-align: center;">A board of notices, a canvas of <br>communication.</h1>
      </div>
    <div class="anime2" style="z-index: -1;" >
        <div class="lol">
            <div class="circle"></div>
            <div class="pulse"></div>
        </div>
    </div>
      <div class="card-container" style="display: inline-flex;padding-left:20px">
      <?php
// Assuming you have a database connection established
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "gatepass"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the notice table
$sql = "SELECT * FROM notice"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $eventName = $row["Event_Name"];
        $description = $row["description"];
        $date=$row["Date"];
        $imageURL = $row["Poster"]; 

        // Output the HTML for the card with the fetched data including the image
        echo "<div class='card'>";
        echo "<img src='$imageURL'>"; // Output the image
        echo "<div class='card-content'>";
        echo "<h1>$eventName</h1>";
        echo "<p>On $date</p>";
        echo "$description";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
</div>
      <br><br><br>

    </body>
    <script>
        var myIndex = 0;
        carousel();
        
        function carousel() {
          var i;
          var x = document.getElementsByClassName("mySlides");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          myIndex++;
          if (myIndex > x.length) {myIndex = 1}    
          x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 5000); // Change image every 4 seconds
        }
        </script>
</html>