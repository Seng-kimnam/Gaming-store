<!DOCTYPE html>
<html>
    <title>Add Products</title>
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
    background-color: transparent;
    padding: 20px;
    margin: auto;
    color:white !important;
    border: 1px solid white;
    box-shadow: 0 0 30px white;
}

img {
    border-radius: 50%;
    border: dashed 2px;
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
        <h2 style="text-align:center;">Add New Product</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="brandname">Brand Name</label>
            <input type="text" name="brandname" id="brandname" placeholder="Enter Brand Name">
            <label for="productname">Product Name</label>
            <input type="text" id="title" name="productname" placeholder="Enter Product Name">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" placeholder="Enter Product Price"> <br>
            <label for="description">Description</label>
            <input type="text" id="description" name="description" placeholder="Enter Product Description"> <br>
            <label for="picture">Image</label>
            <img src="" id="picture" name="picture" width="100px" height="100px">
            <input type="file" id="myfile" name="myfile" onchange="showimg()" placeholder="Enter Product Image">
            <input type="submit" name="btnsubmit" value="Save">
        </form>

    </div>

    <?php
    if (isset($_POST['btnsubmit'])) {
        require ("../DB/db.php");
        $brandName = $_POST['brandname'];
        $productname = $_POST["productname"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        $sql = "INSERT INTO tblproduct (brandname,productname,price,description) VALUES(?,?,?,?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss",$brandName, $productname, $price , $description);
        if ($stmt->execute() == true) {
            $last_id = $conn->insert_id;
            $extension = pathinfo($_FILES['myfile']['name'], PATHINFO_EXTENSION);
            $picture = $last_id . "." . $extension;
            move_uploaded_file($_FILES['myfile']['tmp_name'], "../Images/$picture");
            $conn->query("update tblproduct set picture='$picture' where productid=$last_id");
            header("Location:product.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

</body>

</html>