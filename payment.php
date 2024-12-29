<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f0f0f0;
            font-family: Arial, sans-serif;
            background: url('img/SignBackGround.jpg') center center / cover;
        }

       
   
   

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .payment-details label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .payment-details input {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 3px;
            border: 1px solid #4169E1;
        }

        .payment-details input[type="submit"] {
            background-color: #4169E1;
            color: white;
            cursor: pointer;
        }

        .payment-details input[type="submit"]:hover {
            background-color: purple;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="payment-details">
            <h2>Payment Details</h2>

            <label for="CardNumber">Card Number:</label>
            <input type="text" name="CardNumber">

            <label for="Expiremonth">Expire Date:</label>
            <input type="date" name="Expiremonth">

            <label for="CVV">CVV:</label>
            <input type="CVV" name="CVV">

            <label for="email">Email:</label>
            <input type="text" name="email">

            <label for="no_of_days">Number of days:</label>
            <input type="text" id="no_of_days" name="no_of_days" required>

            <input type="submit" name="submit" value="Pay now">
        </form>
    </div>

    <?php
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $CardNumber = isset($_POST['CardNumber']) ? $_POST['CardNumber'] : '';
        $Expiremonth = isset($_POST['Expiremonth']) ? $_POST['Expiremonth'] : '';
        $CVV = isset($_POST['CVV']) ? $_POST['CVV'] : '';
        $no_of_days = isset($_POST['no_of_days']) ? $_POST['no_of_days'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        $sql = "INSERT INTO payment (cardnumber,  exdate , cvv , no_of_days , email)
                VALUES ('$CardNumber', '$Expiremonth', '$CVV', '$no_of_days','$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Payment has been done successfully";
            header("Location: user_page.php");
            exit();
        } else {
            echo "Error making payment: " . $conn->error;
        }
        $conn->close();
    }
    ?>
</body>

</html>
