<?php
session_start();
include "header.php";
if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
    <?php
}
?>

<div class="container-fluid" style="padding: 0; margin: 0;">
    <div class="row" style="margin: 0; padding: 0; height: 100vh;">
        <div class="col-lg-6 col-lg-push-3" style="min-height: 100%; padding-top: 30px;">
            <!-- Start -->
            <div class="dashboard-container" style="background-color: #fff; border-radius: 10px; box-shadow: 0px 10px 30px rgba(0,0,0,0.1); padding: 30px;">
                <div class="dashboard-header text-center">
                    <h2 class="title">Quiz Dashboard</h2>
                    <p class="description">Answer the questions and navigate between them easily.</p>
                </div>

                <div class="question-status row text-center">
                    <div class="col-lg-4 col-lg-offset-4">
                        <div id="current_que" style="font-size: 24px; color: #333; display: inline-block;">0</div>
                        <div style="display: inline-block;">/</div>
                        <div id="total_que" style="font-size: 24px; color: #333; display: inline-block;">0</div>
                    </div>
                </div>

                <div class="question-container row text-center" style="margin-top: 40px;">
                    <div class="col-lg-10 col-lg-push-1 question-box" id="load_questions" style="padding: 20px; min-height: 200px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0,0,0,0.05);">
                        <!-- Questions will load here dynamically -->
                    </div>
                </div>

                <div class="navigation-buttons row" style="margin-top: 30px;">
                    <div class="col-lg-6 col-lg-push-3 text-center">
                        <button class="btn btn-primary nav-btn" onclick="load_previous();" style="width: 120px;">Previous</button>
                        &nbsp;
                        <button class="btn btn-success nav-btn" onclick="load_next();" style="width: 120px;">Next</button>
                    </div>
                </div>
            </div>
            <!-- End -->
        </div>
    </div>
</div>

<script type="text/javascript">
    var questionno = 1;
    load_questions(questionno);

    function load_questions(questionno) {
        document.getElementById("current_que").innerHTML = questionno;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText.trim() == "over") {
                    window.location.href = "result.php";
                } else {
                    document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
                    load_total_que();
                }
            }
        };
        xmlhttp.open("GET", "forajax/load_questions.php?questionno=" + questionno, true);
        xmlhttp.send(null);
    }

    function radioclick(selectedAnswer, questionno) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                console.log("Answer saved: " + selectedAnswer);
            }
        };
        xmlhttp.open("GET", "forajax/save_answer_in_session.php?questionno=" + questionno + "&answer=" + encodeURIComponent(selectedAnswer), true);
        xmlhttp.send(null);
    }

    function load_previous() {
        if (questionno > 1) {
            questionno = parseInt(questionno) - 1;
            load_questions(questionno);
        }
    }

    function load_next() {
        questionno = parseInt(questionno) + 1;
        load_questions(questionno);
    }
</script>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(to right, #6a11cb, #2575fc);
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container-fluid {
        height: 100%;
    }

    .dashboard-container {
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        background-color: white;
        padding: 30px;
    }

    .title {
        font-size: 32px;
        color: #4e54c8;
        font-weight: 700;
    }

    .description {
        font-size: 18px;
        color: #666;
    }

    .question-box {
        font-size: 20px;
        color: #333;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        background-color: #f9f9f9;
    }

    .nav-btn {
        font-size: 18px;
        padding: 10px 20px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .nav-btn:hover {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 20px;
        }

        .title {
            font-size: 24px;
        }

        .question-box {
            font-size: 16px;
        }

        .nav-btn {
            width: 100px;
        }
    }
</style>

<?php
include "footer.php";
?>
