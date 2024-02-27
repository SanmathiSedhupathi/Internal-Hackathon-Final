<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Notice Board - Hotel Management</title>
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
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }
    .animate-fade-in {
      animation: fade-in 1s ease-out;
    }
    .animate-slide-in {
      animation: slide-in 15s linear infinite;
    }
    .animate-pulse {
      animation: pulse 2s infinite;
    }
    /* Parallax scrolling effect */
    .parallax-bg {
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
    /* Additional Styles */
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    /* Styling for image links */
    .image-link {
      display: block;
      width: 100%;
      height: 100%;
      text-decoration: none;
      color: inherit;
      position: relative;
    }
    .image-link:hover .overlay {
      opacity: 1;
    }
    .overlay {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    .view-button {
      padding: 8px 16px;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .view-button:hover {
      background-color: #555;
    }
    /* Styling for image slider buttons */
    .slider-controls {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 10;
    }
    .arrow-btn {
      background-color: rgba(255, 255, 255, 0.5);
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      cursor: pointer;
    }
    .arrow-btn:hover {
      background-color: rgba(255, 255, 255, 0.8);
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class=" nav bg-white text-black py-4 px-8 flex justify-between items-center">
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
  <header class="relative">
  <div class="py-1">
    <img src="party.jpg" alt="Background Image" width="100%" height="50%">
    <div class="absolute inset-0 flex justify-center items-center">
      <div class="bg-white p-6 text-center rounded-lg animate-pulse">
        <h1 class="text-gray-800 text-4xl font-bold text-blue-800">Welcome to Our College Notice Board</h1><br>
        <p class="text-sanserif font-semibold" >Stay updated with the latest news, announcements, and events happening on campus by checking out our college notice board.
          <br>This dynamic platform serves as a central hub for important information, ensuring that you never miss out <br>on anything happening within our vibrant college community.</p>
      </div>
    </div>
  </div>
</header>



  <!-- Main Content Section -->
  <main>
    <!-- Notice Section 1 -->
    <!-- Notice Section -->
<section class="py-12">
  <div class="container mx-auto">
    <?php
      // Connect to the database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "notice";
      $conn = new mysqli('localhost', 'root', '', 'notice');
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      // Fetch data from database
      $sql = "SELECT * FROM upload;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center animate-fade-in">
      <div class="animate-fade-in">
        <div class="card bg-white p-6 rounded-lg shadow-md">
          <h2 class="text-3xl font-semibold text-black mb-4"><?php echo $row['eventName']; ?></h2>
          <p class="text-gray-600 mb-6"><?php echo $row['eventDescription'] . " - " . $row['eventDate']; ?></p>
          <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 view-button">View</button>
        </div>
      </div>
      <div class="animate-fade-in">
        <img src="<?php echo $row['noticeImage']; ?>" alt="Notice" class="w-full rounded-lg shadow-lg">
      </div>
    </div>
    <?php
        }
      } else {
        echo "No notices available";
      }
      $conn->close();
    ?>
  </div>
</section>

    
    <!-- Other Notice Sections -->

  </main>
  
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
