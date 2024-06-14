<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Product detail</title>
    <link rel="stylesheet" href="../Style/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Odor+Mean+Chey&family=Poppins:wght@200;300;400;700&display=swap");
    body
    {
        font-family: 'Poppins';
    }
         table ,tr,td ,th {
        font-family: 'Poppins';
        text-align: center;
        border: 2px solid black;
    }
     tr:nth-child(n+2):hover
    {
        background-color: whitesmoke;
    }
    p
    {
        text-align: end;
    }
    .fa-plus
    {
        padding: 5px;
    }
    </style>
</head>

    
<body>
    <div id="container">
        <?php require ("menu.php") ?>
        <h1 style="text-align:center">List Product Info</h1>

        <table border="1">
            <thead>
                <th>N<sup>o</sup></th>
                <th>Brand Name</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Picture</th>
                <!-- <th>Desciption</th> -->
                <th>Options</th>
            </thead>
            <?php
            require ("../DB/db.php");
            $sql = "SELECT * FROM tblproduct ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo "<tr class=\" content\">";
                echo "<td>" . $row["productid"] . "</td>";
                echo "<td  class=\" brandname\">" . $row["brandname"] . "</td>";
                echo "<td>" . $row["productname"] . "</td>";
                echo "<td>$ " . $row["price"] . "</td>";
                echo "<td><img src='../Images/" . $row["picture"] . "' width='80px' height='80px'></td>";
                // echo "<td>" . $row['description'] ."</td>";
                echo "<td>  
                        <a href='../Admin/Edit.php?productid=" . $row["productid"] . "' class='button button2'><i class='fa-solid fa-pen-to-square'></i></a> 
|  
                        <a href='../Admin/DeleteProduct.php?productid=" . $row["productid"] . "' class='button button3' 
onclick='return confirm(\"Sure?\");'><i class='fa-solid fa-trash'></i></a> 
                    </td>";
                echo "</tr>";
            }
            ?>
        </table>
        <p>
            <a href="AddProduct.php" class="button"><i class="fa-solid fa-plus"></i></a>
        </p>
    </div>
</body>

</html>