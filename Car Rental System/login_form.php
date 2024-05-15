<?php
@include 'config.php';

session_start();

$error = []; // Initialize the $error array

if(isset($_POST['submit'])){
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $pass = isset($_POST['password']) ? md5($_POST['password']) : '';
    $cpass = isset($_POST['cpassword']) ? md5($_POST['cpassword']) : '';
    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';

    $select = "SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');
            exit();
        } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
            exit();
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>login form</title>


</head>
<body>

<div class="form-container">

<form action="" method="post">
   <h3>login now</h3>
   <?php
   if(isset($error)){
      foreach($error as $error){
         echo '<span class="error-msg">'.$error.'</span>';
      };
   };
   ?>
   <input type="email" name="email" required placeholder="enter your email">
   <input type="password" name="password" required placeholder="enter your password">
   <input type="submit" name="submit" value="login now" class="form-btn">
   <p>don't have an account? <a href="register_form.php">register now</a></p>
</form>

</div>
<footer>
</footer>
<style>
body {
    background: url('img/SignBackGround.jpg');
    background-size: cover;
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.form-container {
            max-width: 400px;
            margin: auto;
            width: 100%;
            padding: 20px;
            border: 1px solid #4169E1;
            border-radius: 5px;
            margin-top: 50px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 10);
        }

form {

    display: flex;
    flex-direction: column;
}

h3 {
    text-align: center;
    margin-bottom: 20px;
}

input[type="email"],
input[type="password"],
input[type="submit"] {
    width: 95%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

input[type="submit"] {
         width: 100%;
         padding: 12px;
         border: none;
         border-radius: 5px;
         background-color: #007bff;
         color: #fff;
         font-size: 16px;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      input[type="submit"]:hover {
         background-color: #0056b3;
      }

.error-msg {
    color: red;
    margin-bottom: 10px;
}

p {
    text-align: center;
    margin-top: 15px;
}

footer {
    text-align: center;
    margin-top: 30px;
}

footer h3 {
    color: #555;
}
</style>

</body>
</html>
