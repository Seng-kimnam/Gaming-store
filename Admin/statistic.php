<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistic</title>
    <link rel="stylesheet" href="../Style/admin.css">
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Odor+Mean+Chey&family=Poppins:wght@200;300;400;700&display=swap");
      
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Khmer:wght@100..900&display=swap');

    body
    {
        font-family: 'Poppins';
    }
         table ,tr,td ,th {
        font-family: 'Poppins';
        text-align: center;
        border: 2px solid black;
        font-size: 18px;
         }
    td {
        
    padding-block: 20px;
    border: 1px solid whitesmoke;
    }
    th
    {
        padding-block: 20px;
        background-color: black;
        color:white;
    }
    tr:last-child
    {
        background-color: green;
        color:white
    }
    h3
    {
        font-family: "Noto Sans Khmer";
        background-color: green;
        width: 300px;
        text-align: center;
        padding: 10px;
        border-radius: 20px;
        color:whitesmoke

    }
    </style>
</head>

<body>
    <div id="container">
        <?php require ("menu.php") ?>
        <h2 style="text-align:center">Product Statistics</h2>
        <table border="1">
            <tr>
                <th>N<sup>o</sup></th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Amount</th>
            </tr>
            <?php
            require ("../DB/db.php");
            $sql = "select * from vstatics";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $num = 1;
            $total = 0;
            $maxQuantity = 0;
            $maxProduct = "";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $num . "</td>";
                echo "<td>" . $row["Productname"] . "</td>";
                echo "<td>" . $row["Quantity"] . "</td>";
                echo "<td>$ " . $row["Amount"] . "</td>";
                echo "</tr>";
                $total += $row["Amount"];
                $num++;
                if($row["Quantity"] > $maxQuantity)
                {
                    $maxQuantity= $row["Quantity"];
                    $maxProduct = $row["Productname"];
                    // continue;
                }
                
            }
            echo ("<tr><td colspan='3'>Total Amount</td><td> $ $total.00</td></tr>");
                ?>
        </table>
          <?php if ($maxProduct !== '') : ?>
            <h3>!!! ទំនិញដែលលក់ដាច់ជាងគេ : <?php echo $maxProduct; ?> </br>ចំនួន : <?php echo $maxQuantity; ?> គ្រឿង</h3>
        <?php endif; ?>
    </div>
</body>

</html>