const menu = document.querySelector('#mobile-menu');
const menulinks = document.querySelector('.nav-menu');

menu.addEventListener('click',function() {
    menu.classList.toggle('is-active');
    menulinks.classList.toggle('active');
})



    function validateForm() {
        var fname = document.getElementById('fname').value;
        var lname = document.getElementById('lname').value;
        var phoneNumber = document.getElementById('phoneNumber').value;
        var email = document.getElementById('email').value;
        var hostelName = document.getElementById('hostelname').value;
        var roomNumber = document.getElementById('roomNumber').value;
        var complaintType = document.getElementById('complaintType').value;
        var complaintDescription = document.getElementById('complaintDescription').value;

        // Simple validation for demonstration purposes
        if (fname === '' || lname === '' || phoneNumber === '' || email === '' || hostelName === '' || roomNumber === '' || complaintType === '' || complaintDescription === '') {
            alert('All fields must be filled out');
            return false;
        }

        // Validate First Name and Last Name
        if (!/^[a-zA-Z]+$/.test(fname) || !/^[a-zA-Z]+$/.test(lname)) {
            alert('First Name and Last Name should contain only alphabetic characters');
            return false;
        }

        // Validate Phone Number format
        if (!/^\d{10}$/.test(phoneNumber)) {
            alert('Invalid Phone Number format. Use: +91 xxxxx xxxxx');
            return false;
        }

        // Validate Email format
        if (!/^[a-z0-9._%+-]+@(kongu)\.edu$/.test(email)) {
            alert('Invalid Email format. Use either gmail or yahoo domain.');
            return false;
        }

        // Validate Hostel Name
        if (hostelName === '') {
            alert('Please select a Hostel Name');
            return false;
        }

        // Validate Room Number - Three-digit number
        if (!/^\d{3}$/.test(roomNumber)) {
            alert('Invalid Room Number format. Use a three-digit number.');
            return false;
        }

        // Validate Complaint Type
        if (complaintType === '') {
            alert('Please select a Complaint Type');
            return false;
        }

        alert('Form submitted successfully!');
        
        document.getElementById('stComplaint').submit();
        displayDataOnAdminPage(fname, lname, phoneNumber, email, hostelName, roomNumber, complaintType, complaintDescription);
    }

    function displayDataOnAdminPage(fname, lname, phoneNumber, email, hostelName, roomNumber, complaintType, complaintDescription) {
        // You can send the form data to the server, save it to a database, or simply display it on the admin page
        var adminDisplay = document.getElementById('adminDisplay');

        // Create a new card to display the form data
        var cardDiv = document.createElement('div');
        cardDiv.classList.add('card');

        cardDiv.innerHTML = `
            <div class="card-body">
                <h5 class="card-title">${fname} ${lname}</h5>
                <p class="card-text"><strong>Phone Number:</strong> ${phoneNumber}</p>
                <p class="card-text"><strong>Email:</strong> ${email}</p>
                <p class="card-text"><strong>Hostel Name:</strong> ${hostelName}</p>
                <p class="card-text"><strong>Room Number:</strong> ${roomNumber}</p>
                <p class="card-text"><strong>Complaint Type:</strong> ${complaintType}</p>
                <p class="card-text"><strong>Complaint Description:</strong> ${complaintDescription}</p>
            </div>
        `;

        // Append the new card to the admin display area
        adminDisplay.appendChild(cardDiv);
    }




   
       
   
