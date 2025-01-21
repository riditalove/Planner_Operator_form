<?php
session_start();
if (!isset(($_SESSION['username']))) {
    header('location:login.php');
}
?>

<?php
include "connection.php";
$id = $_GET['updateid'];
echo $id;
$q = "SELECT * FROM `ope_plan` WHERE `record_id`='$id'";
$res = mysqli_query($con,$q);
$row = mysqli_fetch_assoc($res);

if($row)
{
$edp = $row['Entry_Date_of_Planning'];
$opname = $row['Operator_Name'];
$m_id = $row['Machine_ID'];
$machine = $row['Machine'];
$gg = $row['GG'];
$fb_comp = $row['Fabric_Composition'];
$spo = $row['Select_PO'];
$style = $row['Style'];
$article = $row['Article'];
$po_quantity = $row['PO_Quantity'];
$buyer = $row['Buyer'];
$smv = $row['SMV'];
$quantity_target = $row['Quantity_Target'];
$capacity = $row['Capacity'];
$remaining_balance = $row['Remaining_Balance'];
$rem_ship = $row['Remaining_Days_To_Ship'];
$ship_date = $row['Shipment_Date'];
$target_min = $row['Target_In_Minutes'];
$cap_min = $row['Capacity_In_Minutes'];
$quantity_produced = $row['Quantity_Produced'];

if($_SERVER['REQUEST_METHOD']=="POST")
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

    $sql = " UPDATE `ope_plan` SET `Entry_Date_of_Planning`='$edp',`Operator_Name`='$opname',`Machine_ID`='$m_id',`Machine`='$machine',`GG`='$gg',`Fabric_Composition`='$fb_comp',`Select_PO`='$spo',`Style`='$style',`Article`='$article',`Buyer`='$buyer',`PO_Quantity`='$po_quantity',`SMV`='$smv',`Quantity_Target`='$quantity_target',`Capacity`='$capacity',`Target_In_Minutes`='$target_min',`Capacity_In_Minutes`='$cap_min',`Remaining_Balance`='$remaining_balance ',`Remaining_Days_To_Ship`='$rem_ship',`Shipment_Date`='$ship_date' WHERE `record_id`='$id' ";

    $result = mysqli_query($con,$sql);
    if($result)
    {
        echo "sending data successful";
        header('location:display_Planner.php');
    }
    else
    {  
        echo "not working";
        die(mysqli_error($con));
    }
}

}
else{
    die(mysqli_error($con));
}


?>

<!doctype html>
<html lang="en">

<head>
    <!--  meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Update</title>
    <script>
        function calculateDateDifference() {
            // Get the date values from the form
            const date1 = new Date(document.getElementById("Entry_Date_of_Planning").value);
            const date2 = new Date(document.getElementById("Shipment_Date").value);
            

            // Check if both dates are valid
            if (!isNaN(date1) && !isNaN(date2)) {
                // Calculate the difference in milliseconds
                const diffTime = Math.abs(date2 - date1);

                // Convert to days
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                console.log((diffDays));
                // Show the result in the form
                document.getElementById("Remaining_Days_To_Ship").value = parseInt(diffDays);
            } else {
                document.getElementById("Remaining_Days_To_Ship").value = "Invalid date(s)";
            }
        }
    </script>
</head>

