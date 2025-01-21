<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

include "connection.php";

// Fetch data from the database
$q = "SELECT `Entry_Date_of_Planning`, `Operator_Name`, `Quantity_Produced` FROM `ope_plan`";
$res = mysqli_query($con, $q);

// Prepare data for Highcharts
$data = [];
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = [
        'entry_date' => $row['Entry_Date_of_Planning'],
        'operator_name' => $row['Operator_Name'],
        'quantity_produced' => (int)$row['Quantity_Produced'], // Ensure numeric values are cast to integers
    ];
}

// Encode data to JSON for JavaScript
$jsonData = json_encode($data);
echo $jsonData;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <title>Highcharts with PHP</title>
</head>

<body>
    <div id="container" style="width: 100%; height: 400px;"></div>
     
    <script>
        // Pass PHP data to JavaScript
        
        let chartData = <?php echo $jsonData ; ?> ;
        console.log(chartData);

        // Process data for Highcharts
        const categories = chartData.map(item => item.entry_date); // X-axis: Dates
        const seriesData = chartData.map(item => item.quantity_produced); // Y-axis: Quantities

        // Render Highcharts
        document.addEventListener('DOMContentLoaded', () => {
            Highcharts.chart('container', {
                chart: {
                    type: 'column', // Choose a column chart
                },
                title: {
                    text: 'Production Data',
                },
                xAxis: {
                    categories: categories,
                    title: {
                        text: 'Entry Date of Planning',
                    },
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Quantity Produced',
                    },
                },
                series: [
                    {
                        name: 'Quantity Produced',
                        data: seriesData,
                    },
                ],
            });
        });
    </script>
</body>

</html>

