<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    
    <title>Sign up page</title>
</head>
<style>
   p {
  color:whitesmoke
}
</style>

<body>
    <div class="container">
        <div class="form">
            <form method="post">
                <h1>Sign up</h1>
                <h2>Create your new account </h2>
                <div​ class="user-container">
                <span class="cf-user"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="fullname" placeholder="Enter Fullname" onfocus="this.placeholder=''" onblur="this.placeholder='Enter Fullname'" required>
                 
                    
                </div​>
                <div class="cf-usercontainer">
                <span class="user "><i class="fa-solid fa-user"></i></span>
                <input type="text" name="username" placeholder="Enter Username" onfocus="this.placeholder=''" onblur="this.placeholder='Enter Username'" required>
                </div>
                <div class="pw-container">
                    <span class="password"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" placeholder="Create Password" onfocus="this.placeholder=''" onblur="this.placeholder='Create new Password'" required>
                    
                </div>
                <div class="cf-pwcontainer">
                    <span class="cf-password"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="conpassword" placeholder="Confirm Password" onfocus="this.placeholder=''" onblur="this.placeholder='Confirm Password'" required>
                </div>
                <div class="btn-container">
                    <button name="signup">Create account</button>
                    <p>Already have an account ? <a href="login.php" class="sign-in">Log In</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

    <?php
    if(isset($_POST['signup']))
    {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['conpassword'];
     
        if(empty($fullname)|| empty($username) || empty($password) || empty($confirm_password))
        {
           
                echo ("<script type='text/javascript>alert('Please enter your information correctly');</script>");
        }       
        else
        {
            if ($password != $confirm_password) {
               
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Sign up Failed",
                text: "Please Check your confirm password",
                confirmButtonText: "Try Again"
            });
          </script>';
            }
            else
            {
session_start();

$mdpassword = md5($password);
require("../DB/db.php");

$sql = "INSERT INTO tblclient(clientname, clientfn, clientpsw) VALUES(?, ?, ?);";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $fullname, $mdpassword);

if ($stmt->execute() === true) {
    $_SESSION['status'] = "Successfully";
    $_SESSION['status_icon'] = 'success';
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
            Swal.fire({
                icon: "success",
                title: "Sign up Successful",
                text: "You have signed up successfully",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "login.php";
                }
            });
          </script>';
} else {
    // alert libray function
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Sign up Failed",
                text: "' . $conn->error . '",
                confirmButtonText: "Try Again"
            });
          </script>';
}

$stmt->close();
$conn->close();
        
            }
        }
    }
?>
