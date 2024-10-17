<?php
session_start();
include "../connection.php";
$exam_category=$_GET["exam_category"];
$_SESSION["exam_category"]=$exam_category;

$res=mysqli_query($link,"select * from exam_category where category='$exam_category'");
while($row=mysqli_fetch_array($res))
{
    $_SESSION["exam_time"]=$row["exam_time_in_minutes"];
}
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s");
$_SESSION["end_time"]=date("Y-m-d H:i:s", strtotime($date . "+$_SESSION[exam_time] minutes"));
$_SESSION["exam_start"]="yes";
?>