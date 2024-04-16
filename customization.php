<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $cake_type = $_POST['cake-type'];
    $cake_weight = $_POST['cake-weight'];
    $party_theme = $_POST['party-theme'];
    $food_from_hotel = isset($_POST['food-from-hotel']) ? "Yes" : "No";
    $food_items = isset($_POST['food-item']) ? implode(", ", $_POST['food-item']) : "None selected";
    $members = $_POST['members'];
    $total_cost = $_POST['total-cost'];
    $total_amount_to_pay = $_POST['total-amount-to-pay'];

   
    $conn = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO customization (cake_type, cake_weight, party_theme, food_from_hotel, food_items, members, total_cost, total_amount_to_pay)
    VALUES ('$cake_type', '$cake_weight', '$party_theme', '$food_from_hotel', '$food_items', '$members', '$total_cost', '$total_amount_to_pay')";

    if ($conn->query($sql) === TRUE) {
        echo "Party customization details saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    
    
    // For demonstration purpose, let's just output the data
    echo "<h2>Party Customization Details:</h2>";
    echo "<p><strong>Type of Cake:</strong> $cake_type</p>";
    echo "<p><strong>Cake Weight:</strong> $cake_weight</p>";
    echo "<p><strong>Party Theme:</strong> $party_theme</p>";
    echo "<p><strong>Food from Hotel:</strong> $food_from_hotel</p>";
    echo "<p><strong>Selected Food Items:</strong> $food_items</p>";
    echo "<p><strong>Number of Members:</strong> $members</p>";
    echo "<p><strong>Total Cost for All Members:</strong> $total_cost</p>";
    echo "<p><strong>Total Amount to Pay:</strong> $total_amount_to_pay</p>";
}
?>
