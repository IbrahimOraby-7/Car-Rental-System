<!DOCTYPE html>
<html>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Add Office</title>
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
         background: url('img/SignBackGround.jpg'); 
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
<h2>Office Information</h2>

        <label for="OfficeName">Office Name:</label>
        <input type="text" id="OfficeName" name="OfficeName" required>
        
        <label for="Office_Location">Office Location:</label>
        <input type="text" id="Office_Location" name="Office_Location" required>
        <input type="submit" name="submit" value="Add Office">

    </form>

 
</form>
<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

  $OfficeName = isset($_POST['OfficeName']) ? $_POST['OfficeName'] : '';
  $Office_Location = isset($_POST['Office_Location']) ? $_POST['Office_Location'] : '';
  
  $sql = "INSERT INTO office (Office_Name ,Office_Location)
          VALUES ('$OfficeName' ,  '$Office_Location') ";

  if ($conn->query($sql) === TRUE) {
     
      echo "The office data has been added succefully";

  }

  header("Location: admin_page.php");
  exit();
}
  


?>




</body>
</html>