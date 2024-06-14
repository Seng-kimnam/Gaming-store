<style>
    body {
        width:  100%;
    }
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
    width: 100%;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    opacity: 0.8;
}

.logout {
    background-color: red;
}
</style>
<?php
session_start();
if (!isset($_SESSION['fullname'])) {
    header("Location:login.php");
}
?>
<ul>
    <li><a href="product.php">Products</a></li>
    <li><a href="listorder.php">List Order</a></li>
    <li><a href="statistic.php">Statistic</a></li>
    <li style="float:right"><a class="logout" href="logout.php">Log out</a></li>
</ul>