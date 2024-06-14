<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detial</title>
    <link rel="stylesheet" href="../Style/admin.css">
</head>

<body>
    <div id="container">
        <h2>Order Details | <a href="../Admin/listorder.php" class="button button5">Back</a></h2>
        <hr>
        <?php
        require ("../DB/db.php");
        $orderid = $_GET['orderid'];
        $sql = "SELECT * FROM tblorder WHERE orderid=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $orderid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            echo ("<p>Orderid : " . $row["orderid"] . "</p>");
            echo ("<p>OrderDate : " . $row["orderdate"] . "</p>");
            echo ("<p>Customer : " . $row["custname"] . "</p>");
            echo ("<p>Phone : " . $row["phone"] . "</p>");
            echo ("<p>Location : " . $row["location"] . "</p>");
        }
        ?>
        <table border="1">
            <tr>
                <th>productid</th>
                <th>product name</th>
                <th>price</th>
                <th>qty</th>
                <th>amount</th>
            </tr>
            <?php
            $sql = "SELECT tblproduct.productid, productname, tblorderproduct.price, qty ,tblorderproduct.price*qty AS amount FROM 
            tblorderproduct INNER JOIN tblproduct ON tblorderproduct.productid = tblproduct.productid WHERE orderid=?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $orderid);
            $stmt->execute();
            $result = $stmt->get_result();
            $total = 0;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["productid"] . "</td>";
                echo "<td>" . $row["productname"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["qty"] . "</td>";
                echo "<td>" . $row["amount"] . "</td>";
                echo "</tr>";
                $total += $row["amount"];
            }
            echo ("<tr><td colspan='4'>Total Amount</td><td> $total</td></tr>")
                ?>
        </table>
    </div>
</body>

</html>
</body>
</html>