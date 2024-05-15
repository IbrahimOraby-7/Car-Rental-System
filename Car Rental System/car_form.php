<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Control Panel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .remove-link {
            display: block;
            margin-bottom: 20px;
            text-align: center;
        }
        .remove-link a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .remove-link a:hover {
            color: #0056b3;
        }
      body {
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
    background-color: #fff; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

      form {
         padding: 20px;
      }

      label {
         display: block;
         font-weight: bold;
         margin-bottom: 8px;
      }

      input[type="text"],
      select,
      input[type="file"] {
         width: 100%;
         padding: 10px;
         margin-bottom: 15px;
         border: 1px solid #ccc;
         border-radius: 5px;
         box-sizing: border-box;
         font-size: 14px;
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

      .car-info {
         display: flex;
         align-items: center;
         margin-bottom: 20px;
      }

      .car-info img {
         width: 150px;
         margin-right: 20px;
         border-radius: 5px;
         box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      }

      .car-details {
         font-size: 16px;
      }
      .navbar a::after {
    content: "";
    width: 0;
    height: 3px;
    position: absolute;
    bottom: -4px;
    left: 0;
    transition: width 0.5s, background-color 0.3s;
    background-color: #007bff; 
}

.navbar a:hover::after {
    width: 100%;
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
        <h2>Add a Car</h2>
        <label for="car_model">Car Model:</label>
        <input type="text" name="car_model" required>

        <label for="car_year">Car Year:</label>
        <input type="text" name="car_year" required>

        <label for="car_color">Car Color:</label>
        <input type="text" name="car_color" required>

        <label for="rent_price">Price per day:</label>
        <input type="text" name="rent_price" required>

        
        <label for="car_status">Car Status:</label>
        <select name="car_status" required>
        <option value="available">Available</option>
        <option value="rented">Rented</option>
        <option value="out of service">Out of Service</option>
    </select>


        <label for="image_url">Upload Image:</label>
        <input type="file" name="image_url" accept="image/*" required>

        <input type="submit" name="submit" value="Add">
    </form>


    <?php
    include 'config.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
   
        $car_model = isset($_POST['car_model']) ? $_POST['car_model'] : '';
        $car_year = isset($_POST['car_year']) ? $_POST['car_year'] : '';
        $car_color = isset($_POST['car_color']) ? $_POST['car_color'] : '';
        $rent_price = isset($_POST['rent_price']) ? $_POST['rent_price'] : '';
        $car_status = isset($_POST['car_status']) ? $_POST['car_status'] : ''; 

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image_url"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

       
        if ($_FILES["image_url"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "FORMAT DOESN'T MATCH";
            $uploadOk = 0;
        }

       
        if ($uploadOk == 0) {
            echo "ERROR";

              
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

      
        } else {
            if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars(basename($_FILES["image_url"]["name"])). " uploaded Succesfully.";
            } else {
                echo "ERROR.";
            }   
        }

        if ($uploadOk == 1) {
            $image_url = $target_file;
           
            $sql = "INSERT INTO car (car_model, car_year, car_color, price_per_day, image_url, status)
            VALUES ('$car_model', '$car_year', '$car_color', '$rent_price', '$image_url', '$car_status')"; 


            if ($conn->query($sql) === TRUE) {
                echo "The car information has been added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        header("Location: admin_page.php");
exit();
    }
    
    
    ?>   
   
       </select>
   
  
</body>
</html>