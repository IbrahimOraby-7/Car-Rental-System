<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = hash('sha256', $_POST['password']);
    $cpass = hash('sha256', $_POST['cpassword']);
    $user_type = $_POST['user_type'];
    $date = $_POST['date'];
    $address =$_POST['address'];
    $phonenum =$_POST['phonenum'];
    $ssn=$_POST['ssn'];
    $error = array(); 

   
     $stmt_select = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt_select->bind_param("s", $email);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'Passwords do not match!';
        
        } else {
            $insert = "INSERT INTO users(name, email, password, user_type,address,phone,id) VALUES('$name', '$email', '$pass', '$user_type','$address','$phonenum',  '$ssn')";
            mysqli_query($conn, $insert);
            header('location: login_form.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Register Now</h3>
            <?php
            if (isset($error) && count($error) > 0) {
                foreach ($error as $errMsg) {
                    echo '<span class="error-msg">' . $errMsg . '</span>';
                }
            }
            ?>
            <input type="text" name="name" required placeholder="Enter your name" maxlength="20">  <input type="email" name="email" required placeholder="Enter your email" maxlength="50"> <input type="text" name="ssn" required placeholder="Enter your SSN" maxlength="20"> <input type="password" name="password" required placeholder="Enter your password" maxlength="20"> <input type="password" name="cpassword" required placeholder="Confirm your password" maxlength="20"> <input type="text" name="address" required placeholder="Enter your address" maxlength="50"> <input type="text" name="phonenum" required placeholder="Enter your number" maxlength="20">
            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Register Now" class="form-btn">
            <p>Already have an account? <a href="login_form.php">Login now</a></p>
        </form>
    </div>
    <footer>
    </footer>
<style>
    body {
    background: url('img/SignBackGround.jpg') center center / cover;
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
    width: 95%;
}

h3 {
    text-align: center;
    margin-bottom: 25px;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    border: none;
    border-radius: 5px;
    background-color: #4169E1;
    color: white;
    cursor: pointer;
    padding:10px; 
}

input[type="submit"]:hover {
    background-color: #a305d3;
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
