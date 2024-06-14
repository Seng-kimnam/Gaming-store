<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>listcart</title> 
    <link rel="stylesheet" href="../Style/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

</head> 
<style>

      @import url("https://fonts.googleapis.com/css2?family=Odor+Mean+Chey&family=Poppins:wght@200;300;400;700&display=swap");
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      html {
      font-size: 62.5%;
      }
      body {
        font-family: "Poppins", sans-serif, "Odor Mean Chey", serif;
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(5px);
        background: url(../Images/gamingbg.webp) center / cover no-repeat;
      }
      #container{
        font-size:18px;
        display:flex;
        flex-direction: column;
        background-color: transparent !important;
        padding:6rem;
        gap:15px;
        border-radius:1.5rem;
        box-shadow: 0 0 30px white;
        color:white;
      }
      h1{
        text-align:center;
        margin-top: 1rem;
        font-size:30px;
      }
      p
      {
        text-align: center; 
        width: 10%;
        background: red;
        border-radius: 15px;
      }
      .button{
        text-decoration: none;
        font-size:18px;
        background-color: blue;
        color:white;
        padding: 1.2rem 1.5rem;
        border-radius: .5rem;
        transition: all .2s ease-in-out;
        vertical-align: middle;

      }
      table,tr,th,td{
        border-collapse: collapse;
        padding:2rem;
        text-align: center;
        border:2px solid white;
        font-size:20px;
        font-weight:bold
      } 
      tr:nth-child(2) > td:nth-child(5)> span{
      /* display: flex;
      gap:10px; */
        font-size:20px;
        margin-inline: 20px;
      }
      tr:nth-child(2) > td:nth-child(5){
        width: 270px;
      }
      .button2:hover{
        background-color: dodgerblue;
        
      }
      .button3:hover
      {
        opacity: 0.8;
      }
      input[type="submit"]:hover{
        background-color: dodgerblue;
      }
      label{
        font-size:20px;
        /* color:white; */
      }
      input[type="text"]{
        font-family: "Poppins", sans-serif, "Odor Mean Chey", serif;
        font-size: 15px;
        padding:.9rem 1.5rem;
        outline:none;
        border:none
      }
      input[type="submit"]{
        font-family: "Poppins", sans-serif, "Odor Mean Chey", serif;
        font-size: 18px;
        padding: .95rem 1.5rem;
        outline:none;
        border:none;
        cursor: pointer;
      }
      label{
        margin:0 2rem;
      } input[type="text"]:focus{
        outline:2px solid black;
      }
      input[type="submit"]:hover{
        background-color: dodgerblue;
      }
      .button3
      {
        color:white;
        background-color: red;
      }
     
</style>
<body> 
<div id="container"> 
    <h1>List Book in Your cart | <a href="../Client/Cart.php" class="button button5">Buy More ?</a></h1> 
    <table border="1"> 
        <tr> 
            <th>Option</th> 
            <th>product id</th> 
            <th>product name</th> 
            <th>price</th> 
            <th>qty</th> 
            <th>amount</th> 
        </tr> 
    <?php 
        session_start(); 
        $total =  0; 
        if(isset($_SESSION['cart'])){ 
          // echo("<p class=''>Item have been exist</p>"); 
            $cart = $_SESSION['cart']; 
            for($r=0;$r<count($cart);$r++){ 
                echo("<tr>"); 
                echo("<td><a  href='deletecart.php?index=" . $r . "' class='button button3' onclick='return 
confirm(\"Sure?\");'><i class='fa-solid fa-trash'></i></a></td>"); 

                echo "<td>" .$cart[$r][0]. "</td>"; 
                echo "<td>" . $cart[$r][1] . "</td>"; 
                echo "<td>" . $cart[$r][2] . "</td>"; 
                echo "<td><a href='editcart.php?index=" . $r . "&oper=sub' class='button button3'>-</a>" . 
                     "<span>".$cart[$r][3]."</span>" .  
                     "<a href='editcart.php?index=" . $r . "&oper=sum' class='button button2'>+</a></td>"; 
                echo "<td>$ " . ($cart[$r][2] * $cart[$r][3]) . "</td>"; 
                echo("</tr>"); 
                $total += $cart[$r][2] * $cart[$r][3]; 
            } 
        }else{ 
            echo("<p>No Item</p>"); 
        }    
        echo("<tr><td colspan='5'>Total Amount : </td><td>$ $total</td></tr>"); 
    ?> 
    </table> 
  <h1>Customer Info</h1> 
  <form method="post" enctype="multipart/form-data"> 
    <label for="custname">Customer Name :</label> 
    <input type="text" id="custname" name="custname" >  
    <label for="phone">Phone :</label> 
    <input type="text" id="phone" name="phone"> 
    <label for="location">Location :</label>
    <input type="text" name="location" id="location"> 
    <input type="submit" name="btnsubmit" value="Pay now" class="button" style="background-color:blue;"> 
  </form>
  <?php   
  if(isset($_POST['btnsubmit'])){ 
    require("../DB/db.php"); 
    $custname = $_POST["custname"]; 
    $phone = $_POST["phone"]; 
    $location = $_POST["location"];
    date_default_timezone_set("Asia/Phnom_Penh"); 
    $orderdate = date("Y-m-d");
    $sql = "INSERT INTO tblorder(orderdate,custname,phone ,location) VALUES(?,?,?,?);"; 
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ssss",$orderdate,$custname,$phone ,$location); 
    if($stmt->execute()==true){ 
      $orderid = $conn->insert_id; 
      for($r=0;$r<count($cart);$r++){ 
        $productid = $cart[$r][0]; 
        $price = $cart[$r][2]; 
        $qty = $cart[$r][3];
        $conn->query("insert into tblorderproduct(orderid,productid,price,qty) values($orderid,$productid,$price,$qty)"); 
      } 
      unset($_SESSION['cart']); 
      echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
      echo '<script>
              Swal.fire({
                  icon: "success",
                  title: "Successful",
                  text: "Submit Successfully",
                  confirmButtonText: "OK"
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = "cart.php";
                  }
              });
            </script>';
    }else{ 
      echo "Error: " . $sql . "<br>" . $conn->error; 
    } 
  } 
?> 
</div> 
</body> 
</html> 
