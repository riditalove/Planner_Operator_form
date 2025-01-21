<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

include "connection.php";

// Fetch existing data from the database
$id = $_GET['updateid'];
$q = "SELECT `Quantity_Produced`, `PO_Quantity` FROM `ope_plan` WHERE `record_id`='$id'";
$r = mysqli_query($con, $q);
if (!$r) {
    die(mysqli_error($con));
}
$row = mysqli_fetch_assoc($r);

$quan_prod = $row['Quantity_Produced'];
$po_quantity = $row['PO_Quantity'];
$remaining_balance = $po_quantity - $quan_prod;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_quantity = (int)$_POST['Quantity_Produced'];

    // Update the total Quantity Produced and calculate the Remaining Balance
    $total_quantity = $quan_prod + $new_quantity;
    $remaining_balance = $po_quantity - $total_quantity;

    // Update the database
    $sql = "UPDATE `ope_plan` SET `Quantity_Produced`='$total_quantity', `Remaining_Balance`='$remaining_balance' WHERE `record_id`='$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:display_Operator.php');
        exit;
    } else {
        die(mysqli_error($con));
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Update</title>
    <script>
        function calculateRemainingBalance() {
            const poQuantity = parseInt(document.getElementById("PO_Quantity").value) || 0;
            const prevQuantity = parseInt(document.getElementById("Prev_Quantity").value) || 0;
            const newQuantity = parseInt(document.getElementById("Quantity_Produced").value) || 0;

            const totalProduced = prevQuantity + newQuantity;
            const remainingBalance = poQuantity - totalProduced;

            document.getElementById("Remaining_Balance").value = remainingBalance;
        }
    </script>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-5">Welcome,<?php echo htmlspecialchars($_SESSION['role'])?>&nbsp;<?php echo htmlspecialchars($_SESSION['username']) ?></h2>

        <form method="POST">
            <input type="hidden" id="Prev_Quantity" value="<?php echo htmlspecialchars($quan_prod); ?>">

            <div class="form-group mt-5">
                <label for="Quantity_Produced">New Quantity Produced</label>
                <input type="number" class="form-control" id="Quantity_Produced" name="Quantity_Produced"
                    oninput="calculateRemainingBalance()" required>
            </div>

            <div class="form-group">
                <label for="PO_Quantity">PO Quantity</label>
                <input type="number" id="PO_Quantity" name="PO_Quantity"
                    value="<?php echo htmlspecialchars($po_quantity); ?>" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="Remaining_Balance">Remaining Balance</label>
                <input type="number" id="Remaining_Balance" name="Remaining_Balance"
                    value="<?php echo htmlspecialchars($remaining_balance); ?>" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>
