<html>
    <head>
        <title>Dash Board</title>
        <link rel="stylesheet" href="./Notice_admin_style.css">
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

       <div style="display: flex; justify-content: space-evenly;">
        <div style="margin-left: 15px;" class="side_img"></div>
        <div>
           <br><br><br><br>
            <div class="notice_form">
                <div class="container">
                    <div class="title">Disseminate bulletins</div>
                    <form action="#" method="post" enctype="multipart/form-data">>
                      <div class="user__details">
                        <div class="input__box">
                          <span class="details">Full Name</span>
                          <input type="text" placeholder="E.g: John Smith" name="name" required><br>
                        </div>
                        <div class="input__box">
                          <span class="details">Email</span>
                          <input type="email" placeholder="johnsmith@kongu.edu" name="email" required>
                        </div><br>
                        <div class="input__box">
                          <span class="details">Phone Number</span>
                          <input type="tel"  name="Ph_number" required>
                        </div><br>
                        <div class="input__box">
                          <span class="details">Event Name</span>
                          <input type="text"  name="event_name" required>
                        </div><br>
                        <div class="input__box">
                            <span class="details">Upload Poster</span>
                            <input type="file"  name="poster" required>
                          </div><br>
                          <div class="input__box">
                            <span class="details">Date</span>
                            <input type="date"  name="date" required>
                          </div><br>
                        <div class="input__box">
                          <span class="details">Event Description</span>
                          <textarea name="desc" rows="5" cols="50"></textarea>
                        </div><br>
                      </div>
    
                      <div class="button">
                        <button type="submit" class="submit_btn">Publish</button>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
  </div><br><br>
      <h1 style="color:greay;font-size:50px;padding-left:500px">Recent Posts</h1>  
        <?php
// Assuming you have a database connection established
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "gatepass"; // Change this to your dtabase name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check if a date is in the future
function isFutureDate($date) {
    return (strtotime($date) > time());
}

// Function to securely handle file uploads
function handleFileUpload($file) {
    $targetDir = "uploads/"; // Directory where files will be stored

    // Create the directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        return $targetFile;
    }

    // Check file size (optional)
    if ($file["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.')</script>";
        $uploadOk = 0;
    }

    // Allow only certain file formats (you can customize this)
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "<script>('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.')</script>";
    } else {
        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile; // Return the path to the uploaded file
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['Ph_number'];
    $eventName = $_POST['event_name'];
    $poster = handleFileUpload($_FILES['poster']);
    $date = $_POST['date'];
    $description = $_POST['desc'];

    // Check if the date is a future date
    if (!isFutureDate($date) && !($uploadOk == 1)) {
        echo "<script>alert('Error: Please enter a future date.')</script>";
    } else {
        // SQL to insert data into the database
        $sql = "INSERT INTO notice (name, email, Phonenumber, event_name, poster, date, description) VALUES ('$name', '$email', '$phoneNumber', '$eventName', '$poster', '$date', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

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

// SQL query to fetch recent posts
$sql = "SELECT * FROM notice ORDER BY email DESC LIMIT 5"; // Assuming 'id' is the primary key

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $name = $row["Name"];
        $email = $row["Email"];
        $phoneNumber = $row["PhoneNumber"];
        $eventName = $row["Event_Name"];
        $poster = $row["Poster"];
        $date = $row["Date"];
        $description = $row["description"];

        // Format the date
        $formattedDate = date("M d, Y", strtotime($date));

        // Display the post with extra styles
        echo "<div class='post' style='display:flex;gap:6px'>";
        echo "<div><img src='$poster' alt='Event Poster' class='post-image' style='align-item:center;'></div>";
        echo "<div style='align-item:center;'><br><br><br><h3 class='post-title'>$eventName</h3><hr>";
        echo "<p class='post-meta'>Posted by $name on $formattedDate</p>";
        
        echo "<p class='post-description'>$description</p>";
        // Add delete button
        echo "<a href='delete_post.php?post_id=$email' onclick='return confirm(\"Are you sure you want to delete this post?\")'><i class='fa fa-trash' style='color:red'></i></a>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>

