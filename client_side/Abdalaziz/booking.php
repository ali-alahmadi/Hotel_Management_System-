<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aaam"; // Replace with your actual database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $booking_id = random_int(10000, 99999);

        // Retrieve form data
        $check_in = $_POST['check_out'];
        $check_out = $_POST['check_in'];
        $num_adults = $_POST['num_adults'];
        $num_children = $_POST['num_children'];
        
        echo $check_in . $check_out;
        // Insert data into the database
        $sql = "INSERT INTO booking (booking_id, arrival_date, departure_date, num_adults, num_children) 
            VALUES ('$booking_id', '$check_in', '$check_out', '$num_adults', '$num_children')";

        $room_id = random_int(10000, 99999);
        $hotel_id = random_int(1, 4);

        $sql2 = "INSERT INTO room (room_id, category, price, hotel_id, booking_id) 
            VALUES ('$room_id', 'standard', '150', '$hotel_id', '$booking_id')";

        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
            // Redirect to the payment page

            header("Location: ../Ali/bill.php?booking_id=" . $booking_id);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
