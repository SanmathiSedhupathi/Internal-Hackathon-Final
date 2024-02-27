<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notice Upload Form</title>
  <!-- Integrate Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for animations */
    @keyframes fade-in {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }
    @keyframes slide-in {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(0); }
    }
    .animate-fade-in {
      animation: fade-in 1s ease-out;
    }
    .animate-slide-in {
      animation: slide-in 1s ease-out;
    }
    /* Hover animation for buttons */
    .hover-animation:hover {
      transform: translateY(-2px);
      transition: all 0.3s ease;
    }
    /* Pop-up modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      border-radius: 10px;
    }
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
</head>
<body class="bg-white">
  <div class=" nav bg-purple-700 text-white py-4 px-8 flex justify-between items-center">
    <div class="flex">
        <div>
            <img src="logo.jpg" alt="Logo" class="h-16 w-16">
        </div>
        <div class="pl-4">
            <p class="text-3xl font-bold">Kec Hostel</p>
        </div>
    </div>
    <div class="text-xl font-medium">
        <a href="#" class="mx-4">Home</a>
        <a href="#" class="mx-4">Notices</a>
        <a href="#" class="mx-4">Apply Pass</a>
        <a href="#" class="mx-4">Complaints</a>
        <a href="#" class="mx-4">Contact</a>
        <button class="bg-blue-800 text-white px-6 py-2 rounded-full border border-gray-400 transition duration-300 hover:bg-red-500 hover:text-white">Sign Out</button>
    </div>
</div>

  <!-- Header Section -->
  <header class="py-6 relative">
    <div class="container mx-auto">
        <div class="flex items-start justify-start h-64 ">
            <img src="hos2.png" alt="Your Image" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0"></div>
            <div class="text-black text-4xl font-bold absolute z-10 top-0 left-0 mt-6 ml-6"><br>
                <h1 class="text-center text-black">Notice Upload Form</h1>
            </div>
        </div>
    </div>
</header>


  
  <!-- Main Content Section -->
  <main>
  <div class="content" style="display: flex;font-family: Arial, Helvetica, sans-serif">
      <div style="width: 60%;">
          <img src="https://cdn.dribbble.com/users/2520294/screenshots/7269423/alaminxyz.gif">
      </div>
    <!-- Notice Upload Form -->
    <section class="py-12">
      <div class="container mx-auto">
        <?php
    // Define MySQL database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "notice";

    // Create connection
    $conn = new mysqli('localhost', 'root', '', 'notice');

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Create directory for uploads if it doesn't exist
      $uploadDir = "uploads/";
      if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      // Prepare SQL statement
      $sql = "INSERT INTO upload (email, eventName, eventDescription, noticeImage, eventDate)
              VALUES (?, ?, ?, ?, ?)";
      
      // Bind parameters
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssss", $email, $eventName, $eventDescription, $targetFile, $eventDate);

      // Set parameters and execute
      $email = $_POST['email'];
      $eventName = $_POST['eventName'];
      $eventDescription = $_POST['eventDescription'];
      // Handle image upload
      $noticeImage = $_FILES['noticeImage']['name'];
      $targetFile = $uploadDir . basename($noticeImage);
      move_uploaded_file($_FILES['noticeImage']['tmp_name'], $targetFile);
      $eventDate = $_POST['eventDate'];
      
      if ($stmt->execute()) {
        echo "Notice uploaded successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      // Close statement
      $stmt->close();
    }

    // Close connection
    $conn->close();
?>

        <form  method="post" id="uploadForm" class="max-w-lg mx-auto bg-gray-100 p-8 rounded-lg shadow-md animate-slide-in" enctype="multipart/form-data" onsubmit="submitForm(); return false;">

          <div class="mb-6">
            <label for="email" class="block text-gray-800 font-semibold mb-2">User Email:</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-red-500" required>
          </div>
          <div class="mb-6">
            <label for="eventName" class="block text-gray-800 font-semibold mb-2">Event Name:</label>
            <input type="text" id="eventName" name="eventName" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-red-500" required>
          </div>
          <div class="mb-6">
            <label for="eventDescription" class="block text-gray-800 font-semibold mb-2">Event Description:</label>
            <textarea id="eventDescription" name="eventDescription" rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-red-500" required></textarea>
          </div>
          <div class="mb-6">
            <label for="noticeImage" class="block text-gray-800 font-semibold mb-2">Notice Image:</label>
            <input type="file" id="noticeImage" name="noticeImage" accept="image/*" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-red-500" required>
          </div>
          <div class="mb-6">
            <label for="eventDate" class="block text-gray-800 font-semibold mb-2">Date of Event:</label>
            <input type="datetime-local" id="eventDate" name="eventDate" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-red-500" required>
          </div>
          <button type="submit" class="bg-purple-800 text-white px-6 py-3 rounded-lg hover-animation hover:bg-red-500">Submit</button>
        </form>
      </div>
    </section>
  </main>

  <!-- Success Modal -->
  <div id="successModal" class="modal">
    <div class="modal-content bg-white p-8 rounded-lg shadow-md mx-auto mt-24">
      <span class="close">&times;</span>
      <p class="text-2xl font-semibold text-green-500 text-center mb-4">Successfully Uploaded!</p>
      <p class="text-gray-800 text-center">Your notice has been successfully uploaded. Thank you!</p>
    </div>
  </div>

  <!-- JavaScript for form validation and modal display -->
  <script>
    function submitForm() {
      const form = document.getElementById('uploadForm');
      if (validateForm()) {
        form.submit();
      }
    }
  
    function validateForm() {
      const email = document.getElementById('email').value;
      const eventName = document.getElementById('eventName').value;
      const eventDescription = document.getElementById('eventDescription').value;
      const noticeImage = document.getElementById('noticeImage').value;
      const eventDate = document.getElementById('eventDate').value;
  
      if (!email || !eventName || !eventDescription || !noticeImage || !eventDate) {
        alert('Please fill in all fields');
        return false;
      }
  
      if (!validateEmail(email)) {
        alert('Please enter a valid email address');
        return false;
      }
  
      if (!isFutureDate(eventDate)) {
        alert('Please select an upcoming date for the event');
        return false;
      }
  
      return true;
    }
  
    function validateEmail(email) {
      const re = /\S+@\S+\.\S+/;
      return re.test(email);
    }
  
    function isFutureDate(date) {
      const currentDate = new Date();
      const selectedDate = new Date(date);
      return selectedDate > currentDate;
    }
  </script>
  

  <!-- PHP code to connect backend with MySQL -->
 

  
<!-- Footer -->
<footer class="footer bg-blue-900 text-white">
    <div class="inner-footer w-11/12 mx-auto py-8 flex flex-wrap justify-center">
        <!-- Company info -->
        <div class="footer-items w-full sm:w-1/2 md:w-1/4 lg:w-1/4 px-4">
            <h1 class="text-3xl font-bold">KEC HOSTEL</h1>
            <p class="mt-4">Kongu Engineering College, Perundurai.</p>
        </div>
       
        <!-- Contact info -->
        <div class="footer-items w-full sm:w-1/2 md:w-1/4 lg:w-1/4 px-4">
            <h3 class="text-xl font-semibold">Contact us</h3>
            <div class="border1 my-2"></div>
            <ul>
                <li><i class="fa fa-map-marker mr-2" aria-hidden="true"></i>XYZ, abc</li>
                <li><i class="fa fa-phone mr-2" aria-hidden="true"></i>123456789</li>
                <li><i class="fa fa-envelope mr-2" aria-hidden="true"></i>xyz@gmail.com</li>
            </ul>
        </div>
        <!-- Google Map -->
        <div class="footer-items w-full sm:w-1/2 md:w-1/4 lg:w-1/4 px-4">
            <h3 class="text-xl font-semibold">Location</h3>
            <div class="border1 my-2"></div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3890.865702408721!2d77.74833741434376!3d11.339694991858616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba9035b9f29ef89%3A0x92e2c229b4d688f3!2sKongu%20Engineering%20College!5e0!3m2!1sen!2sin!4v1645989469817!5m2!1sen!2sin" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    <!-- Footer bottom -->
    <div class="footer-bottom text-center py-2 bg-rgb(16, 3, 47)">
        Copyright &copy; KEC Hostel 2024.
    </div>
</footer>


</body>
</html>
