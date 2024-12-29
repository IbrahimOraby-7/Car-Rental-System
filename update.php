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
<form action="" method="POST" enctype="multipart/form-data">
    <h2>Modify Car Status</h2>
    <label for="modify_car_id">Select Car to Modify:</label>
    <select name="modify_car_id" required>
        <?php
        include 'config.php'; 

        $sql = "SELECT car_id, car_model FROM car";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['car_id'] . "'>" . $row['car_id'] . " - " . $row['car_model'] . "</option>";
            }
        } else {
            echo "<option value=''>No cars available</option>";
        }
        ?>
    </select>
       <label for="new_status">Select New Status:</label>
       <select name="new_status" required>
           <option value="available">Available</option>
           <option value="rented">Rented</option>
           <option value="out of service">Out of Service</option>
       </select>

       <input type="submit" name="modify" value="Modify Status">
   </form>

   
   <?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modify'])) { 
    $modify_car_id = mysqli_real_escape_string($conn, $_POST['modify_car_id']);
    $new_status = mysqli_real_escape_string($conn, $_POST['new_status']);

 
    $update_query = "UPDATE car SET status = '$new_status' WHERE car_id = '$modify_car_id'";

    if ($conn->query($update_query) === TRUE) {
        echo "Car status updated successfully";
    } else {


echo "Error updating car status: " . $conn->error;
    }

    $conn->close();
}
?>