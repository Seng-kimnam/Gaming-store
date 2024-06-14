<?php
require '../DB/db.php';
$productid = $_GET["productid"];
//Get Picture 
$picture = "";
$sql = "SELECT picture FROM tblproduct WHERE productid=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productid);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
      $picture = "../Images/" . $row["picture"];
}
//Delete 
$sql = "delete from tblproduct where productid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productid);
if ($stmt->execute() == true) {
      unlink($picture);//remove file 
      header("Location:product.php");
} else {
      echo "Error: " . $sql . "<br>" . $conn->error;
}
