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

$id = $_GET["id"];
$id1 = $_GET["id1"];

// Fetch existing question data
$res = mysqli_query($link, "SELECT * FROM questions WHERE id=$id");
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer = "";

while ($row = mysqli_fetch_array($res)) {
    $question = $row["question"];
    $opt1 = $row["opt1"];
    $opt2 = $row["opt2"];
    $opt3 = $row["opt3"];
    $opt4 = $row["opt4"];
    $answer = $row["answer"];
}
?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Update Images Question</h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="" name="form1" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><strong>Add New Questions with Images</strong></div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="company" class="form-control-label">Add Question</label>
                                            <input type="text" name="fquestion" placeholder="Add Question" class="form-control" value="<?php echo $question; ?>">
                                        </div>
                                        <div class="form-group">
                                            <?php if ($opt1 != "") { ?>
                                                <img src="<?php echo $opt1; ?>" height="50" width="50" alt="img"> <br>
                                            <?php } ?>
                                            <label for="company" class="form-control-label">Add opt1</label>
                                            <input type="file" name="fopt1" class="form-control" style="padding-bottom: 45px">
                                        </div>
                                        <div class="form-group">
                                            <?php if ($opt2 != "") { ?>
                                                <img src="<?php echo $opt2; ?>" height="50" width="50" alt="img"> <br>
                                            <?php } ?>
                                            <label for="company" class="form-control-label">Add opt2</label>
                                            <input type="file" name="fopt2" class="form-control" style="padding-bottom: 45px">
                                        </div>
                                        <div class="form-group">
                                            <?php if ($opt3 != "") { ?>
                                                <img src="<?php echo $opt3; ?>" height="50" width="50" alt="img"> <br>
                                            <?php } ?>
                                            <label for="company" class="form-control-label">Add opt3</label>
                                            <input type="file" name="fopt3" class="form-control" style="padding-bottom: 45px">
                                        </div>
                                        <div class="form-group">
                                            <?php if ($opt4 != "") { ?>
                                                <img src="<?php echo $opt4; ?>" height="50" width="50" alt="img"> <br>
                                            <?php } ?>
                                            <label for="company" class="form-control-label">Add opt4</label>
                                            <input type="file" name="fopt4" class="form-control" style="padding-bottom: 45px">
                                        </div>
                                        <div class="form-group">
                                            <?php if ($answer != "") { ?>
                                                <img src="<?php echo $answer; ?>" height="50" width="50" alt="img"> <br>
                                            <?php } ?>
                                            <label for="company" class="form-control-label">Add Answer</label>
                                            <input type="file" name="fanswer" class="form-control" style="padding-bottom: 45px">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit2" value="Update Question" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> <!-- Close form here -->
                </div>
            </div>
        </div> <!-- /.col -->
    </div><!-- .animated -->
</div><!-- .content -->

<?php
if (isset($_POST['submit2'])) {
    $questionText = $_POST['fquestion']; // Store the new question text
    $tm = md5(time()); // Generate unique filename prefix

    // Initialize variables for database paths
    $dst_db1 = $opt1;
    $dst_db2 = $opt2;
    $dst_db3 = $opt3;
    $dst_db4 = $opt4;
    $dst_db_answer = $answer;

    // Handle opt1 file upload
    if ($_FILES["fopt1"]["error"] == UPLOAD_ERR_OK) {
        $opt1 = $_FILES["fopt1"]["name"];
        $dst1 = "./opt_images/" . $tm . $opt1;
        move_uploaded_file($_FILES["fopt1"]["tmp_name"], $dst1);
        $dst_db1 = "opt_images/" . $tm . $opt1; // Update path for DB
    }

    // Handle opt2 file upload
    if ($_FILES["fopt2"]["error"] == UPLOAD_ERR_OK) {
        $opt2 = $_FILES["fopt2"]["name"];
        $dst2 = "./opt_images/" . $tm . $opt2;
        move_uploaded_file($_FILES["fopt2"]["tmp_name"], $dst2);
        $dst_db2 = "opt_images/" . $tm . $opt2; // Update path for DB
    }

    // Handle opt3 file upload
    if ($_FILES["fopt3"]["error"] == UPLOAD_ERR_OK) {
        $opt3 = $_FILES["fopt3"]["name"];
        $dst3 = "./opt_images/" . $tm . $opt3;
        move_uploaded_file($_FILES["fopt3"]["tmp_name"], $dst3);
        $dst_db3 = "opt_images/" . $tm . $opt3; // Update path for DB
    }

    // Handle opt4 file upload
    if ($_FILES["fopt4"]["error"] == UPLOAD_ERR_OK) {
        $opt4 = $_FILES["fopt4"]["name"];
        $dst4 = "./opt_images/" . $tm . $opt4;
        move_uploaded_file($_FILES["fopt4"]["tmp_name"], $dst4);
        $dst_db4 = "opt_images/" . $tm . $opt4; // Update path for DB
    }

    // Handle answer file upload
    if ($_FILES["fanswer"]["error"] == UPLOAD_ERR_OK) {
        $answer = $_FILES["fanswer"]["name"];
        $dst_answer = "./opt_images/" . $tm . $answer;
        move_uploaded_file($_FILES["fanswer"]["tmp_name"], $dst_answer);
        $dst_db_answer = "opt_images/" . $tm . $answer; // Update path for DB
    }

    // Update the question in the database
    mysqli_query($link, "UPDATE questions SET question='$questionText', opt1='$dst_db1', opt2='$dst_db2', opt3='$dst_db3', opt4='$dst_db4', answer='$dst_db_answer' WHERE id=$id");
?>
<script type="text/javascript">
    window.location = "add_edit_questions.php?id=<?php echo $id1 ?>";
</script>

<?php
}


include "footer.php";
?>
