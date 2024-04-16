<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if (isset($_POST['card_number'], $_POST['holder_name'], $_POST['expirydate'], $_POST['cvv'])) {
        // Retrieve form data
        $cardno = $_POST['card_number'];
        $holdername = $_POST['holder_name'];
        $expdate = $_POST['expirydate'];
        $cvv = $_POST['cvv'];

        // Validate form data
        if (!empty($cardno) && !empty($holdername) && !empty($expdate) && !empty($cvv)) {

            $host = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "finalyr_project";

            // Create connection
            $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
            }

            // Prepare SQL statement
            $stmt = $conn->prepare("INSERT INTO payment (card_number, holder_name, expirydate, cvv) VALUES (?, ?, ?, ?)");

            // Bind parameters to statement
            $stmt->bind_param("ssss", $cardno, $holdername, $expdate, $cvv);

            // Execute statement
            if ($stmt->execute()) {
                // Data inserted successfully
                header("Location: paymentsuccesspage1.html");
                exit; // Stop further execution
            } else {
                // Error occurred during execution
                echo "Error: " . $stmt->error;
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        } else {
            // All fields are required
            echo "All fields are required";
        }
    } else {
        // Invalid request
        echo "Invalid request";
    }
}
?>
