<?php
session_start();
if (!isset(($_SESSION['username']))) {
    header('location:login.php');
}
?>

<?php
require 'connection.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
    $edp = $_POST['Entry_Date_of_Planning'];
    $opname = $_POST['Operator_Name'];
    $m_id = $_POST['Machine_ID'];
    $machine = $_POST['Machine'];
    $gg = $_POST['GG'];
    $fb_comp = $_POST['Fabric_Composition'];
    $spo= $_POST['Select_PO'];
    $style = $_POST['Style'];
    $article = $_POST['Article'];
    $po_quantity = $_POST['PO_Quantity'];
    $buyer = $_POST['Buyer'];
    $smv = $_POST['SMV'];
    $quantity_target = $_POST['Quantity_Target'];
    $capacity = $_POST['Capacity'];
    $remaining_balance = $_POST['Remaining_Balance'];
    $rem_ship = $_POST['Remaining_Days_To_Ship'];
    $ship_date = $_POST['Shipment_Date'];
    $target_min = $_POST['Target_In_Minutes'];
    $cap_min = $_POST['Capacity_In_Minutes'];
   
 
    

   $q = "INSERT INTO ope_plan(Entry_Date_of_Planning, Operator_Name, Machine_ID, Machine, GG, Fabric_Composition, Select_PO, Style, Article, Buyer, PO_Quantity, SMV, Quantity_Target, Capacity, Target_In_Minutes, Capacity_In_Minutes, Remaining_Balance, Remaining_Days_To_Ship, Shipment_Date) VALUES ('$edp','$opname','$m_id','$machine','$gg','$fb_comp','$spo','$style','$article','$buyer','$po_quantity','$smv','$quantity_target','$capacity','$target_min','$cap_min','$remaining_balance','$rem_ship','$ship_date')";

   if(mysqli_query($con,$q))
   {
    echo "Data inserted!"; 
    header("location:display_Planner.php");
   }
   else{
    echo "Error: " . mysqli_error($con);
   }
  }
?>

