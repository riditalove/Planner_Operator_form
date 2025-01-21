<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

include "connection.php";

// Fetch data from the database
$q = "SELECT `Entry_Date_of_Planning`, SUM(`Quantity_Produced`) AS `Total_Produced` 
      FROM `ope_plan` 
      GROUP BY `Entry_Date_of_Planning`";
$res = mysqli_query($con, $q);

// Prepare data for Highcharts
$data = [];
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = [
        'entry_date' => $row['Entry_Date_of_Planning'],
        'quantity_produced' => (int)$row['Total_Produced'], // Use alias for the SUM value
    ];
}

// Encode data to JSON for JavaScript
$jsonData = json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
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

    <script id="chart-data" type="application/json">
        <?php echo $jsonData; ?>
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Parse the JSON data from the embedded script
            const chartData = JSON.parse(document.getElementById('chart-data').textContent);
            console.log(chartData);

            // Prepare categories and series data
            const categories = chartData.map(item => item.entry_date);
            const seriesData = chartData.map(item => item.quantity_produced);

            // Render Highcharts
            Highcharts.chart('container', {
                chart: {
                    type: 'column',
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
