<!DOCTYPE html>
<html>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Rent Form</title>
   <link rel="stylesheet" href="style.css">
  <style>
    body {
    background: url('img/SignBackGround.jpg') center center / cover;
    background-size: cover;
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

    h2 {
      color: #333;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #333;
    }

    input[type="date"],
    input[type="text"],
    input[type="number"],
    select,
    input[type="submit"] {
      width: calc(100% - 12px);
      padding: 8px;
      margin-bottom: 15px;
      border-radius: 3px;
      border: 1px solid #4169E1;
    }

    input[type="submit"] {
      background-color: #4169E1;
      color: white;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: purple;
    }
  </style>
</head>

<body>

<h2>Rent Details</h2>
<form action="" method="post" enctype="multipart/form-data">
        <h2>Add a Car Reservation</h2>
        <label for="car_id">Select a Car:</label>
<select name="car_id" required>
    <option value="">Select Car ID</option>
    <?php
    include 'config.php'; 
     
    $sql = "SELECT car_id, car_model FROM car WHERE status = 'available'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['car_id'] . "'>" .
                "ID: " . $row['car_id'] . " | Model: " . $row['car_model'] . "</option>";
        }
    } else {
        echo "<option value=''>No cars available</option>";
    }
    $conn->close();
    ?>
</select>
        
        <label for="ssn">Your SSN:</label>
        <input type="text" id="ssn" name="ssn" required>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>

        <label for="no_of_days">Number of days:</label>
        <input type="text" id="no_of_days" name="no_of_days" required>

        <label for="location">Location:</label>
        <input type="text" name="location" required>

        <label for="email">Email:</label>
        <input type="text" name="email" required>

        <label for="office_id">Choose office :</label>
<select name="office_id" required>
    <option value="">Select Office</option>
    
    <?php
    include 'config.php'; 
    $sql = "SELECT office_id, office_name FROM office ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['office_id'] . "'>" .
                "ID: " . $row['office_id'] . " | Office Name: " . $row['office_name'] . "</option>";
        }
    } else {
        echo "<option value=''>No offices available</option>";
    }
    $conn->close();
    ?>

  </select><br><br>

        <input type="submit" name="submit" value="Add Reservation">
    </form>

    <form action="" method="post" enctype="multipart/form-data">
    </form>

  


 
<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
 
  $car_id = isset($_POST['car_id']) ? $_POST['car_id'] : '';
  $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
  $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
  $location = isset($_POST['location']) ? $_POST['location'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
  $no_of_days= isset($_POST['no_of_days']) ? $_POST['no_of_days'] : '';
  $office_id=isset($_POST['office_id']) ? $_POST['office_id'] : '';
  $ssn=$_POST['ssn'];


  $sql = "INSERT INTO reservations (car_id, customer_id, start_date, end_date, location, email, no_of_days, office_id)
        VALUES ('$car_id', '$ssn', '$start_date', '$end_date', '$location', '$email', '$no_of_days', '$office_id')";

  if ($conn->query($sql) === TRUE) {
      
      $update_query = "UPDATE car SET status = 'rented' WHERE car_id = '$car_id'";
      if ($conn->query($update_query) === TRUE) {
          echo "New record created successfully and car status updated to 'rented'";
      } else {
          echo "Error updating car status: " . $conn->error;
      }
  } else {
      echo "Error inserting reservation: " . $sql . "<br>" . $conn->error;
  }

header("Location: payment.php");
exit();
}

?>



</body>
</html>
