<?php
if($_GET['key'] && $_GET['token'])
{
    include('database/dbconfig.php');

    $email = $_GET['key'];

    $token = $_GET['token'];

    $query = "SELECT * FROM `user` WHERE `email_verification_link`='$token' and `email`='$email'";

    $result = mysqli_query($con,$query);

    $d = date('Y-m-d H:i:s');

    if(mysqli_num_rows($result)>0) {

        $row= mysqli_fetch_array($result);
        if($row['email_verified_at']==NULL){
            $qry = "UPDATE user SET `email_verified_at` ='$d' WHERE `email`='$email'";
            $res = mysqli_query($con,$qry);
            $msg = "Congratulations! Your email has been verified.";
        }
        else{
            $msg = "You have already verified your account with us";
        }
    } 
    else {
        $msg = "This email has been not registered with us";
    }
}
else
{
    $msg = "Danger! Your something goes to wrong.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Page | Assesment</title>
</head>
<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center">
                User Account Activation by Email Verification using PHP
            </div>
            <div class="card-body">
                <p><?php echo $msg; ?></p>
            </div>
        </div>
    </div>
</body>
</html>