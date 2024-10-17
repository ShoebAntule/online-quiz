
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
$res = mysqli_query($link, "select * from exam_category where id=$id");
while ($row = mysqli_fetch_array($res)) {
    $exam_category = $row["category"];
    $exam_time = $row["exam_time_in_minutes"];
}

   ?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Exam</h1>
                    </div>
                </div>
            </div>
           
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            
                        <form action="" name="form1" method="post" >

                            <div class="card-body">
                                <!-- Credit Card -->
                               
                                <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Edit Exam</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label for="company" class=" form-control-label">New Exam Category</label><input type="text" name="examname" placeholder="Add Exam Category" class="form-control" value="<?php echo $exam_category; ?>" ></div>
                                    <div class="form-group"><label for="vat" class=" form-control-label">Exam Time In Minutes</label><input type="text" placeholder="Exam Time In Minutes" class="form-control" value="<?php echo $exam_time; ?>" name="examtime" ></div>
                                    <div class="form-group">
                                        <input type="submit" name="submit1" value="Update Exam" class="btn btn-success" >
                                    </div>
                                        
                                                </div>
                                            </div>
                            </div>

                        </div> <!-- .card -->
                        </form>

                    </div>
                    <!--/.col-->

                    
                                            </div>
                                        </div><!-- .animated -->
                                    </div><!-- .content -->
                                

    <?php
    if(isset($_POST["submit1"]))
    {
        mysqli_query($link, "update exam_category set category='$_POST[examname]', exam_time_in_minutes='$_POST[examtime]' where id = $id");
        
        ?>
    <script type="text/javascript">
   window.location = "exam_category.php";
</script>

<?php
                                }
                                    include "footer.php";
                                    ?>