<?php
session_start();
include "../connection.php"; // Ensure this file properly establishes the $link connection

if (!isset($_SESSION['exam_category'])) {
    echo "Error: Exam category not set.";
    exit;
}

$exam_category = $_SESSION['exam_category'];
$total_que = 0;

// Check if the connection is properly established
if ($link) {
    // Prepare and execute the query safely
    $res1 = mysqli_query($link, "SELECT * FROM questions WHERE category='$exam_category'");

    if ($res1) {
        // Get the number of rows (i.e., total questions)
        $total_que = mysqli_num_rows($res1);
        echo $total_que;
    } else {
        // Log or display error in case the query fails
        echo "Error in executing query: " . mysqli_error($link);
    }
} else {
    echo "Database connection error.";
}
?>
