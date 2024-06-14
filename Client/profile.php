<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <title>Sign up page</title>
</head>
<style>

</style>
<script type="text/javascript">
    function showimg() {
        //Display Image 
        const input = document.getElementById("myfile");
        const fReader = new FileReader();
        fReader.readAsDataURL(input.files[0]);
        fReader.onloadend = function(event) {
            var img = document.getElementById("picture");
            img.src = event.target.result;
        }
    }
</script>

<body>
    <div class="container">
        <div class="form">
            <form method="post" enctype="multipart/form-data">
                <h1>Your Profile</h1>
                <?php
                session_start();
                if (isset($_SESSION['clientfn'])) {
                    echo ("<p>Welcome Mr/Mrs : " . $_SESSION['clientfn'] . "</p>");
                } else {
                    header("Location:login.php");
                }
                ?>
                 <div class="img">
                 <img src="" id="picture" name="picture" width="100px" height="100px">
                 </div>
              <div class="file">
              <!-- <input type="file" id="myfile" name="myfile" onchange="showimg()"> -->
              </div>
            
              <div class="btnlogout">
              <button><a href="login.php">Log out</a></button>
              </div>
              <div>
                <a href="History.php">Your History</a>
              </div>
            </form>
        </div>
    </div>
</body>
</html>
