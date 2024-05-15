<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Car Control Panel</title>
   <link rel="stylesheet" href="style.css">
   <style>
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         background: url('img/SignBackGround.jpg') no-repeat center center fixed;
         background-size: cover;
      }

      .container {
         max-width: 400px;
         width: 100%;
         margin: 20px;
      }

      form {
         padding: 20px;
         border: 1px solid #ccc;
         border-radius: 5px;
         background-color: rgba(255, 255, 255, 0.8); 
      }

      input[type="text"],
      select,
      input[type="file"] {
         width: 100%;
         padding: 10px;
         margin-bottom: 10px;
         border: 1px solid #ccc;
         border-radius: 3px;
         box-sizing: border-box;
      }

      input[type="submit"] {
         width: 100%;
         padding: 10px;
         border: none;
         border-radius: 3px;
         background-color: #007bff;
         color: #fff;
         cursor: pointer;
      }

      input[type="submit"]:hover {
         background-color: #0056b3;
      }

      .car-info {
         display: flex;
         align-items: center;
         margin-bottom: 20px;
      }

      .car-info img {
         width: 150px;
         margin-right: 20px;
      }

      .car-details {
         font-size: 16px;
      }
   </style>
</head>

<header>
        <div id="menu"><box-icon name='menu'></box-icon></div>
        <ul class="navbar">
            <li> <a href="admin_page.php">Back to dashboard</a></li>

        
    </header>

<body>

<form action="" method="post" enctype="multipart/form-data">
       <label for="remove_car_id"><h2>Remove a Car</h2></label>
       <select name="remove_car_id">
           <?php
           include 'config.php'; 

           $sql = "SELECT car_id, car_model, car_color, car_year, price_per_day FROM car";
           $result = $conn->query($sql);

           if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                   echo "<option value='" . $row['car_id'] . "'>" . 
                        "ID: " . $row['car_id'] . " - Model: " . $row['car_model'] . 
                        " - Color: " . $row['car_color'] . " - Year: " . $row['car_year'] .
                        " - Price per day $" . $row['price_per_day'] . "</option>";
               }
           } else {
               echo "<option value=''>No cars available</option>";
           }
           ?>
       </select>


<input type="submit" name="remove" value="Remove">
   </form>

   <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove'])) {
       if (!empty($_POST['remove_car_id'])) {
           $remove_car_id = $_POST['remove_car_id'];
           $sql_delete = "DELETE FROM car WHERE car_id = '$remove_car_id'";

           if ($conn->query($sql_delete) === TRUE) {
               echo "Record with Car ID $remove_car_id deleted successfully";
           } else {
               echo "Error deleting record: " . $conn->error;
           }
       }
       header("Location: admin_page.php");
exit();
   }
   
   ?>