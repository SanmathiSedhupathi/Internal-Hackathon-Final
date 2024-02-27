<?php
// Check if post_id parameter is set
if (isset($_GET['post_id'])) {
    // Get the email from the GET parameters
    $delete_email = $_GET['post_id'];
    
    // Assuming you have already established a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gatepass";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Call your delete post function using the email
    deletePost($delete_email, $conn);

    // Close the database connection
    $conn->close();
}

// Function to delete post
function deletePost($delete_email, $conn) {
    // Validate and sanitize delete_email to prevent SQL injection
    $delete_email = $conn->real_escape_string($delete_email);
   
    // SQL to delete the selected post
    $delete_sql = "DELETE FROM notice WHERE Email = '$delete_email'";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Post deleted successfully.')</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
