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
$id=$_GET["id"];
$id1=$_GET["id1"];

$res = mysqli_query($link, "select * from questions where id=$id");
$question="";
$opt1="";
$opt2="";
$opt3="";
$opt4="";
$answer="";

while ($row = mysqli_fetch_array($res)) {
    $question=$row["question"];
    $opt1=$row["opt1"];
    $opt2=$row["opt2"];
    $opt3=$row["opt3"];
    $opt4=$row["opt4"];
    $answer=$row["answer"];
}

?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Update Question</h1>
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

     <div class="col-lg-12">
                <form action="" name="form1" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header"><strong>Update Questions</strong></div>
                        <div class="card-body card-block">
                            <div class="form-group"><label for="company" class=" form-control-label">Add
                                    Question</label><input type="text" name="question"
                                    placeholder="Add Question" class="form-control" value="<?php echo $question; ?>" ></div>
                            <div class="form-group"><label for="company" class=" form-control-label">Add
                                    opt1</label><input type="text" name="opt1" placeholder="Add opt1"
                                    class="form-control"value="<?php echo $opt1; ?>"></div>
                            <div class="form-group"><label for="company" class=" form-control-label">Add
                                    opt2</label><input type="text" name="opt2" placeholder="Add opt2"
                                    class="form-control"value="<?php echo $opt2; ?>"></div>
                            <div class="form-group"><label for="company" class=" form-control-label">Add
                                    opt3</label><input type="text" name="opt3" placeholder="Add opt3"
                                    class="form-control"value="<?php echo $opt4; ?>"></div>
                            <div class="form-group"><label for="company" class=" form-control-label">Add
                                    opt4</label><input type="text" name="opt4" placeholder="Add opt4"
                                    class="form-control"value="<?php echo $opt4; ?>"></div>
                            <div class="form-group"><label for="company" class=" form-control-label">Add
                                    Answer</label><input type="text" name="answer" placeholder="Add answer"
                                    class="form-control"value="<?php echo $answer; ?>"></div>
                            <div class="form-group">
                                <input type="submit" name="submit1" value="Update Question"
                                    class="btn btn-success">
                            </div>
                        </div>
                    </div>
                    </form>
            </div>

                    </div>
                </div>
            </div>
        </div> <!-- /.col -->

    </div><!-- .animated -->
</div><!-- .content -->



<?php
    if(isset($_POST["submit1"]))
    {
mysqli_query($link, "update questions set question='$_POST[question]',opt1='$_POST[opt1]',opt2='$_POST[opt2]',opt3='$_POST[opt3]',opt4='$_POST[opt4]',answer='$_POST[answer]' where id=$id ");

?>
<script type="text/javascript">
    window.location = "add_edit_questions.php?id=<?php echo $id1 ?>";
</script>

<?php

    }

?>


<?php
include "footer.php";   
?>
