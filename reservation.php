<?php
if (isset($_POST['customer_name']) && isset($_POST['customer_email_id']) && isset($_POST['customer_phone_no']) && isset($_POST['booking_date']) && isset($_POST['timing']) && isset($_POST['no_of_guests']) && isset($_POST['special_requests'])) {
    $name = $_POST['customer_name'];
    $email = $_POST['customer_email_id'];
    $phone = $_POST['customer_phone_no'];
    $date = $_POST['booking_date'];
    $time = $_POST['timing'];
    $guest = $_POST['no_of_guests'];
    $message = $_POST['special_requests'];

    if (!empty($name) && !empty($email) && !empty($phone) && !empty($date) && !empty($time) && !empty($guest) && !empty($message)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "finalyr_project";

        // Create connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind statement
        $stmt = $conn->prepare("INSERT INTO reservation (customer_name, customer_email_id, customer_phone_no, booking_date, timing, no_of_guests, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $phone, $date, $time, $guest, $message);

        // Execute statement
        if ($stmt->execute()) {
            // Redirect to success page
            header("Location: reservationsuccess.html");
            exit; // Stop further execution of PHP script
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and conction//////
        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required";
    }
} else {
    echo "Invalid request";
}
?>
