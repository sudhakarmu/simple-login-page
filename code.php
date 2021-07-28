<?php
include('database/dbconfig.php');
include('security.php');


if(isset($_POST['login']))
{
    $email = htmlentities($_POST['email']);

    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE `email`='$email' AND `status`=1";

    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);

    $passwd = $row['password'];

    if(password_verify($_POST['password'], $passwd))
    {
        $_SESSION['id'] = $row['id'];

        header('location:index.php');
    }
    else
    {
        echo "<script>";
        echo "alert('Email/Passwrod is incorrect');";
        echo "window.location = 'login.php';"; 
        echo "</script>";    
    }

}

else if(isset($_POST['register']))
{
    $email = htmlentities($_POST['email']);

    $password = htmlentities($_POST['password']);

    $username = htmlentities($_POST['username']);

    $query = "SELECT * FROM user WHERE `email`='$email'";

    $result = mysqli_query($con,$query);

    $row= mysqli_num_rows($result);

    if($row <= 0)
    {

    $token = md5($_POST['email']).rand(10,9999);

    $passwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $qry = "INSERT INTO user(`username`, `email`, `email_verification_link` ,`password`) VALUES('$username','$email', '$token','$passwd')";

    $res = mysqli_query($con, $qry);

    $link = "<a href='www.sudhakar-muthumani.me/assessment/verify_email.php?key=".$email."&token=".$token."'>Click and Verify Email</a>";

    /*require_once('phpmail/PHPMailerAutoload.php');

    $mail = new PHPMailer();

    $mail->CharSet =  "utf-8";

    $mail->IsSMTP();

    $mail->SMTPAuth = true;    

    $mail->Username = "msudhakar826@gmail.com";

    $mail->Password = "sudhakar121";

    $mail->SMTPSecure = "ssl";  

    $mail->Host = "smtp.gmail.com";

    $mail->Port = "465";

    $mail->From='msudhakar826@gmail.com';

    $mail->FromName='Sudhakar Muthumani';

    $mail->AddAddress($email, $username);

    $mail->Subject  =  'Verify Email';

    $mail->IsHTML(true);

    $mail->Body    = 'Click On This Link to Verify Email '.$link.'';

    if($mail->Send())
    {
        echo "<script>";
        echo "alert('Check Your Email box and Click on the email verification link.');";
        echo "window.location = 'login.php';"; 
        echo "</script>";            
    }
    else
    {
        echo "<script>";
        echo "alert('Mail Error - > $mail->ErrorInfo');";
        echo "window.location = 'login.php';"; 
        echo "</script>";   
    }*/
    $myemail = 'msudhakar724@gmail.com';//<—–Put Your email address here. 

    $email_address = 'msudhakar724@gmail.com';
    
    if(empty($errors))
    {
        $to = $myemail;

        $email_subject = "Registration";

        $email_body = 'Click On This Link to Verify Email '.$link.'';

        $headers = "From: $email\n";

        $headers .= "Reply-To: $email_address";

        mail($to,$email_subject,$email_body,$headers);
        echo "<script>";
        echo "alert('Check your inbox');";
        echo "window.location = 'login.php';"; 
        echo "</script>"; 
    }
    else{
        echo "<script>";
        echo "alert('Mail not sent');";
        echo "window.location = 'login.php';"; 
        echo "</script>"; 
            
    }
    }
    else
    {
        echo "<script>";
        echo "alert('You have already registered with us. Check Your email box and verify email.');";
        echo "window.location = 'login.php';"; 
        echo "</script>"; 
    }


}

else if(isset($_POST['forgot']))
{
    $email = htmlentities($_POST["email"]);
        if (!$email) 
        {
            $error .="<p>Invalid email address please type a valid email address!</p>";
        }
        else
        {
            $query = "SELECT * FROM `users` WHERE email='$email'";

            $result = mysqli_query($con,$query);

            $row = mysqli_num_rows($results);

            if(!empty($row)){
                $error .= "<p>You have already registered with us!</p>";
            }
        }
        if($error!="")
        {
           echo "<div class='error'>".$error."</div>";
        }
        else{  
            $expformat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));

            $expdate = date("Y-m-d H:i:s",$expformat);

            $key = md5(2418*2+$email);

            $addkey = substr(md5(uniqid(rand(),1)),3,10);

            $key = $key . $addkey;

            $qry = "INSERT INTO `password_reset_temp` (`email`,`key`,`expDate`) VALUES('$email','$key', '$expdate')";
            $res = mysqli_query($con,$qry);
        
            $output='<p>Dear user,</p>';

            $output.='<p>Please click on the following link to reset your password.</p>';

            $output.='<p><a href="http://www.sudhakar-muthumani.me/assessment/reset_password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">http://www.sudhakar-muthumani.me/assessment/reset_password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';	

            $output.='<p>Please be sure to copy the entire link into your browser. The link will expire after 1 day for security reason.</p>';
        
            $output.='<p>Thanks,</p>';

            $output.='<p>TEAM</p>';
            
            $body = $output; 
        
            $subject = "Password Recovery";

            $myemail = 'msudhakar724@gmail.com';//<—–Put Your email address here. 

            $email_address = 'msudhakar724@gmail.com';
            
            if(empty($errors))
            {
                $to = $myemail;
        
                $email_subject = "Password Recovery";
        
                $email_body = $output;
        
                $headers = "From: $email\n";
        
                $headers .= "Reply-To: $email_address";
        
                mail($to,$email_subject,$email_body,$headers);
                echo "<script>";
                echo "alert('Check your inbox');";
                echo "window.location = 'login.php';"; 
                echo "</script>"; 
            }
            else{
                echo "<script>";
                echo "alert('Mail not sent');";
                echo "window.location = 'login.php';"; 
                echo "</script>"; 
                    
            }

            /*require_once('phpmail/PHPMailerAutoload.php');

            $mail = new PHPMailer();

            $mail->CharSet =  "utf-8";

            $mail->IsSMTP();

            $mail->SMTPAuth = true;    

            $mail->Username = "msudhakar826@gmail.com";

            $mail->Password = "sudhakar121";

            $mail->SMTPSecure = "ssl";  

            $mail->Host = "smtp.gmail.com";

            $mail->Port = "465";

            $mail->From='msudhakar826@gmail.com';

            $mail->FromName='Sudhakar Muthumani';

            $mail->AddAddress($email, $username);

            $mail->Subject  =  'Reset Password';

            $mail->IsHTML(true);

            $mail->Body    = $body;

            if($mail->Send())
            {
                echo "<script>";
                echo "alert('Check Your Email box and Click on the reset link.');";
                echo "window.location = 'login.php';"; 
                echo "</script>";            
            }
            else
            {
                echo "<script>";
                echo "alert('Mail Error - > $mail->ErrorInfo');";
                echo "window.location = 'login.php';"; 
                echo "</script>";   
            }*/
        }
}
else if(isset($_POST['reset']))
{
    $email = $_POST['email'];
    
    $passwd = $_POST['password'];

    $curdate = $_POST['curdate'];

    if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = "UPDATE `user` SET `password`='$password' WHERE `email`='$email'";

        mysqli_query($con,$query);

        $qry = "DELETE FROM `password_reset_temp` WHERE `email`='$email'";

        mysqli_query($con,$qry);
            
        echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
        <p><a href="http://www.sudhakar-muthumani.me/assessment/login.php">Click here</a> to Login.</p></div><br />';
    }
}

?>