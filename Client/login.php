<!DOCTYPE html>
<html lang="en">
<link>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Client Login</title>
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
                <a title="Back to home page" href="../index.php"> <img src="../images/login.svg" alt="Login" /></a>
            </div>
        </div>
        <div class="right-grid">
            <div class="header">
                <h2 style="margin-inline:50px">Log In Your Info</h2>
            </div>
            <form method="POST">
                <div class="form">
                    <input type="text" placeholder="Username" name="username" />
                    <span class="user"><i class="fa-solid fa-user"></i></span>
                    <input type="password" placeholder="Password" name="password" />
                    <span class="password"><i class="fa-solid fa-lock"></i></span>
                </div>
                <div class="btn-container">
                    <input type="submit" name="btnlog" id="" value="Log In" class="btn-log" />
                    <button class="btnsignup"><a href="signup.php">Sign up</a></button>
            </form>
        </div>
        <?php
        if (isset($_POST["btnlog"])) {
            $cName = $_POST["username"];
            $cPassword = $_POST['password'];
            setcookie($cName,$cPassword, time() + (1*60*60));
            $md5password = md5($cPassword); 
            require ("../DB/db.php");
            include ("../includes/alert.php");
            $sql = "SELECT clientfn FROM tblclient WHERE clientname=? AND clientpsw=?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $cName, $md5password);
            $stmt->execute();
            $result = $stmt->get_result();
            // session_start();
            if (empty($cUser) || empty($cPassword)) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Log in Failed",
                            text: "Wrong username or password",
                            confirmButtonText: "Try Again"
                        });
                      </script>';
            }
            if ($row = $result->fetch_assoc()) {
               
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
                // header("Location:cart.php");
            }
            
        }
        ?>

    </div>
</body>

</html>
