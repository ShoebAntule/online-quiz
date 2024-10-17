<?php
session_start();
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

mysqli_query($link, "delete from questions where id=$id");
?>
<script type="text/javascript">
    window.location = "add_edit_questions.php?id=<?php echo $id1 ?>";
</script>