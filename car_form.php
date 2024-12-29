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
        <input type="text" name="car_model" required maxlength="20">

        <label for="car_year">Car Year:</label>
        <input type="text" name="car_year" required maxlength="20">

        <label for="car_color">Car Color:</label>
        <input type="text" name="car_color" required maxlength="20">

        <label for="rent_price">Price per day:</label>
        <input type="text" name="rent_price" required maxlength="20">

        
        <label for="car_status">Car Status:</label>
        <select name="car_status" required >
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

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
        // Start output buffering to avoid header issues
        ob_start();

        $car_model = $_POST['car_model'];
        $car_year = $_POST['car_year'];
        $car_color = $_POST['car_color'];
        $rent_price = $_POST['rent_price'];
        $car_status = $_POST['car_status'];

        // File upload handling
        $target_dir = __DIR__ . "/uploads/";
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                die("Failed to create upload directory.");
            }
        }

        $file = $_FILES['image_url'];
        $target_file = $target_dir . basename($file['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate file type and size
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imageFileType, $allowedTypes)) {
            echo "FORMAT DOESN'T MATCH. Allowed formats: webp, jpg, jpeg, png, gif.";
            ob_end_flush();
            exit();
        }

        if ($file['size'] > 500000) { // 500 KB limit
            echo "Sorry, your file is too large.";
            ob_end_flush();
            exit();
        }

        // Validate if the file is an image
        $check = getimagesize($file['tmp_name']);
        if ($check === false) {
            echo "File is not a valid image.";
            ob_end_flush();
            exit();
        }

        // Move file to the target directory
        if (!move_uploaded_file($file['tmp_name'], $target_file)) {
            echo "Failed to upload file.";
            ob_end_flush();
            exit();
        }

        // Save data to the database
        $image_url = "uploads/" . basename($file['name']); // Relative path for storage
        $sql = "INSERT INTO car (car_model, car_year, car_color, price_per_day, image_url, status)
                VALUES ('$car_model', '$car_year', '$car_color', '$rent_price', '$image_url', '$car_status')";

        if ($conn->query($sql) === TRUE) {
            echo "The car information has been added successfully.";
            header("Location: admin_page.php"); // Redirect to admin page
            ob_end_flush();
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        ob_end_flush();
    }
    ?>
   
       </select>
   
  
</body>
</html>
