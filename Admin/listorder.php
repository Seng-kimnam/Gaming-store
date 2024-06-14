<!DOCTYPE html>
<html>
    <title>List Order</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<style>
    @import url("https://fonts.googleapis.com/css2?family=Odor+Mean+Chey&family=Poppins:wght@200;300;400;700&display=swap");
    body
    {
        font-family: 'Poppins';
        margin: 0;
        padding: 0;
    }
    form {
        margin: 20px 0 20px 0;
    }
    #container
    {
        margin: 0;
        
    }
    table ,tr,td ,th {
        font-family: 'Poppins';
        text-align: center;
        border: 2px solid black;
    }
    th
    {
        background-color: black;
        color:white;
    }
    input[type="date"]
    {
        font-family: "Poppins";
    }
</style>

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../Style/admin.css">
</head>

<body>
    <div id="container">
        <?php require ("menu.php") ?>
        <?php
        $date1 = isset($_POST["date1"]) ? strtotime($_POST["date1"]) : strtotime(date("Y-m-d"));
        $date2 = isset($_POST["date2"]) ? strtotime($_POST["date2"]) : strtotime(date("Y-m-d"));
        ?>
        <form method="post">
            <h1 style="text-align:center;  text-decoration: underline; font-weight: bold;">List Order Info</h1> <br />
            From : <input type="date" name="date1" value="<?php echo (date("Y-m-d", $date1)) ?>">
            To : <input type="date" name="date2" value="<?php echo (date("Y-m-d", $date2)) ?>">
            <input type="submit" value="Search" name="btnsearch">
        </form>
        <table>
            <tr>
                <th>Orderid</th>
                <th>Orderdate</th>
                <th>Customer</th>
                <th>Phone Number</th>
                <th>Location</th>
                <th>Options</th>
            </tr>
            <?php
            require ("../DB/db.php");
            $sql = "SELECT * FROM tblorder ";

            //Search 
            if (isset($_POST["btnsearch"])) {
                $sql .= " where orderdate between '" . date("Y-m-d", $date1) . "' and '" . date("Y-m-d", $date2) . "'";
            }
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["orderid"] . "</td>";
                // formating date 
                $formattedDate = date("d-M-Y", strtotime($row["orderdate"]));
                echo "<td>" . $formattedDate . "</td>";
                echo "<td>" . $row["custname"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>  
                        <a href='../Admin/orderdetail.php?orderid=" . $row["orderid"] . "' class='button 
button2'><i class= 'fa-solid fa-circle-info'></i></a>  
                     
                    </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>