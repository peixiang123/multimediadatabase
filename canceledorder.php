<!-- myorder.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>canceled order</title>
    <?php include('workerpage.php'); 
?>
</head>
<body>
    <form class="search" method="GET">
    <p style="display:inline-block; margin-left:200px; ">Start Date:<input class="text" type="date" name="startDate" placeholder=" Start Date"> TO
     End Date:<input class="text"  type="date" name="endDate" placeholder=" End Date"></p>
    <p><input style="margin-left: 200px; margin-top: 10px;" class="search-button" type="submit" name="search" value="Search"></p>
  </form>
    <h1 style="margin-left:200px; margin-top: 30px; background-color: white; margin-right:1100px;">Canceled Orders</h1>
    <table>
        <tr style="border: 2px solid black; padding:10px; background-color:#FFD700;">
            <th style="padding:10px;">Order ID</th>
            <th>Customer ID</th>
            <th>Order Date</th>
            <th>Order Time</th>
            <th style="padding:10px;">Order Type</th>
            <th style="padding:10px;">Total Amount</th>
        </tr>
        <?php

         if (isset($_GET['startDate']) && !empty($_GET['startDate']) && isset($_GET['endDate']) && !empty($_GET['endDate'])) {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
        $sql2 = "SELECT * FROM orders
                    WHERE orderStatus = 'canceled' 
                    AND DATE_FORMAT(orderDate, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'
                    GROUP BY order_id
                    ORDER BY orderDate asc";
                

        $result2 = mysqli_query($conn, $sql2);
        while ($row = mysqli_fetch_assoc($result2)) {
            echo "<tr style='border: 2px solid black;'>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td>" . $row['customer_id'] . "</td>";
            echo "<td>" . $row['orderDate'] . "</td>";
            echo "<td>" . $row['orderTime'] . "</td>";
            echo "<td style='background-color:#FAFAD2;'>" . $row['orderType'] . "</td>";
            echo "<td>" . $row['total_amount'] . "</td>";
            echo "</tr>";
        }
    }else {
      echo "<tr><td colspan='7'>No matching results found.</td></tr>";
    }
        ?>
    </table>


</body>
</html>