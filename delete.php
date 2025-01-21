<?php
session_start();
if (!isset(($_SESSION['username']))) {
    header('location:login.php');
}
?>
<?php
include "connection.php";
if(isset(($_GET['deleteid'])))
{
    $id = $_GET['deleteid'];

    $del = "DELETE FROM `ope_plan` WHERE record_id = $id";
    $res = mysqli_query($con,$del);
    if($res)
    {
        echo "deletd successfully";
        header("location:display_Planner.php");
    }
    else
    {
        die(mysqli_error($con));
    }
}
?>