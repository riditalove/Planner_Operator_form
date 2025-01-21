<?php
session_start();
if (!isset(($_SESSION['username']))) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>crud operation</title>
</head>

<body>
    <h2 class="text-center mt-5">Welcome , <?php echo $_SESSION['role'] ?></h2>
    <div class="container mt-5">
        <button class="btn btn-primary my-5"><a href="planner.php" class="text-light">Add Record</a></button>
        <button class="btn btn-primary my-5"><a href="another_one.php" class="text-light">Production Summary</a></button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SI No</th>
                    <th scope="col">Entry Date of Planning</th>
                    <th scope="col">Operator Name</th>
                    <th scope="col">Machine ID</th>
                    <th scope="col">Machine</th>

                    <th scope="col">GG</th>
                    <th scope="col">Fabric Composition</th>
                    <th scope="col">Select PO</th>
                    <th scope="col">Style</th>
                    <th scope="col">Article</th>

                    <th scope="col">Buyer</th>
                    <th scope="col">PO Quantity</th>
                    <th scope="col">SMV (Standard Minute Value)</th>
                    <th scope="col">Quantity Produced</th>
                    <th scope="col">Quantity Target</th>

                    <th scope="col">Capacity</th>
                    <th scope="col">Target in Minutes</th>
                    <th scope="col">Capacity in Minutes</th>
                    <th scope="col">Remaining Balance</th>
                    <th scope="col">Remaining Days to Ship</th>
                    <th scope="col">Shipment Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "connection.php";
                $q = "select *from `ope_plan`";
                $r = mysqli_query($con, $q);
                if ($r) {
                    while ($row = mysqli_fetch_assoc(($r))) {
                        
                        $id = $row['record_id'];
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
                        $rem_ship = $row['Remaining_Days_To_Ship'];
                        $ship_date = $row['Shipment_Date'];
                        $target_min = $row['Target_In_Minutes'];
                        $cap_min = $row['Capacity_In_Minutes'];
                        $quantity_produced = $row['Quantity_Produced']; 
                        $remaining_balance = ($po_quantity - $quantity_produced);


                        echo '<tr>
                    <th scope="row">' . $id . '</th>
                    <td>' . $edp . '</td>
                    <td>' . $opname . '</td>
                    <td>' . $m_id . '</td>
                    <td>' .  $machine . '</td>
                    <td>' . $gg . '</td>
                    <td>' . $fb_comp . '</td>
                    <td>' . $spo . '</td>
                    <td>' . $style . '</td>
                    <td>' . $article . '</td>
                    <td>' . $buyer . '</td>
                     <td>' . $po_quantity . '</td>
                    <td>' . $smv. '</td>
                    <td>' . $quantity_produced . '</td>
                    <td>' . $quantity_target . '</td>
                    <td>' . $capacity . '</td>
                    <td>' . $target_min. '</td>
                    <td>' .  $cap_min  . '</td>
                    <td>' . $remaining_balance . '</td>
                    <td>' .$rem_ship .'</td>
                    <td>' . $ship_date . '</td>
                                     
                     <td>
                    <button class= "btn btn-primary"><a href="update.php?updateid=' . $id . '" class="text-light">Update</a></button>
                    <button class= "btn btn-danger"><a href="delete.php? deleteid=' . $id . '" class="text-light">Delete</a></button>
                </td>
                </tr>';
                    }
                }
                ?>

            </tbody>
        </table>

        


    </div>
    <div class="container">
        <a href="logout.php"class="btn btn-primary mt-5">Logout</a>
    </div>
</body>

</html>