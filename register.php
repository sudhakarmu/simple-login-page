<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page | Assesment</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.esm.min.js" integrity="sha384-pXJyILVSfKOB4xKYbM0dJr+oH4iVvo4s7mWbiTHe6LSxd38hl16DMj6AOJyy2Wcz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
  <div class="card">
        <h1 class="card-title">Welcome!</h1>
        <small class="card-subtitle">Enter your details to sign up</small>
        <form class="card-form needs-validation" method="POST" action="code.php" novalidate oninput='confirm.setCustomValidity(confirm.value != password.value ? "Passwords do not match." : "")'>
        <label for="name">User Name</label>
            <div class="card-input-container username">
                <input type="text" placeholder="Enter your name" id="username" name="username" minlength="4" maxlength="30" required>
                <div class="invalid-feedback">
                    Please enter a valid name
                </div>
            </div>
            <label for="email">Email</label>
            <div class="card-input-container username">
                <input type="email" placeholder="Enter your email" id="email" name="email" minlength="8" maxlength="65" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                <div class="invalid-feedback">
                    Please enter a valid email
                </div>
            </div>
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
            <button class="card-button" type="submit" name="register">Sign Up</button>
            <small class="card-forgot-password">Already an user? <a href="login.php">Sign in</a></small>
        </form>
    </div>
</div>
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