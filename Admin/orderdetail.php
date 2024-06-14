<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="../Style/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Odor+Mean+Chey&family=Poppins:wght@200;300;400;700&display=swap");
        button
        {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
           
            
        }
        button
        {
            margin-left: 15px;
            transition: all 0.3s ease-in-out;
        }
        button:hover
        {
            transform: scale(1.1);
        }
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
    </style>
</head>

<body>
    <div id="container">
        <h1 style="text-align:center ; text-decoration:underline">Order Report</h1>
        <h2>Order Details | <a href="../Admin/listorder.php" id="btnback" class="button button5"><i class="fa-solid fa-backward"></i></a></h2>
        <button id="downloadBtn" title="Download" onclick="generatePDF()">Download As PDF<i class="fa-solid fa-download"></i></button>
        <hr>
        <?php
        require("../DB/db.php");
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
        <table>
            <tr>
                <th>productid</th>
                <th>product name</th>
                <th>price</th>
                <th>qty</th>
                <th>amount</th>
            </tr>
            <?php
            $sql = "SELECT tblproduct.productid, productname, tblorderproduct.price, qty, tblorderproduct.price*qty AS amount FROM tblorderproduct INNER JOIN tblproduct ON tblorderproduct.productid = tblproduct.productid WHERE orderid=?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $orderid);
            $stmt->execute();
            $result = $stmt->get_result();
            $total = 0;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["productid"] . "</td>";
                echo "<td>" . $row["productname"] . "</td>";
                echo "<td>$ " . $row["price"] . "</td>";
                echo "<td>" . $row["qty"] . "</td>";
                echo "<td>$ " . $row["amount"] . "</td>";
                echo "</tr>";
                $total += $row["amount"];
            }
            echo ("<tr><td colspan='4'>Total Amount :</td><td>$ " . $total . "</td></tr>");
            ?>
        </table>
    </div>

    <script>
        function generatePDF() {
            const element = document.getElementById('container');
            const downloadBtn = document.getElementById('downloadBtn');
            const btnBack =document.getElementById("btnback");
            
            // Hide the download button
            btnBack.style.display = 'none';
            downloadBtn.style.display = 'none';

            // Generate the PDF
            html2pdf().from(element).set({
                margin: 0,
                filename: 'order-details.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            }).save().then(() => {
                // Show the download button again after the PDF is generated
                downloadBtn.style.display = 'block';
                btnBack.style.display = 'inline-block';
            });
        }
    </script>
</body>

</html>
