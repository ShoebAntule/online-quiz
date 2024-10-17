<!-- <?php
session_start();

// Check if questionno and answer are set
if (isset($_GET["questionno"]) && isset($_GET["answer"])) {
    $questionno = intval($_GET["questionno"]);
    $value1 = $_GET["answer"];  // Correctly retrieve the 'answer' parameter

    // Save the answer in the session
    $_SESSION["answer"][$questionno] = $value1;
} else {
    echo "Invalid request.";
}
?> -->
