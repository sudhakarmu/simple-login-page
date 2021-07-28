<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Assesment</title>
</head>
<body>
<?php
include('database/dbconfig.php');

if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"]))
{
  
    $key = $_GET["key"];
  
    $email = $_GET["email"];
  
    $curdate = date("Y-m-d H:i:s");
  
    $query = "SELECT * FROM `password_reset_temp` WHERE `key`='$key' and `email`='$email'";

    $result = mysqli_query($con,$query);
  
    $row = mysqli_num_rows($result);
  
    if ($row=="")
    {
        $error .= ' <h2>Invalid Link</h2>
                    <p>The link is invalid/expired. Either you did not copy the correct linkfrom the email, or you have already used the key in which case it is deactivated.</p>
                    <p><a href="http://www.sudhakar-muthumani.me/assessment/index.php">Click here</a> to reset password.</p>';
	}
    else{
        $row = mysqli_fetch_assoc($result);
        $expdate = $row['expdate'];
        if ($expdate >= $curdate)
        {
  ?>
<div class="container">
  <div class="card">
        <h1 class="card-title">Reset Password</h1>
        <form class="card-form needs-validation" method="POST" action="code.php" novalidate oninput='confirm.setCustomValidity(confirm.value != password.value ? "Passwords do not match." : "")'>
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="email" value="<?php echo $email;?>"/>
        <input type="hidden" name="curdate" value="<?php echo $curdate;?>"/>
            <label for="password">Password</label>
            <div class="card-input-container password">
                <input type="password" placeholder="Enter your password" id="password" name="password" maxlength="30" minlength="8" required>
                <div class="invalid-feedback">
                    Password must be atleast 8 characters and less than 30 characters
                </div>
            </div>
            <label for="password">Password</label>
            <div class="card-input-container password">
                <input type="password" placeholder="Confirm your password" id="confirm" name="confirm" maxlength="30" minlength="8" required>
                <div class="invalid-feedback">
                    Password and confirm password doesn't match
                </div>
            </div>
            <button class="card-button" type="submit" name="reset">Reset Password</button>
        </form>
    </div>
</div>
<?php
        }
            else{
                $error .= "<h2>Link Expired</h2><p>The link is expired. You are trying to use the expired link which as valid only 24 hours (1 days after request).<br /><br /></p>";
            }
    }
    if($error!="")
    {
        echo "<div class='error'>".$error."</div><br />";
    }			
}

?>
</body>
<script>
    (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
</html>