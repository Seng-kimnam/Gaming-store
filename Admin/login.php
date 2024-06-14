<!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Login</title>
<link rel="stylesheet" href="../Style/log.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

</style>
</link>
</head>

<body>
  <div class="login-container">
    <div class="left-grid">
      <div class="img">
        <a href="../index.php"> <img src="../images/login.svg" alt="Login" /></a>
      </div>
    </div>
    <div class="right-grid">
      <div class="header">
        <h2>Admin Login Form</h2>
      </div>
      <form method="POST">
        <div class="form">
          <input type="text" placeholder="Username" name="adminname" />
          <span class="user"><i class="fa-solid fa-user"></i></span>
          <input type="password" placeholder="Password" name="password" />
          <span class="password"><i class="fa-solid fa-lock"></i></span>
        </div>
        <div class="btn-container">
          <input type="submit" name="btnlog" id="" value="Log In" class="btn-log" />
          <!-- <button class="btnsignup"><a href="signup.php">Sign up</a></button> -->
      </form>
    </div>
    <?php
    if (isset($_POST["btnlog"])) {
      $u = $_POST["adminname"];
      $p = md5($_POST['password']);
      $sql = "SELECT fullname FROM tbladmin WHERE adminname=? AND PASSWORD=?;";
      require("../DB/db.php");
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $u, $p);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {
        session_start();
        $_SESSION['fullname'] = $row['fullname']; //Vorn Viva 
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Successful",
                    text: "Login Successfully",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "product.php";
                    }
                });
              </script>';
        // header("Location: product.php");
      } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Log in Failed",
                    text: "Please your username and password again.",
                    confirmButtonText: "Try Again"
                });
              </script>';
      }
    }
    ?>

  </div>
</body>

</html>
<!-- php code -->