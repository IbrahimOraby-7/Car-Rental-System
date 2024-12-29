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
            <li> <a href="rent.php">Rent a car</a></li>
            <li> <a href="logout.php">Logout</a></li>

        </ul>
        <div class="header_widegts">
    Hi,<span class="user-header"> <?php echo $_SESSION['user_name'] ?>
    <div class="profile-icon-container">
            </div>
        
    </header>

    


    <!--home-->
    <section class="home" id="home">

    
     <div class="text">  

<!--USER WELCOME--> 
     
<div class="container">
<h1><span>Welcome to </h1> <h1>ANU Car<br>Rental System</br> </h1>
     <p class="rent-now"><b>Rent your car now!</b></p>

    </div>
    </div>
   

    </section>
    


   <section class="services" id="services">
    <div class="heading">
        <span><h1>Our Available Cars<h1> </span> 
      </div>
      <div class="services-container">
      <?php $sql = "SELECT image_url, car_model, car_color, car_year, price_per_day	 FROM car WHERE status ='available'";
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
       
       
      
    </div>
       </section>
      <style>
        
        :root {
    --main-color: #4169E1;
    --second-color: #a305d3;
    --text-color: #444;
    --gradient: linear-gradient(#4169E1, #a305d3);
    --background-color: #f0f0f0; 
}

.logo img {
    width: 70px;
}

.profile-icon-container img {
    width: 45px; 
    height: 45px; 
    border-radius: 50%; 
}

.rent-now {
    font-size: 1.5em;
    background: linear-gradient(90deg, #4169E1, #a305d3);
    -webkit-background-clip: text;
    color: transparent;
    display: inline;
}


    .btn-container {
  display: flex;
  justify-content: center;
  align-items: center;
}


.btn {
  padding: 10px 20px;
  background: url('img/car 1_2.jpg'); 
  color: #fff;
  border-radius: 0.5rem;
}

.btn:hover {
  background-color: #ffff; 
}

.logo img{
    width: 60px;
    
}
body {
    font-family: Arial, sans-serif;
    background-image: url('img/car 1_2.jpg'); 
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat; 
    margin: 0;
    padding: 0;
    height: 100%; 
}
html{
  height: 100%;
}
.navbar{
    display: flex;
    justify-content: center;
}
.navbar li{
    position: relative;
    margin: 0 15px;
}
.navbar a{
    font-size: 1rem;
    padding: 10px 20px;
    color: var(--text-color);
    font-weight: 500;  
    text-align: center;
    display: block; 
}
.navbar a::after {
    content: "";
    width: 0;
    height: 3px;
    position: absolute;
    bottom: -4px;
    left: 0;    
    transition: width 0.5s;
    background-color: #a305d3;
}
.navbar a:hover::after{
    width: 100%;
}


</style>


  
</section>
            <div class="copyright">
                <p>&#169;All Rights Reserved</p>
            </div>

   <script src="https://unpkg.com/scrollreveal"></script>

    <script src="main.js"></script>
    
</body>
</html>


