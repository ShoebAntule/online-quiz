<?php
session_start();
include "header.php";
include "../connection.php";
if(!isset($_SESSION["admin"])){
    ?>
    <script type="text/javascript" >
        window.location = "index.php";
    </script>
    <?php
}
?>


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>All Exam Results</h1>
            </div>

        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        
                    <center>
            <h1>Old Exam Results</h1>
        </center>

        <?php
        $query = "SELECT * FROM exam_results  ORDER BY id DESC";
        $res = mysqli_query($link, $query);

        if (!$res) {
            echo "Error in query execution: " . mysqli_error($link);
            exit();
        }

        $count = mysqli_num_rows($res);
        if ($count == 0) {
            ?>
            <center>
                <h1>No result Found</h1>
            </center>
            <?php
        } else {
            echo "<table class='table table-bordered'>";
            echo "<tr style='background-color: #006df0; color: white'>";
            echo "<th>Username</th>";
            echo "<th>Exam Type</th>";
            echo "<th>Total Question</th>";
            echo "<th>Correct Answer</th>";
            echo "<th>Wrong Answer</th>";
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
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
