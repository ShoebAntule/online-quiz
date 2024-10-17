<?php
session_start();
include "connection.php";

$date = date("Y-m-d H:i:s");
$_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date . "+ $_SESSION[exam_time] minutes"));

include "header.php";
?>

<div class="row" style="margin: 0px; padding: 0px; margin-bottom: 50px;">
    <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background: linear-gradient(145deg, #e6e6e6, #ffffff); border-radius: 20px; box-shadow: 5px 5px 15px #a1a1a1; position: relative; overflow: hidden;">
        <div class="celebration" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;">
            <div class="confetti"></div>
        </div>
        <div style="padding: 30px;">
            <h2 style="text-align: center; color: #4A90E2; font-size: 36px;">Quiz Result</h2>
            <?php
            $correct = 0;
            $wrong = 0;

            if (isset($_SESSION["answer"])) {
                for ($i = 1; $i <= sizeof($_SESSION["answer"]); $i++) {
                    $answer = "";
                    $res = mysqli_query($link, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]' AND question_no=$i");
                    while ($row = mysqli_fetch_array($res)) {
                        $answer = $row["answer"];
                    }

                    if (isset($_SESSION["answer"][$i])) {
                        if ($answer == $_SESSION["answer"][$i]) {
                            $correct++;
                        } else {
                            $wrong++;
                        }
                    } else {
                        $wrong++;
                    }
                }
            }

            $res = mysqli_query($link, "SELECT * FROM questions WHERE category='$_SESSION[exam_category]'");
            $count = mysqli_num_rows($res);
            $wrong = $count - $correct;

            echo "<div style='text-align: center; margin-top: 20px;'>";
            echo "<div style='font-size: 24px; margin: 10px 0; color: #333;'>Total Questions: <span style='font-weight: bold;'>$count</span></div>";
            echo "<div style='font-size: 24px; margin: 10px 0; color: #4CAF50;'>Correct Answers: <span style='font-weight: bold;'>$correct</span></div>";
            echo "<div style='font-size: 24px; margin: 10px 0; color: #F44336;'>Wrong Answers: <span style='font-weight: bold;'>$wrong</span></div>";
            echo "</div>";
            ?>
        </div>
    </div>
</div>

<?php
if (isset($_SESSION["exam_start"])) {
    $date = date("Y-m-d");
    $query = "INSERT INTO exam_results (id, username, exam_type, total_question, correct_answer, wrong_answer, exam_time) 
              VALUES (NULL, '$_SESSION[username]', '$_SESSION[exam_category]', '$count', '$correct', '$wrong', '$date')";

    if (mysqli_query($link, $query)) {
        echo "Result successfully saved.";
    } else {
        echo "Error: " . mysqli_error($link);
    }
}

if (isset($_SESSION["exam_start"])) {
    unset($_SESSION["exam_start"]);
    ?>
    <script type="text/javascript">
        window.location.href = "result.php";  
    </script>
    <?php
}
?>

<style>
    .confetti {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }

    .confetti div {
        position: absolute;
        width: 10px;
        height: 10px;
        background: red;
        animation: fall linear forwards;
        opacity: 0;
    }

    @keyframes fall {
        0% {
            transform: translateY(-100%);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh);
            opacity: 0;
        }
    }

    .confetti div:nth-child(2n) {
        background: blue;
    }

    .confetti div:nth-child(3n) {
        background: green;
    }

    .confetti div:nth-child(4n) {
        background: yellow;
    }

    .confetti div:nth-child(5n) {
        background: orange;
    }

    .confetti div:nth-child(6n) {
        background: pink;
    }
</style>

<script>
    const confettiCount = 100;
    const confettiContainer = document.querySelector('.confetti');

    for (let i = 0; i < confettiCount; i++) {
        const confetti = document.createElement('div');
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
        confetti.style.opacity = Math.random();
        confettiContainer.appendChild(confetti);
    }
</script>

<?php
include "footer.php";
?>
