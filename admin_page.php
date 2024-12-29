<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
  header('location:login_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>car rent</title>
    <link rel="stylesheet" href="style.css">

<body>
</head>

   
<header>
        <a href="#" class="logo"><img src="img/SportsCarLogo.png" alt=""></a>
        <div id="menu"><box-icon name='menu'></box-icon></div>
        <ul class="navbar">
            
            <li> <a href="car_form.php">Add Car</a></li>
            <li> <a href="office.php">Add Office</a></li>
            <li> <a href="remove.php">Remove Car</a></li>
            <li> <a href="update.php">Change status of a car</a></li>
            <li> <a href="reserve_report.php">Reservation Report</a></li>
            <li> <a href="car_report.php">Car Report</a></li>
            <li> <a href="logout.php">Logout</a></li>
            
        </ul>
        
        <div class="header_widegts">
    Hi,<span class="user-header"> <?php echo $_SESSION['user_name'] ?>
    <div class="profile-icon-container">
            </div>
       
    
    </header>


    <section class="home" id="home">
     <div class="text">  

     
<div class="container">
<br> 
<br> 

    <h1><span>Welcome</span> to <br></h1> <h1>ANU Car Rental System Dashboard</h1>
       
    </div>

   <section class="services" id="services">
    <div class="heading">
        <span></span> 
      </div>
    
      </div>

     <section class="services" id="services">
    
      
       </section>
<div class="heading">
        <span><h1>This the list of system cars<h1> </span> 
      </div>
      <div class="services-container">
      <?php $sql = "SELECT image_url, car_model, car_color, car_year, price_per_day	 FROM car";
       $result = $conn->query($sql);

       if ($result->num_rows > 0) {

           while ($row = $result->fetch_assoc()) {
               $imageUrl = $row['image_url'];
               $carModel = $row['car_model'];
               $carColor = $row['car_color'];
               $carYear = $row['car_year'];
               $rentPrice = $row['price_per_day'];
              
               echo "<div class='box'>";
               echo "<div class='box-img'>";
               echo "<img src='$imageUrl' alt='Car Image'>";
               echo "</div>";
               echo "<p>$carYear</p>";
               echo "<h3>$carModel</h3>";
               echo "<h2>$rentPrice$</h2>";
               echo "</div>";
           }
       } else {
           echo "No car information found";
       }
   $conn->close();
   ?>
    
   <script src="https://unpkg.com/scrollreveal"></script>

   <script>
        function allimg() {
    const imgs = document.querySelectorAll("img");
    imgs.forEach((img) => {
      img.addEventListener("mouseenter", () => {
        img.style.transform = `scale(1.05)`;
      });
      img.addEventListener("mouseout", () => {
        img.style.transform = `scale(1)`;
      });
    });
  }
  </script>
    
</body>
</html>

<style>

body {
    background-size: auto;
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.rent-now {
    font-size: 1.5em;
    background: linear-gradient(90deg, #4169E1, #a305d3);
    -webkit-background-clip: text;
    color: transparent;
    display: inline;
}
  .logo img {
    width: 70px;
  }

  .profile-icon-container img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
  }
  .box {
    background-color: #fff; 
    margin: 10px;
    padding: 10px; 
    width: 300px;
}

.box-img img {
    width: 100%; 
}

.box p, .box h3, .box h2 {
    margin: 0; 
}
</style>