<body>
<h2 class="text-center mt-5">Welcome , <?php echo $_SESSION['role'] ?></h2>
    <div class="container">
        <form method="POST" oninput="calculateDateDifference()">

        <div class="form-group mt-5">
                <label for="Entry_Date_of_Planning">Entry Date of Planning</label>
                <input type="date" id="Entry_Date_of_Planning" name="Entry_Date_of_Planning" 
                    class="form-control" value=<?php echo $edp; ?>>
            </div>


            <div class="form-group">
                <label for="Operator_Name">Operator Name</label>
                <input type="text" id="Operator_Name" name="Operator_Name" placeholder="Enter your name" 
                    class="form-control" value=<?php echo $opname; ?>>
            </div>

            <div class="form-group">
                <label for="Machine_ID">Machine ID</label>
                <input type="number" id="Machine_ID" name="Machine_ID" placeholder="Enter the machine id" 
                value=<?php echo $m_id; ?>  class="form-control">
            </div>

            <div class="form-group">
                <label for="Machine">Machine</label>
                <input type="text" id="Machine" name="Machine" placeholder="Enter the machine name"
                 value=<?php echo $machine; ?> class="form-control">
            </div>

            <div class="form-group">

                <label for="GG">GG</label>
                <input type="number" id="GG" name="GG"
                value=<?php echo $gg; ?> class="form-control">
            </div>

            <div class="form-group">

                <label for="Fabric_Composition">Fabric Composition</label>
                <input type="text" id="Fabric_Composition" name="Fabric_Composition"   
                class="form-control" value=<?php echo $fb_comp; ?>>
            </div>

            <div class="form-group">
                <label for="Select_PO">Select PO</label>
                <input type="text" id="Select_PO" name="Select_PO" placeholder=""  class="form-control" value=<?php echo $spo; ?>>
            </div>

            <div class="form-group">
                <label for="Style">Style</label>
                <input type="text" id="Style" name="Style" placeholder=""  
                value=<?php echo $style; ?> class="form-control">
            </div>

            <div class="form-group">
                <label for="Article">Article</label>
                <input type="text" id="Article" name="Article" 
                value=<?php echo $article; ?> class="form-control">
            </div>

            <div class="form-group">
                <label for="PO_Quantity">PO Quantity</label>
                <input type="number" id="PO_Quantity" name="PO_Quantity" 
                value=<?php echo $po_quantity; ?> placeholder="" class="form-control">
            </div>

            <div class="form-group">
                <label for="Buyer">Buyer</label>
                <select id="Buyer" name="Buyer" class="form-control" >
                    <option value="<?php echo $buyer; ?>">Select the Buyer</option>
                    <option value="zara">ZARA</option>
                    <option value="nasa">NASA</option>
                    <option value="mango">MANGO</option>
                    <option value="zara">PEPE JEANS</option>
                    <option value="scoot">SCOOT</option>
                    <option value="stier">STIER</option>
                </select>

            </div>

            <div class="form-group">
                <label for="SMV">SMV (Standard Minute Value)</label>
                <input type="number" id="SMV" name="SMV"  value=<?php echo $smv; ?> class="form-control">
            </div>

            <div class="form-group">
                <label for="Quantity_Target">Quantity Target</label>
                <input type="number" id="Quantity_Target" name="Quantity_Target" placeholder="" value=<?php echo $quantity_target; ?> class="form-control">
            </div>

            <div class="form-group">
                <label for="Capacity">Capacity</label>
                <input type="number" id="Capacity" name="Capacity" placeholder=""   value=<?php echo $capacity; ?> class="form-control">
            </div>

            <div class="form-group">
                <label for="Target_In_Minutes">Target in Minutes</label>
                <input type="number" id="Target_In_Minutes" name="Target_In_Minutes" placeholder=""  value=<?php echo $target_min; ?> 
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="Capacity_In_Minutes">Capacity in Minutes</label>
                <input type="number" id="Capacity_In_Minutes" name="Capacity_In_Minutes" placeholder=""
                value=<?php echo $cap_min; ?>    class="form-control">
            </div>

            <div class="form-group">
                <label for="Remaining_Balance">Remaining Balance</label>
                <input type="number" id="Remaining_Balance" name="Remaining_Balance" placeholder=""
                value=<?php echo $remaining_balance; ?>    class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="Remaining_Days_To_Ship">Remaining Days to Ship</label>
                <input type="number" id="Remaining_Days_To_Ship" name="Remaining_Days_To_Ship" placeholder=""
                value=<?php echo $rem_ship; ?>      class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="Shipment_Date">Shipment Date</label>
                <input type="date" id="Shipment_Date" name="Shipment_Date" placeholder="" value=<?php echo $ship_date; ?>  class="form-control">
            </div>
          
        

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</body>

</html>