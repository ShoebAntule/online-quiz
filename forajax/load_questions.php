<?php
session_start();
include "../connection.php";

// Get the current question number from the GET request
$questionno = intval($_GET["questionno"]);

// Fetch total questions count in the category
$res = mysqli_query($link, "SELECT COUNT(*) as total FROM questions WHERE category='$_SESSION[exam_category]'");
$row = mysqli_fetch_array($res);
$total_questions = $row['total'];

// Check if the current question number exceeds the total number of questions
if ($questionno > $total_questions) {
    echo "over";  // If all questions are done, return "over"
} else {
    // Fetch the question based on the current question number and exam category
    $res = mysqli_query($link, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]' AND question_no='$questionno'");
    while ($row = mysqli_fetch_array($res)) {
        $question = $row["question"];
        $opt1 = $row["opt1"];
        $opt2 = $row["opt2"];
        $opt3 = $row["opt3"];
        $opt4 = $row["opt4"];
        
        // Display the question and options
        echo "<h4>" . $question . "</h4>";
        echo "<input type='radio' name='radiobtn' value='" . $opt1 . "' onclick='radioclick(this.value, " . $questionno . ")'";
        
        // Check if the option was already selected
        if (isset($_SESSION['answer'][$questionno]) && $_SESSION['answer'][$questionno] == $opt1) {
            echo " checked";  // Mark this radio button as checked
        }
        echo "> " . $opt1 . "<br>";

        echo "<input type='radio' name='radiobtn' value='" . $opt2 . "' onclick='radioclick(this.value, " . $questionno . ")'";
        if (isset($_SESSION['answer'][$questionno]) && $_SESSION['answer'][$questionno] == $opt2) {
            echo " checked";
        }
        echo "> " . $opt2 . "<br>";

        echo "<input type='radio' name='radiobtn' value='" . $opt3 . "' onclick='radioclick(this.value, " . $questionno . ")'";
        if (isset($_SESSION['answer'][$questionno]) && $_SESSION['answer'][$questionno] == $opt3) {
            echo " checked";
        }
        echo "> " . $opt3 . "<br>";

        echo "<input type='radio' name='radiobtn' value='" . $opt4 . "' onclick='radioclick(this.value, " . $questionno . ")'";
        if (isset($_SESSION['answer'][$questionno]) && $_SESSION['answer'][$questionno] == $opt4) {
            echo " checked";
        }
        echo "> " . $opt4 . "<br>";
    }
}
?>
