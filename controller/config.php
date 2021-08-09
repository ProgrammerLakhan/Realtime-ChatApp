<?php
    $conn = mysqli_connect("localhost","root","123456","chatapp");
    if (!$conn) {
        echo "Database connection error: ".mysqli_connect_error();
    }
?>