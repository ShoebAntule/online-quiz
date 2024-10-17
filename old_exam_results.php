<?php
session_start();
include "header.php";
include "connection.php";

if (!isset($_SESSION["username"])) {
    echo "<script type='text/javascript'>window.location = 'login.php';</script>";
}
?>

<div class="result-container">
    <div class="result-section">
        <center>
            <h1 class="result-title">Old Exam Results</h1>
        </center>

        <?php
        $query = "SELECT * FROM exam_results WHERE username='{$_SESSION['username']}' ORDER BY id DESC";
        $res = mysqli_query($link, $query);

        if (!$res) {
            echo "Error in query execution: " . mysqli_error($link);
            exit();
        }

        $count = mysqli_num_rows($res);
        if ($count == 0) {
            echo "<center><h1>No result Found</h1></center>";
        } else {
            echo "<table class='table table-bordered'>";
            echo "<tr class='table-header'>";
            echo "<th>Username</th>";
            echo "<th>Exam Type</th>";
            echo "<th>Total Questions</th>";
            echo "<th>Correct Answers</th>";
            echo "<th>Wrong Answers</th>";
            echo "<th>Exam Time</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["exam_type"] . "</td>";
                echo "<td>" . $row["total_question"] . "</td>";
                echo "<td>" . $row["correct_answer"] . "</td>";
                echo "<td>" . $row["wrong_answer"] . "</td>";
                echo "<td>" . $row["exam_time"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </div>
</div>

<?php include "footer.php"; ?>

<style>
    body {
        background: #5b2c6f;
        color: #fff;
        font-family: 'Roboto', sans-serif;
        margin: 0;
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    .result-container {
        flex: 1;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 20px;
    }

    .result-section {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 80%;
        max-height: 500px;
        overflow-y: auto;
    }

    .result-title {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #333;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-header {
        background-color: #006df0;
        color: white;
    }

    .table th, .table td {
        padding: 10px;
        text-align: center;
        border: 1px solid #dee2e6;
        color: #333;
    }

    footer {
        background-color: #007bff;
        padding: 10px 0;
        text-align: center;
        color: white;
        width: 100%;
        position: relative; /* Changed to relative */
    }

    @media (max-width: 768px) {
        .result-section {
            width: 100%;
        }

        .result-title {
            font-size: 2rem;
        }
    }
</style>
