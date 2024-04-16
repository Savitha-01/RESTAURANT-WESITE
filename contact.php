<?php
if (isset($_POST['customer_name']) && isset($_POST['customer_email_id']) && isset($_POST['customer_phone_no'])&& isset($_POST['any_special_request'])) {
    $name = $_POST['customer_name'];
    $email = $_POST['customer_email_id'];
    $phone=$_POST['customer_phone_no'];
    $message = $_POST['any_special_request'];

    if (!empty($name) && !empty($email) && !empty($phone) && !empty($message)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "finalyr_project";

        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO contact(customer_name, customer_email_id, customer_phone_no,any_special_request) VALUES (?, ?, ?,?)");

            $stmt->bind_param("ssss", $name, $email,  $phone,$message);

            if ($stmt->execute()) {
                // Redirect to success page
                echo "<script>window.location.href = 'contactSuccess.html';</script>";
                exit; // Stop further execution of PHP script
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    } else {
        echo "All fields are required";
    }
} else {
    echo "Invalid request";
}
?>