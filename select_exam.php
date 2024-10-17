<?php
session_start();
include "connection.php";
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
    <div class="row" style="margin: 0; padding: 0;">
        <div class="col-lg-6 col-lg-push-3 select-exam-section" style="min-height: 600px;">
            <div class="exam-container text-center">
                <h2>Select Your Exam</h2>
                <div class="exam-buttons">
                    <?php
                    $res = mysqli_query($link, "SELECT * FROM exam_category");
                    while ($row = mysqli_fetch_array($res)) {
                        ?>
                        <button class="btn btn-exam" onclick="set_exam_type_session('<?php echo $row['category']; ?>')">
                            <?php echo $row["category"]; ?>
                        </button>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>

<script type="text/javascript">
    function set_exam_type_session(exam_category) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                window.location = "dashboard.php";
            }
        };
        xmlhttp.open("GET", "forajax/set_exam_type_session.php?exam_category=" + exam_category, true);
        xmlhttp.send(null);
    }
</script>

<style>
    body {
        background: linear-gradient(to right, #4e54c8, #8f94fb);
        color: #fff;
        font-family: 'Roboto', sans-serif;
    }

    .select-exam-section {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin-top: 50px;
    }

    .exam-container h2 {
        font-size: 2.5rem;
        margin-bottom: 40px;
        color: #333;
    }

    .exam-buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .btn-exam {
        padding: 15px 30px;
        font-size: 18px;
        color: #fff;
        background-color: #4e54c8;
        border: none;
        border-radius: 50px;
        margin: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-exam:hover {
        background-color: #8f94fb;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    .btn-exam:focus {
        outline: none;
    }

    @media (max-width: 768px) {
        .select-exam-section {
            padding: 20px;
        }

        .exam-container h2 {
            font-size: 2rem;
        }

        .btn-exam {
            padding: 10px 20px;
            font-size: 16px;
        }
    }
</style>
