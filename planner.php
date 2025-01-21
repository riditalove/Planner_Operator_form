<?php
session_start();
if (!isset(($_SESSION['username']))) {
    header('location:login.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Crud Operation</title>

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
        <form action="add_planner.php" method="POST" oninput="calculateDateDifference()">

            <div class="form-group mt-5">
                <label for="Entry_Date_of_Planning">Entry Date of Planning</label>
                <input type="date" id="Entry_Date_of_Planning" name="Entry_Date_of_Planning" required
                    class="form-control">
            </div>


            <div class="form-group">
                <label for="Operator_Name">Operator Name</label>
                <input type="text" id="Operator_Name" name="Operator_Name" placeholder="Enter your name"
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="Machine_ID">Machine ID</label>
                <input type="number" id="Machine_ID" name="Machine_ID" placeholder="Enter the machine id" required
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="Machine">Machine</label>
                <input type="text" id="Machine" name="Machine" placeholder="Enter the machine name" class="form-control">
            </div>

            <div class="form-group">

                <label for="GG">GG</label>
                <input type="number" id="GG" name="GG" class="form-control">
            </div>

            <div class="form-group">

                <label for="Fabric_Composition">Fabric Composition</label>
                <input type="text" id="Fabric_Composition" name="Fabric_Composition" class="form-control">
            </div>

            <div class="form-group">
                <label for="Select_PO">Select PO</label>
                <input type="text" id="Select_PO" name="Select_PO" placeholder="" class="form-control">
            </div>

            <div class="form-group">
                <label for="Style">Style</label>
                <input type="text" id="Style" name="Style" placeholder="" required class="form-control">
            </div>

            <div class="form-group">
                <label for="Article">Article</label>
                <input type="text" id="Article" name="Article" class="form-control">
            </div>

            <div class="form-group">
                <label for="PO_Quantity">PO Quantity</label>
                <input type="number" id="PO_Quantity" name="PO_Quantity" placeholder="" class="form-control">
            </div>

            <div class="form-group">
                <label for="Buyer">Buyer</label>
                <select id="Buyer" name="Buyer" class="form-control" >
                    <option value="">Select the Buyer</option>
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
                <input type="number" id="SMV" name="SMV" class="form-control">
            </div>

            <div class="form-group">
                <label for="Quantity_Target">Quantity Target</label>
                <input type="number" id="Quantity_Target" name="Quantity_Target" placeholder="" class="form-control">
            </div>

            <div class="form-group">
                <label for="Capacity">Capacity</label>
                <input type="number" id="Capacity" name="Capacity" placeholder="" class="form-control">
            </div>

            <div class="form-group">
                <label for="Target_In_Minutes">Target in Minutes</label>
                <input type="number" id="Target_In_Minutes" name="Target_In_Minutes" placeholder=""
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="Capacity_In_Minutes">Capacity in Minutes</label>
                <input type="number" id="Capacity_In_Minutes" name="Capacity_In_Minutes" placeholder=""
                    class="form-control">
            </div>

            <!-- <div class="form-group">

                <label for="Remaining_Balance">Remaining Balance</label>
                <input type="number" id="Remaining_Balance" name="Remaining_Balance" placeholder=""
                    class="form-control">
            </div> -->

            <div class="form-group">
                <label for="Remaining_Days_To_Ship">Remaining Days to Ship</label>
                <input type="number" id="Remaining_Days_To_Ship" name="Remaining_Days_To_Ship" placeholder=""
                    class="form-control">
            </div>

            <div class="form-group">
                <label for="Shipment_Date">Shipment Date</label>
                <input type="date" id="Shipment_Date" name="Shipment_Date" placeholder="" required class="form-control">
            </div>

            <button type="submit">Submit</button>

        </form>

    </div>
</body>


</html>