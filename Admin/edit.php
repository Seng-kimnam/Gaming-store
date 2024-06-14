<!DOCTYPE html>
<html>

<style>
  @import url("https://fonts.googleapis.com/css2?family=Odor+Mean+Chey&family=Poppins:wght@200;300;400;700&display=swap"); 
    body {
    font-family: "Poppins", sans-serif, "Odor Mean Chey", serif;
    display: flex;
    height: 90vh;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(5px);
    background: url(../Images/gamingbg.webp) center / cover no-repeat;
    overflow: hidden;
}
    input[type=text],
    [type=date],
    [type=file],
    [type=number],
    select {
    outline:none;
    border:none;
    font-family:'Poppins';
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    
    input[type=submit] {
    font-family:'Poppins';
    width: 100%;
    background-color: purple;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: all .15s ease-in-out;
}

input[type=submit]:hover {
    filter:brightness(1.2)
}

  div { 
    width: 400px; 
    border-radius: 5px; 
    background-color: transparent !important;
    color:white !important;
    border:1px solid white !important;
    box-shadow: 0 0 30px;
    padding: 20px; 
    margin: auto; 
  } 
  img
  {
    border-radius: 50%;
    border:dashed 2px ;
  }
    
</style>

<script type="text/javascript">
function showimg() {
    //Display Image 
    var input = document.getElementById("myfile");
    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function(event) {
        var img = document.getElementById("picture");
        img.src = event.target.result;
    }
}
</script>

<body>

    <div>
        <h2 style="text-align:center;">Edit Product</h2>

        <?php
    if (!isset($_POST['btnsubmit'])) {
      require ("../DB/db.php");
      $productid = $_GET['productid'];
      $sql = "SELECT * FROM tblproduct WHERE productid=?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $productid);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($row = $result->fetch_assoc()) {
        ?>
        <form method="post" enctype="multipart/form-data">
        <label for="productname">Brand Name</label>
        <input type="text" id="brandname" name="brandname" value="<?php echo ($row['brandname']) ?>">
            <label for="productname">Product Name</label>
            <input type="text" id="productname" name="productname" value="<?php echo ($row['productname']) ?>">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" value="<?php echo ($row['price']) ?>"> <br>
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="<?php echo ($row['description']) ?>"> <br>
            <label for="picture">Picture</label>
            <img src="../Images/<?php echo ($row['picture']) ?>" id="picture" name="picture" width="80px" height="80px">
            <input type="file" id="myfile" name="myfile" onchange="showimg()">
            <input type="submit" name="btnsubmit" value="Save"> 
        </form>
        <?php }
    } ?>
    </div>
    <?php
  if (isset($_POST['btnsubmit'])) {
    require ("../DB/db.php");
    $productid = $_GET['productid'];
    $brandName = $_POST['brandname'];
    $productname = $_POST["productname"];
    $description =  $_POST["description"];
    $price = $_POST["price"];
    $picture = "";
    if (file_exists($_FILES['myfile']['tmp_name'])) {
      //Upload Image 
      $extension = pathinfo($_FILES['myfile']['name'], PATHINFO_EXTENSION);
      $picture = $productid . "." . $extension;
      move_uploaded_file($_FILES['myfile']['tmp_name'], "../Images/$picture");
      //Update with image 
      $sql = "update tblproduct set brandname =? ,productname=?, price=?, picture=? , description=? where productid=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssssi", $brandName, $productname, $price, $picture, $description, $productid);
    } else {
      //Update without image 
      $sql = "update tblproduct set brandname=?, productname=?, price=? , description=? where productid=? ";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssssi",$brandName, $productname, $price, $description, $productid);
    }

    if ($stmt->execute() == true) {
      header("Location:product.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }
  ?>

</body>

</html>